/*! --------------------------------------------------------------------
JAVASCRIPT "Burocratik's plugins - must have"

* @Version:    2.0.0 - 2014
* @author:     Burocratik (alexandre gomes - @alexrgomes)
* @email:      alex@burocratik.com, hello@burocratik.com
* @website:    http://www.burocratik.com
* @preserve
-----------------------------------------------------------------------*/

/*-----------------------------------------------------------------------
 * Javascript - Suport attribute
 * Jeremy keith
 -----------------------------------------------------------------------*/
 function elementSupportsAttribute(element,attribute){
     var test = document.createElement(element);
     if (attribute in test){return true;}else{return false;}
 }
/*-----------------------------------------------------------------------
 * clickTouchEvent - Click or Touch Event  :: © 2013 alexandre gomes
 * If is mobile uses ontouchend if not uses click: $element.on("clickTouchEvent",function(){....etc
 -----------------------------------------------------------------------*/
$.event.special.clickTouchEvent={setup:function(){var a=("ontouchend" in document)?"touchend":"click";$(this).on(a+".myclickTouchEvent",function(b){b.type="clickTouchEvent";$.event.handle.apply(this,[b])})},teardown:function(){$(this).off(".clickTouchEvent")}};

/*-----------------------------------------------------------------------
 * jQuery doTimeout: Like setTimeout, but better! - v1.0 - 3/3/2010
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 -----------------------------------------------------------------------*/
(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);

/*-----------------------------------------------------------------------
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 -----------------------------------------------------------------------*/
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

/*-----------------------------------------------------------------------
 * jQuery outside events - v1.1 - 3/16/2010
 * http://benalman.com/projects/jquery-outside-events-plugin/
 -----------------------------------------------------------------------*/
(function($,c,b){$.map("click dblclick mousemove mousedown mouseup mouseover mouseout change select submit keydown keypress keyup".split(" "),function(d){a(d)});a("focusin","focus"+b);a("focusout","blur"+b);$.addOutsideEvent=a;function a(g,e){e=e||g+b;var d=$(),h=g+"."+e+"-special-event";$.event.special[e]={setup:function(){d=d.add(this);if(d.length===1){$(c).bind(h,f)}},teardown:function(){d=d.not(this);if(d.length===0){$(c).unbind(h)}},add:function(i){var j=i.handler;i.handler=function(l,k){l.target=k;j.apply(this,arguments)}}};function f(i){$(d).each(function(){var j=$(this);if(this!==i.target&&!j.has(i.target).length){j.triggerHandler(e,[i.target])}})}}})(jQuery,document,"outside");

/*-----------------------------------------------------------------------
 * AnimatePNG (background) - infinit loop :: © 2012 alexandre gomes
 * requires  jQuery doTimeout: loop (0=false) :: function(step, frames, speed, loop)
 * All rights reserved.
 -----------------------------------------------------------------------*/
(function($) {
  $.fn.animatePNG = function(step, frames, speed, loop) {
    var index = 0;
    this.each(function(){
      var $t = $(this), nT=frames;

          $t.doTimeout('loop', speed, function(){
            index++;
        if(index == nT) {
          if(loop==0){return false;}else{index=0;}
        }
        $t.css("backgroundPosition", "-" + index*step + "px 0px");
            return true;
          });
      //end loop
      if(step==null){$t.doTimeout('loop')} //end loop

    })//end each
  };//end function
})(jQuery);

/*-----------------------------------------------------------------------
 * animateSpriteIMG  :: © 2015 @alexrgomes (alexandre gomes)
 * Requires  jQuery doTimeout:
 * CSS needed

 * Licensed under the MIT license
 * Default of a generic jquery Plugin: jQuery lightweight plugin boilerplate by author: @ajpiano
 *                                     (https://github.com/jquery-boilerplate)

 ****NOTAS: precisamospor a funcionar sem o outdated. Meter a fazer play novamente.
 -----------------------------------------------------------------------*/
