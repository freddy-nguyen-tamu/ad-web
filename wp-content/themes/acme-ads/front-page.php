<?php
/* Template Name: Front Page */
get_header();
?>

<!-- Ad Close Button Template -->
<template id="ad-close-template">
    <button class="acme-ad-close" aria-label="Close ad" title="Close this ad">
        ×
    </button>
</template>

<!-- Ad Toggle Button (initially hidden) -->
<button class="ad-toggle-button" aria-label="Show ad" title="Show ad" style="display: none;">
    📢
</button>

<main class="container my-4">
  <div class="row">
    <!-- Main Content Column -->
    <div class="col-lg-8">
      <section class="hero py-5 bg-light rounded-3 mb-4" id="home">
        <div class="hero-inner px-4">
          <div class="text-center">
            <h1 class="display-5 fw-bold"><?php echo get_theme_mod('acme_hero_heading', 'Grow faster with performance advertising'); ?></h1>
            <p class="lead text-muted mt-3"><?php echo get_theme_mod('acme_hero_sub', 'Targeted campaigns that increase leads and lower cost-per-acquisition.'); ?></p>
            <div class="mt-4">
              <a href="#contact" class="btn btn-primary btn-lg px-4">Get a free audit</a>
              <a href="#pricing" class="btn btn-outline-secondary btn-lg px-4 ms-2">See pricing</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Rest of your content remains the same -->
      <section id="services" class="py-5">
        <h2 class="text-center mb-5">Our Services</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
              <div class="card-body">
                <div class="mb-3">
                  <svg width="48" height="48" fill="currentColor" class="text-primary" viewBox="0 0 24 24">
                    <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                  </svg>
                </div>
                <h4 class="card-title h5">Paid Social</h4>
                <p class="card-text text-muted">Facebook & Instagram ad strategies that convert browsers to buyers.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
              <div class="card-body">
                <div class="mb-3">
                  <svg width="48" height="48" fill="currentColor" class="text-primary" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                  </svg>
                </div>
                <h4 class="card-title h5">Search Ads</h4>
                <p class="card-text text-muted">Google Ads campaigns with keyword optimizations and smart bidding.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
              <div class="card-body">
                <div class="mb-3">
                  <svg width="48" height="48" fill="currentColor" class="text-primary" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                  </svg>
                </div>
                <h4 class="card-title h5">Analytics</h4>
                <p class="card-text text-muted">Clear dashboards and tracking to know exactly what works.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="pricing" class="py-5 bg-light rounded-3">
        <div class="container">
          <h2 class="text-center mb-5">Simple Pricing</h2>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card h-100 text-center">
                <div class="card-header bg-white py-4">
                  <h3 class="h4">Starter</h3>
                  <div class="price h2 text-primary my-3">$500<span class="h6 text-muted">/month</span></div>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled mb-4">
                    <li class="mb-2">✓ Campaign setup</li>
                    <li class="mb-2">✓ Basic reporting</li>
                    <li class="mb-2">✓ Email support</li>
                  </ul>
                  <a class="btn btn-outline-primary w-100" href="#contact">Get Started</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 text-center border-primary shadow">
                <div class="card-header bg-primary text-white py-4">
                  <h3 class="h4">Growth</h3>
                  <div class="price h2 text-white my-3">$1,200<span class="h6 text-white-50">/month</span></div>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled mb-4">
                    <li class="mb-2">✓ A/B testing</li>
                    <li class="mb-2">✓ Conversion optimization</li>
                    <li class="mb-2">✓ Priority support</li>
                    <li class="mb-2">✓ Monthly strategy calls</li>
                  </ul>
                  <a class="btn btn-primary w-100" href="#contact">Get Started</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 text-center">
                <div class="card-header bg-white py-4">
                  <h3 class="h4">Enterprise</h3>
                  <div class="price h2 text-primary my-3">Custom</div>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled mb-4">
                    <li class="mb-2">✓ Dedicated strategist</li>
                    <li class="mb-2">✓ 24/7 priority support</li>
                    <li class="mb-2">✓ Custom integrations</li>
                    <li class="mb-2">✓ Advanced analytics</li>
                  </ul>
                  <a class="btn btn-outline-primary w-100" href="#contact">Contact Sales</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="about" class="py-5">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h2 class="mb-4">About Our Approach</h2>
            <p class="lead">We're a small team focused on measurable growth. We treat your budget like it's our own and show weekly progress reports.</p>
            <p>With over 5 years of experience in digital advertising, we've helped businesses of all sizes scale their online presence and drive real results.</p>
          </div>
          <div class="col-md-6">
            <div class="bg-light rounded-3 p-5 text-center">
              <div class="h1 text-primary mb-2">5+</div>
              <div class="h5">Years Experience</div>
              <div class="mt-4">
                <div class="h1 text-primary mb-2">250+</div>
                <div class="h5">Campaigns Managed</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="contact" class="py-5 bg-light rounded-3">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <h2 class="text-center mb-4">Get Your Free Audit</h2>
              <p class="text-center text-muted mb-5">Want a free audit or quote? Fill out the form below and we'll get back to you within 24 hours.</p>
              <?php echo do_shortcode('[acme_contact_form]'); ?>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Sidebar Column for Sticky Ad -->
    <div class="col-lg-4">
      <aside class="sidebar">
        <!-- Sticky Ad Container -->
        <div class="sticky-ad-container">
          <?php acme_display_ad_zone('sidebar'); ?>
        </div>
        
        <!-- Optional: Additional sidebar content -->
        <div class="mt-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
              <h5 class="card-title">Why Choose Us?</h5>
              <p class="card-text text-muted small">Proven track record of increasing ROI by 40% on average for our clients.</p>
              <div class="mt-3">
                <div class="d-flex justify-content-around">
                  <div>
                    <div class="h5 text-primary mb-1">98%</div>
                    <div class="small text-muted">Client Satisfaction</div>
                  </div>
                  <div>
                    <div class="h5 text-primary mb-1">40%</div>
                    <div class="small text-muted">Avg. ROI Increase</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ad = document.querySelector('.acme-ad[data-ad-id="15"]');
    const toggleButton = document.querySelector('.ad-toggle-button');
    
    if (ad) {
        // Add close button to the ad
        const closeButtonTemplate = document.getElementById('ad-close-template');
        const closeButton = closeButtonTemplate.content.cloneNode(true);
        
        // Wrap ad title in header and add close button
        const adTitle = ad.querySelector('.acme-ad-title');
        if (adTitle) {
            const adHeader = document.createElement('div');
            adHeader.className = 'acme-ad-header';
            adTitle.parentNode.insertBefore(adHeader, adTitle);
            adHeader.appendChild(adTitle);
            adHeader.appendChild(closeButton);
        } else {
            // Fallback: add close button to the top of the ad
            ad.insertBefore(closeButton, ad.firstChild);
        }
        
        // Close ad functionality
        ad.addEventListener('click', function(e) {
            if (e.target.closest('.acme-ad-close')) {
                e.preventDefault();
                ad.classList.add('ad-closed');
                toggleButton.classList.add('visible');
                
                // Store preference in localStorage
                localStorage.setItem('acme-ad-closed', 'true');
            }
        });
        
        // Show ad button functionality
        toggleButton.addEventListener('click', function() {
            ad.classList.remove('ad-closed');
            toggleButton.classList.remove('visible');
            
            // Remove preference from localStorage
            localStorage.removeItem('acme-ad-closed');
        });
        
        // Check if ad was previously closed
        if (localStorage.getItem('acme-ad-closed') === 'true') {
            ad.classList.add('ad-closed');
            toggleButton.classList.add('visible');
        }
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Find the specific ad in the hidden container
    const originalAdContainer = document.querySelector('.header-ad-original');
    const stickyAd = originalAdContainer.querySelector('.acme-ad[data-ad-id="15"]');
    
    if (stickyAd) {
        // Create a new container for the sticky ad
        const stickyContainer = document.createElement('div');
        stickyContainer.className = 'sticky-ad-wrapper';
        document.body.appendChild(stickyContainer);
        
        // Move the ad to the new container
        stickyContainer.appendChild(stickyAd);
        
        // Now apply the sticky styles
        stickyAd.style.position = 'fixed';
        stickyAd.style.top = '80px';
        stickyAd.style.right = '20px';
        stickyAd.style.width = '300px';
        stickyAd.style.zIndex = '9999';
        stickyAd.style.background = 'white';
        stickyAd.style.padding = '20px';
        stickyAd.style.borderRadius = '8px';
        stickyAd.style.boxShadow = '0 8px 30px rgba(0,0,0,0.15)';
        stickyAd.style.margin = '0';
        
        // Add close button functionality (your existing code)
        addCloseButtonToAd(stickyAd);
    }
});

function addCloseButtonToAd(ad) {
    // Your existing close button code here
    const closeButton = document.createElement('button');
    closeButton.className = 'acme-ad-close';
    closeButton.innerHTML = '×';
    closeButton.setAttribute('aria-label', 'Close ad');
    
    const adHeader = document.createElement('div');
    adHeader.className = 'acme-ad-header';
    const adTitle = ad.querySelector('.acme-ad-title');
    
    if (adTitle) {
        adTitle.parentNode.insertBefore(adHeader, adTitle);
        adHeader.appendChild(adTitle);
    }
    adHeader.appendChild(closeButton);
    
    closeButton.addEventListener('click', function() {
        ad.style.display = 'none';
        // Show toggle button logic here
    });
}
</script>

<?php get_footer(); ?>