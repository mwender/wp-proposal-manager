
(function($){
  var instances = plyr.setup('.plyr-video',{
    debug: false,
    autoplay: true
  });
  console.log(instances);
  if( instances ){
    instances[0].on('ended',function(e){
      $('#video').fadeOut(400,function(){
        $('#attachments').fadeIn();
        $('#watch-video').fadeIn();
      });
      Cookies.set('video_viewed','yes', { expires: 28, path: '' } );
    });
  }

  $('#watch-video').click(function(e){
    e.preventDefault();
    Cookies.remove('video_viewed',{ path: '' });
    $('#attachments').fadeOut(400,function(){
      $('#video').fadeIn(400,function(){
        instances[0].restart();
        instances[0].play();
      });
      $('#watch-video').fadeOut();
    });
    //location.reload(true);
  });

})(jQuery);
