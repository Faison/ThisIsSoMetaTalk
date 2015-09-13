<?php
/**
 * The template for displaying Single Team Members
 *
 * @package FZ Talk
 * @since 0.1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', \FZ_Projects\Projects\get_projects_post_type_name() ); ?>

		<?php endwhile; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
