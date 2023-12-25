/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'en';
	// config.uiColor = '#AADC6E';

	// Set the most common block elements.
	config.format_tags               = 'p;h1;h2;h3;h4;h5;h6;pre';

	// Allow content rules
	config.allowedContent            = true;

	// Allow any class and any inline style
	config.extraAllowedContent       = '*(*);*{*}';

    config.extraPlugins = 'image2';
    config.removePlugins = 'image';

    config.allowedContent            = true;
	config.coreStyles_bold           = {element:'strong'};
	config.coreStyles_italic         = {element:'em'};
	config.htmlEncodeOutput          = false;
	config.entities                  = false;
	config.filebrowserBrowseUrl      = ckFinderPath;
};
