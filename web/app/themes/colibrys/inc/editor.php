<?php 

class Editor
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_action('after_setup_theme', [$this,'clbs_theme_setup']);
        add_filter('tiny_mce_before_init', [$this,'clbs_mce_text_sizes']);
        add_filter('tiny_mce_before_init', [$this,'clbs_clean_copy_paste_editor']);
        add_action( 'init', [$this,'clbs_tiny_mce_link_buttons'] );
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Editor();
        }
        return self::$_instance;
    }

    public function clbs_theme_setup()
    {
        // Relative path to the TinyMCE Stylesheet
        add_editor_style(array('assets/editor-style.css'));
    }

    public function clbs_mce_text_sizes($initArray)
    {
        $initArray['fontsize_formats'] = "14px 16px 18px 20px 22px 24px 26px 28px 30px";
        return $initArray;
    }

    public function clbs_clean_copy_paste_editor($in) {
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

    function clbs_tiny_mce_link_buttons() {
        add_filter( 'mce_external_plugins', [$this, 'clbs_tiny_mce_add_buttons']);
        add_filter( 'mce_buttons', [$this, 'clbs_tiny_mce_register_buttons'] );
    }

    public static function clbs_tiny_mce_add_buttons( $plugins ) {
        $plugins['createCustomButton'] = get_template_directory_uri() . '/assets/tinymce/createButton/index.js';
        return $plugins;
    }

    public static function clbs_tiny_mce_register_buttons( $buttons ) {
        $newBtns = array(
            'customButton',
        );
        $buttons = array_merge( $buttons, $newBtns );
        return $buttons;
    }
}