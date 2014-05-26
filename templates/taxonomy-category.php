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
			<h1 class="page-title"><?php _e( 'WIMP WIKI', 'wiki_wiki' ); ?><h1>
			<h2><?php _e( 'CATEGORIES', 'wiki_wiki' ); ?></h2>
			<p><?php _e( 'Wimp wants to have a list of resources that everyone can reference at any time! This could be the best places to learn JavaScript, a list of CPA\'s, or the best Co-Working locations. We want this to be a wiki style so any Wimp member can come in and collaborate at any time. However, this area is still being built and should be available very shortly.', 'wiki_wiki' ); ?></p>
		</header>

		<aside class="search-wrapper">
			<label class="search-title"><?php _e( 'Find A Resource:', 'wiki_wiki' ); ?></label> <input type="text" id="resource-search">
		</aside>

		<?php
			echo '<h2 class="page-title">' . __( 'Resource Categories', 'wiki_wiki' ) . '</h2>';

			$args = array(
				'hide_empty' => false
			);
			$cats = get_terms( 'wiki_wiki_categories', $args );

			foreach ( $cats as $cat ) : ?>
				<section class="wiki-cat-wrapper">
					<h3 class="wiki-cat <?php echo esc_attr( $cat->term_id ) . ' ' . esc_attr( $cat->slug ); ?>"><a href="<?php echo esc_url( home_url( '/resources/categories/' . $cat->slug ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></h3>
					<ul class="wiki-cat-list">

					</ul>
				</section>
			<?php endforeach;
		?>
	</section>

	<?php get_sidebar( 'wiki' ); ?>
<?php get_footer(); ?>