<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dailycms.com
 * @since      1.0.0
 *
 * @package    Mister_chat
 * @subpackage Mister_chat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mister_chat
 * @subpackage Mister_chat/public
 * @author     DailyCMS <info@dailycms.com>
 */
class Mister_chat_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mister_chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mister_chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mister_chat-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mister_chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mister_chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		add_filter( 'script_loader_tag', array($this, 'wsds_defer_scripts'), 10, 3 );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mister_chat-public.js', array( 'jquery' ), $this->version, false );

		$options = get_option( 'mister_chat_options' );
		wp_localize_script( $this->plugin_name, 'key', esc_attr( $options['key'] ));
	}

	public function wsds_defer_scripts( $tag, $handle, $src ) {

		// The handles of the enqueued scripts we want to defer
		$defer_scripts = array(
			$this->plugin_name,
		);

		if ( in_array( $handle, $defer_scripts ) ) {
			return '<script type="text/javascript" src="' . esc_js($src) . '" defer></script>' . "\n";
		}

		return $tag;
	}

}
