<?php

function wppm_password_form_alert( $form ){

  if( ! isset( $_COOKIE['wp-postpass_' . COOKIEHASH ] ) )
    return $form;

  // The refresh came from a different page, the user has not sent anything until now.
  if ( ! wp_get_raw_referer() == get_permalink() )
    return $form;

  $msg = '<div style="background-color: #fff7a1; padding: 1em 1em 1em 1.25em; margin-bottom: 1em; border-left: 5px solid #f3e167;">Either the password you entered was incorrect, or your browser\'s stored password does not match the password used for this page. Please try again:</div>';
  return $msg . $form;
}
add_filter( 'the_password_form', 'wppm_password_form_alert' );