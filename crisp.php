<?php
/**
 * @package Crisp
 * @version 0.1
 */
/*
Plugin Name: Crisp
Plugin URI: http://wordpress.org/plugins/crisp/
Description: Crisp is a Livechat plugin
Author: Crisp Communications
Version: 0.1
Author URI: https://crisp.im
*/


add_action('admin_menu', 'crisp_create_menu');

function crisp_create_menu() {
  add_menu_page('Crisp Settings', 'Crisp Settings', 'administrator', __FILE__, 'crisp_plugin_settings_page' , 'https://crisp.im/favicon.png');
  add_action( 'admin_init', 'register_crisp_plugin_settings' );
}


function register_crisp_plugin_settings() {
  register_setting( 'crisp-plugin-settings-group', 'website_id' );
}

function crisp_plugin_settings_page() {
?>
<div class="wrap">
<h2>Crisp</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'crisp-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'crisp-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Website Id</th>
        <td><a href="https://app.crisp.im/#/settings/websites">Get your Website Id here</a></td>
        <td><input type="text" name="website_id" value="<?php echo esc_attr( get_option('website_id') ); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php }

add_action('wp_head', 'hook_head');

function hook_head() {

  $website_id = get_option('website_id');
  $output="<script type='text/javascript'>
    CRISP_WEBSITE_ID = '$website_id';
    (function(){
      d=document;s=d.createElement('script');
      s.src='https://client.crisp.im/l.js';
      s.async=1;d.getElementsByTagName('head')[0].appendChild(s);
    })();
  </script>";

  echo $output;

}
?>