
// use relative paths for assets
App.$(document).on('init-html-editor', function(e, editor) {

    var buttons = {};

    buttons.mpdocsasset = {
        title : 'Asset',
        label : '<i class="uk-icon-cloud"></i>'
    };

    editor.addButtons(buttons);

    // remove cpfinder and cpasset from toolbar, add mpdocsasset instead
    editor.options.toolbar = editor.options.toolbar.filter(function(button) {
        return button != 'cpfinder' && button != 'cpasset';
    }).concat(['mpdocsasset']);

    editor.on('action.mpdocsasset', function() {

        App.assets.select(function(assets){

            if (Array.isArray(assets) && assets.length) {

                var asset = assets[0], isImage = asset.mime.match(/^image\//);

                var assets_url = ASSETS_URL.replace(MP_SITE_URL, '');

                if (editor.getCursorMode() == 'markdown') {
                    editor['replaceSelection'](isImage ? '!['+asset.title+']('+assets_url+asset.path+')' : '['+asset.title+']('+assets_url+asset.path+')');
                } else {
                    editor['replaceSelection'](isImage ? '<img src="'+assets_url+asset.path+'" alt="'+asset.title+'">' : '<a href="'+assets_url+asset.path+'">'+asset.title+'</a>');
                }
            }
        });
    });

});
