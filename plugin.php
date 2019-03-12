<?php
/*
 * Plugin Name: WW Disable browse-happy
 * Plugin URI: https://github.com/sjinks/wp-disable-browse-happy
 * Description: Disable calls to the BrowseHappy API (ie, for privacy reasons)
 * Version: 1.0.2
 * Author: Volodymyr Kolesnykov
 * License: MIT
 */

if (defined('ABSPATH')) {
	require __DIR__ . '/inc/disable-browse-happy.php';
	WildWolf\WordPress\DisableBrowseHappyPlugin::instance();
}
