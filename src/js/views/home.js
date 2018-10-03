function homePage() {

  

  /*Variables*/
 

  /*DOM variables*/
  

  var init = function() {

    if(_customScroll == null) {
      /*Attach the event with a reference to kill after exit */
      _scrollRef = function() { _raf_loop_id = _rAF_loop( home_scroll_rAF ); }
      $_window[0].addEventListener("scroll", _scrollRef, { passive: true } );
    }
    else {
      _page_scroll_listener = function(status) {
        home_scroll_rAF(status);
      };

      _customScroll.addListener(_page_scroll_listener);
    }
    console.log("home page");

    /*inits*/
    

    //Events
    initEvents();
  }

  var kill = function() {
    //Kill Events

    _scrollRef = null;
    cancelAnimationFrame(_raf_main_id);

    if(_customScroll)
      _customScroll.removeListener(_page_scroll_listener);
  }

  /*page functions*/
 

  function initEvents() {
   
  }


  function home_scroll_rAF(status) {
   
  }

  return {
    init: init,
    kill: kill
  }
}