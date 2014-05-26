<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wimp
 */

get_header(); ?>

	<section class="main-body site-content" role="main">

		<header>
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					the_content();
				endwhile; endif;
			?>
		</header>

		<aside class="search-wrapper">
			<label for="resource-search" class="search-title"><?php _e( 'Find A Resource:', 'wiki_wiki' ); ?></label> <input type="text" id="resource-search">
		</aside>

		<h2 class="page-title"><?php _e( 'Resource Categories', 'wiki_wiki' ); ?></h2>
	</section>

	<?php get_sidebar( 'wiki' ); ?>
<?php get_footer(); ?>