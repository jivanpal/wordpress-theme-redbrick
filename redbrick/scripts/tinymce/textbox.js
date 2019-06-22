/**
 * Add the textbox plugin to TinyMCE, with a button in the TinyMCE editor and
 * a menu entry in the TinyMCE menu to allow the user to insert a textbox via
 * a modal dialog.
 * 
 * This code is written for TinyMCE 4, NOT TinyMCE 5.
 * 
 * The TinyMCE API documentation is notoriously bad; see the following pages to
 * gain some semblance of sanity as to how this code works:
 * 
 * @see https://www.tiny.cloud/docs/ui-components/toolbarbuttons/
 * @see https://codex.wordpress.org/TinyMCE_Custom_Buttons
 * @see https://www.tiny.cloud/docs/advanced/creating-a-plugin/
 * @see https://makina-corpus.com/blog/metier/2016/how-to-create-a-custom-dialog-in-tinymce-4
 * @see https://stackoverflow.com/questions/24871792/tinymce-api-v4-windowmanager-open-what-widgets-can-i-configure-for-the-body-op
 * @see https://wordpress.stackexchange.com/questions/299617/using-a-dashicon-for-a-custom-button-in-tinymce
 */
function redbrick_mce_textbox() {
    tinymce.PluginManager.add(
        'redbrick_mce_textbox',
        function(editor, url) {
            /**
             * This function opens a modal dialog that asks the user for the
             * required info in order to insert a pullquote (alignment, size,
             * the quote text itself).
             */
            function redbrick_mce_textbox_openDialog() {
                editor.windowManager.open( {
                    title:  "Insert text box",
                    width:  1000,
                    height: 150,
                    body:   [
                        {
                            type:   "listbox",
                            name:   "align",
                            label:  "Text box alignment",
                            values: [
                                {   text: "Full width of column",   value: "fullwidth", selected: true  },
                                {   text: "Left aligned",           value: "left"       },
                                {   text: "Right aligned",          value: "right"      }
                            ]
                        },
                        {
                            type:   "textbox",
                            name:   "title",
                            label:  "Text box title"
                        },
                        {
                            type:   "textbox",
                            multiline: true,
                            name:   "content",
                            label:  "Text box content"
                        }
                    ],
                    buttons:    [
                        {
                            text:       "Cancel",
                            onclick:    "close"
                        },
                        {
                            text:       "Insert",
                            onclick:    "submit",
                            subtype:    "primary"
                        }
                    ],
                    onSubmit:   function(result) {
                        editor.insertContent(`[textbox align="${result.data.align}" title="${result.data.title}"]${result.data.content}[/textbox]`);
                    }
                } );
            }

            editor.addButton(
                'redbrick_mce_textbox_button',
                {
                    tooltip:    "Insert text box",
                    image:      url + "/../../assets/tinymce-button-textbox.png",
                    onclick:    redbrick_mce_textbox_openDialog
                }
            );
            
            editor.addMenuItem(
                'rebrick_mce_textbo_menuItem',
                {
                    text:       "Insert text box",
                    onclick:    redbrick_mce_textbox_openDialog
                }
            );

            return {
                getMetadata:    function() {
                    return {
                        name:   "Redbrick TinyMCE plugin to insert text boxes",
                        url:    "https://github.com/jivanpal/redbrick-theme-for-wordpress"
                    }
                }
            }
        }
    );
}

// Now actually call the function to actually add the button
redbrick_mce_textbox();
