<footer class="footer" role="contentinfo">

</footer>

</div>
<!--scroll-content-wrapper-->

<!-- TRANSITION -->
<div id="loading-page" class="js-loading-page" aria-hidden="true"></div>

<!-- outdated browser  -->
<div id="outdated">
    <h6>Your browser is out of date!</h6>
    <p>Update your browser to view this website correctly. <a id="btnUpdateBrowser" href="http://outdatedbrowser.com/">Update
            my browser now </a></p>
    <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
    <!-- end #outdated browser  -->
</div>

<!-- ============= SCRIPTS ============= -->
<!--[if lt IE 9]>
    <script src="public/scripts/jquery-1.8.min.js"></script>
<![endif]-->
<!--[if (gte IE 9) | (!IE)]><!-->
<script src="/public/scripts/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="/public/scripts/jquery.min.js"><\/script>')
</script>
<!-- <script src="/public/js/plugins_default/jquery-migrate/jquery-migrate.min.js"></script> -->
<!--<![endif]-->

<?php if (defined('ENVIRONMENT')) : ?>
<?php if (ENVIRONMENT == 'development' ): ?>
<script src="/public/scripts/buro-workers.js"></script> 
<script src="/public/scripts/main-engine.js"></script>
<?php else: ?>
<script src="/public/scripts/buro-workers.min.js"></script>
<script src="/public/scripts/main-engine.min.js"></script>
<?php endif; ?>
<?php else : ?>
<script src="/public/scripts/buro-workers.min.js"></script>
<script src="/public/scripts/main-engine.min.js"></script>
<?php endif; ?>

<!-- ANALYTICS -->
<script>
    // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    // ga('create', 'UA-XXXXXX-1', 'auto');
    // ga('send', 'pageview');
</script>

<!-- end #ANALYTICS -->
<script id="__bs_script__">
    //<![CDATA[
    document.write("<script async src='http://HOST:3008/browser-sync/browser-sync-client.js?v=2.24.7'><\/script>".replace(
        "HOST", location.hostname));
    //]]>
</script>
</body>

</html>