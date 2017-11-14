<div id="register-form" class="widecolumn">
    <?php if ($attributes['show_title']) : ?>
        <h3><?php _e('Register', 'personalize-login'); ?></h3>
    <?php endif; ?>
    <?php if (count($attributes['errors']) > 0) : ?>
        <?php foreach ($attributes['errors'] as $error) : ?>
            <p>
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    <form id="tutexpsms-registerForm" action="<?php echo wp_registration_url(); ?>" method="post">
        <p class="form-row">
            <label for="email"><?php _e('Email', 'personalize-login'); ?> <strong>*</strong></label>
            <input type="text" name="email" id="email">
        </p>

        <p class="form-row">
            <label for="first_name"><?php _e('First name', 'personalize-login'); ?></label>
            <input type="text" name="first_name" id="first-name">
        </p>

        <p class="form-row">
            <label for="last_name"><?php _e('Last name', 'personalize-login'); ?></label>
            <input type="text" name="last_name" id="last-name">
        </p>
        <p class="form-row">

            <label for="mobile_number"><?php _e('Mobile Number', 'personalize-login'); ?></label>
            <input type="tel" name="mobile_number" id="mobile-number">
        </p>

        <p class="form-row">
            <?php _e('Note: Mobile Number is needed for login using mobile number . SMS message come your phone', 'personalize-login'); ?>
        </p>


        <p class="signup-submit">

            <input type="submit" name="submit" class="register-button"
                   value="<?php _e('Register', 'personalize-login'); ?>"/>
        </p>
    </form>
</div>