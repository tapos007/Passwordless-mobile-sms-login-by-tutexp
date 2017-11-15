<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       tutexp.com
 * @since      1.0.0
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/public
 * @author     tutexp team <tapos.aa@gmail.com>
 */
class Tutexp_sms_wordpress_login_Public {

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
		 * defined in Tutexp_sms_wordpress_login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tutexp_sms_wordpress_login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tutexp_sms_wordpress_login-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( "intlTelInput", plugin_dir_url( __FILE__ ) . 'css/intlTelInput.css', array(), $this->version, 'all' );

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
		 * defined in Tutexp_sms_wordpress_login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tutexp_sms_wordpress_login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_script( 'intlTelInputJS', plugin_dir_url( __FILE__ ) . 'js/intlTelInput.min.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script( 'intlTelInputJSutils', plugin_dir_url( __FILE__ ) . 'js/utils.js', array( 'jquery','intlTelInputJS' ), $this->version, true );
        wp_enqueue_script( 'fbIncludedScript', 'https://sdk.accountkit.com/en_US/sdk.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tutexp_sms_wordpress_login-public.js', array( 'jquery','intlTelInputJS' ), $this->version, true );
        wp_localize_script($this->plugin_name, 'tutexp_ajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'admin_url'=>admin_url(),
            'member_url'=>home_url( 'tutexpsms-member-account' )
        ));


        wp_enqueue_script( 'tutexp_ajax_login', plugin_dir_url( __FILE__ ) . 'js/tutexp_sms_login.js', array( 'jquery','intlTelInputJS' ), $this->version, true );
        wp_localize_script('tutexp_ajax_login', 'tutexp_ajax1', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'admin_url'=>admin_url(),
            'member_url'=>home_url( 'tutexpsms-member-account' )
        ));




	}

}
