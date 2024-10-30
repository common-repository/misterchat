<?php

/**
 * Fired during plugin activation
 *
 * @link       https://dailycms.com
 * @since      1.0.0
 *
 * @package    Mister_chat
 * @subpackage Mister_chat/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mister_chat
 * @subpackage Mister_chat/includes
 * @author     DailyCMS <info@dailycms.com>
 */
class Mister_chat_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('mister_chat_options', array('key' => ''));
	}

}
