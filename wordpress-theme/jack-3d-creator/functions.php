<?php
/**
 * Jack 3D Creator — theme setup, assets and helpers.
 *
 * @package Jack_3D_Creator
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'JACK3D_VERSION', '1.0.0' );

/**
 * Theme supports and menus.
 */
function jack3d_setup() {
	load_theme_textdomain( 'jack-3d-creator', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu (one-page anchors)', 'jack-3d-creator' ),
		)
	);
}
add_action( 'after_setup_theme', 'jack3d_setup' );

/**
 * Content width.
 */
function jack3d_content_width() {
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'jack3d_content_width', 0 );

/**
 * Enqueue styles and scripts.
 */
function jack3d_scripts() {
	// Kanit, weights 300-900.
	wp_enqueue_style(
		'jack3d-fonts',
		'https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'jack3d-style', get_stylesheet_uri(), array( 'jack3d-fonts' ), JACK3D_VERSION );

	wp_enqueue_script(
		'jack3d-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		JACK3D_VERSION,
		true
	);

	wp_localize_script(
		'jack3d-theme',
		'jack3dSettings',
		array(
			'magnetStrength'  => 3,
			'magnetPadding'   => 150,
			'marqueeSpeed'    => 0.3,
			'cardScaleStep'   => 0.03,
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jack3d_scripts' );

/**
 * Preconnect to Google Fonts.
 */
function jack3d_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'jack3d_resource_hints', 10, 2 );

/**
 * Customizer settings.
 */
require get_template_directory() . '/inc/customizer.php';

/* -------------------------------------------------------------------------
 * Helpers
 * ---------------------------------------------------------------------- */

/**
 * Get a theme mod with default fallback.
 *
 * @param string $key     Setting key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function jack3d_mod( $key, $default = '' ) {
	$defaults = jack3d_defaults();
	if ( '' === $default && isset( $defaults[ $key ] ) ) {
		$default = $defaults[ $key ];
	}
	return get_theme_mod( $key, $default );
}

/**
 * All default content values.
 *
 * @return array
 */
function jack3d_defaults() {
	return array(
		'jack3d_hero_title'     => "Hi, I'm Jack",
		'jack3d_hero_tagline'   => 'A 3D creator driven by crafting striking and unforgettable projects',
		'jack3d_hero_portrait'  => '',
		'jack3d_cta_label'      => 'Contact Me',
		'jack3d_contact_email'  => 'hello@example.com',
		'jack3d_about_title'    => 'About Me',
		'jack3d_about_text'     => "With more than five years of experience in design, i focus on branding, web design, and user experience, i truly enjoy working with businesses that aim to stand out and present their best image. Let's build something incredible together!",
		'jack3d_services_title' => 'Services',
		'jack3d_projects_title' => 'Project',
		'jack3d_contact_title'  => "Let's Talk",
		'jack3d_contact_text'   => 'Have a project in mind? Send a brief and I will get back to you within 24 hours.',
		'jack3d_footer_text'    => '© ' . gmdate( 'Y' ) . ' Jack — 3D Creator',
	);
}

/**
 * Default service items. Each item is editable in the Customizer.
 *
 * @return array
 */
function jack3d_services() {
	$defaults = array(
		array( '3D Modeling', 'Creation of detailed objects, characters, or environments tailored to specific client needs, ideal for games, products, and visualizations.' ),
		array( 'Rendering', 'High-quality, photorealistic renders that showcase designs with custom lighting, textures, and materials to bring concepts to life.' ),
		array( 'Motion Design', 'Dynamic animations and motion graphics that add energy and storytelling to brands, products, and digital experiences.' ),
		array( 'Branding', 'Crafting cohesive visual identities — from logos to full brand systems — that communicate a clear and memorable presence.' ),
		array( 'Web Design', 'Designing clean, modern, and conversion-focused websites with attention to layout, typography, and user experience.' ),
	);

	$services = array();
	foreach ( $defaults as $i => $item ) {
		$n    = $i + 1;
		$name = get_theme_mod( "jack3d_service_{$n}_name", $item[0] );
		$desc = get_theme_mod( "jack3d_service_{$n}_desc", $item[1] );
		if ( '' === trim( (string) $name ) ) {
			continue;
		}
		$services[] = array(
			'num'  => str_pad( (string) $n, 2, '0', STR_PAD_LEFT ),
			'name' => $name,
			'desc' => $desc,
		);
	}
	return $services;
}

/**
 * Project cards. Pulled from the "project" posts when available,
 * otherwise from Customizer fields.
 *
 * @return array
 */
function jack3d_projects() {
	$defaults = array(
		array( 'Nextlevel Studio', 'Client' ),
		array( 'Aura Brand Identity', 'Personal' ),
		array( 'Solaris Digital', 'Client' ),
	);

	$projects = array();
	foreach ( $defaults as $i => $item ) {
		$n    = $i + 1;
		$name = get_theme_mod( "jack3d_project_{$n}_name", $item[0] );
		if ( '' === trim( (string) $name ) ) {
			continue;
		}
		$projects[] = array(
			'num'      => str_pad( (string) $n, 2, '0', STR_PAD_LEFT ),
			'name'     => $name,
			'category' => get_theme_mod( "jack3d_project_{$n}_category", $item[1] ),
			'url'      => get_theme_mod( "jack3d_project_{$n}_url", '' ),
			'image_1'  => get_theme_mod( "jack3d_project_{$n}_image_1", '' ),
			'image_2'  => get_theme_mod( "jack3d_project_{$n}_image_2", '' ),
			'image_3'  => get_theme_mod( "jack3d_project_{$n}_image_3", '' ),
		);
	}
	return $projects;
}

/**
 * Marquee images (8 Customizer slots, falls back to nothing when empty).
 *
 * @return array
 */
function jack3d_marquee_images() {
	$images = array();
	for ( $n = 1; $n <= 8; $n++ ) {
		$url = get_theme_mod( "jack3d_marquee_image_{$n}", '' );
		if ( $url ) {
			$images[] = $url;
		}
	}
	return $images;
}

/**
 * Output an image tag or a neutral placeholder box.
 *
 * @param string $url   Image URL.
 * @param string $alt   Alt text.
 * @param string $class CSS class.
 */
function jack3d_image( $url, $alt = '', $class = '' ) {
	if ( ! $url ) {
		printf(
			'<div class="%1$s" style="background:rgba(215,226,234,.08);min-height:160px;border-radius:inherit"></div>',
			esc_attr( $class )
		);
		return;
	}
	printf(
		'<img src="%1$s" alt="%2$s" class="%3$s" loading="lazy" decoding="async" />',
		esc_url( $url ),
		esc_attr( $alt ),
		esc_attr( $class )
	);
}

/**
 * Split text into per-character spans for the scroll reveal effect.
 *
 * @param string $text Text.
 * @return string HTML.
 */
function jack3d_split_text( $text ) {
	$words  = preg_split( '/\s+/', trim( wp_strip_all_tags( $text ) ) );
	$output = '';
	foreach ( $words as $word ) {
		$chars = '';
		foreach ( preg_split( '//u', $word, -1, PREG_SPLIT_NO_EMPTY ) as $char ) {
			$chars .= '<span class="j-char">' . esc_html( $char ) . '</span>';
		}
		$output .= '<span class="j-word">' . $chars . '</span> ';
	}
	return trim( $output );
}

/**
 * Fallback one-page menu when no menu is assigned.
 */
function jack3d_default_nav() {
	$items = array(
		'about'    => __( 'About', 'jack-3d-creator' ),
		'price'    => __( 'Price', 'jack-3d-creator' ),
		'projects' => __( 'Projects', 'jack-3d-creator' ),
		'contact'  => __( 'Contact', 'jack-3d-creator' ),
	);
	echo '<ul>';
	foreach ( $items as $slug => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/#' . $slug ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}
