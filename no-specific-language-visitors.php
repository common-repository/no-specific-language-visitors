<?php
/*

**************************************************************************

Plugin Name:  No Specific Language Visitors
Plugin URI:   http://www.arefly.com/no-specific-language-visitors/
Description:  Disallow Specific Language Visitors in Your Blog. 在你的部落格中禁止特定語言的訪客
Version:      1.0.6
Author:       Arefly
Author URI:   http://www.arefly.com/
Text Domain:  no-specific-language-visitors
Domain Path:  /lang/

**************************************************************************

	Copyright 2014  Arefly  (email : eflyjason@gmail.com)

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

**************************************************************************/

define("NO_SPECIFIC_LANGUAGE_VISITORS_PLUGIN_URL", plugin_dir_url( __FILE__ ));
define("NO_SPECIFIC_LANGUAGE_VISITORS_FULL_DIR", plugin_dir_path( __FILE__ ));
define("NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN", "no-specific-language-visitors");

/* Plugin Localize */
function no_specific_language_visitors_load_plugin_textdomain() {
	load_plugin_textdomain(NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN, false, dirname(plugin_basename( __FILE__ )).'/lang/');
}
add_action('plugins_loaded', 'no_specific_language_visitors_load_plugin_textdomain');

include_once NO_SPECIFIC_LANGUAGE_VISITORS_FULL_DIR."options.php";

/* Add Links to Plugins Management Page */
function no_specific_language_visitors_action_links($links){
	$links[] = '<a href="'.get_admin_url(null, 'options-general.php?page='.NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN.'-options').'">'.__("Settings", NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN).'</a>';
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'no_specific_language_visitors_action_links');

function no_specific_language_visitors(){
	$lang_option = explode("|", get_option("no_specific_language_visitors_lang"));
	foreach($lang_option as $ban_lang){
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, mb_strlen($ban_lang));
		if($lang == $ban_lang){
			if( (!is_admin()) && (!in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) ){
				$message = nl2br(get_option("no_specific_language_visitors_notice"));
				header("Content-type: text/html; charset=utf-8");
				wp_die($message);
				exit;
			}
		}
	}
}
add_action('init', 'no_specific_language_visitors');
