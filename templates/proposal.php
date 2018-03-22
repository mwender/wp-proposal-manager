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
    <section class="container" id="videox">
      <div class="row">
        <div class="column column-67">
          <div id="video"<?php if( 'yes' == $video_viewed ) echo ' style="display: none;"' ?>>
            <h3 style="margin-bottom: 1.4rem;">Introductory Video</h3>
            <div class="video-container">
              <div id="player"></div>
            </div>
          </div>
          <div id="attachments" <?php if( 'yes' != $video_viewed ) echo 'style="display: none;"' ?>>
            <h3>Your proposal package:</h3>
            <?php
            $files = tr_posts_field('files');
            if( $files ){
              echo '<ul class="lrg">';
              foreach( $files as $file ){
                echo '<li><a href="' . wp_get_attachment_url( $file['pdf'] ) . '" target="_blank">' . get_the_title( $file['pdf'] ) . '</a></li>';
              }
              echo '</ul>';
            } else {
              echo '<div class="alert"><p><strong>No Attachments!</strong>No attachments have been added to this Proposal. Please <a href="' . edit_post_link( $post->ID ) . '">edit this Proposal</a> and add some attachments under the <code>Attachments</code> meta box.</p></div>';
            }

            $post_content = apply_filters( 'the_content', $post->post_content );
            if( ! empty( $post_content ) )
              echo '<hr/><h4>Notes</h4>' . $post_content;
            ?>
          </div>
        </div>
        <div class="column column-33" id="about">
          <h4>About The Hollingsworth Companies</h4>
          <a href="<?php echo site_url('our-listings', 'http') ?>" target="_blank"><img class="border" src="<?php echo HPM_PLUGIN_DIR_URL; ?>lib/img/map-cropped.jpg" /></a>
          <p class="hidetext"><strong>Building on Success: </strong><br/>The Hollingsworth Companies Industrial Building Program doesn’t just build industrial facilities. We build businesses. Because we are likely to own all the real estate surrounding any of our facilities that you might select, we take a very serious interest in making sure your business is successful and growing. Our business grows when your business thrives, so it is only natural for us to want to see you do well. The list of creative solutions to business challenges is as long as our 50 years of combined experience, and it will continue to get longer.</p>
        </div>
      </div>
    </section>
    <section class="container grey" id="view-properties">
      <h4>View Our Properties</h4>
      <div class="row" style="margin-bottom: 10px;">
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php echo site_url('our-listings?view=5', 'http') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/click-to-find-properties.jpg" /></a></div>
            <div class="card-caption"><a href="<?php echo site_url('our-listings?view=5', 'http') ?>" target="_blank">Click to Find Properties</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php echo site_url('our-listings?view=1', 'http') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/available-now.jpg" /></a></div>
            <div class="card-caption"><a href="<?php echo site_url('our-listings?view=1', 'http') ?>" target="_blank">Available Now</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php echo site_url('our-listings?view=2', 'http') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/construction-ready.jpg" /></a></div>
            <div class="card-caption"><a href="<?php echo site_url('our-listings?view=2', 'http') ?>" target="_blank">Under Construction Ready in 120 Days</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="<?php echo site_url('our-listings?view=3', 'http') ?>" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/build-to-suit.jpg" /></a></div>
            <div class="card-caption"><a href="<?php echo site_url('our-listings?view=3', 'http') ?>" target="_blank">Build to Suit in as little as 180 days</a></div>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer">
      <section class="container"><p>&copy; <?php echo date('Y') ?> All rights reserved. <?php bloginfo( 'name' ) ?>, 2 Centre Plaza, Clinton, TN 37716, (865) 457-3601.</p></section>
    </footer>
  </main>
  <?php wp_footer() ?>
</body>
</html>
