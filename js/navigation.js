/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button_nav, button_search, menu, links, i, len;

	container = document.body.querySelector( '#site-navigation' );
	if ( ! container ) {
		return;
	}

	button_nav = container.querySelector( '.nav-toggle' );
	button_search = container.querySelector( '.search-toggle' );
	if ( 'undefined' === typeof button_nav || 'undefined' === typeof button_search ) {
		return;
	}

	menu = container.querySelector( 'ul' );
	search = container.querySelector( '.blog-search' );

	// Hide menu toggle button_nav and search toggle button button_search if menu and search form are empty and return early.
	if ( 'undefined' === typeof menu || 'undefined' === typeof search ) {
		button_nav.style.display = 'none';
		button_search.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button_nav.onclick = function() {
		if ( -1 !== container.className.indexOf( 'nav-toggled' ) ) {
			container.className = container.className.replace( ' nav-toggled', '' );
			button_nav.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' nav-toggled';
			button_nav.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	button_search.onclick = function() {
		if ( -1 !== container.className.indexOf( 'search-toggled' ) ) {
			container.className = container.className.replace( ' search-toggled', '' );
			button_search.setAttribute( 'aria-expanded', 'false' );
			search.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' search-toggled';
			button_search.setAttribute( 'aria-expanded', 'true' );
			search.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links = menu.querySelectorAll( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var i,
				touchStartFn, 
				parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
