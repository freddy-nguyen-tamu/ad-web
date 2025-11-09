<?php
/* Template Name: Front Page */
get_header();
?>

<main>
  <section class="hero py-5 bg-light" id="home">
    <div class="container hero-inner d-flex gap-4 align-items-center">
      <div class="hero-copy flex-fill">
        <h1 class="display-5"><?php echo get_theme_mod('acme_hero_heading', 'Grow faster with performance advertising'); ?></h1>
        <p class="lead text-muted"><?php echo get_theme_mod('acme_hero_sub', 'Targeted campaigns that increase leads and lower cost-per-acquisition.'); ?></p>
        <p class="mt-3">
          <a href="#contact" class="btn btn-primary btn-lg">Get a free audit</a>
          <a href="#pricing" class="btn btn-outline-secondary btn-lg ms-2">See pricing</a>
        </p>
      </div>
      <div class="hero-image" style="max-width:480px;">
        <?php
          // render hero ad zone (rotating)
          acme_display_ad_zone('hero');
        ?>
      </div>
    </div>
  </section>

  <section id="services" class="container py-5">
    <h2>Services</h2>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="card p-3 h-100">
          <h3>Paid Social</h3>
          <p>Facebook & Instagram ad strategies that convert browsers to buyers.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 h-100">
          <h3>Search Ads</h3>
          <p>Google Ads campaigns with keyword optimizations and smart bidding.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 h-100">
          <h3>Analytics</h3>
          <p>Clear dashboards and tracking to know exactly what works.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="pricing" class="py-5 bg-white">
    <div class="container">
      <h2>Pricing</h2>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card p-3">
            <h3>Starter</h3>
            <p class="h3">$500/month</p>
            <ul>
              <li>Campaign setup</li>
              <li>Basic reporting</li>
            </ul>
            <a class="btn btn-primary" href="#contact">Start</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3 border-primary">
            <h3>Growth</h3>
            <p class="h3">$1,200/month</p>
            <ul>
              <li>A/B testing</li>
              <li>Conversion optimization</li>
            </ul>
            <a class="btn btn-primary" href="#contact">Start</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h3>Enterprise</h3>
            <p class="h3">Custom</p>
            <ul>
              <li>Dedicated strategist</li>
              <li>Priority support</li>
            </ul>
            <a class="btn btn-primary" href="#contact">Start</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="container py-5">
    <h2>About</h2>
    <p>We’re a small team focused on measurable growth. We treat your budget like it's our own and show weekly progress reports.</p>
  </section>

  <section id="contact" class="container py-5">
    <h2>Contact</h2>
    <p>Want a free audit or quote? Use the form below.</p>
    <?php echo do_shortcode('[acme_contact_form]'); ?>
  </section>
</main>

<?php get_footer(); ?>
