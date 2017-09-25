/**
 * Custom functions.
 *
 * Some custom functions to be used on this theme.
 */

( function() {

	/**
	 * 如果浏览器不支持CSS的calc()方法，就用JS代替
   */
	var primary, primary_minH;
	primary = document.body.querySelector( '#primary' );
	primary_minH = window.getComputedStyle( primary, null ).getPropertyValue("min-height");
  if ( primary_minH == 'none' ) {
  	if ( !window.addEventListener ) {
  		return;
		} else {
			window.addEventListener( 'load', function() {
				$content.style.setProperty( 'min-height', window.innerWidth - 124 + 'px' );
			}, false );
		}
  }

} )();