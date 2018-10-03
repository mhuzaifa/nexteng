

// https://stackoverflow.com/a/31687097/3203138
Array.prototype.scaleBetween = function(scaledMin, scaledMax) {
  var max = Math.max.apply(Math, this);
  var min = Math.min.apply(Math, this);
  return this.map(
    function(num) {
      return (scaledMax-scaledMin)*(num-min)/(max-min)+scaledMin
    }
  );
}

// function scaleBetween(arr, scaledMin, scaledMax) {
//   var max = Math.max.apply(Math, arr);
//   var min = Math.min.apply(Math, arr);
//   return arr.map(num => (scaledMax-scaledMin)*(num-min)/(max-min)+scaledMin);
// }

/**
 * Prevent body scroll and overscroll.
 * Tested on mac, iOS chrome / Safari, Android Chrome.
 *
 * Based on: https://benfrain.com/preventing-body-scroll-for-modals-in-ios/
 *           https://stackoverflow.com/a/41601290
 *
 * Use in combination with:
 * html, body {overflow: hidden;}
 *
 * and: -webkit-overflow-scrolling: touch; for the element that should scroll.
 *
 * disableBodyScroll(true, '.i-can-scroll');
 */
var disableBodyScroll = (function () {
    /**
     * Private variables
     */
    var _selector = false,
        _element = false,
        _clientY;

    /**
     * Polyfills for Element.matches and Element.closest
     */
    if (!Element.prototype.matches)
        Element.prototype.matches = Element.prototype.msMatchesSelector ||
        Element.prototype.webkitMatchesSelector;

    if (!Element.prototype.closest)
        Element.prototype.closest = function (s) {
            var ancestor = this;
            if (!document.documentElement.contains(el)) return null;
            do {
                if (ancestor.matches(s)) return ancestor;
                ancestor = ancestor.parentElement;
            } while (ancestor !== null);
            return el;
        };

    /**
     * Prevent default unless within _selector
     *
     * @param  event object event
     * @return void
     */
    var preventBodyScroll = function (event) {
        if (false === _element || !event.target.closest(_selector)) {
            event.preventDefault();
        }
    };

    /**
     * Cache the clientY co-ordinates for
     * comparison
     *
     * @param  event object event
     * @return void
     */
    var captureClientY = function (event) {
        // only respond to a single touch
        if (event.targetTouches.length === 1) {
            _clientY = event.targetTouches[0].clientY;
        }
    };

    /**
     * Detect whether the element is at the top
     * or the bottom of their scroll and prevent
     * the user from scrolling beyond
     *
     * @param  event object event
     * @return void
     */
    var preventOverscroll = function (event) {
        // only respond to a single touch
      if (event.targetTouches.length !== 1) {
        return;
      }

      var clientY = event.targetTouches[0].clientY - _clientY;

      // The element at the top of its scroll,
      // and the user scrolls down
      if (_element.scrollTop === 0 && clientY > 0) {
          event.preventDefault();
      }

      // The element at the bottom of its scroll,
      // and the user scrolls up
    // https://developer.mozilla.org/en-US/docs/Web/API/Element/scrollHeight#Problems_and_solutions
    if ((_element.scrollHeight - _element.scrollTop <= _element.clientHeight) && clientY < 0) {
          event.preventDefault();
      }

    };

    /**
     * Disable body scroll. Scrolling with the selector is
     * allowed if a selector is porvided.
     *
     * @param  boolean allow
     * @param  string selector Selector to element to change scroll permission
     * @return void
     */
    return function (allow, selector) {
      if (typeof selector !== "undefined") {
          _selector = selector;
          _element = document.querySelector(selector);
      }

        if (true === allow) {
          if (false !== _element) {
              _element.addEventListener('touchstart', captureClientY, { passive: false });
              _element.addEventListener('touchmove', preventOverscroll, { passive: false });
          }
            $("body, html").css("overflow", "hidden");
            document.body.addEventListener("touchmove", preventBodyScroll, { passive: false });
        } else {
          if (false !== _element) {
              _element.removeEventListener('touchstart', captureClientY, { passive: false });
              _element.removeEventListener('touchmove', preventOverscroll, { passive: false });
          }
            $("body, html").css("overflow", "");
            document.body.removeEventListener("touchmove", preventBodyScroll, { passive: false });
        }
    };
}());

/*
 * Easing Functions - inspired from http://gizma.com/easing/
 * only considering the t value for the range [0, 1] => [0, 1]
 https://gist.github.com/gre/1650294
 */


