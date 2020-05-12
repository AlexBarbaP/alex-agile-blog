/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-backgroundsize-csstransforms3d-csstransitions-touch-shiv-cssclasses-prefixed-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a){var e=a[d];if(!C(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e}),q.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:w(["@media (",m.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},q.backgroundsize=function(){return F("backgroundSize")},q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&w("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},q.csstransitions=function(){return F("transition")};for(var G in q)y(q,G)&&(v=G.toLowerCase(),e[v]=q[G](),t.push((e[v]?"":"no-")+v));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)y(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},z(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,e.prefixed=function(a,b,c){return b?F(a,b,c):F(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};


/**
 * jquery.gridrotator.js v1.1.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {

    'use strict';

    /*
    * debouncedresize: special jQuery event that happens once after a window resize
    *
    * latest version and complete README available on Github:
    * https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js
    *
    * Copyright 2011 @louis_remi
    * Licensed under the MIT license.
    */
    var $event = $.event,
    $special,
    resizeTimeout;

    $special = $event.special.debouncedresize = {
        setup: function() {
            $( this ).on( "resize", $special.handler );
        },
        teardown: function() {
            $( this ).off( "resize", $special.handler );
        },
        handler: function( event, execAsap ) {
            // Save the context
            var context = this,
                args = arguments,
                dispatch = function() {
                    // set correct event type
                    event.type = "debouncedresize";
                    $event.dispatch.apply( context, args );
                };

            if ( resizeTimeout ) {
                clearTimeout( resizeTimeout );
            }

            execAsap ?
                dispatch() :
                resizeTimeout = setTimeout( dispatch, $special.threshold );
        },
        threshold: 100
    };

    // http://www.hardcode.nl/subcategory_1/article_317-array-shuffle-function
    Array.prototype.shuffle = function() {
        var i=this.length,p,t;
        while (i--) {
            p = Math.floor(Math.random()*i);
            t = this[i];
            this[i]=this[p];
            this[p]=t;
        }
        return this;
    };

    // HTML5 PageVisibility API
    // http://www.html5rocks.com/en/tutorials/pagevisibility/intro/
    // by Joe Marini (@joemarini)
    function getHiddenProp(){
        var prefixes = ['webkit','moz','ms','o'];

        // if 'hidden' is natively supported just return it
        if ('hidden' in document) return 'hidden';

        // otherwise loop over all the known prefixes until we find one
        for (var i = 0; i < prefixes.length; i++){
            if ((prefixes[i] + 'Hidden') in document)
                return prefixes[i] + 'Hidden';
        }

        // otherwise it's not supported
        return null;
    }
    function isHidden() {
        var prop = getHiddenProp();
        if (!prop) return false;

        return document[prop];
    }

    function isEmpty( obj ) {
        return Object.keys(obj).length === 0;
    }

    // global
    var $window = $( window ),
        Modernizr = window.Modernizr;

    $.GridRotator = function( options, element ) {

        this.$el = $( element );
        if( Modernizr.backgroundsize ) {

            var self = this;
            this.$el.addClass( 'gfort-section-bg-images-grid-loading-img' );
            this._init( options );

        }

    };

    // the options
    $.GridRotator.defaults = {
        // number of rows
        rows : 4,
        // number of columns
        columns : 10,
        wLG : { rows : 3, columns : 8 },
        wMD : {rows : 3,columns : 7 },
        wSM : {rows : 3,columns : 5 },
        wXS : {rows : 2,columns : 4 },
        // step: number of items that are replaced at the same time
        // random || [some number]
        // note: for performance issues, the number "can't" be > options.maxStep
        step : 'random',
        // change it as you wish..
        maxStep : 3,
        // prevent user to click the items
        preventClick : true,
        // animation type
        // showHide || fadeInOut ||
        // slideLeft || slideRight || slideTop || slideBottom ||
        // rotateBottom || rotateLeft || rotateRight || rotateTop ||
        // scale ||
        // rotate3d ||
        // rotateLeftScale || rotateRightScale || rotateTopScale || rotateBottomScale ||
        // random
        animType : 'random',
        // animation speed
        animSpeed : 800,
        // animation easings
        animEasingOut : 'linear',
        animEasingIn: 'linear',
        // the item(s) will be replaced every 3 seconds
        // note: for performance issues, the time "can't" be < 300 ms
        interval : 3000,
        // if false the animations will not start
        // use false if onhover is true for example
        slideshow : true,
        // if true the items will switch when hovered
        onhover : false,
        // ids of elements that shouldn't change
        nochange : []
    };

    $.GridRotator.prototype = {

        _init : function( options ) {

            // options
            this.options = $.extend( true, {}, $.GridRotator.defaults, options );
            // cache some elements + variables
            this._config();

        },
        _config : function() {

            var self = this,
                transEndEventNames = {
                    'WebkitTransition' : 'webkitTransitionEnd',
                    'MozTransition' : 'transitionend',
                    'OTransition' : 'oTransitionEnd',
                    'msTransition' : 'MSTransitionEnd',
                    'transition' : 'transitionend'
                };

            // support CSS transitions and 3d transforms
            this.supportTransitions = Modernizr.csstransitions;
            this.supportTransforms3D = Modernizr.csstransforms3d;

            this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.gridrotator';

            // all animation types for the random option
            this.animTypes = this.supportTransforms3D ? [
                'fadeInOut',
                'slideLeft',
                'slideRight',
                'slideTop',
                'slideBottom',
                'rotateLeft',
                'rotateRight',
                'rotateTop',
                'rotateBottom',
                'scale',
                'rotate3d',
                'rotateLeftScale',
                'rotateRightScale',
                'rotateTopScale',
                'rotateBottomScale' ] :
                [ 'fadeInOut', 'slideLeft', 'slideRight', 'slideTop', 'slideBottom' ];

            this.animType = this.options.animType;

            if( this.animType !== 'random' && !this.supportTransforms3D && $.inArray( this.animType, this.animTypes ) === -1 && this.animType !== 'showHide' ) {

                // fallback to 'fadeInOut' if user sets a type which is not supported
                this.animType = 'fadeInOut';

            }

            this.animTypesTotal = this.animTypes.length;

            // the <ul> where the items are placed
            this.$list = this.$el.children( 'ul' );
            // remove images and add background-image to anchors
            // preload the images before
            var loaded = 0,
                $imgs = this.$list.find( 'img' ),
                count = $imgs.length;

            $imgs.each( function() {

                var $img = $( this ), src = $img.attr( 'src' );

                $( '<img/>' ).on('load', function() {

                    ++loaded;
                    $img.parent().css( 'background-image', 'url(' + src + ')' );

                    if( loaded === count ) {

                        $imgs.remove();
                        self.$el.removeClass( 'gfort-section-bg-images-grid-loading-img' );
                        // the items
                        self.$items = self.$list.children( 'li' );
                        // make a copy of the items
                        self.$itemsCache = self.$items.clone();
                        // total number of items
                        self.itemsTotal = self.$items.length;
                        // the items that will be out of the grid
                        // actually the item's child (anchor element)
                        self.outItems= [];
                        self._layout( function() {
                            self._initEvents();
                        } );
                        // replace [options.step] items after [options.interval] time
                        // the items that go out are randomly chosen, while the ones that get in
                        // follow a "First In First Out" logic
                        self._start();

                    }

                } ).attr( 'src', src )

            } );

        },
        _layout : function( callback ) {

            var self = this;

            // sets the grid dimentions based on the container's width
            this._setGridDim();

            // reset
            this.$list.empty();
            this.$items = this.$itemsCache.clone().appendTo( this.$list );

            var $outItems = this.$items.filter( ':gt(' + ( this.showTotal - 1 ) + ')' ),
                $outAItems = $outItems.children( 'a' );

            this.outItems.length = 0;

            $outAItems.each( function( i ) {
                self.outItems.push( $( this ) );
            } );

            $outItems.remove();

                // container's width
            var containerWidth = ( document.defaultView ) ? parseInt( document.defaultView.getComputedStyle( this.$el.get( 0 ), null ).width ) : this.$el.width(),
                // item's width
                itemWidth = Math.floor( containerWidth / this.columns ),
                // calculate gap
                gapWidth = containerWidth - ( this.columns * Math.floor( itemWidth ) );

            for( var i = 0; i < this.rows; ++i ) {

                for( var j = 0; j < this.columns; ++j ) {

                    var idx = this.columns * i + j,
                        $item = this.$items.eq( idx );

                    $item.css( {
                        width : j < Math.floor( gapWidth ) ? itemWidth + 1 : itemWidth,
                        height : itemWidth
                    } );

                    if( $.inArray( idx, this.options.nochange ) !== -1 ) {
                        $item.addClass( 'ri-nochange' ).data( 'nochange', true );
                    }

                }

            }

            if( this.options.preventClick ) {

                this.$items.children().css( 'cursor', 'default' ).on( 'click.gridrotator', false );

            }

            if( callback ) {
                callback.call();
            }

        },
        // set the grid rows and columns
        _setGridDim  : function() {

            // container's width
            var c_w = this.$el.width();

            // we will choose the number of rows/columns according to the container's width and the values set in the plugin options
            switch( true ) {
                case ( c_w < 576 ) : this.rows = this.options.wXS.rows; this.columns = this.options.wXS.columns; break;
                case ( c_w < 768 ) : this.rows = this.options.wSM.rows; this.columns = this.options.wSM.columns; break;
                case ( c_w < 992 ) : this.rows = this.options.wMD.rows; this.columns = this.options.wMD.columns; break;
                case ( c_w < 1200 ) : this.rows = this.options.wLG.rows; this.columns = this.options.wLG.columns; break;
                default : this.rows = this.options.rows; this.columns = this.options.columns; break;
            }

            this.showTotal = this.rows * this.columns;

        },
        // init window resize event
        _initEvents : function() {

            var self = this;

            $window.on( 'debouncedresize.gridrotator', function() {
                self._layout();
            } );

            // use the property name to generate the prefixed event name
            var visProp = getHiddenProp();

            // HTML5 PageVisibility API
            // http://www.html5rocks.com/en/tutorials/pagevisibility/intro/
            // by Joe Marini (@joemarini)
            if (visProp) {

                var evtname = visProp.replace(/[H|h]idden/,'') + 'visibilitychange';
                document.addEventListener(evtname, function() { self._visChange(); } );

            }

            if( !Modernizr.touch && this.options.onhover ) {

                self.$items.on( 'mouseenter.gridrotator', function() {

                    var $item = $( this );
                    if( !$item.data( 'active' ) && !$item.data( 'hovered' ) && !$item.data( 'nochange' ) ) {
                        $item.data( 'hovered', true );
                        self._replace( $item );
                    }

                } ).on( 'mouseleave.gridrotator', function() {

                    $( this ).data( 'hovered', false );

                } );

            }

        },
        _visChange : function() {

            isHidden() ? clearTimeout( this.playtimeout ) : this._start();

        },
        // start rotating elements
        _start : function() {

            if( this.showTotal < this.itemsTotal && this.options.slideshow ) {
                this._showNext();
            }

        },
        // get which type of animation
        _getAnimType : function() {

            return this.animType === 'random' ? this.animTypes[ Math.floor( Math.random() * this.animTypesTotal ) ] : this.animType;

        },
        // get css properties for the transition effect
        _getAnimProperties : function( $out ) {

            var startInProp = {}, startOutProp = {}, endInProp = {}, endOutProp = {},
                animType = this._getAnimType(), speed, delay = 0;

            switch( animType ) {

                case 'showHide' :

                    speed = 0;
                    endOutProp.opacity = 0;
                    break;

                case 'fadeInOut' :

                    endOutProp.opacity = 0;
                    break;

                case 'slideLeft' :

                    startInProp.left = $out.width();
                    endInProp.left = 0;
                    endOutProp.left = -$out.width();
                    break;

                case 'slideRight' :

                    startInProp.left = -$out.width();
                    endInProp.left = 0;
                    endOutProp.left = $out.width();
                    break;

                case 'slideTop' :

                    startInProp.top = $out.height();
                    endInProp.top = 0;
                    endOutProp.top = -$out.height();
                    break;

                case 'slideBottom' :

                    startInProp.top = -$out.height();
                    endInProp.top = 0;
                    endOutProp.top = $out.height();
                    break;

                case 'rotateLeft' :

                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'rotateY(90deg)';
                    endInProp.transform = 'rotateY(0deg)';
                    delay = speed;
                    endOutProp.transform = 'rotateY(-90deg)';
                    break;

                case 'rotateRight' :

                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'rotateY(-90deg)';
                    endInProp.transform = 'rotateY(0deg)';
                    delay = speed;
                    endOutProp.transform = 'rotateY(90deg)';
                    break;

                case 'rotateTop' :

                    speed = this.options.animSpeed / 2;
                    startInProp.transform= 'rotateX(90deg)';
                    endInProp.transform = 'rotateX(0deg)';
                    delay = speed;
                    endOutProp.transform = 'rotateX(-90deg)';
                    break;

                case 'rotateBottom' :

                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'rotateX(-90deg)';
                    endInProp.transform = 'rotateX(0deg)';
                    delay = speed;
                    endOutProp.transform = 'rotateX(90deg)';
                    break;

                case 'scale' :

                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'scale(0)';
                    startOutProp.transform = 'scale(1)';
                    endInProp.transform = 'scale(1)';
                    delay = speed;
                    endOutProp.transform = 'scale(0)';
                    break;

                case 'rotateLeftScale' :

                    startOutProp.transform = 'scale(1)';
                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'scale(0.3) rotateY(90deg)';
                    endInProp.transform = 'scale(1) rotateY(0deg)';
                    delay = speed;
                    endOutProp.transform = 'scale(0.3) rotateY(-90deg)';
                    break;

                case 'rotateRightScale' :

                    startOutProp.transform = 'scale(1)';
                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'scale(0.3) rotateY(-90deg)';
                    endInProp.transform = 'scale(1) rotateY(0deg)';
                    delay = speed;
                    endOutProp.transform = 'scale(0.3) rotateY(90deg)';
                    break;

                case 'rotateTopScale' :

                    startOutProp.transform = 'scale(1)';
                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'scale(0.3) rotateX(90deg)';
                    endInProp.transform = 'scale(1) rotateX(0deg)';
                    delay = speed;
                    endOutProp.transform = 'scale(0.3) rotateX(-90deg)';
                    break;

                case 'rotateBottomScale' :

                    startOutProp.transform = 'scale(1)';
                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'scale(0.3) rotateX(-90deg)';
                    endInProp.transform = 'scale(1) rotateX(0deg)';
                    delay = speed;
                    endOutProp.transform = 'scale(0.3) rotateX(90deg)';
                    break;

                case 'rotate3d' :

                    speed = this.options.animSpeed / 2;
                    startInProp.transform = 'rotate3d( 1, 1, 0, 90deg )';
                    endInProp.transform = 'rotate3d( 1, 1, 0, 0deg )';
                    delay = speed;
                    endOutProp.transform = 'rotate3d( 1, 1, 0, -90deg )';
                    break;

            }

            return {
                startInProp : startInProp,
                startOutProp : startOutProp,
                endInProp : endInProp,
                endOutProp : endOutProp,
                delay : delay,
                animSpeed : speed != undefined ? speed : this.options.animSpeed
            };

        },
        // show next [option.step] elements
        _showNext : function( time ) {

            var self = this;

            clearTimeout( this.playtimeout );

            this.playtimeout = setTimeout( function() {

                var step = self.options.step, max= self.options.maxStep, min = 1;

                if( max > self.showTotal ) {
                    max = self.showTotal;
                }

                    // number of items to swith at this point of time
                var nmbOut  = step === 'random' ? Math.floor( Math.random() * max + min ) : Math.min( Math.abs( step ) , max ) ,
                    // array with random indexes. These will be the indexes of the items we will replace
                    randArr = self._getRandom( nmbOut, self.showTotal );

                for( var i = 0; i < nmbOut; ++i ) {

                    // element to go out
                    var $out = self.$items.eq( randArr[ i ] );

                    // if element is active, which means it is currently animating,
                    // then we need to get different positions..
                    if( $out.data( 'active' ) || $out.data( 'nochange' ) ) {

                        // one of the items is active, call again..
                        self._showNext( 1 );
                        return false;

                    }

                    self._replace( $out );

                }

                // again and again..
                self._showNext();

            }, time || Math.max( Math.abs( this.options.interval ) , 300 ) );

        },
        _replace : function( $out ) {

            $out.data( 'active', true );

            var self = this,
                $outA = $out.children( 'a:last' ),
                newElProp = {
                    width : $outA.width(),
                    height : $outA.height()
                };

            // element stays active
            $out.data( 'active', true );

            // get the element (anchor) that will go in (first one inserted in this.outItems)
            var $inA = this.outItems.shift();

            // save element that went out
            this.outItems.push( $outA.clone().css( 'transition', 'none' ) );

            // prepend in element
            $inA.css( newElProp ).prependTo( $out );

            var animProp = this._getAnimProperties( $outA );

            $inA.css( animProp.startInProp );
            $outA.css( animProp.startOutProp );

            this._setTransition( $inA, 'all', animProp.animSpeed, animProp.delay, this.options.animEasingIn );
            this._setTransition( $outA, 'all', animProp.animSpeed, 0, this.options.animEasingOut );

            this._applyTransition( $inA, animProp.endInProp, animProp.animSpeed, function() {

                var $el = $( this ),
                    t = animProp.animSpeed === self.options.animSpeed && isEmpty( animProp.endInProp ) ? animProp.animSpeed : 0;

                setTimeout( function() {

                    if( self.supportTransitions ) {
                        $el.off( self.transEndEventName );
                    }

                    $el.next().remove();
                    $el.parent().data( 'active', false );

                }, t );

            }, animProp.animSpeed === 0 || isEmpty( animProp.endInProp ) );
            this._applyTransition( $outA, animProp.endOutProp, animProp.animSpeed );

        },
        _getRandom : function( cnt, limit ) {

            var randArray = [];

            for( var i = 0; i < limit; ++i ) {
                randArray.push( i )
            }

            return randArray.shuffle().slice( 0, cnt );

        },
        _setTransition : function( el, prop, speed, delay, easing ) {

            setTimeout( function() {
                el.css( 'transition', prop + ' ' + speed + 'ms ' + delay + 'ms ' + easing );
            }, 25 );

        },
        _applyTransition : function( el, styleCSS, speed, fncomplete, force ) {

            var self = this;
            setTimeout( function() {
                $.fn.applyStyle = self.supportTransitions ? $.fn.css : $.fn.animate;

                if( fncomplete && self.supportTransitions ) {

                    el.on( self.transEndEventName, fncomplete );

                    if( force ) {
                        fncomplete.call( el );
                    }

                }

                fncomplete = fncomplete || function() { return false; };

                el.stop().applyStyle( styleCSS, $.extend( true, [], { duration : speed + 'ms', complete : fncomplete } ) );
            }, 25 );

        }

    };

    var logError = function( message ) {

        if ( window.console ) {

            window.console.error( message );

        }

    };

    $.fn.gridrotator = function( options ) {

        var instance = $.data( this, 'gridrotator' );

        if ( typeof options === 'string' ) {

            var args = Array.prototype.slice.call( arguments, 1 );

            this.each(function() {

                if ( !instance ) {

                    logError( "cannot call methods on gridrotator prior to initialization; " +
                    "attempted to call method '" + options + "'" );
                    return;

                }

                if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {

                    logError( "no such method '" + options + "' for gridrotator instance" );
                    return;

                }

                instance[ options ].apply( instance, args );

            });

        }
        else {

            this.each(function() {

                if ( instance ) {

                    instance._init();

                }
                else {

                    instance = $.data( this, 'gridrotator', new $.GridRotator( options, this ) );

                }

            });

        }

        return instance;

    };

} )( jQuery, window );