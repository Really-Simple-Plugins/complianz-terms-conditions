<div class="wrap" id="complianz">
	<?php //this header is a placeholder to ensure notices do not end up in the middle of our code ?>
    <h1 class="cmplz-notice-hook-element"></h1>
	<div id="cmplz-{page}">
		<div id="cmplz-header">
			<img src="<?php echo trailingslashit(cmplz_tc_url)?>assets/images/cmplz-logo.svg" alt="Complianz - Terms & conditions">
            <div class="cmplz-header-right">
                <a href="https://complianz.io/docs/" class="link-black" target="_blank"><?php _e("Documentation", 'complianz-terms-conditions')?></a>
                <a href="https://wordpress.org/support/plugin/complianz-terms-conditions/" class="button button-black" target="_blank"><?php echo _e("Support", 'complianz-terms-conditions') ?></a>
            </div>
		</div>
		<div id="cmplz-content-area">
			{content}
		</div>
	</div>
</div>
