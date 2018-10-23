/*! -------------------------------------------------------------------------------------------
JAVASCRIPT main engine!

* @Version:    1.0 - 2016
* @author:     Burocratik
* @email:      hello@burocratik.com
* @website:    http://www.burocratik.com
* @preserve
NOTES:
:: js-no-ajax class on body (nao pode ser no html) > take it off with js as soon I work with ajax
:: js-no-ajax = did refresh
:: body.js-byrefresh= when i start by direct link (refresh) do no show content before loading
:: #loading-page.js-loading-page = i need separate byrefresh of this when I have js off
:: js-loading-page = can be used if I need a global style only when I am loading content
:: mobile = tag html is via js, tag body is via php (can't be on html tag or is deleted), also used for IE<=10
:: _global_allowNavigate = do not allow multiple cliks to load ajax (arrow, keys, click)
:: js-no-transPage = when I want a domain link with no transition ajax animation
--------------------------------------------------------------------------------------------*/
$(document).ready(function () {
  
  //** outdatedbrowser.com
  // Must be the first to be call or in older browsers IE6,7 will have weird js erros on my code, and the plugin will not work
  outdatedBrowser({
    bgColor: '#f25648',
    color: '#fff',
    lowerThan: 'borderImage',
    languagePath: ''
  });
  //** MODERNIZR not supporter properties
  Modernizr.addTest('backgroundcliptext', function () {
    var div = document.createElement('div');
    div.style.cssText = Modernizr._prefixes.join('background-clip:text;');
    return !!div.style.cssText.replace(/\s/g, '').length;
  });
  Modernizr.addTest('object-fit', !!Modernizr.prefixed('objectFit'));

  //BURO SIGNATURE CONSOLE
  if (navigator.userAgent.toLowerCase().indexOf("chrome") > -1 || navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
    var e = ["%c Made by Büro %c https://burocratik.com %c 🤘 %c\n",
      "color: #fff; background: #0020f4; padding:5px 0;",
      "color: #fff; background: #242424; padding:5px 0 5px 5px;",
      "background: #242424; padding:5px 0",
      "background: #242424; padding:5px 5px 5px 0"
    ];
    window.console.log.apply(console, e)
  } else {
    window.console && window.console.log("Made by Büro - https://burocratik.com")
  }
  /////////////////////////
}); //END LOAD DOCUMENT


/********************************************************************************************
 **                                                                                       **
      =LOADING PAGES, SECTIONS - =transitions between pages, =ajax
 **                                                                                       **
*********************************************************************************************/
//** MAIN LOAD
function loadPages(newContent, pageTransition, $thisElement) {

  var $currentPage = $(".page-main.page-current"),
    $nextContent = $(".page-main.page-next");

  $("html,body").addClass("fixed-all");
  $_body.removeClass('js-no-ajax'); // I am using =ajax
  $_body.addClass("js-loading-page"); // loading by ajax (removed onStartPage())

  if (pageTransition == undefined) {


    $nextContent.load(newContent + " .page-toload", function (response, status, xhr) {
      var $this = $(this);
      if (!$this.html()) { //=404
        window.location = newContent;
        return false;
      }

      if (_currentView) {
        _currentView.kill();
        _currentView = null;
      }

      $(".page-main.page-next .preload").imagesLoaded(function ($images, $proper, $broken) {
        var fPreload = $(this).imagesLoaded();
        fPreload.always(function () {
          manageBodyClasses();
          clearPagesAfterloading(0);
        });
      });
    });
  }

  return;
} //////end function main load content


function clearPagesAfterloading(delay) {
  var $currentPage = $(".page-main.page-current"),
    $nextContent = $(".page-main.page-next"); // can't be global

  $.doTimeout(delay, function () {
    $currentPage.remove();
    $nextContent.removeClass('page-next');
    $nextContent.addClass('page-current').removeAttr("aria-hidden");
    var $newCurrentPage = $(".page-main.page-current");
    $newCurrentPage.after('<div class="page-main page-next" aria-hidden="true"></div>');

    onStartPageWhenRefresh(false);
    $newCurrentPage.attr("style", "");
    window.scrollTo(0, 0);
    $("html,body").scrollTop(0);
  }) //end do timeout
} //end function

