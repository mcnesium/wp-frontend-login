<?php

$action = !empty( $_GET['action'] ) && ($_GET['action'] == 'register' || $_GET['action'] == 'forgot' || $_GET['action'] == 'resetpass') ? $_GET['action'] : 'login';
$success = !empty( $_GET['success'] );
$failed = !empty( $_GET['failed'] ) ? $_GET['failed'] : false;

?>

<?php get_header(); ?>

    <div class="container">
        <div class="row">

            <main class="primary col-md-<?php echo ( is_active_sidebar( 'primary' ) ? 9 : 12 ); ?>" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="page-<?php the_ID(); ?>" class="meta-box hentry">
                    <div id="page-login" class="post-content page-login cf">

                    <?php if ( $action == 'register' && $success ): ?>

                                <header class="entry-header">
                                    <h1>Success!</h1>
                                </header>

                                <div class="message-box message-success">
                                    Check your email for the password and then <a href="/login/">return to login</a>.
                                </div>

                    <?php elseif ( $action == 'forgot' && $success ): ?>

                                <header class="entry-header">
                                    <h1>Password recovery</h1>
                                </header>

                                <div class="message-box message-info">
                                    Check your email for the instructions to get a new password.
                                </div>

                    <?php elseif ( $action == 'resetpass' && $success ): ?>

                                <header class="entry-header">
                                    <h1>Password reset</h1>
                                </header>

                                <div class="message-box message-success">
                                    Your password has been updated. <a href="/login/">Proceed to login</a>.
                                </div>

                    <?php else: ?>

                        <?php if ( $action == 'login' ): ?>


                                    <header class="entry-header">
                                        <h1 class="entry-title">Login</h1>
                                    </header>

                            <?php if ( $failed ): ?>
                                    <div class="message-box message-error">
                                            Invalid username or password. Please try again. <a href="/login/?action=forgot">Forgot password</a>?
                                    </div>
                            <?php endif; ?>

                                    <div class="entry-content">
                                        <p>Don't have an account? <a href="/login/?action=register">Sign up now</a>!</p>
                                    </div>

                                    <?php wp_login_form(); ?>

                        <?php endif; ?>

                        <?php if ( $action == 'register' ): ?>

                                    <header class="entry-header">
                                        <h1 class="entry-title">Register</h1>
                                    </header>

                            <?php if ( $failed ): ?>
                                    <div class="message-box message-error">
                                        <?php switch( $failed ) {
                                            case 'username_exists':
                                                ?>Username already in use.<?php
                                                break;
                                            case 'invalid_username':
                                                ?>Username can only contain alphanumerical characters, "_" and "-". Please choose another username.<?php
                                                break;
                                            case 'email_exists':
                                                ?>E-mail already in use. Maybe you are already registered? <a href="/login/">Try to log in</a> <?php
                                                break;
                                            case 'invalid_email':
                                                ?>The provided E-Mail vas invalid. Please try again.<?php
                                                break;
                                            case 'empty':
                                                ?>All fields are required.<?php
                                                break;
                                            case 'generic':
                                                ?>An error occurred while registering the new user. Please try again.<?php
                                                break;
                                        }?>
                                    </div>
                            <?php endif; ?>

                                    <form name="registerform" id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
                                        <p>
                                            <label for="user_login">Username</label>
                                            <input type="text" name="user_login" id="user_login" class="input" value="">
                                        </p>
                                        <p>
                                            <label for="user_email">E-mail</label>
                                            <input type="text" name="user_email" id="user_email" class="input" value="">
                                        </p>
                                        <p style="display:none">
                                            <label for="confirm_email">Please leave this field empty</label>
                                            <input type="text" name="confirm_email" id="confirm_email" class="input" value="">
                                        </p>

                                        <p id="reg_passmail">A password will be e-mailed to you.</p>

                                        <input type="hidden" name="redirect_to" value="/login/?action=register&amp;success=1" />
                                        <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Register" /></p>
                                    </form>

                        <?php endif; ?>

                        <?php if ( $action == 'forgot' ): ?>

                                    <header class="entry-header">
                                        <h1 class="entry-title">Password recovery</h1>
                                    </header>

                            <?php if ( $failed ): ?>
                                    <div class="message-box message-error">
                                        <?php switch( $failed ) {
                                            case 'wrongkey':
                                                ?>The reset key is wrong or expired. Please check that you used the right reset link or request a new one.<?php
                                                break;
                                            default:
                                                ?>Sorry, we couldn't find any user with that username or email.<?php
                                                break;
                                        }?>
                                    </div>
                            <?php endif; ?>

                                    <div class="entry-content">
                                        <p>Please enter your username or email address. You will receive a link to create a new password.</p>
                                    </div>

                                    <form name="lostpasswordform" id="lostpasswordform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post">
                                        <p>
                                            <label for="user_login">Username or E-mail:</label>
                                            <input type="text" name="user_login" id="user_login" class="input" value="">
                                        </p>

                                        <input type="hidden" name="redirect_to" value="/login/?action=forgot&amp;success=1">
                                        <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password" /></p>
                                    </form>

                        <?php endif; ?>

                        <?php if ( $action == 'resetpass' ): ?>

                            <?php if ( $failed ): ?>
                                    <div class="message-box message-error">
                                        <span class="icon-attention"></span>
                                        The passwords don't match. Please try again.
                                    </div>

                            <?php endif; ?>

                                    <header class="entry-header">
                                        <h1 class="entry-title">Reset password</h1>
                                    </header>

                                    <div class="entry-content">
                                        <p>Create a new password for your account.</p>
                                    </div>

                                    <form name="resetpasswordform" id="resetpasswordform" action="<?php echo site_url('wp-login.php?action=resetpass', 'login_post') ?>" method="post">
                                        <p class="form-password">
                                            <label for="pass1">New Password</label>
                                            <input class="text-input" name="pass1" type="password" id="pass1">
                                        </p>

                                        <p class="form-password">
                                            <label for="pass2">Confirm Password</label>
                                            <input class="text-input" name="pass2" type="password" id="pass2">
                                        </p>

                                        <input type="hidden" name="redirect_to" value="/login/?action=resetpass&amp;success=1">
                                        <?php
                                        $rp_key = '';
                                        $rp_cookie = 'wp-resetpass-' . COOKIEHASH;
                                        if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
                                            list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );
                                        }
                                        ?>
                                        <input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>">
                                        <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password" /></p>
                                    </form>
                        <?php endif; ?>


                    <?php endif; ?>

                    </div>
                </article>

            <?php endwhile; ?>

            </main>

        </div>
    </div>

<?php get_footer(); ?>
