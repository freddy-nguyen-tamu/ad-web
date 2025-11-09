<?php
/**
 * Acme Ads Theme Functions - upgraded
 * - CPT "ad"
 * - ad zones + rotation APIs
 * - admin analytics
 * - Bootstrap, Chart.js, ads JS
 */

if ( ! function_exists( 'acme_setup' ) ) {
    function acme_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'custom-logo' );
        add_theme_support( 'post-thumbnails' );
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'acme-ads' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'acme_setup' );

/* ---------------------------
   Enqueue styles & scripts
   --------------------------- */
function acme_enqueue_scripts() {
    // Theme stylesheet
    wp_enqueue_style( 'acme-style', get_stylesheet_uri(), array(), '1.0' );

    // Bootstrap 5 (CDN)
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2' );
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true );

    // Chart.js for admin analytics
    wp_enqueue_script( 'chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '4.4.1', true );

    // Theme ads JS
    wp_enqueue_script( 'acme-ads-js', get_template_directory_uri() . '/js/ads.js', array('jquery'), '1.0', true );

    // Localize AJAX URL & nonce
    wp_localize_script( 'acme-ads-js', 'AcmeAds', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'acme_ads_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'acme_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'acme_enqueue_scripts' );

/* ---------------------------
   Register Ad Custom Post Type
   --------------------------- */
function acme_register_ad_cpt() {
    $labels = array(
        'name'               => 'Ads',
        'singular_name'      => 'Ad',
        'menu_name'          => 'Ads',
        'name_admin_bar'     => 'Ad',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Ad',
        'new_item'           => 'New Ad',
        'edit_item'          => 'Edit Ad',
        'view_item'          => 'View Ad',
        'all_items'          => 'All Ads',
        'search_items'       => 'Search Ads',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,            // not publicly queryable
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'supports'           => array('title','editor','thumbnail','excerpt'),
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-megaphone',
    );
    register_post_type( 'acme_ad', $args );
}
add_action( 'init', 'acme_register_ad_cpt' );

/* ---------------------------
   Ad meta: zone, cta_url, weight, active
   store impressions/clicks as postmeta: _acme_impr, _acme_clicks
   --------------------------- */

function acme_add_ad_meta_boxes() {
    add_meta_box( 'acme_ad_settings', 'Ad Settings', 'acme_ad_meta_box_cb', 'acme_ad', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'acme_add_ad_meta_boxes' );

function acme_ad_meta_box_cb( $post ) {
    wp_nonce_field( 'acme_save_ad_meta', 'acme_ad_meta_nonce' );
    $zone = get_post_meta( $post->ID, '_acme_zone', true );
    $cta  = get_post_meta( $post->ID, '_acme_cta', true );
    $weight = get_post_meta( $post->ID, '_acme_weight', true );
    $active = get_post_meta( $post->ID, '_acme_active', true );
    if ($weight === '') $weight = 1;
    ?>
    <p>
      <label>Zone:</label>
      <select name="acme_zone" class="widefat">
        <?php $zones = array('header','hero','sidebar','inline','footer'); ?>
        <?php foreach($zones as $z): ?>
          <option value="<?php echo esc_attr($z); ?>" <?php selected( $zone, $z ); ?>><?php echo ucfirst($z); ?></option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      <label>CTA URL:</label>
      <input type="url" name="acme_cta" value="<?php echo esc_attr($cta); ?>" class="widefat" />
    </p>
    <p>
      <label>Weight (rotation):</label>
      <input type="number" name="acme_weight" value="<?php echo esc_attr($weight); ?>" class="small-text" min="1" />
      <span class="description">Higher = shown more often</span>
    </p>
    <p>
      <label><input type="checkbox" name="acme_active" value="1" <?php checked( $active, '1' ); ?> /> Active</label>
    </p>
    <p>
      <strong>Impressions:</strong> <?php echo (int) get_post_meta( $post->ID, '_acme_impr', true ); ?><br/>
      <strong>Clicks:</strong> <?php echo (int) get_post_meta( $post->ID, '_acme_clicks', true ); ?>
    </p>
    <?php
}

function acme_save_ad_meta( $post_id ) {
    if ( ! isset( $_POST['acme_ad_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['acme_ad_meta_nonce'], 'acme_save_ad_meta' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( isset( $_POST['acme_zone'] ) ) update_post_meta( $post_id, '_acme_zone', sanitize_text_field( $_POST['acme_zone'] ) );
    if ( isset( $_POST['acme_cta'] ) ) update_post_meta( $post_id, '_acme_cta', esc_url_raw( $_POST['acme_cta'] ) );
    if ( isset( $_POST['acme_weight'] ) ) update_post_meta( $post_id, '_acme_weight', intval( $_POST['acme_weight'] ) );
    update_post_meta( $post_id, '_acme_active', isset($_POST['acme_active']) ? '1' : '0' );
}
add_action( 'save_post', 'acme_save_ad_meta' );

/* ---------------------------
   Utility: increment counters
   --------------------------- */
function acme_increment_meta( $post_id, $meta_key, $amount = 1 ) {
    $val = (int) get_post_meta( $post_id, $meta_key, true );
    $val += $amount;
    update_post_meta( $post_id, $meta_key, $val );
}

/* ---------------------------
   AJAX: return random ad for a zone
   --------------------------- */
function acme_ajax_get_random_ad() {
    check_ajax_referer( 'acme_ads_nonce', 'nonce' );

    $zone = isset($_REQUEST['zone']) ? sanitize_text_field( $_REQUEST['zone'] ) : '';
    if ( empty($zone) ) {
        wp_send_json_error('Missing zone');
    }

    // Query active ads for zone
    $args = array(
        'post_type' => 'acme_ad',
        'meta_query' => array(
            array(
                'key' => '_acme_zone',
                'value' => $zone,
            ),
            array(
                'key' => '_acme_active',
                'value' => '1',
            ),
        ),
        'posts_per_page' => -1,
    );
    $ads = get_posts($args);
    if ( empty($ads) ) {
        wp_send_json_error('No ads');
    }

    // Weighted selection
    $pool = array();
    foreach($ads as $ad){
        $w = max(1, (int) get_post_meta($ad->ID, '_acme_weight', true));
        for ($i=0;$i<$w;$i++) $pool[] = $ad;
    }
    $choice = $pool[array_rand($pool)];

    // increment impression
    acme_increment_meta( $choice->ID, '_acme_impr', 1 );

    // return ad data
    $data = array(
        'id' => $choice->ID,
        'title' => get_the_title($choice),
        'content' => apply_filters('the_content', $choice->post_content),
        'image' => get_the_post_thumbnail_url($choice->ID, 'large'),
        'cta' => get_post_meta($choice->ID, '_acme_cta', true),
    );
    wp_send_json_success($data);
}
add_action( 'wp_ajax_acme_get_random_ad', 'acme_ajax_get_random_ad' );
add_action( 'wp_ajax_nopriv_acme_get_random_ad', 'acme_ajax_get_random_ad' );

/* ---------------------------
   AJAX: record click
   --------------------------- */
function acme_ajax_record_click() {
    check_ajax_referer( 'acme_ads_nonce', 'nonce' );
    $ad_id = isset($_POST['ad_id']) ? intval($_POST['ad_id']) : 0;
    if ( ! $ad_id ) wp_send_json_error('Missing ad id');
    acme_increment_meta( $ad_id, '_acme_clicks', 1 );
    wp_send_json_success();
}
add_action( 'wp_ajax_acme_record_click', 'acme_ajax_record_click' );
add_action( 'wp_ajax_nopriv_acme_record_click', 'acme_ajax_record_click' );

/* ---------------------------
   Template helper: render ad HTML
   Usage: echo acme_render_ad($ad_or_id);
   --------------------------- */
function acme_render_ad( $ad ) {
    if ( is_numeric($ad) ) $ad = get_post($ad);
    if ( ! $ad || $ad->post_type !== 'acme_ad' ) return '';

    $id = $ad->ID;
    $title = get_the_title($ad);
    $content = apply_filters('the_content', $ad->post_content);
    $img = get_the_post_thumbnail_url($id, 'large');
    $cta = get_post_meta($id, '_acme_cta', true);
    ob_start();
    ?>
    <div class="acme-ad" data-ad-id="<?php echo esc_attr($id); ?>">
      <?php if ( $img ): ?>
        <div class="acme-ad-media">
          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" style="max-width:100%;height:auto;border-radius:8px;">
        </div>
      <?php endif; ?>
      <div class="acme-ad-body">
        <h4 class="acme-ad-title"><?php echo esc_html($title); ?></h4>
        <div class="acme-ad-content"><?php echo $content; ?></div>
        <?php if ( $cta ): ?>
          <p><a class="btn acme-ad-cta ad-click" href="<?php echo esc_url($cta); ?>" target="_blank" rel="nofollow noopener noreferrer" data-ad-id="<?php echo esc_attr($id); ?>">Learn more</a></p>
        <?php endif; ?>
      </div>
    </div>
    <?php
    return ob_get_clean();
}

/* ---------------------------
   Template tag to print a zone
   Usage: acme_display_ad_zone('hero');
   --------------------------- */
function acme_display_ad_zone( $zone = 'hero' ) {
    // Attempt to render a server-side ad to avoid flicker: choose one at random similar to AJAX logic
    $args = array(
        'post_type' => 'acme_ad',
        'meta_query' => array(
            array('key'=>'_acme_zone','value'=>$zone),
            array('key'=>'_acme_active','value'=>'1'),
        ),
        'posts_per_page' => -1,
    );
    $ads = get_posts($args);
    if (empty($ads)) {
        // fallback empty container
        echo '<div class="acme-ad-zone" data-zone="'.esc_attr($zone).'"></div>';
        return;
    }
    // pick weighted
    $pool = array();
    foreach($ads as $ad){
        $w = max(1, (int) get_post_meta($ad->ID, '_acme_weight', true));
        for ($i=0;$i<$w;$i++) $pool[] = $ad;
    }
    $choice = $pool[array_rand($pool)];
    // increment impression server-side too (we already do on AJAX; double-count avoided because AJAX will be used for rotation normally)
    acme_increment_meta( $choice->ID, '_acme_impr', 1 );

    echo '<div class="acme-ad-zone" data-zone="'.esc_attr($zone).'" data-ad-id="'.esc_attr($choice->ID).'">';
    echo acme_render_ad( $choice );
    echo '</div>';
}

/* ---------------------------
   Shortcode: [acme_hero]
   --------------------------- */
function acme_hero_shortcode( $atts ) {
    ob_start();
    acme_display_ad_zone('hero');
    return ob_get_clean();
}
add_shortcode( 'acme_hero', 'acme_hero_shortcode' );

/* ---------------------------
   Admin Analytics Page
   --------------------------- */
function acme_register_admin_page() {
    add_menu_page( 'Ad Analytics', 'Ad Analytics', 'manage_options', 'acme-ads-analytics', 'acme_admin_analytics_page', 'dashicons-chart-bar', 56 );
}
add_action( 'admin_menu', 'acme_register_admin_page' );

function acme_admin_analytics_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    // Query ads and their metrics
    $ads = get_posts(array('post_type'=>'acme_ad','posts_per_page'=>-1));
    $labels = array();
    $impr = array();
    $clicks = array();
    foreach($ads as $a){
        $labels[] = get_the_title($a);
        $impr[] = (int) get_post_meta($a->ID, '_acme_impr', true);
        $clicks[] = (int) get_post_meta($a->ID, '_acme_clicks', true);
    }
    ?>
    <div class="wrap">
      <h1>Ad Analytics</h1>
      <p>Basic impressions and clicks for your ads.</p>
      <canvas id="acmeChart" width="800" height="300"></canvas>
      <script>
        (function(){
          const labels = <?php echo wp_json_encode($labels); ?>;
          const impr = <?php echo wp_json_encode($impr); ?>;
          const clicks = <?php echo wp_json_encode($clicks); ?>;
          document.addEventListener('DOMContentLoaded', function(){
            const ctx = document.getElementById('acmeChart').getContext('2d');
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: labels,
                datasets: [
                  { label: 'Impressions', data: impr },
                  { label: 'Clicks', data: clicks }
                ]
              },
              options: {
                responsive: true,
                scales: {
                  y: { beginAtZero: true }
                }
              }
            });
          });
        })();
      </script>

      <h2>Top Ads (CTR)</h2>
      <table class="widefat">
        <thead><tr><th>Ad</th><th>Impr</th><th>Clicks</th><th>CTR</th></tr></thead>
        <tbody>
        <?php foreach($ads as $a): 
            $i = (int) get_post_meta($a->ID, '_acme_impr', true);
            $c = (int) get_post_meta($a->ID, '_acme_clicks', true);
            $ctr = $i ? round(($c/$i)*100,2) . '%' : '—';
        ?>
          <tr>
            <td><?php echo esc_html(get_the_title($a)); ?></td>
            <td><?php echo $i; ?></td>
            <td><?php echo $c; ?></td>
            <td><?php echo $ctr; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php
}

/* ---------------------------
   Misc: Tiny contact handling (simple AJAX backup)
   Shortcode: [acme_contact_form]
   --------------------------- */
function acme_contact_form_shortcode() {
    ob_start();
    ?>
    <form id="acme-contact-form" class="acme-contact-form">
      <div class="mb-3">
        <label>Name</label>
        <input name="name" required class="form-control" />
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" required class="form-control" />
      </div>
      <div class="mb-3">
        <label>Message</label>
        <textarea name="message" required class="form-control"></textarea>
      </div>
      <button class="btn" type="submit">Send</button>
      <div id="acme-contact-result" style="margin-top:10px;"></div>
    </form>
    <script>
    (function(){
      const form = document.getElementById('acme-contact-form');
      form.addEventListener('submit', function(e){
        e.preventDefault();
        const data = new FormData(form);
        data.append('action', 'acme_send_contact');
        data.append('nonce', AcmeAds.nonce);
        fetch(AcmeAds.ajax_url, { method: 'POST', body: data })
        .then(r=>r.json()).then(j=>{
          document.getElementById('acme-contact-result').textContent = j.success ? 'Message sent (via server).' : ('Error: '+(j.data||'unknown'));
          if (j.success) form.reset();
        });
      });
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'acme_contact_form', 'acme_contact_form_shortcode' );

function acme_ajax_send_contact() {
    check_ajax_referer( 'acme_ads_nonce', 'nonce' );
    $name = sanitize_text_field( $_POST['name'] ?? '' );
    $email = sanitize_email( $_POST['email'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );
    if ( empty($email) || empty($message) ) wp_send_json_error('Missing fields');
    // Simple email - in local dev this may not send; you can configure SMTP plugin in WP for production
    $to = get_option('admin_email');
    $subject = "Contact from site: $name <$email>";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $sent = wp_mail( $to, $subject, $body );
    if ( $sent ) wp_send_json_success();
    wp_send_json_error('Mail failed');
}
add_action( 'wp_ajax_acme_send_contact', 'acme_ajax_send_contact' );
add_action( 'wp_ajax_nopriv_acme_send_contact', 'acme_ajax_send_contact' );
