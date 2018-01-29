<?php

add_action( 'typerocket_loaded', function(){
    $proposals = tr_post_type( 'Proposal', 'Proposals' );
    $proposals->setIcon( 'folder' );
    tr_meta_box('Attachments')->apply($proposals);

});