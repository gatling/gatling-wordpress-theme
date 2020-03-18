<?php
// ACF Option page
if ( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Options du thème');
}

// Add custom ACF taxonomy field
function change_post_taxonomy( $post_id ) {
  // bail if no ACF data
  if ( empty($_POST['acf']) ) {
      return;
  }
  
  // Limit to certain post types if needed
  if(get_post_type($post_id) == 'resources') {
    
    $term_ids = array();
  
    // get term id from $post_id
    $stored_cat = wp_get_post_terms($post_id, 'resources_cat');
    
    // get submitted value from acf form by field key
    $posted_cat = $_POST['acf']['field_5e722bd52dfb8'];
    
    // get term_id for the submitted value(s)	  
    $term = get_term_by( 'slug', $posted_cat, 'resources_cat' );
    $term_id = $term->term_id;
    
    // if stored value(s) is/are not equal to posted value(s), then update terms
    if ( $stored_cat != $posted_cat ) {
        wp_set_object_terms( $post_id, $term_id, 'resources_cat' );
    }
  }
}
add_action('acf/save_post', 'change_post_taxonomy', 20);

