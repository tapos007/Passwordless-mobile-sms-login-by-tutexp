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
                    <h1>Account Kit</h1>
                    <div>
                        <p class="form-row">

                            <label for="mobile_number"><?php _e('Mobile Number', 'personalize-login'); ?></label>
                            <input style="color: white !important;background-color: green !important; " type="tel" name="mobile_number" id="mobile-number">
                        </p>
                        <button class="button button-block smsLogin"/>
                        Send</button>
                    </div>
                </div>
                <div id="login">
                    <h1>Account Kit</h1>
                    <div>
                        <div class="field-wrap">
                            <label>
                                Email Address<span class="req">*</span>
                            </label>
                            <input type="email" id="email" required autocomplete="off"/>
                        </div>
                        <button type="submit" class="button button-block emailLogin"/>
                        Log In</button>
                    </div>
                </div>
            </div>
            <!-- tab-content -->
        </div>
        <!-- /form -->
    </div>


</div>