/********************************************************************************************
 **                                                                                       **
     =START EACH PAGE - refresh or ajax
 **                                                                                       **
*********************************************************************************************/
function onStartPageWhenRefresh(byRefresh) {
  if (byRefresh) {
    // :BUG CHROME: even wit this is not scrolling top is some section, needed hack after preloading with animate
    window.scrollTo(0, 0);
    $("html,body").scrollTop(0);
    //
    $("html,body").addClass("fixed-all");
    $_body.addClass('js-loading-page');
    $_body.removeClass("js-byrefresh");

    manageBodyClasses();

    $_toPreload.imagesLoaded(function ($images, $proper, $broken) {
      var fPreload = $(this).imagesLoaded();
      fPreload.always(function () {

        $("html,body").animate({
          scrollTop: 0
        }, 100); // :BUG CHROME: 100ms is arbitrary
        // $_toPreload.remove(); because i need for section name

        // if browser does not suport object-fit: cover
        if ($_html.hasClass("no-object-fit")) {
          var $element = $(".page-current .element-cover");
          resizeLikeCover($element);
        }

        if ($_html.hasClass("no-object-fit")) {
          var $element = $(".page-current .element-cover");
          resizeLikeCover($element);
        }

        ///
        TweenMax.to($_loadingPage, .6, {
          opacity: 0,
          ease: Power2.easeInOut,
          onComplete: function () {
            $("html,body").removeClass("fixed-all");
            $_loadingPage.removeClass('js-loading-page').hide();
            onStartPage();
          }
        });
      }); //end always
    }); //end preload images

    //for history: When your page loads, it might have a non-null state object and the page will receive an onload event, but no popstate event.
    //forPopstate=true;

  } else {
    onStartPage();
  }
} //////end function

/*-------------------------------------------------------------------------------------------
    =STARTPAGE - EACH PAGE - call of functions and events
--------------------------------------------------------------------------------------------*/
function onStartPage() {

  // ** =ALLOW user load other pages
  _global_allowNavigate = true;

  window.cancelAnimationFrame(_raf_loop_id);

  // ** =REMOVE classes of loading (if needed)
  $("html,body").removeClass("fixed-all");
  $_body.removeClass("js-loading-page");

  $_currentPage = $(".page-main.page-current"),
    $_toPreload = $(".preload"),
    $_loadingPage = $("#loading-page");

  $_pageHeader = $(".page-current .page-header");
  $_pageFooter = $(".page-current .page-footer");
  $_pageContent = $(".page-current .page-content");
  $_pageToLoad = $(".page-current .page-toload");


  if (_customScroll != null) {
    $.doTimeout(1000, function () {
      _customScroll.update();
    });

  }

  if (!_browserObj.isMobile) {
    if ($_scrollContentWrapper.attr("data-scrollbar") != undefined && !$_scrollContentWrapper.hasClass("js-scroll")) {
      _customScroll = Scrollbar.init($_scrollContentWrapper[0], {
        speed: 0.8,
        syncCallbacks: true
      });
      $_scrollContentWrapper.addClass("js-scroll");
    }
  } else {
    $(".scroll-content-wrapper").removeAttr("data-scrollbar");
  }

  if (_customScroll != null) {
    $(".loading-container").css({
      'top': 0
    });
    _customScroll.setPosition(0, 0);
    _customScroll.removeListener(_page_scroll_listener);
  }


  // **=POLYFILL ASYNC
  callAsyncFunctions();

  // **=Routing
  if ($_pageToLoad.hasClass("home-page")) {
    _currentView = homePage();
    _currentView.init();
  }

  // ** =scrolling events


  // ** =URL com ancoras onload
  var hasHash = window.location.hash;
  if (hasHash != "") {
    var $toGoHere = $("" + hasHash + "")
    $.doTimeout(500, function () {
      goTo($toGoHere, 1500, [0.7, 0, 0.3, 1], 0);
    });
    //
  }

  // ** =RESIZE ELEMENTS LIKE BACKGROUND COVER (browser does not support object-fit: cover)
  if ($_html.hasClass("no-object-fit")) {
    var $element = $(".page-current .element-cover");
    resizeLikeCover($element);
  }

} //////end function StartPage


/*******************************************************************************************
 **                                                                                       **
    =MAIN =NAVIGATION and FORM NEWSLETTER
 **                                                                                       **
*********************************************************************************************/
function mainNavigation() {


} // end function

