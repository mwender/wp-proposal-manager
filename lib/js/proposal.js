
var player;
var video_viewed = Cookies.get('video_viewed');
console.log('video_viewed = ' + video_viewed );

function onYouTubeIframeAPIReady(){
  player = new YT.Player('player',{
    width: '100%',
    height: 210,
    videoId: 'E3_0_objXK4',
    events: {
      onReady: onPlayerReady,
      onStateChange: onStateChange,
    },
    origin: scriptvars.siteurl,
    playerVars: {rel: 0}
  });
}

function onPlayerReady(event){
  if( 'yes' != video_viewed ){
    event.target.playVideo();
  }
}

function onStateChange(event){
  console.log('onVideoEnd(event) = ');
  console.log(event);
  if( 0 === event.data ){
    console.log('Video has ENDED.');
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
      //player.play();
      jQuery('#replay-video').fadeOut();
    });
  });
});

/*
(function($){

  var video_viewed = Cookies.get('video_viewed');
  console.log('video_viewed = ' + video_viewed );




  var player = getPlayer( video_viewed );

  if( typeof player != 'undefined' ){
    player.source({
      type: 'video',
      title: 'Introductory Video',
      sources: [{
        src: 'E3_0_objXK4',
        type: 'youtube'
      }]
    });
    player.on('ended', function(e){
      $('#video').fadeOut(400,function(){
        $('#attachments').fadeIn();
        $('#replay-video').fadeIn();
      });
      Cookies.set('video_viewed','yes', { expires: 28, path: '' } );
    });
  }

  $('#replay-video').click(function(e){
    e.preventDefault();
    Cookies.remove('video_viewed',{ path: '' });
    $('#attachments').fadeOut(400,function(){
      $('#video').fadeIn(400,function(){
        player.restart();
        player.play();
        $('#replay-video').fadeOut();
      });
    });
  });

})(jQuery);

function getPlayer( video_viewed ){
  var autoplay = true;
  if( 'yes' == video_viewed )
    autoplay = false;
  console.log('video_viewed = ' + video_viewed );

  var instances = plyr.setup('#plyr-video',{
    autoplay: autoplay
  });
  return instances[0];
}
*/