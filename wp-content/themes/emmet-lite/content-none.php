<?php
/**
 * The default template for displaying content
 *
 * Used for  index/archive/search.
 *
 * @package WordPress
 * @subpackage Emmet
 * @since Emmet 1.0
 */
?>
<article class="post no-results not-found">
    <div class="entry-content">
		<h3 class="entry-title"><?php _e('Nothing Found', 'emmet-lite'); ?></h3>
		<?php if (is_home() && current_user_can('publish_posts')) : ?>
			<p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'emmet-lite'), esc_url(admin_url('post-new.php'))); ?></p>
		<?php elseif (is_search()) : ?>
			<p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'emmet-lite'); ?></p>
		<?php else : ?>
			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'emmet-lite'); ?></p>
		<?php endif; ?>
		<?php get_search_form(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-0 -->