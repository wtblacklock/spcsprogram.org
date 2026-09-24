/**
 * Editor-side registration for the theme's server-rendered blocks.
 *
 * Hand-written against the wp.* globals rather than bundled: there is no JSX
 * and no dependency here, so putting it through a build step would add a
 * toolchain hop for no benefit.
 */
( function ( blocks, element, ServerSideRender, i18n ) {
	'use strict';

	var createElement = element.createElement;
	var __ = i18n.__;

	var titles = {
		'spcs/site-header': __( 'Site header (locked)', 'spcs' ),
		'spcs/site-footer': __( 'Site footer (locked)', 'spcs' ),
		'spcs/crisis-bar': __( 'Crisis resources bar (locked)', 'spcs' ),
	};

	( window.spcsEditorBlocks || [] ).forEach( function ( name ) {
		blocks.registerBlockType( name, {
			apiVersion: 3,
			title: titles[ name ] || name,
			category: 'theme',
			icon: 'lock',
			description: __(
				'Rendered by the theme so it stays identical and accessible on every page. Text is edited in the theme files.',
				'spcs'
			),
			supports: {
				html: false,
				inserter: false,
				reusable: false,
				multiple: false,
			},
			edit: function () {
				return createElement( ServerSideRender, { block: name } );
			},
			save: function () {
				return null;
			},
		} );
	} );
} )( window.wp.blocks, window.wp.element, window.wp.serverSideRender, window.wp.i18n );