;(function(defaults, $, window, document, undefined) {
    'use strict';

    $.extend({
        // Function to change the default properties of the plugin
        // Usage: jQuery.pluginSetup({property:'Custom value'});
        // animateSpriteIMGSetup : function(options) {
        //     return $.extend(defaults, options);
        // }
    }).fn.extend({
        // Usage: jQuery(selector).pluginName({property:'value'});
        animateSpriteIMG : function(options) {
            options = $.extend({}, defaults, options);

            return $(this).each(function() {
                //** PLUGIN LOGIC
                    var $el = $(this),
                        transX = 0,
                        transY = 0,
                        i = 1,
                        j = 1,
                        nTFrames = 1;

                //** animation
                $el.doTimeout("animation", options.speed, function(){
                    if ( i <= options.totalRow ) {
                        // columns
                        if ( j < options.totalColumn ) {
                            if ( nTFrames >= options.totalFrames) {
                                nTFrames = 1;
                                transX = 0;
                                transY = 0;
                                i = 1;
                                j = 1;
                                //no loop
                                if ( !options.loop ) {
                                    $el.attr("style","");
                                    return false;
                                }
                            }

                            transX = transX + options.widthFrame;
                            $el.css({
                                "transform": "translate3d(-"+ transX +"px, -"+ transY +"px, 0px)"
                            })
                            j += 1;
                        } else {
                            j = 1;
                            i +=1;
                            transY = transY + options.heightFrame;
                            transX = 0;
                        }

                    } else {
                        transX = 0;
                        transY = 0;
                        i = 1;
                        j = 1;
                    }
                    nTFrames += 1;
                    return true;

                })//END ANIMATION

                //CONDITONS COLLED BY METHODS
                if ( options.pause ) {
                    $el.doTimeout("animation");
                }

                if ( options.destroy ) {
                    $el.doTimeout("animation");
                    $el.attr("style","");
                }
            //END PLUGIN LOGIC (return each)
            });
        },

        pause : function( options )  {
            var $el = $(this);
            $el.animateSpriteIMG({
                pause: true
            });
            return $.extend(defaults, options);
            // Some logic , Calling the function: jQuery(selector).otherMethod(options);
        },
        destroy : function( options ) {
            var $el = $(this);
            $el.animateSpriteIMG({
                destroy: true
            });
            return $.extend(defaults, options);
        }
    });
})({
    widthFrame: 0,
    heightFrame: 0,
    totalFrames: 0,
    totalRow: 1,
    totalColumn:1,
    speed: 50,
    loop: false,
    pause: false,
    play: false,
    destroy: false
}, jQuery, window, document);

/********************************************************************************************
 **                                                                                       **
     =Scroll to page section SCROLL TO PAGE SECTION
     =Height - Width of viewport (sar antes o verge)
     =Reload Page
     =StopScroll
 **                                                                                       **
*********************************************************************************************/
$(document).on("click",".js-btn-goto", function(){
  var $this = $(this);
  var aux = $this.attr("data-go");
  var $elemento = $(""+aux+"");
  can_scroll = false;
  goTo($elemento, 280);
  $.doTimeout(1500, function(){
    can_scroll = true;
  })
  return false;
});//end click

/* +++ HEIGHT-WIDTH viewport (use insted verge) +++ */
function calculateHeight(){
    var H=$(window).height();
    return H;
}//end function

function calculateWidth(){
    var W=$(window).width();
    return W;
}//end function

/* +++ RELOAD PAGE +++ */
function reloadPage(){
    location.reload();
    return false;
}//end function

/* +++ STOP SCROLL (alternativa http://stackoverflow.com/a/4770179) +++ */
function stopPlayScroll(yesno){
    if(yesno){
        $(document).on("mousewheel DOMMouseScroll",function(e){preventDefault(e);}); /* for webkit and IE */
        var aux = $(document).scrollTop(); /* for Firefox + TAB & KEYS up down do not scroll in all browsers (ie9+ and safari can jump a little but stable) */
        $(document).on("scroll", function(e){
            $(document).scrollTop(aux);
            preventDefault(e);
        });
        $(document).on("touchmove", function(e){preventDefault(e);}) /* Mobile*/
    }else{
        $(document).off("mousewheel DOMMouseScroll");
        $(document).unbind("scroll");
        $(document).off("touchmove"); /*mobile*/
    }//end if
}//end function

function preventDefault(e) {
    e = e || window.event; /* IE7, IE8, Chrome, Safari */
    if(e.preventDefault) {e.preventDefault();} /* Chrome, Safari, Firefox */
    e.returnValue = false; /* IE7, IE8 */
}

/* +++ ScrollTO Vertical +++ */
function goTo($elemento){
  TweenMax.to(window, 1.5, {
    scrollTo: {
      y: $elemento
    },
    ease: Power4.easeOut
  });
};//end goTo

