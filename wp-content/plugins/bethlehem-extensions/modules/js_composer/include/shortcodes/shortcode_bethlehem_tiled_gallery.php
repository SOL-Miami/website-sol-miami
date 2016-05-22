<?php
if ( !function_exists( 'shortcode_vc_tiled_gallery' ) ):

function shortcode_vc_tiled_gallery( $atts, $content = null ){

    extract(shortcode_atts(array(
        'title' => '',
        'pretitle' => '',
        'post_types' => '',
        'orderby' => '',
        'order' => '',
        'tax_term' => '',
        'taxonomy' => '',
        'limit' => '',
        'grid' => '',
        'padding' => '',
        'pagination' => '',
        'byline_template' => '',
        'byline_opacity' => '',
        'byline_color' => '',
        'el_class' => '',
    ), $atts));

    if( empty( $orderby ) ) {
        $orderby = 'none';
    }

    if( empty( $order ) ) {
        $order = 'ASC';
    }

    if( empty( $limit ) ) {
        $limit = 5;
    }

    if( empty( $post_types ) ) {
        $post_types = 'post';
    }

    if( empty( $grid ) ) {
        $grid = 'News';
    }

    if( empty( $padding ) ) {
        $padding = 0;
    }

    if( empty( $pagination ) ) {
        $pagination = 'none';
    }

    if( empty( $byline_template ) ) {
        $byline_template = '%excerpt%';
    }

    if( empty( $byline_opacity ) || $byline_opacity < 0 || $byline_opacity > 1 ) {
        $byline_opacity = 0;
    }

    if( empty( $tax_term ) || empty( $taxonomy ) ) {
        $tax_term = false;
        $taxonomy = false;
    }

    $content = wpb_js_remove_wpautop( $content, true );

    $args = array(
        'title'                 => $title,
        'pretitle'              => $pretitle,
        'content'               => $content,
        'limit'                 => $limit,
        'orderby'               => $orderby,
        'order'                 => $order,
        'tax_term'              => $tax_term,
        'taxonomy'              => $taxonomy,
        'post_types'            => $post_types,
        'grid'                  => $grid,
        'padding'               => $padding,
        'pagination'            => $pagination,
        'byline_template'       => $byline_template,
        'byline_opacity'        => $byline_opacity,
        'byline_color'          => $byline_color,
        'el_class'              => $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_tiled_gallery' ) ) {
        $html = shortcode_bethlehem_tiled_gallery( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_tiled_gallery' , 'shortcode_vc_tiled_gallery' );

endif;
