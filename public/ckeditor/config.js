CKEDITOR.editorConfig = function( config ) {
    config.extraPlugins=`
        liststyle,
        youtube,
        font,
        justify,
        confighelper,
        html5audio,
        pastefromword,
        filetools
    `;

	config.toolbarGroups = [
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup','subscript', 'superscript' ] },
        { name: 'styles' },
        { name: 'paragraph',   groups: [ 'list', 'blocks', 'align', 'bidi' ] },
        { name: 'insert' },
		{ name: 'others' },
        { name: 'tools' }
	];

	config.removeButtons        = '';
	config.format_tags          = 'p;h1;h2;h3;pre';
    config.uiColor              = '#DEEFF2';
    config.autoParagraph        = false;
	config.removeDialogTabs     = 'image:advanced;link:advanced';
    config.allowedContent       = true;
    // config.enterMode            = CKEDITOR.ENTER_BR;
    // config.ShiftEnterMode       = CKEDITOR.ENTER_BR;
};
