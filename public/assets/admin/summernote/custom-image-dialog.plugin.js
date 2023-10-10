/**
 *
 * copyright [year] [your Business Name and/or Your Name].
 * email: your@email.com
 * license: Your chosen license, or link to a license file.
 *
 */
(function (factory) {
    /* Global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function ($) {
    /**
     * @class plugin.examplePlugin
     *
     * example Plugin
     */
    $.extend(true, $.summernote.lang, {
        'en-US': { /* US English(Default Language) */
            examplePlugin: {
                exampleText: 'Insert Image',
                dialogTitle: 'Insert Image',
                okButton: 'OK'
            }
        }
    });

    $.extend($.summernote.options, {
        examplePlugin: {
            icon: '<i class="note-icon-picture"/>',
            tooltip: 'Insert Image'
        }
    });

    // plugin to create dialog box and return the value of the input as image url
    $.extend($.summernote.plugins, {
        'examplePlugin': function (context) {
            var self = this;
            var ui = $.summernote.ui;
            var $editor = context.layoutInfo.editor;
            var options = context.options;
            var lang = options.langInfo;

            context.memo('button.examplePlugin', function () {
                var button = ui.button({
                    contents: options.examplePlugin.icon,
                    tooltip: options.examplePlugin.tooltip,
                    click: function () {
                        self.showDialog();
                    }
                });
                return button.render();
            });

            self.showDialog = function () {

                window.addImageToEditor = function (url) {
                    context.invoke('editor.pasteHTML', '<img src="' + url + '" />');
                    $('#gc-media-library-dialog').modal('hide');
                }

                $('#gc-media-library-dialog').find('iframe').attr('src','/admin/media-library/iframe?page=editor-dialog');
                $('#gc-media-library-dialog').modal('show');

            };



        }
    });
}));
