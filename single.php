<?php
/** Single post template.
 * 
 * @package Archimedes
 * @uses webcomic()
 * @uses is_webcomic()
 */

get_header(); ?>

<?php if ( webcomic() and is_webcomic() ) : ?>
	<?php get_template_part( 'webcomic/single', get_post_type() ); ?>
<?php else : ?>
	<section id="main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_type() ); ?>
			<nav class="posts">
				<?php previous_post_link(); ?>
				<?php next_post_link(); ?>
			</nav>
			<?php comments_template( '', true ); ?>
		<?php endwhile; ?>
	</section><!-- #main -->
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>