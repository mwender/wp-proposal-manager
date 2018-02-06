<?php get_header(); ?>

<div class="container-fluid content-container proposal-page">

	<div class="container">
		<div class="row">
			<div class="col-sm-12 content-left page-content-container">
        <?php
        if( have_posts() ){
          while( have_posts() ){
            the_post();
            ?>
            <div class="row" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
              <div class="col-sm-6">
                <h1 class="entry-title"><span style="font-size: 14px; font-family: Helvetica, Arial, sans-serif;">Proposal for</span><br/><?= get_the_title() ?></h1>
              </div>
              <div class="col-sm-6" style="text-align: right;">
                <p style="color: #fff;">Prepared: <?php the_date() ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <?php
                $video_id = get_post_meta( $post->ID, 'video', true );
                if( $video_id ){
                  $video_url = wp_get_attachment_url( $video_id );
                ?>
                <div class="page_video_link embed-responsive embed-responsive-4by3">
                  <div style="max-width:100%">
                    <?php
                    $video_viewed = tr_cookie()->get('video_viewed');
                    error_log( 'video_viewed = ' . $video_viewed );
                    if( 'yes' != $video_viewed ){
                    ?>
                    <div id="mediaplayer"></div>
                    <script src="<?php echo site_url(); ?>/wp-content/uploads/player/jwplayer.js" type="text/javascript"></script>
                    <script type="text/javascript">
                    var video = jwplayer("mediaplayer").setup({
                    flashplayer: "<?php echo site_url(); ?>/wp-content/uploads/player/player.swf",
                    file: "<?php echo $video_url; ?>",
                    width: "100%",
                    height: "420px",
                    stretching: "uniform",
                    image: "<?php echo HPM_PLUGIN_DIR_URL; ?>/lib/img/proposal_video_thumbnail.jpg",
                    events: {
                      onComplete: function() {
                        // Show content after video completes, set a COOKIE on user's browser
                        (function($){
                          $('#mediaplayer').fadeOut(400,function(){
                            $('#attachments').fadeIn();
                          });
                        })(jQuery);
                        Cookies.set('video_viewed','yes', { expires: 28, path: '' } );
                      }
                    }
                    }).play();
                    </script>
                    <?php } // if( ! $video_viewed ) ?>
                    <div class="page-content" id="attachments" style="<?php if( 'yes' != $video_viewed ) echo 'display: none; ' ?>background-color: #fff; min-height: 420px">
                      <h3 style="margin-top: 0;">Your proposal package:</h3>
                      <?php
                      $pdf_query_args = [
                        'post_type' => 'attachment',
                        'post_mime_type' => 'application/pdf',
                        'post_status' => 'inherit',
                        'posts_per_page' => -1,
                        'post_parent' => $post->ID
                      ];
                      $pdf_query = new WP_Query( $pdf_query_args );
                      if( $pdf_query->have_posts() ):
                        while( $pdf_query->have_posts() ){
                          $pdf_query->the_post();
                          echo '<h4><i class="fa fa-file-pdf-o"></i> <a href="' . wp_get_attachment_url( get_the_ID() ) . '" target="_blank">' . get_the_title() . '</a></h4>';
                        }
                        wp_reset_postdata();
                      else:
                        echo '<p>No files have been included.</p>';
                      endif;
                      ?>
                      <h5 style="font-family: Helvetica, Arial, sans-serif; margin-top: 60px;"><a href="#" id="watch-video">Replay Video <i class="fa fa-caret-right"></i></a></h5>
                      <script type="text/javascript">
                        (function($){
                          $('#watch-video').click(function(e){
                            e.preventDefault();
                            Cookies.remove('video_viewed',{ path: '' });
                            location.reload(true);
                          });
                        })(jQuery);
                      </script>
                    </div>
                  </div>
                </div>
                <?php
                } else {
                  echo '<p><strong>NO VIDEO FOUND!</strong><br/>Please specify a video for this proposal.</p>';
                } ?>
              </div>
              <div class="col-sm-4" style="color: #fff">
                  <?php the_content(); ?>
              </div>
            </div>

          <?php
          }
        }
        ?>

			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div>
</div>

</div>
</main>

<?php get_footer(); ?>