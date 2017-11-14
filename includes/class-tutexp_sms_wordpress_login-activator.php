<?php

/**
 * Fired during plugin activation
 *
 * @link       tutexp.com
 * @since      1.0.0
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/includes
 * @author     tutexp team <tapos.aa@gmail.com>
 */
class Tutexp_sms_wordpress_login_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        $page_definitions = array(
            'tutexpsms-member-login' => array(
                'title' => __( 'Sign In', 'Tutexp_sms_wordpress_login' ),
                'content' => '[tutexpsms-login-form]'
            ),
            'tutexpsms-member-account' => array(
                'title' => __( 'Your Account', 'Tutexp_sms_wordpress_login' ),
                'content' => '[tutexpsms-account-info]'
            ),
            'tutexpsms-member-register' => array(
                'title' => __( 'Register', 'Tutexp_sms_wordpress_login' ),
                'content' => '[tutexpsms-register-form]'
            ),
        );

        foreach ( $page_definitions as $slug => $page ) {
            // Check that the page doesn't exist already
            $query = new WP_Query( 'pagename=' . $slug );
            if ( ! $query->have_posts() ) {
                // Add the page using the data from the array above
                wp_insert_post(
                    array(
                        'post_content'   => $page['content'],
                        'post_name'      => $slug,
                        'post_title'     => $page['title'],
                        'post_status'    => 'publish',
                        'post_type'      => 'page',
                        'ping_status'    => 'closed',
                        'comment_status' => 'closed',
                    )
                );
            }
        }

    }



}
