<?php
/*
 * Plugin Name: uCAT - WP Auto Login
 * Version: 1.0
 * Plugin URI: http://ucat.biz/wp-auto-login/
 * Description: Quick login when working locally.
 * Author: uCAT
 * Author URI: http://ucat.biz/
 * Requires at least: 4.0
 * Tested up to: 4.0
 * *
 * @package WordPress
 * @author uCAT
 * @since 1.0.0
 */
class U_Auto_login
{
	
	public static function init()
	{
		add_action('init', array(__CLASS__, 'auto_login') );
	}
	public static function auto_login()
	{
		if( defined( 'U_AUTO_LOGIN' ) && U_AUTO_LOGIN === true && !is_user_logged_in() ){

			if( defined( 'U_AUTO_LOGIN_SECRETTOKEN' ) && (!isset($_GET['u_token']) || $_GET['u_token'] != U_AUTO_LOGIN_SECRETTOKEN) ){
				return;
			}

			if( defined( 'U_AUTO_LOGIN_USERNAME' ) ){
                $username = U_AUTO_LOGIN_USERNAME;				
			}else{
				$super_admins = get_super_admins();
				$username     = $super_admins[0];
			}


			$user = get_user_by('login', $username);
			if( $user ){
            	$user_id  = $user->ID;				
				// let user read private posts
	            if (!$user->has_cap('read_private_posts')) {
	                    $user->add_cap('read_private_posts');
	            }
	            //login
	            wp_set_current_user($user_id, $username);
	            wp_set_auth_cookie($user_id);
	            do_action('wp_login', $username, $user);
			}
		}

	}
}

U_Auto_login::init();