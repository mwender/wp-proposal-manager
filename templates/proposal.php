<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta name="robots" content="noindex,nofollow">
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title() ?></title>
  <?php wp_head(); ?>
</head>
<body>
<?php $video_viewed = tr_cookie()->get('video_viewed'); ?>
  <main class="wrapper">
    <header>
      <section class="container">
        <div class="row">
          <div class="column">
            <img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/hollingsworth-logo.svg" width="200" />
          </div>
          <div class="column">
            <p>Prepared: <?php echo get_the_date() ?></p>
          </div>
        </div>

      </section>
    </header>
    <nav class="navigation">
      <section class="container">
        <div class="row">
          <div class="column">
            <h1 class="title"><?= get_the_title() ?></h1>
          </div>
          <div class="column">
            <a class="button" style="<?php if( 'yes' != $video_viewed ) echo 'display: none; ' ?>" href="#" id="watch-video">Replay Video</a>
          </div>
        </div>
      </section>
    </nav>
    <?php
    if( 'yes' != $video_viewed ){
    ?>
    <section class="container" id="video">
      <?php
      $video_id = get_post_meta( $post->ID, 'video', true );
      if( $video_id ){
        $video_url = wp_get_attachment_url( $video_id );
        echo '<h3>Introductory Video</h3>';
        //echo wp_video_shortcode( [ 'src' => $video_url, 'poster' => HPM_PLUGIN_DIR_URL . 'lib/img/proposal_video_thumbnail.jpg' ] );
        echo '<video class="plyr-video" id="video-1626-1" poster="' . HPM_PLUGIN_DIR_URL . 'lib/img/proposal_video_thumbnail.jpg" controls="controls" preload="metadata"><source type="video/mp4" src="' . $video_url . '"></video>'; //
      } else {
        echo '<p><strong>No video found!</strong><br />Please check the settings for this proposal. No video was found.</p>';
      }
      ?>
    </section>
    <?php } ?>
    <section class="container" id="attachments" style="<?php if( 'yes' != $video_viewed ) echo 'display: none;' ?>">
      <div class="row">
        <div class="column column-60">
          <h3>Your proposal package:</h3>
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
            echo '<ul class="lrg">';
            while( $pdf_query->have_posts() ){
              $pdf_query->the_post();
              echo '<li><a href="' . wp_get_attachment_url( get_the_ID() ) . '" target="_blank">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
          else:
            echo '<p>No files have been included.</p>';
          endif;
          ?>
        </div>
        <div class="column column-40">
          <?php
          $post_content = apply_filters( 'the_content', get_the_content() );
          if( ! empty( $post_content ) )
            echo '<h4>Notes</h4>' . $post_content;
          ?>
        </div>
      </div>
    </section>
    <footer class="footer">
      <section class="container"><p>&copy; <?php echo date('Y') ?> <?php bloginfo( 'name' ) ?>. All rights reserved.<br/>2 Centre Plaza, Clinton, TN 37716, (865) 457-3601.</p></section>
    </footer>
  </main>
  <?php wp_footer() ?>
</body>
</html>
