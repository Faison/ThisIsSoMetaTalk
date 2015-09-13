( function ( $ ) {
	'use strict';

	function init_handlers() {
		$( '.js-fz-dropdown-list' ).on( 'click', '.js-fz-remove', remove_list_item );

		$( '.js-fz-meta-field' ).on( 'click', '.js-fz-dropdown-list-add', add_list_item );
	}

	function remove_list_item( e ) {
		var $this      = $( e.target),
			$parent_li = $this.closest( 'li' );

		$parent_li.remove();
	}

	$( document ).ready( function() {
		init_handlers();
	} );

	function add_list_item( e ) {
		var $target_list = $( e.target ).siblings( '.js-fz-dropdown-list'),
			$list_item   = $target_list.children().first(),
			$new_item    = $list_item.clone();

		$new_item.find( 'option:selected' ).removeAttr( 'selected' );

		$target_list.append( $new_item );
	}

} )( jQuery );
