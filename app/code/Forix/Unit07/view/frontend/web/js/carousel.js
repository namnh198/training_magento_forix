define([
    'jquery',
    'underscore',
    'mage/template',
    'Forix_Unit07/js/lib/own.carousel'
], function ($, _, mageTemplate) {
    return function (config, element) {
        var template = mageTemplate(config.template);
        var templateHtml = template({
            carousels: config.carousels
        })
        $(element).html(templateHtml);
        $(element).owlCarousel({
            responsive:{
                0:{
                    items:2
                },
                480:{
                    items:3
                },
                768:{
                    items:4
                },
                992:{
                    items:5
                },
                1200:{
                    items:6
                }
            },
            autoplay:false,
            loop:true,
            nav : true,
            dots: false,
            autoplaySpeed : 500,
            navSpeed : 500,
            dotsSpeed : 500,
            autoplayHoverPause: true,
            margin:30
        });
    }
})