/********************************************************************************************
 **                                                                                       **
     =RESIZE IMAGES (live background: cover AND  object-fit: cover;)
      1. can work as a fallback for no-object-fit.
      2. needs a container, and not browser with and height (this way is more generic)
      3. test for vertical images (in responsive i can't get horiginal size of the pics)
 **                                                                                       **
*********************************************************************************************/
function resizeLikeCover($element){
    $element.each(function(){
        var $this = $(this);
        var picW = $this.width(),
            picH = $this.height(),
            picWH = picW/picH;
        var $picParent = $this.parent(),
             parentW = $picParent.width(),
             parentH = $picParent.height(),
             parentWH = parentW/parentH;
        if(parentW>parentH && parentWH>=picWH) {
          $this.css({width:parentW, height: "auto"});
          var difH=parseInt($this.css("height"))-parentH; //Centrar fotos - Y
          var auxH=parseInt(difH/2);
          $this.css({"top": -auxH, "left":0});

        } else {
          $this.css({width:"auto", height: parentH});
          var difW=parseInt($this.css("width"))-parentW; //Centrar fotos - X
          var auxW=parseInt(difW/2);
          $this.css({"left": -auxW, "top":0});
        }
    });//end each
}//end function resize

/********************************************************************************************
 **                                                                                       **
     =ENABLE/DISABLE SCROLL
 **                                                                                       **
*********************************************************************************************/

var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
  e = e || window.event;
  if (e.preventDefault)
      e.preventDefault();
  e.returnValue = false;
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
      preventDefault(e);
      return false;
  }
}

function disableScroll() {
  if (window.addEventListener) // older FF
      window.addEventListener('DOMMouseScroll', preventDefault, false);
  window.onwheel = preventDefault; // modern standard
  window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
  window.ontouchmove  = preventDefault; // mobile
  document.onkeydown  = preventDefaultForScrollKeys;
}

function enableScroll() {
  if (window.removeEventListener)
      window.removeEventListener('DOMMouseScroll', preventDefault, false);
  window.onmousewheel = document.onmousewheel = null;
  window.onwheel = null;
  window.ontouchmove = null;
  document.onkeydown = null;
}

/*-----------------------------------------------------------------------
 =FORMS VALIDADTE
 NOTE: changed to giv error on element and not parent
-----------------------------------------------------------------------*/
function validateForm($form) {

    $form.find(".formMsg").hide();
    var error = 0;
    $form.find(".required").each(function() {
        var $this = $(this);
        var defeito = this.defaultValue;
        error += check($this, defeito, error);
    }) //end each

    if($form.find(".password-confirm").length > 0) {
      $form.find(".password-confirm").each(function(){
        var $psw = $(this);
        error += validatePasswords($form, $psw);
      });

    }

    if (error > 0) {
        return false;
    } else {
        return true;
    }
} //end validate form

function resetForm($form) {
  var $formInputs = $form.find("input"),
      $formTextarea = $form.find("textarea");

  $formTextarea.each(function(){
    var $this = $(this);
    $this.removeClass("erro");
    $this.attr("value", "");
  });

  $formInputs.each(function(){
    var $this = $(this);
    $this.removeClass("erro");
    $this.attr("value","");
  });
}

