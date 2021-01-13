<?php
/*
 * Template Name: Login
 */

get_header(); ?>

<div class='container-fluid app-theme-white'>
    <div class='row col splash-container'>
        <div class='card mx-auto'>
            <div class='card-body'>
                <div class='nav nav-tabs'>
                    <a class='nav-item nav-link active' data-toggle='tab' href='#login' role='tab' aria-controls='nav-login' aria-selected='true'>Login</a>
                    <a class='nav-item nav-link' data-toggle='tab' href='#register' role='tab' aria-controls='nav-register' aria-selected='false'>Register</a>
                    <a class='nav-item nav-link' data-toggle='tab' href='#forgot' role='tab' aria-controls='nav-forgot' aria-selected='false'>Forgot</a>
                </div>

                <div class='tab-content' id='nav-tabContent'>
                    <div id='login' class='tab-pane fade show active'>
                        <form name='<?php bloginfo('url') ?>/wp-login.php' id='<?php $args['form_id'] ?>' action='<?php esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>' method='post'>

                            <div class='form-group'>
                                <input type='text' name='log' id='user_login' class='input form-control' value='<?php echo esc_attr(stripslashes($user_login)); ?>' size='20' placeholder='Username' autocomplete='username' required/>
                            </div>
                            <div class='form-group'>
                                <input type='password' name='pwd' id='user_pass' class='input form-control' value='' size='20' placeholder='Password' autocomplete='current-password' required/>
                            </div>
                            <div class='form-group'>
                                <label class='custom-control custom-checkbox'>
                                    <input name='rememberme' type='checkbox' class='custom-control-input' id='<?php esc_attr( $args['id_remember'] ) ?>' value='forever'
                                    <?php /*( $args['value_remember'] ' checked='checked'' : '' )*/ ?>/> Remember Me
                                </label>
                            </div>

                            <input type='submit' name='wp-submit' id='<?php esc_attr( $args['id_submit'] ) ?>' class='btn btn-primary btn-lg btn-block' value='Login' />
                            <input type='hidden' name='redirect_to' value='<?php echo get_home_url(); ?>/wp-admin/' />
                            <!--'<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>' -->
                            <input type='hidden' name='testcookie' value='1' />
                        </form>
                    </div>

                    <div id='register' class='tab-pane fade'>
                        <h3>Register for this site!</h3>
                        <p>Sign up now for the good stuff.</p>
                        <form method='post' action='<?php echo site_url('wp-login.php?action=register', 'login_post') ?>' class='wp-user-form'>
                            <div class='form-group'>
                                <input class='form-control' id='user_login' name='user_login' value='<?php echo esc_attr(stripslashes($user_login)); ?>' type='text' placeholder='Username' autocapitalize='none' autocomplete='username' maxlength='150' aria-label='username' required>
                            </div>
                            <div class='form-group'>
                                <input class='form-control' type='email' id='user_email' name='user_email' value='<?php echo esc_attr(stripslashes($user_email)); ?>' required placeholder='E-mail' autocomplete='off' aria-label='email'>
                            </div>
                            <div class='form-group'>
                                <input class='form-control' id='id_password' name='password' type='password' placeholder='Password' aria-label='password' autocomplete='current-password'>
                            </div>
                            <div class='form-group'>
                                <input class='form-control' placeholder='Confirm' aria-label='password2'>
                            </div>
                            <div class='form-group'>
                                <label class='custom-control custom-checkbox'>
                                    <input class='custom-control-input' type='checkbox'>
                                    <span class='custom-control-label'>
                                        By creating an account, you agree the<br/><a href='#'>terms and conditions</a>
                                    </span>
                                </label>
                            </div>

                            <?php do_action('register_form'); ?>
                            <input type='submit' name='user-submit' value='<?php _e('Sign up!'); ?>' class='btn btn-primary btn-lg btn-block' tabindex='103' />
                            <?php $register = $_GET['register']; if($register == true) { echo '<p>Check your email for the password!</p>'; } ?>
                            <input type='hidden' name='redirect_to' value='<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?register=true' />
                            <input type='hidden' name='user-cookie' value='1' />
                        </form>
                    </div>

                    <div id='forgot' class='tab-pane fade'>
                        <h3>Lose something?</h3>
                        <p>Enter your username or email to reset your password.</p>
                        <form method='post' action='<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>' class='wp-user-form'>
                            <div class='username'>
                                <label for='user_login' class='hide'><?php _e('Username or Email'); ?>: </label>
                                <input type='text' name='user_login' value='' size='20' id='user_login' tabindex='1001' />
                            </div>
                            <div class='login_fields'>
                                <?php do_action('login_form', 'resetpass'); ?>
                                <input type='submit' name='user-submit' value='<?php _e('Reset my password'); ?>' class='user-submit' tabindex='1002' />
                                <?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
                                <input type='hidden' name='redirect_to' value='<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?reset=true' />
                                <input type='hidden' name='user-cookie' value='1' />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--div class='card-footer bg-white p-0'>
                <div class='card-footer-item card-footer-item-bordered'>
                    <a href='<?php esc_url( wp_registration_url() ) ?>' class='footer-link'>Sign Up</a>
                </div>
                <div class='card-footer-item card-footer-item-bordered'>
                    <a href='<?php esc_url( wp_lostpassword_url() ) ?>' class='footer-link'>Forgot</a>
                </div>
            </div-->
        </div>
    </div>
</div>

<?php get_footer(); ?>