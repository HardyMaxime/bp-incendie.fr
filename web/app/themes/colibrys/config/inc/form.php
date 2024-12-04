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
            add_filter('wpcf7_form_tag', [$this, 'populate_page_id_field']);
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
            //$page_id = "option";
            $page_id = Helpers::get_id_by_slug(Helpers::get_contact_slug());
            $url_rgpd_file = (get_field("file_rgpd",$page_id) ? esc_url(get_field("file_rgpd",$page_id)['url']) : "#");
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

    public function populate_page_id_field($tag)
    {
        if ($tag['name'] === 'current_page_id') {
            $tag['values'] = array(get_the_ID());
        }
        return $tag;
    }
}