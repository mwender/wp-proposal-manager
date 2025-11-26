<?php $video_viewed = tr_cookie()->get('video_viewed'); ?>
  <main class="wrapper">
    <header>
      <section class="container">
        <div class="row">
          <div class="column">
            <img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/hollingsworth-logo.svg" alt="Visit our website" />
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
            <?php
            global $post;
            $video = get_post_meta( $post->ID, 'video', true );
            $video_url = wp_get_attachment_url( $video );
            ?>
            <div class="video-container">
              <video class="video-js" id="proposal-video">

              </video>
            </div>
            <a class="button button-block button-lg" id="play-proposal-video" style="margin-top: 1rem; margin-bottom: 3rem;" href="#">Click to Play Video</a>
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
          <a href="<?php echo site_url('our-listings/', 'http') ?>" target="_blank"><img class="border" src="<?php echo HPM_PLUGIN_DIR_URL; ?>lib/img/map-cropped.jpg" /></a>
          <p class="hidetext"><strong>Building on Success: </strong><br/>The Hollingsworth Companies Industrial Building Program doesn’t just build industrial facilities. We build businesses. Because we are likely to own all the real estate surrounding any of our facilities that you might select, we take a very serious interest in making sure your business is successful and growing. Our business grows when your business thrives, so it is only natural for us to want to see you do well. The list of creative solutions to business challenges is as long as our 50 years of combined experience, and it will continue to get longer.</p>
        </div>
      </div>
    </section>
    <section class="container grey" id="view-properties">
      <h4>View Our Properties</h4>
      <div class="row" style="margin-bottom: 10px;">
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="https://hollingsworthcos.com/properties" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/click-to-find-properties.jpg" /></a></div>
            <div class="card-caption"><a href="https://hollingsworthcos.com/properties" target="_blank">Click to Find Properties</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="https://hollingsworthcos.com/services" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/available-now.jpg" /></a></div>
            <div class="card-caption"><a href="https://hollingsworthcos.com/services" target="_blank">Our Services</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="https://hollingsworthcos.com/news" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/construction-ready.jpg" /></a></div>
            <div class="card-caption"><a href="https://hollingsworthcos.com/news" target="_blank">Construction News and Insights</a></div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image"><a href="https://hollingsworthcos.com/about" target="_blank"><img src="<?php echo HPM_PLUGIN_DIR_URL ?>lib/img/build-to-suit.jpg" /></a></div>
            <div class="card-caption"><a href="https://hollingsworthcos.com/about" target="_blank">About Hollingsworth Cos.</a></div>
          </div>
        </div>
      </div>
    </section>