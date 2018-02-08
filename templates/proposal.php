<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
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
            <a href="<?php echo site_url(); ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/hollingsworth-logo.svg" alt="Visit our website" /></a>
          </div>
          <div class="column">
            <p>Prepared: <?php echo get_the_date() ?><br /><a href="<?php echo site_url() ?>"><?php echo str_replace( ['http://','https://'], '', site_url() ) ?></a></p>
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
            <a class="button" style="<?php if( 'yes' != $video_viewed ) echo 'display: none; ' ?>" href="#" id="replay-video">Replay Video</a>
          </div>
        </div>
      </section>
    </nav>
    <section class="container" id="video"<?php if( 'yes' == $video_viewed ) echo ' style="display: none;"' ?>>
      <div class="video-container">
        <div id="player"></div>
      </div>
    </section>
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
    <section class="container grey" id="about">
      <h4>About The Hollingsworth Companies</h4>
      <div class="row">
        <div class="column column-25">
          <a href="<?php echo site_url('our-listings') ?>" target="_blank"><img class="border" src="<?php echo HPM_PLUGIN_DIR_URL; ?>lib/img/map-cropped.jpg" /></a>
        </div>
        <div class="column column-75">
          <p><strong>Building on Success</strong><br/>The Hollingsworth Companies Industrial Building Program doesn’t just build industrial facilities. We build businesses. Because we are likely to own all the real estate surrounding any of our facilities that you might select, we take a very serious interest in making sure your business is successful and growing. Our business grows when your business thrives, so it is only natural for us to want to see you do well. The list of creative solutions to business challenges is as long as our 50 years of combined experience, and it will continue to get longer.</p>
        </div>
      </div>
      <div class="row">
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php site_url('our-listings?view=5') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/click-to-find-properties.jpg" /></a></div>
            <div class="card-caption"><a href="<?php site_url('our-listings?view=5') ?>">Click to Find Properties</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php site_url('our-listings?view=1') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/available-now.jpg" /></a></div>
            <div class="card-caption"><a href="<?php site_url('our-listings?view=1') ?>">Available Now</a></div>
          </div>

        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php site_url('our-listings?view=2') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/construction-ready.jpg" /></a></div>
            <div class="card-caption"><a href="<?php site_url('our-listings?view=2') ?>">Under Construction Ready in 120 Days</a></div>
          </div>

        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php site_url('our-listings?view=3') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/build-to-suit.jpg" /></a></div>
            <div class="card-caption"><a href="<?php site_url('our-listings?view=3') ?>">Build to Suit in as little as 180 days</a></div>
          </div>

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
