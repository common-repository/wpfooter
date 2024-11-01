<?php
/**
 * Plugin Name: WPfooter
 * Plugin URI: http://wpfooter.com
 * Description: This plugin allows you to add tracking pixels, analytics tags and custom code to every page of your site.
 * Version: 1.0.0
 * Author: mediacambridge
 * Author URI: http://wpfooter.com
 * License: GPL2
 */

add_action( 'wp_footer', 'wpfooter' );
function wpfooter() {
  echo get_option('wpfooter');

}

add_action( 'wp_head', 'wpheader' );
function wpheader(){
    if (get_option('hidecredits') == 1) {
        echo '<style>span.credit-link { display: none !important; } .site-info { display: none !important; }</style>';
    }
}

add_action('admin_menu', 'wpfooter_menu');

function wpfooter_menu() {
	add_menu_page('WPfooter Settings', 'WPfooter', 'administrator', 'wpfooter-settings', 'wpfooter_settings_page', 'dashicons-download');
}

function wpfooter_settings_page() {
?>
<div class="wrap">
<h2>WPfooter</h2>
<p>Enter your code or text in the text area below and it will be inserted in to the footer of your website</p>
<form method="post" action="options.php">
    <?php settings_fields( 'wpfooter-settings-group' ); ?>
    <?php do_settings_sections( 'wpfooter-settings-group' ); ?>
    <textarea style="width: 100%; height: 300px;" name="wpfooter"><?php echo esc_attr( get_option('wpfooter') ); ?></textarea><br>
    <input type="checkbox" name="hidecredits" value="1"> Hide Credits 
    <br>
    <?php submit_button(); ?>
</form>
</div>

<?php
}

add_action( 'admin_init', 'wpfooter_settings' );

function wpfooter_settings() {
	register_setting( 'wpfooter-settings-group', 'wpfooter' );
    register_setting( 'wpfooter-settings-group', 'hidecredits' );
}