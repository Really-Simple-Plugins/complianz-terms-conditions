<?php
if (function_exists('cmplz_get_value')) {
    $high_contrast = cmplz_get_value('high_contrast', false, 'settings') ? 'cmplz-high-contrast' : '';
} else {
    $high_contrast = '';
} ?>
<div class="cmplz wrap <?php echo $high_contrast ?>" id="complianz">
	<?php //this header is a placeholder to ensure notices do not end up in the middle of our code ?>
    <h1 class="cmplz-notice-hook-element"></h1>
	<div class="cmplz-{page}">
        <div class="cmplz-header-container">
            <div class="cmplz-header">
                <img src="<?php echo trailingslashit(cmplz_tc_url)?>assets/images/cmplz-logo.svg" alt="Complianz - Terms & Conditions">
                <div class="cmplz-header-right">
                    <a href="https://complianz.io/docs/" class="link-black" target="_blank"><?php _e("Documentation", 'complianz-terms-conditions')?></a>
                    <a href="https://wordpress.org/support/plugin/complianz-terms-conditions/" class="button button-black" target="_blank"><?php echo _e("Support", 'complianz-terms-conditions') ?></a>
                </div>
            </div>
		</div>
		<div class="cmplz-content-area">
			{content}
		</div>
	</div>
</div>