/*******************************************************************************************
 ****                                                                                   ****
    =DOCUMENT =READY =START Document ready
 ****                                                                                   ****
*********************************************************************************************/
$(document).ready(function () {
  //** =Global objects
    $_window = $(window), 
    $_body = $("body"),
    $_html = $("html"),
    $_scrollContentWrapper = $(".scroll-content-wrapper"),
    $_mainPage = $(".page-main"),
    $_btn_nav_main = $(".btn-nav-main");

  $_headerMain = $("#header-main");
  $_hamburguerIcon = $(".hamburguer-icon");
  $_selectedWinesButton = $(".selected-wines-button");

  $_currentPage = $(".page-main.page-current"),
    $_toPreload = $(".preload"),
    $_loadingPage = $("#loading-page");

  $_pageHeader = $(".page-current .page-header");
  $_pageFooter = $(".page-current .page-footer");
  $_pageContent = $(".page-current .page-content");
  $_pageToLoad = $(".page-current .page-toload");

  _raf_main_id = -1;

  _page_scroll_listener = null;

  _currentView = null;

  _customScroll = null;

  _browserObj = getBrowserInfo();

  //** =Global variables
  _pageTransition = null;

  if ($_body.hasClass("mobile") && $_body.hasClass("phone")) {
    _isMobile = true;
    _isPhone = true;
  }
  if ($_body.hasClass("mobile") && !$_body.hasClass("phone")) {
    _isMobile = true;
    _isPhone = false;
  }

  //** =Global variables
  calculateGlobalValues();
  _global_allowNavigate = false; //When loading do not allow clicks by user ( onStartPage revers to true)
  _server_hostname = window.location.hostname;

  // Request Animation Frame
  _rAF_loop = window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    // IE Fallback, you can even fallback to onscroll
    function (callback) {
      window.setTimeout(callback, 1000 / 60)
    };

  _raf_loop_id = null;




  // VW/VH Unis fix for IOS
  // Usar esta CSS em todos os VH logo a seguir à medida VH (height: calc(var(--vh, 1vh) * 100);)
  var vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', vh + 'px');

  //** =START PAGES
  onStartPageWhenRefresh(true);
  mainNavigation();
  callAsyncFunctions();

  //Start Plugins
  //**OLD** FastClick.attach(document.body); //no 300ms tap delay!

  /** -----------------------------------------------------------------------------------------
  =LOAD SECTIONS - triger events =CLICK to LOAD PAGE
  body class="js-no-ajax ismobile" > inserida via php == no nosso caso a mobile
  --------------------------------------------------------------------------------------------*/
  var domainSite = window.location.host;
  var mainTitle = " | Kopke",
    homeTitle = $("a").attr("data-title-home");
  _forPopstate = true;
  $_linkInternal = $('a[href*="' + domainSite + '"]');

  $(document).on('click', 'a[data-remote="true"]', function () {
    var $this = $(this);

    // **ALLOW user load other pages only after page is loaded ( onStartPage )
    if (!_global_allowNavigate) return false;
    _global_allowNavigate = false;

    // exit and have normal click
    if ($_html.hasClass('mobile')) return true;
    if ($this.hasClass("modal") || $this.hasClass("js-no-transPage")) return;

    //
    var thisHref = $this.attr('href'),
      thisTitle = $this.attr("data-title"),
      pageTransition = $this.attr("data-pageTrans"),
      newContent = thisHref,
      forHistory = newContent,
      forTitle = thisTitle + mainTitle;

    //home page
    if (!thisTitle) {
      forTitle = homeTitle;
    }

    //for history
    if (_forPopstate) {
      history.pushState({}, forTitle, forHistory);
    }
    _forPopstate = true;

    // for title
    $('head title').html(forTitle);

    //ga('send', 'pageview', window.location.pathname); //analytics

    loadPages(newContent, pageTransition, $this);

    return false;
  }); //end click

  /// HISTORY
  //  note: Chrome and Safari will fire a popstate event when the page loads but Firefox doesnt. When your page loads, it might have a non-null state object and the page will receive an onload event, but no popstate event. (window.history.state; on refresh page)
  if (window.addEventListener) {
    window.addEventListener('popstate', function (e) {
      if ($_html.hasClass('mobile')) return false;
      if (!e.state) {
        _forPopstate = true;
        return false;
      } // firefox vs webkit and safari trigers on
      _forPopstate = false;
      window.location = window.location; // reload page for this new adress!
      return false;
    });
  } //endif: does not excute for <= IE8


  /* -------------------------------------------------------------------------------------------
  =EVENTS DEFAULT BURO
  -------------------------------------------------------------------------------------------- */
  //OPEN NEW WINDOW
  $(document).on("click", "a[rel=external]", function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();
    event.stopPropagation();
    var linkExterno = window.open($(this).attr("href"));
    return linkExterno.closed;
  })
  //PRINT
  $("a[rel=print]").click(function () {
    var imprimir = window.print();
    return false;
  })
  //E-MAIL: has classclass="email", e [-at-]
  $("a.email").each(function () {
    var mailReal = $(this).text().replace("[-at-]", "@");
    $(this).text(mailReal);
    $(this).attr("href", "mailto:" + mailReal);
  })
  //CLEAR FORMS
  $('input[type=text], input[type=email], input.text, input.email, textarea').each(function () {
    if (!$(this).hasClass("txtClear")) return;
    var defeito = this.defaultValue;
    $(this).focus(function () {
      if ($(this).val() == defeito) {
        $(this).val("")
      }
    });
    $(this).blur(function () {
      if ($(this).val() == "") {
        $(this).val(defeito)
      }
    });
  })
  //OPEN POPUP
  $(document).on("click", '.newWindow', function () {
    event.stopImmediatePropagation();
    event.preventDefault();
    event.stopPropagation();
    var newwindow = window.open($(this).attr('href'), '', 'height=480,width=560');
    if (window.focus) {
      newwindow.focus();
    }
    return false;
  })

  /*-------------------------------------------------------------------------------------------
  =KEYS
  --------------------------------------------------------------------------------------------*/
  $(document).on("keydown", function (event) {
    switch (event.which) {
      case 40: //down
        //return false;
        break;
      case 38: //up
        // return false;
        break;
      case 39: //next
        // return false;
        break;
      case 37: //prev
        // return false;
        break;
      case 27: //close (esc)
        //break
      default:
        break;
    } //end switch
  }); //end keypress

  /*-------------------------------------------------------------------------------------------
  =RESIZE on
  --------------------------------------------------------------------------------------------*/
  $_window.on('resize', $.debounce(500, function () {
    //** =recalculate global variables
    calculateGlobalValues();
    _browserObj = getBrowserInfo();

    if ($_html.hasClass("no-object-fit")) {
      var $element = $(".page-current .element-cover");
      resizeLikeCover($element);
    }

    // VW/VH Unis fix for IOS
    // Usar esta CSS em todos os VH logo a seguir à medida VH (height: calc(var(--vh, 1vh) * 100);)
    var vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', vh + 'px');

  })) //end resize window

  window.addEventListener("orientationchange", function () {
    $.doTimeout(500, function () {
      _browserObj = getBrowserInfo();
    })
  });

  /////////////////////////
}); //END LOAD DOCUMENT

