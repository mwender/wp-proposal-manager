<?php

add_action( 'typerocket_loaded', function(){
  $proposals = tr_post_type( 'Proposal', 'Proposals' );
  $proposals->setIcon( 'clipboard' );
  $proposals->setArgument( 'publicly_queryable', false );
  $proposals->setArgument( 'menu_position', 3 );

  // Generate a unique permalink
  $proposals->setTitleForm(function(){
    //global $form;

    $unique_id = tr_posts_field('unique_id');
    if( ! $unique_id )
      $unique_id = \ProposalManager\fns\uniqueid\get_unique_id();

    $form = tr_form();
    echo $form->hidden( 'unique_id',[ 'value' => $unique_id ] );

    $proposal_permalink = site_url( 'view-proposal/' . $unique_id );
    echo '<h4 style="margin-bottom: 4px;">Unique Proposal URL [<a target="_blank" href="' . site_url( 'view-proposal/' . $unique_id ) . '">View</a>]</h4>';
    echo '<input type="text" value="' . $proposal_permalink  . '" name="disabled_unique_id" id="disabled_unique_id" />';
    echo '<div style="font-size: 12px; height: 16px; margin-top: 4px; color: #090;" id="copy-notify"><span style="display: none; margin-left: 8px;">Link copied to your clipboard.</span></div>';
    echo '<script type="text/javascript">
    document.getElementById("disabled_unique_id").onclick = function(){
      this.select();
      document.execCommand("copy");
      (function($){
        $(\'#copy-notify span\').fadeIn();
        window.setTimeout(function(){
          $(\'#copy-notify span\').fadeOut();
        },3000);
      })(jQuery);
      //alert("The proposal permalink has been copied to your clipboard.");
    }
    </script>';
  });

  // Add an admin index "Permalink" column
  $proposals->addColumn('permalink', false, 'Permalink', function(){
    $unique_id = tr_posts_field('unique_id');
    $proposal_permalink = site_url( 'view-proposal/' . $unique_id );
    echo '<a href="' . $proposal_permalink . '" target="_blank">' . $proposal_permalink . '</a>';
  }, 'string' );

  // Let user upload documents to include with the proposal
  $box = tr_meta_box('Attachments')->apply($proposals);
  $box->setCallback(function() {
      $form = tr_form();
      $repeater = $form->repeater('Files')->setFields([
          $form->file('PDF'),
          //$form->text('Name')
      ]);

      echo $repeater;
  });

  // Let user pick a video to include with the proposal
  tr_meta_box('Introductory Video')->apply($proposals);
  function add_meta_content_introductory_video() {
    $videos = [
      'Video_All' => 'E3_0_objXK4',
      'Video_No DAI Incentive (<span style="color: #f00;"><strong>Tom Mann:</strong> This video needs to be uploaded to YouTube.</span>)' => '',
      'Video_No A&amp;S (<span style="color: #f00;"><strong>Tom Mann:</strong> This needs to be uploaded to YouTube.</span>)' => '',
      'Video_No DAI_No A&S (<span style="color: #f00;"><strong>Tom Mann:</strong> This needs to be uploaded to YouTube.</span>)' => '',
    ];
    $form = tr_form();
    echo $form->radio('Video')->setOptions( $videos );

    /*
    $video_query_args = [
      'post_type' => 'attachment',
      'post_mime_type' => 'video/mp4',
      'post_status' => 'inherit',
      'posts_per_page' => -1,
    ];
    $query_videos = new WP_Query( $video_query_args );
    if( $query_videos->have_posts() ):
      while ( $query_videos->have_posts() ) {
        $query_videos->the_post();
        $videos[get_the_title()] = get_the_ID();
      }
      echo $form->radio('Video')->setOptions( $videos );
    else:
      echo '<p><strong>No videos found!</strong><br />Please upload one or more videos to your WordPress media library.</p>';
    endif;
    /**/
  }

});