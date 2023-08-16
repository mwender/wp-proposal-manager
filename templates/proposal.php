<?php
$post = get_post();
require_once( dirname(__FILE__) . '/head.php' );
if( post_password_required( $post ) ){
  require_once( dirname( __FILE__ ) . '/body.password-form.php' );
} else {
  require_once( dirname( __FILE__ ) . '/body.proposal.php' );
}
require_once( dirname( __FILE__ ) . '/footer.php' );
?>