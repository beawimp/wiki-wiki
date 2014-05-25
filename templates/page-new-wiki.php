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
					<h1>Add New Wiki Page</h1>
					<?php the_content(); ?>

					<form action="" class="form-horizontal" role="form">
						<div class="form-group">
							<label for="wiki-title" class="col-sm-2 control-label input-lg">Title</label>
							<div class="col-sm-10">
								<input type="text" name="wiki-title" class="form-control" id="wiki-title" placeholder="Give it a good title... somethingy wimpy.">
							</div>
						</div>
						<div class="form-group">
							<label for="wiki-content" class="col-sm-2 control-label">Content</label>
							<div class="col-sm-10">
								<?php wp_editor( '', 'wiki-content' ); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="wiki-content" class="col-sm-2 control-label">Content</label>
							<div class="col-sm-10">
								<select name="" class="form-control" id="">
									<option value="">-- Choose A Category --</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="wiki-content" class="col-sm-2 control-label">Parent</label>
							<div class="col-sm-10">
								<select name="" class="form-control" id="">
									<option value="">-- Assign To A Parent --</option>
								</select>
								<span class="help-block">Assign this new page as a child to an existing wiki page.</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Create</button>
							</div>
						</div>
					</form>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		<?php endwhile; ?>

	</section>

	<?php get_sidebar( 'wiki' ); ?>

<?php get_footer(); ?>
