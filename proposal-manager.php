<?php
/**
 * Plugin Name:     WordPress Proposal Manager
 * Plugin URI:      https://github.com/mwender/wp-proposal-manager
 * Description:     Adds a Proposal CPT for quick and easy creation of proposals.
 * Author:          Michael Wender
 * Author URI:      https://mwender.com
 * Text Domain:     wp-proposal-manager
 * Domain Path:     /languages
 * Version:         1.4.1
 *
 * @package         Wp_Proposal_Manager
 */
define( 'HPM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'HPM_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Initialize TypeRocket
require ( 'lib/typerocket/init.php' );

function hide_adminbar_on_proposals( $show_admin_bar ){
    if(
      is_singular( 'proposal' )
      || 'proposal' == get_post_type()
      || is_singular( 'Proposal' )
      || 'Proposal' == get_post_type()
    ){
        return false;
    }
    return $show_admin_bar;
}
add_filter('show_admin_bar', 'hide_adminbar_on_proposals', 999);

// Load Required Files
require_once( 'lib/fns/enqueues.php' );
require_once( 'lib/fns/inlinestyles.php' );
require_once( 'lib/fns/password-form.php' );
require_once( 'lib/fns/proposal-cpt.php' );
require_once( 'lib/fns/remove-protected.php' );
require_once( 'lib/fns/robots.php' );
require_once( 'lib/fns/unique_id.php' );
require_once( 'lib/fns/url_rewrites.php' );