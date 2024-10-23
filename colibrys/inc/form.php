<?php 

class Form
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        if(class_exists("WPCF7"))
        {
            // Retire les appels ajax
            add_filter( 'wpcf7_load_js', '__return_false' );
            add_action( 'wpcf7_init', [$this,'clbs_custom_add_form_tag_urlrgpd'] );
            add_filter('wpcf7_form_elements', [$this,'clbs_clean_form_content'] );
        }
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Form();
        }
        return self::$_instance;
    }

    // Ajouter le fichier RGPD (A creer via ACF avec le nom "file_rgpd")
    public function clbs_custom_add_form_tag_urlrgpd() {
        wpcf7_add_form_tag( 'urlrgpd', function($tag){
            $url_rgpd_file = (get_field("file_rgpd","option") ? esc_url(get_field("file_rgpd","option")['url']) : "#");
            return $url_rgpd_file;
        });
    }

    // Retirer les span de contact form 7 https://gist.github.com/kharakhordindemo/fe0af52a063a9f24c813fcdb202870b8
    public function clbs_clean_form_content($content)
    {
        $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

        $content = str_replace('<br />', '', $content);
        $content = str_replace('<p>', '', $content);
        $content = str_replace('</p>', '', $content);
        return $content;
    }
}