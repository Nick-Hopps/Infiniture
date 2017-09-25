<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package infiniture
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="articles clear">

				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php
							printf( '搜索: %s', '<span>' . get_search_query() . '</span>' );
						?></h1>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				
			</div>

			<?php
			the_posts_pagination( array(
				'prev_text'          => '上一页',
				'next_text'          => '下一页',
				'before_page_number' => '<span class="meta-nav screen-reader-text">页码</span>',
			) );
			?>
					
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
