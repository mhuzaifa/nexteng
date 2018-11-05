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

  // initiate clipthru for logo
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

  /* 
  $manifestoImg.hover(function(){
    TweenMax.fromTo($manifestoImg, 0.3, {rotation:-1}, {rotation:0, ease:RoughEase.ease.config({strength:8, points:20, template:Linear.easeNone, randomize:false}) , clearProps:"x"})

  });  */


})

function homePage() {


  /*Variables*/
  var big_data_wrapper_offset_top = $('.big-data').offset().top;
  var rpa_wrapper_offset_top = $('.rpa').offset().top;
  var setores_wrapper_offset_top = $('.setores').offset().top;

  var menuHeight = $('.menu .items-wrapper').outerHeight() + 15;
  var manifestoTitleOffset = $('.manifesto').offset().top;

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
  var $nearShoreShip = $('.nearshore img');
  var $nearShore = $('.nearshore');

  function animations() {
    TweenMax.to($tWordLogo, 1, {
      x: -100,
      delay: 0,
      ease: Power4.easeOut
    });
  }

  var lFollowX = 0,
    lFollowY = 0,
    x = 0,
    y = 0,
    friction = 1 / 30;

  function moveBackground() {
    x += (lFollowX - x) * friction;
    y += (lFollowY - y) * friction;

    translate = 'translate(' + x + 'px, ' + y + 'px)';

    TweenMax.to($nearShoreShip, 0, {
      transform: translate,
      ease: Power4.easeOut
    });

    window.requestAnimationFrame(moveBackground);
  }

  $nearShore.on('mousemove click', function (e) {
    var lMouseX = Math.max(-100, Math.min(100, $_window.width() / 2 - e.clientX));
    var lMouseY = Math.max(-100, Math.min(100, $_window.height() / 2 - e.clientY));
    lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
    lFollowY = (20 * lMouseY) / 100;

  });

  if (!$_body.hasClass("mobile")) {
    moveBackground();
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
    if (!$_body.hasClass("mobile")) {
      $stickyContainer.stickyStack({
        containerElement: '.sticky-container',
        stackingElement: 'article',
        boxShadow: '0'
      });
    };

    /*
    var rotate = 10;
    var count = 0;
    for (var i = 0; i < 10; i++) {
      s = '';
      s+= $('.duplicated')[0].src;
      
      $('.manifesto--img').append('<img data-counter="'+ i + '" class="duplicated" src=' + s + '>');
      
      TweenMax.to($('.duplicated').attr("counter", i.toString()), 1, {rotation: -rotate, x: -rotate/2, y: -rotate, delay: .5, ease: Power4.easeOut});
      
console.log( $('.duplicated').attr("counter", i.toString()) )
      rotate += 10;
      count++;
    }
    */

    for (var i = 1; i < 7; i++) {
      s = '';
      s += $('.duplicated')[0].src;

      $('.rotation-fix').append('<img data-counter="' + i + '" class="duplicated" src=' + s + '>');
    }


    var imgWidth = $('.duplicated');
    //$('.manifesto--img').css('padding-left', imgWidth / 2);

    //Events
    initEvents();
  }

  var kill = function () {
    //Kill Events
    $_window.off('resize.homePage');
    _scrollRef = null;
    cancelAnimationFrame(_raf_main_id);

    if (_customScroll) _customScroll.removeListener(_page_scroll_listener);
  };

  /*page functions*/
  animations();
  navLinkScroll();

  function initEvents() {
    $.doTimeout(2000, function () {
      $_window.on('resize.homePage', $.debounce(500, resize));
    });
    window.addEventListener("orientationchange", function () {
      location.reload();
    });
  }

  /*Anchor Link Smooth Scroll*/

  function navLinkScroll() {
    $('.items-wrapper .scroll-item').on('click', function () {
      var $this = $(this),
        targetLink = $this.attr('data-target');
      TweenLite.to($_window, 1, {
        scrollTo: targetLink
      });
    });

    $('.logo-main').on('click', function () {
      var $this = $(this),
        targetLink = $this.attr('data-target');
      TweenLite.to($_window, 1, {
        scrollTo: targetLink
      });
    });

  }

  function resize() {

    if (!$_body.hasClass("mobile"))
      location.reload();

  }




  function home_scroll_rAF(status) {
    var manifestoTitleHeight = $('.manifesto--title').outerHeight();
    var windowScrollTop = $_window.scrollTop();

    if (windowScrollTop >= manifestoTitleOffset) {
      $manifestoTitle.addClass('fixed-title');
      $spacer.outerHeight(manifestoTitleHeight);
    } else {
      $('.fixed-title').removeClass('fixed-title');
      $spacer.css('height', '0');
    };

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

    if (verge.inViewport($(".service--title"), -50) && !$(".service--title").hasClass("js-inviewport")) {
      $(".service--title").addClass("js-inviewport");
      TweenMax.to($(".service--title"), 1, {
        y: 0,
        autoAlpha: 1,
        delay: 0.1,
        ease: Power4.easeOut
      });
    };


    if (verge.inViewport($(".service--subtitle"), -50) && !$(".service--subtitle").hasClass("js-inviewport")) {
      $(".service--subtitle").addClass("js-inviewport");
      TweenMax.to($(".service--subtitle"), 1, {
        y: 0,
        autoAlpha: 1,
        delay: 0.1,
        ease: Expo.easeOut
      });
    };

    if (verge.inViewport($(".manifesto--title"), -50) && !$(".manifesto--title").hasClass("js-inviewport")) {
      $(".manifesto--title").addClass("js-inviewport");
      TweenMax.to($(".manifesto--title"), 1, {
        y: 0,
        autoAlpha: 1,
        delay: 0.1,
        ease: Expo.easeOut
      });
    };

    var $manifestoDetails = $('.manifesto--details');

    $manifestoDetails.each(function () {
      var $div = $(this);
      if (verge.inViewport($div, -50) && !$div.hasClass("js-inviewport")) {

        $div.addClass('js-inviewport');

        TweenMax.to($div.find($('.manifesto--text')), 1, {
          y: 0,
          autoAlpha: 1,
          delay: 0.1,
          ease: Expo.easeOut
        });

        var num = 10;
        $('.duplicated').each(function () {

          TweenMax.staggerTo($(this), 1, {
            autoAlpha: 1,
            rotation: num * 6,
            x: -num / 2,
            y: -num,
            transformOrigin: "top left",
            ease: Power4.easeOut
          }, 0.1);
          num++;
        });
        //TweenMax.to(, 1, { x: 0, autoAlpha: 1, delay: 0.1, ease: Expo.easeOut});
      }
    });

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

    /* if (verge.inViewport($(".info-tech .sectors-title"), -50) && !$(".info-tech .sectors-title").hasClass("js-inviewport")) {
      $(".info-tech .sectors-title").addClass("js-inviewport");
      TweenMax.to($(".info-tech .sectors-title"), 1, { y: 0, autoAlpha: 1, delay: 0.1, ease: Expo.easeOut });
   }; */

    if (verge.inViewport($('.social'))) {
      $('.circle-container.apply-tang-right').css('visibility', 'hidden')
    } else if (verge.inViewport($rpa)) {
      $('.circle-container.apply-tang-right').css('visibility', 'visible')
    }
    scrollingHandler();
  }



  function scrollingHandler() {
    var scaledTranslate = scaleBetween($_window.scrollTop(), 0, menuHeight, 0, $_body.height());
    TweenMax.to($scrollHandler, 0.5, {
      y: scaledTranslate,
      ease: Power4.easeOut
    });
  }

  VirtualScroll.on(function (event) {
    vel = event.deltaY;

    TweenMax.to("svg#round", 1, {
      rotation: "+=" + vel * .5,
      ease: Linear.easeNone,
    });

  });

  function scaleBetween(unscaledNum, minAllowed, maxAllowed, min, max) {
    return (maxAllowed - minAllowed) * (unscaledNum - min) / (max - min) + minAllowed;
  }


  return {
    init: init,
    kill: kill
  }
}