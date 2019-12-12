/*!
 * ==============================================================
 *  TEXT EDITOR 3.1.3
 * ==============================================================
 * Author: Taufik Nurrohman <https://github.com/taufik-nurrohman>
 * License: MIT
 * --------------------------------------------------------------
 */
!function(n,t,e){function r(n){return n.length}function u(n){return n instanceof Array}function i(n){return"function"==typeof n}function a(n){return n instanceof RegExp?n.source||!0:!1}function f(n){return void 0!==n}function o(n){return"string"==typeof n}function c(t){if(u(t)){var r,i=[];for(r in t)i[r]=c(t[r]);return i}return t[w](l("["+n[e].x[w](/./g,"\\$&")+"]","g"),"\\$&")}function l(n,t){return a(n)||RegExp(n,t)}function s(n,t){return n["trim"+(-1===t?"Left":1===t?"Right":"")]()}var v="__instance__",p="Selection",g="blur",b="disabled",d="focus",h="insert",m="match",y="parentNode",S="readOnly",w="replace",_="scroll",x=_+"Left",E=_+"Top",O="select",R=O+"ion",j=R+"End",T=R+"Start",L="substring",k=setTimeout;!function(e){e._=e.prototype,e.version="3.1.3",e[v]={},e.each=function(n,t){var r,u;return k(function(){u=$[v];for(r in u)n.call(u[r],r)},0===t?0:t||1),e},e.x="!$^*()-=+[]{}\\|:<>,./?",e.esc=c,e[p]=function(n,t,e){var u,i=this;i.start=n,i.end=t,i.value=u=e[L](n,t),i.before=e[L](0,n),i.after=e[L](t),i.length=r(u),i.toString=function(){return u}};var u=t.currentScript;e.path=(u&&u.src||n.location.href).split("/").slice(0,-1).join("/")}(n[e]=function($,R){function L(){return $.value[w](/\r/g,"")}if($){var k=this,A=n[e],H=/^([\s\S]*?)$/,N=t.body,X=N[y];if($[e])return k;if(R=R||{},o(R)&&(R={tab:R}),f(R.tab)||(R.tab="	"),k.state=R,!(k instanceof A))return new A($,R);A[v][$.id||$.name||r(Object.keys(A[v]))]=k,k.self=k.source=$,k.value=L(),k.get=function(){return!$[b]&&s($.value)||null},k.let=function(){return $.value=k.value,k},k.set=function(n){return $[b]||$[S]?k:($.value=n,k)},k.$=function(){var n=new A[p]($[T],$[j],L());return n},k[d]=function(n){var t,e;return-1===n?t=e=0:1===n&&(t=r(L()),e=$[_+"Height"]),f(t)&&f(e)&&($[T]=$[j]=t,$[E]=e),$[d](),k},k[g]=function(){return $[g](),k},k[O]=function(){if($[b]||$[S])return $[d](),k;var t,e,u,i=arguments,a=r(i),f=k.$();if(t=n.pageXOffset||X[x]||N[x],e=n.pageYOffset||X[E]||N[E],u=$[E],0===a)i[0]=f.start,i[1]=f.end;else if(1===a){if(!0===i[0])return $[d](),$[O](),k;i[1]=i[0]}return $[d](),$.setSelectionRange(i[0],i[1]),$[E]=u,n.scroll(t,e),k},k[m]=function(n,t){if(u(n)){var e=k.$(),r=[e.before[m](n[0]),e.value[m](n[1]),e.after[m](n[2])];return i(t)?t.call(k,r[0]||[],r[1]||[],r[2]||[]):[!!r[0],!!r[1],!!r[2]]}var r=k.$().value[m](n);return i(t)?t.call(k,r||[]):!!r},k[w]=function(n,t,e){var u=k.$(),i=u.before,a=u.after,f=u.value;return-1===e?i=i[w](n,t):1===e?a=a[w](n,t):f=f[w](n,t),k.set(i+f+a)[O](i=r(i),i+r(f))},k[h]=function(n,t,e){var r=H;return e&&k[w](r,""),-1===t?r=/$/:1===t&&(r=/^/),k[w](r,n,t)},k.wrap=function(n,t,e){var u=k.$(),i=u.before,a=u.after,f=u.value;return e?k[w](H,n+"$1"+t):k.set(i+n+f+t+a)[O](i=r(i+n),i+r(f))},k.peel=function(n,t,e){var u=k.$(),i=u.before,f=u.after,o=u.value;n=a(n)||c(n),t=a(t)||c(t);var s=l(n+"$"),v=l("^"+t);return e?k[w](l("^"+n+"([\\s\\S]*?)"+t+"$"),"$1"):s.test(i)&&v.test(f)?(i=i[w](s,""),f=f[w](v,""),k.set(i+o+f)[O](i=r(i),i+r(o))):k[O]()},k.pull=function(n,t){var e=k.$();return n=f(n)?n:R.tab,n=a(n)||c(n),f(t)||(t=!0),r(e)?t?k[w](l("^"+n,"gm"),""):k[h](e.value.split("\n").map(function(t){return l("^("+n+")*$").test(t)?t:t[w](l("^"+n),"")}).join("\n")):k[w](l(n+"$"),"",-1)},k.push=function(n,t){var e=k.$();return n=f(n)?n:R.tab,f(t)||(t=!1),r(e)?k[w](l("^"+(t?"":"(?!$)"),"gm"),n):k[h](n,-1)},k.trim=function(n,t,e,u,i){f(i)||(i=!0),null!==n&&!1!==n&&(n=n||""),null!==t&&!1!==t&&(t=t||""),null!==e&&!1!==e&&(e=e||""),null!==u&&!1!==u&&(u=u||"");var a=k.$(),o=a.before,c=a.after,l=a.value,v=s(o,1),$=s(c,-1);return o=!1!==n?s(o,1)+(v||!i?n:""):o,c=!1!==t?($||!i?t:"")+s(c,-1):c,!1!==e&&(l=s(l,-1)),!1!==u&&(l=s(l,1)),k.set(o+l+c)[O](o=r(o),o+r(l))}}})}(window,document,"TE");
/*!
 * ==============================================================
 *  TEXT EDITOR HISTORY 1.1.0
 * ==============================================================
 * Author: Taufik Nurrohman <https://github.com/taufik-nurrohman>
 * License: MIT
 * --------------------------------------------------------------
 */
