;'use strict';
document.addEventListener('DOMContentLoaded', function () {
    $(function () {

        $(".header-main").sticky({topSpacing:0});
        //SLIDERS
        $(".slider-full__list").slick({
            //infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            appendDots: $(".slider-full__list").next(),
            fade: true,
            centerMode: false,
            // autoplay: true,
            autoplaySpeed: 2500,
        });
        $(".product-slider__main").slick({
            infinite: false,
            centerMode: false,
            arrows: false,
            swipe: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            asNavFor: '.product-slider__nav'
        });
        $(".product-slider__nav").slick({
            infinite: false,
            centerMode: false,
            arrows: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            focusOnSelect: true,
            asNavFor: '.product-slider__main'
        });

        $("#catalog-filter").stick_in_parent({
            parent: '.section__box',
            offset_top: 70
        });

        $(document).on("click",".repair-group__tabs-navigation .button", function (e) {
            e.preventDefault();
            var $this = $(this);
            if(!$this.hasClass('active')) {
                var target = $this.attr('href');
                $('#'+target).addClass('active').siblings().removeClass('active');
                $this.addClass('active').siblings().removeClass('active');
            }
        });

        $(document).on('click','.tabs__navigation .button',function (e) {
            e.preventDefault();
            var $this = $(this),
                $container = $this.closest('.tabs'),
                index = $this.index();
            if($container.length) {
                var $tab = $container.find('.tabs__item:eq('+index+')');
                if(!$tab.length) return;
                $this.addClass('active').siblings().removeClass('active');
                $tab.addClass('active').siblings().removeClass('active');
            }
        });
    });
});
