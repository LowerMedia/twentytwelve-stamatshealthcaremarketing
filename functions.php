<?php
/*
#
#   REGISTER PARENT CSS
#
*/

function lowermedia_enqueue_parent_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'lowermedia_enqueue_parent_style' );

function lowermedia_register_my_menu() {
  register_nav_menu('footer-social-menu',__( 'Footer Social Menu' ));
}
add_action( 'init', 'lowermedia_register_my_menu' );


/*
#
#   WHITE LABEL
#
*/

//* Replace WordPress login logo with your own
add_action('login_head', 'lm_custom_login_logo');
function lm_custom_login_logo() {
    echo '<style type="text/css">
    h1 a 
    { 
        background-image:url('.get_stylesheet_directory_uri().'/images/login.png) !important; 
        background-size: 311px 100px !important;
        height: 100px !important; 
        width: 311px !important; 
        margin-bottom: 0 !important; 
        padding-bottom: 0 !important; 
    }
    .login form { margin-top: 10px !important; }
    </style>';
}

//* Change the URL of the WordPress login logo
function lm_url_login_logo(){
    return get_bloginfo( 'wpurl' );
}
add_filter('login_headerurl', 'lm_url_login_logo');

//* Login Screen: Change login logo hover text
function lm_login_logo_url_title() {
  return 'A LowerMedia Site';
}
add_filter( 'login_headertitle', 'lm_login_logo_url_title' );

//* Login Screen: Don't inform user which piece of credential was incorrect
function lm_failed_login () {
  return 'The login information you have entered is incorrect. Please try again.';
}
add_filter ( 'login_errors', 'lm_failed_login' );

//* Modify the admin footer text
function lm_modify_footer_admin () {
  echo '<style type="text/css">
        #footer-upgrade{color:transparent;}
        #footer-upgrade:after {
        content: "Created For Stamats Healthcare Marketing";
        color: #777;
        }
    </style>
    <span id="footer-meta"><a href="http://lowermedia.net" target="_blank">A LowerMedia Site</a></span>';
}
add_filter('admin_footer_text', 'lm_modify_footer_admin');

//* Add theme info box into WordPress Dashboard
function lm_add_dashboard_widgets() {
  wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'lm_theme_info');
}
add_action('wp_dashboard_setup', 'lm_add_dashboard_widgets' );
 
function lm_theme_info() {
  echo "<ul>
  <li><strong>Developed By:</strong> LowerMedia.Net</li>
  <li><strong>Website:</strong> <a href='http://lowermedia.net'>www.lowermedia.net</a></li>
  <li><strong>Contact:</strong> <a href='mailto:pete.lower@gmail.com'>pete.lower@gmail.com</a></li>
  </ul>";
}

function custom_admin_logo() {
    echo '
        <style type="text/css">
            #wp-admin-bar-wp-logo { display:none !important; }
        </style>
    ';
}
add_action('admin_head', 'custom_admin_logo');