!function(t,n,e){function r(t,n,e){return u(n)&&n>t?n:u(e)&&t>e?e:t}function u(t){return void 0!==t}var i=t[e],a=i._,o="_history",c=o+"State";a[o]=[],a[c]=-1,a.history=function(t){var n=this;return u(t)?u(n[o][t])?n[o][t]:null:n[o]},a.record=function(t){var n=this,e=n.$(),r=n[o][n[c]]||[],i=[n.self.value,e.start,e.end];return i[0]===r[0]&&i[1]===r[1]&&i[2]===r[2]?n:(++n[c],n[o][u(t)?t:n[c]]=i,n)},a.loss=function(t){var n,e=this;return!0===t?(e[o]=[],e[c]=-1,[]):(n=e[o].splice(u(t)?t:e[c],1),e[c]=r(e[c]-1,-1),n)},a.undo=function(){var t,n=this;return n[c]=r(n[c]-1,0,n[o].length-1),t=n[o][n[c]],n.set(t[0]).select(t[1],t[2])},a.redo=function(){var t,n=this;return n[c]=r(n[c]+1,0,n[o].length-1),t=n[o][n[c]],n.set(t[0]).select(t[1],t[2])}}(window,document,"TE");
/*!
 * ==============================================================
 *  TEXT EDITOR SOURCE 1.1.2
 * ==============================================================
 * Author: Taufik Nurrohman <https://github.com/taufik-nurrohman>
 * License: MIT
 * --------------------------------------------------------------
 */
!function(e,t,n){function o(e,t,n){e.removeEventListener(t,n)}function r(e,t,n){e.addEventListener(t,n,!1)}function a(e,t){return Object.assign(e,t)}function c(e){return"function"==typeof e}function i(e){e&&e.preventDefault()}var u,s,f=e[n],l=setTimeout,d=f.esc,p="blur",v="close",y="ctrlKey",b="disabled",h="focus",m="fromCharCode",w="indexOf",g="lastIndexOf",E="keydown",$="match",k="mousedown",x="mouseup",C="pull",O="push",L="readOnly",_="record",K="redo",R="replace",T="select",j="shiftKey",z="toLowerCase",D="touch",I=D+"end",S=D+"start",W="undo";u=function(e,t){function u(){e[b]||e[L]||l(function(){{var e=A.$(),t=/\W/g,n=".",o=e.before[R](t,n)[g](n),r=e.after[R](t,n)[w](n);e.value}o=0>o?0:o+1,r=0>r?e.after.length:r,M!==e.start&&A[T](o,e.end+r)},0)}function s(){M=A.$().start}function D(n){if(!e[b]&&!e[L]){var o=N[v],r=t.tab,a=n.keyCode,c=(n.key||String[m](a))[z](),u=n[y],s="enter"===c||13===a,f=n[j],w="tab"===c||9===a,g=A.$(),E=g.before,k=g.value,x=g.after,_=E.slice(-1),R=x.slice(0,1),D=E[$](RegExp("(?:^|\\n)("+d(r)+"+).*$")),I=D?D[1]:"",S=o[c];u?F&&("z"===c||90===a?(A[W](),i(n)):("y"===c||89===a)&&(A[K](),i(n))):w?(A[f?C:O](r),q(),i(n)):"\\"!==_&&c===R?(A[T](g.end+1),q(),i(n)):"\\"!==_&&S?(q(),A.wrap(c,S),q(),i(n)):"backspace"===c||8===a?(!k&&E[$](RegExp(d(r)+"$"))?(A[C](r),i(n)):(S=o[_],S&&S===R&&(A.peel(_,R),i(n))),q()):"delete"===c||46===a?(S=o[_],S&&S===R&&(A.peel(_,R),i(n)),q()):s?(S=o[_],S&&S===R?(A.wrap("\n"+r+I,"\n"+I)[p]()[h](),i(n)):(k||I)&&(A.insert("\n",-1,!0)[O](I)[p]()[h](),i(n)),q()):l(q,0)}}function q(){F&&A[_]()}var A=this,B=A.pop,F=W in f._;f.call(this,e,t);var G="source",t=A.state,H={},J=!(G in t)||t[G];H[v]={"(":")","{":"}","[":"]",'"':'"',"'":"'","<":">"},H[T]=!0,J&&(t[G]=a(H,!0===t[G]?{}:t[G]));var M,N=t[G]||{};J&&(r(e,E,D),N[T]&&(r(e,k,u),r(e,x,s),r(e,I,s),r(e,S,u)),q()),A.pop=function(){return c(B)&&B.call(A),o(e,E,D),o(e,k,u),o(e,x,s),o(e,I,s),o(e,S,u),delete e[n],F&&A[loss](!0),A},A.state=t};for(s in f)u[s]=f[s];u.prototype=u._=f._,e[n]=u}(window,document,"TE");


(function(doc) {
    var source = doc.querySelectorAll('.field\\:source .textarea'), $$;
    source.length && source.forEach(function($) {
        $$ = new TE($, JSON.parse($.getAttribute('data-state') || '{}'));
    });
})(document);