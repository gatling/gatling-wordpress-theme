<?php

// Load includes

require_once get_template_directory() . '/includes/helpers.php';
require_once get_template_directory() . '/includes/styles.php';
require_once get_template_directory() . '/includes/scripts.php';
require_once get_template_directory() . '/includes/templating.php';
require_once get_template_directory() . '/includes/acf.php';

// Strip tags and echo field function

function strip_the_field($field, $tags) {
  echo strip_tags($field, $tags);
}

// Polylang

function my_pll_register_string(string $string) {
  pll_register_string($string, $string, "Theme: Gatling");
}

// Shortcut to get_template_directory_uri

function add_img_html($file) {
  $path = get_template_directory_uri() . '/assets/img/' . $file;
  echo $path;
}

// Custom post type USER STORIES

 $labels = array(
  'name'              => 'User stories',
  'singular_name'     => 'User story',
  'all_items'         => 'All stories',
  'view_item'         => 'View story',
);
$args = array(
  'labels'        => $labels,
  'public'        => true,
  'has_archive'   => true,
  'menu_position' => 5,
  'supports'      => ['title', 'editor', 'thumbnail'],
);

register_post_type('user-stories', $args);

//Custom post type RESOURCES
$labels = array(
	'name'              => 'Resources',
	'singular_name'     => 'Resource',
	'all_items'         => 'All resources',
	'view_item'         => 'View resource',
);
$args = array(
	'labels'        => $labels,
	'publicly_queryable' => false,
	'public'	=> true,
	'menu_position' => 5,
	'supports'			=> ['title'],
);

register_post_type('resources', $args);

//Taxonomy RESOURCES CAT
$labels = array(
	'name' =>  'Resources categories',
	'singular_name' => 'Resources Category',
	'menu_name' => 'Categories',
);

register_taxonomy('resources_cat', 'resources', array(
	'hierarchical' => false,
	'labels' => $labels,
  'show_ui' => true,
  'show_admin_column' => true,
  'meta_box_cb' => false,
));

// Post thumbnail

add_theme_support( 'post-thumbnails' );

// Read more link disable scroll

function remove_more_link_scroll( $link ) {
  $link = preg_replace( '|#more-[0-9]+|', '', $link );
  return $link;
}

add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

// Get WP Menu

function my_get_menu($location) {
  $menu_locations = get_nav_menu_locations();
  $hero_menu = $menu_locations[$location];
  $menu_items = wp_get_nav_menu_items( $hero_menu );

  $menu_ordered = array();

  foreach ($menu_items as $item) {
    if ($item->menu_item_parent == 0) {
      $menu_ordered[$item->ID] = $item;
      $menu_ordered[$item->ID]->children = array();
    } else {
      $menu_ordered[$item->menu_item_parent]->children[] = $item;
    }
  }


  return $menu_ordered;
}

function nnki_get_menu($location) {
  $menu_locations = get_nav_menu_locations();
  $hero_menu = $menu_locations[$location];
  $menu_items = wp_get_nav_menu_items( $hero_menu );
  
  $menu_ordered = array();

  $parent = null;
  $parent_int = null;

  foreach ($menu_items as $item) {
    if ($item->menu_item_parent == 0) {
      $menu_ordered[$item->ID] = $item;
      $menu_ordered[$item->ID]->children = array();
      $parent = $item;
    } else {
      if ($item->menu_item_parent == $parent->ID) {
        $menu_ordered[$parent->ID]->children[$item->ID] = $item;
        $menu_ordered[$parent->ID]->children[$item->ID]->children = array();
        $parent_int = $item;
      } else if ($item->menu_item_parent == $parent_int->ID) {
        $menu_ordered[$parent->ID]->children[$parent_int->ID]->children[] = $item;
      }
    }
  }  

  return $menu_ordered;
}

function is_child_active($menu_item, $page_url) {
  foreach($menu_item->children as $child) {
    if ($child->url == $page_url) {
      return true;
    }
  }
  return false;
}

function is_grandchild_active($menu_item, $page_url) {
  foreach($menu_item->children as $child) {
    foreach($child->children as $subchild) {
      if ($subchild->url == $page_url) {
        return true;
      }
    }    
  }
  return false;
}

// Remove admin bar inline css

function wl_get_header() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('get_header', 'wl_get_header');

// Init WP site

function init_site() {
  register_nav_menus(
    array(
      'main-nav' => "Main menu",
      'footer-1' => "Footer menu 1",
      'footer-2' => "Footer menu 2"
    )
  );
}

add_action('init', 'init_site');