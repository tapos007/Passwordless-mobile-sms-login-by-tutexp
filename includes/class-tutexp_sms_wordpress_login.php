<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       tutexp.com
 * @since      1.0.0
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/includes
 * @author     tutexp team <tapos.aa@gmail.com>
 */
class Tutexp_sms_wordpress_login
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Tutexp_sms_wordpress_login_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('PLUGIN_NAME_VERSION')) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'tutexp_sms_wordpress_login';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->loadAddShortCode();
        $this->redirectLoginRegistration();
        $this->ajaxCallInformation();




    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Tutexp_sms_wordpress_login_Loader. Orchestrates the hooks of the plugin.
     * - Tutexp_sms_wordpress_login_i18n. Defines internationalization functionality.
     * - Tutexp_sms_wordpress_login_Admin. Defines all hooks for the admin area.
     * - Tutexp_sms_wordpress_login_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-tutexp_sms_wordpress_login-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-tutexp_sms_wordpress_login-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-tutexp_sms_wordpress_login-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-tutexp_sms_wordpress_login-public.php';


        /**
         * The class responsible for all short code
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-tutexp_sms_wordpress_login-shortcode.php';

        $this->loader = new Tutexp_sms_wordpress_login_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Tutexp_sms_wordpress_login_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Tutexp_sms_wordpress_login_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Tutexp_sms_wordpress_login_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Tutexp_sms_wordpress_login_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();

    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Tutexp_sms_wordpress_login_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    public function loadAddShortCode()
    {

        $shortCode = new Tutexp_sms_wordpress_login_ShortCode();
    }

    public function redirectLoginRegistration()
    {
        add_action('login_form_login', array($this, 'redirect_to_custom_login'));

        add_filter( 'authenticate', array( $this, 'maybe_redirect_at_authenticate' ), 101, 3 );
        add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

        add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );

        // for registration work

        add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );
        add_action( 'login_form_register', array( $this, 'do_register_user' ) );


    }
    /**
     * Redirect the user to the custom login page instead of wp-login.php.
     */
    function redirect_to_custom_login() {
        if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
            $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;

            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user( $redirect_to );
                exit;
            }

            // The rest are redirected to the login page
            $login_url = home_url( 'tutexpsms-member-login' );
            if ( ! empty( $redirect_to ) ) {
                $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
            }

            wp_redirect( $login_url );
            exit;
        }
    }
    /**
     * Redirects the user to the correct page depending on whether he / she
     * is an admin or not.
     *
     * @param string $redirect_to   An optional redirect_to URL for admin users
     */
    private function redirect_logged_in_user( $redirect_to = null ) {
        $user = wp_get_current_user();
        if ( user_can( $user, 'manage_options' ) ) {
            if ( $redirect_to ) {
                wp_safe_redirect( $redirect_to );
            } else {
                wp_redirect( admin_url() );
            }
        } else {
            wp_redirect( home_url( 'tutexpsms-member-account' ) );
        }
    }

    /**
     * Redirect the user after authentication if there were any errors.
     *
     * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
     * @param string            $username   The user name used to log in.
     * @param string            $password   The password used to log in.
     *
     * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
     */
    function maybe_redirect_at_authenticate( $user, $username, $password ) {
        // Check if the earlier authenticate filter (most likely,
        // the default WordPress authentication) functions have found errors
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            if ( is_wp_error( $user ) ) {
                $error_codes = join( ',', $user->get_error_codes() );

                $login_url = home_url( 'tutexpsms-member-login' );
                $login_url = add_query_arg( 'login', $error_codes, $login_url );

                wp_redirect( $login_url );
                exit;
            }
        }

        return $user;
    }


    /**
     * Finds and returns a matching error message for the given error code.
     *
     * @param string $error_code    The error code to look up.
     *
     * @return string               An error message.
     */
    private function get_error_message( $error_code ) {
        switch ( $error_code ) {
            case 'empty_username':
                return __( 'You do have an email address, right?', 'personalize-login' );

            case 'empty_password':
                return __( 'You need to enter a password to login.', 'personalize-login' );

            case 'invalid_username':
                return __(
                    "We don't have any users with that email address. Maybe you used a different one when signing up?",
                    'personalize-login'
                );

            case 'incorrect_password':
                $err = __(
                    "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?",
                    'personalize-login'
                );
                return sprintf( $err, wp_lostpassword_url() );

            default:
                break;
        }

        return __( 'An unknown error occurred. Please try again later.', 'personalize-login' );
    }


    /**
     * Redirect to custom login page after the user has been logged out.
     */
    public function redirect_after_logout() {
        $redirect_url = home_url( 'tutexpsms-member-login?logged_out=true' );
        wp_safe_redirect( $redirect_url );
        exit;
    }


    /**
     * Returns the URL to which the user should be redirected after the (successful) login.
     *
     * @param string           $redirect_to           The redirect destination URL.
     * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
     * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
     *
     * @return string Redirect URL
     */
    public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
        $redirect_url = home_url();

        if ( ! isset( $user->ID ) ) {
            return $redirect_url;
        }

        if ( user_can( $user, 'manage_options' ) ) {
            // Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
            if ( $requested_redirect_to == '' ) {
                $redirect_url = admin_url();
            } else {
                $redirect_url = $requested_redirect_to;
            }
        } else {
            // Non-admin users always go to their account page after login
            $redirect_url = home_url( 'tutexpsms-member-account' );
        }

        return wp_validate_redirect( $redirect_url, home_url() );
    }


    /**
     * Redirects the user to the custom registration page instead
     * of wp-login.php?action=register.
     */
    public function redirect_to_custom_register() {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
            } else {
                wp_redirect( home_url( 'tutexpsms-register-form' ) );
            }
            exit;
        }
    }



    /**
     * Validates and then completes the new user signup process if all went well.
     *
     * @param string $email         The new user's email address
     * @param string $first_name    The new user's first name
     * @param string $last_name     The new user's last name
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    private function register_user( $email, $first_name, $last_name,$phone ) {
        $errors = new WP_Error();

        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if ( ! is_email( $email ) ) {
            $errors->add( 'email', $this->get_error_message( 'email' ) );
            return $errors;
        }

        if ( username_exists( $email ) || email_exists( $email ) ) {
            $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
            return $errors;
        }

        $checkPhoneNumber = get_users(array('meta_key' => 'tutexp_phone', 'meta_value' => $phone));



        if(count($checkPhoneNumber)>0){
            $errors->add( 'phone_exits', $this->get_error_message( 'phone_exits') );
            return $errors;
        }

        // Generate the password so that the subscriber will have to check email...
        $password = wp_generate_password( 12, false );

        $user_data = array(
            'user_login'    => $email,
            'user_email'    => $email,
            'user_pass'     => $password,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'nickname'      => $first_name,
        );

        $user_id = wp_insert_user( $user_data );
        add_user_meta( $user_id, 'tutexp_phone', $phone);
       // wp_new_user_notification( $user_id, $password );

        return $user_id;
    }


    /**
     * Handles the registration of a new user.
     *
     * Used through the action hook "login_form_register" activated on wp-login.php
     * when accessed through the registration action.
     */
    public function do_register_user() {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $redirect_url = home_url( 'tutexpsms-member-register' );

            if ( ! get_option( 'users_can_register' ) ) {
                // Registration closed, display error
                $redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
            } else {
                $email = $_POST['email'];
                $first_name = sanitize_text_field( $_POST['first_name'] );
                $last_name = sanitize_text_field( $_POST['last_name'] );
                $phone = sanitize_text_field( $_POST['phoneOriginal'] );


                $result = $this->register_user( $email, $first_name, $last_name,$phone );

                if ( is_wp_error( $result ) ) {
                    // Parse errors into a string and append as parameter to redirect
                    $errors = join( ',', $result->get_error_codes() );
                    $redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
                } else {
                    // Success, redirect to login page.
                    $redirect_url = home_url( 'tutexpsms-member-login' );
                    $redirect_url = add_query_arg( 'registered', $email, $redirect_url );
                }
            }

            wp_redirect( $redirect_url );
            exit;
        }
    }

    public function ajaxCallInformation()
    {
        add_action( 'wp_ajax_nopriv_ajax_login', array( $this, 'ajax_login' ) );
        add_action( 'wp_ajax_nopriv_tutexp_facebook', array( $this, 'tutexp_facebook'));
        add_action( 'wp_ajax_tutexp_facebook', array( $this, 'tutexp_facebook'));

       // add_action('wp_ajax_ajaxlogin', 'ajaxlogin');

    }

    function ajax_login(){

        $phone = $_POST['mobile_number'];
        $checkPhoneNumber = get_users(array('meta_key' => 'tutexp_phone', 'meta_value' => $phone));
        if(count($checkPhoneNumber)==0){
            echo json_encode(array('status'=>false, 'message'=>__('Mobile number not found our system')));
        }else{
            echo json_encode(array('status'=>true, 'message'=>__('enter next area')));
        }

        die();
    }

    public function tutexp_facebook()
    {
        $code = $_POST['code'];
        $csrf = $_POST['csrf'];
        $mobileNumber = $_POST['tutmobileNumber'];
        $version = "v1.0";
        $app_id = "1952653494947783";
        $secret = "a1d4c2479d99e1649fa762e194c4423a";

        $token_exchange_url = 'https://graph.accountkit.com/' . $version . '/access_token?' .
            'grant_type=authorization_code' .
            '&code=' . $code .
            "&access_token=AA|$app_id|$secret";

        $response = wp_remote_get($token_exchange_url);
        $phone = $mobileNumber;


        $checkPhoneNumber = get_users(array('meta_key' => 'tutexp_phone', 'meta_value' => $phone));

        $user = $checkPhoneNumber[0];
        wp_set_auth_cookie($user->id);
        if ( user_can( $user->id, 'manage_options' ) ) {
            echo json_encode(array('status'=>true, 'isAdmin'=>true));
        } else {
            echo json_encode(array('status'=>true, 'isAdmin'=>false));
        }

        die();
    }









}
