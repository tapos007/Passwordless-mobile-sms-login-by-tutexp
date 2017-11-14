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
class Tutexp_sms_wordpress_login_ShortCode
{


    /**
     * Tutexp_sms_wordpress_login_ShortCode constructor.
     */
    public function __construct()
    {
        add_shortcode('tutexpsms-login-form', array($this, 'render_tutexpsms_login_form'));
        add_shortcode('tutexpsms-register-form', array($this, 'render_tutexpsms_register_form'));
    }

    /**
     * A shortcode for rendering the login form.
     *
     * @param  array $attributes Shortcode attributes.
     * @param  string $content The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
    public function render_tutexpsms_login_form($attributes, $content = null)
    {
        // Parse shortcode attributes
        $default_attributes = array('show_title' => false);
        $attributes = shortcode_atts($default_attributes, $attributes);
        $show_title = $attributes['show_title'];

        if (is_user_logged_in()) {
            return __('You are already signed in.', 'personalize-login');
        }

        // Pass the redirect parameter to the WordPress login functionality: by default,
        // don't specify a redirect, but if a valid redirect URL has been passed as
        // request parameter, use it.
        $attributes['redirect'] = '';
        if (isset($_REQUEST['redirect_to'])) {
            $attributes['redirect'] = wp_validate_redirect($_REQUEST['redirect_to'], $attributes['redirect']);
        }
        $attributes['registered'] = isset( $_REQUEST['registered'] );
        // Render the login form using an external template
        return $this->get_template_html('login_form', $attributes);
    }

    /**
     * Renders the contents of the given template to a string and returns it.
     *
     * @param string $template_name The name of the template to render (without .php)
     * @param array $attributes The PHP variables for the template
     *
     * @return string               The contents of the template.
     */
    private function get_template_html($template_name, $attributes = null)
    {
        if (!$attributes) {
            $attributes = array();
        }

        ob_start();
        do_action('personalize_login_before_' . $template_name);

        require(plugin_dir_path(__DIR__) . 'templates/' . $template_name . '.php');

        do_action('personalize_login_after_' . $template_name);

        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }


    /**
     * A shortcode for rendering the new user registration form.
     *
     * @param  array $attributes Shortcode attributes.
     * @param  string $content The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
    public function render_tutexpsms_register_form($attributes, $content = null)
    {
        // Parse shortcode attributes
        $default_attributes = array('show_title' => false);
        $attributes = shortcode_atts($default_attributes, $attributes);

        if (is_user_logged_in()) {
            return __('You are already signed in.', 'personalize-login');
        } elseif (!get_option('users_can_register')) {
            return __('Registering new users is currently not allowed.', 'personalize-login');
        } else {
            $attributes['errors'] = array();
            if (isset($_REQUEST['register-errors'])) {
                $error_codes = explode(',', $_REQUEST['register-errors']);

                foreach ($error_codes as $error_code) {
                    $attributes['errors'] [] = $this->get_error_message($error_code);
                }
            }
            return $this->get_template_html('register_form', $attributes);
        }
    }

    private function get_error_message($error_code)
    {
        switch ($error_code) {
            case 'email':
                return __('The email address you entered is not valid.', 'personalize-login');

            case 'email_exists':
                return __('An account exists with this email address.', 'personalize-login');
            case 'phone_exits':
                return __('An account exists with this phone number.', 'personalize-login');

            case 'closed':
                return __('Registering new users is currently not allowed.', 'personalize-login');
        }
    }
}
