
(function(){
    tinymce.create('tinymce.plugins.customButton', {
        init: function(ed, url){
            ed.addButton('customButton', {
                title: 'Creer un bouton',
                cmd: 'customButtonCmd',
                image: url + '/link.png'
            });
            ed.addCommand('customButtonCmd', function(){
                //var selectedText = ed.selection.getContent({format: 'html'});
                var win = ed.windowManager.open({
                    title: 'Inserer un bouton',
                    body: [
                      {
                        type: 'textbox',
                        name: 'url',
                        label: 'URL du bouton',
                        minWidth: 500,
                        value: ''
                      },
                      {
                        type: 'textbox',
                        name: 'name',
                        label: 'Nom du bouton',
                        minWidth: 500,
                        value: ''
                      }
                    ],
                    buttons: [
                        {
                          text: "Valider",
                          subtype: "primary",
                          onclick: function() {
                            win.submit();
                          }
                        },
                        {
                          text: "Annuler",
                          onclick: function() {
                            win.close();
                          }
                        }
                      ],
                    onsubmit: function(e){
                        var returnText = '<a href='+ e.data.url +' class="link-with-arrow" target="_blank" rel="noopener" >'+ e.data.name +'</a>';
                        ed.execCommand('mceInsertContent', 0, returnText);
                      }
                });
            });
        },
        getInfo: function() {
          return {
            longname: 'Inserer un bouton',
            author: 'Maxime HARDY',
            authorurl: 'https://www.colibrys.fr/',
            version: "1.0"
          };
        }
    });
    tinymce.PluginManager.add( 'createCustomButton', tinymce.plugins.customButton );
})();
