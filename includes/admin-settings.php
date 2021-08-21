<?php

class Slang_Blocker {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menu_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_styles' ) );
	}

	public function register_menu_page() {
		add_submenu_page(
			'edit-comments.php',
			esc_html__( 'Slang Word Blocker Settings', 'slang-word-blocker' ),
			esc_html__( 'Settings', 'slang-word-blocker' ),
			'manage_options',
			'slang-word-blocker-settings',
			array( $this, 'render_settings_page' )
		);
	}

	public function render_settings_page() {
		if ( isset( $_POST['slang_blocker_settings_nonce'] ) ) {
			$this->save_settings();
		}
		include dirname( __FILE__ ) . '/templates/settings-page.php';
	}

	public function add_styles( $hook ) {
		if ( 'comments_page_slang-word-blocker-settings' != $hook ) {
			return;
		}
		wp_register_style(
			'slang_blocker',
			plugins_url( '/includes/css/style.css', SLANG_BLOCKER_LOCATION ),
			array(),
			SLANG_BLOCKER_VERSION
		);
		wp_enqueue_style( 'slang_blocker' );

		wp_register_script(
			'slang_blocker',
			plugins_url( '/includes/js/script.js', SLANG_BLOCKER_LOCATION ),
			array(),
			SLANG_BLOCKER_VERSION,
			true
		);
		wp_enqueue_script( 'slang_blocker' );
	}

	function save_settings() {
		if ( ! wp_verify_nonce( $_POST['slang_blocker_settings_nonce'], 'slang_blocker_settings_save' ) ) {
			wp_die( esc_html__( 'Security token invalid', 'slang-word-blocker' ) );
		}

		if ( ! isset( $_POST['blocked_word_lists'] ) ) {
			wp_die( esc_html__( 'Invalid Input!', 'slang-word-blocker' ) );
		}

		$word_list = sanitize_textarea_field( $_POST['blocked_word_lists'] );
		$word_list = trim( preg_replace( "/[ ]*/", '', $word_list ), ",;." );

		if ( ! $this->validate_settings( $word_list ) ) {
			return;
		}

		update_option( 'enable_slang_blocker', $_POST['enable_slang_blocker'] );
		update_option( 'blocked_word_lists', $word_list );

		$this->show_success_message();
	}

	function validate_settings( $word_list ) {
		if ( ( $_POST['enable_slang_blocker'] != '' ) && ( $word_list == '' || empty( $word_list ) ) ) {
			$this->show_error_message( esc_html__( 'Word list is empty.', 'slang-word-blocker' ) );

			return false;
		}

		return true;
	}

	function show_success_message() {
		include dirname( __FILE__ ) . '/templates/success_message.php';
	}

	function show_error_message( $message ) {
		include dirname( __FILE__ ) . '/templates/error_message.php';
	}

}

$slang_blocker_settings = new Slang_Blocker();