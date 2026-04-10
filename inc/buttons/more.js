(function() {
    tinymce.create('tinymce.plugins.success', {
        init : function(ed, url) {
            ed.addButton('success', {
                title : 'Green Background Bar',
                image : url+'/images/success.png',
                onclick : function() {
                     ed.selection.setContent('[success]' + ed.selection.getContent() + '[/success]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('success', tinymce.plugins.success);
    tinymce.create('tinymce.plugins.info', {
        init : function(ed, url) {
            ed.addButton('info', {
                title : 'Blue Background Bar',
                image : url+'/images/info.png',
                onclick : function() {
                     ed.selection.setContent('[info]' + ed.selection.getContent() + '[/info]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('info', tinymce.plugins.info);
    tinymce.create('tinymce.plugins.danger', {
        init : function(ed, url) {
            ed.addButton('danger', {
                title : 'Red Background Bar',
                image : url+'/images/danger.png',
                onclick : function() {
                     ed.selection.setContent('[danger]' + ed.selection.getContent() + '[/danger]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('danger', tinymce.plugins.danger);     
    tinymce.create('tinymce.plugins.successbox', {
        init : function(ed, url) {
            ed.addButton('successbox', {
                title : 'Green Panel',
                image : url+'/images/successbox.png',
                onclick : function() {
                     ed.selection.setContent('[successbox title="Title Content"]' + ed.selection.getContent() + '[/successbox]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('successbox', tinymce.plugins.successbox);
    tinymce.create('tinymce.plugins.infoboxs', {
        init : function(ed, url) {
            ed.addButton('infoboxs', {
                title : 'Blue Panel',
                image : url+'/images/infobox.png',
                onclick : function() {
                     ed.selection.setContent('[infobox title="Title Content"]' + ed.selection.getContent() + '[/infobox]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('infoboxs', tinymce.plugins.infoboxs);
    tinymce.create('tinymce.plugins.dangerbox', {
        init : function(ed, url) {
            ed.addButton('dangerbox', {
                title : 'Red Panel',
                image : url+'/images/dangerbox.png',
                onclick : function() {
                     ed.selection.setContent('[dangerbox title="Title Content"]' + ed.selection.getContent() + '[/dangerbox]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('dangerbox', tinymce.plugins.dangerbox);        
    tinymce.create('tinymce.plugins.title', {
        init : function(ed, url) {
            ed.addButton('title', {
                title : 'Content Title',
                image : url+'/images/title.png',
                onclick : function() {
                     ed.selection.setContent('[title]' + ed.selection.getContent() + '[/title]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('title', tinymce.plugins.title);

    tinymce.create('tinymce.plugins.highlight', {
        init : function(ed, url) {
            ed.addButton('highlight', {
                title : 'Code Beautification',
                image : url+'/images/highlight.png',
                onclick : function() {
                     ed.selection.setContent('[highlight lanaguage="language"]<pre><br>' + ed.selection.getContent() + '</pre>[/highlight]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);

    tinymce.create('tinymce.plugins.block', {
        init : function(ed, url) {
            ed.addButton('block', {
                title : 'Code Block',
                image : url+'/images/codeblock.png',
                onclick : function() {
                    ed.selection.setContent('[block]<pre><br>' + ed.selection.getContent() + '</pre>[/block]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('block', tinymce.plugins.block);



    tinymce.create('tinymce.plugins.accordion', {
        init : function(ed, url) {
            ed.addButton('accordion', {
                title : 'Expand/Collapse',
                image : url+'/images/accordion.png',
                onclick : function() {
                     ed.selection.setContent('[collapse title="Title Content"]' + ed.selection.getContent() + '[/collapse]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
    tinymce.create('tinymce.plugins.hide', {
        init : function(ed, url) {
            ed.addButton('hide', {
                title : 'Reply to View',
                image : url+'/images/hide.png',
                onclick : function() {
                     ed.selection.setContent('[hide reply_to_this="true"]' + ed.selection.getContent() + '[/hide]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('hide', tinymce.plugins.hide);

    tinymce.create('tinymce.plugins.striped', {
        init : function(ed, url) {
            ed.addButton('striped', {
                title : 'Progress Bar',
                image : url+'/images/striped.png',
                onclick : function() {
                     ed.selection.setContent('[striped]' + ed.selection.getContent() + '[/striped]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('striped', tinymce.plugins.striped);
    tinymce.create('tinymce.plugins.ypbtn', {
        init : function(ed, url) {
            ed.addButton('ypbtn', {
                title : 'Cloud Download',
                image : url+'/images/ypbtn.png',
                onclick : function() {
                     ed.selection.setContent('[ypbtn]' + ed.selection.getContent() + '[/ypbtn]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('ypbtn', tinymce.plugins.ypbtn);
    tinymce.create('tinymce.plugins.music', {
        init : function(ed, url) {
            ed.addButton('music', {
                title : 'Netease Cloud Music',
                image : url+'/images/music.png',
                onclick : function() {
                     ed.selection.setContent('[music autoplay="0"]' + ed.selection.getContent() + '[/music]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('music', tinymce.plugins.music);
    tinymce.create('tinymce.plugins.soundcloud', {
        init : function(ed, url) {
            ed.addButton('soundcloud', {
                title : 'SoundCloud',
                image : url+'/images/music.png',
                onclick : function() {
                     ed.selection.setContent('[soundcloud]' + ed.selection.getContent() + '[/soundcloud]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('soundcloud', tinymce.plugins.soundcloud);
    tinymce.create('tinymce.plugins.wxmusic', {
        init : function(ed, url) {
            ed.addButton('wxmusic', {
                title : 'Local Music Player',
                image : url+'/images/weixinmusic.png',
                onclick : function() {
                    ed.selection.setContent('[wxmusic url="address" author="author" title="title"]' + ed.selection.getContent() + '[/wxmusic]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('wxmusic', tinymce.plugins.wxmusic);
    tinymce.create('tinymce.plugins.video', {
        init : function(ed, url) {
 
            ed.addButton('video', {
                title : 'Video Embed',
                image : url+'/images/bilibili.png',
                onclick : function() {
                     ed.selection.setContent('[video site="auto"]' + ed.selection.getContent() + '[/video]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('video', tinymce.plugins.video);







})();