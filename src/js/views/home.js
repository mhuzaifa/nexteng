function homePage() {
  /*Variables*/
  var menuHeight = $('.items-wrapper').height() + 13,
    bodyHeight = $('.header').outerHeight() +
    $('.content').outerHeight() + $('.manifesto').outerHeight() +
    $('.info-tech').outerHeight() +
    $('.big-data').outerHeight() +
    $('.rpa').outerHeight() +
    $('.setores').outerHeight();

  /*DOM variables*/
  var $scrollHandler = $('.scroll-handler');
  var $hiddenMenuItems = $('.menu-light .scroll-item .link-text, .menu-full.manif .scroll-item .link-text');
  var $menuItemsOnHover = $('.menu-light .scroll-anchor, .menu-full.manif .scroll-anchor');

  var init = function () {

    $('.manifesto-wrapper').height($('.manifesto').outerHeight());
    $('.info-wrapper').height($('.info-tech').outerHeight());
    $('.big-data-wrapper').height($('.big-data').outerHeight());
    $('.rpa-wrapper').height($('.rpa').outerHeight());
    $('.setores-wrapper').height($('.setores').outerHeight());

    $hiddenMenuItems.hide();

    $menuItemsOnHover.hover(
      function () {
        $(this).next().fadeTo(1, 1);
      },
      function () {
        $(this).next().fadeTo(1, 0);
      }
    );

    // $(".links li").on("click", function () {
    //   var target_offset = $($(this).attr("data-target")).offset().top;
    //   console.log(target_offset)
    //   TweenLite.to($_body, 10, {
    //     scrollTo: {
    //       y: target_offset
    //     }
    //   });
    // })



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
    console.log('home page');

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

  }

  /*Anchor Link Smooth Scroll*/
  function smoothScroll() {

    var pageWrapper = $(".page-content"),
      $Navmenu = $(".menusss"),
      $window = $(window);

    $menu.on("click", "a", function () {
      var $this = $(this),
        href = $this.attr("href"),
        topY = $(href).offset().top;

      TweenMax.to($window, 1, {
        scrollTo: {
          y: topY,
          autoKill: true
        },
        ease: Power3.easeOut
      });

      return false;
    });

  };

  function resize() {
    menuHeight = $('.items-wrapper').height() + 13;
    bodyHeight = $('.header').outerHeight() +
      $('.content').outerHeight() + $('.manifesto').outerHeight() +
      $('.info-tech').outerHeight() +
      $('.big-data').outerHeight() +
      $('.rpa').outerHeight() +
      $('.setores').outerHeight();
  }

  function home_scroll_rAF(status) {
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