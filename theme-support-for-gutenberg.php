<?php
/*
Plugin Name: Theme Support for Gutenberg
Plugin URI: https://weavertheme.com/plugins
Description: Add support for Gutenberg to most existing WordPress themes, including alignwide and alignfull styling. Activate and it will integrate with most existing themes. Works best on pages with no sidebars. Plugin options found on the Appearance menu.
Author: wpweaver
Author URI: https://weavertheme.com/about/
Version: 0.2

License: GPL Version 3 or later

Theme Support for Gutenberg (C) 2018, Bruce E. Wampler - weaver@weavertheme.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/* CORE FUNCTIONS
*/

define ( 'tsg_VERSION','0.2');
define ( 'tsg_MINIFY','');		// '' for dev, '.min' for production

// ===============================>>> REGISTER ACTIONS <<<===============================


if ( tsg_is_gutenberg_active() && !tsg_theme_supports_gb() ) :

add_action( 'plugins_loaded', 'tsg_plugins_loaded');

    function tsg_plugins_loaded() {

        function tsg_installed() {
        return true;
    }

    /* add admin option interface */
	add_action('admin_menu', 'tsg_admin_menu');
    add_action('wp_enqueue_scripts', 'tsg_enqueue_scripts' );

	add_action('init', 'tsg_after_theme_setup');

	add_action( 'enqueue_block_editor_assets', 'tsg_enqueue_gutenberg_block_editor_assets' );	// Gutenberg invokes this action
	add_action( 'enqueue_block_assets', 'tsg_gutenberg_block_assets' );				// Gutenberg invokes this action

}

// ===============================>>> DEFINE ACTIONS <<<===============================

function tsg_body_classes( $classes ) {

	$classes[] = 'tsg-plugin';
	$classes[] = 'tsg-' . get_template();

	if ( !tsg_getopt('no_fitvids') || tsg_getopt('have_flexible_video') )
		$classes[] = 'tsg-fitvids';

	if ( tsg_getopt('reduced_full_width') )
		$classes[] = 'align-full-90';

	return $classes;
}


function tsg_admin() {
    require_once(dirname( __FILE__ ) . '/includes/tsg-admin-top.php'); // NOW - load the admin stuff
    tsg_admin_page();
}

function tsg_admin_menu() {

    $menu = 'Theme Support for Gutenberg';
    $full = 'Theme Support for Gutenberg Plugin by WeaverTheme.com';

	$page = add_theme_page(
	  $full, $menu, 'manage_options', 'tsg_page', 'tsg_admin');
	/* using registered $page handle to hook stylesheet loading for this admin page */
    add_action('admin_print_styles-'. $page, 'tsg_admin_scripts');
}


function tsg_admin_scripts() {
    /* called only on the admin page, enqueue our special style sheet here (for tabbed pages) */
    wp_enqueue_style('wvrx_Stylesheet', tsg_plugins_url('/assets/css/tsg-admin-style', tsg_MINIFY . '.css'), array(), tsg_VERSION);

    wp_enqueue_script('tsg_Yetii', tsg_plugins_url('/assets/js/yetii/yetii',tsg_MINIFY.'.js'), array(),tsg_VERSION);
    wp_enqueue_script('tsg_Admin', tsg_plugins_url('/assets/js/tsg-admin',tsg_MINIFY.'.js'), array(), tsg_VERSION);
}

function tsg_plugins_url($file,$ext='') {
    return plugins_url($file,__FILE__) . $ext;
}

// ############

function tsg_after_theme_setup() {
	add_theme_support( 'align-wide' );		// gutenberg wide
	add_action( 'admin_bar_menu', 'tsg_admin_bar_menu', 120 );
	add_filter( 'body_class', 'tsg_body_classes' );
}

// ############


function tsg_enqueue_scripts() {	// enqueue runtime scripts

	// no non-gb styling required

    // wp_register_style('tsg-style-sheet',tsg_plugins_url('/assets/css/tsg-style', tsg_MINIFY.'.css'),null,tsg_VERSION,'all');
    // wp_enqueue_style('tsg-style-sheet');

	if ( !tsg_getopt('no_fitvids') && !tsg_getopt('have_flexible_video') ) {
		wp_register_script('fitvids', tsg_plugins_url('/assets/js/fitvids/jquery.fitvids.min.js'), array('jquery'), tsg_VERSION, true);
		wp_enqueue_script('fitvids');
	}
}

// ############

/**
 * Action:	Enqueue style sheets and fonts for Gutenberg Editor only.
 *
 * @since 4.0
 *
 */