function linear(t) { return t };
function easeInQuad(t) { return t*t };
function easeOutQuad(t) { return t*(2-t) };
function easeInOutQuad(t) { return t<.5 ? 2*t*t : -1+(4-2*t)*t };
function easeInCubic(t) { return t*t*t };
function easeOutCubic(t) { return (--t)*t*t+1 };
function easeInOutCubic(t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 };
function easeInQuart(t) { return t*t*t*t };
function easeOutQuart(t) { return 1-(--t)*t*t*t };
function easeInOutQuart(t) { return t<.5 ? 8*t*t*t*t : 1-8*(--t)*t*t*t };
function easeInQuint(t) { return t*t*t*t*t };
function easeOutQuint(t) { return 1+(--t)*t*t*t*t };
function easeInOutQuint(t) { return t<.5 ? 16*t*t*t*t*t : 1+16*(--t)*t*t*t*t }
function exponentialOut(t) {return t == 1.0 ? t : 1.0 - Math.pow(2.0, -10.0 * t);}


//https://github.com/drojdjou/bartekdrozdz.com/blob/master/static/src/framework/VirtualScroll.js
var VirtualScroll = (function(document) {

  var vs = {};

  var numListeners, listeners = [], initialized = false;

  var touchStartX, touchStartY;

  // [ These settings can be customized with the options() function below ]
  // Mutiply the touch action by two making the scroll a bit faster than finger movement
  var touchMult = 2;
  // Firefox on Windows needs a boost, since scrolling is very slow
  var firefoxMult = 15;
  // How many pixels to move with each key press
  var keyStep = 120;
  // General multiplier for all mousehweel including FF
  var mouseMult = 1;

  var bodyTouchAction;

  var hasWheelEvent = 'onwheel' in document;
  var hasMouseWheelEvent = 'onmousewheel' in document;
  var hasTouch = 'ontouchstart' in document;
  var hasTouchWin = navigator.msMaxTouchPoints && navigator.msMaxTouchPoints > 1;
  var hasPointer = !!window.navigator.msPointerEnabled;
  var hasKeyDown = 'onkeydown' in document;

  var isFirefox = navigator.userAgent.indexOf('Firefox') > -1;

  var event = {
    y: 0,
    x: 0,
    deltaX: 0,
    deltaY: 0,
    originalEvent: null
  };

  vs.on = function(f) {
    if(!initialized) initListeners();
    listeners.push(f);
    numListeners = listeners.length;
  }

  vs.options = function(opt) {
    keyStep = opt.keyStep || 120;
    firefoxMult = opt.firefoxMult || 15;
    touchMult = opt.touchMult || 2;
    mouseMult = opt.mouseMult || 1;
  }

  vs.off = function(f) {
    listeners.splice(f, 1);
    numListeners = listeners.length;
    if(numListeners <= 0) destroyListeners();
  }

  var notify = function(e) {
    event.x += event.deltaX;
    event.y += event.deltaY;
    event.originalEvent = e;

    for(var i = 0; i < numListeners; i++) {
      listeners[i](event);
    }
  }

  var onWheel = function(e) {
    // In Chrome and in Firefox (at least the new one)
    event.deltaX = e.wheelDeltaX || e.deltaX * -1;
    event.deltaY = e.wheelDeltaY || e.deltaY * -1;

    // for our purpose deltamode = 1 means user is on a wheel mouse, not touch pad
    // real meaning: https://developer.mozilla.org/en-US/docs/Web/API/WheelEvent#Delta_modes
    if(isFirefox && e.deltaMode == 1) {
      event.deltaX *= firefoxMult;
      event.deltaY *= firefoxMult;
    }

    event.deltaX *= mouseMult;
    event.deltaY *= mouseMult;

    notify(e);
  }

  var onMouseWheel = function(e) {
    // In Safari, IE and in Chrome if 'wheel' isn't defined
    event.deltaX = (e.wheelDeltaX) ? e.wheelDeltaX : 0;
    event.deltaY = (e.wheelDeltaY) ? e.wheelDeltaY : e.wheelDelta;

    notify(e);
  }

  var onTouchStart = function(e) {
    var t = (e.targetTouches) ? e.targetTouches[0] : e;
    touchStartX = t.pageX;
    touchStartY = t.pageY;
  }

  var onTouchMove = function(e) {
    // e.preventDefault(); // < This needs to be managed externally
    var t = (e.targetTouches) ? e.targetTouches[0] : e;

    event.deltaX = (t.pageX - touchStartX) * touchMult;
    event.deltaY = (t.pageY - touchStartY) * touchMult;

    touchStartX = t.pageX;
    touchStartY = t.pageY;

    notify(e);
  }

  var onKeyDown = function(e) {
    // 37 left arrow, 38 up arrow, 39 right arrow, 40 down arrow
    event.deltaX = event.deltaY = 0;
    switch(e.keyCode) {
      case 37:
        event.deltaX = -keyStep;
        break;
      case 39:
        event.deltaX = keyStep;
        break;
      case 38:
        event.deltaY = keyStep;
        break;
      case 40:
        event.deltaY = -keyStep;
        break;
    }

    notify(e);
  }

  var initListeners = function() {
    if(hasWheelEvent) document.addEventListener("wheel", onWheel);
    if(hasMouseWheelEvent) document.addEventListener("mousewheel", onMouseWheel);

    if(hasTouch) {
      document.addEventListener("touchstart", onTouchStart);
      document.addEventListener("touchmove", onTouchMove);
    }

    if(hasPointer && hasTouchWin) {
      bodyTouchAction = document.body.style.msTouchAction;
      document.body.style.msTouchAction = "none";
      document.addEventListener("MSPointerDown", onTouchStart, true);
      document.addEventListener("MSPointerMove", onTouchMove, true);
    }

    if(hasKeyDown) document.addEventListener("keydown", onKeyDown);

    initialized = true;
  }

  var destroyListeners = function() {
    if(hasWheelEvent) document.removeEventListener("wheel", onWheel);
    if(hasMouseWheelEvent) document.removeEventListener("mousewheel", onMouseWheel);

    if(hasTouch) {
      document.removeEventListener("touchstart", onTouchStart);
      document.removeEventListener("touchmove", onTouchMove);
    }

    if(hasPointer && hasTouchWin) {
      document.body.style.msTouchAction = bodyTouchAction;
      document.removeEventListener("MSPointerDown", onTouchStart, true);
      document.removeEventListener("MSPointerMove", onTouchMove, true);
    }

    if(hasKeyDown) document.removeEventListener("keydown", onKeyDown);

    initialized = false;
  }

  return vs;
})(document);


