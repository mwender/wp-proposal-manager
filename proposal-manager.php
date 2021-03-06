<?php
/**
 * Plugin Name:     Hollingsworth Proposal Manager
 * Plugin URI:      https://github.com/mwender/wp-proposal-manager
 * Description:     Adds a Proposal CPT for quick and easy creation of Hollingsworth Construction proposals.
 * Author:          Michael Wender
 * Author URI:      https://michaelwender.com
 * Text Domain:     hollingsworth-proposal-manager
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Hollingsworth_Proposal_Manager
 */
define( 'HPM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'HPM_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Initialize TypeRocket
require ( 'lib/typerocket/init.php' );

// Initialize Plugin Updates
/*
require_once ( plugin_dir_path( __FILE__ ) . 'lib/classes/plugin-updater.php' );
if( is_admin() ){
    add_action( 'init', function(){
        // If you're experiencing GitHub API rate limits while testing
        // plugin updates, create a `Personal access token` under your
        // GitHub profile's `Developer Settings`. Then add
        // `define( 'GITHUB_ACCESS_TOKEN', your_access_token );` to
        // your site's `wp-config.php`.
        new GitHub_Plugin_Updater( __FILE__, 'mwender', 'hollingsworth-proposal-manager', GITHUB_ACCESS_TOKEN );
    } );
}
/**/
function hide_adminbar_on_proposals(){
    if(
      is_singular( 'proposal' )
      || 'proposal' == get_post_type()
      || is_singular( 'Proposal' )
      || 'Proposal' == get_post_type()
    ){
        return false;
    }
    return true;
}
add_filter('show_admin_bar', 'hide_adminbar_on_proposals', 999);

// Load Required Files
require_once( 'lib/fns/enqueues.php' );
require_once( 'lib/fns/inlinestyles.php' );
require_once( 'lib/fns/proposal-cpt.php' );
require_once( 'lib/fns/unique_id.php' );
require_once( 'lib/fns/url_rewrites.php' );