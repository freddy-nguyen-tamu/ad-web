<?php
get_header();
if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
else :
  echo '<div class="container"><p>No content yet. Create pages in WP Admin.</p></div>';
endif;
get_footer();
?>
