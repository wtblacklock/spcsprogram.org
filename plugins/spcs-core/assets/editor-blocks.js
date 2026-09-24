/**
 * Editor registration for the SPCS content blocks.
 *
 * Each block previews itself with ServerSideRender so the editor shows the real
 * citations, statistics and quotes rather than an abstract placeholder.
 */
( function ( blocks, element, ServerSideRender, i18n, components, blockEditor ) {
	'use strict';

	var createElement = element.createElement;
	var Fragment = element.Fragment;
	var __ = i18n.__;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var RangeControl = components.RangeControl;
	var TextControl = components.TextControl;

	/** Attribute schema per block, mirroring the PHP registration. */
	var schema = {
		'spcs/studies': { limit: { type: 'number', default: -1 } },
		'spcs/outcomes': { limit: { type: 'number', default: 3 } },
		'spcs/testimonials': { limit: { type: 'number', default: 2 } },
		'spcs/faqs': { group: { type: 'string', default: '' } },
		'spcs/partners': { type: { type: 'string', default: '' } },
	};

	var titles = window.spcsContentBlocks || {};

	Object.keys( schema ).forEach( function ( name ) {
		var attributes = schema[ name ];

		blocks.registerBlockType( name, {
			apiVersion: 3,
			title: titles[ name ] || name,
			category: 'theme',
			icon: 'database',
			attributes: attributes,
			supports: { html: false },
			edit: function ( props ) {
				var controls = [];

				if ( attributes.limit ) {
					controls.push(
						createElement( RangeControl, {
							key: 'limit',
							label: __( 'How many to show', 'spcs-core' ),
							help: __( 'Set to the maximum to show every entry.', 'spcs-core' ),
							value: props.attributes.limit < 0 ? 12 : props.attributes.limit,
							min: 1,
							max: 12,
							onChange: function ( value ) {
								props.setAttributes( { limit: value === 12 ? -1 : value } );
							},
						} )
					);
				}

				if ( attributes.group ) {
					controls.push(
						createElement( TextControl, {
							key: 'group',
							label: __( 'Only show this group', 'spcs-core' ),
							help: __( 'Leave empty to show all FAQs.', 'spcs-core' ),
							value: props.attributes.group,
							onChange: function ( value ) {
								props.setAttributes( { group: value } );
							},
						} )
					);
				}

				if ( attributes.type ) {
					controls.push(
						createElement( TextControl, {
							key: 'type',
							label: __( 'Only show this type', 'spcs-core' ),
							help: __( 'funder, campus or accreditor. Leave empty for all.', 'spcs-core' ),
							value: props.attributes.type,
							onChange: function ( value ) {
								props.setAttributes( { type: value } );
							},
						} )
					);
				}

				return createElement(
					Fragment,
					null,
					controls.length
						? createElement(
								InspectorControls,
								null,
								createElement(
									PanelBody,
									{ title: __( 'Settings', 'spcs-core' ) },
									controls
								)
						  )
						: null,
					createElement( ServerSideRender, {
						block: name,
						attributes: props.attributes,
					} )
				);
			},
			save: function () {
				return null;
			},
		} );
	} );
} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.serverSideRender,
	window.wp.i18n,
	window.wp.components,
	window.wp.blockEditor
);