//function check inputs
function check($this, defeito, error) {
  var error = 0;
    //Is checkbox
    if ($this.hasClass("check-box")) {
        if (!validateCheckBox($this)) {
          error += 1;
        }
    } //end has min length

    //has min length
    if ($this.hasClass("min-length")) { // has min length
        if (!validateLength($this)) {
          error += 1;
        }
    } //end has min length

    //has exact length
    if ($this.hasClass("exact-length")) { // has min length
        if (!validateExactLength($this)) {
          error += 1;
        }
    } //end has min length

    //has exact length
    if ($this.hasClass("month-credit-card")) { // has min length

        if (!validateCreditCardMonth($this)) {
          error += 1;
        }
    } //end has min length

    //has exact length
    if ($this.hasClass("year-credit-card")) { // has min length
        if (!validateCreditCardYear($this)) {
          error += 1;
        }
    } //end has min length

    //is an email
    if ($this.hasClass("email")) { // is this an email
        if (!validateEmail($this)) {
          error += 1;
        }
    } //end if mail

    //is an phone
    if ($this.hasClass("phone")) { // is is an email
        if (!validatePhone($this)) {
          error += 1;
        }
    } //end if mail

    //is an birthdate
    if ($this.hasClass("birthdate")) { // is is a birthdate
        if (!validateBirthdate($this)) {
          error += 1;
        }
    } //end if birthdate

    //is an number
    if ($this.hasClass("number")) { // is is a birthdate
        if (!validateNumbers($this)) {
          error += 1;
        }
    } //end if number

    //is an radio
    if ($this.hasClass("select")) { // is is a select

        if (!validateSelect($this)) {
            error += 1;
            $this.parent().addClass("erro");
         return error;
        } else {
            $this.parent().removeClass("erro");
           return error;
        }
    } //end if radio

    //is an captcha
    if ($this.hasClass("cap")) { // is is an email
        if ($this.val() == "" || $this.val() == defeito) {
            $this.parent().children("span").addClass("on");
            error += 1;
            $this.parent().addClass("erro");
            // return error;
        } else {
            $this.parent().children("span").removeClass("on");
            $this.parent().removeClass("erro");
            // return error;
        }
    } //end if mail

    //not empty field
    if ($this.val() == "" || $this.val() == defeito) {
      error += 1;
    }

    if(error > 0) {
      $this.addClass("erro");
      $this.parent(".input").addClass("erro");
    } else {
      $this.removeClass("erro");
      $this.parent(".input").removeClass("erro");
    }
    return error;
} //end function

//equal passwords validation
function validatePasswords($form, $input) {
  var value = '',
      error = 0;

  //check if is input focus
  if($input.length > 0)
    $input.addClass("first-focus");

  //search for password confirm
  $form.find(".password-confirm").each(function() {
    var $this = $(this);

    if( $this.val() == '' && !$this.hasClass("required") ) error = 0;
    if( $this.val() == '' && $this.hasClass("required") ) error +=1;
    if( $this.hasClass("min-length") && !validateLength($this) ){
      error += 1;
    }

    if(value == '')
      value = $this.val();
    else
      if( value == $this.val() )
        if( error > 0)
          error -= 1;
        else
          error = 0;
      else
        error += 1;

    if($this.hasClass("first-focus")){
      if(error > 0)
        $this.addClass("erro");
      else
        $this.removeClass("erro");
    }
  });


  return error;
}

// minimum length
function validateCheckBox($this) {

    if($this.is(":checked"))
      return true;
    else
      return false;
}

// minimum length
function validateLength($this) {
    var a = $this.val(),
        length = $this.attr("data-length");

    if(a.length >= length)
      return true;
    else
      return false;
}

// minimum length
function validateExactLength($this) {
    var a = $this.val(),
        length = $this.attr("data-length");

    if(a.length == length)
      return true;
    else
      return false;
}

// month
function validateCreditCardMonth($this) {
    var a = $this.val();

    if(a <= 12)
      return true;
    else
      return false;
}

// year
function validateCreditCardYear($this) {
    var a = $this.val(),
        d = new Date();
        n = d.getFullYear();
        n = n.toString().substr(2);

    if(a >= n && n <= 99)
      return true;
    else
      return false;
}

//email validation
function validateEmail($this) {
    var a = $this.val();

    var filter = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,15}$/i);
    if (filter.test(a)) {
        return true;
    } else {
        return false;
    }
}
//Phone validation
function validatePhone($this) {
    var a = $this.val();
    var filter = /^[+]?[0-9 ]{9,}$/;
    if (filter.test(a)) {
        return true;
    } else {
        return false;
    }
}
//Birthdate validation
function validateBirthdate($this) {
    var a = $this.val();
    var filter = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g;
    if (filter.test(a)) {
        return true;
    } else {
        return false;
    }
}
//Numbers validation
function validateNumbers($this) {
    var a = $this.val();
    var filter = /^[+-]?[0-9]{1,9}(?:\.[0-9]{1,2})?$/i;
    if (filter.test(a)) {
        return true;
    } else {
        return false;
    }
}
//Radio validation
function validateSelect($this) {
    $this.each(function() {
        var a = $this.attr('checked');
        if (a == 'checked') {
            return true;
        } else {
            return false;
        }
    });
}

////ONLY TYPE NUMBERS and , .
function onlyNumber(event) {
    if (event.shiftKey) {
        event.preventDefault();
    }
    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 188) {
    } else {
        if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
            }
        } else {
            if (event.keyCode < 96 || event.keyCode > 105) {
                event.preventDefault();
            }
        }
    }
} //end function
