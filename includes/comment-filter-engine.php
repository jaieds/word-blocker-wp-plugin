<?php

if ( get_option( 'enable_slang_blocker', false ) ) {
	add_filter( 'comment_text', 'filter_the_comment_text', 2 );
	function filter_the_comment_text( $comment ) {
		$slang_word_dict = explode( ',', get_option( 'blocked_word_lists' ) );

		if ( count( $slang_word_dict ) < 1 ) {
			return $comment;
		}

		$comment = preg_replace( $slang_word_dict, '<b>***</b>', $comment );

		return $comment;
	}
}