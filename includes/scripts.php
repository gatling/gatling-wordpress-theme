<?php

function add_js_scripts() {
	
	if (!is_admin()) {
	
		//jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri().'/assets/js/jquery.min.js', '3.3.1', true);
		wp_enqueue_script('jquery');

		//fontawesome
		wp_register_script( 'fontawesome', get_template_directory_uri().'/assets/js/all.min.js?' . filemtime(get_template_directory() . '/assets/js/all.min.js'), '5.8.1', true );
		wp_enqueue_script('fontawesome');

		//slick
		wp_register_script( 'slick', get_template_directory_uri().'/assets/js/slick.min.js?' . filemtime(get_template_directory() . '/assets/js/slick.min.js'), array('jquery'), '1.8.1', true );
		wp_enqueue_script('slick');

		//prism
		wp_register_script( 'prism', get_template_directory_uri().'/assets/js/prism.min.js?' . filemtime(get_template_directory() . '/assets/js/prism.min.js'), '1.0', true );
		wp_enqueue_script('prism');

		//main JS
		wp_register_script( 'main', get_template_directory_uri().'/assets/js/main.min.js?' . filemtime(get_template_directory() . '/assets/js/main.min.js'), array('jquery'), '1.0', true );
		wp_enqueue_script('main');
	}
}

add_action('wp_enqueue_scripts', 'add_js_scripts');


?>
