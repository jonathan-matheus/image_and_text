<?php
$iat_text_list = get_post_meta($post->ID, 'iat_text', true);
?>
<label for="iat_text"><?php _e('Text List', 'image-and-text'); ?></label>
<textarea style="width: 100%;" id="iat_text" name="iat_text" rows="5" cols="30">
<?= $iat_text_list; ?>
</textarea>