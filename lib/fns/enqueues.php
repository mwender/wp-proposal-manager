<?php

namespace ProposalManager\fns\enqueues;

function enqueue_scripts(){

    global $wp_query, $wp_styles;

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

    wp_enqueue_script( 'js-cookie', HPM_PLUGIN_DIR_URL . 'lib/js/js.cookie.js', null, '2.2.0' );

    wp_register_script( 'plyr', HPM_PLUGIN_DIR_URL . 'lib/js/plyr/plyr.js' );
    wp_enqueue_style( 'plyr', HPM_PLUGIN_DIR_URL . 'lib/js/plyr/plyr.css' );
    wp_enqueue_script( 'proposal', HPM_PLUGIN_DIR_URL . 'lib/js/proposal.js', ['plyr'], filemtime( HPM_PLUGIN_DIR_PATH . 'lib/js/proposal.js'), true );
    wp_enqueue_style( 'proposal-manager', HPM_PLUGIN_DIR_URL . 'lib/css/main.css' );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 999 );