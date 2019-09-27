<?php

function gtl_register_endpoint($endpoint) {
  add_action('wp_ajax_'.$endpoint, $endpoint);
  add_action('wp_ajax_nopriv_'.$endpoint, $endpoint);
}

require_once 'forms.php';
