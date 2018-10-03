<?php
/**
 * @package Buro Wordpress Defaults
 * @version 1.0
 */
/*
Plugin Name:  Buro Defaults
Description:  Defaults de Wordpress usados em todos os sites buro
Version:      1.0
Author:       Daniel Vaz
*/

if(!class_exists("BuroWordpress"))
{
    /**
     * class:   BuroWordpress
     * desc:    plugin class to allow reports be pulled from multipe GA accounts
     */
    class BuroWordpress
    {
        /**
         * Created an instance of the BuroWordpress class
         */
        public function __construct()
        {
            // Set up ACF
            add_filter('acf/settings/path', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", dirname(__FILE__));
            });
            add_filter('acf/settings/dir', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", plugin_dir_url(__FILE__));
            });
            require_once(sprintf("%s/includes/advanced-custom-fields-pro/acf.php", dirname(__FILE__)));

            // Settings managed via ACF
            require_once(sprintf("%s/includes/settings.php", dirname(__FILE__)));
            $settings = new BuroWordpress_Settings(plugin_basename(__FILE__));

            // CPT for example post type
            // require_once(sprintf("%s/includes/snippets-cpt.php", dirname(__FILE__)));
            // $burosnippets = new Buro_Snippets();

            require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

        } // END public function __construct()

        /**
         * Hook into the WordPress activate hook
         */
        public static function activate()
        {
            // Do something
        }

        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate()
        {
            // Do something
        }
    } // END class BuroWordpress
} // END if(!class_exists("BuroWordpress"))

if(class_exists('BuroWordpress'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('BuroWordpress', 'activate'));
    register_deactivation_hook(__FILE__, array('BuroWordpress', 'deactivate'));

    // instantiate the plugin class
    $plugin = new BuroWordpress();
} // END if(class_exists('BuroWordpress'))

?>