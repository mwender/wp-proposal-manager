<?php

namespace ProposalManager\fns\rewrites;

/**
 * Setup rewrite rule for viewing a proposal.
 */
function add_rewrite_rules(){
  add_rewrite_rule( 'view\-proposal\/([0-9a-z]{1,})', 'index.php?uid=$matches[1]', 'top' );
}
add_action( 'init', __NAMESPACE__ . '\\add_rewrite_rules' );

/**
 * Add a rewrite tag to register a `uid` as a valid URL parameter.
 */
function add_rewrite_tags(){
  add_rewrite_tag( '%uid%', '([0-9a-z]{1,})' );
}
add_action( 'init', __NAMESPACE__ . '\\add_rewrite_tags' );

/**
 * Setups up main query when `uid` query_var is present
 *
 * @param      obj  $query  The query
 */
function filter_query( $query ){
  if( is_admin() || ! $query->is_main_query() )
    return;

  global $wp_query;

  if( ! isset( $wp_query->query_vars['uid'] ) )
    return;

  $uid = get_query_var( 'uid' );
  $query->set('post_type','proposal');
  $query->set( 'meta_query', array([
    'key' => 'unique_id',
    'value' => $uid,
    'compare' => '='
  ]));
}
add_action( 'pre_get_posts', __NAMESPACE__ . '\\filter_query' );

/**
 * Handles the display of a proposal.
 */
function view_proposal( $template ){
  global $wp_query;

  if( ! isset( $wp_query->query_vars['uid'] ) )
    return $template;

  $proposal_template = dirname( __FILE__ ) . '/../../templates/proposal.php';
  if( file_exists( $proposal_template ) )
    return $proposal_template;

  return $template;
}
add_action( 'template_include', __NAMESPACE__ . '\\view_proposal' );