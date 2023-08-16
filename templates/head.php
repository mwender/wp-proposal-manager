<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
    <title><?php
    global $post;
    if( post_password_required( $post ) ){
      echo 'Access Restricted';
    } else {
      wp_title();
    }
?></title>
    <?php wp_head(); ?>
  </head>
<body>