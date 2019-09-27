<?php

$plezi_form_fields = array(
  '5d5188d4f420874ad39371d6' => array(
    'first_name' => 'sanitize_text_field',
    'last_name' => 'sanitize_text_field',
    'company' => 'sanitize_text_field',
    'email' => 'sanitize_email',
    'consents' => array('intval'),
    'content_web_form_id' => 'sanitize_text_field',
    'visit' => 'sanitize_text_field',
    'visitor' => 'sanitize_text_field',
  )
);

function gtl_send_error($status, $error, $error_description) {
  status_header($status);
  wp_send_json(array(
    'error' => $error,
    'error_description' => $error_description
  ));
}

function gtl_forms() {
  global $plezi_form_fields;

  if (!isset($_GET['form_id'])) {
    gtl_send_error(400, 'missing_parameter', 'Missing form_id parameter');
    return;
  }

  $form_id = sanitize_text_field($_GET['form_id']);
  if (empty($form_id) || !array_key_exists($form_id, $plezi_form_fields)) {
    gtl_send_error(400, 'invalid_parameter', 'Unknown form_id');
    return;
  }

  $args = array('form_id' => $form_id);
  foreach ($plezi_form_fields[$form_id] as $field_name => $value) {
    if (!array_key_exists($field_name, $_GET) || empty($_GET[$field_name])) {
      gtl_send_error(400, 'missing_parameter', "Missing $field_name parameter");
      return;
    }

    if (is_array($value)) {
      $subargs = array();
      foreach ($value as $index => $func) {
        array_push($subargs, $func($_GET[$field_name][$index]));
      }
      $args[$field_name] = $subargs;
    } else {
     $args[$field_name] = $value($_GET[$field_name]);
    }
  }

  $query = http_build_query($args);
  $url = "https://app.plezi.co/api/v1/create_contact_after_webform?$query";

  $response = wp_remote_get($url, array(
    'headers' => array(
      'Accept' => 'application/json',
      'Content-Type' => 'application/json', // application/x-www-form-urlencoded ?
      'X-API-Key' => 'rc5VX-it9yNVsmUbVNHb',
      'X-Tenant-Company' => 'Gatling'
    )
  ));

  wp_send_json(
    json_decode($response['body'])
  );
}

gtl_register_endpoint('gtl_forms');
