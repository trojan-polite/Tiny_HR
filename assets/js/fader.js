(function($) {
    $.fn.fader = function(options) {

        var settings = $.extend({
            delay: 2000
        }, options );

        /**
         * Fades out element `toFade`, fading in `toFade+1`
         * If `toFade` is the last element, then the first element will be
         * faded in.
         *
         * @param {Integer} toFade which element to fade out
         * @param {Array} imgs array of jQuery elements
         */
        function fade(toFade, imgs) {
          imgs[toFade].animate({opacity: 0}, settings.delay/2);

          var toShow = toFade === (imgs.length - 1) ? 0 : toFade+1;

          imgs[toShow].animate({opacity: 1}, settings.delay/2);

          setTimeout(function() {
            fade(toShow, imgs);
          }, settings.delay);

        }

        // find images, and hide them
        var imgs = [];
        $(this).find('ul li').each(function(){
          imgs.push($(this));
          $(this).css({opacity: 0});
        });

        // show the first image, and set a timer to fade it - set first image CSS opacity to 1
        imgs[0].css({opacity: 1});

        // fade out the first image (which has opacity set to 1)
        setTimeout(function(){
          fade(0, imgs);
        }, options.delay/2);

    };

}(jQuery));