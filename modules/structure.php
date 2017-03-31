<?php

/**
 * Bhari_Post_Author_Structure initial setup
 *
 * @since 0.0.1
 */
if( ! class_exists( 'Bhari_Post_Author_Structure' ) ) :

	class Bhari_Post_Author_Structure {

		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance()
		{
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct()
		{
			add_filter( 'the_content', 												array( $this, 'contents' ) );
			add_filter( 'wp_enqueue_scripts', 										array( $this, 'add_assets' ) );

			// Add Tabs
			add_action( 'bhari_post_author_author-info_tab_items', 					array( $this, 'author_info' ) );
			add_action( 'bhari_post_author_author-posts_tab_items', 				array( $this, 'author_posts' ) );
			add_action( 'bhari_post_author_author-contact_tab_items', 				array( $this, 'author_contact' ) );

			add_action( 'wp_ajax_bhari_post_author_get_all_recent_posts',        	array( $this, 'bhari_post_author_get_all_recent_posts' ) );
            add_action( 'wp_ajax_noprev_bhari_post_author_get_all_recent_posts', 	array( $this, 'bhari_post_author_get_all_recent_posts' ) );

			add_action( 'wp_ajax_bhari_post_author_send_email',        				array( $this, 'bhari_post_author_send_email' ) );
            add_action( 'wp_ajax_noprev_bhari_post_author_send_email', 				array( $this, 'bhari_post_author_send_email' ) );
		}

		function bhari_post_author_send_email() {

			$to      = 'mwaghmare7@gmail.com';
			$subject = 'The subject';
			$body    = 'The email body content';
			$headers = array('Content-Type: text/html; charset=UTF-8');
			
			if( wp_mail( $to, $subject, $body, $headers ) ) {
				echo 'send';
			} else {
				echo 'nope';
			}

			wp_die();
		}

		function bhari_post_author_get_all_recent_posts() {
			$author_id = $_POST['id'];

			$args = array(
				'posts_per_page' => -1,
				// 'offset'         => '-5',
				'author'         => $author_id,
			);

			ob_start();

			$i = 0;
			$myposts = get_posts( $args );
			foreach ($myposts as $post) :
				if( $i > 5 ) {
					?>
					<li>
						<a href="<?php echo get_post_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
						on <?php echo $post->post_date; ?>
					</li>
					<?php
				}
				$i = $i + 1;
			endforeach;

			$output = ob_get_clean();

			echo $output;
			wp_die();
		}

		function add_assets() {

			wp_enqueue_style( 'bhari-post-author', BHARI_POST_AUTHOR_URL . 'assets/css/style.css' );
			wp_enqueue_script( 'bhari-post-author', BHARI_POST_AUTHOR_URL . 'assets/js/bhari-post-author.js', array( 'jquery', 'jquery-ui-tabs' ) );

			wp_localize_script( 'bhari-post-author', 'BhariPostAuthor', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
          	) );
		}

		public static function get_tab_items() {

			/**
			 * To add tab item content
			 * Use hook 'bhari_post_author_{KEY}_tab_items'.
			 *
			 * E.g.
			 *
			 * Use hook 'bhari_post_author_{author-info}_tab_items' for author info.
			 */
			return apply_filters( 'bhari_post_author_tab_items', array(
				'author-posts' => __( 'Author Recent Posts', 'bhari-post-author' ),
				'author-info'  => __( 'Author Info', 'bhari-post-author' ),
				'author-contact'  => __( 'Author Contact', 'bhari-post-author' ),
			) );
		}

		function contents( $contents ) {

			$items = self::get_tab_items();

			ob_start();
			?>

			<div class="bhari-post-author-author-box">

				<ul>
					<?php
					foreach ( $items as $key => $value) {
						?>
						<li><a href="#<?php echo esc_html( $key ); ?>"> <?php echo esc_html( $value ); ?> </a></li>
						<?php
					}
					?>
				</ul>

				<?php
				foreach ( $items as $key => $value) {
					do_action( 'bhari_post_author_'.$key.'_tab_items' );
				}
				?>

				<!-- <div id="_s-tabs-2">
					<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
				</div>
				<div id="_s-tabs-3">
					<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
					<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
				</div> -->

			</div><!-- .bhari-post-author-author-box -->

			<?php
			$author_box = ob_get_clean();

			return $contents . $author_box;
		}

		function author_info( ) {
			?>
			<div id="author-info" class="author-info">
				<div class="thumb">
					<img src="#" />
				</div>
				<div class="details">
					<h3> Author Name </h3>
					<p> description goes here </.p>
				</div>
			</div><!-- .author-info -->
			<?php
		}

		function author_contact( ) {
			?>
			<button class="send-email">Send Email</button>
			<?php
		}

		function author_posts( ) {
			?>
			<div id="author-posts" class="author-posts">
				<h3> Recent Posts </h3>
				<p><?php echo 'Number of posts published by user: ' . count_user_posts( get_the_author_meta( 'ID' ), "post"  ); ?></p>
				<ol class="posts-list">
					<?php
					$args = array(
						'author' => get_the_author_meta( 'ID' ),
					);

					$myposts = get_posts( $args );
					// print_r( $myposts );
					foreach ($myposts as $post) :
						?>
						<li>
							<a href="<?php echo get_post_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
							on <?php echo $post->post_date; ?>
						</li>
					<?php endforeach; 
					?>
				</ol>

				<center><button class="get-all-posts" data-id="<?php echo get_the_author_meta( 'ID' ); ?>"><?php _e( 'See All', 'bhari-post-author' );?></button></center>

			</div><!-- .author-posts -->
			<?php
		}

	}

endif;

/**
 *  Kicking this off by calling 'get_instance()' method
 */
$bhari_post_author_structure = Bhari_Post_Author_Structure::get_instance();

