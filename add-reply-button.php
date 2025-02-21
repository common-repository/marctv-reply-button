<?php
/*
  Plugin Name: Add comment reply link after last thread
  Plugin URI: http://marc.tv/marctv-wordpress-plugins/
  Description: Adds an additional reply button at the end of the comment thread. 
  Version: 3.0
  Author: Marc Tönsing
  Author URI: http://marc.tv
  License: GPL2

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
 */

if ( !class_exists( 'AddReplyButton' ) ) {
	class AddReplyButton {

		protected static $version;

		/**
		 * __construct
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			add_action( 'init', array( &$this, 'init' ) );

			// Setting plugin defaults here:
			self::$version = '3.0';

		}

		/**
		 * init function.
		 *
		 * @access public
		 * @return void
		 */
		public function init() {

			if( !is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
				add_action( 'wp_print_scripts', array( $this,'add_scripts_frontend' ) );
			}
		}

		public function add_scripts() {
      wp_enqueue_script( 'add-reply-button', plugins_url( '/add-reply-button.js' ,__FILE__ ), array(), self::$version, 1 );
		}

		/**
		 * add_scripts_frontend function.
		 *
		 * @access public
		 * @return void
		 */
		public function add_scripts_frontend() {

			if ( is_singular() && comments_open() ) {
				$this->add_scripts();
			}
		}
	}
}

//instantiate the class
if ( class_exists( 'AddReplyButton' ) ) {
	new AddReplyButton();
}

?>
