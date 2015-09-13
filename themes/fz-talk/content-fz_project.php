<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="fz-width-wrap">
		<header class="entry-header group">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="fz-team-member-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_single() ) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
			<?php endif; // is_single() ?>

			<?php if ( ! empty( \FZ_Projects\Projects\get_project_tagline() ) ) : ?>
				<div class="entry-subtitle">
					<?php echo esc_html( \FZ_Projects\Projects\get_project_tagline() ); ?>
				</div>
			<?php endif; ?>
			<div class="entry-meta">
				<?php if ( ! empty( \FZ_Projects\Projects\get_project_github_url() ) ) : ?>
					<span class='symbol'><a href="<?php echo esc_url( \FZ_Projects\Projects\get_-project_github_url() ); ?>">githubalt</a></span>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
	</div>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php
	$project_lead = \FZ_Projects\Projects\get_project_lead();
	$team_members = \FZ_Projects\Projects\get_project_team_members();

	$all_members = array();

	if ( ! empty( $team_members ) ) {
		$all_members = $team_members;
	}

	if ( ! empty( $project_lead ) ) {
		array_unshift( $all_members, $project_lead );
	}

	if ( ! empty( $all_members ) ) : ?>
	<div class="fz-width-wrap">
		<div class="entry-additionals">
			<?php foreach ( $all_members as $member ) : ?>
				<div class="project-member <?php if ( true === $member['project_lead'] ) { echo 'project-lead'; } ?>">
					<a href="<?php echo esc_url( $member['permalink'] ); ?>">
						<img src="<?php echo esc_url( $member['image_src'] ); ?>" />
						<h3><?php echo esc_html( $member['title'] ); ?></h3>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>

</article><!-- #post -->
