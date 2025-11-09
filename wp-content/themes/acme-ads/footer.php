  <footer class="site-footer bg-light mt-5 py-4">
    <div class="container footer-inner d-flex flex-column flex-md-row justify-content-between align-items-center">
      <div>© <?php echo date("Y"); ?> <?php bloginfo('name'); ?></div>
      <div class="social">
        <a class="me-2" href="#" aria-label="twitter">Twitter</a>
        <a class="me-2" href="#" aria-label="linkedin">LinkedIn</a>
      </div>
    </div>
    <div class="container py-3">
      <?php acme_display_ad_zone('footer'); ?>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
