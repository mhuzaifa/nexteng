<?php $mobile_info = buro_get_mobile(); ?>


<footer class="footer" role="contentinfo">

</footer>


<!-- MODAL -->
<div id="modal-bg"></div>
<div id="modal-wrapper"> <div id="modal-content"></div></div>
<!-- TRANSITION -->
<div id="loading-page" aria-hidden="true"></div>

<!-- outdated browser  -->
<div id="outdated">
  <h6>Your browser is out of date!</h6>
  <p>Update your browser to view this website correctly. <a id="btnUpdateBrowser" href="http://outdatedbrowser.com/">Update my browser now </a></p>
  <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
<!-- end #outdated browser  -->
</div>

<!-- ============= SCRIPTS ============= -->
<!--[if lt IE 9]>
    <script src="public/js/plugins_default/jquery-1.8.min.js"></script>
<![endif]-->
<!--[if (gte IE 9) | (!IE)]><!-->
    <script src="/public/js/plugins_default/jquery/dist/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="public/js/plugins_default/jquery/dist/jquery.js"><\/script>')</script>
    <script src="/public/js/jquery-migrate-1.2.1.js"></script>
<!--<![endif]-->
<?php if (ENVIRONMENT == 'development' ): ?>
    <script src="/public/js/plugins_default/bower_components/Tocca.js/Tocca.min.js"></script>
    <script src="/public/js/plugins_default/bower_components/jquery.easing/js/jquery.easing.min.js"></script>
    <script src="/public/js/plugins_default/bower_components/gsap/src/minified/TweenMax.min.js"></script>
    <script src="/public/js/plugins_default/bower_components/gsap/src/minified/plugins/CSSRulePlugin.min.js"></script>
    <script src="/public/js/plugins_default/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>
    <script src="/public/js/plugins_default/bower_components/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="/public/js/plugins_default/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="/public/js/plugins_default/bower_components/requestAnimationFrame/app/requestAnimationFrame.js"></script>
    <script src="/public/js/plugins_default/bower_components/svg4everybody/lib/svg4everybody.js"></script>
    <script src="/public/js/plugins_default/bower_components/verge/verge.js"></script>
    <script src="/public/js/plugins_default/bower_components/outdated-browser/outdatedbrowser/outdatedbrowser.js"></script>
    <script src="/public/js/plugins_default/burocratik-default.js"></script>

    <script src="/public/js/main-engine.js"></script>
<?php else: ?>
    <script src="/public/scripts/burocratik-workers.min.js"></script>
    <script src="/public/scripts/main-engine.min.js"></script>
<?php endif; ?>

<!-- ANALYTICS -->
<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-???????', 'auto');
  ga('send', 'pageview');
</script> -->
<!-- end #ANALYTICS -->
</body>
</html>

