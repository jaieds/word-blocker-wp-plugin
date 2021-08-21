<div class="wrap">
    <h1>Slang Word Blocker Settings</h1>
    <form method="post" action="<?php echo admin_url( 'edit-comments.php?page=slang-word-blocker-settings' ); ?>">
		<?php wp_nonce_field( 'slang_blocker_settings_save', 'slang_blocker_settings_nonce' ); ?>
        <table class="form-table">
            <tr>
                <th>
                    <label for="enable_slang_blocker"><?php esc_html_e( 'Block Slang Words:', 'slang-word-blocker' ); ?></label>
                </th>
                <td>
                    <input name="enable_slang_blocker" type="checkbox"
						<?php echo( esc_attr( get_option( 'enable_slang_blocker', false ) ) ? "checked" : null ) ?>>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="author-title-shortcode"><?php esc_html_e( 'Blocked Words list:', 'slang-word-blocker' ); ?></label>
                </th>
                <td>
                    <textarea name="blocked_word_lists" rows="10"
                              cols="55"><?php echo esc_textarea( get_option( 'blocked_word_lists' ) ); ?></textarea>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>
