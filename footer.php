  <?php wp_footer(); ?>

  <footer class="container container--footer">
    <div class="col col--three--quarters left cf">
      <div class="media">
        <a class="logo media__img" href="/" alt="Valley Church" title="Valley Church">
          <svg width="32" height="32" class="logo-mark-footer">
            <image xlink:href="<?php echo valleycdn(); ?>/img/icons/icon.svg" src="<?php echo valleycdn(); ?>/img/icons/icon.png" width="100%" height="100%" class="logo-mark-footer" />
          </svg>
        </a>
        <div class="copyright media__body">
          <p class="no-margin-bottom">&copy; Valley Church 2008&ndash;<?php echo date("Y"); ?>&mdash;Empowering A New Generation</p>
          <p><a href="http://freemethodist.org.uk" target="_blank">A Free Methodist UK Church</a> &bull; <a href="http://www.charitycommission.gov.uk/search-for-a-charity/?txt=1125080" target="_blank">Registered Charity No. 1125080</a> &bull; <a href="/privacy">Privacy &amp; Cookie Policy</a></p>
        </div>
      </div>
    </div>
    <div class="col col--quarter left">
      <?php get_search_form(); ?>
    </div>
  </footer>

  <!-- Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-34521921-1', 'valleychurch.eu');
    ga('send', 'pageview');
  </script>

  <!-- ClickTale Bottom part -->
  <script type='text/javascript'>
  // The ClickTale Balkan Tracking Code may be programmatically customized using hooks:
  // 
  //   function ClickTalePreRecordingHook() { /* place your customized code here */  }
  //
  // For details about ClickTale hooks, please consult the wiki page http://wiki.clicktale.com/Article/Customizing_code_version_2

  document.write(unescape("%3Cscript%20src='"+
  (document.location.protocol=='https:'?
  "https://clicktalecdn.sslcs.cdngc.net/www02/ptc/dad2ba83-7ce6-4b2d-8062-fabe404c1b26.js":
  "http://cdn.clicktale.net/www02/ptc/dad2ba83-7ce6-4b2d-8062-fabe404c1b26.js")+"'%20type='text/javascript'%3E%3C/script%3E"));
  </script>
  <!-- ClickTale end of Bottom part -->
</body>
</html>