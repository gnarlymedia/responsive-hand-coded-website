$(function()
{
      var 
        speed = 700,   // animation speed
        $wall = $('#wall'),

        masonryOptions = {         // initial masonry options
          columnWidth: 110, 
          itemSelector: '.box:not(.invis)',
          isAnimated: !Modernizr.csstransitions,
          animate: true,
/*           isFitWidth: true, */
          animationOptions: {
            duration: speed,
            queue: true
          }
        }

      // run on window.load so we can capture any incoming hashes
      $(window).load(function()
	     {
        // run masonry on start-up to capture all the boxes we'll need
        $wall.masonry(masonryOptions);
        if (window.location.hash)
		    {
          // get rid of the '#' from the hash
          var possibleFilterClass = window.location.hash.replace('#', '');
          switch (possibleFilterClass)
          {
            // if the hash matches the following words
            case 'e-commerce' : case 'html-css-javascript-jquery' : case 'seo-analytics-adwords' : case 'php-mysql' : case 'wordpress-social-integration' : case 'flash' :
              // set masonry options animate to false
              masonryOptions.animate = false;
              
              // hide boxes that don't match the filter class
              $wall.children().not('.'+possibleFilterClass).toggleClass('invis').hide();
                
              // run masonry again, this time with the necessary stuff hidden
              animate_wall(this);

              // $wall.masonry(masonryOptions, function()
              // {
              //     alert('Completed');
              // });
              break;
          }
        }
        
      // get visible boxes
      var $visible_boxes = $wall.children().not('.invis');

      // add rel attribute to visible boxes
      $visible_boxes.children("a").attr('rel','lightbox[current]');  

      $screen_width = document.documentElement.clientWidth;
    });

    var myPhotoSwipe;
    var jPM;

	   // enable photoswipe (jQuery version)
  	$(document).ready
    (
      function()
  	  {
        trigger_photoswipe();

/*        reset_facebook_size();

        mediaCheck
        (
          {
            //phone
            media: '(max-width: 767px)',
            entry: function()
            {
              console.log('starting 767px');
              reset_facebook_size();
            },
            exit: function()
            {
              console.log('leaving 767px');
              reset_facebook_size();
            }
          }
        )

        mediaCheck
        (
          {
            //tablet
            media: '(min-width: 768px) and (max-width: 979px)',
            entry: function()
            {
              console.log('starting 979px');
              reset_facebook_size();
            },
            exit: function()
            {
              console.log('leaving 979px');
              reset_facebook_size();
            }
          }
        )

        mediaCheck
        (
          {
            //desktop
            media: '(max-width: 1200px)',
            entry: function()
            {
              console.log('starting 1200px');
              reset_facebook_size();
            },
            exit: function()
            {
              console.log('leaving 1200px');
              reset_facebook_size();
            }            
          }
        );*/

        // Listen for orientation changes
/*        window.addEventListener("orientationchange", function()
        {
          reset_facebook_size();

        }, false);*/
        // var myPhotoSwipe = $("#wall a").photoSwipe({ enableMouseWheel: true , enableKeyboard: true });

        // jPM = $.jPanelMenu
        // (
        //   {
        //     menu: '#menu',
        //     trigger: '.custom-menu-trigger-selector'
        //   }
        // );

        // mediaCheck
        // (
        //   {
        //     media: '(max-width: 767px)',
        //     entry: function() {
        //       console.log('starting 767px');
        //       jPM.on();
        //     },
        //     exit: function() {
        //       console.log('leaving 767px');
        //       jPM.off();
        //     }
        //   }
        // );
      }
  	);

/*    (function(window, $, PhotoSwipe){
      
      $(document).ready(function(){
        $('div#wall')
          .live('pageshow', function(e){
            
            var 
              currentPage = $(e.target),
              options = {},
              photoSwipeInstance = $("#wall a > img", e.target).photoSwipe(options,  currentPage.attr('id'));
              
            return true;
            
          })
          
          .live('pagehide', function(e){
            
            var 
              currentPage = $(e.target),
              photoSwipeInstance = PhotoSwipe.getInstance(currentPage.attr('id'));

            if (typeof photoSwipeInstance != "undefined" && photoSwipeInstance != null) {
              PhotoSwipe.detatch(photoSwipeInstance);
            }
            
            return true;
            
          });
        
      });
    
    }(window, window.jQuery, window.Code.PhotoSwipe));*/
	

/*    function reset_facebook_size()
    {
      $(window).load
      (
        function()
        {
          $('#facebook-inner').attr( 'data-width', $('#facebook-container-home').width());
        }
      )
    }*/

    function trigger_photoswipe()
    {
/*      $('body').removeClass('ps-active');
      $('#wall').each(function()
      {
          if (window.Code)
          {
            var photoSwipe = window.Code.PhotoSwipe;
          }
          //var photoSwipeInstance = photoSwipe.getInstance($(this).attr('id'));
          if (typeof myPhotoSwipe != "undefined" && myPhotoSwipe != null)
          {
              photoSwipe.unsetActivateInstance(myPhotoSwipe);
              photoSwipe.detatch(myPhotoSwipe);
          }
      });*/

      var $visible_boxes = $("#wall a").not('.invis').has('img');
      myPhotoSwipe = $visible_boxes.photoSwipe({ enableMouseWheel: true , enableKeyboard: true });
    }

    $(document).bind('pagebeforechange', function(e)
    {
      if ($('.ps-carousel').length)
      {
          $('body').removeClass('ps-active');
          $('div#wall').each(function(){
              var photoSwipe = window.Code.PhotoSwipe;
              var photoSwipeInstance = photoSwipe.getInstance($(this).attr('id'));
              if (typeof photoSwipeInstance != "undefined" && photoSwipeInstance != null) {
                  photoSwipe.unsetActivateInstance(photoSwipeInstance);
              }
          });
      }
    });

/*  (function (window, $, PhotoSwipe)
	{
    $(document).ready
		(
			function ()
			{
        $("wall a").live
				(
					'pagehide2', function (e)
					{
          	var 
          		currentPage = $(e.target),
           		photoSwipeInstance = PhotoSwipe.getInstance(currentPage.attr('id'));

						photoSwipeInstance.addEventHandler
						(
							PhotoSwipe.EventTypes.onToolbarTap, function(e)
							{
								if (e.toolbarAction === 'close')
								{
									// I needed to use a specific location here: window.location.href = "something";
									// but i think you could use the history back
					   		  console.log("close photoswipe");
									animate_wall(this);
								}
							}
						);
            return true;
          }
				);
      }
		);

    } (window, window.jQuery, window.Code.PhotoSwipe));*/

    $('.filtering-nav a').click
	  (
		  function()
		  {
			   animate_wall(this);
		  }
    );

    $('.phone-number').click
    (
      function()
      {
        goog_report_conversion(window.location);
      }
    )
	  
	  function animate_wall(obj)
	  {
        $(obj).removeClass("selected");
        $(obj).addClass("selected");

        $('.filtering-nav li').removeClass("active");
        $(obj).parent().addClass("active");

        var 
          color = $(obj).attr('class').split(' ')[0],
          filterClass = '.' + color;

        if (filterClass == '.everything')
        {
          	// show all hidden boxes
          	$wall.children('.invis').toggleClass('invis').fadeIn(200);
          
          	// get visible boxes
          	var $visible_boxes = $wall.children().not('.invis');

            // add rel attribute to visible boxes
            $visible_boxes.children("a").attr('rel','external');          	
        }
        else
        {
        	// hide visible boxes
        	$wall.children().not(filterClass).not('.invis').toggleClass('invis').fadeOut(400);
                
			// show hidden boxes
			$wall.children(filterClass + '.invis').toggleClass('invis').fadeIn(200);
			
			// get visible boxes
			var $visible_boxes = $wall.children().not('.invis');
			
            // add rel attribute to visible boxes
            $visible_boxes.children("a").attr('rel','external');
            
            // get hidden boxes
			var $hidden_boxes = $wall.children('.invis');
            
   			// remove rel attribute from hidden boxes
			$hidden_boxes.children("a").attr('rel','');
        }
        // $wall.masonry({ animate: true });

        jQuery.when($wall.masonry(masonryOptions)).done(function(x) { 
            //call back logic
            console.log("callback");
            trigger_photoswipe();
        });

        // set hash in URL
        window.location.hash = color;
        return false;
	  }
});