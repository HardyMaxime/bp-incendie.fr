<?php

class ConfigController extends AbstractController
{
    protected static $frontID;
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ConfigController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_filter( 'page_template', array($this, 'clbs_custom_hierarchy_template') );
    }

    public static function clbs_custom_hierarchy_template($template)
    {
        global $post;
        if ($post->post_parent) {
            // get top level parent page

            $parent = get_post(
               reset(array_reverse(get_post_ancestors($post->ID)))
            );

            $child_template = locate_template(
                [
                    'subpages/'.$parent->post_name . '/page-' . $post->post_name . '.php',
                    'subpages/'.$parent->post_name . '/page-' . $post->ID . '.php',
                    'subpages/'.$parent->post_name . '/page.php',
                ]
            );

            if ($child_template) return $child_template;
        }
        return $template;
    }

    /**
     *  Retourne vrai si la page d'accueil est la page courante
     */
    public static function isAccueil(): bool 
    {
        $res = is_front_page() ? true : false;
        return $res;
    }

    /**
     *  Genere les class pour le body
    */
    public static function generateBodyClass(): array
    {
        $bodyClass = [];
        if (is_front_page()) {
            $bodyClass[] = "is-accueil";
        }
        if(current_user_can('administrator')) {
            $bodyClass[] = "is-admin";
        }

        if(is_page('contact')) {
            $bodyClass[] = "page-contact";
        }

        return $bodyClass;
    }

    /**
     * Renvoie l'url de la favion déjà echappée 
     * @return array|string URL de la favicon et le type
     */
    public static function getFavicon(string $param = ""): array|string
    {
        $array = array();
        if(function_exists('get_site_icon_url') && !empty(get_site_icon_url()))
        {
            $array = [
                "url" => esc_url(get_site_icon_url()),
                "type" => esc_attr(wp_get_image_mime(wp_get_original_image_path(get_option( 'site_icon' ))))
            ];
        }
        else
        {
            $array =  [
                "url" => esc_url( get_template_directory_uri().'/assets/favicon.png'),
                "type" => esc_attr("image/png")
            ];
        }

        if(!empty($param) && array_key_exists($param, $array))
        {
            return $array[$param];
        }

        return $array;
    }

    public static function clbs_pagination(string $paged)
    {
        $pages = paginate_links([
            'type' => 'array',
            'prev_next' => false,
            'current'    => max( 1, $paged )
        ]);
        if ($pages === null) {
            return;
        }
        echo '<nav class="pagination-wrapper reset-list" aria-label="Pagination" >';
        echo '<ul class="pagination">';
        foreach ($pages as $page) {
            $active = strpos($page, 'current') !== false;
            $class = 'pagination-item';
            if ($active) {
                $class .= ' active';
            }
            echo '<li class="' . $class . '">';
            echo str_replace('page-numbers', 'pagination-item-link', $page);
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}