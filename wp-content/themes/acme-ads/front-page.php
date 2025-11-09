<?php
/* Template Name: Front Page */
get_header();
?>

<main>
  <section class="hero" id="home">
    <div class="container hero-inner">
      <div class="hero-copy">
        <h1><?php echo get_theme_mod('acme_hero_heading', 'Grow faster with performance advertising'); ?></h1>
        <p><?php echo get_theme_mod('acme_hero_sub', 'Targeted campaigns that increase leads and lower cost-per-acquisition.'); ?></p>
        <p class="cta-row">
          <a href="#contact" class="btn large">Get a free audit</a>
          <a href="#pricing" class="btn ghost">See pricing</a>
        </p>
      </div>
      <div class="hero-image">
        <?php if ( get_header_image() ) : ?>
          <img src="<?php header_image(); ?>" alt="Hero image" />
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/hero.jpg" alt="Team working on advertising strategy" />
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section id="services" class="container section">
    <h2>Services</h2>
    <div class="grid features">
      <div class="card">
        <h3>Paid Social</h3>
        <p>Facebook & Instagram ad strategies that convert browsers to buyers.</p>
      </div>
      <div class="card">
        <h3>Search Ads</h3>
        <p>Google Ads campaigns with keyword optimizations and smart bidding.</p>
      </div>
      <div class="card">
        <h3>Analytics</h3>
        <p>Clear dashboards and tracking to know exactly what works.</p>
      </div>
    </div>
  </section>

  <section id="pricing" class="container section teal">
    <h2>Pricing</h2>
    <div class="grid pricing">
      <div class="card">
        <h3>Starter</h3>
        <p class="price">$500/month</p>
        <ul>
          <li>Campaign setup</li>
          <li>Basic reporting</li>
        </ul>
        <a href="#contact" class="btn">Start</a>
      </div>
      <div class="card featured">
        <h3>Growth</h3>
        <p class="price">$1,200/month</p>
        <ul>
          <li>A/B testing</li>
          <li>Conversion optimization</li>
        </ul>
        <a href="#contact" class="btn">Start</a>
      </div>
      <div class="card">
        <h3>Enterprise</h3>
        <p class="price">Custom</p>
        <ul>
          <li>Dedicated strategist</li>
          <li>Priority support</li>
        </ul>
        <a href="#contact" class="btn">Start</a>
      </div>
    </div>
  </section>

  <section id="about" class="container section">
    <h2>About</h2>
    <p>We’re a small team focused on measurable growth. We treat your budget like it's our own and show weekly progress reports.</p>
  </section>

  <section id="contact" class="container section contact">
    <h2>Contact</h2>
    <p>Want a free audit or quote? Email us or use the contact button.</p>
    <p>Email: <a href="mailto:hello@acme-ads.example?subject=Website%20Inquiry">hello@acme-ads.example</a></p>
    <p>Phone: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
    <p><a class="btn" href="mailto:hello@acme-ads.example?subject=Free%20Audit">Request free audit</a></p>
  </section>
</main>

<?php get_footer(); ?>
