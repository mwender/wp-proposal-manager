(function($){
  var video_viewed = Cookies.get('video_viewed');
  if( video_viewed )
    hideVideo();

  if( '' == scriptvars.video ){
    $('#video').html('<div class="alert"><p><strong>No video found!</strong><br/>No video ID was provided. Please check your Proposal\'s settings for the <code>Introductory Video</code>.</p></div>');
  } else {
    var videoPlayer = videojs('proposal-video',{
      controls: true,
      autoplay: false,
      preload: 'auto',
      width: 713,
      height: 401,
      poster: scriptvars.poster_frame
    });
    videoPlayer.src([{ type: 'video/mp4', src: scriptvars.video_url }]);

    videoPlayer.on('ended', function(){
      hideVideo();
      Cookies.set('video_viewed','yes', { expires: 28, path: '' } );
      if( isiPhone() ){
        alert('Thank you for watching. Here is your proposal.');
        document.getElementById('proposal-video').webkitExitFullScreen();
      }
    });
  }

  function hideVideo(){
    $('#video').fadeOut(400,function(){
      $('#attachments').fadeIn();
      $('#replay-video').fadeIn();
      $('#play-proposal-video').hide();
    });
  }

  function showVideo(){
    $('#attachments').fadeOut(400,function(){
      $('#video').fadeIn(400,function(){
        videoPlayer.play();
        $('#replay-video').fadeOut();
        $('#play-proposal-video').show();
      });
    });
  }

  // "Click to Play Video" Button
   $('#play-proposal-video').on('click', function(e){
    e.preventDefault();
    videoPlayer.play();
    //$(this).slideUp();
  });

  // "Replay Video" Button
  $('#replay-video').click(function(e){
    e.preventDefault();
    //Cookies.remove('video_viewed',{ path: '' });
    showVideo();
  });
})(jQuery);

// Detects if is iPhone
function isiPhone(){
  return(
    (navigator.platform.indexOf("iPhone") != -1) ||
    (navigator.platform.indexOf("iPod") != -1)
  );
}

// Adds `Read More` link
function hideText( textselector, strlen, moretext ){
    strlen = typeof strlen !== 'undefined' ? strlen : 100;
    moretext = typeof moretext !== 'undefined' ? moretext : 'Read More';

    var sections = jQuery( textselector );
    for(var i = 0; i < sections.length; i++ ){
        var textToHide = jQuery( sections[i] ).html();
        var textToCheck = jQuery( sections[i] ).text().substring(strlen);
        if( '' == textToCheck )
            continue;
        var visibleText = jQuery( sections[i] ).text().substring(0, strlen);

        jQuery( sections[i] )
            .html(('<span class="visible-text">' + visibleText + '</span>') + ('<span class="hidden-text">' + textToHide + '</span>'))
            .append('<span class="read-more">&hellip;[<a id="read-more" title="' + moretext + '" style="cursor: pointer;">' + moretext + '</a>]</spam>')
            .click(function() {
                jQuery(this).find('span.hidden-text').toggle();
                jQuery(this).find('span.read-more').hide();
                jQuery(this).find('span.visible-text').hide();
            });
        jQuery( sections[i] ).find( 'span.hidden-text' ).hide();
    }
}
hideText( '.hidetext', 237 );