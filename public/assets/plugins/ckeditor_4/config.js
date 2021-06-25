/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_P;
	
	config.toolbar = [
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyBlock', 'Link', 'Unlink','Image', 'addFile', 'addImage'] },	
		//{ name: 'links', items: [ 'Link', 'Unlink','Image' ] },
		{ name: 'styles', items: [ 'Format' ] },
		//{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		//{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'insert', items: [ 'Table', 'HorizontalRule',  'SpecialChar', 'Image' ] },
		//{ name: 'insert', items: [ 'Image' ] },
		//{ name: 'tools', items: [ 'ShowBlocks' ] },
		//{ name: 'document', items: [ 'Source' ] },
		//{ name: 'insert', items: [ 'Table' ] },
	];
	config.removeButtons = 'Strike,Subscript,Superscript,About';
	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
	config.allowedContent = true;	
};
