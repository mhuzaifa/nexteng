function homePage() {
  /*Variables*/

  /*DOM variables*/
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

    $('.sectors').scroll(function () {
      var alpha = Math.min(0.5 + 0.4 * $(this).scrollTop() / 210, 0.9);
      var channel = Math.round(alpha * 255);
      $('.sectors').css('background-color', 'rgb(' + channel + ',' + channel + ',' + channel + ')');
    });


    /*inits*/

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
    $_window.on('resize.homePage', resize);

    navLinkScroll();
    absoluteItemsHeight();
    navLinksShowHide();
  }

  /*Anchor Link Smooth Scroll*/
  function navLinkScroll() {
    $('.items-wrapper .scroll-item').on('click', function () {
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
  }

  function home_scroll_rAF(status) {

    if (verge.inViewport($('.sectors'), -50) && !$('.sectors').hasClass('js-inviewport')) {
      $('.sectors').addClass('js-inviewport');

    };

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