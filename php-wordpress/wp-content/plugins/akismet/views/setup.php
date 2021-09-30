<h3><?php esc_html_e( 'Set Up Akismet' , 'akismet' );?></h3>
<div class="akismet-right">
	<?php Akismet::view( 'get', array( 'text' => __( 'Set up your Akismet account' , 'akismet' ), 'classes' => array( 'akismet-button', 'akismet-is-primary' ) ) ); ?>
</div>
<p><?php esc_html_e( 'Set up your Akismet account to enable spam filtering on this site.', 'akismet' ); ?></p>