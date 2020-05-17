/*!
 * ==============================================================
 *  F3H 1.0.7
 * ==============================================================
 * Author: Taufik Nurrohman <https://github.com/taufik-nurrohman>
 * License: MIT
 * --------------------------------------------------------------
 */
!function(e,t,n){var r,o,u,i="GET",s="POST",c="document",f="text",a="replace",l="test",p=e.history,h=e.location,d="//"+h.hostname,v=t.documentElement,m=t.currentScript;function g(e,t){return e.getAttribute(t)}function b(e,t){return e.hasAttribute(t)}function y(e,t,n){return e.setAttribute(t,n)}function L(e){return e.innerHTML}function E(e){return"false"!==e&&(""===e||"null"===e?null:"true"===e||(/^-?(\d*\.)?\d+$/[l](e)?+e:e))}function T(e){return M(e)?"submit":"click"}function k(e,t,n){e.removeEventListener(t,n)}function S(e,t,n){e.addEventListener(t,n,!1)}function w(e){return e.split("#")[1]||""}function H(e){return e.split("#")[0]}function x(e){var t,n=0,r=e.length;if(0===r)return n;for(t=0;t<r;++t)n=(n<<5)-n+e.charCodeAt(t),n&=n;return n<1?-1*n:n}function C(e){return"function"==typeof e}function M(e){return"form"===I(e.nodeName)}function A(e){return void 0!==e}function j(e){if(e.src&&m.src===e.src)return 1;var t=I(n);return b(e,"data-"+t)||b(e,t)?1:new RegExp("\\b"+n+"\\b").test(L(e)||"")?1:0}function N(e){for(var t,r,o,u,i={},s=P("link[rel=dns-prefetch],link[rel=preconnect],link[rel=prefetch],link[rel=preload],link[rel=prerender]",e),c=0,f=s.length;c<f;++c)o=r=s[c],void 0,u=I(n),b(o,"data-"+u)||b(o,u)||(r.id=t=r.id||n+":"+x(g(r,"href")||L(r)),i[t]=$(r),i[t][2].href=r.href);return i}function O(e,n){return(n||t).querySelector(e)}function P(e,n){return(n||t).querySelectorAll(e)}function R(e,t,n){n.insertBefore(e,t&&n===t.parentNode?t:null)}function q(e){if(e){var t=e.parentNode;t&&t.removeChild(e)}}function D(e){var n=t.createElement(e[0]);for(var r in n.innerHTML=e[1],e[2])y(n,r,K(e[2][r]));return n}function $(e){for(var t=e.attributes,n=[I(e.nodeName),L(e),{}],r=0,o=t.length;r<o;++r)n[2][t[r].name]=E(t[r].value);return n}function B(e){return e[a](/\/+$/,"")}function F(e){e.preventDefault()}function U(){return h.href}function X(e){for(var t,r,o={},u=P("script",e),i=0,s=u.length;i<s;++i)j(r=u[i])||(r.id=t=r.id||n+":"+x(g(r,"src")||L(r)),o[t]=$(r));return o}function _(e){for(var t,r,o,u,i={},s=P("link[rel=stylesheet],style",e),c=0,f=s.length;c<f;++c)o=r=s[c],void 0,u=I(n),b(o,"data-"+u)||b(o,u)||(r.id=t=r.id||n+":"+x(g(r,"href")||L(r)),i[t]=$(r));return i}function G(e,n){return e?t.getElementById(e)||(n?t.getElementsByName(e)[0]:null):null}function I(e){return e.toLowerCase()}function J(e){return e.toUpperCase()}function z(e){var t,n,r,o,u={},i=e.getAllResponseHeaders().trim().split(/[\r\n]+/);for(t in i)r=I((n=i[t].split(": ")).shift()),I(o=n.join(": ")),u[r]=E(o);return new Proxy(u,{get:function(e,t){return e[I(t)]||null},set:function(e,t,n){e[I(t)]=n}})}function K(e){return!1===e?"false":null===e?"null":!0===e?"true":e+""}(u=e[n]=function(u){var l,h=this,d=e[n],m={},g={},b=U(),y={},L=N(),E=X(),x=_(),j=Object.assign({},d.state,!0===u?{cache:u}:u||{}),$=I(j.sources);if(j.turbo&&(j.cache=!0),!(h instanceof d))return new d(u);function I(e,t){var n=P(e,t),r=U();if(C(j.is)){for(var o=[],u=0,i=n.length;u<i;++u)j.is.call(h,n[u],r)&&o.push(n[u]);return o}return n}function K(e){var n=t.createElement("input"),r=P("[name][type=submit][value]",e);n.type="hidden",R(n,0,e);for(var o=0,u=r.length;o<u;++o)S(r[o],"click",function(){n.name=this.name,n.value=this.value})}function Q(n,r,o){var u=n===e,s=j.history;if(i!==r||n!==l||u){if(l=n,b=h.ref=o,ue("exit",[t,n]),j.cache){var f=m[B(H(o))];if(f)return h.lot=f[2],h.status=f[0],f[3]&&u&&s&&te(v),ee(o),a=[f[1],n],f[3]&&(L=ne(a[0])),f[3]&&(x=oe(a[0])),ue("success",a),ue(f[0],a),$=I(j.sources),f[3]&&(E=re(a[0])),le(a),void ue("enter",a)}var a,p,d,g,y,T=Y(n,r,o,j.lot),k=c===T.responseType,w=T.upload;return S(T,"abort",function(){C(),ue("abort",[T.response,n])}),S(T,"error",p=function(){C(),k&&u&&s&&te(v),a=[T.response,n],k&&(L=ne(a[0])),k&&(x=oe(a[0])),ue("error",a),$=I(j.sources),k&&(E=re(a[0])),le(a),ue("enter",a)}),S(w,"error",p),S(T,"load",p=function(){if(C(),a=[T.response,n],g=T.responseURL,y>=300&&y<400){var t=B(g);return m[t]&&delete m[t],ue("success",a),ue(y,a),void Q(l=e,i,g||o)}k&&s&&te(v),i===r&&ee(o),k&&(x=oe(a[0])),ue("success",a),ue(y,a),$=I(j.sources),k&&(E=re(a[0])),le(a),ue("enter",a)}),S(w,"load",p),S(T,"progress",function(e){C(),ue("pull",e.lengthComputable?[e.loaded,e.total]:[0,-1])}),S(w,"progress",function(e){C(),ue("push",e.lengthComputable?[e.loaded,e.total]:[0,-1])}),T}function C(){d=z(T),y=T.status,i===r&&j.cache&&y&&(m[B(H(o))]=[y,T.response,d,k]),h.lot=d,h.status=y}}function V(e){y[e]&&y[e][0]&&(y[e][0].abort(),delete y[e])}function W(){for(var e in y)V(e)}function Y(e,t,n,r){n=C(j.ref)?j.ref.call(h,e,n):n;var o,u=new XMLHttpRequest,i=J(n.split(/[?&#]/)[0].split("/").pop().split(".")[1]||""),c=j.types[i]||f;if(C(c)&&(c=c.call(h,n)),u.responseType=c,u.open(t,n,!0),function(e){return"object"==typeof e}(r))for(o in r)u.setRequestHeader(o,r[o]);return u.send(s===t?new FormData(e):null),u}function Z(e,t){var n,r=Y(e,i,t);S(r,"load",function(){200===(n=r.status)&&(m[B(H(t))]=[n,r.response,z(r),c===r.responseType])})}function ee(e){e!==U()&&j.history&&p.pushState({},"",e)}function te(e){e&&(v.scrollLeft=o.scrollLeft=e.offsetLeft,v.scrollTop=o.scrollTop=e.offsetTop)}function ne(e){var t,n,o,u=N(e),i={};for(t in L)(n=O("#"+t[a](/[:.]/g,"\\$&")))&&(i[t]=n.nextElementSibling),u[t]||(delete L[t],q(G(t)));for(t in u)L[t]||(L[t]=o=u[t],R(D(o),i[t],r));return L}function re(e){var t,n,r,u=X(e),i={};for(t in E)(n=O("#"+t[a](/[:.]/g,"\\$&")))&&(i[t]=n.nextElementSibling),u[t]||(delete E[t],q(G(t)));for(t in u)E[t]||(E[t]=r=u[t],R(D(r),i[t],o));return E}function oe(e){var t,n,o,u=_(e),i={};for(t in x)(n=O("#"+t[a](/[:.]/g,"\\$&")))&&(i[t]=n.nextElementSibling),u[t]||(delete x[t],q(G(t)));for(t in u)x[t]||(x[t]=o=u[t],R(D(o),i[t],r));return x}function ue(e,t){if(!A(g[e]))return h;for(var n=0,r=g[e].length;n<r;++n)g[e][n].apply(h,t);return h}function ie(){o=t.body,r=t.head,le([t,e]),j.cache&&Z(e,U())}function se(e){W();var t,n=this,r=n.href,o=n.action,u=r||o,s=J(n.method||i);i===s&&(ee(u),M(n)&&(t=new URLSearchParams(new FormData(n))+"",u=B(u.split(/[?&#]/)[0])+(t?"?"+t:""))),y[u]=[Q(n,s,u),n],F(e)}function ce(e){te(G(w(U()),1)),F(e)}function fe(){var e=this,t=e.href;m[B(H(t))]||Z(e,t),k(e,"mousemove",fe)}function ae(t){W();var n=U();w(n)&&H(b)===H(n)||(y[n]=[Q(e,i,n),e])}function le(e){for(var t=j.turbo,n=0,r=$.length;n<r;++n)S($[n],T($[n]),se),M($[n])?K($[n]):t&&S($[n],"mousemove",fe);!function(e){if(g.focus)ue("focus",e);else{var t=O("[autofocus]");t&&t.focus()}}(e),function(e){g.scroll?ue("scroll",e):te(G(w(U()),1))}(e)}return d.instances[Object.keys(d.instances).length]=h,h.abort=function(e){return e?y[e]&&V(e):W(),h},h.pop=function(){return function(){for(var e=0,t=$.length;e<t;++e)k($[e],T($[e]),se)}(),k(e,"DOMContentLoaded",ie),k(e,"hashchange",ce),k(e,"popstate",ae),ue("pop",[t,e]),h.abort()},h.caches=m,h.fetch=function(e,t,n){return Y(n,t,e)},h.fire=ue,h.hooks=g,h.links=L,h.lot={},h.off=function(e,t){if(!A(e))return g={},h;if(A(g[e]))if(A(t))for(var n=0,r=g[e].length;n<r;++n)t===g[e][n]&&g[e].splice(n,1);else delete g[e];return h},h.on=function(e,t){return A(g[e])||(g[e]=[]),A(t)&&g[e].push(t),h},h.ref=null,h.scripts=E,h.state=j,h.status=null,h.styles=x,S(e,"DOMContentLoaded",ie),S(e,"hashchange",ce),S(e,"popstate",ae),h}).version="1.0.7",u.state={cache:!1,history:!0,is:function(e,t){var n=e.target,r=g(e,"href")||g(e,"action")||"",o=e.href||e.action||"";return!(n&&"_self"!==n||"#"===r[0]||/^(data|javascript|mailto):/[l](r)||w(o)&&H(t)===H(o)||""!==r&&0!==r.search(/[.\/?]/)&&0!==r.search(d)&&0!==r.search(h.protocol+d)&&0===r.search("://"))},lot:{"x-requested-with":n},ref:function(e,t){return t},sources:"a[href],form",turbo:!1,types:{"":c,ASP:c,HTM:c,HTML:c,JSON:"json",PHP:c,XML:c}},u.instances={},u._=u.prototype}(this,this.document,"F3H");


(function(win, doc, _) {
    function $$(query, context) {
        return (context || doc).querySelectorAll(query);
    }
    let root = doc.documentElement,
        selectors = 'body>div>main,body>div>nav,body>svg',
        elements = $$(selectors),
        f3h = new F3H({
            cache: false
        });
    _.on('error', function() {
        win.location.reload();
    });
    F3H.state.types.ALERT = 'document';
    F3H.state.types.STATE = 'document';
    f3h.on('error', function() {
        _.fire('error');
    });
    f3h.on('exit', function() {
        _.fire('let');
    });
    f3h.on('success', function(response, target) {
        let status = this.status,
            responseElements = $$(selectors, response),
            responseRoot = response.documentElement;
        if (200 === status || 404 === status) {
            doc.title = response.title;
            responseRoot && (root.className = responseRoot.className + ' can:fetch');
            elements.forEach(function(element, index) {
                if (responseElements[index]) {
                    element.className = responseElements[index].className;
                    element.innerHTML = responseElements[index].innerHTML;
                }
            });
            _.fire('change');
        }
    });
    _.f3h = f3h;
})(this, this.document, this._);
