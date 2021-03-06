<?php
/*
Plugin Name: TODO
Plugin URI: TODO
Description: TODO
Version: 1.0
Author: TODO
Author URI: TODO
Author Email: TODO
License:

  Copyright 2013 TODO (email@domain.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// TODO: rename this class to a proper name for your plugin
if ( !class_exists('PluginName' )) :  
class PluginName {

	var $settings;	

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

	    $this->settings = array(
	            'version' => '1.0.0'
	    );			

		// Load plugin text domain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

	    /*
	     * TODO:
	     * Define the custom functionality for your plugin. The first parameter of the
	     * add_action/add_filter calls are the hooks into which your code should fire.
	     *
	     * The second parameter is the function name located within this class. See the stubs
	     * later in the file.
	     *
	     * For more information:
	     * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
	     */
	    add_action( 'TODO', array( $this, 'action_method_name' ) );
	    add_filter( 'TODO', array( $this, 'filter_method_name' ) );

        //only show in admin
        if( is_admin() )
        {
            add_action( 'admin_menu' , array($this,'my_plugin_admin_menu' ));
            add_action( 'admin_notices', array($this,'my_plugin_admin_notices') );
        }	    

	} // end constructor



	/*
	take a look at http://codex.wordpress.org/Function_Reference/add_menu_page
	*/
	public function my_plugin_admin_menu() {

		//decide between add_menu_page and add_options_page below

		$hook_suffix = add_menu_page( __('My Plugin Menu Item', 'plugin-name-locale' ), __('My Plugin', 'plugin-name-locale' ), 'manage_options', '', array($this,'my_plugin_main_page'), plugins_url('universal-uploader/img/uuploader.png'), 100 );
		//$hook_suffix = 	add_options_page( __('My Plugin Menu Item', 'plugin-name-locale'), __('My Plugin', 'plugin-name-locale' ), 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
		add_action( 'load-' . $hook_suffix , array($this,'my_plugin_load_function') );
	}

	public function my_plugin_main_page() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>Here is where the form would go if I actually had options.</p>';
		echo '</div>';
	}

	public function my_plugin_load_function() {
		// Current admin page is the options page for our plugin, so do not display the notice
		// (remove the action responsible for this)	
		remove_action( 'admin_notices', array($this,'my_plugin_admin_notices'));
	}

	public function my_plugin_admin_notices() {
		echo "<div id='notice' class='updated fade'><p>My Plugin is not configured yet. Please do it now.</p></div>\n";
	}

	public function get_setting( $index ) 
	{
		$result = false;
		if (isset($this->settings[$index])) 
		{
			$result = $this->settings[$index];
		} 
		else 
		{
			$result = $this->settings;
		}

		return $result;
	}	

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function activate( $network_wide ) {
		// TODO:	Define activation functionality here
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// TODO:	Define deactivation functionality here
	} // end deactivate

	/**
	 * Fired when the plugin is uninstalled.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function uninstall( $network_wide ) {
		// TODO:	Define uninstall functionality here
	} // end uninstall

	/**
	 * Loads the plugin text domain for translation
	 */
	public function plugin_textdomain() {

		// TODO: replace "plugin-name-locale" with a unique value for your plugin
		$domain = 'plugin-name-locale';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	} // end plugin_textdomain

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_style( 'plugin-name-admin-styles', plugins_url( 'plugin-name/css/admin.css' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_script( 'plugin-name-admin-script', plugins_url( 'plugin-name/js/admin.js' ), array('jquery') );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues plugin-specific styles.
	 */
	public function register_plugin_styles() {

		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_style( 'plugin-name-plugin-styles', plugins_url( 'plugin-name/css/display.css' ) );

	} // end register_plugin_styles

	/**
	 * Registers and enqueues plugin-specific scripts.
	 */
	public function register_plugin_scripts() {

		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_script( 'plugin-name-plugin-script', plugins_url( 'plugin-name/js/display.js' ), array('jquery') );

	} // end register_plugin_scripts

	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	/**
 	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *		  WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
	 *		  Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 */
	function action_method_name() {
    	// TODO:	Define your action method here
	} // end action_method_name

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *		  WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *		  Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 */
	function filter_method_name() {
	    // TODO:	Define your filter method here
	} // end filter_method_name

} // end class

// TODO:	Update the instantiation call of your plugin to the name given at the class definition
function my_plugin()
{
        global $my_plugin;
        
        if( !isset($my_plugin) )
        {
                $my_plugin = new PluginName();
        }
        
        return $my_plugin;
}

my_plugin();

endif; // class_exists bracket