function checkInViewHorizontal(item, offset, scroll) {
  if(offset = undefined)
    offset = 0;

  if(item.offsetX - offset  >= scroll + _globalViewportW  || item.offsetX + item.width - offset <= scroll )
    return false;
  else
    return true;
}

function normalizedValue(val, max, min) { return Number(((val - min) / (max - min)).toFixed(2)); }

function cover(srcW, srcH, targetW, targetH, contain) {
  var output = {};

  if (contain) {
    // https://opensourcehacker.com/2011/12/01/calculate-aspect-ratio-conserving-resize-for-images-in-javascript/
    var ratio = Math.min(targetW / srcW, targetH / srcH);
    output.width = srcW * ratio;
    output.height = srcH * ratio;
  } else {
    output.width = targetW;
    output.height = (srcH * targetW) / srcW;

    if (output.height < targetH) {
      output.width = (srcW * targetH) / srcH;
      output.height = targetH;
    }
  }

  output.left = Math.round((targetW - output.width) / 2);
  output.top = Math.round((targetH - output.height) / 2);

  return output;
}

function getBrowserInfo() {
  var obj = {
      isMobile : false,
      isTablet: false,
      isPhone: false,
      isDesktop: false,
      isPortrait: false,
      isLandscape: false,
      isSafari : false,
      isIE : false,
      isEdge : false,
      isChrome: false,
      isFirefox: false,
      isRetina: false,
      pixelRatio : 1,
      type : '',
      browser : ''
    }



  if($("body").hasClass("mobile")) {
    obj.isMobile = true;

    if($("body").hasClass("phone")){
      obj.isPhone = true;
      obj.type = 'phone';
    }
    else{
      obj.type = 'tablet';
      obj.isTablet = true;
    }

    if($("html").hasClass("firefox")){
      obj.browser = 'firefox';
      obj.isFirefox = true;
    }
    else if($("html").hasClass("chrome")){
      obj.browser = 'chrome';
      obj.isChrome = true;
    }
    else if($("html").hasClass("safari")) {
      obj.browser = 'safari';
      obj.isSafari = true;
    }
    else
      obj.browser = 'unknown';
  }
  else {
    obj.type = 'desktop';
    obj.isDesktop = true;

    if($("html").hasClass("firefox")) {
      obj.browser = 'firefox';
      obj.isFirefox = true;
    }
    else if($("html").hasClass("chrome")){
      obj.browser = 'chrome';
      obj.isChrome = true;
    }
    else if($("html").hasClass("safari")){
      obj.browser = 'safari';
      obj.isSafari = true;
    }
    else if($("html").hasClass("ie")){
      obj.browser = 'ie';
      obj.isIE = true;
    }
    else if($("html").hasClass("edge")) {
      obj.browser = 'edge';
      obj.isEdge = true;
    }
    else
      obj.browser = 'unknown';
  }

  if($("html").hasClass("orientation_landscape"))
    obj.isLandscape = true;

  if($("html").hasClass("orientation_portrait"))
    obj.isPortrait = true;

  obj.pixelRatio = window.devicePixelRatio;

  if(obj.pixelRatio >= 2)
    obj.isRetina = true;

  return obj;

}
