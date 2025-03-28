<?php
/**
 * Shared functions.
 *
 * @package LiveChat
 */

namespace LiveChat;

use stdClass;
use WP_User;

define( 'TEXT_TOKEN_DATA_DB_KEY', 'token_data' );

/**
 * Get numeric value from string.
 *
 * @param string $value Stringified numeric value.
 * @return string
 */
function get_numeric_value_from_string( string $value ): float {
	return floatval( preg_replace( '/[^\d\.]/', '', $value ) );
}

/**
 * Get the WooCommerce product variant title.
 *
 * @param array $variation The product variation.
 * @return string
 */
function get_variant_title( array $variation ): string {
	$variant_title = '';

	foreach ( $variation as $attribute_name => $attribute_value ) {
		// Output the variation attribute values (e.g., "Large / black").
		$variant_title .= $attribute_value . ' / ';
	}

	// remove the last ' / '.
	return rtrim( $variant_title, ' / ' );
}

/**
 * Get the WooCommerce cart.
 *
 * @param \WC_Cart $cart The WooCommerce cart.
 * @param string   $currency The currency.
 * @return void
 */
function text_get_cart( \WC_Cart $cart, string $currency ): void {
	$response = new stdClass();

	$response->currency = $currency;
	$response->total    = get_numeric_value_from_string( $cart->get_cart_contents_total() );
	$response->subtotal = get_numeric_value_from_string( $cart->get_subtotal() );

	$response->items = array();

	$items = $cart->get_cart_contents();

	$product_ids = array();
	foreach ( $items as $item ) {
		$product_ids[] = $item['product_id'];
	}

	$products = wc_get_products(
		array(
			'include' => $product_ids,
		)
	);

	foreach ( $items as $item ) {
		$product = $products[ array_search( $item['product_id'], array_column( $products, 'id' ), true ) ];

		$subtotal = $item['line_subtotal'];
		$value    = $item['line_total'];

		$discount = $subtotal - $value;

		$response->items[] = array(
			'id'                => $item['product_id'],
			'thumbnailUrl'      => get_the_post_thumbnail_url( $product->get_id(), 'shop_thumbnail' ),
			'title'             => $product->get_name(),
			'variantTitle'      => get_variant_title( $item['variation'] ),
			'variantId'         => $item['variation_id'],
			'discounts'         => array(
				'amount' => $discount,
			),
			'qty'               => $item['quantity'],
			'value'             => $value,
			'productPreviewUrl' => $product->get_permalink(),
		);
	}

	wp_send_json_success( $response );
}

/**
 * Check if the user is on a specific page.
 *
 * @param string $page_id The page ID.
 * @return bool
 */
function is_user_on_page( string $page_id ): bool {
	$screen = get_current_screen();
	return ! is_null( $screen ) && $page_id === $screen->id;
}

/**
 * Create an API URL.
 *
 * @param string $endpoint The API endpoint.
 * @param ?array $query The query parameters.
 * @return string
 */
function text_build_api_url( string $endpoint, ?array $query = null ): string {
	$url = 'https://' . TEXT_DOMAIN . $endpoint;

	if ( ! $query ) {
		return $url;
	}

	return $url . '?' . http_build_query( $query );
}

/**
 * Get the visitor data.
 *
 * @return ?stdClass
 */
function text_get_visitor_data(): ?stdClass {
	if ( ! is_user_logged_in() ) {
		return null;
	}

	$user = wp_get_current_user();

	$visitor = new stdClass();

	$visitor->email = $user->user_email;
	$visitor->name  = $user->display_name;

	return $visitor;
}

/**
 * Return the URL for the /api/v1/oauth/initiate endpoint.
 *
 * @return string
 */
function get_oauth_initiate_url(): string {
	$query_params = array(
		'email'     => wp_get_current_user()->user_email,
		'url'       => get_site_url(),
		'adminUrl'  => admin_url(),
		'productId' => TEXT_PRODUCT_ID,
		'partnerId' => TEXT_PARTNER_ID,
		'phpVer'    => phpversion(),
		'wpVer'     => get_bloginfo( 'version' ),
		'pluginVer' => TEXT_PLUGIN_VERSION,
		'nonce'     => wp_create_nonce( 'text_connect' ),
	);

	if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
		$query_params['woocommerceVer'] = WOOCOMMERCE_VERSION;
	}

	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		$query_params['elementorVer'] = ELEMENTOR_VERSION;
	}

	return text_build_api_url( '/api/v1/oauth/initiate', $query_params );
}

/**
 * Return the URL for the /api/v1/public/:websiteUuid/deactivation-feedback endpoint.
 *
 * @return ?string
 */
function get_deactivation_feedback_url(): ?string {
	$token_data = text_get_token();

	if ( ! $token_data ) {
		return null;
	}

	return text_build_api_url( '/api/v1/public/' . $token_data['websiteUuid'] . '/deactivation-feedback' );
}

/**
 * Check if the plugin is active.
 *
 * @return bool
 */
function text_is_auto_update_enabled(): bool {
	$auto_update_plugins = get_option( 'auto_update_plugins', array() );
	return in_array( TEXT_PLUGIN_BASE, $auto_update_plugins, true );
}

/**
 * Get option value from the database.
 *
 * @return array
 */
function text_get_token(): array {
	return get_option( TEXT_DB_PREFIX . TEXT_TOKEN_DATA_DB_KEY, array() );
}

/**
 * Update option value in the database.
 *
 * @param array $token Decoded token.
 * @return bool
 */
function text_update_token( array $token ): bool {
	return update_option( TEXT_DB_PREFIX . TEXT_TOKEN_DATA_DB_KEY, $token );
}

/**
 * Delete option value from the database.
 *
 * @return bool
 */
function text_cleanup(): bool {
	return delete_option( TEXT_DB_PREFIX . TEXT_TOKEN_DATA_DB_KEY );
}

/**
 * Get legacy widget script url value from the database.
 *
 * @return ?string
 */
function text_get_legacy_widget_url(): ?string {
	return get_option( 'livechat_widget_url', null );
}

/**
 * Remove wp options from legacy integration.
 *
 * @return void
 */
function text_remove_legacy_options(): void {
	global $wpdb;

	try {
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'livechat_%'" );
	} catch ( \Exception $e ) {
		// Stop propagating error as it should not break the flow.
		return;
	}
}
