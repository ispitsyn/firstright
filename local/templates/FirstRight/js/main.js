;'use strict';
document.addEventListener('DOMContentLoaded', function () {

    $(function () {
        $('[onclick*="BX.ajax.insertToNode"]').each(function () {
            $(this)[0].removeAttribute('onclick');
        });
        BX.addCustomEvent('onAjaxSuccess', function () {
            $('[onclick*="BX.ajax.insertToNode"]').each(function () {
                $(this)[0].removeAttribute('onclick');
            })
        });
    });
    if (!document.querySelectorAll('#bx_incl_area_1').length) {
        function moneyFormat(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

        app = new Vue({
            el: '#page',
            data: {
                filter: {
                    price: [15000, 55000]
                },
                detailCurrentPrice: typeof(pageParams) != 'undefined' ? moneyFormat(pageParams.price) : 0,
                productTabsActive: 'first',
                is_show: false,
                dialogTableVisible: false,
                dialogProductSlider: false,
                currentProductSlide: 0,
                repairTabShow: '',
                orderForm: {
                    name: '',
                    phone: '',
                    comment: '',
                    agree: false
                },
                repair: {
                    cost: '',
                    time: '',
                    items: {}
                },
                callBackForm: {
                    name: ''
                }
            },
            methods: {
                addServices(event) {
                    var target = event.currentTarget;
                    var itemRepair = {
                        id: target.getAttribute('data-id'),
                        name: target.getAttribute('data-name'),
                        price: target.getAttribute('data-price'),
                        time: target.getAttribute('data-time')
                    };
                    if (itemRepair.id in this.repair.items) {
                        delete(this.repair.items[itemRepair.id]);
                        $(target).removeClass('active');
                    } else {
                        this.repair.items[itemRepair.id] = itemRepair;
                        $(target).addClass('active');
                    }
                    var cost = '',
                        time = '';

                    for (var item in this.repair.items) {
                        var element = this.repair.items[item];
                        cost = +cost + +element.price;
                        time = +time + +element.time;
                    }

                    this.repair.cost = cost;

                    function time_convert(num) {
                        var hours = Math.floor(num / 60);
                        var minutes = num % 60;
                        return hours + " : " + minutes;
                    }

                    if (time) {
                        this.repair.time = time_convert(time);
                    } else {
                        this.repair.time = time;
                    }
                },
                handleClick(tab, event) {
                    console.log(tab, event);
                    if (tab.name === "third") {
                        tabSliderInit();
                    }
                },
                openOrderForm: function () {
                    overflow('open', false);
                },
                closeOrderForm: function () {
                    overflow('close', false);
                }
            },
            watch: {
                dialogProductSlider: function () {
                    if (this.dialogProductSlider) {
                        overflow('open', false);
                        setTimeout(function () {
                            $(".popup-product-slider__list").slick({
                                infinite: true,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: false,
                                fade: true,
                                centerMode: false,
                                initialSlide: app.currentProductSlide,
                                asNavFor: '.popup-product-slider__list-navigation'
                            });
                            $(".popup-product-slider__list-navigation").slick({
                                infinite: true,
                                slidesToShow: 5,
                                slidesToScroll: 1,
                                arrows: false,
                                fade: false,
                                centerMode: false,
                                centerPadding: '0',
                                focusOnSelect: true,
                                initialSlide: app.currentProductSlide,
                                asNavFor: '.popup-product-slider__list'
                            });
                            $('.popup-product-slider__list').on('afterChange', function (event, slick, currentSlide, nextSlide) {
                                app.currentProductSlide = currentSlide;
                                $('.product-slider__main').slick('slickGoTo', currentSlide);
                                $('.product-slider__nav').slick('slickGoTo', currentSlide);
                            });
                        }, 1);
                    } else {
                        overflow('close', false);
                        setTimeout(function () {
                            $(".popup-product-slider__list").slick('unslick');
                            $(".popup-product-slider__list-navigation").slick('unslick');
                        }, 500);
                    }
                }
            }
        });
    }

    function tabSliderInit() {
        $(".card-slider__list").slick('unslick');
        $(".card-slider__list").slick({
            slidesToShow: 4,
            slidesToScroll: 1
        });
    }

    var scrollWidth = getScrollWidth();
    $(document).resize(function () {
        scrollWidth = getScrollWidth();
    });

    function getScrollWidth() {
        var div = document.createElement('div');
        div.style.overflowY = 'scroll';
        div.style.width = '50px';
        div.style.height = '50px';
        div.style.visibility = 'hidden';
        document.body.appendChild(div);
        var scrollWidth = div.offsetWidth - div.clientWidth;
        document.body.removeChild(div);
        return scrollWidth;
    }

    function overflow(action, body) {
        if (typeof(body) === 'undefined') body = true;
        if (action == 'open') {
            var cssScrollWidth = parseInt(scrollWidth) + 'px';
            if (body) {
                $('body').css({
                    'overflow': 'hidden',
                    'padding-right': cssScrollWidth
                });
            }
            $('.header.fixed .header-main').css('padding-right', cssScrollWidth);
            $('.b24-widget-button-visible').css('padding-right', cssScrollWidth);
        } else {
            $('.header.fixed .header-main').css('padding-right', '0');
            $('.b24-widget-button-visible').css('padding-right', '0');
            $('body').css({
                'overflow-y': 'visible',
                'padding-right': 0
            });
        }
    }

    $(function () {

        var $document = $(document),
            $window = $(window);

        $(document).on('click', '.btn_product-card', function (e) {
            e.preventDefault();
            e.stopPropagation();
        });

        var App = {
            $: {
                header: $('.header'),
                headerTop: $('.header-top'),
                headerMain: $('.header-main'),
                menu: $('.menu'),
                search: $('.header-search')
            },
            popupWrap: function () {

            }
        };

        var $header = $('.header');
        var $headerTop = $('.header-top');
        var $headerMain = $('.header-main');
        var $menu = $('.menu');
        var $search = $('.header-search');

        function library(module) {
            $(function () {
                if (module.init) {
                    module.init();
                }
            });
            return module;
        }

        var search = library(function ($, $document, $window) {

            var $wrap = App.$.search,
                form = $wrap.find('form')[0],
                state = 'close',
                buttons = '.header-search__close, .header-search__btn, .header-search__cover';


            //FUNCTIONS
            function open() {
                $wrap.attr('data-search', 'open');
                App.$.header.attr('data-search', 'open');
                App.$.menu.attr('data-search', 'open');
                App.popupWrap('open');
                state = 'open';
                overflow('open');
            }

            function close() {
                state = 'close';

                $wrap.attr('data-search', 'close');
                App.$.header.attr('data-search', 'close');
                App.$.menu.attr('data-search', 'close');
                overflow('close');
            }

            function search() {
                if ($wrap.find('.header-search__field').val().length > 1) {
                    form.submit();
                }
            }

            return {
                init: function () {
                    //EVENTS
                    console.log('search init!');
                    $(document)
                        .on('click', buttons, function (e) {
                            var $this = $(this),
                                target = e.target.className,
                                action = '';

                            switch (target) {
                                case 'header-search__close':
                                    action = 'close';
                                    break
                                case 'header-search__btn':
                                    state == 'open' ? action = 'search' : action = 'open';
                                    break
                                case 'header-search__cover':
                                    action = 'close';
                                    break
                            }

                            switch (action) {
                                case 'open':
                                    open();
                                    break;
                                case 'close':
                                    close();
                                    break;
                                case 'search':
                                    search();
                                    break;
                            }
                        });
                }
            };

        }($, $document, $window, App));


        var $header = $('.header'),
            $headerMain = $('.header-main');
        var $headerTop = $headerMain.offset().top;

        $window.scroll(function () {
            var pageTop = $(this).scrollTop();
            if (pageTop >= $headerTop && !$header.hasClass('fixed')) {
                $header.addClass('fixed');
            } else if (pageTop < $headerTop && $header.hasClass('fixed')) {
                $header.removeClass('fixed');
            }
        });


        /*SLIDERS*/
        $('.card-category_repair-subcategory .card-category__list').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: false
        });
        $('.category-slider__list').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2500,
        });
        $(".full-slider__list").slick({
            //infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            appendDots: $(".full-slider__list").next(),
            fade: true,
            centerMode: false,
            autoplay: true,
            autoplaySpeed: 2500,
        });
        $(".stocks__list").slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false,
            dots: true,
            appendDots: $(".stocks__list").next(),
            fade: false,
            centerMode: false,
            autoplay: true,
            autoplaySpeed: 2500,
        });
        $(".card-slider__list").slick({
            //infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2500,
        });
        $(".info-blocks-column__list").slick({
            //infinite: false,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false,
            dots: true,
            appendDots: $(".info-blocks-column__list").next(),
            autoplay: true,
            autoplaySpeed: 2500,
        });
        $('.repair-navigation__list').slick({
            infinite: false,
            slidesToShow: 10,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 2500,
        });
        if ($('.product-slider').length) {

            $(".product-slider__main").slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                centerMode: false,
                asNavFor: '.product-slider__nav'

            });
            $(".product-slider__nav").slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: false,
                focusOnSelect: true,
                asNavFor: '.product-slider__main'
            });

            $('.product-slider__main').on('afterChange', function (event, slick, currentSlide, nextSlide) {
                app.currentProductSlide = currentSlide;
            });
        }

        $document
            .on('change', '.product-spoiler__item [name=set]', function () {
                var $this = $(this);
                $('.product-spoiler__item-header.active').removeClass('active');
                $('.product-spoiler__item-info.open').removeClass('open');
                var currentSpoiler = $this.closest('.product-spoiler__item');
                currentSpoiler
                    .find('.product-spoiler__item-info')
                    .addClass('open');
                currentSpoiler
                    .find('.product-spoiler__item-header')
                    .addClass('active');
            });
        if ($('.tabs-nav').length) {
            $('.tabs-nav').tabs();
        }

        //PRODUCT
        function rowMaxWidth(items) {

            function innerRowMaxWidth() {
                var maxWidth = 0;
                $(items).each(function () {
                    var $this = $(this);
                    console.log('width: ' + $this.width());
                    if (maxWidth < $this.width()) {
                        maxWidth = $this.width();
                    }
                });
                $(items).css('min-width', maxWidth + 'px');
            }

            innerRowMaxWidth();
            $(window).resize(function () {
                $(items).css('min-width', 0);
                innerRowMaxWidth();
            });
        }

        rowMaxWidth('.tabs-characteristics__row-property');

        var tagsCategory = library(function () {

            var block = $('.tags-category'),
                $box = $('.tags-category__box'),
                $list = $('.tags-category__list'),
                $items = $list.find('.tags-category__item'),
                $button_prev,
                $button_next;

            var button_prev = '<div class="tags-category__button tags-category__button_prev"</div>',
                button_next = '<div class="tags-category__button tags-category__button_next"</div>';

            var box_width = fullWidth($box),
                list_width = listWith(),
                list_position = 0,
                start_position = true,
                finish_position = false;

            function fullWidth(element, margin) {
                var current_width = parseFloat(element.width())
                    + parseFloat(element.css('padding-left'))
                    + parseFloat(element.css('padding-right'))
                    + parseFloat(element.css('border-left-width'))
                    + parseFloat(element.css('border-right-width'));
                if (margin) {
                    current_width += parseFloat(element.css('margin-left'))
                        + parseFloat(element.css('margin-right'));
                }
                return current_width;
            }

            function listWith() {
                var current_with = 0;
                $items.each(function (index) {
                    current_with += fullWidth($(this), true);
                });
                return current_with;
            }

            function addButton(mod) {
                if (mod === 'next') {
                    $button_next = $(button_next).insertAfter($list);
                    setTimeout(function () {
                        $button_next.addClass('tags-category__button_show');
                    }, 1);
                    $button_next.on('click', function () {
                        listMargin('next', searchTargetItem('next'));
                    });
                } else if (mod === 'prev') {
                    $button_prev = $(button_prev).insertBefore($list);
                    setTimeout(function () {
                        $button_prev.addClass('tags-category__button_show');
                    }, 1);
                    $button_prev.on('click', function () {
                        listMargin('prev', searchTargetItem('prev'));
                    });
                }
            }

            function removeButton(mod) {
                if (mod === 'next') {
                    $button_next.removeClass('tags-category__button_show');
                    setTimeout(function () {
                        $button_next.remove();
                    }, 250);
                } else if (mod === 'prev') {
                    $button_prev.removeClass('tags-category__button_show');
                    setTimeout(function () {
                        $button_prev.remove();
                    }, 250);
                }
            }

            function init() {
                if (list_width <= box_width) return 0;
                addButton('next');
                setTimeout(function () {
                    $list.css('width', list_width);
                }, 1000);
            }

            function searchTargetItem(mod) {
                box_width = fullWidth($box);
                var $searchIndex = 0;

                $items.each(function (index) {
                    var position = $(this).position().left + fullWidth($(this));
                    if ((mod === 'prev' && position > 0) || (mod === 'next' && position > box_width)) {
                        console.log('index: ' + index);
                        $searchIndex = mod === 'next' ? index - 2 : index + 1;
                        console.log('$searchIndex: ' + $searchIndex);
                        return false;
                    }
                });

                return $items.eq($searchIndex);
            }

            function listMargin(mod, item) {

                var bias,
                    remainingWidth,
                    thisOffset;

                thisOffset = parseInt(item.position().left);

                if (mod === 'next') {
                    remainingWidth = list_width - (list_position + box_width);
                    if (thisOffset > remainingWidth) {
                        bias = remainingWidth;
                        removeButton('next');
                        finish_position = true;
                    } else {
                        bias = thisOffset;
                    }
                    list_position += bias;
                    if (start_position) {
                        addButton('prev');
                    }
                } else if (mod === 'prev') {
                    thisOffset = box_width - (thisOffset + fullWidth(item));
                    if (thisOffset > list_position) {
                        bias = list_position;
                        removeButton('prev');
                        start_position = true;
                    } else {
                        bias = thisOffset;
                    }
                    list_position -= bias;
                    if (finish_position) {
                        addButton('next');
                    }
                }
                $list.css('transform', 'translateX(-' + list_position + 'px)');
            }

            return {
                init: function () {
                    if (block.length) init();
                }
            };

        }($, $document, $window, App));
    });
});
