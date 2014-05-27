<?php
/**
 * The template for displaying wiki pages
 *
 * @package wiki-wiki
 * @version  1.0
 * @since    0.1
 */

get_header(); ?>

	<section class="main-body site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php edit_post_link( __( 'Edit', 'wiki_wiki' ), '<span class="edit-link">', '</span>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<h1><?php _e( 'Add New Wiki Page', 'wiki_wiki' ); ?></h1>
					<?php the_content(); ?>

					<div id="wiki-messages"></div>

					<form action="" id="wiki-wiki-add-form" class="form-horizontal" role="form">
						<div class="form-group">
							<label for="wiki-title" class="col-sm-2 control-label input-lg">Title</label>
							<div class="col-sm-10">
								<input type="text" name="wiki-title" class="form-control wiki-form-field" id="wiki-title" placeholder="<?php _e( 'Give it a good title... somethingy wimpy.', 'wiki_wiki' ); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="wiki-content" class="col-sm-2 control-label"><?php _e( 'Content', 'wiki_wiki' ); ?></label>
							<div class="col-sm-10">
								<?php wp_editor( '', 'wiki-content', array(
									'editor_class' => 'wiki-form-field',
								) ); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="wiki-category" class="col-sm-2 control-label"><?php _e( 'Category', 'wiki_wiki' ); ?></label>
							<div class="col-sm-10">
								<select name="wiki-category" class="form-control wiki-form-field" id="wiki-category">
									<option value=""><?php _e( '-- Choose A Category --', 'wiki_wiki' ); ?></option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="wiki-parent" class="col-sm-2 control-label"><?php _e( 'Parent Wiki', 'wiki_wiki' ); ?></label>
							<div class="col-sm-10">
								<select name="wiki-parent" class="form-control wiki-form-field" id="wiki-parent">
									<option value=""><?php _e( '-- Assign To A Parent --', 'wiki_wiki' ); ?></option>
								</select>
								<span class="help-block"><?php _e( 'Assign this new page as a child to an existing wiki page.', 'wiki_wiki' ); ?></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary"><?php _e( 'Create Wiki', 'wiki_wiki' ); ?></button>
								<?php wp_nonce_field( 'wiki-wiki-add-wiki-nonce', 'wiki-wiki-nonce' ); ?>
							</div>
						</div>
					</form>
				</div>
			</article>

		<?php endwhile; ?>

	</section>

	<?php get_sidebar( 'wiki' ); ?>

<?php get_footer(); ?>
