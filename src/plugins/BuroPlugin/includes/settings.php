<?php
if(!class_exists('BuroWordpress_Settings'))
{
    class BuroWordpress_Settings
    {
        const SLUG = "custom-plugin-options";

        /**
         * Construct the plugin object
         */
        public function __construct($plugin)
        {
            // register actions
            acf_add_options_page(array(
                'page_title' => __('Buro Wordpress', 'custom'),
                'menu_title' => __('Buro Wordpress', 'custom'),
                'menu_slug' => self::SLUG,
                'capability' => 'manage_options',
                'redirect' => false
            ));

            

            require_once('acf_fields.php');

            add_action('init', array(&$this, "init"));
            add_action('admin_menu', array(&$this, 'admin_menu'), 20);
            add_filter("plugin_action_links_$plugin", array(&$this, 'plugin_settings_link'));

            /*CUSTOM FUNCTIONS FROM PLUGIN SETTINGS*/
            add_action('init', array(&$this, "hide_pages"));
            add_action('init', array(&$this, "environment"));
            add_action('init', array(&$this, "restrict_deletions"));
            add_action('init', array(&$this, "custom_includes"));
            add_action( 'wp_loaded', array(&$this, "config_all_cpt") );
            add_action('init', array(&$this, "require_plugins"));



        } // END public function __construct

        /**
         * Add options page
         */
        public function admin_menu()
        {
            // Duplicate link into properties mgmt
            add_submenu_page(
                self::SLUG,
                __('Settings', 'custom'),
                __('Settings', 'custom'),
                'manage_options',
                self::SLUG,
                1
            );
        }

        /**
         * Add settings fields via ACF
         */
        function init()
        {

            if(function_exists('acf_add_local_field_group')) {
               buroSettings(self::SLUG);
            }

        }

        #-----------------------------------------------------------------#
        # Restrict DELETIONS
        #-----------------------------------------------------------------#
        function restrict_deletions() {
          $master_account = get_field("master_account");
          $sec_master_account = get_field("sec_master_account");
          $current_user = wp_get_current_user();

          if($master_account == "") return;

          if($current_user->ID != $master_account["ID"] && $current_user->ID != $sec_master_account["ID"]){
            add_action( 'delete_user', 'dont_delete_user' );
            add_action('wp_trash_post', 'restrict_post_type_deletion', 10, 1);
            add_action('before_delete_post', 'restrict_post_type_deletion', 10, 1);
          }
          //Restrict user deletion
          function dont_delete_user( $id ) {
            $users = get_field("restrict_user_deletion","option");
            foreach( $users as $user):
              if( $id == $user["ID"] )
                wp_die( 'You cannot delete this user account.' );
            endforeach;
          }

          //Restrict Posts Type Deletion
          function restrict_post_type_deletion($post_ID){
            $post_types = get_field("restrict_post_type_deletion","option");
            foreach( $post_types as $post_type):
              if(get_post_type($post_ID) == $post_type["post_type"]){
                wp_die( 'You cannot delete this page.' );
              }
            endforeach;
          }
        }

        #-----------------------------------------------------------------#
        # HIDE PAGES FROM USERS
        #-----------------------------------------------------------------#
        function hide_pages() {
          $pages = get_field("hide_pages_from_client", "option");
          $master_account = get_field("master_account", "option");
          $sec_master_account = get_field("sec_master_account", "option");
          $rh_account = get_field("rh_account", "option");
          $hide_master = get_field("hide_from_master", "option");
          $hide_cpt_master = get_field("hide_cpt_from_master", "option");
          $current_user = wp_get_current_user();

          if($master_account == "" || $master_account == null || sizeof($master_account) < 1 )
            $master_account["ID"] = null;

          if($current_user->ID != $master_account["ID"] && $current_user->ID != $sec_master_account["ID"]){
            add_action( 'admin_menu', 'remove_cpt_menus' );
            add_action( 'admin_menu', 'remove_menus', 99);
            add_action( 'pre_get_posts' ,'hide_pages_from_user' );
            add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
            add_action('admin_head', 'hide_add_new_button');
            add_action('admin_head', 'hide_buro_admin');
          }


         
          if($hide_master)
            add_action( 'pre_get_posts' ,'hide_pages_from_user' );
          if($hide_cpt_master)
            add_action( 'admin_menu', 'remove_cpt_menus' );

          function remove_cpt_menus() {
            $cpts = get_field("hide_cpt_from_client", "option");
            if($cpts == "") return;
            foreach($cpts as $cpt) :
              $type = "edit.php?post_type=" . $cpt["post_type"];
              remove_menu_page( $type );
            endforeach;
          }
          //Custom CSS to hide some fields to user
          function hide_buro_admin() {
            echo  '<style>
                    .buro-admin,
                    #menu-dashboard li:last-child,
                    #acf-group_5559f9e8747d1,
                    #acf-group_55a636044d9ab{ display : none; }
                  </style>';
          }

          //Hide Posts From user - ex. Static stuff for development
          function hide_pages_from_user( $query ) {
            $pages = get_field("hide_pages_from_client","option");

            global $pagenow;
            if( 'edit.php' == $pagenow && ( get_query_var('post_type') && 'page' == get_query_var('post_type') ) )
              $query->set( 'post__not_in', $pages );
            return $query;
          }

          //Remove menu links
          function remove_menus(){
            $rh_account = get_field("rh_account", "option");

            //remove_menu_page( 'index.php' );                  //Dashboard
            remove_menu_page( 'edit.php' );                   //Posts
            //remove_menu_page( 'upload.php' );                 //Media
            //remove_menu_page( 'edit.php?post_type=page' );    //Pages
            remove_menu_page( 'edit-comments.php' );          //Comments
            remove_menu_page( 'themes.php' );                 //Appearance
            remove_menu_page( 'plugins.php' );                //Plugins
            remove_menu_page( 'users.php' );                  //Users
            remove_menu_page( 'tools.php' );                  //Tools
            remove_menu_page( 'options-general.php' );        //Settings

            
            remove_menu_page( 'GADWP_Config' );
            remove_menu_page( 'WP-Optimize' );
            remove_menu_page( 'wpcf7' );
            remove_menu_page( 'mlang' );
            remove_menu_page( 'postman' );
            remove_menu_page( 'acf-options-general-setings' );
            remove_menu_page( 'edit.php?post_type=acf-field-group' );
            remove_menu_page( 'gadash_settings' );
            remove_menu_page('w3tc_dashboard');
            remove_menu_page('admin.php?page=Wordfence');


            // remove new post button from the custom post type if not admin
            $page = remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' );
            // remove_submenu_page( 'edit.php?post_type=jobs', 'edit-tags.php?taxonomy=jobs_location&post_type=jobs' );

            // unset($submenu['index.php'][10]);
            // unset($submenu['options-general.php'][15]); // Writing
            // unset($submenu['options-general.php'][20]); // Reading
            // unset($submenu['options-general.php'][25]); // Discussion
            // unset($submenu['options-general.php'][30]); // Media
            // unset($submenu['options-general.php'][35]); // Privacy
            // unset($submenu['options-general.php'][40]); // Permalinks
            // unset($submenu['options-general.php'][45]); // Misc

            if($rh_account == "" || $rh_account == null || sizeof($rh_account) < 1 ){
              $rh_account = array();
              $rh_account["ID"] = null;
            }
            
            if ( wp_get_current_user()->ID == $rh_account["ID"] ) {
              remove_menu_page( 'upload.php' );
              remove_menu_page( 'index.php' );                  //Dashboard
              remove_menu_page( 'edit.php?post_type=page' );    //Pages
              remove_menu_page('edit.php?post_type=ajax');
              remove_menu_page('edit.php?page=general-setings');
              remove_menu_page('edit.php?post_type=noticias');
              remove_menu_page('edit.php?post_type=candidaturas');


              echo  '<style>
                    #toplevel_page_general-setings { display: none; }
                  </style>';
          

            }
          }

          function remove_admin_bar_links() {
            global $wp_admin_bar;
            //$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
            $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
            $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
            $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
            $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
            $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
            $wp_admin_bar->remove_menu('updates');          // Remove the updates link
            $wp_admin_bar->remove_menu('comments');         // Remove the comments link
            $wp_admin_bar->remove_menu('new-content');      // Remove the content link
            $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link

          }

          function hide_add_new_button() {
            global $submenu;
            $post_types = get_field("restrict_add_new_post","option");
            if($post_types) :
              foreach( $post_types as $post_type) :
                $string = "edit.php?post_type=" . $post_type['post_type'];
                unset($submenu[$string][10]);
                echo  '<style>
                        .post-type-' . $post_type["post_type"] . ' .page-title-action { display : none; }
                      </style>';
              endforeach;
            endif;
          }
        }//End Hide Function



        #-----------------------------------------------------------------#
        # CONFIG VARIABLES SETUP IN ALL CPT
        #-----------------------------------------------------------------#
        function config_all_cpt(){


          $rh_account = get_field("rh_account", "option");
          if($rh_account == "" || $rh_account == null || sizeof($rh_account) < 1 ) {
            $rh_account = array();
            $rh_account["ID"] = null; 
          }
          
          if ( wp_get_current_user()->ID != $rh_account["ID"] ) {

            if( function_exists('acf_add_options_page') ) {
              $option_page = acf_add_options_page(array(
                'page_title'  => 'Definições Gerais',
                'menu_title'  => 'Definições Gerais',
                'menu_slug'   => 'general-setings',
                'capability'  => 'edit_posts',
                'redirect'  => false
              ));
            }
          }

          $post_types = get_post_types('', 'names' );
          $posts_in = array ( );

          foreach ($post_types as $post_type) {
            $add = array ( array (
                      'param' => 'post_type',
                      'operator' => '==',
                      'value' => $post_type,
                    ));

            array_push($posts_in,$add);
          }

         if( function_exists('acf_add_local_field_group') ) :

            $args = array(
               'public'   => true,
               '_builtin' => false
            );
            $output = 'names'; // names or objects, note names is the default
            $operator = 'and'; // 'and' or 'or'


            globalConfig($posts_in);

          endif;
        }

        #-----------------------------------------------------------------#
        # CUSTOM SCRIPTS INCLUDES
        #-----------------------------------------------------------------#
        function custom_includes() {
          require_once('buro_defaults.php');
          require_once('buro_util_functions.php');
          require_once('duplicate_posts.php');

          require_once('Mobile_Detect.php');

        }

        #-----------------------------------------------------------------#
        # INCLUDE TGM FOR PLUGINS REQUIREMENTS
        #-----------------------------------------------------------------#
        function require_plugins() {
          add_action( 'tgmpa_register', 'buro_require_plugins' );
          function buro_require_plugins() {

            $plugins_needed = get_field("plugins_needed", "option");
            $plugins = array ( );

            if($plugins_needed)
              foreach ($plugins_needed as $plugin_needed) {
                $add =  array (
                          'name' => $plugin_needed["plugin_name"],
                          'slug' => $plugin_needed["plugin_slug"],
                          'required' => $plugin_needed["plugin_required"]
                        );
                array_push($plugins,$add);
              }
            array_push($plugins,
              array(
                'name'      => 'Force Regenerate Thumbnails',
                'slug'      => 'force-regenerate-thumbnails',
                'required'  => false, // this plugin is recommended
              )
            );
            array_push($plugins,
              array(
                'name'      => 'W3 Total Cache',
                'slug'      => 'w3-total-cache',
                'required'  => false, // this plugin is recommended
              )
            );
            array_push($plugins,
              array(
                'name'      => 'Password Protected',
                'slug'      => 'password-protected',
                'required'  => false, // this plugin is recommended
              )
            );
            array_push($plugins,
              array(
                'name'      => 'Php Browser Detection',
                'slug'      => 'php-browser-detection',
                'required'  => false, // this plugin is recommended
              )
            );
            array_push($plugins,
              array(
                'name'      => 'Google XML Sitemaps',
                'slug'      => 'google-sitemap-generator',
                'required'  => false, // this plugin is recommended
              )
            );
            array_push($plugins,
              array(
                'name'      => 'Advanced Custom Fields: Post Type Selector',
                'slug'      => 'acf-post-type-selector',
                'source'    => dirname(__FILE__) . '/acf-post-type-selector.zip', // The "internal" source of the plugin.
                'required'  => true, // this plugin is required
              )
            );

            $config = array(
              'id'           => 'buro-tgmpa', // your unique TGMPA ID
              'menu'         => 'buro-tgmp', // menu slug
              'has_notices'  => false, // Show admin notices
              'dismissable'  => false, // the notices are NOT dismissable
              'dismiss_msg'  => 'I really, really need you to install these plugins, okay?', // this message will be output at top of nag
              'is_automatic' => true, // automatically activate plugins after installation
              'message'      => '<!--Hey there.-->', // message to output right before the plugins table
              'strings'      => array() // The array of message strings that TGM Plugin Activation uses
            );
            tgmpa( $plugins, $config );
          }
        }
        #-----------------------------------------------------------------#
        # ENVIRONMENT
        #-----------------------------------------------------------------#
        function environment() {
          $env = get_field("environment","option");
          define('ENVIRONMENT',$env);
        }

        /**
         * Add the settings link to the plugins page
         */
        public function plugin_settings_link($links)
        {
            $settings_link = sprintf('<a href="admin.php?page=%s">Settings</a>', self::SLUG);
            array_unshift($links, $settings_link);
            return $links;
        } // END public function plugin_settings_link($links)
    } // END class BuroWordpress_Settings
} // END if(!class_exists('BuroWordpress_Settings'))