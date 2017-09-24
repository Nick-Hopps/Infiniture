/**
 * Custom functions.
 *
 * Some custom functions to be used on this theme.
 */

( function() {

	/**
	 * 如果#content的高度不能填满窗口，就重新设置#primary的高度
   */
	if ( window.addEventListener ) {
		window.addEventListener( 'load', function() {

			var $elem, $target, $window_h, $content_h;
			$elem = document.body.querySelector( '#content' );
			$target = document.body.querySelector( '#primary' );
			$window_h = window.innerHeight;
			$content_h = $elem.offsetHeight;

			if ( $content_h < $window_h ) {
				$target.style.setProperty( 'height', $window_h - 124 + 'px' );
			}
		}, false );
	}

	/**
	 * 如果浏览器不支持CSS的calc()方法，就用JS代替
   */
  $content = document.body.querySelector( '#content' );
  $content_maxW = window.getComputedStyle( $content, null ).getPropertyValue("max-width");
  if ( $content_maxW == 'none' ) {
  	if ( window.addEventListener ) {
			window.addEventListener( 'resize', function() {
				$content.style.setProperty( 'max-width', window.innerWidth - 320 + 'px' );
			}, false );
		}
  }

} )();