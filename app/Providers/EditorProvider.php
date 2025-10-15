<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class EditorProvider extends AbstractProvider
{
    public function register(): void
    {
        add_action('after_setup_theme', [$this,'mhdy_theme_setup']);
        add_filter('tiny_mce_before_init', [$this,'mhdy_mce_text_sizes']);
        add_filter('tiny_mce_before_init', [$this,'mhdy_clean_copy_paste_editor']);
        add_action( 'init', [$this,'mhdy_tiny_mce_link_buttons'] );
        add_action( 'admin_init', [$this, 'mhdy_theme_add_editor_styles'] );
        remove_filter('the_content', 'wpautop');
    }

    public function mhdy_theme_setup()
    {
        // Relative path to the TinyMCE Stylesheet
        add_editor_style(array('assets/editor/editor-style.css'));
    }

    public function mhdy_theme_add_editor_styles()
    {
        add_editor_style(array('assets/editor/inner-editor-style.css'));
    }

    public function mhdy_mce_text_sizes($initArray)
    {
        $initArray['fontsize_formats'] = "14px 16px 18px 20px 22px 24px 26px 28px 30px";
        return $initArray;
    }

    public function mhdy_clean_copy_paste_editor($in) {
        $in['paste_preprocess'] = "function(plugin, args){
            // Strip all HTML tags except those we have whitelisted
            var whitelist = 'img,strong,ul,li,ol,a';
            var stripped = jQuery('<div>' + args.content + '</div>');
            var els = stripped.find('*').not(whitelist);
            for (var i = els.length - 1; i >= 0; i--) {
            var e = els[i];
            jQuery(e).replaceWith(e.innerHTML);
            }
            // Strip all class and id attributes
            stripped.find('*').removeAttr('id').removeAttr('class');
            // Return the clean HTML
            args.content = stripped.html();
        }";
        return $in;
    }

    function mhdy_tiny_mce_link_buttons() {
        add_filter( 'mce_external_plugins', [$this, 'mhdy_tiny_mce_add_buttons']);
        add_filter( 'mce_buttons', [$this, 'mhdy_tiny_mce_register_buttons'] );
    }

    public static function mhdy_tiny_mce_add_buttons( $plugins ) {
        $plugins['createCustomButton'] = get_template_directory_uri() . '/assets/tinymce/createButton/index.js';
        return $plugins;
    }

    public static function mhdy_tiny_mce_register_buttons( $buttons ) {
        $newBtns = array(
            'customButton',
        );
        $buttons = array_merge( $buttons, $newBtns );
        return $buttons;
    }
}