function tsg_enqueue_gutenberg_block_editor_assets() {
	// add our element styles to gutenberg. enqueues for editor only

	if ( !tsg_getopt('no_load_edit_style') ) {

		/* It turns out that is works really well to load the legacy editor styles.
		 * This seems to work because TinyMCE is right there under the hood.
		 */

		global $editor_styles;

		$n = 0;

		foreach ( $editor_styles as $style ) {
			if ( strpos( $style, 'http') === 0 || strpos( $style, '//') === 0 ) {
				//tsg_alert('Load http: ' . $style);
				wp_enqueue_style( 'tsg_style_' . $n++, $style );
			} else {
				//tsg_alert('Load theme stylesheet:' . get_theme_root_uri() . '/' . $style);
				wp_enqueue_style( 'tsg_style_' . $n++, get_template_directory_uri() . '/' . $style );
			}
		}
	}

	wp_register_style('tsg_gutenberg_base_style',tsg_plugins_url('/assets/css/gutenberg-base-editor-style', tsg_MINIFY.'.css'),null,tsg_VERSION,'all');
    wp_enqueue_style('tsg_gutenberg_base_style');

}

/* function tsg_alert($msg) {	// also in runtime lib
	echo "<script> alert('" . esc_html($msg) . "'); </script>";
}
*/

/**
 * Action:	Enqueue style sheets for Gutenberg Editor and Front end.
 *
 * @since 4.0
 *
 */
function tsg_gutenberg_block_assets() {

	//if ( get_theme_support( 'align-wide' ) !== false )	// don't add our support for themes that already have align-wide
	//	return;

	wp_register_style('tsg_gutenberg_block',tsg_plugins_url('/assets/css/gutenberg-blocks', tsg_MINIFY.'.css'),null,tsg_VERSION,'all');
    wp_enqueue_style('tsg_gutenberg_block');

}

/**
 * Add an `Edit (Classic)` link in the toolbar.
 */
function tsg_admin_bar_menu( $wp_admin_bar ) {
	global $post_id, $wp_the_query;
	$edit_url = null;

	if ( is_admin() ) {
		$post = get_post( $post_id );
	} else {
		$post = $wp_the_query->get_queried_object();
	}

	if ( empty( $post ) || empty( $post->ID ) ) {
		return;
	}

	// Capability check is in get_edit_post_link().
	$edit_url = get_edit_post_link( $post->ID, 'url' );

	if ( $edit_url &&
		( ( is_admin() && 'post' === get_current_screen()->base ) || ( ! is_admin() && ! empty( $post->post_type ) ) ) &&
		post_type_supports( $post->post_type, 'editor' ) ) {

		if ( isset( $_GET['classic-editor'] ) ) {
			$wp_admin_bar->add_menu( array(
				'id' => 'classic-editor',
				'title' => __( 'Edit (Gutenberg)', 'theme-support-for-gutenberg' ),
				'href' => remove_query_arg( 'classic-editor', $edit_url ),
			) );
		} else {
			$wp_admin_bar->add_menu( array(
				'id' => 'classic-editor',
				'title' => __( 'Edit (Classic)', 'theme-support-for-gutenberg' ),
				'href' => add_query_arg( 'classic-editor', '1', $edit_url ),
			) );
		}
	}
}



require_once(dirname( __FILE__ ) . '/includes/tsg-runtime-lib.php'); // NOW - load the basic library

function tsg_load_textdomain() {

		load_plugin_textdomain( 'theme-support-for-gutenberg', false, basename(dirname( __FILE__ )) . '/languages' );
}

add_action( 'plugins_loaded', 'tsg_load_textdomain' );

endif;
/**
 * Check if Gutenberg is active.
 *
 * Cannot use `is_plugin_active()` as it loads late and only in wp-admin.
 *
 * @return bool whether the Gutenberg plugin is active.
 */
function tsg_is_gutenberg_active() {
	if ( in_array( 'gutenberg/gutenberg.php', (array) get_option( 'active_plugins', array() ) ) ||
		( is_multisite() && array_key_exists( 'gutenberg/gutenberg.php', (array) get_site_option( 'active_sitewide_plugins' ) ) ) ) {
		return true;
	}

	return false;
}

function tsg_theme_supports_gb() {
	$theme = wp_get_theme();		// fetch the current theme
	if (! $theme->exists() )
		return false;
	$style_name = $theme->get_stylesheet();

	$have_gb = array ('weaver-xtreme');

	if ( in_array( $style_name, $have_gb) )
		return true;
	return false;
}


?>
