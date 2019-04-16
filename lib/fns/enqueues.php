<?php

namespace ProposalManager\fns\enqueues;

function enqueue_scripts(){

    global $wp_query, $wp_styles, $post;

    // Don't do anything if we're not on a proposal page
    if( is_admin() || ! isset( $wp_query->query_vars['uid'] ) )
        return;

    // dequeue all styles
    foreach( $wp_styles->registered as $handle => $data ) {
        wp_deregister_style( $handle );
        wp_dequeue_style( $handle );
    }

    // dequeue theme js
    wp_deregister_script( 'bootstrap.min.js' );
    wp_dequeue_script( 'bootstrap.min.js' );
    wp_deregister_script( 'functions.js' );
    wp_dequeue_script( 'functions.js' );

    wp_register_script( 'js-cookie', HPM_PLUGIN_DIR_URL . 'lib/js/js.cookie.js', null, '2.2.0' );

    //wp_register_script( 'youtube-api', 'https://www.youtube.com/iframe_api' );
    wp_enqueue_style( 'video-js', 'https://vjs.zencdn.net/7.4.1/video-js.css', null, '7.4.1' );
    //wp_register_script( 'video-js', 'https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js', null, '1.1.2' );
    wp_register_script( 'video-js', HPM_PLUGIN_DIR_URL . 'lib/js/video.min.js', null, '7.3.0' );
    wp_enqueue_script( 'proposal', HPM_PLUGIN_DIR_URL . 'lib/js/proposal.js', ['js-cookie','video-js'], filemtime( HPM_PLUGIN_DIR_PATH . 'lib/js/proposal.js'), true );
    $video = get_post_meta( $post->ID, 'video', true );
    $poster_frame = wp_get_attachment_url( 2342 );
    wp_localize_script( 'proposal', 'scriptvars', [
        'siteurl' => site_url(),
        'video' => $video,
        'video_url' => wp_get_attachment_url( $video ),
        'poster_frame' => $poster_frame,
    ]);
    wp_enqueue_style( 'proposal-manager', HPM_PLUGIN_DIR_URL . 'lib/css/main.css', null, filemtime( HPM_PLUGIN_DIR_PATH . 'lib/css/main.css') );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 999 );