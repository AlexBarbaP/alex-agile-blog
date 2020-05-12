/*
gfortInsta
Description: Instagram Feed by Graphicfort
Version: 1.0
Author: Graphicfort
Author URL: http://graphicfort.com
*/
/*global $*/
(function ($) {

    'use strict';

    $.fn.gfortInsta = function (options) {

        var settings,
            el = $(this),
            imagesCount,
            imageItem = '',
            imagesWrapper = '<div class="gfort-instagram-feed-block-container">',
            imageSRC,
            columnsWrapper = 'row',
            gridGutter,
            colXL,
            colLG,
            colMD,
            colSM,
            colXS,
            instaSliderTimer;

        settings = $.extend({
            count: 6,
            imagesSize: '',
            userID: '',
            accessToken: '',
            linkClass: '',
            showText: 'yes',
            text: '',
            columnsWrapper: columnsWrapper,
            gridGutter: '0',
            colXL: 'col-xl-1',
            colLG: 'col-lg-1',
            colMD: 'col-md-1',
            colSM: 'col-sm-1',
            colXS: 'col-1',
            slider: false
        }, options);

        el.append('<span class="gfort-insta-loading"></span>');

        gridGutter = settings.gridGutter;
        colXL = settings.colXL;
        colLG = settings.colLG;
        colMD = settings.colMD;
        colSM = settings.colSM;
        colXS = settings.colXS;

        if (settings.slider === true) {
            gridGutter = '';
            columnsWrapper = 'gfort-owl-slider gfort-instagram-owl-slider owl-carousel';
            colXL = 'gfort-owl-slider-item';
            colLG = '';
            colMD = '';
            colSM = '';
            colXS = '';
        }

        $.ajax({
            type: 'GET',
            url: 'https://api.instagram.com/v1/users/' + settings.userID + '/media/recent/?access_token=' + settings.accessToken,
            dataType: 'jsonp',
            cache: true,
            success: function (response) {

                if (response.meta.code === 400) {

                    el.append('<p class="gfort-text-center">The access token provided is invalid.</p>');

                } else {

                    imageItem = '<div class="' + columnsWrapper + ' ' + gridGutter + '">';

                    for (imagesCount = 0; imagesCount < settings.count && imagesCount < response.data.length; imagesCount += 1) {

                        if (settings.imagesSize === 'low_resolution') {
                            imageSRC = response.data[imagesCount].images.low_resolution.url;
                        } else if (settings.imagesSize === 'standard_resolution') {
                            imageSRC = response.data[imagesCount].images.standard_resolution.url;
                        } else {
                            imageSRC = response.data[imagesCount].images.thumbnail.url;
                        }

                        imageItem += '<div class="gfort-grid-item ' + colXL + ' ' + colLG + ' ' + colMD + ' ' + colSM + ' ' + colXS + '"><a class="gfort-insta-item ' + settings.linkClass + '" href="' + response.data[imagesCount].link + '" target="_blank" rel="noopener"><img src="' + imageSRC + '" alt="Instagram Image" /></a></div>';

                    }

                    if (settings.showText === 'yes') {
                        imagesWrapper += '<h6 class="font-size-13"><a href="https://www.instagram.com/' + response.data[0].user.username + '" target="_blank" rel="noopener" class="gfort-insta-username">' + settings.text + ' @' + response.data[0].user.username + '</a>' + '</h6>';
                    }

                    imagesWrapper += imageItem + '</div></div>';

                    return el.append(imagesWrapper);

                }

            }
        }).done(function () {

            el.find('.gfort-insta-loading').remove();

            if (settings.slider === true) {

                if ($().owlCarousel) {

                    instaSliderTimer = setTimeout(function () {

                        el.find('.gfort-instagram-owl-slider').each(function () {

                            var instaSlider = $(this),
                                margin = parseInt(el.attr('data-gfort-owl-slider-items-margin'), 10),
                                loop = el.attr('data-gfort-owl-slider-loop'),
                                nav = el.attr('data-gfort-owl-slider-arrows'),
                                arrowLeft,
                                arrowRight,
                                autoplay = el.attr('data-gfort-owl-slider-autoplay'),
                                rtl = false,
                                rtlAttr = el.attr('data-gfort-page-direction'),
                                itemsXL = parseInt(el.attr('data-gfort-owl-slider-items-xl'), 10),
                                itemsLG = parseInt(el.attr('data-gfort-owl-slider-items-lg'), 10),
                                itemsMD = parseInt(el.attr('data-gfort-owl-slider-items-md'), 10),
                                itemsSM = parseInt(el.attr('data-gfort-owl-slider-items-sm'), 10),
                                itemsXS = parseInt(el.attr('data-gfort-owl-slider-items-xs'), 10);

                            instaSlider.attr('data-gfort-owl-slider-arrows', el.attr('data-gfort-owl-slider-arrows'));
                            instaSlider.attr('data-gfort-owl-slider-arrows-layout', el.attr('data-gfort-owl-slider-arrows-layout'));
                            instaSlider.attr('data-gfort-owl-slider-arrows-position', el.attr('data-gfort-owl-slider-arrows-position'));

                            /* Margin
                            --------------------------------------------------------- */
                            margin = (!margin)
                                ? 0
                                : margin;

                            /* Loop
                            --------------------------------------------------------- */
                            if (loop === 'yes') {
                                loop = true;
                            } else {
                                loop = false;
                            }

                            /* Arrows
                            --------------------------------------------------------- */
                            if (nav === 'yes') {
                                nav = true;
                            } else {
                                nav = false;
                            }

                            if (rtlAttr === 'rtl') {
                                rtl = true;
                                arrowLeft = '<span class="screen-reader-text">Right</span><i class="fas fa-chevron-right"></i>';
                                arrowRight = '<span class="screen-reader-text">Left</span><i class="fas fa-chevron-left"></i>';
                            } else {
                                arrowLeft = '<span class="screen-reader-text">Left</span><i class="fas fa-chevron-left"></i>';
                                arrowRight = '<span class="screen-reader-text">Right</span><i class="fas fa-chevron-right"></i>';
                            }

                            /* Autoplay
                            --------------------------------------------------------- */
                            if (autoplay === 'yes') {
                                autoplay = true;
                            } else {
                                autoplay = false;
                            }

                            /* Items
                            --------------------------------------------------------- */
                            itemsXL = (!itemsXL)
                                ? 1
                                : itemsXL;

                            itemsLG = (!itemsLG)
                                ? 1
                                : itemsLG;

                            itemsMD = (!itemsMD)
                                ? 1
                                : itemsMD;

                            itemsSM = (!itemsSM)
                                ? 1
                                : itemsSM;

                            itemsXS = (!itemsXS)
                                ? 1
                                : itemsXS;

                            /* init
                            --------------------------------------------------------- */
                            instaSlider.owlCarousel({
                                navSpeed: 600,
                                dotsSpeed: 600,
                                lazyLoad: true,
                                responsiveClass: true,
                                loop: loop,
                                autoplay: autoplay,
                                autoplaySpeed: 600,
                                autoplayHoverPause: true,
                                margin: margin,
                                autoHeight: true,
                                rtl: rtl,
                                dots: false,
                                nav: nav,
                                navText: [arrowLeft, arrowRight],
                                responsive: {
                                    '0': {items: parseInt(itemsXS, 10)},       // Mobile Portrait      < 576px
                                    '576': {items: parseInt(itemsSM, 10)},     // Mobile Landscape     >= 576px
                                    '768': {items: parseInt(itemsMD, 10)},     // Tablet Portrait      >= 768px
                                    '992': {items: parseInt(itemsLG, 10)},     // Tablet Landscape     >= 992px
                                    '1200': {items: parseInt(itemsXL, 10)}     // Desktop              >= 1200px
                                },
                                onInitialized: function () {
                                    clearTimeout(instaSliderTimer);
                                }
                            });

                            /* Keyboard navigation
                            --------------------------------------------------------- */
                            el.find('.gfort-instagram-owl-slider').on({
                                mouseenter: function () {
                                    el.find('.gfort-instagram-owl-slider').attr('data-gfort-owl-slider-mouse-enter', 'true');
                                },
                                mouseleave: function () {
                                    el.find('.gfort-instagram-owl-slider').attr('data-gfort-owl-slider-mouse-enter', 'false');
                                }
                            });

                            $(document).keyup(function (i) {
                                if (i.keyCode === 37) {
                                    if (el.find('.gfort-instagram-owl-slider').attr('data-gfort-owl-slider-mouse-enter') === 'true') {
                                        el.find('.gfort-instagram-owl-slider').trigger('prev.owl.carousel');
                                    }
                                } else if (i.keyCode === 39) {
                                    if (el.find('.gfort-instagram-owl-slider').attr('data-gfort-owl-slider-mouse-enter') === 'true') {
                                        el.find('.gfort-instagram-owl-slider').trigger('next.owl.carousel');
                                    }
                                }
                            });

                        });

                    }, 600);

                }

            }

        });

    };

}($));