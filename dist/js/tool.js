(()=>{"use strict";var e={142:(e,t,n)=>{n.d(t,{Z:()=>a});var r=n(645),o=n.n(r)()((function(e){return e[1]}));o.push([e.id,"",""]);const a=o},645:e=>{e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var n=e(t);return t[2]?"@media ".concat(t[2]," {").concat(n,"}"):n})).join("")},t.i=function(e,n,r){"string"==typeof e&&(e=[[null,e,""]]);var o={};if(r)for(var a=0;a<this.length;a++){var i=this[a][0];null!=i&&(o[i]=!0)}for(var s=0;s<e.length;s++){var c=[].concat(e[s]);r&&o[c[0]]||(n&&(c[2]?c[2]="".concat(n," and ").concat(c[2]):c[2]=n),t.push(c))}},t}},379:(e,t,n)=>{var r,o=function(){return void 0===r&&(r=Boolean(window&&document&&document.all&&!window.atob)),r},a=function(){var e={};return function(t){if(void 0===e[t]){var n=document.querySelector(t);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(e){n=null}e[t]=n}return e[t]}}(),i=[];function s(e){for(var t=-1,n=0;n<i.length;n++)if(i[n].identifier===e){t=n;break}return t}function c(e,t){for(var n={},r=[],o=0;o<e.length;o++){var a=e[o],c=t.base?a[0]+t.base:a[0],l=n[c]||0,u="".concat(c," ").concat(l);n[c]=l+1;var d=s(u),f={css:a[1],media:a[2],sourceMap:a[3]};-1!==d?(i[d].references++,i[d].updater(f)):i.push({identifier:u,updater:v(f,t),references:1}),r.push(u)}return r}function l(e){var t=document.createElement("style"),r=e.attributes||{};if(void 0===r.nonce){var o=n.nc;o&&(r.nonce=o)}if(Object.keys(r).forEach((function(e){t.setAttribute(e,r[e])})),"function"==typeof e.insert)e.insert(t);else{var i=a(e.insert||"head");if(!i)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");i.appendChild(t)}return t}var u,d=(u=[],function(e,t){return u[e]=t,u.filter(Boolean).join("\n")});function f(e,t,n,r){var o=n?"":r.media?"@media ".concat(r.media," {").concat(r.css,"}"):r.css;if(e.styleSheet)e.styleSheet.cssText=d(t,o);else{var a=document.createTextNode(o),i=e.childNodes;i[t]&&e.removeChild(i[t]),i.length?e.insertBefore(a,i[t]):e.appendChild(a)}}function p(e,t,n){var r=n.css,o=n.media,a=n.sourceMap;if(o?e.setAttribute("media",o):e.removeAttribute("media"),a&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var m=null,h=0;function v(e,t){var n,r,o;if(t.singleton){var a=h++;n=m||(m=l(t)),r=f.bind(null,n,a,!1),o=f.bind(null,n,a,!0)}else n=l(t),r=p.bind(null,n,t),o=function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(n)};return r(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap)return;r(e=t)}else o()}}e.exports=function(e,t){(t=t||{}).singleton||"boolean"==typeof t.singleton||(t.singleton=o());var n=c(e=e||[],t);return function(e){if(e=e||[],"[object Array]"===Object.prototype.toString.call(e)){for(var r=0;r<n.length;r++){var o=s(n[r]);i[o].references--}for(var a=c(e,t),l=0;l<n.length;l++){var u=s(n[l]);0===i[u].references&&(i[u].updater(),i.splice(u,1))}n=a}}}},744:(e,t)=>{t.Z=(e,t)=>{const n=e.__vccOpts||e;for(const[e,r]of t)n[e]=r;return n}}},t={};function n(r){var o=t[r];if(void 0!==o)return o.exports;var a=t[r]={id:r,exports:{}};return e[r](a,a.exports,n),a.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),n.nc=void 0,(()=>{const e=Vue;var t={class:"mb-6"},r={key:0,class:"error text-error-message mb-6"},o={key:1,class:"mb-6"},a={key:0},i={key:2};const s={mounted:function(){this.updateStatus(),this.startStatusRefresh()},props:{publishing:{type:Boolean,default:!0},lastRun:Object,error:String},data:function(){return{error:"",publishing:!1,lastRun:void 0}},methods:{publish:function(){var e=this;this.publishing=!0,Nova.request().post("/nova-vendor/publish/publish").then((function(t){e.error=""})).catch((function(t){e.error=t.message,e.publishing=!1}))},updateStatus:function(){var e=this;Nova.request().get("/nova-vendor/publish/last-publish-run").then((function(t){e.lastRun=t.data,e.publishing="completed"!==t.data.status,e.error=""})).catch((function(t){e.error=t.message}))},startStatusRefresh:function(){var e=this;window.setInterval((function(){e.updateStatus()}),1e4)},formatDate:function(e){return new Intl.DateTimeFormat(Nova.config("locale"),{dateStyle:"full",timeStyle:"long"}).format(new Date(e))}}};var c=n(379),l=n.n(c),u=n(142),d={insert:"head",singleton:!1};l()(u.Z,d);u.Z.locals;const f=(0,n(744).Z)(s,[["render",function(n,s,c,l,u,d){var f=(0,e.resolveComponent)("Head"),p=(0,e.resolveComponent)("heading"),m=(0,e.resolveComponent)("default-button");return(0,e.openBlock)(),(0,e.createElementBlock)(e.Fragment,null,[(0,e.createVNode)(f,{title:n.__("title")},null,8,["title"]),(0,e.createVNode)(p,{class:"mb-6"},{default:(0,e.withCtx)((function(){return[(0,e.createTextVNode)((0,e.toDisplayString)(n.__("heading")),1)]})),_:1}),(0,e.createElementVNode)("p",t,(0,e.toDisplayString)(n.__("explanation")),1),(0,e.createVNode)(m,{onClick:d.publish,disabled:!!u.publishing,class:"mb-6"},{default:(0,e.withCtx)((function(){return[(0,e.createTextVNode)((0,e.toDisplayString)(n.__("button_text")),1)]})),_:1},8,["onClick","disabled"]),u.error?((0,e.openBlock)(),(0,e.createElementBlock)("p",r,(0,e.toDisplayString)(n.__("error",u.error)),1)):(0,e.createCommentVNode)("",!0),u.lastRun&&"completed"===u.lastRun.status?((0,e.openBlock)(),(0,e.createElementBlock)("p",o,[(0,e.createTextVNode)((0,e.toDisplayString)(n.__("completed_message",{last_run:d.formatDate(u.lastRun.updated_at)}))+" ",1),"failure"===u.lastRun.conclusion?((0,e.openBlock)(),(0,e.createElementBlock)("span",a,(0,e.toDisplayString)(n.__("error_short")),1)):(0,e.createCommentVNode)("",!0)])):(0,e.createCommentVNode)("",!0),u.lastRun&&"completed"!==u.lastRun.status?((0,e.openBlock)(),(0,e.createElementBlock)("p",i,(0,e.toDisplayString)(n.__("running_message",{last_run:d.formatDate(u.lastRun.created_at)})),1)):(0,e.createCommentVNode)("",!0)],64)}]]);Nova.booting((function(e){Nova.inertia("PublishTool",f)}))})()})();