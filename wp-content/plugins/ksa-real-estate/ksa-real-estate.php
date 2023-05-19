<?php
/**
 * Plugin Name:       KSA Real Estate.
 * Plugin URI:        https://allbeua.com
 * Description:       Add post type house and filter by fields ACF from shortcode [property_filter]
 * Version:           1.0.0
 * Author:            KSA
 * Author URI:        https://allbeua.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       https://allbeua.com
 * Domain Path:       /languages
 */

if (!function_exists('is_plugin_active_for_network')) {
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

if (!is_plugin_active('advanced-custom-fields/acf.php')) {
    deactivate_plugins(plugin_basename(__FILE__));
    delete_option('ksa_riel_estate');
    function activate_ksa_riel_estate()
    {
        ?>
        <div class="notice notice-error">
            <p> Please Install and Enable ACF plugin</p>
        </div><br><?php
        @trigger_error(__('Please Install and Enable ACF plugin.', 'cln'), E_USER_ERROR);
    }

    add_action('network_admin_notices', 'activate_ksa_riel_estate');
    register_activation_hook(__FILE__, 'activate_ksa_riel_estate');
} else {
    add_option('ksa_riel_estate', 123);
}

function deactivate_ksa_riel_estate() {
    delete_option('ksa_riel_estate');
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'deactivate_ksa_riel_estate' );



require plugin_dir_path(__FILE__) . 'class-ksa-riel-estate.php';
function run_ksa_riel_estate()
{
    $plugin = new Ksa_Riel_Estate();
}

run_ksa_riel_estate();
flush_rewrite_rules();

