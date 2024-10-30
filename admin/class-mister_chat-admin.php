<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dailycms.com
 * @since      1.0.0
 *
 * @package    Mister_chat
 * @subpackage Mister_chat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mister_chat
 * @subpackage Mister_chat/admin
 * @author     DailyCMS <info@dailycms.com>
 */
class Mister_chat_Admin
{

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mister_chat-admin.css', array(), $this->version, 'all');

		// wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/form_styling.css', array(), $this->version, 'all');

		wp_register_style('form_styling', plugin_dir_url(__FILE__) . 'css/form_styling.css');
    	wp_enqueue_style('form_styling');

		add_action( 'admin_init','form_styling');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mister_chat-admin.js', array( 'jquery' ), $this->version, false );

	}

	function register_settings()
	{
		register_setting('mister_chat_options', 'mister_chat_options', array($this, 'mister_chat_plugin_options_validate'));

		$sectionName = __('', $this->plugin_name);
		add_settings_section('key_settings', $sectionName, array($this, 'my_setting_section_callback_function'), $this->plugin_name);

		add_settings_field('mister_chat_key', __('Licentie', $this->plugin_name), array($this, 'mister_chat_setting_key'), $this->plugin_name, 'key_settings');
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu()
	{

		/*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */

		$image_url = plugin_dir_url(__FILE__) . 'images/mister_chat.png';
		add_menu_page('MisterChat', 'MisterChat', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), esc_url($image_url));
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "options";

		// check if the form is already been filled out
		$result = $wpdb->get_results($wpdb->prepare("SELECT option_id FROM $table_name WHERE option_name = 'misterchat_form' AND option_value = '1'"));

		// if the form has not been filled out
		if (!empty($result)) {

			// code below fires when form has already been filled out

			$imageLogo = plugin_dir_url(__FILE__) . 'images/mister_logo.png';
			// create the form

?>

			<img src="<?php echo esc_url($imageLogo); ?>" alt="logo" style="width: 200px;">
			<br>

			<p style="width: 520px;">

				<br><br>
				<?php _e('Welcome to MisterChat and thank you for the trust!', 'mister_chat'); ?>
				<br><br>
				<?php _e('You have chosen to get started with MisterChat', 'mister_chat'); ?>.<br>
				<?php _e('We are currently working on creating a chat in your style and will contact you within 24 hours for an intake and compiling an FAQ that we can use in the chat conversations. Once your chat is ready you will receive a unique key that you can enter above. From that moment on, your chat is live and we receive all your website visitors with our chat! Here you don\'t have to do anything for yourself. Easy right?!', 'mister_chat'); ?>
				<br><br>
				<?php _e('Do you have any questions, or do you want to make adjustments to your chat; contact our support department <a href="mailto:support@misterchat.nu">support@misterchat.nu</a> or call <a href="tel:+3178-3030023">+3178-3030023</a>. You can also chat via <a href="www.misterchat.nu">www.misterchat.nu</a>', 'mister_chat'); ?> 😊

			</p>

			<form action="options.php" method="post">
				<?php
				settings_fields('mister_chat_options');
				do_settings_sections($this->plugin_name); ?>
				<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
			</form>

		<?php

		} else {

		?>

			</form>

			<?php

			if (isset($_POST['submitForm'])) {

				$mailto = "sales@misterchat.nu";  //My email address
				//getting customer data
				$vnaam = $_POST['vnaam']; //getting customer voornaam
				$anaam = $_POST['anaam']; //getting customer achternaam
				$bnaam = $_POST['bnaam']; //getting customer bedrijfsnaam

				$email = $_POST['email']; //getting customer email
				$telef = $_POST['telef']; //getting customer Phone number

				$subject = 'Nieuwe gebruiker van de MisterChat WordPress plugin!';
				$subject2 = 'Thanks for using our plugin | MisterChat';

				//Email body I will receive
				$message = "Naam: " . $vnaam . " " . $anaam . "\n"
					. "Bedrijfsnaam: " . $bnaam . "\n"
					. "E-mailadres: " . $email . "\n"
					. "Telefoonnummer: " . $telef . "\n";

				//Message for client confirmation
				$message2 = "Dear " . $vnaam . " " . $anaam . "\n"
					. "Thanks for downloading our plugin! You can now test our unique manned live chat for FREE for 14 days!" . "\n\n"
					. "How does it work?" . "\n"
					. "Test it for 14 days without any obligation and free of charge in your own webshop. Experience our unique approach! After downloading the plugin, we will contact you within 24 hours for a personal onboarding!" . "\n\n"
					. "You have submitted the following information: " . $message . "\n\n"
					. "Sincerely, MisterChat.";

				//Email headers
				$headers = "Van: " . $email; // Client email, I will receive
				$headers2 = "Van: " . $mailto; // This will receive client

				$result1 = mail($mailto, $subject, $message, $headers); // This email sent to My address
				$result2 = mail($email, $subject2, $message2, $headers2); //This confirmation email to client

				//Checking if Mails sent successfully

				if ($result1 && $result2) {
					$success = _e("Your message has been sent!", 'mister_chat');
				} else {
					$failed = _e("Sorry, your message could not be delivered. Try again later!", 'mister_chat');
				}

				// Insert a record into the db when form is filled out
				global $wpdb;
				$table_name = $wpdb->prefix . "options";

				// check if record already exists before insert
				$checkIfExist = $wpdb->get_results($wpdb->prepare("SELECT option_id FROM $table_name WHERE option_name = 'misterchat_form' AND option_value = '1'"));

				// if empty insert record
				if (empty($checkIfExist)) {
					$wpdb->insert($table_name, array(
						'option_name' => 'misterchat_form',
						'option_value' => '1',
						'autoload' => 'no',
					));

					require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
					dbDelta($sql);
					add_option('my_db_version', $my_products_db_version);
				}

				?>

				<script>
					// reload page
					window.location.reload();
				</script>

				<?php
			}

			$imageLogo = plugin_dir_url(__FILE__) . 'images/mister_logo.png';

			?>

			<img src="<?php echo esc_url($imageLogo); ?>" alt="logo" style="width: 200px; padding-top: 25px;">

			<h3><?php _e('Welcome to MisterChat!', 'mister_chat'); ?></h3>

			<p>
				<b><?php _e('How does it work?', 'mister_chat'); ?></b><br>
				<?php _e('Test it for 14 days without any obligation and free of charge in your own webshop. Experience our unique approach!<br>Download the app and we will contact you within 24 hours for a personal onboarding!', 'mister_chat'); ?><br><br>
				<b><?php _e('Start today!', 'mister_chat'); ?></b><br>
				<?php _e('Fill out the form below and start today with our unique manned live chat!', 'mister_chat'); ?>
			</p>
			

			<!-- send form action to sendmail.php (isset($_POST['submitForm']))-->
			<form method="post" action="">

				<fieldset>
					<input placeholder="<?php _e('First name', 'mister_chat'); ?>" type="text" id="vnaam" name="vnaam" required minlength="2">
				</fieldset>

				<fieldset>
					<input placeholder="<?php _e('Last name', 'mister_chat'); ?>" type="text" id="anaam" name="anaam" required minlength="2">
				</fieldset>

				<fieldset>
					<input placeholder="<?php _e('Company name', 'mister_chat'); ?>" type="text" id="bnaam" name="bnaam" required minlength="2">
				</fieldset>

				<fieldset>
					<input placeholder="<?php _e('Email address', 'mister_chat'); ?>" type="email" id="email" name="email" required minlength="5">
				</fieldset>

				<fieldset>
					<input placeholder="<?php _e('Phonenumber', 'mister_chat'); ?>" type="tel" id="telef" name="telef" required>
				</fieldset>

				<fieldset>
					<input type="submit" name="submitForm" id="contact-submit" data-submit="...Verzenden">
				</fieldset>

	<?php

		}
	}


	function mister_chat_plugin_options_validate($input)
	{
		$newinput['key'] = trim($input['key']);
		return $newinput;
	}

	function my_setting_section_callback_function($args)
	{
	}

	function mister_chat_setting_key($input)
	{
		$options = get_option('mister_chat_options');
		echo "<input id='mister_chat_setting_key' name='mister_chat_options[key]' type='text' value='" . esc_attr($options['key']) . "' />";
	}
}


add_action( 'init', 'mister_chat_text_domain_load' );

function mister_chat_text_domain_load() {
	load_plugin_textdomain( 'mister_chat', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
}