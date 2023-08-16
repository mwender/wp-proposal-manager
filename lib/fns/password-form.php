<?php

function wppm_password_form_alert( $form ){
  global $post;

  if( ! isset( $_COOKIE['wp-postpass_' . COOKIEHASH ] ) )
    return $form;

  $raw_referer = wp_get_raw_referer();

  // If we're accessing directly, return the form:
  if( empty( $raw_referer ) )
    return $form;

  // The refresh came from a different page, the user has not sent anything until now.
  $unique_id = tr_posts_field('unique_id');
  $proposal_permalink = site_url( 'view-proposal/' . $unique_id );

  $valid_referers = [
    get_edit_post_link( $post->ID, 'php' ),
    admin_url( 'edit.php?post_type=proposal' ),
    get_permalink( $post ),
    $proposal_permalink,
  ];
  foreach( $valid_referers as $referer ){
    if( $referer == $raw_referer )
      return $form;
  }

  $msg = '<div style="background-color: #fff7a1; padding: 1em 1em 1em 1.25em; margin-bottom: 1em; border-left: 5px solid #f3e167;">Either the password you entered was incorrect, or your browser\'s stored password does not match the password used for this page. Please try again:</div>';
  return $msg . $form;
}
add_filter( 'the_password_form', 'wppm_password_form_alert' );