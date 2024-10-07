<?php
/**
 * Child theme main functions
 *
 * @package Alpha
 */

/**
 * Enqueue styles
 *
 * @return void
 */
function alpha_child_enqueue_styles() {
	$parenthandle = 'alpha-parent-style';
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get( 'Version' ) );
	wp_enqueue_style( 'alpha-child-style', get_stylesheet_uri(), array( $parenthandle ), $theme->get( 'Version' ) );
	//load donate-form.css only on donate and leadership conference pages
	if( is_page([4271, 6818, 7983])){
		wp_enqueue_style( 'donate', get_stylesheet_directory_uri() . '/css/donation-form.css', false, '', 'all');
	}
}
add_action( 'wp_enqueue_scripts', 'alpha_child_enqueue_styles' );

function alpha_child_load_js() {
	if (is_page( 4271 )) {
		wp_register_script( 'donate', get_stylesheet_directory_uri() . '/js/donate.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'donate' );
	} else if (is_page('ukraine')) {
		wp_register_script( 'ukraine_donate', get_stylesheet_directory_uri() . '/js/ukraine-donate.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'ukraine_donate' );
	}
	 else if (is_page( 6818 )) {
		wp_register_script( 'lc_donate', get_stylesheet_directory_uri() . '/js/lc-donate.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'lc_donate' );
	}
	else if (is_page( 7983 )) {
		wp_register_script( 'ays_donate', get_stylesheet_directory_uri() . '/js/ays-donate.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'ays_donate' );
};

	wp_register_script('osano', 'https://cmp.osano.com/AzZcqLRx57D0c6Gv/dde941b7-a2df-401e-968f-216e585dafcd/osano.js', array('jquery'), '', false);
	wp_enqueue_script( 'osano' );
}

add_action(	'get_header', 'alpha_child_load_js' );
