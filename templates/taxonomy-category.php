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
			<h1 class="page-title">WIMP WIKI<h1>
			<h2>CATEGORIES</h2>
			<p>Wimp wants to have a list of resources that everyone can reference at any time! This could be the best places to learn JavaScript, a list of CPA's, or the best Co-Working locations. We want this to be a wiki style so any Wimp member can come in and collaborate at any time. However, this area is still being built and should be available very shortly.</p>
		</header>

		<aside class="search-wrapper">
			<span class="search-title">Find A Resource:</span> <input type="text" id="resource-search">
		</aside>

		<?php
			echo '<h2 class="page-title">Resource Categories</h2>';

			$args = array(
				'hide_empty' => false
			);
			$cats = get_terms( 'cg_wikiwiki_categories', $args );

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