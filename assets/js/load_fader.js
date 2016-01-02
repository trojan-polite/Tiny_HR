// on doc ready
jQuery(document).ready(function($) {

// alert( pw_script_vars.alert );
var delaySpeed2 = pw_script_vars.delaySpeed
console.log(delaySpeed2);

    $(".widget_wp_simple_fading_testimonials").fader({
        delay: 7000
    })

    var totalHeight = []; // create new array

    // loop through each li to obtain height
    $('.widget_wp_simple_fading_testimonials li').each(function() {
        totalHeight.push($(this).height()); // push each li height to array
        // $(this).height( $(this).height() ); // set li height
    });

    var maxHeight = Math.max.apply(Math, totalHeight); // find max li height used
    $(".widget_wp_simple_fading_testimonials").height(maxHeight); // assign that height to widget

});