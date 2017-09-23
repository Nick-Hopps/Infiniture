<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package infiniture
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function infiniture_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'infiniture_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function infiniture_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'infiniture_pingback_header' );

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function infiniture_search_form( $form ) {
    $form = '<form class="search-form" role="search" method="get"  action="' . home_url( '/' ) . '" >
    <label>
    	<span class="screen-reader-text">' . esc_html__( '搜索' ) . '</span>
    	<input class="search-field" placeholder="' . esc_html__( '请输入搜索内容' ) . '" value="' . get_search_query() . '" name="s" type="search" />
    </label>
    <input class="search-submit" value="'. esc_html__( '搜索' ) .'" type="submit" />
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'infiniture_search_form' );

/**
 * Generate custom comment
 *
 * @param string $comment.
 * @param string $args.
 * @param string $depth.
 */
function infiniture_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<?php __( 'Pingback:', 'hemingway' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'hemingway' ), '<span class="edit-link">', '</span>' ); ?>
	</li>

	<?php
			break;
		default :
	global $post;
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">

			<div class="comment-meta comment-author vcard">
				<?php echo get_avatar( $comment, 120 ); ?>
				<div class="comment-meta-content">
					<?php printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span class="post-author"> ' . __( '(作者)', 'infiniture' ) . '</span>' : ''
					); ?>
					<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' at ' . get_comment_time() ?></a></p>
				</div> <!-- /comment-meta-content -->
			</div> <!-- /comment-meta -->

			<div class="comment-content post-content">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( '等待审核', 'infiniture' ); ?></p>
				<?php endif; ?>

				<?php comment_text(); ?>

				<div class="comment-actions">
					<?php edit_comment_link( __( '编辑', 'infiniture' ), '', '' ); ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '回复', 'infiniture' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<div class="clear"></div>
				</div> <!-- /comment-actions -->
			</div><!-- /comment-content -->
		</div><!-- /comment-## -->
	<?php
			break;
	endswitch;
}

/**
 * Custom excerpt length
 *
 * @param string $comment.
 * @param string $args.
 * @param string $depth.
 */
function new_excerpt_length( $length ) {
    return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');