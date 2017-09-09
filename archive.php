<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infiniture
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="articles clear">

				<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</div>

			<?php
			the_posts_pagination( array(
				'prev_text'          => __( '上一页', 'infiniture' ),
				'next_text'          => __( '下一页', 'nfiniture' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '页码', 'infiniture' ) . ' </span>',
			) );
			?>
					
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
