(function() {
    tinymce.create('tinymce.plugins.podcast', {
        init : function(ed, url) {
 
            ed.addButton('podbut', {
                title : 'Insert Podcast Player',
                cmd : 'podbut',
                image :  url + '/podcast.png'
            });
 
            ed.addCommand('podbut', function() {
                var title = prompt("Podcast Title"), link = prompt("Link to the mp3 file"),
                shortcode;
                if (link !== null) {
                    shortcode = '[podcast title="' + title + '"]' + link + '[/podcast]';
                    ed.execCommand('mceInsertContent', 0, shortcode);
                }
            });
        },
        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'podcast', tinymce.plugins.podcast );
})();