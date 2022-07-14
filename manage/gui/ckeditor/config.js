/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    config.extraPlugins = 'image,dialog';


    config.extraPlugins = 'iframe,youtube,justify,bidi,font,colorbutton';


    config.filebrowserBrowseUrl = 'ckeditor/plugins/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = 'ckeditor/plugins/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = 'ckeditor/plugins/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = 'ckeditor/plugins/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = 'ckeditor/plugins/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = 'ckeditor/plugins/kcfinder/upload.php?type=flash';

    config.toolbar_Basic = [
        [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
        [ 'TextColor', 'RemoveFormat'],
    ];

	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	//config.uiColor = '#ff0000';
};
