
var player;
var video_viewed = Cookies.get('video_viewed');
console.log('video = ' + scriptvars.video);
if( '' == scriptvars.video ){
  jQuery('#video').html('<div class="alert"><p><strong>No video found!</strong><br/>No video ID was provided. Please check your Proposal\'s settings for the <code>Introductory Video</code>.</p></div>');
} else {
  function onYouTubeIframeAPIReady(){
    player = new YT.Player('player',{
      width: '100%',
      height: 210,
      videoId: scriptvars.video,
      events: {
        onReady: onPlayerReady,
        onStateChange: onStateChange,
      },
      origin: scriptvars.siteurl,
      playerVars: {rel: 0}
    });
  }
}



function onPlayerReady(event){
  if( 'yes' != video_viewed ){
    event.target.playVideo();
  }
}

function onStateChange(event){
  if( 0 === event.data ){
    jQuery('#video').fadeOut(400,function(){
      jQuery('#attachments').fadeIn();
      jQuery('#replay-video').fadeIn();
    });
    Cookies.set('video_viewed','yes', { expires: 28, path: '' } );
  }
}

jQuery('#replay-video').click(function(e){
  e.preventDefault();
  Cookies.remove('video_viewed',{ path: '' });
  jQuery('#attachments').fadeOut(400,function(){
    jQuery('#video').fadeIn(400,function(){
      player.playVideo();
      jQuery('#replay-video').fadeOut();
    });
  });
});

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