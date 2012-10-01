<?php
/** Generic archive template.
 * 
 * @package Archimedes
 * @uses archimedes_posts_nav()
 * @uses webcomic()
 * @uses is_webcomic_archive()
 * @uses is_webcomic_storyline()
 * @uses is_webcomic_character()
 * @see codex.wordpress.org/Template_Hierarchy
 */

get_header(); $object = get_queried_object(); $taxonomy = empty( $object->taxonomy ) ? false : get_taxonomy( $object->taxonomy ); ?>

<?php if ( webcomic() and ( is_webcomic_archive() or is_webcomic_storyline() or is_webcomic_character() ) ) : ?>
	<?php get_template_part( 'webcomic/archive' ); ?>
<?php else : ?>
	<section id="main" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php if ( is_day() ) : ?>
					<hgroup>
						<h1><?php _e( 'Daily Archives', 'archimedes' ); ?></h1>
						<h2><?php the_date(); ?></h2>
					</hgroup>
					<?php printf( __( 'Daily Archives: %s', 'archimedes' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
					<hgroup>
						<h1><?php _e( 'Monthly Archives', 'archimedes' ); ?></h1>
						<h2><?php the_date( __( 'F Y', 'archimedes' ) ); ?></h2>
					</hgroup>
				<?php elseif ( is_year() ) : ?>
					<hgroup>
						<h1><?php _e( 'Yearly Archives', 'archimedes' ); ?></h1>
						<h2><?php the_date( _( 'Y', 'archimedes' ) ); ?></h2>
					</hgroup>
				<?php elseif ( is_category() ) : ?>
					<hgroup>
						<h1><?php _e( 'Category Archives', 'archimedes' ); ?></h1>
						<h2><?php single_cat_title(); ?></h2>
					</hgroup>
				<?php elseif ( is_tag() ) : ?>
					<hgroup>
						<h1><?php _e( 'Tag Archives', 'archimedes' ); ?></h1>
						<h2><?php single_tag_title(); ?></h2>
					</hgroup>
				<?php elseif ( is_tax() ) : ?>
					<hgroup>
						<h1><?php printf( __( '%s Archives', 'archimedes' ), $taxonomy->labels->name ); ?></h1>
						<h2><?php echo apply_filters( 'single_term_title', $object->name ); ?></h2>
					</hgroup>
				<?php elseif ( is_author() ) : ?>
					<hgroup>
						<h1><?php _e( 'Author Archives', 'archimedes' ); ?></h1>
						<h2><?php echo apply_filters( 'the_author', $object->display_name ); ?></h2>
					</hgroup>
				<?php elseif ( is_post_type_archive() ) : ?>
					<h1><?php printf( __( '%s Archives', 'archimedes' ), post_type_archive_title( '', false ) ); ?></h1>
				<?php else : ?>
					<h1><?php _e( 'Archives', 'archimedes' ); ?></h1>
				<?php endif; ?>
			</header><!-- .page-header -->
			<?php if ( is_author() and $image = get_avatar( $object->user_email, 60 ) ) : ?>
				<div class="page-image"><?php echo $image; ?></div><!-- .page-image -->
			<?php endif; ?>
			<?php if ( is_category() and $description = category_description() ) : ?>
				<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
			<?php elseif ( is_tag() and $description = tag_description() ) : ?>
				<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
			<?php elseif ( is_tax() and $description = term_description( $object->term_id, $object->taxonomy ) ) : ?>
				<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
			<?php elseif ( is_author() and $description = get_the_author_meta( 'description', $object->ID ) ) : ?>
				<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
			<?php elseif ( is_post_type_archive() and !empty( $object->description ) ) : ?>
				<div class="page-content"><?php echo wpautop( $object->description ); ?></div><!-- .page-content -->
			<?php endif; ?>
			<?php archimedes_posts_nav( 'above' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( webcomic() and is_a_webcomic() ) : ?>
					<?php get_template_part( 'webcomic/content', get_post_type() ); ?>
				<?php else : ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endif; ?>
			<?php endwhile; ?>
			<?php archimedes_posts_nav( 'below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'content-none', 'archive' ); ?>
		<?php endif; ?>
	</section><!-- #main -->
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>