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
          <div class="column column-50">
            <h1 class="title">Access Restricted</h1>
          </div>
          <div class="column column-50">&nbsp;</div>
        </div>
      </section>
    </nav>
    <section class="container">
      <div class="row">
        <div class="column column-25"></div>
        <div class="column column-50">
            <h3 style="margin-bottom: 1.4rem;">Password required:</h3>
            <?= get_the_password_form(); ?>
        </div>
        <div class="column column-25"></div>
      </div>
    </section>
