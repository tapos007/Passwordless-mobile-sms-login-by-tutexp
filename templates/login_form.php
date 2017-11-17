<div class="login-form-container">
    <?php


    ?>
    <?php if ($attributes['show_title']) : ?>
        <h2><?php _e('Sign In', 'personalize-login'); ?></h2>
    <?php endif; ?>
    <?php if ($attributes['registered']) : ?>
        <p class="login-info">
            <?php
            printf(
                __('You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'personalize-login'),
                get_bloginfo('name')
            );
            ?>
        </p>
    <?php endif; ?>
    <div class="tutexpForm">
        <div class="form">
            <ul class="tab-group mytabls">
                <li class="tab active"><a href="#signup">Phone</a></li>
                <li class="tab"><a href="#login">Email</a></li>
            </ul>
            <form method="post" id="form">
                <?php wp_nonce_field('state', 'state'); ?>
            </form>
            <div class="tab-content">
                <div id="signup">
                    <h1>SMS Login</h1>
                    <div>
                        <p class="form-row">

                            <label for="mobile_number"><?php _e('Mobile Number', 'personalize-login'); ?></label>
                            <input style="color: white !important;background-color: green !important; " type="tel"
                                   name="mobile_number" id="mobile-number">
                        </p>
                        <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                        <button class="button button-block smsLogin"/>
                        Send</button>
                    </div>
                </div>
                <div id="login">
                    <h1>Normal Login</h1>
                    <div>
                        <form method="post" action="<?php echo wp_login_url(); ?>">
                            <div class="field-wrap">
                                <label>
                                    Email Address<span class="req">*</span>
                                </label>
                                <input type="text" name="log" id="user_login" required autocomplete="off"/>
                            </div>
                            <div class="field-wrap">
                                <label>
                                    <?php _e( 'Password', 'personalize-login' ); ?><span class="req">*</span>
                                </label>
                                <input type="password" name="pwd" id="user_pass" required autocomplete="off"/>
                            </div>

                            <button type="submit" class="button button-block"/>
                            <?php _e( 'Sign In', 'personalize-login' ); ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- tab-content -->
        </div>
        <!-- /form -->
    </div>


</div>