<?php
/** Generic page template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php get_template_part( 'content', 'page' ); ?>
		
		<?php comments_template( '', true ); ?>
		
	<?php endwhile;?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>