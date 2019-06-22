/**
 * Add the YouTube embed plugin to TinyMCE, with a button in the TinyMCE editor
 * and a menu entry in the TinyMCE menu to allow the user to embed a YouTube
 * video via a modal dialog.
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
function redbrick_mce_youtube() {
    tinymce.PluginManager.add(
        'redbrick_mce_youtube',
        function(editor, url) {
            /**
             * This function opens a modal dialog that asks the user for the
             * URL or video code of a YouTube video.
             */
            function redbrick_mce_youtube_openDialog() {
                editor.windowManager.open( {
                    title:  "Embed YouTube video",
                    width:  1000,
                    height: 150,
                    body:   [
                        {
                            type:   "textbox",
                            name:   "videourl",
                            label:  "YouTube video URL or video ID"
                        }
                    ],
                    buttons:    [
                        {
                            text:       "Cancel",
                            onclick:    "close"
                        },
                        {
                            text:       "Embed",
                            onclick:    "submit",
                            subtype:    "primary"
                        }
                    ],
                    onSubmit:   function(result) {
                        /** Check if URL is of the form *youtube.com/*, and grab video ID if so ... */
                        let redbrick_mce_youtube_regex_match = /^(https?:\/\/)?(www.)?youtube.com\/watch\?\S*$/.exec(result.data.videourl);

                        if (redbrick_mce_youtube_regex_match != null) {
                            /** We have a match for *youtube.com/*, now grab video ID from URL query string*/
                            result.data.videoid = (new URL(result.data.videourl)).searchParams.get("v");
                        } else {
                            /** No match; check if URL is of the form *youtu.be/*, and grab video ID if so ... */
                            redbrick_mce_youtube_regex_match = /^(?:https?:\/\/)?youtu.be\/([a-zA-Z0-9_-]{11})(?:\?\S*)?$/.exec(result.data.videourl);
                            if (redbrick_mce_youtube_regex_match != null) {
                                /** We have a match for *youtu.be/*, now grab video ID from capture group of RegEx match on URL */
                                result.data.videoid = redbrick_mce_youtube_regex_match[1];
                            } else {
                                /** No match; assume that the given "URL" is actually the video ID itself */
                                result.data.videoid = result.data.videourl;
                            }
                        }

                        editor.insertContent(`[youtube videoid="${result.data.videoid}" /]`);
                    }
                } );
            }

            editor.addButton(
                'redbrick_mce_youtube_button',
                {
                    tooltip:    "Embed YouTube video",
                    image:      url + "/../../assets/tinymce-button-youtube.png",
                    onclick:    redbrick_mce_youtube_openDialog
                }
            );
            
            editor.addMenuItem(
                'rebrick_mce_youtube_menuItem',
                {
                    text:       "Embed YouTube video",
                    onclick:    redbrick_mce_youtube_openDialog
                }
            );

            return {
                getMetadata:    function() {
                    return {
                        name:   "Redbrick TinyMCE plugin to embed YouTube videos",
                        url:    "https://github.com/jivanpal/redbrick-theme-for-wordpress"
                    }
                }
            }
        }
    );
}

// Now actually call the function to actually add the button
redbrick_mce_youtube();
