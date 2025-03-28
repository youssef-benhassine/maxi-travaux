"use strict";(globalThis.webpackChunkcomplianz_gdpr=globalThis.webpackChunkcomplianz_gdpr||[]).push([[626,9091,756,2010],{10626:(e,a,t)=>{t.r(a),t.d(a,{default:()=>g});var n=t(51609),o=t(86087),s=t(9588),c=t(99091),l=t(27723),r=t(52010),i=t(45111),d=t(15139),m=t(52043),p=t(4219),u=t(80756),_=t(32828);const g=(0,o.memo)((()=>{const{setSyncProgress:e,fetchSyncProgressData:a}=(0,d.default)(),{initialLoadCompleted:t,loading:g,nextPage:f,progress:b,setProgress:z,cookies:h,fetchProgress:v,lastLoadedIframe:w,setLastLoadedIframe:E}=(0,c.UseCookieScanData)(),[k,y]=(0,o.useState)(!1),{addHelpNotice:N,fieldsLoaded:C}=(0,p.default)(),{selectedSubMenuItem:L}=(0,m.default)(),{setProgressLoaded:P}=(0,_.default)(),[S,T]=(0,o.useState)(!1);(0,o.useEffect)((()=>{w!==f&&(k||(y(!0),A()))}),[f,w,k]),(0,o.useEffect)((()=>{!k&&!g&&b<100&&v()}),[k,g,b]),(0,o.useEffect)((()=>{C&&(void 0===window.canRunAds&&N("cookie_scan","warning",(0,l.__)("You are using an ad blocker. This will prevent most cookies from being placed. Please run the scan without an adblocker enabled.","complianz-gdpr"),(0,l.__)("Ad Blocker detected.","complianz-gdpr"),null),I()&&N("cookie_scan","warning",(0,l.__)("Your browser has the Do Not Track or Global Privacy Control setting enabled.","complianz-gdpr")+"&nbsp;"+(0,l.__)("This will prevent most cookies from being placed.","complianz-gdpr")+"&nbsp;"+(0,l.__)("Please run the scan with these browser options disabled.","complianz-gdpr"),(0,l.__)("DNT or GPC enabled.","complianz-gdpr"),null))}),[C]),(0,o.useEffect)((()=>{(async()=>{try{const e=await s.doAction("get_wsc_status",{});T(e.wsc_lock)}catch(e){console.error("Error activating Website Scan:",e)}})()}),[]);const I=()=>{let e="doNotTrack"in navigator&&"1"===navigator.doNotTrack;return"globalPrivacyControl"in navigator&&navigator.globalPrivacyControl||e},A=()=>{if(!f)return void y(!1);let e=document.getElementById("cmplz_cookie_scan_frame");e||(e=document.createElement("iframe"),e.setAttribute("id","cmplz_cookie_scan_frame"),e.classList.add("hidden")),e.setAttribute("src",f),e.onload=function(e){setTimeout((()=>{y(!1),E(f)}),200)},document.body.appendChild(e)};if("cookie-scan"!==L)return null;let D=h?h.length:0,x="";x=0===D?(0,l.__)("No cookies found on your domain yet.","complianz-gdpr"):1===D?(0,l.__)("The scan found 1 cookie on your domain.","complianz-gdpr"):(0,l.__)("The scan found %s cookies on your domain.","complianz-gdpr").replace("%s",D),b>=100?D>0&&(x+=" "+(0,l.__)("Continue the wizard to categorize cookies and configure consent.","complianz-gdpr")):x+=" "+(0,l.__)("Scanning, %s complete.","complianz-gdpr").replace("%s",Math.round(b)+"%"),t||(x=(0,n.createElement)(i.default,{name:"loading",color:"grey"}));let U=!!S||b<100&&b>0;return(0,n.createElement)(n.Fragment,null,S&&(0,n.createElement)("div",{className:"cmplz-wscscan-alert"},(0,n.createElement)(i.default,{name:"warning",color:"orange",size:48}),(0,n.createElement)("div",{className:"cmplz-wscscan-alert-group"},(0,n.createElement)("div",{className:"cmplz-wscscan-alert-group-title"},(0,l.__)("Advanced Scan Unavailable","complianz-gdpr")),(0,n.createElement)("div",{className:"cmplz-wscscan-alert-group-desc"},(0,l.__)("We need to authenticate this domain.","complianz-gpdr"))),(0,n.createElement)("div",{className:"cmplz-wscscan-alert-desc-long"},(0,l.__)("The new advanced Website Scan needs to authenticate your website for security purposes. It only takes a second!")),(0,n.createElement)("div",null,(0,n.createElement)("button",{type:"button",onClick:()=>{const e=new URL(cmplz_settings.dashboard_url);e.searchParams.set("websitescan",""),setTimeout((()=>{window.location.href=e.href}),500)},className:"cmplz-wscscan-alert button-secondary"},(0,l.__)("Start","complianz-gdpr")))),(0,n.createElement)("div",{className:"cmplz-table-header"},(0,n.createElement)("button",{disabled:U,className:"button button-default",onClick:t=>(async()=>{z(1),await s.doAction("scan",{scan_action:"restart"}),await v(),100===b&&(await a(),h.length>0&&e(1))})()},(0,l.__)("Scan","complianz-gdpr")),(0,n.createElement)("button",{disabled:U,className:"button button-default cmplz-reset-button",onClick:t=>(async()=>{z(1),await s.doAction("scan",{scan_action:"reset"}),await v(),100===b&&(P(!1),await a(),h.length>0&&e(1))})()},(0,l.__)("Clear Cookies","complianz-gdpr"))),(0,n.createElement)("div",{id:"cmplz-scan-progress"},(0,n.createElement)("div",{className:"cmplz-progress-bar",style:Object.assign({},{width:b+"%"})})),(0,n.createElement)("div",null,(0,n.createElement)("div",{className:"cmplz-panel__list"},(0,n.createElement)(r.default,{summary:x,details:(0,u.default)(t,h)}))))}))},99091:(e,a,t)=>{t.r(a),t.d(a,{UseCookieScanData:()=>s});var n=t(81621),o=t(9588);const s=(0,n.vt)(((e,a)=>({initialLoadCompleted:!1,setInitialLoadCompleted:a=>e({initialLoadCompleted:a}),iframeLoaded:!1,loading:!1,nextPage:!1,progress:0,cookies:[],lastLoadedIframe:"",setIframeLoaded:a=>e({iframeLoaded:a}),setLastLoadedIframe:a=>e((e=>({lastLoadedIframe:a}))),setProgress:a=>e({progress:a}),fetchProgress:()=>(e({loading:!0}),o.doAction("get_scan_progress",{}).then((a=>(e({initialLoadCompleted:!0,loading:!1,nextPage:a.next_page,progress:a.progress,cookies:a.cookies}),a))))})))},80756:(e,a,t)=>{t.r(a),t.d(a,{default:()=>o});var n=t(51609);const o=(e,a)=>(0,n.createElement)(n.Fragment,null,e&&a.map(((e,a)=>(0,n.createElement)("div",{key:a},e))))},52010:(e,a,t)=>{t.r(a),t.d(a,{default:()=>c});var n=t(51609),o=t(45111),s=t(86087);const c=e=>{const[a,t]=(0,s.useState)(!1);return(0,n.createElement)("div",{className:"cmplz-panel__list__item",style:e.style?e.style:{}},(0,n.createElement)("details",{open:a},(0,n.createElement)("summary",{onClick:e=>(e=>{e.preventDefault(),t(!a)})(e)},e.icon&&(0,n.createElement)(o.default,{name:e.icon}),(0,n.createElement)("h5",{className:"cmplz-panel__list__item__title"},e.summary),(0,n.createElement)("div",{className:"cmplz-panel__list__item__comment"},e.comment),(0,n.createElement)("div",{className:"cmplz-panel__list__item__icons"},e.icons),(0,n.createElement)(o.default,{name:"chevron-down",size:18})),(0,n.createElement)("div",{className:"cmplz-panel__list__item__details"},a&&e.details)))}}}]);