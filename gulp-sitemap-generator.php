<?php
/**
 * Plugin Name: Gulp Sitemap Generator
 * Plugin URI: https://github.com/digitoimistodude/gulp-sitemap-generator
 * Description: Generate a JSON list of every page on a site so it can be used with gulp and uncss.
 * Author: Digitoimisto Dude Oy, Roni Laukkarinen
 * Author URI: https://github.com/digitoimistodude
 * Version: 1.0
 */

add_action('template_redirect', 'show_sitemap');

function show_sitemap() {
  if ( isset( $_GET['show_sitemap'] ) ) :
    $the_query = new WP_Query( array(
      'post_type' => 'any',
      'posts_per_page' => -1,
      'post_status' => 'publish',
    ) );
    $urls = array();

    while ($the_query->have_posts()) :
      $the_query->the_post();
      $urls[] = get_permalink();
    endwhile;

    die( json_encode( $urls ) );
  endif;
}
