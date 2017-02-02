	(function($) {
    $.fn.fader = function(options) {

        // default settings
        var settings = $.extend({
            fadeSpeed: 1000,
            duration: 4000,
            authorDelay: 1200,
            authorFadeSpeed: 750
        }, options );

        /**
         * Fades out element `toFade`, fading in `toFade+1`
         * If `toFade` is the last element, then the first element will be
         * faded in.
         *
         * @param {Integer} toFade which element to fade out
         * @param {Array} testimonial array of jQuery elements
         */
        function fade(toFade, testimonial, author) {
        
            // fade OUT element to opacity 0
          testimonial[toFade].animate({opacity: 0}, settings.fadeSpeed);
          author[toFade].animate({opacity: 0}, settings.fadeSpeed);

          var toShow = toFade === (testimonial.length - 1) ? 0 : toFade+1;
            
            // fade IN element to opacity 1
          testimonial[toShow].animate({opacity: 1}, settings.fadeSpeed);
          author[toShow].stop(true, true).delay(settings.authorDelay).animate({opacity: 1}, settings.authorFadeSpeed);

            // set duration of element
          setTimeout(function() {
            fade(toShow, testimonial, author);
          }, settings.duration);

        };
        

        // find li, add to text array and hide them
        var testimonial = [];
        $(this).find('ul li').each(function(){
          testimonial.push($(this));
          $(this).css({opacity: 0});
        });
        
        	
		// find li, add to text array and hide them
        var author = [];
        $(this).find('ul li span').each(function(){
          author.push($(this));
          $(this).css({opacity: 0});
        });


    	// fade in first item in array       
		testimonial[0].animate({opacity: 1}, settings.fadeSpeed/2);
		
		
    	 // run function 
        setTimeout(function(){
          fade(0, testimonial, author);
        }, settings.duration);
		
	
       author[0].stop(true, true).delay(settings.authorDelay/2).animate({opacity: 1}, settings.fadeSpeed/2);


    };
    

}(jQuery));