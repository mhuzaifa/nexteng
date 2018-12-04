$(document).ready(function () {

  // initiate clipthru for menu
  $('.menu').clipthru({
    autoUpdate: true,
    autoUpdateInterval: 30,
    keepClonesInHTML: true
  });

  // initiate clipthru for logo
  $('.logo-main').clipthru({
    autoUpdate: true,
    autoUpdateInterval: 30,
    keepClonesInHTML: false,
  });

  // initiate clipthru for apply link
  $('.circle-container').clipthru({
    autoUpdate: true,
    autoUpdateInterval: 30,
    keepClonesInHTML: false,
  });

  var $menuItemsOnHover = $('nav.light .scroll-anchor');
  var $linkText = $('nav.light .link-text');
  $linkText.hide();

  $menuItemsOnHover.hover(
    function () {
      $(this).next().fadeIn(150);
    },
    function () {
      $(this).next().fadeOut(150);
    }
  );

})

function homePage() {


  /*Variables*/
  var big_data_wrapper_offset_top = $('.big-data').offset().top;
  var rpa_wrapper_offset_top = $('.rpa').offset().top;
  var setores_wrapper_offset_top = $('.setores').offset().top;

  var menuHeight = $('.menu .items-wrapper').outerHeight() + 15;
  var manifestoTitleOffset = $('.manifesto').offset().top;
  var infoTechOffsetTop = $('.sticky-container').offset().top;

  var canScroll = true;
  var loop = -1;
  /* 
  var dragScroll = 0;
  var isDragging = false; */

  /*DOM variables*/
  var $tWordLogo = $('.st1');

  var $stickyContainer = $('.sticky-container');
  var $bigData = $('.big-data');
  var $rpa = $('.rpa');
  var $setores = $('.setores');

  var $overlayInfoTech = $('.info-tech .active-overlay');
  var $overlayBigData = $('.big-data .active-overlay');
  var $overlayRpa = $('.rpa .active-overlay');

  var $scrollHandler = $('.menu .scroll-handler');

  var $manifestoTitle = $('.manifesto--title');
  var $spacer = $('.spacer');
  var $nearShoreShip = $('.nearshore .fly');
  var $nearShore = $('.nearshore');
  var $carouselSlogan = $('.carousel--slogan div h3');

  //nex t logo animation for "t" word
  TweenMax.to($tWordLogo, 0.5, {
    x: -100,
    delay: 0,
    ease: Power4.easeOut
  });

  TweenMax.to($carouselSlogan, 0.5, {
    css: {
      transform: 'translateY(0%)',
      opacity: 1
    },
    delay: 0.2,
    ease: Power3.easeOut
  })


  var birdTimeline = new TimelineMax({
    repeat: -1,
    yoyo: true
  });

  birdTimeline.fromTo($nearShoreShip, 3, {
    rotation: 0,
    y: -5,
    x: -5,
    ease: Power3.easeInOut
  }, {
    rotation: 0,
    y: 5,
    x: 5,
    ease: Power3.easeInOut
  });

  function imageDuplicator(number, className) {

  }

  /*duplicate images for proxpera*/
  for (var i = 1; i < 8; i++) {
    var s = '';
    s += $('.duplicated')[0].src;
    $('.rotation-fix').append('<img data-counter="' + i + '" class="duplicated" src=' + s + '>');
  }

  /*duplicate images for Curiosidade*/
  for (var i = 1; i < 3; i++) {
    var s = '';
    s += $('.curiosidade img')[0].src;
    $('.curiosidade').append('<img data-counter="' + i + '" class="" src=' + s + '>');
  }

  /*duplicate images for Carácter*/
  for (var i = 1; i < 3; i++) {
    var s = '';
    s += $('.caracter img')[0].src;
    $('.caracter').append('<img data-counter="' + i + '" src=' + s + '>');
  }



  var init = function () {
    if (_customScroll == null) {
      /*Attach the event with a reference to kill after exit */
      _scrollRef = function () {
        _raf_loop_id = _rAF_loop(home_scroll_rAF);
      }
      $_window[0].addEventListener("scroll", _scrollRef, {
        passive: true
      });
    } else {
      _page_scroll_listener = function (status) {
        home_scroll_rAF(status);
      };

      _customScroll.addListener(_page_scroll_listener);
    }
    console.log("home page");

    /*inits*/
    /*init sticky plugin */
    if (!$_body.hasClass("mobile")) {
      $stickyContainer.stickyStack({
        containerElement: '.sticky-container',
        stackingElement: 'article',
        boxShadow: '0'
      });
    };

    //Events
    initEvents();
  }

  var kill = function () {
    //Kill Events
    $_window.off('resize.homePage');
    _scrollRef = null;
    cancelAnimationFrame(_raf_main_id);
    cancelAnimationFrame(loop);
    if (_customScroll) _customScroll.removeListener(_page_scroll_listener);
  };

  /*page functions*/

  navLinkScroll();
  //nearshoreAnimation();
  applyLinkRotation();

  function initEvents() {
    $.doTimeout(2000, function () {
      $_window.on('resize.homePage', $.debounce(500, resize));
    });
    window.addEventListener("orientationchange", function () {
      location.reload();
    });
  }

  function resize() {

    if (!$_body.hasClass("mobile"))
      location.reload();
  }

  function home_scroll_rAF(status) {

    /* Manifesto sticky title */
    var manifestoTitleHeight = $('.manifesto--title').outerHeight();
    var windowScrollTop = $_window.scrollTop();

    if (windowScrollTop >= manifestoTitleOffset) {
      $manifestoTitle.addClass('fixed-title');
      $spacer.outerHeight(manifestoTitleHeight);
    }
    /* else if (windowScrollTop >= infoTechOffsetTop) {
           $('.fixed-title').removeClass('fixed-title');
           $spacer.css('height', '0');
       } */
    else {
      $('.fixed-title').removeClass('fixed-title');
      $spacer.css('height', '0');
    };

    // this dosen't work inside above if/else statement so i did it separately
    if (windowScrollTop >= infoTechOffsetTop) {
      $('.fixed-title').removeClass('fixed-title');
      $spacer.css('height', '0');
    }

    /* Transparent Overlay for three sectors */
    if (verge.inViewport($bigData)) {
      var scaledOpacityInfoTech = scaleBetween($_window.scrollTop(), 0.5, -0.01,
        big_data_wrapper_offset_top,
        big_data_wrapper_offset_top - $_window.height());

      TweenMax.to($overlayInfoTech, 0.5, {
        opacity: scaledOpacityInfoTech
      })
    };

    if (verge.inViewport($rpa)) {
      var scaledOpacityInfoTech = scaleBetween($_window.scrollTop(), 0.5, -0.3, rpa_wrapper_offset_top,
        rpa_wrapper_offset_top - $_window.height());

      TweenMax.to($overlayBigData, 0.5, {
        opacity: scaledOpacityInfoTech
      })
    };

    if (verge.inViewport($setores)) {

      var scaledOpacityInfoTech = scaleBetween($_window.scrollTop(), 0.5, -0.3,
        setores_wrapper_offset_top,
        setores_wrapper_offset_top - $_window.height());

      TweenMax.to($overlayRpa, 0.5, {
        opacity: scaledOpacityInfoTech
      });
    };

    /* service section title animation */
    if (verge.inViewport($(".service--title"), -50) && !$(".service--title").hasClass("js-inviewport")) {
      $(".service--title").addClass("js-inviewport");
      TweenMax.to($(".service--title"), 1, {
        y: 0,
        autoAlpha: 1,
        delay: 0.1,
        ease: Power4.easeOut
      });
    };


    /* manifesto section title animation */
    if (verge.inViewport($(".manifesto--title"), -50) && !$(".manifesto--title").hasClass("js-inviewport")) {
      $(".manifesto--title").addClass("js-inviewport");
      TweenMax.to($(".manifesto--title"), 1, {
        y: 0,
        autoAlpha: 1,
        zIndex: 1,
        delay: 0.1,
        ease: Expo.easeOut
      });
    };

    /* manifesto section title animation */
    var $manifestoDetails = $('.manifesto--details');

    $manifestoDetails.each(function () {
      var $div = $(this);
      if (verge.inViewport($div, -200) && !$div.hasClass("js-inviewport")) {
        $div.addClass('js-inviewport');
        TweenMax.to($div.find($('.manifesto--text')), 1, {
          y: 0,
          autoAlpha: 1,
          delay: 0.1,
          ease: Expo.easeOut
        });

        if (!$_body.hasClass('mobile')) {
          /* animate duplicated prospera image */
          var num = 10;
          $div.find($('.duplicated')).each(function () {
            TweenMax.staggerTo($(this), 1.5, {
              delay: 0.4,
              autoAlpha: 1,
              rotation: num * 5,
              x: num / 2,
              y: num,
              transformOrigin: "top left",
              ease: Power4.easeOut
            }, 0.2);
            num++;
          });

        } else if ($_body.hasClass('mobile')) {
          /* animate duplicated prospera image */
          var num = 10;
          $div.find($('.duplicated')).each(function () {
            TweenMax.staggerTo($(this), 1.5, {
              delay: 0.5,
              autoAlpha: 1,
              rotation: num * 5,
              x: num / 2,
              y: num,
              transformOrigin: "top left",
              ease: Power4.easeOut
            }, 0.2);
            num++;
          });
        };

        var $curiosidade = $('.curiosidade');
        var $curiosidadeImg = $('.curiosidade img');
        var $curiosidadeImg2 = $('.curiosidade img:nth-child(2)');
        var $curiosidadeImg3 = $('.curiosidade img:nth-child(3)');

        TweenMax.to($div.find($curiosidade), 1, {
          autoAlpha: 1,
          x: 0,
          delay: 0.5,
          ease: Power3.easeInOut
        });


        TweenMax.to($div.find($curiosidadeImg), 1, {
          css: {
            animation: "glitch1 1s 2 forwards"
          }
        });

        TweenMax.to($div.find($curiosidadeImg2), 1, {
          css: {
            animation: "glitch2 1s 2 forwards"
          }
        });

        TweenMax.to($div.find($curiosidadeImg3), 1, {
          css: {
            animation: "glitch3 1s 2 forwards"
          }
        });


        var $altruismo = $('.altruismo img');


        TweenMax.fromTo($div.find($altruismo), 1, {
          scale: 0.2,
          autoAlpha: 0,
          rotation: 100 * 10,
          transformOrigin: "center",
          ease: Power4.easeOut
        }, {
          scale: 1,
          autoAlpha: 1,
          rotation: 0,
          delay: 0.5
        }, 0.2);

        /* animate duplicated prospera image */
        var $caracter = $('.caracter img');

        var n = 1;
        var op = 0.90;

        $div.find($caracter).each(function () {
          TweenMax.staggerTo($(this), 1, {
            opacity: op / 2.5,
            delay: 0.8,
            x: n * 8,
            y: -n * 6,
            transformOrigin: "center",
            ease: Power4.easeOut
          }, 0.2);
          n++;
          op++
        });

        /* animate astronaut with baseball image */
        var $astronaut = $('.astronaut');
        var $target = $('.target');

        TweenMax.to($div.find($astronaut), 0.6, {
          autoAlpha: 1,
          x: 0,
          delay: 0.5,
          ease: Elastic.easeOut.config(1, 0.3)
        });

        TweenMax.to($div.find($target), 0.4, {
          autoAlpha: 1,
          x: 0,
          delay: 0.2,
          ease: Power3.easeInOut
        });


      }
    });

    /* sectors title animation */
    var $sectors = $('.sectors');

    $sectors.each(function () {
      var $div = $(this).find('.sectors-title');
      if (verge.inViewport($div, -50) && !$div.hasClass("js-inviewport")) {
        $div.addClass('js-inviewport');
        TweenMax.to($div, 1, {
          y: 0,
          autoAlpha: 1,
          delay: 0.1,
          ease: Expo.easeOut
        });
      }
    });

    /* show hide apply link service section */

    var topDistance = $('.manifesto').offset().top;
    $('.circle-container.apply-top-right').show()

    if ((topDistance - 180) < windowScrollTop) {
      $('.circle-container.apply-top-right').hide()
    } else if ((window.innerWidth <= 414) && (verge.inViewport($('.manifesto'), -50))) {
      $('.circle-container.apply-top-right').hide()
    }

    /* show hide apply link footer section */
    if (verge.inViewport($('.social'))) {
      $('.circle-container.apply-tang-right').css('visibility', 'hidden')
    } else if (verge.inViewport($rpa)) {
      $('.circle-container.apply-tang-right').css('visibility', 'visible')
    }

    scrollingHandler();

  }


  function scrollingHandler() {
    if (!canScroll) return;
    var scaledTranslate = scaleBetween($_window.scrollTop(), 0, menuHeight, 0, $_body.height());
    TweenMax.to($scrollHandler, 0.5, {
      y: scaledTranslate,
      ease: Power4.easeOut
    });
  }


  /*   var handlerHeight = $('.fakehandler').height(); 

    Draggable.create(".dragger", {
          type:"y",
          bounds: ".fakehandler",
          lockAxis:true,
          onDrag: function(){
            canScroll = false;
            isDragging = true;
            dragScroll = scaleBetween(this.endY, 0, $_body.height(), 0, handlerHeight);

            //$_window.scrollTop(dragScroll);
            
          },
          onDragEnd: function() {
            canScroll = true;
            isDragging = false;
          }
      });  */

  function applyLinkRotation() {
    VirtualScroll.on(function (event) {
      vel = event.deltaY;

      TweenMax.to("svg#round", 1, {
        rotation: "+=" + vel * .5,
        ease: Linear.easeNone,
      });

    });
  }

  function scaleBetween(unscaledNum, minAllowed, maxAllowed, min, max) {
    return (maxAllowed - minAllowed) * (unscaledNum - min) / (max - min) + minAllowed;
  }

  /*Anchor Link Smooth Scroll*/
  function navLinkScroll() {
    $('.logo-main').on('click', function () {
      var $this = $(this),
        targetLink = $this.attr('data-target');
      TweenLite.to($_window, 1, {
        scrollTo: targetLink
      });
    });

    $('.items-wrapper .scroll-item').on('click', function () {
      var $this = $(this),
        targetLink = $this.attr('data-target');
      TweenLite.to($_window, 1, {
        scrollTo: targetLink
      });
    });

  }


  return {
    init: init,
    kill: kill
  }
}