$(document).ready(function () {

  // initiate clipthru
  $('.menu').clipthru({
    autoUpdate: true,
    autoUpdateInterval: 30,
    keepClonesInHTML: true
  })

  // initiate clipthru
  $('.logo-main').clipthru({
    autoUpdate: true,
    autoUpdateInterval: 30,
    keepClonesInHTML: true
  })


  var $menuItemsOnHover = $('nav.light .scroll-anchor');
  var $linkText = $('nav.light .link-text');

  $linkText.hide();
  $menuItemsOnHover.hover(
    function () {
      $(this).next().fadeTo(1, 1);
    },
    function () {
      $(this).next().fadeTo(1, 0);
    }
  );

})
 
function homePage() {

  /*Variables*/
  var big_data_wrapper_offset_top = $('.big-data').offset().top;
  var rpa_wrapper_offset_top = $('.rpa').offset().top;
  var setores_wrapper_offset_top = $('.setores').offset().top;

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
  var menuHeight = $('.menu .items-wrapper').outerHeight() + 15;



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
  stickyInit();
  
  function initEvents() {

    $_window.on('resize.homePage', resize);

  }

  function stickyInit() {
    $stickyContainer.stickyStack({
      containerElement: '.sticky-container',
      stackingElement: 'article',
      boxShadow: '-1px 0 150px rgba(0, 0, 0, 0.20)'
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
    
  } 


  function animations() {
    TweenMax.to($tWordLogo, 1, {
      x: -100,
      delay: 0,
      ease: Power4.easeOut
    });

    TweenMax.set($('.st0'), {
      x: 0
    });
    TweenMax.to($('.st0'), 1, {
      x: 0,
      ease: Power4.easeOut
    });

  }

  function home_scroll_rAF(status) {

       if (verge.inViewport($bigData)) {

         var scaledOpacityInfoTech = scaleBetween($_window.scrollTop(), 0.8, -0.1, big_data_wrapper_offset_top,
         big_data_wrapper_offset_top - $_window.height());
         
         TweenMax.to($overlayInfoTech, 0, {
          opacity: scaledOpacityInfoTech
        });

       };

       if (verge.inViewport($rpa)) {

         var scaledOpacityInfoTech = scaleBetween($_window.scrollTop(), 0.8, -0.1, rpa_wrapper_offset_top,
         rpa_wrapper_offset_top - $_window.height());

         TweenMax.to($overlayBigData, 0.5, {
          opacity: scaledOpacityInfoTech
        });

       };

       if (verge.inViewport($setores)) {

         var scaledOpacityInfoTech = scaleBetween($_window.scrollTop(), 0.8, -0.1, setores_wrapper_offset_top,
         setores_wrapper_offset_top - $_window.height());

         TweenMax.to($overlayRpa, 0.5, {
          opacity: scaledOpacityInfoTech
        });

       };

       /* if (verge.inViewport($('.rpa'))) {

         $('.switch').addClass('active-overlay');

         var scaledOpacityBigData = scaleBetween(
           $_body.scrollTop(), 0, 0.8,
           rpa_wrapper_offset_top,
           rpa_wrapper_offset_top + _globalViewportH
         );

         TweenMax.to($overlayBigData, 0.2, {
           opacity: scaledOpacityBigData
         });

       }  */
 

    var scaledTranslate = scaleBetween($_window.scrollTop(), 0, menuHeight, 0, $_body.height());

    TweenMax.to($scrollHandler, 0.5, {
      y: scaledTranslate,
      ease: Power4.easeOut
    });

  }

  function scaleBetween(unscaledNum, minAllowed, maxAllowed, min, max) {
    return (maxAllowed - minAllowed) * (unscaledNum - min) / (max - min) + minAllowed;
  }
    
  return {
    init: init,
    kill: kill
  }
}