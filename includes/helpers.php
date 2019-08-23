<?php

// Srcset helper

function gtl_image_with_srcset($image, $default = 'large') {
  $available_sizes = array('thumbnail', 'medium', 'large');

  $srcset = [];
  foreach ($available_sizes as &$size) {
    $link  = $image['sizes'][$size];
    $width = $image['sizes'][$size.'-width'];
    array_push($srcset, "$link {$width}w");
  }
  unset($size);

  $full_size_link = $image['url'];
  $full_size_width = $image['width'];
  array_push($srcset, "$full_size_link {$full_size_width}w");

  $srcset = implode(',', $srcset);

  if ($default === 'full' || !in_array($default, $available_sizes)) {
    $src = $full_size_link;
  } else {
    $src = $image['sizes'][$default];
  }

  return "<img src=\"$src\" srcset=\"$srcset\" alt=\"{$image['alt']}\">";
}

// Price comparison helper

$gtl_price_comparison_colors = [
  'defaults' => [
    'purple',
    'orange'
  ],
  502 => [ // AWS Marketplace
    'purple',
    'orange',
    'orange',
    'orange',
    'blue'
  ],
  4662 => [ // On-Premises
    'purple',
    'orange',
    'purple',
    'purple',
    'blue'
  ]
];

function gtl_price_comparison_color($index) {
  global $gtl_price_comparison_colors;
  global $post;

  if (!empty($post) && isset($gtl_price_comparison_colors[$post->ID])) {
    $colors = $gtl_price_comparison_colors[$post->ID];
  } else {
    $colors = $gtl_price_comparison_colors['defaults'];
  }

  return isset($colors[$index]) ? $colors[$index] : 'blue';
}
