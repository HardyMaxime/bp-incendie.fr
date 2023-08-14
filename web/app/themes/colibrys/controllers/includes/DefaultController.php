<?php

class DefaultController 
{
    protected static $frontID;
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DefaultController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $frontid = get_option('page_on_front');
        self::setFrontID($frontid);
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
     *  Setter de l'ID de la page d'accueil
     */
    public static function setFrontID(string $id)
    {
        self::$frontID = $id;
    }

    /**
     * Retourne l'ID de la page d'accueil
     * @return string
     */
    public static function getFrontID(): string
    {
        return self::$frontID;
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

    public static function getPostThumbnailAttribut(string $image_id, string $params = ""): array|string
    {
        $attributs = array(
            'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
            'title' => get_the_title($image_id)
        );

        if(!empty($params) && array_key_exists($params, $attributs))
        {
            return $attributs[$params];
        }

        return $attributs;
    }

    /**
     * Retourne le contenu d'un champ ACF ou un champ personnalisé
     * @param string $field Nom du champ
     * @param string $id ID de la page
     */
    public static function field_value($field, $id)
    {
        // Si ACF est installé
        if(empty($id)) $id = get_the_ID();
        if(function_exists('get_field'))
        {
            return get_field($field, $id);
        }
        return get_post_meta($id, $field, true);
    }

    /**
     * Retourne le contenu d'un champ ou une chaine vide si le champ est vide
     * @param string $field Nom du champ
     * @param string $id ID de la page
     * @param string $return_value Valeur de retour si le champ est vide
     */
    public static function get_field_or_empty($field, $id, $return_value = "") {
        $value = self::field_value($field, $id);
        return empty($value) ? $return_value : $value;
    }

    /**
     * Vérifie si le paramètre existe dans le tableau et le retourne
     * @param string $param Nom du paramètre
     * @param array $array Tableau de paramètres
     */
    public static function check_array_param($param, $array)
    {
        if(!empty($param) && array_key_exists($param, $array))
        {
            return $array[$param];
        }
    }

    public static function changeWpQuery(WP_Query $query): WP_Query
    {
        global $wp_query;
        $tmp_query = $wp_query;
        $wp_query = $query;

        return $tmp_query;
    }

    public static function resetWpQuery(WP_Query $query): void
    {
        global $wp_query;
        $wp_query = $query;
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