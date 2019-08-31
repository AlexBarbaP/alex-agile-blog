/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
// require('../css/app.css');

// require and version all images
const imagesContext = require.context('../images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

(function ($) {
    /**
     * Shows and hides mobile menu with a CSS transition.
     */
    $('#toggle-menu-container').on('touchstart click', function (e) {
        e.preventDefault();

        var body = $('body');
        var content = $('#content');

        /* Cross browser support for CSS "transition end" event */
        var transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

        /* When the toggle menu link is clicked, animation starts */
        body.addClass('animating');

        /**
         * Determine correct direction of the animation.
         */
        if (body.hasClass('menu-visible')) {
            body.addClass('up');
        } else {
            body.addClass('down');
        }

        /**
         * When CSS transition has finished, remove animating classes and either add or remove
         * "menu-visible" class depending whether it was visible or not previously.
         */
        content.on(transitionEnd, function () {
            body
                .removeClass('animating down up')
                .toggleClass('menu-visible');

            content.off(transitionEnd);
        });
    });
})($);
