<?php
/**
 * The template for displaying wiki pages
 *
 * @package wiki-wiki
 * @version  1.0
 * @since    0.1
 */

get_header(); ?>

	<section class="main-body" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php edit_post_link( __( 'Edit', 'wimp' ), '<span class="edit-link">', '</span>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'wimp' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		<?php endwhile; ?>

	</section>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
