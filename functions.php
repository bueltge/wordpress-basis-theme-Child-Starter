<?php
/**
 * WP Basis Theme Child
 * The file is only a starter to demonstate to build a child theme with WP Basis
 * 
 * @package    WP-Basis Theme
 * @subpackage WP-Basis Theme Child Starter
 * @version    02/06/2014
 * @author     fb
 */

/**
 * Set namespace to encapsulating items
 * @link     http://www.php.net/manual/en/language.namespaces.rationale.php
 * 
 * @since    05/08/2012  0.0.1
 * @version  05/08/2012
 * @author   fb
 */
namespace Wp_Basis_Child\Setup;

\add_action( 'after_setup_theme', '\Wp_Basis_Child\Setup\setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features
 * of the Child Theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support for post thumbnails.
 *
 * @since   02/06/2014
 * @return  void
 */
function setup() {

	// Loads the child theme's translated strings
	load_child_theme_textdomain( 'wp_basis_child_textdomain', get_stylesheet_directory() . '/languages' );
	
	\add_action( 'wp_basis_loader', '\Wp_Basis_Child\Setup\loader' );
	
	// Enqueue child theme's styles.css for front-end.
	\add_action( 'wp_enqueue_scripts', '\Wp_Basis_Child\Setup\add_stylesheets' );
}

/**
 * Change the autoloader of WP Basis
 * 
 * @see WP Basis functions.php:wp_basis_load_files()
 * 
 * @param   Array
 * @return  Array
 */
function loader( $includes ) {
	
	// Example
	// Unset the core setup for include the default stylesheets
	unset( $includes[ 'setup.php' ] );
	
	return $includes;
}

/**
 * Enqueue my styles for front-end.
 * Also usable for scripts
 *
 * @since   02/06/2014
 * @return  void
 */
function add_stylesheets() {

	/**
	 * Suffix for minified script/stylesheet versions.
	 *
	 * Adds a conditional ".min" suffix to the file name
	 * when SCRIPT_DEBUG is NOT set to TRUE.
	 */
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		/**
	 * Register the Parent CSS style file, if it is necessary.
	 *
	 * @param string $handle Name of the stylesheet.
	 * @param string|bool $src Path to the stylesheet from the root directory of WordPress. Example: '/assets/style.css'.
	 * @param array $deps Array of handles of any stylesheet that this stylesheet depends on.
	 *  (Stylesheets that must be loaded before this stylesheet.) Pass an empty array if there are no dependencies.
	 * @param string|bool $ver String specifying the stylesheet version number. Set to null to disable.
	 *  Used to ensure that the correct version is sent to the client regardless of caching.
	 * @param string $media The media for which this stylesheet has been defined.
	 */
	wp_register_style(
		'wp_basis_parent_style',
		get_template_directory_uri() . '/style' . $suffix . '.css',
		array(),
		'20140206',
		'screen'
	);
	
	// Enqueue the Parent CSS style file
	wp_enqueue_style( 'wp_basis_parent_style' );
	
	/**
	 * Register CSS style file.
	 *
	 * @param string $handle Name of the stylesheet.
	 * @param string|bool $src Path to the stylesheet from the root directory of WordPress. Example: '/assets/style.css'.
	 * @param array $deps Array of handles of any stylesheet that this stylesheet depends on.
	 *  (Stylesheets that must be loaded before this stylesheet.) Pass an empty array if there are no dependencies.
	 * @param string|bool $ver String specifying the stylesheet version number. Set to null to disable.
	 *  Used to ensure that the correct version is sent to the client regardless of caching.
	 * @param string $media The media for which this stylesheet has been defined.
	 */
	wp_register_style(
		'wp_basis_child_style',
		get_stylesheet_directory_uri() . '/style' . $suffix . '.css',
		array(),
		'20140206',
		'screen'
	);

	// Enqueue a CSS style file
	wp_enqueue_style( 'wp_basis_child_style' );
}
