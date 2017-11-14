<div class="login-form-container">
    <?php if ( $attributes['show_title'] ) : ?>
        <h2><?php _e( 'Sign In', 'personalize-login' ); ?></h2>
    <?php endif; ?>
    <?php if ( $attributes['registered'] ) : ?>
        <p class="login-info">
            <?php
            printf(
                __( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'personalize-login' ),
                get_bloginfo( 'name' )
            );
            ?>
        </p>
    <?php endif; ?>
    <?php
    wp_login_form(
        array(
            'label_username' => __( 'Email', 'personalize-login' ),
            'label_log_in' => __( 'Sign In', 'personalize-login' ),
            'redirect' => $attributes['redirect'],
        )
    );
    ?>

    <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'Forgot your password?', 'personalize-login' ); ?>
    </a>
</div>