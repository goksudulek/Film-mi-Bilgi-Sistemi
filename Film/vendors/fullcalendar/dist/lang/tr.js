=arguments.length,i=new Array(a>3?a-3:0),s=3;s<a;s++)i[s-3]=arguments[s];var y="debug"===o?"log":o;if(console[y]){var _,w=$.contextStringify(r);i[0].message?i=[w].concat(_toConsumableArray(i)):i[0]="".concat(w," ").concat(i[0]),(_=console)[y].apply(_,_toConsumableArray(i))}return Promise.resolve()},deferUntil:void 0,deferredLogs:[]},server:{enable:function serverEnable(){return!1},handler:function serverHandler(n,r,o){for(var a=arguments.length,i=new Array(a>3?a-3:0),s=3;s<a;s++)i[s-3]=arguments[s];return _logToServer(n,i[0].message?$.contextObjAppend(_objectSpread({level:o},i[0]),r):$.contextObjAppend({level:o,message:$.truncate($.format.apply($,i))},r))},batchHandler:function serverBatchHandler(n){if(0!==n.length){var r=[];return n.forEach((function(n){var o=n[3].message?n[3]:{message:$.truncate($.format.apply($,_toConsumableArray(n.slice(3))))};r.push($.contextObjAppend(_objectSpread({level:n[2]},o),n[1]))})),_logToServer(n[0][0],r)}},deferUntil:void 0,deferredLogs:[]}},defaultTimeout:3e4,asyncInterval:1e4};var B=new $;r.logging=B;var ne=$;r.default=ne},"9NTL":function(n,r,o){"use strict";Object.defineProperty(r,"__esModule",{value:!0}),r.default=function bindAndCatch(n,r,o){if(1===arguments.length||"function"!=typeof o.value)throw new TypeError("@bindAndCatch applies only to methods");var i=o.value;return o.value=function(){try{return i.apply(this,arguments)}catch(n){this.setState((function(){throw n}))}},(0,a.default)(n,r,o)};var a=function _interopRequireDefault(n){return n&&n.__esModule?n:{default:n}}(o("gIfm"))},A4of:function(n,r,o){"use strict";function replaceClassName(n,r){return n.replace(new RegExp("(^|\\s)"+r+"(?:\\s|$)","g"),"$1").replace(/\s+/g," ").replace(/^\s*|\s*$/g,"")}n.exports=function removeClass(n,r){n.classList?n.classList.remove(r):"string"==typeof n.className?n.className=replaceClassName(n.className,r):n.setAttribute("class",replaceClassName(n.className&&n.className.baseVal||"",r))}},Ah8R:function(n,r,o){n.exports=function(){"use strict";return[{locale:"it",pluralRuleFunction:function(n,r){var o=!String(n).split(".")[1];return r?11==n||8==n||80==n||800==n?"many":"other":1==n&&o?"one":"other"},fields:{year:{displayName:"anno",relative:{0:"quest’anno",1:"anno prossimo","-1":"anno scorso"},relativeTime:{future:{one:"tra {0} anno",othe