<?php
/**
 * Plugin Name:       Subpages List
 * Description:       Fetches child pages of the current page (if any).
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Rajdeep Singh Gaur
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       subpages-list
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_subpages_list_block_init() {
	register_block_type( __DIR__ . '/build/subpages-list' );
}
add_action( 'init', 'create_block_subpages_list_block_init' );