/********************************************************************************************
 **                                                                                       **
     =FORMS AJAX SUBMITS
 **                                                                                       **
*********************************************************************************************/

function submitJSON(action, value, onSuccess, onError) {
  $.ajax({
    data: ({
      action: 'saveSimulatorData',
      value: value
    }),
    type: 'post',
    dataType: 'json',
    url: 'http://' + _server_hostname + '/wp-admin/admin-ajax.php',
    success: function (data) {
      onSuccess(data)
      console.log("success", data);
    },
    error: function (data) {
      onError(data)
      console.log("error", data);
    }
  });
}

function submitForm($form) {
  if (validateForm($form) && !$form.hasClass('sending')) {
    $form.addClass('sending');

    $.ajax({
      data: $form.serialize(),
      type: 'post',
      dataType: 'json',
      url: 'http://' + _server_hostname + '/wp-admin/admin-ajax.php',
      success: function (data) {
        $form.removeClass('sending');
      },
      error: function (data) {
        $form.removeClass('sending');
      }
    });
  }
}

/*******************************************************************************************
 **                                                                                       **
    =GENERAL FUNCTIONS AND PLUGINGS CONTROL
 **                                                                                       **
*********************************************************************************************/
/** =Global page values */
function calculateGlobalValues() {
  _globalViewportW = verge.viewportW();
  _globalViewportH = verge.viewportH();
  _globalHalfViewportH = (_globalViewportH / 2).toFixed(0);
}

/** =ASYNC PLUGINS (polyfill, etc) */
function callAsyncFunctions() {
  if (window.respimage) respimage();
}

/** =Random integer between min (included) and max (excluded) */
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

/** =Manage for added body and page classes */
function manageBodyClasses() {
  if ($_body.hasClass("js-no-ajax")) {
    $_body.addClass($(".page-main.page-current .page-toload").attr("data-bodyClass"));
  } else {
    $_body.removeClass($(".page-main.page-current .page-toload").attr("data-bodyClass"));
    $_body.addClass($(".page-main.page-next .page-toload").attr("data-bodyClass"));
  }
}

/*******************************************************************************************
 **                                                                                       **
    =globa1Animations
 **                                                                                       **
*********************************************************************************************/
function initGlobalAnimations() {
  if (_customScroll == null)
    _scrollLimit = $_html.height();
  else
    _scrollLimit = _customScroll.limit.y;

  _raf_main_id = _rAF_loop(animationLoop);

  animationLoop();

  function animationLoop() {
    _raf_main_id = _rAF_loop(animationLoop);

    if (_customScroll == null) {
      _scrollY = window.pageYOffset;

      var status = {
        offset: {
          y: -1
        }
      };
      status.offset.y = window.pageYOffset;

    } else {
      _scrollY = _customScroll.offset.y;
    }

    if (_lastScroll != _scrollY && _scrollY != 0 && !_blockAll) {

      if (_lastScroll < _scrollY)
        _scrollDirection = 'down';
      else
        _scrollDirection = 'up';

      _lastScroll = _scrollY;
    }
  }
}