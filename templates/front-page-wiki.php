<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wimp
 */

get_header(); ?>

	<section class="main-body" class="site-content" role="main">

		<header>
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					the_content();
				endwhile; endif;
			?>
		</header>

		<aside class="search-wrapper">
			<span class="search-title">Find A Resource:</span> <input type="text" id="resource-search">
		</aside>

		<?php
			$args = array(
				'hide_empty' => false
			);
			$cats = get_terms( 'cg_wikiwiki_categories', $args );

			echo '<h2 class="page-title">Resource Categories</h2>';
			foreach ( $cats as $cat ) : ?>
				<section class="wiki-cat-wrapper">
					<h3 class="wiki-cat <?php echo esc_attr( $cat->term_id ) . ' ' . esc_attr( $cat->slug ); ?>"><a href="<?php echo esc_url( home_url( '/resources/categories/' . $cat->slug ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></h3>
					<ul class="wiki-cat-list">
						<?php wimp_get_wiki_posts_by_cat( $cat->term_id, 4 ); ?>
					</ul>
				</section>
			<?php endforeach;
		?>
	</section>

	<?php get_sidebar( 'wiki' ); ?>
<?php get_footer(); ?>