/**
 * Bethlehem JS
 */

(function($) {
    "use strict";

    $(document).ready(function () {

        /*===================================================================================*/
        /*  WOW
        /*===================================================================================*/
        
        if (typeof func_name === 'WOW') {
            new WOW().init();
        }

        /*===================================================================================*/
        /*  LAZY LOAD IMAGES USING ECHO
        /*===================================================================================*/
        
        if (typeof func_name === 'echo') {
            echo.init({
                offset: 100,
                throttle: 250,
                unload: false,
                callback: function (element, op) {
                    $( element ).removeClass( 'echo-lazy-loading');
                }
            });
        }

        /*===================================================================================*/
        /*  REMEMBER USER SHOP VIEW
        /*===================================================================================*/
        $('.grid-list-button-item > a').on('click', function(){
            var href = $(this).attr('href');
            eraseCookie( 'user_shop_view' );
            if( href == '#grid-view' ) {
                createCookie( 'user_shop_view', 'grid-view', 300 );
            } else {
                createCookie( 'user_shop_view', 'list-view', 300 );
            }
        });

        /*===================================================================================*/
        /*  STICKY NAVIGATION
        /*===================================================================================*/

        if( bethlehem_options.should_stick == '1' ) {
            $('.header-nav-menu').waypoint('sticky');
        }

        /*===================================================================================*/
        /*  GO TO TOP / SCROLL UP
        /*===================================================================================*/

        if( bethlehem_options.should_scroll == '1' ) {
            $.scrollUp({
                scrollName: "scrollUp", // Element ID
                scrollDistance: 300, // Distance from top/bottom before showing element (px)
                scrollFrom: "top", // "top" or "bottom"
                scrollSpeed: 1000, // Speed back to top (ms)
                easingType: "easeInOutCubic", // Scroll to top easing (see http://easings.net/)
                animation: "fade", // Fade, slide, none
                animationInSpeed: 200, // Animation in speed (ms)
                animationOutSpeed: 200, // Animation out speed (ms)
                scrollText: "<i class='fa fa-angle-up'></i>", // Text for element, can contain HTML
                scrollTitle: " ", // Set a custom <a> title if required. Defaults to scrollText
                scrollImg: 0, // Set true to use image
                activeOverlay: 0, // Set CSS color to display scrollUp active point, e.g "#00FFFF"
                zIndex: 1001 // Z-Index for the overlay
            });
        }
    });

    $(window).load(function(){
        var $container = $('#folio');

        if( $container.length > 0 ) {

            $container.isotope({
                itemSelector : '.post'
            });
            
            var $optionSets = $('#portfolio .folio-filter'),
                $optionLinks = $optionSets.find('a');
            
            $optionLinks.on('click',  function(){
                var $this = $(this);
                // don't proceed if already selected
                if ( $this.hasClass('selected') ) {
                    return false;
                }
                var $optionSet = $this.parents('.folio-filter');
                $optionSet.find('.selected').removeClass('selected');
                $this.addClass('selected');
                // make option object dynamically, i.e. { filter: '.my-filter-class' }
                var options = {},
                    key = $optionSet.attr('data-option-key'),
                    value = $this.attr('data-option-value');

                // parse 'false' as false boolean
                value = value === 'false' ? false : value;
                options[ key ] = value;
                    if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                    changeLayoutMode( $this, options );
                } else {
                    // otherwise, apply new options
                    $container.isotope( options );
                }
                return false;
            });
        }

    });
})(jQuery);

/**
 * Scroll to top
 */
! function (a, b, c) {
    a.fn.scrollUp = function (b) {
        a.data(c.body, "scrollUp") || (a.data(c.body, "scrollUp", !0), a.fn.scrollUp.init(b))
    }, a.fn.scrollUp.init = function (d) {
        var e = a.fn.scrollUp.settings = a.extend({}, a.fn.scrollUp.defaults, d),
            f = e.scrollTitle ? e.scrollTitle : e.scrollText,
            g = a("<a/>", {
                id: e.scrollName,
                href: "#top"/*,
                title: f*/
            }).appendTo("body");
        e.scrollImg || g.html(e.scrollText), g.css({
            display: "none",
            position: "fixed",
            zIndex: e.zIndex
        }), e.activeOverlay && a("<div/>", {
            id: e.scrollName + "-active"
        }).css({
            position: "absolute",
            top: e.scrollDistance + "px",
            width: "100%",
            borderTop: "1px dotted" + e.activeOverlay,
            zIndex: e.zIndex
        }).appendTo("body"), scrollEvent = a(b).scroll(function () {
            switch (scrollDis = "top" === e.scrollFrom ? e.scrollDistance : a(c).height() - a(b).height() - e.scrollDistance, e.animation) {
            case "fade":
                a(a(b).scrollTop() > scrollDis ? g.fadeIn(e.animationInSpeed) : g.fadeOut(e.animationOutSpeed));
                break;
            case "slide":
                a(a(b).scrollTop() > scrollDis ? g.slideDown(e.animationInSpeed) : g.slideUp(e.animationOutSpeed));
                break;
            default:
                a(a(b).scrollTop() > scrollDis ? g.show(0) : g.hide(0))
            }
        }), g.on('click', function (b) {
            b.preventDefault(), a("html, body").animate({
                scrollTop: 0
            }, e.scrollSpeed, e.easingType)
        })
    }, a.fn.scrollUp.defaults = {
        scrollName: "scrollUp",
        scrollDistance: 300,
        scrollFrom: "top",
        scrollSpeed: 300,
        easingType: "linear",
        animation: "fade",
        animationInSpeed: 200,
        animationOutSpeed: 200,
        scrollText: "Scroll to top",
        scrollTitle: !1,
        scrollImg: !1,
        activeOverlay: !1,
        zIndex: 2147483647
    }, a.fn.scrollUp.destroy = function (d) {
        a.removeData(c.body, "scrollUp"), a("#" + a.fn.scrollUp.settings.scrollName).remove(), a("#" + a.fn.scrollUp.settings.scrollName + "-active").remove(), a.fn.jquery.split(".")[1] >= 7 ? a(b).off("scroll", d) : a(b).unbind("scroll", d)
    }, a.scrollUp = a.fn.scrollUp
}(jQuery, window, document);

/**
 * Create cookie
 */
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

/**
 * Read cookie
 */
function readCookie(name) {
    var nameEQ = escape(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}

/**
 * Delete cookie
 */
function eraseCookie(name) {
    createCookie(name, "", -1);
}
