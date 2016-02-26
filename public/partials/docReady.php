<?php function neccessary_codes_for_sft(){
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
    
        $(".widget_wp_simple_fading_testimonials").fader({
            // fadeSpeed: 400,
            // duration: 10000
        })
    
        var totalHeight = []; // create new array
    
        // loop through each li to obtain height
        $('.widget_wp_simple_fading_testimonials li').each(function() {
            totalHeight.push($(this).height()); // push each li height to array
             $(this).height( $(this).height() ); // set li height
        });
        var maxHeight = Math.max.apply(Math, totalHeight); // find max li height used
        $(".widget_wp_simple_fading_testimonials ul").height(maxHeight); // assign that height to widget
    
    });
</script>
<?php 
}
add_action('wp_footer', 'neccessary_codes_for_sft');