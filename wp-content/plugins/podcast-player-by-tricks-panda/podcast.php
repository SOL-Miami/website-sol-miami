<?php
/*
Plugin Name: Podcast Player
Plugin URI: http://www.trickspanda.com
Description: Easily add a podcast player to your WordPress website with shortcodes and a user-friendly button.
Version: 1.0
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com
*/

add_action('init','podcast_init');

function podcast_init() {
    wp_enqueue_script( 'audio.min-js', plugins_url( '/assets/audio.min.js', __FILE__ ));
}

function tp_podcast() {
?>
<script type="text/javascript">
    audiojs.events.ready(function() {
    var as = audiojs.createAll();
  });
</script>
<?php
}
add_action( 'wp_head', 'tp_podcast' );

function podcast( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "title" => 'Podcast Player'  
    ), $atts));  
    return '<div><audio src="'.$content.'" preload="auto" /></div>
<pre>' . $title . ' - <a href="'.$content.'">Download This Episode</a></pre>';
}

add_shortcode("podcast", "podcast"); 

add_action( 'init', 'podcast_buttons' );
function podcast_buttons() {
    add_filter( "mce_external_plugins", "podcast_add_buttons" );
    add_filter( 'mce_buttons', 'podcast_register_buttons' );
}
function podcast_add_buttons( $plugin_array ) {
    $plugin_array['podcast'] = $dir = plugins_url( 'shortcode.js', __FILE__ );
    return $plugin_array;
}
function podcast_register_buttons( $buttons ) {
    array_push( $buttons, 'podbut' );
    return $buttons;
}

?>