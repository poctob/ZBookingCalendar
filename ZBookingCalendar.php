<?php
/**
 * Plugin Name: ZBookingCalendar
 * Plugin URI: http://www.xpresstek.net/ZBookingCalendar
 * Description: Booking calendar implementation
 * Version: 0.1
 * Author: XpressTek
 * Author URI: http://www.xpresstek.net
 * License: GPL2
 * 
 */
/* 
    Copyright 2014  XpressTek LLC.  (email : info@xpresstek.net)

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


if(!class_exists('ZBookingCalendar'))
{
    /**
     * ZBookingCalendar 
     * Main entrance point to the application.
     * performs initialization and housekeeping functionality
     */
    class ZBookingCalendar
    {
        /**
         * Constuctor
         */
        public  function __construct() {
            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'add_menu'));            
        }
        
        /**
         * Activates the plugin
         */
        public static function activate()
        {
        }
        
        /**
         * Deactivates the plugin
         */
        public static function deactivate()
        {
            
        }
        
        /**
         * Admin area initializer
         */
        public function admin_init()
        {
            $this->init_settings();
        }
        
        /**
         * Custom settings initializaion
         */
        public function init_settings()
        {
            register_setting('zbc-group', 'setting1');
            register_setting('zbc-group', 'setting2');
        }
        
        /**
         * Plugin configuration menu.
         */
        public function add_menu()
        {
            add_options_page(
                    'ZBookingCalendar Settings', 
                    'ZBookingCalendar', 
                    'manage_options', 
                    'ZBookingCalendar', 
                    array(&$this, 'plugin_settings_page')); 
        }
        
        /**
         * Callback for the settings menu option
         */
        public function plugin_settings_page()
        {
            if(!current_user_can('manage_options'))
            {
                wp_die(__('Access Denied!'));                                
            }
            include (sprintf("%s/templates/settings.php", dirname(__FILE__)));
        }
    }
}

if(class_exists(ZBookingCalendar))
{
    //activation deactivation hooks
    register_activation_hook(__FILE__, array('ZBookingCalendar', 'activate'));
    register_deactivation_hook(__FILE__, array('ZBookingCalendar', 'deactivate'));
    
    //class initialization
    $zbc = new ZBookingCalendar();
}

if(isset($zbc))
{
    function plugin_settings_link($links)
    {
        $settings_link = '<a href="options-general.php?page=ZBookingCalendar">Settings</a>'; 
        array_unshift($links, $settings_link); 
        
        return $links;
    }
    
    $plugin = plugin_basename(__FILE__); 
    add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
}
