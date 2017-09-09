<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infiniture
 */

?>

<div class="article-container">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry">
			<div class="entry-header">
				<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
				?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</header>

		<footer class="entry-footer">
			<span class="ornament"></span>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php infiniture_entry_footer(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
