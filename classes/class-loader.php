<?php

/**
 * Bhari_Post_Author initial setup
 *
 * @since 0.0.1
 */
if( !class_exists('Bhari_Post_Author') ) :

	class Bhari_Post_Author {

		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			self::define_constants();
			self::load_files();
		}

		/**
		 * Define Constants.
		 *
		 * @since 0.0.1
		 * @return void
		 */ 
		static private function define_constants() {	
			define('BHARI_POST_AUTHOR_VERSION', 			'0.0.1');
			define('BHARI_POST_AUTHOR_FILE', 				trailingslashit(dirname(dirname(__FILE__))) . 'bhari-post-author.php');
			define('BHARI_POST_AUTHOR_PLUGIN_BASE', 		plugin_basename( BHARI_POST_AUTHOR_FILE ) );
			define('BHARI_POST_AUTHOR_DIR', 				plugin_dir_path( BHARI_POST_AUTHOR_FILE ) );
			define('BHARI_POST_AUTHOR_URL', 				plugins_url( '/', BHARI_POST_AUTHOR_FILE ) );
			define('BHARI_POST_AUTHOR_FILE_ASSETS_URL', 	BHARI_POST_AUTHOR_URL . 'assets/' );
		}

		/**
		 * Loads classes and includes.
		 *
		 * @since 0.0.1
		 * @return void
		 */ 
		static private function load_files()
		{
			/* Required Main File */
			// require_once BHARI_POST_AUTHOR_DIR . 'classes/class-metabox.php';
			// require_once BHARI_POST_AUTHOR_DIR . 'classes/class-customizer.php';

			/* Author Features */
			require_once BHARI_POST_AUTHOR_DIR . 'modules/structure.php';
			// require_once BHARI_POST_AUTHOR_DIR . 'modules/class-author-info.php';
			// require_once BHARI_POST_AUTHOR_DIR . 'modules/class-author-posts.php';
			// require_once BHARI_POST_AUTHOR_DIR . 'modules/class-author-contact.php';
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	$Bhari_Post_Author = Bhari_Post_Author::get_instance();

endif;
