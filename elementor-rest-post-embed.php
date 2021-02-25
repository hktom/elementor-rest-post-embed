<?php
/**
 * Plugin Name: Elementor Rest Post Embed
 * Description: Elementor widget that allow to embed post from another website by using REST API
 * Plugin URI:  https://github.com/hktom/elementor-rest-post-embed
 * Version:     2.0.2
 * Author:      Tom Hikari
 * Author URI:  https://github.com/hktom/
 * Text Domain: elementor-rest-post-embed
 */
namespace Elementor_Rest_Post_Embed;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// The Widget_Base class is not available immediately after plugins are loaded, so
// we delay the class' use until Elementor widgets are registered
add_action( 'elementor/widgets/widgets_registered', function() {
	require_once('widget.php');

	$elementor_rest_post_embed = new Elementor_Rest_Post_Embed();

	// Let Elementor know about our widget
	Plugin::instance()->widgets_manager->register_widget_type( $elementor_rest_post_embed );
});