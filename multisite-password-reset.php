<?php

/*

Plugin Name: Multisite Password Reset

Plugin URI: https://www.freelancer.com/u/soamnovum.html

Description: Reset all wordpress users password in multisite

Version: 1.0

Author: soamnovum

Author URI: https://www.freelancer.com/u/soamnovum.html

License: GPLv2 or later

Text Domain: multisite-password-reset

*/



/*

This program is free software; you can redistribute it and/or

modify it under the terms of the GNU General Public License

as published by the Free Software Foundation; either version 2

of the License, or (at your option) any later version.



This program is distributed in the hope that it will be useful,

but WITHOUT ANY WARRANTY; without even the implied warranty of

MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

GNU General Public License for more details.



You should have received a copy of the GNU General Public License

along with this program; if not, write to the Free Software

Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.



Copyright 2005-2015 Automattic, Inc.

*/





// A File-nak közvetlen hozzáférés tiltása
if ( !function_exists( 'add_action' ) ) {

	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';

	exit;

}
//A főmappa meghatározása
define( 'MULTIPASSRESET__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

//Futattás a Network kezelő esetében
add_action( 'wp_loaded', 'load_if_networkadmin');
function load_if_networkadmin(){
	if(current_user_can( 'edit_users' ) ) {
		require_once( MULTIPASSRESET__PLUGIN_DIR . 'class.multipassreset.php' );
		require_once( MULTIPASSRESET__PLUGIN_DIR . 'class.multipassreset-admin.php');
		$MPR_OPTIONS = new MPR_OPTIONS();
		//JS regisztrálása 
		add_action( 'admin_enqueue_scripts', array($MPR_OPTIONS,'add_admin_scripts') );
	}
}