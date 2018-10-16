function homePage() {
  /*Variables*/
  var big_data_wrapper_offset_top = $('.big-data-wrapper').offset().top;
  var rpa_wrapper_offset_top = $('.rpa-wrapper').offset().top;
  /*DOM variables*/
  var $tWordLogo = $('.st1');
  var $overlayInfoTech = $('.info-tech .active-overlay');
  var $overlayBigData = $('.big-data .active-overlay');

  var $scrollHandler = $('.scroll-handler');
  var $hiddenMenuItems = $('.menu-light .scroll-item .link-text, .manifesto .menu-full .scroll-item .link-text');
  var $menuItemsOnHover = $('.menu-light .scroll-anchor, .manifesto .menu-full .scroll-anchor');
  var menuHeight = $('.items-wrapper').height() + 13;
  var bodyHeight =
    $('.header').outerHeight() +
    $('.content').outerHeight() +
    $('.manifesto').outerHeight() +
    $('.info-tech').outerHeight() +
    $('.big-data').outerHeight() +
    $('.rpa').outerHeight() +
    $('.setores').outerHeight();

  var init = function () {

    //$('.page-content').height($('.content').outerHeight());

    if (_customScroll == null) {
      /*Attach the event with a reference to kill after exit */
      _scrollRef = function () {
        _raf_loop_id = _rAF_loop(home_scroll_rAF);
      };
      $_body[0].addEventListener('scroll', _scrollRef, {
        passive: true
      });
    } else {
      _page_scroll_listener = function (status) {
        home_scroll_rAF(status);
      };

      _customScroll.addListener(_page_scroll_listener);
    }

    //Events
    initEvents();
  };

  var kill = function () {
    //Kill Events
    $_window.off('resize.homePage');
    _scrollRef = null;
    cancelAnimationFrame(_raf_main_id);

    if (_customScroll) _customScroll.removeListener(_page_scroll_listener);
  };

  /*page functions*/

  function initEvents() {
    $.doTimeout(2000, function () {
      $_window.on('resize.homePage', $.debounce(500, resize));
    });
 
      
    TweenMax.set($tWordLogo, { x: 0 });
    TweenMax.to($tWordLogo, 1, { x: -100, delay: 0, ease: Power4.easeOut});

    TweenMax.set($('.st0'), {x: 0 });
    TweenMax.to($('.st0'), 1, { x: 0, ease: Power4.easeOut });

    navLinkScroll();
    absoluteItemsHeight();
    navLinksShowHide();
  }

  /*Anchor Link Smooth Scroll*/
  function navLinkScroll() {
    $('.items-wrapper .scroll-item').on('click', function () {
      console.log("logo")
      var $this = $(this),
        targetLink = $this.attr('data-target');
      TweenLite.to($_body, 1, {
        scrollTo: targetLink
      });
    });

    $('.logo-main').on('click', function () {
      var $this = $(this),
        targetLink = $this.attr('data-target');
      TweenLite.to($_body, 1, {
        scrollTo: targetLink
      });
    });
  }

  /*Manually assigned height for absolute items */
  function absoluteItemsHeight() {
    $('.manifesto-wrapper').height($('.manifesto').outerHeight());
    $('.info-wrapper').height($('.info-tech').outerHeight());
    $('.big-data-wrapper').height($('.big-data').outerHeight());
    $('.rpa-wrapper').height($('.rpa').outerHeight());
    $('.setores-wrapper').height($('.setores').outerHeight());

    big_data_wrapper_offset_top = $('.big-data-wrapper').offset().top - _globalViewportH + $_body.scrollTop();

    rpa_wrapper_offset_top = $('.rpa-wrapper').offset().top - _globalViewportH + $_body.scrollTop();
  }

  /*hover only nav links */
  function navLinksShowHide() {
    $hiddenMenuItems.hide();

    $menuItemsOnHover.hover(
      function () {
        $(this).next().fadeTo(1, 1);
      },
      function () {
        $(this).next().fadeTo(1, 0);
      }
    );
  }

  function resize() {

    absoluteItemsHeight();

    menuHeight = $('.items-wrapper').height() + 13;

    bodyHeight =
      $('.header').outerHeight() +
      $('.content').outerHeight() +
      $('.manifesto').outerHeight() +
      $('.info-tech').outerHeight() +
      $('.big-data').outerHeight() +
      $('.rpa').outerHeight() +
      $('.setores').outerHeight();

    // location.reload();
  }

  function home_scroll_rAF(status) {


    if (verge.inViewport($('.big-data-wrapper'))) {

      $('.switch').addClass('active-overlay');

      var scaledOpacityInfoTech = scaleBetween(
        $_body.scrollTop(), 0, 1,
        big_data_wrapper_offset_top,
        big_data_wrapper_offset_top + _globalViewportH
      );

      console.log(scaledOpacityInfoTech);

      $overlayInfoTech.css({
        opacity: function () {
          opacity = scaledOpacityInfoTech;
          return opacity;
        }
      });

      /*  TweenMax.to($overlayInfoTech, 0.2, {
         opacity: scaledOpacityInfoTech
       }); */

    };

    if (verge.inViewport($('.rpa-wrapper'))) {

      $('.switch').addClass('active-overlay');

      var scaledOpacityBigData = scaleBetween(
        $_body.scrollTop(), 0, 0.8,
        rpa_wrapper_offset_top,
        rpa_wrapper_offset_top + _globalViewportH
      );

      TweenMax.to($overlayBigData, 0.2, {
        opacity: scaledOpacityBigData
      });

    }

    var scaledTranslate = scaleBetween($_body.scrollTop(), 0, menuHeight, 0, bodyHeight);

    TweenMax.to($scrollHandler, 0.2, {
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
  };
}