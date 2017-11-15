<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       tutexp.com
 * @since      1.0.0
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/admin
 * @author     tutexp team <tapos.aa@gmail.com>
 */
class Tutexp_sms_wordpress_login_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->addUserPhoneColumn();

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tutexp_sms_wordpress_login-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tutexp_sms_wordpress_login-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function addUserPhoneColumn()
    {

        add_action( 'show_user_profile', array($this,'custom_user_profile_fields') );
        add_action( 'edit_user_profile', array($this,'custom_user_profile_fields') );
        add_action( "user_new_form", array($this,"custom_user_profile_fields" ));

        add_action('user_register', 'save_custom_user_profile_fields');
        add_action('profile_update', 'save_custom_user_profile_fields');

    }

    function custom_user_profile_fields($user){
        if(is_object($user))
            $phone = esc_attr( get_the_author_meta( 'tutexp_phone', $user->ID ) );
        else
            $phone = null;
        ?>
        <h3>Extra profile information</h3>
        <table class="form-table">
            <tr>
                <th><label for="company">Mobile Number</label></th>
                <td>
                    <input type="text" class="regular-text" name="phone" value="<?php echo $phone; ?>" id="phone" /><br />
                    <span class="description">Mobile Number Needed?</span>
                </td>
            </tr>
        </table>
        <?php
    }
    function save_custom_user_profile_fields($user_id){
        # again do this only if you can
        if(!current_user_can('manage_options'))
            return false;

        # save my custom field
        update_user_meta($user_id, 'tutexp_phone', $_POST['phone']);
    }







}
