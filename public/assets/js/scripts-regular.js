/*global jQuery, requirejs, gfortPace, window, grecaptcha, google*/
(function ($) {


    'use strict';


    var GRAPHICFORT = {},
        // Page fade effect true OR false
        pageFadeEffect = false,
        // Current Page true OR false
        currentPage = true,
        // copyright current year true OR false
        currentYear = true,
        instagramUserID = 'Instagram user id',
        instagramAccessToken = 'Instagram access token',
        mailchimpFormURL = 'Mailchimp form URL',
        reCaptchaSitekey = 'reCaptcha sitekey',
        gmapAPIKey = 'Google map API key',
        currentPageFileName,
        isMobile,
        scrollBarDiv,
        scrollBarWidth,
        pageCurrentPosition,
        mobileContainerClass,
        headerSectionSubMenuTimer,
        headerSectionMegaMenuTimer,
        headerSectionSearchFormTimer,
        headerSectionPerfectScrollbarTimer,
        notificationsTimer,
        rules = {
            form_name: 'required',
            form_email: {
                required: true,
                email: true
            },
            form_subject: 'required',
            form_message: 'required',
            form_comment: 'required',
            form_bmi_weight: {
                required: true,
                number: true,
                minlength: 1,
                maxlength: 5
            },
            form_bmi_height: {
                required: true,
                number: true,
                minlength: 1,
                maxlength: 5
            },
            form_select: 'required',
            form_phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            form_choose_car: 'required',
            form_pickup_location: 'required',
            form_dropoff_location: 'required',
            form_pickup_date: {
                required: true,
                date: true
            },
            form_dropoff_date: {
                required: true,
                date: true
            }
        },
        messages = {
            form_name: 'Your name is required.',
            form_email: {
                required: 'Your email address is required.',
                email: 'Please enter a valid email address.'
            },
            form_subject: 'Your subject is required.',
            form_message: 'Don\'t you want to say something?.',
            form_comment: 'Don\'t you want to say something?.',
            form_bmi_weight: {
                required: 'This field is required.',
                min: 'Please enter a valid number.',
                minlength: 'Please enter a valid number.',
                maxlength: 'Please enter a valid number.'
            },
            form_bmi_height: {
                required: 'This field is required.',
                min: 'Please enter a valid number.',
                minlength: 'Please enter a valid number.',
                maxlength: 'Please enter a valid number.'
            },
            form_select: {
                required: 'This field is required.'
            },
            form_phone: {
                required: 'Please provide a phone number.',
                digits: 'Please enter digits only',
                minlength: 'Phone number must be 10 digits.',
                maxlength: 'Phone number must be 10 digits.'
            },
            form_choose_car: {
                required: 'Please select a car.'
            },
            form_pickup_location: {
                required: 'Please select pickup location.'
            },
            form_dropoff_location: {
                required: 'Please select dropoff location.'
            },
            form_pickup_date: {
                required: 'Please select pickup date.'
            },
            form_dropoff_date: {
                required: 'Please select dropoff date.'
            }
        };


    /* =========================================================================
    Mobile
    ========================================================================= */
    isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera\ Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };


    /* =========================================================================
    Scroll bar
    ========================================================================= */
    scrollBarDiv = document.createElement('div');
    scrollBarDiv.className = 'scrollbar-div';
    document.body.appendChild(scrollBarDiv);
    scrollBarWidth = scrollBarDiv.offsetWidth - scrollBarDiv.clientWidth;
    document.body.removeChild(scrollBarDiv);


    /* =========================================================================
    Bootsrtap
    ========================================================================= */
    GRAPHICFORT.bootstrapfn = {
        // init
        init: function () {

            // Tooltip
            if ($().tooltip) {

                $('body').tooltip({
                    container: 'body',
                    trigger: 'hover',
                    selector: '[data-toggle="tooltip"]'
                });

            }

            // Scrollspy
            if ($().scrollspy) {

                var offset = 0;

                if ($('.gfort-section-header').hasClass('gfort-section-header-fixed')) {
                    offset = parseInt($('.gfort-section-header-fixed').height() + 2, 10);
                }

                $('body').scrollspy({
                    target: '.gfort-navbar',
                    offset: offset
                });

            }

        }
    };


    /* =========================================================================
    Page fade effect
    ========================================================================= */
    GRAPHICFORT.pageFadeEffectfn = {
        // init
        init: function () {

            if ($().animsition) {

                $('#gfort-main-container').animsition({
                    inClass: 'gfort-fade-in',
                    outClass: 'gfort-fade-out',
                    inDuration: 1500,
                    outDuration: 800,
                    loading: false,
                    linkElement: 'a:not([target="_blank"]):not([href^="#"])'
                });

            }

        }
    };


    /* =========================================================================
    Page PreLoader
    ========================================================================= */
    GRAPHICFORT.pagePreLoaderfn = {
        // init
        init: function () {

            var layout = parseInt($('#gfort-page-preloader').attr('data-gfort-preloader-layout'), 10);

            layout = (!layout)
                ? 1
                : layout;

            $('body').addClass('page-preloader-layout-' + layout);

        }
    };


    /* =========================================================================
    Header
    ========================================================================= */
    GRAPHICFORT.headerSectionfn = {
        // init
        init: function () {

            // Sub menu parent class
            $('.gfort-navbar-nav').find('ul').parent('li').addClass('menu-item-has-children');

            // Toggler button
            $('body').on('click', '.gfort-navbar-toggler', function () {
                $(this).toggleClass('toggle');
            });

            // helper for the accordion simulation
            $('.gfort-navbar-nav .menu-item-has-children').on({
                click: function () {
                    $(this).addClass('gfort-collapse-menu-open-close');
                },
                mouseleave: function () {
                    $(this).removeClass('gfort-collapse-menu-open-close');
                }
            });
            $('body').on('click', '.gfort-btn-collapse-menu > a', function (e) {

                var el = $(this);

                // check if the submenu is opened / closed
                if (!el.hasClass('menu-opened')) {

                    if (el.parent('li').hasClass('megamenu-without-title')) {
                        el.next('ul').find('ul').slideDown();
                    }
                    el.next('ul').slideDown();

                    el.addClass('menu-opened');

                    // accordion simulation
                    $('.gfort-navbar-nav .menu-item-has-children').each(function () {
                        if (!$(this).hasClass('gfort-collapse-menu-open-close')) {
                            $('> a', this).removeClass('menu-opened');
                            $('> ul', this).slideUp();
                        }
                    });

                } else {

                    if (el.attr('href') === '#') {
                        e.preventDefault();
                    }

                    el.removeClass('menu-opened');

                    el.next('ul').slideUp();
                    el.next('ul').find('ul').slideUp();

                }

                if (el.hasClass('menu-opened')) {
                    return false;
                }

            });

        },
        // Mobile menu
        mobileMenu: function () {

            mobileContainerClass = $('.gfort-navbar > .container').attr('class');
            $('.gfort-navbar-collapse-desktop-menu')
                .clone()
                .attr({class: mobileContainerClass})
                .appendTo($('.gfort-navbar-collapse-mobile-menu'));

        },
        // Collapse Menu
        collapseMenu: function () {

            $('.gfort-navbar-collapse-mobile-menu .gfort-navbar-nav .menu-item-has-children').each(function () {
                $(this).addClass('gfort-btn-collapse-menu');
            });

        },
        // Sub menu
        subMenu: function () {

            clearTimeout(headerSectionSubMenuTimer);
            $('.gfort-navbar-collapse-desktop-menu .gfort-navbar-nav > .menu-item-has-children:not(.megamenu)').each(function () {

                var el = $(this),
                    subMenuChildren,
                    subMenuChildrenTemp,
                    windowWidth = $(window).width() + scrollBarWidth;

                el.removeClass('submenu-correct-position');

                if (el.children('ul').length) {

                    subMenuChildren = el.children('ul');
                    subMenuChildrenTemp = subMenuChildren;

                    while (subMenuChildrenTemp.length) {
                        subMenuChildren = subMenuChildrenTemp;
                        subMenuChildrenTemp = subMenuChildrenTemp.children('li').children('ul');
                    }

                    if (subMenuChildren.offset().left < 0) {
                        el.addClass('submenu-correct-position');
                    }

                    if (windowWidth < (parseInt((subMenuChildren.width() + subMenuChildren.offset().left), 10))) {
                        el.addClass('submenu-correct-position');
                    } else {
                        el.removeClass('submenu-correct-position');
                    }

                }

            });

        },
        // Mega menu
        megaMenu: function () {

            clearTimeout(headerSectionMegaMenuTimer);
            $('.gfort-navbar-collapse-desktop-menu .gfort-navbar-nav > .megamenu-col-2').each(function () {

                var el = $(this),
                    megaMenuChild = $('> ul', el),
                    windowWidth = $(window).width() + scrollBarWidth;

                el.removeClass('megamenu-correct-position');

                if (megaMenuChild.length) {

                    if (megaMenuChild.offset().left < 0) {
                        el.addClass('megamenu-correct-position');
                    }

                    if (windowWidth < (parseInt((megaMenuChild.width() + megaMenuChild.offset().left), 10))) {
                        el.addClass('megamenu-correct-position');
                    } else {
                        el.removeClass('megamenu-correct-position');
                    }

                }

            });

        },
        // Search form
        searchForm: function () {

            // open search form
            $('.gfort-nav-link-search-btn-open').on('click', function () {
                $('.gfort-section-header-menu').addClass('gfort-form-block-header-search-open');
                headerSectionSearchFormTimer = setTimeout(function () {
                    $('.gfort-form-block-header-search-desktop input').focus();
                }, 100);
                return false;
            });

            // Close search form
            $('.gfort-nav-link-search-btn-close').on('click', function () {
                GRAPHICFORT.headerSectionfn.closeSearchFform();
                return false;
            });

            // Focus out
            $('.gfort-form-block-header-search-desktop input').on('focusout', function () {
                GRAPHICFORT.headerSectionfn.closeSearchFform();
            });

        },
        closeSearchFform: function () {
            clearTimeout(headerSectionSearchFormTimer);
            $('.gfort-form-block-header-search-open').removeClass('gfort-form-block-header-search-open');
        },
        // Fixed header
        fixedHeader: function (pageCurrentPosition) {
            if (!isMobile.any()) {

                var el = $('.gfort-section-header-fixed .gfort-section-header-menu-container'),
                    height = el.height(),
                    parent = $('.gfort-section-header-menu'),
                    offset = parent.offset().top;

                if (parseInt(pageCurrentPosition, 10) > parseInt(offset, 10)) {
                    el.addClass('gfort-section-header-menu-stuck');
                    parent.css({height: height});
                } else {
                    el.removeClass('gfort-section-header-menu-stuck');
                    parent.css({height: 'auto'});
                }

            }
        },
        // Middle section
        middleSection: function () {

            $('.gfort-section-header-middle .container')
                .addClass($('.gfort-section-header-menu .gfort-navbar .container').attr('class').replace('container', ''))
                .addClass($('.gfort-section-header-menu .gfort-navbar').attr('class').replace('gfort-navbar', ''));

        },
        // Perfect scrollbar
        perfectScrollbar: function () {

            try {

                $('#gfort-section-header-off-canvas-menu-container').perfectScrollbar();

                // update scrollbar (calculate new hight)
                $('body').on('click', '#gfort-section-header-off-canvas-menu-container .menu-item-has-children > a', function () {
                    headerSectionPerfectScrollbarTimer = setTimeout(function () {
                        $('#gfort-section-header-off-canvas-menu-container').perfectScrollbar('update');
                    }, 400);
                });
                $('#gfort-section-header-off-canvas-menu-container').on('mouseleave', function () {
                    clearTimeout(headerSectionPerfectScrollbarTimer);
                });

            } catch (error) {

                if (error.toString().indexOf('PerfectScrollbar')) {
                    return false;
                }

            }

            // open / close menu
            $('.gfort-navbar-toggler').on('click', function () {

                $('body').toggleClass('gfort-navbar-toggler-off-canvas-menu-open');

                // Fix for translate fixed element
                if ($('.gfort-section-header-fixed').length) {
                    pageCurrentPosition = $(window).scrollTop();
                    $('.gfort-section-header-fixed').css({transform: 'translateY(' + pageCurrentPosition + 'px)'});
                }

            });
            $('.gfort-section-header-off-canvas-menu-overlay').on('click', function () {
                $('body').removeClass('gfort-navbar-toggler-off-canvas-menu-open');
                $('.gfort-navbar-toggler').removeClass('toggle');
            });

            // stop body from scroll
            $('.gfort-section-header-off-canvas-menu').on('scroll touchmove mousewheel', function (e) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            });

        },
        // Transparent
        transparent: function () {

            var gfortPaddingTop = 0;

            if ($('[data-gfort-section-padding]').length) {
                gfortPaddingTop = parseInt($('[data-gfort-section-padding]').attr('data-gfort-section-padding'), 10);
            }

            if ($(window).width() + scrollBarWidth >= 1200) {

                $('.gfort-section-breadcrumb').css({paddingTop: $('.gfort-section-header').outerHeight(true)});
                $('[data-gfort-section-padding]').css({paddingTop: gfortPaddingTop + $('.gfort-section-header').outerHeight(true)});

            } else {

                $('.gfort-section-breadcrumb').css({paddingTop: 0});
                $('[data-gfort-section-padding]').css({paddingTop: gfortPaddingTop});

            }

        }
    };


    /* =========================================================================
    fitVids
    ========================================================================= */
    GRAPHICFORT.fitVidsfn = {
        // init
        init: function () {

            if ($().fitVids) {

                $('body').fitVids({
                    customSelector: 'iframe[src*="soundcloud.com"], iframe[src*="videopress.com"], iframe[src*="player.twitch.tv"], iframe[src*="maps.google.com"], iframe[src*="google.com/maps"], iframe[src*="dailymotion.com"]'
                });

            }

        }
    };


    /* =========================================================================
    mediaElementPlayer
    ========================================================================= */
    GRAPHICFORT.mediaElementPlayerfn = {
        // init
        init: function () {

            if ($().mediaelementplayer) {

                $('video, audio').each(function () {
                    $(this).mediaelementplayer({stretching: 'responsive'});
                });

            }

        }
    };


    /* =========================================================================
    Mailchimp
    ========================================================================= */
    GRAPHICFORT.mailchimpfn = {
        // init
        init: function () {

            $('.gfort-form-block-mailchimp').each(function () {
                $('form', this).attr('action', mailchimpFormURL.replace('/post?', '/post-json?').concat('&c=?'));
            });

            $('body').on('submit', '.gfort-form-block-mailchimp form', function () {

                var form = $(this),
                    button = form.find('button'),
                    formURL = form.attr('action'),
                    formData = form.serialize();

                form.find('.gfort-form-message').remove();

                $.ajax({
                    type: 'POST',
                    url: formURL,
                    data: formData,
                    dataType: 'jsonp',
                    cache: true,
                    beforeSend: function () {
                        button.addClass('show-spinner').attr('disabled', '');
                    },
                    success: function (response) {

                        if (response.result === 'error') {

                            form.append('<div class="gfort-form-message col-lg-12"><div class="alert gfort-alert gfort-alert-danger">' + response.msg + '</div></div>');

                            form.find('input[type="email"]').addClass('error');

                        } else {

                            form.append('<div class="gfort-form-message col-lg-12"><div class="alert gfort-alert gfort-alert-success">' + response.msg + '</div></div>');

                            form.find('input').each(function () {
                                $(this).val('');
                            });

                            form.find('input[type="email"]').removeClass('error');

                        }

                        button.removeClass('show-spinner').removeAttr('disabled');

                    }
                });

                return false;

            });

        }
    };


    /* =========================================================================
    Instagram feed
    ========================================================================= */
    GRAPHICFORT.instagramfn = {
        // init
        init: function () {

            if ($().gfortInsta) {

                $('.gfort-instagram-feed-block').each(function () {

                    var el = $(this),
                        count = parseInt(el.attr('data-gfort-instagram-images-count'), 10),
                        imagesSize = el.attr('data-gfort-instagram-images-size'),
                        userID = instagramUserID,
                        accessToken = instagramAccessToken,
                        linkClass = el.attr('data-gfort-instagram-link-class'),
                        showText = el.attr('data-gfort-instagram-show-text'),
                        text = el.attr('data-gfort-instagram-text'),
                        gridGutter = parseInt(el.attr('data-gfort-instagram-columns-gutter'), 10),
                        colXL = el.attr('data-gfort-instagram-xl-column-class'),
                        colLG = el.attr('data-gfort-instagram-lg-column-class'),
                        colMD = el.attr('data-gfort-instagram-md-column-class'),
                        colSM = el.attr('data-gfort-instagram-sm-column-class'),
                        colXS = el.attr('data-gfort-instagram-xs-column-class'),
                        slider = el.attr('data-gfort-instagram-slider');

                    /* Gutter
                    --------------------------------------------------------- */
                    gridGutter = (!gridGutter)
                        ? 0
                        : gridGutter;

                    if (!(gridGutter === 0 || gridGutter === 2 || gridGutter === 6 || gridGutter === 12 || gridGutter === 18 || gridGutter === 36)) {
                        gridGutter = 0;
                    }

                    /* Count
                    --------------------------------------------------------- */
                    count = (!count)
                        ? 1
                        : count;

                    /* Slider
                    --------------------------------------------------------- */
                    if (slider === 'yes') {
                        slider = true;
                    } else {
                        slider = false;
                    }

                    el.gfortInsta({
                        count: count,
                        imagesSize: imagesSize,
                        userID: userID,
                        accessToken: accessToken,
                        linkClass: linkClass,
                        showText: showText,
                        text: text,
                        gridGutter: 'gfort-grid-gutter-' + gridGutter,
                        colXL: colXL,
                        colLG: colLG,
                        colMD: colMD,
                        colSM: colSM,
                        colXS: colXS,
                        slider: slider
                    });

                });

            }

        }
    };


    /* =========================================================================
    Twitter feed
    ========================================================================= */
    GRAPHICFORT.twitterfn = {
        // init
        init: function () {

            if ($().tweetie) {

                $('.gfort-twitter-feed-block').each(function () {

                    var el = $(this),
                        count = parseInt(el.attr('data-gfort-twitter-tweets-count'), 10),
                        screen_name = el.attr('data-gfort-twitter-screen-name'),
                        slider = el.attr('data-gfort-twitter-slider'),
                        colXL = el.attr('data-gfort-twitter-xl-column-class'),
                        colLG = el.attr('data-gfort-twitter-lg-column-class'),
                        colMD = el.attr('data-gfort-twitter-md-column-class'),
                        colSM = el.attr('data-gfort-twitter-sm-column-class'),
                        colXS = el.attr('data-gfort-twitter-xs-column-class'),
                        itemClass = '',
                        template = '';

                    /* Slider
                    --------------------------------------------------------- */
                    if (slider === 'yes') {
                        itemClass = 'gfort-owl-slider-item';
                    }

                    /* Template
                    --------------------------------------------------------- */
                    if (slider !== 'yes' && el.hasClass('gfort-twitter-feed-layout-3')) {
                        template += '<div class="' + colXL + ' ' + colLG + ' ' + colMD + ' ' + colSM + ' ' + colXS + '">';
                    }

                    template += '<div class="gfort-block gfort-twitter-feed-item ' + itemClass + '">';
                    template += '<div class="gfort-block-container gfort-twitter-feed-item-container">';

                    if (!(slider === 'yes' && el.hasClass('gfort-twitter-feed-layout-1')) && !el.hasClass('gfort-twitter-feed-layout-2')) {
                        template += '<div class="gfort-block-head gfort-twitter-feed-item-head">';
                        template += '<div class="gfort-twitter-feed-user-avatar"><a href="https://twitter.com/{{tweet.user.screen_name}}/" target="_blank" rel="noopener"><img src="{{tweet.user.profile_image_url_https}}" alt="{{tweet.user.screen_name}}" /></a></div>';
                        template += '<div class="gfort-twitter-feed-user-info"><h6 class="gfort-twitter-feed-user-name"><a href="https://twitter.com/{{tweet.user.screen_name}}/" target="_blank" rel="noopener">{{tweet.user.name}}</a><a title="{{tweet.user.name}}" class="twitter-bird" href="https://twitter.com/{{tweet.user.screen_name}}/" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></h6><h6 class="gfort-twitter-feed-screen-name font-size-13"><a href="https://twitter.com/{{tweet.user.screen_name}}/" target="_blank" rel="noopener">&commat;{{tweet.user.screen_name}}</a></h6></div>';
                        template += '</div>';
                    }

                    if (slider === 'yes' && el.hasClass('gfort-twitter-feed-layout-1')) {
                        template += '<div class="gfort-block-head gfort-twitter-feed-item-head">';
                        template += '<div class="gfort-twitter-feed-user-info"><h6 class="gfort-twitter-feed-user-name"><a title="{{tweet.user.name}}" class="twitter-bird" href="https://twitter.com/{{tweet.user.screen_name}}/" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></h6></div>';
                        template += '</div>';
                    }

                    template += '<div class="gfort-block-body gfort-twitter-feed-item-body">';

                    template += '<div class="gfort-block-content"><p>';
                    if (el.hasClass('gfort-twitter-feed-layout-2')) {
                        template += '<a title="{{tweet.user.name}}" class="twitter-bird" href="https://twitter.com/{{tweet.user.screen_name}}/" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a> ';
                    }
                    template += '{{tweet.text}}</p></div>';

                    template += '<div class="gfort-block-footer gfort-twitter-feed-item-footer font-size-13 secondary-font-family">';
                    template += '<div class="gfort-twitter-feed-item-date"><a href="https://twitter.com/{{tweet.user.screen_name}}/status/{{tweet.id_str}}" target="_blank" rel="noopener">{{tweet.created_at}}</a></div>';

                    if (!(slider === 'yes' && el.hasClass('gfort-twitter-feed-layout-1'))) {
                        template += '<div class="gfort-twitter-feed-item-action-buttons">';
                        template += '<a class="gfort-twitter-feed-item-action-buttons-reply" href="https://twitter.com/intent/tweet?in_reply_to={{tweet.id_str}}" target="_blank" rel="noopener" title="Reply" data-toggle="tooltip" data-original-title="Reply"><i class="far fa-comment-alt"></i></a>';
                        template += '<a class="gfort-twitter-feed-item-action-buttons-retweet" href="https://twitter.com/intent/retweet?tweet_id={{tweet.id_str}}" target="_blank" rel="noopener" title="Retweet" data-toggle="tooltip" data-original-title="Retweet"><i class="fas fa-retweet"></i></a>';
                        template += '<a class="gfort-twitter-feed-item-action-buttons-favorite" href="https://twitter.com/intent/favorite?tweet_id={{tweet.id_str}}" target="_blank" rel="noopener" title="Like" data-toggle="tooltip" data-original-title="Like"><i class="far fa-heart"></i></a>';
                        template += '</div>';
                    }
                    template += '</div>'; //end footer
                    template += '</div>'; //end body

                    template += '</div>'; //end container
                    template += '</div>'; //end wrapper

                    if (slider !== 'yes' && el.hasClass('gfort-twitter-feed-layout-3')) {
                        template += '</div>';
                    }

                    /* Count
                    --------------------------------------------------------- */
                    count = (!count)
                        ? 1
                        : count;

                    /* Tweetie init
                    --------------------------------------------------------- */
                    el.tweetie({
                        url: 'assets/js/plugins/tweetie/api/server.php',
                        type: 'timeline',
                        dateFormat: '%b %d, %Y',
                        params: {
                            count: count,
                            screen_name: screen_name
                        },
                        template: template
                    }, function () {

                        /* Slider
                        ----------------------------------------------------- */
                        if (slider === 'yes') {

                            el.addClass('gfort-owl-slider owl-carousel');

                            GRAPHICFORT.owlSliderfn.init();

                        }

                        /* Layout 2
                        ----------------------------------------------------- */
                        if (slider !== 'yes' && el.hasClass('gfort-twitter-feed-layout-3')) {
                            el.wrapInner('<div class="row"></div>');
                        }

                    });

                });

            }

        }
    };


    /* =========================================================================
    Fancybox
    ========================================================================= */
    GRAPHICFORT.fancyboxfn = {
        // init
        init: function () {

            $('[data-gfort-lightbox]').each(function () {

                var el = $(this);

                if (el.attr('href').indexOf('soundcloud.com') > -1) {

                    $.ajax({
                        type: 'GET',
                        url: 'https://soundcloud.com/oembed?url=' + el.attr('href') + '&format=json',
                        cache: true
                    }).done(function (response) {
                        el.attr('href', response.html.split('src="')[1].split('">')[0] + '&auto_play=true');
                    });

                }

            });

            if ($().fancybox) {

                $('body').on('click', '[data-gfort-lightbox]', function () {

                    var el = $(this),
                        arrowLeft,
                        arrowRight,
                        numberOfImages,
                        imageObject = {},
                        imageLink = el.attr('href'),
                        imagesArray = [],
                        gallery,
                        type = el.attr('data-gfort-lightbox-type');
                    // Arrows
                    arrowLeft = '<span class="screen-reader-text">Left</span><i class="fas fa-chevron-left"></i>';
                    arrowRight = '<span class="screen-reader-text">Right</span><i class="fas fa-chevron-right"></i>';

                    // Type
                    if (!type) {
                        type = '';
                    }

                    // init
                    if (el.attr('data-gfort-lightbox') === '') {

                        // Single image

                        numberOfImages = 0;

                        imageObject = {
                            src: imageLink,
                            opts: {
                                caption: el.attr('data-gfort-lightbox-caption'),
                                thumb: el.attr('data-gfort-lightbox-thumb')
                            }
                        };

                        imagesArray.push(imageObject);

                    } else {

                        // Gallery

                        numberOfImages = el.index('[data-gfort-lightbox="' + el.attr('data-gfort-lightbox') + '"]');

                        $('[data-gfort-lightbox="' + el.attr('data-gfort-lightbox') + '"]').each(function () {

                            gallery = $(this);
                            imageLink = gallery.attr('href');

                            imageObject = {
                                src: imageLink,
                                opts: {
                                    caption: gallery.attr('data-gfort-lightbox-caption'),
                                    thumb: gallery.attr('data-gfort-lightbox-thumb')
                                }
                            };

                            imagesArray.push(imageObject);

                        });

                    }

                    // open
                    $.fancybox.open(
                        imagesArray,
                        {
                            loop: false,
                            arrows: true,
                            infobar: true,
                            margin: [48, 0],
                            buttons: [
                                'slideShow',
                                'fullScreen',
                                'thumbs',
                                'close'
                            ],
                            thumbs: {
                                autoStart: false,
                                hideOnClose: true
                            },
                            slideShow: {
                                autoStart: false,
                                speed: 4000
                            },
                            iframe: {
                                preload: false
                            },
                            smallBtn: false,
                            autoFocus: false,
                            backFocus: false,
                            transitionEffect: 'slide',
                            animationEffect: 'zoom-in-out',
                            baseClass: 'gfort-lightbox-wrapper',
                            btnTpl: {
                                arrowLeft: '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' + arrowLeft + '</button>',
                                arrowRight: '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' + arrowRight + '</button>'
                            },
                            onInit: function () {

                                // Fix for jumping fixed elements
                                $('#gfort-btn-back-to-top').addClass('gfort-no-transition');
                                $('.gfort-section-header-menu-stuck').addClass('gfort-no-transition');

                                $('#gfort-btn-back-to-top').css({marginRight: scrollBarWidth});
                                $('.gfort-section-header-menu-stuck').css({paddingRight: scrollBarWidth});
                                $('.gfort-page-boxed .gfort-section-header-menu-stuck').css({
                                    paddingRight: 0,
                                    right: scrollBarWidth
                                });

                            },
                            afterShow: function () {

                                // Video
                                if ($('.fancybox-slide video').length) {
                                    $('.fancybox-slide video').each(function () {
                                        $(this).mediaelementplayer({stretching: 'responsive'});
                                    });
                                }

                            },
                            afterClose: function () {

                                $('#gfort-btn-back-to-top').css({marginRight: 0});
                                $('.gfort-section-header-menu-stuck').css({paddingRight: 0});
                                $('.gfort-page-boxed .gfort-section-header-menu-stuck').css({
                                    paddingRight: 0,
                                    right: 0
                                });

                            }
                        },
                        numberOfImages
                    );

                    imagesArray = [];
                    imageObject = {};

                    return false;

                });

            }

        }
    };


    /* =========================================================================
    Share buttons
    ========================================================================= */
    GRAPHICFORT.shareButtonfn = {
        // init
        init: function () {

            var url = $(location).attr('href'),
                title = $(document).attr('title');

            // Buttons href
            $('.gfort-share-facebook a').attr('href', 'https://www.facebook.com/sharer.php?u=' + url);
            $('.gfort-share-twitter a').attr('href', 'https://twitter.com/intent/tweet?text=' + title + '&amp;url=' + url);
            $('.gfort-share-linkedin a').attr('href', 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' + url + '&amp;title=' + title);
            $('.gfort-share-tumblr a').attr('href', 'https://www.tumblr.com/share/link?url=' + url + '&amp;name=' + title);
            $('.gfort-share-reddit a').attr('href', 'https://reddit.com/submit?url=' + url + '&amp;title=' + title);
            $('.gfort-share-vk a').attr('href', 'https://vk.com/share.php?url=' + url);
            $('.gfort-share-pocket a').attr('href', 'https://getpocket.com/save?title=' + title + '&amp;url=' + url);
            $('.gfort-share-stumbleupon a').attr('href', 'https://www.stumbleupon.com/submit?url=' + url + '&amp;title=' + title);

            // open share pop up window
            $('body').on('click', '.gfort-btn-share a', function () {
                window.open($(this).attr('href'), 'popupWindow', 'width=600, height=600, scrollbars=yes');
            });

        }
    };


    /* =========================================================================
    OWL slider
    ========================================================================= */
    GRAPHICFORT.owlSliderfn = {
        // init
        init: function () {

            if ($().owlCarousel) {

                $('.gfort-owl-slider').each(function () {

                    var el = $(this),
                        margin = parseInt(el.attr('data-gfort-owl-slider-items-margin'), 10),
                        loop = el.attr('data-gfort-owl-slider-loop'),
                        center = el.attr('data-gfort-owl-slider-center'),
                        nav = el.attr('data-gfort-owl-slider-arrows'),
                        arrowLeft,
                        arrowRight,
                        dots = el.attr('data-gfort-owl-slider-dots'),
                        autoplay = el.attr('data-gfort-owl-slider-autoplay'),
                        autoHeight = el.attr('data-gfort-owl-slider-auto-height'),
                        rtl = false,
                        rtlAttr = el.attr('data-gfort-page-direction'),
                        itemsXL = parseInt(el.attr('data-gfort-owl-slider-items-xl'), 10),
                        itemsLG = parseInt(el.attr('data-gfort-owl-slider-items-lg'), 10),
                        itemsMD = parseInt(el.attr('data-gfort-owl-slider-items-md'), 10),
                        itemsSM = parseInt(el.attr('data-gfort-owl-slider-items-sm'), 10),
                        itemsXS = parseInt(el.attr('data-gfort-owl-slider-items-xs'), 10),
                        animateIn = el.attr('data-gfort-owl-slider-animateIn'),
                        animateOut = el.attr('data-gfort-owl-slider-animateOut'),
                        mouseDrag = el.attr('data-gfort-owl-slider-mouseDrag'),
                        touchDrag = el.attr('data-gfort-owl-slider-touchDrag'),
                        autoplayHoverPause,
                        thumbnailSliderActiveItem,
                        thumbnailSlider = el.attr('data-gfort-owl-slider-thumbnail');

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

                    /* Center
                    --------------------------------------------------------- */
                    if (center === 'yes') {
                        center = true;
                    } else {
                        center = false;
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

                    /* Dots
                    --------------------------------------------------------- */
                    if (dots === 'yes') {
                        dots = true;
                    } else {
                        dots = false;
                    }

                    /* Autoplay
                    --------------------------------------------------------- */
                    if (autoplay === 'yes') {
                        autoplay = true;
                    } else {
                        autoplay = false;
                    }

                    if (el.parent().hasClass('gfort-section-slider-media')) {
                        autoplayHoverPause = false;
                    } else {
                        autoplayHoverPause = true;
                    }

                    /* Auto height
                    --------------------------------------------------------- */
                    if (autoHeight === 'no') {
                        autoHeight = false;
                    } else {
                        autoHeight = true;
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

                    /* Animation
                    --------------------------------------------------------- */
                    // IN
                    animateIn = (!animateIn)
                        ? ''
                        : animateIn;

                    // OUT
                    animateOut = (!animateOut)
                        ? ''
                        : animateOut;

                    /* Drag
                    --------------------------------------------------------- */
                    // Mouse
                    if (mouseDrag === 'no') {
                        mouseDrag = false;
                    } else {
                        mouseDrag = true;
                    }

                    // Touch
                    if (touchDrag === 'no') {
                        touchDrag = false;
                    } else {
                        touchDrag = true;
                    }

                    /* Thumbnail slider
                    --------------------------------------------------------- */
                    if (thumbnailSlider === 'yes') {

                        el.next('.gfort-owl-slider-thumbnail').find('.gfort-owl-slider-item').each(function (index) {
                            $(this).attr('data-gfort-owl-slider-jump-to', index);
                        });

                        el.next('.gfort-owl-slider-thumbnail').find('[data-gfort-owl-slider-jump-to=0]').addClass('gfort-owl-slider-active-item');

                    }

                    /* init
                    --------------------------------------------------------- */
                    el.on('initialized.owl.carousel', function () {

                        // Auto height
                        if (autoHeight === false) {

                            var minHeight = 0;

                            el.find('.owl-item').each(function () {

                                minHeight = $(this).height() > minHeight
                                    ? $(this).height()
                                    : minHeight;

                            });

                            el.find('.owl-item').css({minHeight: minHeight + 'px'});
                            el.find('.owl-item').css({height: minHeight + 'px'});

                        }

                    });
                    el.owlCarousel({
                        navSpeed: 600,
                        dotsSpeed: 600,
                        lazyLoad: true,
                        responsiveClass: true,
                        loop: loop,
                        autoplaySpeed: 600,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        margin: margin,
                        autoHeight: autoHeight,
                        mouseDrag: mouseDrag,
                        touchDrag: touchDrag,
                        rtl: rtl,
                        dots: dots,
                        nav: nav,
                        center: center,
                        navText: [arrowLeft, arrowRight],
                        animateIn: animateIn,
                        animateOut: animateOut,
                        responsive: {
                            '0': {items: parseInt(itemsXS, 10)},       // Mobile Portrait      < 576px
                            '576': {items: parseInt(itemsSM, 10)},     // Mobile Landscape     >= 576px
                            '768': {items: parseInt(itemsMD, 10)},     // Tablet Portrait      >= 768px
                            '992': {items: parseInt(itemsLG, 10)},     // Tablet Landscape     >= 992px
                            '1200': {items: parseInt(itemsXL, 10)}     // Desktop              >= 1200px
                        },
                        onTranslate: function (elem) {

                            // Thumbnail Slider
                            if (thumbnailSlider === 'yes') {

                                el.next('.gfort-owl-slider-thumbnail').find('.gfort-owl-slider-active-item').removeClass('gfort-owl-slider-active-item');

                                thumbnailSliderActiveItem = elem.item.index - el.find('.owl-item.cloned').length / 2;
                                if (thumbnailSliderActiveItem === -1) {
                                    thumbnailSliderActiveItem = el.find('.owl-item').length - el.find('.owl-item.cloned').length - 1;
                                } else if (thumbnailSliderActiveItem === elem.item.count) {
                                    thumbnailSliderActiveItem = 0;
                                }

                                el.next('.gfort-owl-slider-thumbnail').trigger('to.owl.carousel', [thumbnailSliderActiveItem, 300, true]);

                                el.next('.gfort-owl-slider-thumbnail').find('[data-gfort-owl-slider-jump-to="' + thumbnailSliderActiveItem + '"]').addClass('gfort-owl-slider-active-item');

                            }

                        },
                        onResized: function () {

                            // Auto height
                            if (autoHeight === false) {

                                var minHeight = 0;

                                el.find('.owl-item').css({minHeight: '0'});
                                el.find('.owl-item').css({height: 'auto'});

                                el.find('.owl-item').each(function () {

                                    minHeight = $(this).height() > minHeight
                                        ? $(this).height()
                                        : minHeight;

                                });

                                el.find('.owl-item').css({minHeight: minHeight + 'px'});
                                el.find('.owl-item').css({height: minHeight + 'px'});

                            }

                        }
                    });

                    /* Keyboard navigation
                    --------------------------------------------------------- */
                    el.on({
                        mouseenter: function () {
                            el.attr('data-gfort-owl-slider-mouse-enter', 'true');
                        },
                        mouseleave: function () {
                            el.attr('data-gfort-owl-slider-mouse-enter', 'false');
                        }
                    });

                    $(document).keyup(function (i) {
                        if (i.keyCode === 37) {
                            if (el.attr('data-gfort-owl-slider-mouse-enter') === 'true') {
                                el.trigger('prev.owl.carousel');
                            }
                        } else if (i.keyCode === 39) {
                            if (el.attr('data-gfort-owl-slider-mouse-enter') === 'true') {
                                el.trigger('next.owl.carousel');
                            }
                        }
                    });

                    /* Jump to Slide
                    --------------------------------------------------------- */
                    $('body').on('click', '[data-gfort-owl-slider-jump-to]', function (e) {

                        e.preventDefault();

                        $(this).parents('.gfort-block-wrapper').find('.gfort-owl-slider-active-item').removeClass('gfort-owl-slider-active-item');

                        $(this).addClass('gfort-owl-slider-active-item');

                        $(this).parents('.gfort-block-wrapper').prev('.gfort-owl-slider').trigger('to.owl.carousel', [$(this).attr('data-gfort-owl-slider-jump-to'), 600, true]);

                    });

                });

            }

        }
    };


    /* =========================================================================
    isotope
    ========================================================================= */
    // Main
    GRAPHICFORT.isotopefn = {
        // init
        init: function () {

            if ($().isotope) {

                $('.gfort-isotope').each(function () {

                    var el = $(this),
                        originLeft = true,
                        originLeftAttr = el.attr('data-gfort-page-direction'),
                        filter = el.attr('data-gfort-filter'),
                        transitionDuration = parseInt(el.attr('data-transition-duration'), 10);

                    transitionDuration = (!transitionDuration && transitionDuration !== 0)
                        ? 0.4
                        : transitionDuration;

                    transitionDuration = transitionDuration + 's';

                    if (originLeftAttr === 'rtl') {
                        originLeft = false;
                    }

                    el.isotope({
                        filter: filter,
                        layoutMode: 'masonry',
                        percentPosition: true,
                        itemSelector: '.gfort-isotope-item',
                        originLeft: originLeft,
                        animationOptions: {
                            queue: false,
                            duration: 850,
                            easing: 'linear'
                        },
                        transitionDuration: transitionDuration
                    });

                });

            }

        }
    };

    // Filter
    GRAPHICFORT.isotopefnFilterfn = {
        // init
        init: function () {

            if ($().isotope) {

                // Filter by link
                $('body').on('click', '.gfort-isotope-filter a', function (e) {

                    e.preventDefault();

                    var el = $(this),
                        parent = el.parents('.gfort-isotope-filter'),
                        attr = el.attr('data-filter'),
                        section = parent.next('.gfort-isotope'),
                        select = $('> .gfort-form-control', parent);

                    if ($(section).length) {

                        parent.find('.active').removeClass('active');
                        el.addClass('active');

                        section.isotope({
                            filter: attr
                        });

                    }

                    if ($(select).length) {
                        select.val(el.attr('data-filter'));
                    }

                });

                // Filter by select
                if ($('.gfort-isotope-filter-select').length) {
                    $('.gfort-isotope-filter').each(function () {

                        var el = $(this),
                            container = $('> .gfort-isotope-filter-container', el),
                            select = '',
                            maxWidth = parseInt(el.attr('data-gfort-isotope-filter-select-width'), 10);

                        if (maxWidth > 0) {
                            maxWidth = 'style="max-width: ' + maxWidth + 'px' + '"';
                        } else {
                            maxWidth = '';
                        }

                        select = '<select class="gfort-form-control secondary-font-family" aria-label="Filter" ' + maxWidth + '>';

                        $('> a', container).each(function () {
                            select += '<option value="' + $(this).attr('data-filter') + '">' + $(this).text() + '</option>';
                        });

                        select += '</select>';

                        el.prepend(select);

                    });
                }
                // select (on change)
                $('body').on('change', '.gfort-isotope-filter-select .gfort-form-control', function () {

                    var el = $(this),
                        parent = el.parents('.gfort-isotope-filter-select'),
                        section = parent.next('.gfort-isotope');

                    parent.find('.active').removeClass('active');
                    parent.find('a[data-filter="' + el.val() + '"]').addClass('active');

                    if ($(section).length) {
                        section.isotope({
                            filter: el.val()
                        });
                    }

                });

            }

        }
    };


    /* =========================================================================
    Google reCaptcha v3
    ========================================================================= */
    GRAPHICFORT.reCaptchafn = {
        // init
        init: function (recaptcha) {

            var recaptchaID = $(recaptcha).attr('id');

            $.ajax({
                type: 'GET',
                url: 'https://www.google.com/recaptcha/api.js?render=' + reCaptchaSitekey,
                dataType: 'script',
                cache: true
            }).done(function () {
                grecaptcha.ready(function () {
                    grecaptcha.execute(reCaptchaSitekey, {action: 'homepage'}).then(function (token) {
                        document.getElementById(recaptchaID).value = token;
                    });
                });
            });

        }
    };


    /* =========================================================================
    Form
    ========================================================================= */
    /* Validation
    ------------------------------------------------------------------------- */
    // Back btn
    GRAPHICFORT.formBackBtnfn = {
        // init
        init: function () {

            $('.gfort-btn-form-back').on('click', function () {

                var el = $(this);

                el.parents('.gfort-form-block-step').css({display: 'none'});
                el.parents('.gfort-form-block-step').prev('.gfort-form-block-step').css({display: 'block'});

                return false;

            });

        }
    };
    // Next btn
    GRAPHICFORT.formNextBtnfn = {
        // init
        init: function () {

            $('.gfort-btn-form-next').on('click', function () {

                var el = $(this),
                    form = el.parents('.gfort-form-block-validation').find('form');

                if ($().validate) {

                    $(form).validate({
                        rules: rules,
                        messages: messages,
                        errorElement: 'span',
                        errorClass: 'gfort-form-error'
                    });

                    if (form.valid() === true) {

                        el.parents('.gfort-form-block-step').css({display: 'none'});
                        el.parents('.gfort-form-block-step').next('.gfort-form-block-step').css({display: 'block'});

                        return false;

                    } else {

                        return false;

                    }

                }

            });

        }
    };

    /* Validation
    ------------------------------------------------------------------------- */
    GRAPHICFORT.formValidationfn = {
        // init
        init: function () {

            $('.gfort-form-block-validation').each(function () {

                var el = $(this),
                    redirect = el.attr('data-gfort-contact-form-redirect-url'),
                    button = el.find('button[type="submit"]'),
                    form = el.find('form'),
                    keyCode;

                if (el.hasClass('gfort-form-block-multi-step')) {
                    $(form).on('keyup keypress', function (e) {

                        keyCode = e.keyCode || e.which;

                        if (keyCode === 13) {
                            e.preventDefault();
                            return false;
                        }

                    });
                }

                if (el.find('.gfort-form-check-must-accept').length) {
                    button.attr('disabled', '');
                }

                if (el.hasClass('gfort-form-block-contact')) {
                    form.prepend('<input type="hidden" class="form_domain" name="form_domain" value="' + document.location.hostname + '">');
                }

                $(button).on('click', function () {
                    form.find('.gfort-form-message').remove();
                });

                if ($().validate) {

                    $(form).validate({
                        rules: rules,
                        messages: messages,
                        errorElement: 'span',
                        errorClass: 'gfort-form-error',
                        submitHandler: function () {

                            form.find('.gfort-form-message').remove();

                            button.addClass('show-spinner').attr('disabled', '');

                            $.ajax({
                                type: 'POST',
                                url: form.attr('action'),
                                data: form.serialize()
                            }).done(function (response) {

                                /* Success Message
                                ------------------------------------------------- */
                                if (response.match('success-message') !== null) {

                                    if (redirect) {

                                        window.location = redirect;

                                    } else {

                                        form.append('<div class="gfort-form-message col-lg-12"><div class="alert gfort-alert gfort-alert-success">' + response + '</div></div>');

                                    }

                                    if (el.hasClass('gfort-form-block-multi-step')) {
                                        button.parents('.gfort-form-block-step').css({display: 'none'});
                                    }

                                    form.find('input').val('');
                                    form.find('.form_domain').val(document.location.hostname);
                                    form.find('textarea').val('');
                                    form.find('input[type="checkbox"]').prop('checked', false);

                                }

                                /* Error Message
                                ------------------------------------------------- */
                                if (response.match('error-message') !== null) {

                                    form.append('<div class="gfort-form-message col-lg-12"><div class="alert gfort-alert gfort-alert-danger">' + response + '</div></div>');

                                }

                                /* reCaptcha
                                ------------------------------------------------- */
                                if (form.find('.g-recaptcha-response').length) {
                                    GRAPHICFORT.reCaptchafn.init($('#' + form.find('.g-recaptcha-response').attr('id')));
                                }

                                button.removeClass('show-spinner').removeAttr('disabled');

                            });

                        }
                    });

                    /* Additional Method to validate email
                    --------------------------------------------------------- */
                    $.validator.methods.email = function (value, element) {
                        return this.optional(element) || (/\S+@\S+\.\S+/).test(value);
                    };

                }

            });

        }
    };

    /* Checkbox accept
    ------------------------------------------------------------------------- */
    GRAPHICFORT.formCheckboxAcceptfn = {
        // init
        init: function () {

            $('.gfort-form-check-must-accept').on('change', function () {

                var el = $(this),
                    form = el.parents('.gfort-form-block'),
                    button = form.find('[type=submit]'),
                    disabledArray = [];

                $(form).find('.gfort-form-check-must-accept').each(function () {

                    if ($(this)[0].checked === false) {
                        disabledArray.push('false');
                    } else {
                        disabledArray.push('true');
                    }

                });

                disabledArray = disabledArray.filter(function (elem, index, self) {
                    return index === self.indexOf(elem);
                });

                if (disabledArray.length > 1) {
                    button.attr('disabled', '');
                } else {
                    if (disabledArray[0] === 'false') {
                        button.attr('disabled', '');
                    } else {
                        button.removeAttr('disabled');
                    }
                }

            });

        }
    };

    /* Min date today
    ------------------------------------------------------------------------- */
    GRAPHICFORT.formMinDateTodayfn = {
        // init
        init: function () {

            $('.gfort-min-date-today').each(function () {

                var el = $(this),
                    date = new Date(),
                    today;

                today = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
                el.attr('min', today);

            });

        }
    };


    /* =========================================================================
    Modal
    ========================================================================= */
    GRAPHICFORT.modalfn = {
        // init
        init: function () {

            // Show
            $('.modal').on('show.bs.modal', function () {

                // Fixed header
                $('.gfort-section-header-menu-stuck').css({paddingRight: scrollBarWidth});
                $('.gfort-page-boxed .gfort-section-header-menu-stuck').css({
                    paddingRight: 0,
                    right: scrollBarWidth
                });
                $('.gfort-section-header-menu-stuck').addClass('gfort-no-transition');

                // iframe
                $(this).find('iframe').each(function () {
                    $(this).attr('data-gfort-temp-src', $(this).attr('src'));
                    $(this).attr('src', $(this).attr('data-gfort-temp-src'));
                });

                // Back to top button
                $('#gfort-btn-back-to-top').addClass('gfort-no-transition');
                $('#gfort-btn-back-to-top').css({marginRight: scrollBarWidth});

            });

            // Hidden
            $('.modal').on('hidden.bs.modal', function () {

                // Fixed header
                $('.gfort-section-header-menu-stuck').css({paddingRight: 0});
                $('.gfort-page-boxed .gfort-section-header-menu-stuck').css({
                    paddingRight: 0,
                    right: 0
                });

                // iframe
                $(this).find('iframe').each(function () {
                    $(this).attr('src', $(this).attr('data-gfort-temp-src'));
                });

                // Mediaelement
                $(this).find('.mejs__container video').each(function () {
                    this.player.pause();
                });
                $(this).find('.mejs__container audio').each(function () {
                    this.player.pause();
                });

                // Back to top button
                $('#gfort-btn-back-to-top').css({marginRight: 0});

            });

        }
    };


    /* =========================================================================
    Notifications
    ========================================================================= */
    // Set / Get cookie
    GRAPHICFORT.cookiefn = {
        // Set
        setCookie: function (cookieName, cookieValue, cookieEXdays) {

            var date = new Date(),
                expires;

            date.setTime(date.getTime() + (cookieEXdays * 24 * 60 * 60 * 1000));
            expires = 'expires=' + date.toGMTString();

            document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";

        },
        // Get
        getCookie: function (cookieName) {

            cookieName = cookieName + '=';

            var decodedCookie = decodeURIComponent(document.cookie),
                cookieArray = decodedCookie.split(';'),
                count,
                cookie;

            for (count = 0; count < cookieArray.length; count += 1) {

                cookie = cookieArray[count];

                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }

            }

            return '0';

        }
    };

    // Main
    GRAPHICFORT.notificationsfn = {
        // init
        init: function () {

            $('.gfort-block-notification').each(function () {

                var el = $(this),
                    cookieName = el.attr('data-gfort-cookie-name');

                cookieName = (!cookieName)
                    ? 'GRAPHICFORT'
                    : cookieName;

                if (GRAPHICFORT.cookiefn.getCookie(cookieName) === '0') {
                    if ($('#gfort-page-preloader').length) {
                        el.addClass('notification-preloader-show');
                    } else {
                        el.addClass('show');
                    }
                }

            });

            // Dismiss
            $('.gfort-notification-dismiss').on('click', function () {

                $('body').removeClass('gfort-block-notification-layout-3-stop-scroll');

                var el = $(this),
                    cookieName = el.parents('.gfort-block-notification').attr('data-gfort-cookie-name'),
                    cookieEXdays = parseInt(el.parents('.gfort-block-notification').attr('data-gfort-cookie-expire'), 10);

                cookieName = (!cookieName)
                    ? 'GRAPHICFORT'
                    : cookieName;

                cookieEXdays = (!cookieEXdays)
                    ? 0
                    : cookieEXdays;

                $(this).parents('.gfort-block-notification').removeClass('show');
                $(this).parents('.gfort-block-notification').removeClass('notification-preloader-show');

                // Set cookie
                GRAPHICFORT.cookiefn.setCookie(cookieName, '1', cookieEXdays);

                // Reset timer
                clearTimeout(notificationsTimer);

            });

        },
        // Perfect scrollbar
        perfectScrollbar: function () {

            if ($('.gfort-block-notification-layout-3').length) {
                $('body').addClass('gfort-block-notification-layout-3-stop-scroll');
            }

            try {

                $('.gfort-block-notification-scrollbar').perfectScrollbar();

            } catch (error) {

                if (error.toString().indexOf('PerfectScrollbar')) {
                    return false;
                }

            }

        }
    };


    /* =========================================================================
    Parallax
    ========================================================================= */
    GRAPHICFORT.parallaxfn = {
        // init
        init: function () {

            $('.gfort-section-parallax').each(function () {
                $(this).parallax('50%', 0.3);
            });

        }
    };


    /* =========================================================================
    Count To
    ========================================================================= */
    GRAPHICFORT.countTofn = {
        // init
        init: function () {

            if ($().countTo) {

                $('[data-gfort-count-to]').each(function () {

                    var el = $(this),
                        from = parseFloat(el.attr('data-gfort-count-from')),
                        to = parseFloat(el.attr('data-gfort-count-to')),
                        speed = parseInt(el.attr('data-gfort-count-speed'), 10),
                        interval = parseFloat(el.attr('data-gfort-count-interval')),
                        decimals = parseInt(el.attr('data-gfort-count-decimals'), 10);

                    // From
                    from = (!from)
                        ? 0
                        : from;

                    if (from === 0) {
                        el.html('0');
                    }

                    // To
                    to = (!to)
                        ? 100
                        : to;

                    // Speed
                    speed = (!speed)
                        ? 1000
                        : speed;

                    // Interval
                    interval = (!interval)
                        ? 50
                        : interval;

                    // Decimals
                    decimals = (!decimals)
                        ? 0
                        : decimals;

                    if ($().appear) {

                        el.appear(function () {
                            el.countTo({
                                from: from,
                                to: to,
                                speed: speed,
                                refreshInterval: interval,
                                decimals: decimals
                            });
                        }, {accX: 0, accY: -108});

                    } else {

                        el.countTo({
                            from: from,
                            to: to,
                            speed: speed,
                            refreshInterval: interval,
                            decimals: decimals
                        });

                    }

                });

            }

        }
    };


    /* =========================================================================
    BG video
    ========================================================================= */
    GRAPHICFORT.bgVideofn = {
        // init
        init: function (element) {

            var el = element,
                parent = el.parent(),
                parentWidth = parseInt(parent.outerWidth(true), 10),
                parentHeight = parseInt(parent.outerHeight(true), 10),
                elWidth,
                elHeight,
                elMarginTop,
                elMarginLeft;

            if (!isMobile.any()) {

                elWidth = parseInt(parentHeight * 16 / 9, 10);
                if (elWidth > parentWidth) {
                    elWidth = parseInt(parentHeight * 16 / 9, 10);
                    elHeight = parseInt(parentHeight, 10);
                    elMarginTop = 0;
                    elMarginLeft = parseInt((parentWidth - elWidth) / 2, 10);
                } else {
                    elWidth = parseInt(parentWidth, 10);
                    elHeight = parseInt(parentWidth * 9 / 16, 10);
                    elMarginTop = parseInt((parentHeight - elHeight) / 2, 10);
                    elMarginLeft = 0;
                }

                el.css({
                    width: elWidth,
                    height: elHeight,
                    marginTop: elMarginTop,
                    marginLeft: elMarginLeft
                });

            }

        }
    };


    /* =========================================================================
    Youtube BG video
    ========================================================================= */
    GRAPHICFORT.youtubeBGVideofn = {
        // init
        init: function () {

            $('.gfort-youtube-bg-video').each(function (index) {

                var el = $(this),
                    url = el.attr('data-gfort-youtube-bg-video-url'),
                    videoID = url.split('?v=')[1],
                    autoplay = el.attr('data-gfort-youtube-bg-video-autoplay'),
                    mute = el.attr('data-gfort-youtube-bg-video-mute'),
                    src;

                if (!isMobile.any()) {

                    /* autoplay
                    --------------------------------------------------------- */
                    if (autoplay === 'no') {
                        autoplay = '&autoplay=0';
                    } else {
                        autoplay = '&autoplay=1';
                    }

                    /* Mute
                    --------------------------------------------------------- */
                    if (mute === 'no') {
                        mute = '&mute=0';
                    } else {
                        mute = '&mute=1';
                    }

                    /* iframe
                    --------------------------------------------------------- */
                    src = 'https://www.youtube.com/embed/' + videoID + '?enablejsapi=1&iv_load_policy=3&enablejsapi=1&disablekb=1&controls=0&widgetid=1&showinfo=0&loop=1&&playlist=' + videoID + '&rel=0' + mute + autoplay;
                    el.append('<iframe src="' + src + '" id="gfort-youtube-iframe-bg-video-' + index + '" class="gfort-youtube-iframe-bg-video"></iframe>');

                    /* Resize iframe
                    --------------------------------------------------------- */
                    GRAPHICFORT.bgVideofn.init(el);

                }

                /* Youtube Play btn (Mobile)
                ------------------------------------------------------------- */
                el.parent('.gfort-section-bg-video').after('<a class="gfort-btn-youtube-bg-video" href="' + url + '" data-gfort-lightbox title="Play"></a>');
                GRAPHICFORT.fancyboxfn.init();

            });

        }
    };


    /* =========================================================================
    Google Map
    ========================================================================= */
    GRAPHICFORT.googleMapfn = {
        // init
        init: function () {

            var maps = [];

            $('.gfort-block-gmap').each(function () {

                var el = $(this),
                    id = el.attr('id'),
                    zoom = parseInt(el.attr('data-gfort-map-zoom'), 10),
                    latitude = parseFloat(el.attr('data-gfort-map-latitude')),
                    longitude = parseFloat(el.attr('data-gfort-map-longitude')),
                    height = el.attr('data-gfort-map-height'),
                    center,
                    options,
                    styles = el.attr('data-gfort-map-style');

                // Responsive
                if (height === 'responsive') {
                    el.wrap('<div class="fluid-width-video-wrapper"></div>');
                } else if (height === 'bg') {
                    el.css({height: el.parent().height()});
                } else {
                    height = parseInt(height, 10);
                    height = (!height)
                        ? 300
                        : height;
                    el.css({height: height});
                }

                zoom = (!zoom)
                    ? 16
                    : zoom;
                zoom = (zoom < 0 || zoom > 22)
                    ? 16
                    : zoom;

                latitude = (!latitude)
                    ? 0
                    : latitude;

                longitude = (!longitude)
                    ? 0
                    : longitude;

                if (styles === 'silver') {

                    styles = [{elementType: "geometry", stylers: [{color: "#f5f5f5"}]}, {elementType: "labels.icon", stylers: [{visibility: "off"}]}, {elementType: "labels.text.fill", stylers: [{color: "#616161"}]}, {elementType: "labels.text.stroke", stylers: [{color: "#f5f5f5"}]}, {featureType: "administrative.land_parcel", elementType: "labels.text.fill", stylers: [{color: "#bdbdbd"}]}, {featureType: "poi", elementType: "geometry", stylers: [{color: "#eeeeee"}]}, {featureType: "poi", elementType: "labels.text.fill", stylers: [{color: "#757575"}]}, {featureType: "poi.park", elementType: "geometry", stylers: [{color: "#e5e5e5"}]}, {featureType: "poi.park", elementType: "labels.text.fill", stylers: [{color: "#9e9e9e"}]}, {featureType: "road", elementType: "geometry", stylers: [{color: "#ffffff"}]}, {featureType: "road.arterial", elementType: "labels.text.fill", stylers: [{color: "#757575"}]}, {featureType: "road.highway", elementType: "geometry", stylers: [{color: "#dadada"}]}, {featureType: "road.highway", elementType: "labels.text.fill", stylers: [{color: "#616161"}]}, {featureType: "road.local", elementType: "labels.text.fill", stylers: [{color: "#9e9e9e"}]}, {featureType: "transit.line", elementType: "geometry", stylers: [{color: "#e5e5e5"}]}, {featureType: "transit.station", elementType: "geometry", stylers: [{color: "#eeeeee"}]}, {featureType: "water", elementType: "geometry", stylers: [{color: "#c9c9c9"}]}, {featureType: "water", elementType: "labels.text.fill", stylers: [{color: "#9e9e9e"}]}];

                } else if (styles === 'retro') {

                    styles = [{elementType: "geometry", stylers: [{color: "#ebe3cd"}]}, {elementType: "labels.icon", stylers: [{visibility: "off"}]}, {elementType: "labels.text.fill", stylers: [{color: "#523735"}]}, {elementType: "labels.text.stroke", stylers: [{color: "#f5f1e6"}]}, {featureType: "administrative", elementType: "geometry.stroke", stylers: [{color: "#c9b2a6"}]}, {featureType: "administrative.land_parcel", elementType: "geometry.stroke", stylers: [{color: "#dcd2be"}]}, {featureType: "administrative.land_parcel", elementType: "labels.text.fill", stylers: [{color: "#ae9e90"}]}, {featureType: "landscape.natural", elementType: "geometry", stylers: [{color: "#dfd2ae"}]}, {featureType: "poi", elementType: "geometry", stylers: [{color: "#dfd2ae"}]}, {featureType: "poi", elementType: "labels.text.fill", stylers: [{color: "#93817c"}]}, {featureType: "poi.park", elementType: "geometry.fill", stylers: [{color: "#a5b076"}]}, {featureType: "poi.park", elementType: "labels.text.fill", stylers: [{color: "#447530"}]}, {featureType: "road", elementType: "geometry", stylers: [{color: "#f5f1e6"}]}, {featureType: "road.arterial", elementType: "geometry", stylers: [{color: "#fdfcf8"}]}, {featureType: "road.highway", elementType: "geometry", stylers: [{color: "#f8c967"}]}, {featureType: "road.highway", elementType: "geometry.stroke", stylers: [{color: "#e9bc62"}]}, {featureType: "road.highway.controlled_access", elementType: "geometry", stylers: [{color: "#e98d58"}]}, {featureType: "road.highway.controlled_access", elementType: "geometry.stroke", stylers: [{color: "#db8555"}]}, {featureType: "road.local", elementType: "labels.text.fill", stylers: [{color: "#806b63"}]}, {featureType: "transit.line", elementType: "geometry", stylers: [{color: "#dfd2ae"}]}, {featureType: "transit.line", elementType: "labels.text.fill", stylers: [{color: "#8f7d77"}]}, {featureType: "transit.line", elementType: "labels.text.stroke", stylers: [{color: "#ebe3cd"}]}, {featureType: "transit.station", elementType: "geometry", stylers: [{color: "#dfd2ae"}]}, {featureType: "water", elementType: "geometry.fill", stylers: [{color: "#b9d3c2"}]}, {featureType: "water", elementType: "labels.text.fill", stylers: [{color: "#92998d"}]}];

                } else if (styles === 'dark') {

                    styles = [{elementType: "geometry", stylers: [{color: "#212121"}]}, {elementType: "labels.icon", stylers: [{visibility: "off"}]}, {elementType: "labels.text.fill", stylers: [{color: "#757575"}]}, {elementType: "labels.text.stroke", stylers: [{color: "#212121"}]}, {featureType: "administrative", elementType: "geometry", stylers: [{color: "#757575"}]}, {featureType: "administrative.country", elementType: "labels.text.fill", stylers: [{color: "#9e9e9e"}]}, {featureType: "administrative.land_parcel", stylers: [{visibility: "off"}]}, {featureType: "administrative.locality", elementType: "labels.text.fill", stylers: [{color: "#bdbdbd"}]}, {featureType: "poi", elementType: "labels.text.fill", stylers: [{color: "#757575"}]}, {featureType: "poi.park", elementType: "geometry", stylers: [{color: "#181818"}]}, {featureType: "poi.park", elementType: "labels.text.fill", stylers: [{color: "#616161"}]}, {featureType: "poi.park", elementType: "labels.text.stroke", stylers: [{color: "#1b1b1b"}]}, {featureType: "road", elementType: "geometry.fill", stylers: [{color: "#2c2c2c"}]}, {featureType: "road", elementType: "labels.text.fill", stylers: [{color: "#8a8a8a"}]}, {featureType: "road.arterial", elementType: "geometry", stylers: [{color: "#373737"}]}, {featureType: "road.highway", elementType: "geometry", stylers: [{color: "#3c3c3c"}]}, {featureType: "road.highway.controlled_access", elementType: "geometry", stylers: [{color: "#4e4e4e"}]}, {featureType: "road.local", elementType: "labels.text.fill", stylers: [{color: "#616161"}]}, {featureType: "transit", elementType: "labels.text.fill", stylers: [{color: "#757575"}]}, {featureType: "water", elementType: "geometry", stylers: [{color: "#000000"}]}, {featureType: "water", elementType: "labels.text.fill", stylers: [{color: "#3d3d3d"}]}];

                } else if (styles === 'night') {

                    styles = [{elementType: "geometry", stylers: [{color: "#242f3e"}]}, {elementType: "labels.icon", stylers: [{visibility: "off"}]}, {elementType: "labels.text.fill", stylers: [{color: "#746855"}]}, {elementType: "labels.text.stroke", stylers: [{color: "#242f3e"}]}, {featureType: "administrative.locality", elementType: "labels.text.fill", stylers: [{color: "#d59563"}]}, {featureType: "poi", elementType: "labels.text.fill", stylers: [{color: "#d59563"}]}, {featureType: "poi.park", elementType: "geometry", stylers: [{color: "#263c3f"}]}, {featureType: "poi.park", elementType: "labels.text.fill", stylers: [{color: "#6b9a76"}]}, {featureType: "road", elementType: "geometry", stylers: [{color: "#38414e"}]}, {featureType: "road", elementType: "geometry.stroke", stylers: [{color: "#212a37"}]}, {featureType: "road", elementType: "labels.text.fill", stylers: [{color: "#9ca5b3"}]}, {featureType: "road.highway", elementType: "geometry", stylers: [{color: "#746855"}]}, {featureType: "road.highway", elementType: "geometry.stroke", stylers: [{color: "#1f2835"}]}, {featureType: "road.highway", elementType: "labels.text.fill", stylers: [{color: "#f3d19c"}]}, {featureType: "transit", elementType: "geometry", stylers: [{color: "#2f3948"}]}, {featureType: "transit.station", elementType: "labels.text.fill", stylers: [{color: "#d59563"}]}, {featureType: "water", elementType: "geometry", stylers: [{color: "#17263c"}]}, {featureType: "water", elementType: "labels.text.fill", stylers: [{color: "#515c6d"}]}, {featureType: "water", elementType: "labels.text.stroke", stylers: [{color: "#17263c"}]}];

                } else if (styles === 'aubergine') {

                    styles = [{elementType: "geometry", stylers: [{color: "#1d2c4d"}]}, {elementType: "labels.icon", stylers: [{visibility: "off"}]}, {elementType: "labels.text.fill", stylers: [{color: "#8ec3b9"}]}, {elementType: "labels.text.stroke", stylers: [{color: "#1a3646"}]}, {featureType: "administrative.country", elementType: "geometry.stroke", stylers: [{color: "#4b6878"}]}, {featureType: "administrative.land_parcel", elementType: "labels.text.fill", stylers: [{color: "#64779e"}]}, {featureType: "administrative.province", elementType: "geometry.stroke", stylers: [{color: "#4b6878"}]}, {featureType: "landscape.man_made", elementType: "geometry.stroke", stylers: [{color: "#334e87"}]}, {featureType: "landscape.natural", elementType: "geometry", stylers: [{color: "#023e58"}]}, {featureType: "poi", elementType: "geometry", stylers: [{color: "#283d6a"}]}, {featureType: "poi", elementType: "labels.text.fill", stylers: [{color: "#6f9ba5"}]}, {featureType: "poi", elementType: "labels.text.stroke", stylers: [{color: "#1d2c4d"}]}, {featureType: "poi.park", elementType: "geometry.fill", stylers: [{color: "#023e58"}]}, {featureType: "poi.park", elementType: "labels.text.fill", stylers: [{color: "#3C7680"}]}, {featureType: "road", elementType: "geometry", stylers: [{color: "#304a7d"}]}, {featureType: "road", elementType: "labels.text.fill", stylers: [{color: "#98a5be"}]}, {featureType: "road", elementType: "labels.text.stroke", stylers: [{color: "#1d2c4d"}]}, {featureType: "road.highway", elementType: "geometry", stylers: [{color: "#2c6675"}]}, {featureType: "road.highway", elementType: "geometry.stroke", stylers: [{color: "#255763"}]}, {featureType: "road.highway", elementType: "labels.text.fill", stylers: [{color: "#b0d5ce"}]}, {featureType: "road.highway", elementType: "labels.text.stroke", stylers: [{color: "#023e58"}]}, {featureType: "transit", elementType: "labels.text.fill", stylers: [{color: "#98a5be"}]}, {featureType: "transit", elementType: "labels.text.stroke", stylers: [{color: "#1d2c4d"}]}, {featureType: "transit.line", elementType: "geometry.fill", stylers: [{color: "#283d6a"}]}, {featureType: "transit.station", elementType: "geometry", stylers: [{color: "#3a4762"}]}, {featureType: "water", elementType: "geometry", stylers: [{color: "#0e1626"}]}, {featureType: "water", elementType: "labels.text.fill", stylers: [{color: "#4e6d70"}]}];

                } else {

                    styles = [];

                }

                try {

                    center = new google.maps.LatLng(latitude, longitude);

                    options = {
                        zoom: zoom,
                        center: center,
                        styles: styles,
                        scrollwheel: false,
                        mapTypeControl: false,
                        streetViewControl: false
                    };

                    // Map
                    maps[id] = new google.maps.Map(document.getElementById(id), options);

                    // Markers
                    GRAPHICFORT.googleMapfn.markers(id, maps);

                } catch (error) {

                    if (error.toString().indexOf('google')) {
                        return false;
                    }

                }

            });

        },
        markers: function (id, maps) {

            var marker = [],
                infoWindow = [];

            $('#' + id).parents('.gfort-block-gmap-wrapper').find('.gfort-block-gmap-marker').each(function (index) {

                var el = $(this),
                    latitude = parseFloat(el.attr('data-gfort-marker-latitude')),
                    longitude = parseFloat(el.attr('data-gfort-marker-longitude')),
                    icon = el.attr('data-gfort-marker-image'),
                    content = '<div class="gfort-block-gmap-infowindow">' + el.html() + '</div>';

                latitude = (!latitude)
                    ? 0
                    : latitude;

                longitude = (!longitude)
                    ? 0
                    : longitude;

                infoWindow[index] = new google.maps.InfoWindow({
                    content: content
                });

                marker[index] = new google.maps.Marker({
                    icon: icon,
                    position: new google.maps.LatLng(latitude, longitude),
                    animation: google.maps.Animation.DROP
                });
                marker[index].setMap(maps[id]);

                marker[index].addListener('click', function () {
                    infoWindow[index].open(id, marker[index]);
                });

            });

        }
    };


    /* =========================================================================
    Tabs
    ========================================================================= */
    GRAPHICFORT.tabsfn = {
        // init
        init: function () {

            // Add the select element
            $('.gfort-block-tabs-select').each(function () {

                var el = $(this),
                    nav = $('> .gfort-nav-tabs', el),
                    select = '',
                    maxWidth = parseInt(el.attr('data-gfort-block-tabs-select-width'), 10);

                if (maxWidth > 0) {
                    maxWidth = 'style="max-width: ' + maxWidth + 'px' + '"';
                } else {
                    maxWidth = '';
                }

                if (el.hasClass('gfort-block-tabs-vertical')) {
                    nav = $('> .gfort-nav-tabs-wrapper .gfort-nav-tabs', el);
                }

                select = '<select class="gfort-tabs-select gfort-form-control secondary-font-family" aria-label="Select" ' + maxWidth + '>';

                $('> .gfort-nav-item', nav).each(function () {
                    select += '<option value="' + $('> a', this).attr('href') + '">' + $('> a', this).text() + '</option>';
                });

                select += '</select>';

                el.prepend(select);

            });

            // nav link (on click)
            $('.gfort-block-tabs-select .gfort-nav-item .gfort-nav-link').on('click', function () {
                $(this).parents('.gfort-block-tabs-select').find('.gfort-tabs-select').val($(this).attr('href'));
            });

            // select (on change)
            $('body').on('change', '.gfort-tabs-select', function () {

                var parent = $(this).parents('.gfort-block-tabs-select');

                parent.find('.active').removeClass('active');
                parent.find('a[href="' + $(this).val() + '"]').addClass('active');
                parent.find($(this).val()).addClass('active');

            });

        }
    };


    /* =========================================================================
    Text animation
    ========================================================================= */
    GRAPHICFORT.typedfn = {
        // init
        init: function () {

            if ($().typed) {

                $('.gfort-text-animation').each(function () {

                    var el = $(this),
                        strings = [],
                        typed = el.next().attr('id');

                    el.children().each(function () {
                        strings.push($(this).text());
                    });

                    $('#' + typed).typed({
                        loop: true,
                        typeSpeed: 30,
                        backDelay: 2000,
                        strings: strings
                    });

                });

            }

        }
    };


    /* =========================================================================
    Text animation
    ========================================================================= */
    GRAPHICFORT.gfortBGImageGrid = {
        // init
        init: function () {

            if ($().gridrotator) {

                $('.gfort-section-bg-images-grid').each(function () {

                    var el = $(this),
                        rowXL = parseInt(el.attr('data-gfort-row-xl'), 10),
                        colXL = parseInt(el.attr('data-gfort-col-xl'), 10),
                        rowLG = parseInt(el.attr('data-gfort-row-lg'), 10),
                        colLG = parseInt(el.attr('data-gfort-col-lg'), 10),
                        rowMD = parseInt(el.attr('data-gfort-row-md'), 10),
                        colMD = parseInt(el.attr('data-gfort-col-md'), 10),
                        rowSM = parseInt(el.attr('data-gfort-row-sm'), 10),
                        colSM = parseInt(el.attr('data-gfort-col-sm'), 10),
                        rowXS = parseInt(el.attr('data-gfort-row-xs'), 10),
                        colXS = parseInt(el.attr('data-gfort-col-xs'), 10),
                        animType = el.attr('data-gfort-animation'),
                        animSpeed = parseInt(el.attr('data-gfort-animation-speed'), 10),
                        interval = parseInt(el.attr('data-gfort-animation-interval'), 10);

                    /* Row / Column
                    --------------------------------------------------------- */
                    rowXL = (!rowXL)
                        ? 1
                        : rowXL;

                    rowLG = (!rowLG)
                        ? 1
                        : rowLG;

                    rowMD = (!rowMD)
                        ? 1
                        : rowMD;

                    rowSM = (!rowSM)
                        ? 1
                        : rowSM;

                    rowXS = (!rowXS)
                        ? 1
                        : rowXS;

                    colXL = (!colXL)
                        ? 1
                        : colXL;

                    colLG = (!colLG)
                        ? 1
                        : colLG;

                    colMD = (!colMD)
                        ? 1
                        : colMD;

                    colSM = (!colSM)
                        ? 1
                        : colSM;

                    colXS = (!colXS)
                        ? 1
                        : colXS;

                    /* init
                    --------------------------------------------------------- */
                    el.gridrotator({
                        // >= 1200px Desktop
                        rows: rowXL,
                        columns: colXL,
                        // < 1200 Tablet Landscape
                        wLG: {
                            rows: rowLG,
                            columns: colLG
                        },
                        // < 992px Tablet Portrait
                        wMD: {
                            rows: rowMD,
                            columns: colMD
                        },
                        // < 768px Mobile Landscape
                        wSM: {
                            rows: rowSM,
                            columns: colSM
                        },
                        // < 576px Mobile Portrait
                        wXS: {
                            rows: rowXS,
                            columns: colXS
                        },
                        // animation type
                        // showHide, fadeInOut, slideLeft, slideRight, slideTop, slideBottom, rotateBottom, rotateLeft, rotateRight, rotateTop, scale, rotate3d, rotateLeftScale, rotateRightScale, rotateTopScale, rotateBottomScale || random
                        animType: animType,
                        // animation speed
                        animSpeed: animSpeed,
                        // the item(s) will be replaced every X seconds
                        // note: for performance issues, the time "can't" be < 300 ms
                        interval: interval
                    });

                });

            }

        }
    };


    /* =========================================================================
    DownCount Timer
    ========================================================================= */
    GRAPHICFORT.downCountfn = {
        // init
        init: function () {

            if ($().downCount) {

                $('.gfort-block-downcount').each(function () {

                    var el = $(this),
                        year = el.attr('data-gfort-downcount-year'),
                        month = el.attr('data-gfort-downcount-month'),
                        day = el.attr('data-gfort-downcount-day'),
                        hour = el.attr('data-gfort-downcount-hour'),
                        minutes = el.attr('data-gfort-downcount-min'),
                        offset = el.attr('data-gfort-downcount-utc'),
                        message = el.attr('data-gfort-downcount-message');

                    el.downCount({
                        date: month + '/' + day + '/' + year + ' ' + hour + ':' + minutes + ':' + '00',
                        offset: offset
                    }, function () {
                        el.html('<div class="downcount-col-100"><h2>' + message + '</h2></div>');
                    });

                });

            }

        }
    };


    /* =========================================================================
    Easy Pie chart
    ========================================================================= */
    GRAPHICFORT.easyPieChartfn = {
        // init
        init: function () {

            if ($().easyPieChart) {

                $('.gfort-block-pie').each(function () {

                    var el = $(this),
                        container = $('> .gfort-block-container', el),
                        pie,
                        percent = parseFloat(el.attr('data-gfort-pie-percent')),
                        barColor = el.attr('data-gfort-pie-bar-color'),
                        trackColor = el.attr('data-gfort-pie-track-color'),
                        size = 156;

                    // Percent
                    percent = (!percent)
                        ? 100
                        : percent;

                    // Size
                    if (el.width() < 156) {
                        size = Math.ceil(el.width() - 2);
                    }

                    container.prepend('<div class="gfort-block-head gfort-block-pie-head"><div class="gfort-block-pie-circle"></div><h3 class="gfort-block-pie-percent" style="color: ' + barColor + '"><span data-gfort-count-from="0" data-gfort-count-to="' + percent + '" data-gfort-count-speed="1000" data-gfort-count-interval="50">' + percent + '</span><span>%</span></h3></div>');
                    pie = el.find('.gfort-block-pie-circle');

                    if ($().appear) {

                        pie.appear(function () {
                            pie.easyPieChart({
                                size: size,
                                scaleLength: 0,
                                lineWidth: '3',
                                scaleColor: false,
                                lineCap: 'square',
                                barColor: barColor,
                                trackColor: trackColor,
                                animate: {
                                    duration: 1500,
                                    enabled: true
                                }
                            });
                            pie.data('easyPieChart').update(Math.ceil(percent));
                        }, {accX: 0, accY: -108});

                    } else {

                        pie.easyPieChart({
                            size: size,
                            scaleLength: 0,
                            lineWidth: '3',
                            scaleColor: false,
                            lineCap: 'square',
                            barColor: barColor,
                            trackColor: trackColor,
                            animate: {
                                duration: 1500,
                                enabled: true
                            }
                        });
                        pie.data('easyPieChart').update(Math.ceil(percent));

                    }

                    GRAPHICFORT.countTofn.init();

                });

            }

        }
    };


    /* =========================================================================
    Progress bar
    ========================================================================= */
    GRAPHICFORT.progressBarfn = {
        // init
        init: function () {

            $('.gfort-progress').each(function () {

                var el = $(this),
                    percent = parseFloat(el.attr('data-gfort-progress-percent')) + '%',
                    title = el.attr('data-gfort-progress-title'),
                    lightColor = el.attr('class'),
                    line = $('> .gfort-progress-bar', el);

                if (lightColor.indexOf('light-color') > -1) {
                    lightColor = 'light-color';
                } else {
                    lightColor = '';
                }

                el.before('<div class="gfort-progress-title-percent ' + lightColor + '"><h6 class="font-size-13"><span>' + title + '</span><span>' + percent + '</span></h6></div>');

                if ($().appear) {

                    line.appear(function () {
                        line.animate({width: percent}, 800);
                    }, {accX: 0, accY: -108});

                } else {

                    line.animate({width: percent}, 800);

                }

            });

        }
    };


    /* =========================================================================
    Ready
    ========================================================================= */
    GRAPHICFORT.documentOnReady = {
        // init
        init: function () {

            // Desktop
            if (!isMobile.any()) {
                $('body').addClass('gfort-desktop-device');
            }

            // Bootstrap
            GRAPHICFORT.bootstrapfn.init();

            // Page fade effect
            if (pageFadeEffect === true) {
                GRAPHICFORT.pageFadeEffectfn.init();
            }

            // Page PreLoader
            if ($('#gfort-page-preloader').length) {
                gfortPace.start();
                GRAPHICFORT.pagePreLoaderfn.init();
            }

            // Back to top button
            $('.gfort-btn-back-to-top').on('click', function () {
                $('html, body').animate({scrollTop: '0'}, 800);
                return false;
            });

            // current page
            if (currentPage === true) {

                currentPageFileName = window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1);

                $('.gfort-section-header .gfort-nav-link').each(function () {

                    var el = $(this);

                    if (el.attr('href') === currentPageFileName) {
                        el.addClass('active').parentsUntil('.gfort-navbar-nav').addClass('active');
                    }

                });

            }

            // Header
            GRAPHICFORT.headerSectionfn.mobileMenu();
            GRAPHICFORT.headerSectionfn.init();
            GRAPHICFORT.headerSectionfn.collapseMenu();
            GRAPHICFORT.headerSectionfn.subMenu();
            GRAPHICFORT.headerSectionfn.megaMenu();
            GRAPHICFORT.headerSectionfn.searchForm();
            if ($('.gfort-section-header-middle').length) {
                GRAPHICFORT.headerSectionfn.middleSection();
            }
            if ($('.gfort-section-header-layout-5').length) {
                GRAPHICFORT.headerSectionfn.perfectScrollbar();
            }
            if ($('.gfort-section-header-transparent').length || $('.gfort-section-header-layout-2').length) {
                GRAPHICFORT.headerSectionfn.transparent();
            }

            // fitVids
            GRAPHICFORT.fitVidsfn.init();

            // MediaElement.js
            if ($('video').length || $('audio').length) {
                GRAPHICFORT.mediaElementPlayerfn.init();
            }

            // Mailchimp
            if ($('.gfort-form-block-mailchimp').length) {
                GRAPHICFORT.mailchimpfn.init();
            }

            // Instagram feed
            if ($('.gfort-instagram-feed-block').length) {
                GRAPHICFORT.instagramfn.init();
            }

            // Twitter feed
            if ($('.gfort-twitter-feed-block').length) {
                GRAPHICFORT.twitterfn.init();
            }

            // Fancybox
            if ($('[data-gfort-lightbox]').length) {
                GRAPHICFORT.fancyboxfn.init();
            }

            // copyright current year
            if (currentYear === true) {
                if ($('.gfort-current-year').length) {
                    $('.gfort-current-year').html(new Date().getFullYear());
                }
            }

            // Share buttons
            if ($('.gfort-block-share').length) {
                GRAPHICFORT.shareButtonfn.init();
            }

            // OWL slider
            if ($('.gfort-owl-slider').length) {
                GRAPHICFORT.owlSliderfn.init();
            }

            // ScrollTo
            $('body').on('click', '.data-gfort-scroll', function () {
                if ($(this.hash).length) {

                    var id = $(this).attr('href');

                    if ($('.gfort-navbar-collapse').hasClass('show')) {
                        $('body').removeClass('gfort-navbar-toggler-off-canvas-menu-open');
                        $('.gfort-navbar-toggler').removeClass('toggle');
                        $('.gfort-navbar-collapse').removeClass('show').addClass('collapse');
                    }

                    if ($('.gfort-section-header-layout-5').length) {
                        $('body').removeClass('gfort-navbar-toggler-off-canvas-menu-open');
                        $('.gfort-navbar-toggler').removeClass('toggle');
                    }

                    if ($('.gfort-section-header').hasClass('gfort-section-header-fixed') && (parseInt($(window).width() + scrollBarWidth, 10)) > 1199) {
                        $('html, body').animate({scrollTop: $(id).offset().top - $('.gfort-section-header-fixed .gfort-section-header-menu-container').height() + 2}, 800);
                    } else {
                        $('html, body').animate({scrollTop: $(id).offset().top}, 800);
                    }

                    return false;

                }
            });

            // isotope
            if ($('.gfort-isotope').length) {
                GRAPHICFORT.isotopefn.init();
            }
            // Filter
            if ($('.gfort-isotope-filter').length) {
                GRAPHICFORT.isotopefnFilterfn.init();
            }

            // reCaptcha
            if ($('.g-recaptcha-response').length) {
                $('.g-recaptcha-response').each(function (index) {
                    $(this).attr('id', $(this).attr('class') + '-' + index);
                    GRAPHICFORT.reCaptchafn.init($(this));
                });
            }

            // Form
            // Validation
            if ($('.gfort-form-block-validation').length) {
                GRAPHICFORT.formValidationfn.init();
            }
            // Back / Next btns
            if ($('.gfort-btn-form-back').length) {
                GRAPHICFORT.formBackBtnfn.init();
            }
            if ($('.gfort-btn-form-next').length) {
                GRAPHICFORT.formNextBtnfn.init();
            }
            // Checkbox accept
            if ($('.gfort-form-check-must-accept').length) {
                GRAPHICFORT.formCheckboxAcceptfn.init();
            }
            // Min date today
            if ($('.gfort-min-date-today').length) {
                GRAPHICFORT.formMinDateTodayfn.init();
            }

            // Modal
            GRAPHICFORT.modalfn.init();

            // Notifications
            if ($('.gfort-block-notification').length) {

                notificationsTimer = setTimeout(function () {

                    GRAPHICFORT.notificationsfn.init();

                    if ($('.gfort-block-notification-layout-2').length || $('.gfort-block-notification-layout-3').length) {
                        GRAPHICFORT.notificationsfn.perfectScrollbar();
                    }

                }, 1500);

            }

            // Parallax
            if ($('.gfort-section-parallax').length) {
                if (!isMobile.any()) {
                    GRAPHICFORT.parallaxfn.init();
                }
            }

            // Count To
            if ($('[data-gfort-count-to]').length) {
                if (!isMobile.any()) {
                    GRAPHICFORT.countTofn.init();
                }
            }

            // Youtube BG video
            if ($('.gfort-youtube-bg-video').length) {
                GRAPHICFORT.youtubeBGVideofn.init();
            }

            // Google Map
            if ($('.gfort-block-gmap').length) {

                $('.gfort-block-gmap').each(function (index) {
                    $(this).attr('id', 'gfort-block-map-id-' + index);
                });

                $.ajax({
                    type: 'GET',
                    url: 'https://maps.googleapis.com/maps/api/js?key=' + gmapAPIKey,
                    dataType: 'script',
                    cache: true
                }).done(function () {
                    GRAPHICFORT.googleMapfn.init();
                });

            }

            // Tabs
            if ($('.gfort-block-tabs-select').length) {
                GRAPHICFORT.tabsfn.init();
            }

            // Text animation
            if ($('.gfort-text-animation').length) {

                $('.gfort-text-animation').each(function (index) {
                    $('>:first-child', this).after('<span></span>');
                    $(this).attr('id', 'gfort-text-animation-' + index);
                    $(this).after('<span class="gfort-text-animation-typed" id="gfort-text-animation-typed-' + index + '"></span>');
                });

                GRAPHICFORT.typedfn.init();

            }

            // BG image grid
            if ($('.gfort-section-bg-images-grid').length) {
                GRAPHICFORT.gfortBGImageGrid.init();
            }

            // Downcount
            if ($('.gfort-block-downcount').length) {
                GRAPHICFORT.downCountfn.init();
            }

            // Before/After image slider
            if ($('.gfort-block-slider-image').length) {
                $('.gfort-block-slider-image').twentytwenty({
                    before_label: 'Before',
                    after_label: 'After',
                    no_overlay: true
                });
            }

            // Easy Pie chart
            if ($('.gfort-block-pie').length) {
                GRAPHICFORT.easyPieChartfn.init();
            }

            // Progress bar
            if ($('.gfort-progress').length) {
                GRAPHICFORT.progressBarfn.init();
            }

        }
    };
    $(document).ready(GRAPHICFORT.documentOnReady.init);


    /* =========================================================================
    Scroll
    ========================================================================= */
    GRAPHICFORT.windowOnScroll = {
        // init
        init: function () {

            pageCurrentPosition = $(window).scrollTop();

            // Back to top button
            if ($('#gfort-btn-back-to-top').length) {
                if (pageCurrentPosition >= 300) {
                    $('#gfort-btn-back-to-top').addClass('show');
                } else {
                    $('#gfort-btn-back-to-top').removeClass('show');
                }
            }

            // Header
            if ($('.gfort-section-header-fixed').length) {
                GRAPHICFORT.headerSectionfn.fixedHeader(pageCurrentPosition);
            }
            GRAPHICFORT.headerSectionfn.closeSearchFform();
            if ($('.gfort-section-header-fixed').length) {
                if (pageCurrentPosition >= 72) {
                    $('.gfort-section-header-menu-container').addClass('scroll');
                } else {
                    $('.gfort-section-header-menu-container').removeClass('scroll');
                }
            }
            if ($('.gfort-section-header-layout-5.gfort-section-header-fixed').length) {
                $('.gfort-section-header-fixed').css({transform: 'none'});
            }

            // fancyBox
            $('#gfort-btn-back-to-top').removeClass('gfort-no-transition');
            $('.gfort-section-header-menu-stuck').removeClass('gfort-no-transition');

        }
    };
    $(window).on('scroll', GRAPHICFORT.windowOnScroll.init);


    /* =========================================================================
    Resize
    ========================================================================= */
    GRAPHICFORT.windowOnResize = {
        // init
        init: function () {

            // Header
            // Sub menu
            headerSectionSubMenuTimer = setTimeout(function () {
                GRAPHICFORT.headerSectionfn.subMenu();
            }, 400);
            // Mega menu
            headerSectionMegaMenuTimer = setTimeout(function () {
                GRAPHICFORT.headerSectionfn.megaMenu();
            }, 400);
            // Transparent
            if ($('.gfort-section-header-transparent').length || $('.gfort-section-header-layout-2').length) {
                GRAPHICFORT.headerSectionfn.transparent();
            }

            // Scrollspy
            if ($().scrollspy) {
                $('[data-spy="scroll"]').each(function () {
                    $(this).scrollspy('refresh');
                });
            }

            // Youtube BG video
            if ($('.gfort-youtube-bg-video').length) {
                $('.gfort-youtube-bg-video').each(function () {
                    GRAPHICFORT.bgVideofn.init($(this));
                });
            }

        }
    };
    $(window).on('resize', GRAPHICFORT.windowOnResize.init);


}(jQuery));