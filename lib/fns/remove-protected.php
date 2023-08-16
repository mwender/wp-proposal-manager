<?php

/**
* Removes or edits the 'Protected:' part from posts titles
*/
function remove_protected_text( $format, $post ) {
  return '%s';
}
add_filter( 'protected_title_format', 'remove_protected_text', 10, 2 );