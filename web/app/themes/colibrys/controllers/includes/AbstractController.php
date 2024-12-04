<?php

abstract class AbstractController 
{
    protected static $frontID;
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new AbstractController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $frontid = get_option('page_on_front');
        self::setFrontID($frontid);
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
     *  Modifier le titre d'un champ flexible content d'ACF
     *
     * @param string $layout_fieldname
     * @param string|array $sub_field_name
     * @param string $default_title
     * @return void
     */
    public static function add_admin_flexible_content_title(
        string $layout_fieldname,
        string|array $sub_field_name,
        string $default_title = "Element",
    ) : void
    {
    add_filter('acf/fields/flexible_content/layout_title/name='.$layout_fieldname, function($title, $field, $layout, $i) use ($sub_field_name, $default_title) {
            $sub_field_content = "";
            if(is_string($sub_field_name) && strpos($sub_field_name, '[]') !== false) {
                $sub_field_name = explode('[]', $sub_field_name);
                $sub_field_content = (get_sub_field($sub_field_name[0]) ? (get_sub_field($sub_field_name[0])) : false); // content[]
                if($sub_field_content && isset($sub_field_content[$sub_field_name[1]]))
                {
                    $sub_field_content = $sub_field_content[$sub_field_name[1]];
                }
            }
            else $sub_field_content = (get_sub_field($sub_field_name) ? (get_sub_field($sub_field_name)) : false);

            if( $sub_field_content ) {
                if(strlen($sub_field_content) > 100) {
                    return '<b>' . esc_html(strip_tags(substr($sub_field_content, 0,100))) . '[...]</b>';
                }
                return '<b>' . esc_html(strip_tags($sub_field_content)) . '</b>';
            }
            return $default_title;
        }, 10, 4);
    }

    public static function getPostThumbnail(string $image_id, string $params = null, bool $return_false = false): array|string
    {
        // Récupérer les informations de l'image
        $image_src = wp_get_attachment_image_src($image_id, 'full');
        if($return_false && !$image_src) return false;
        // Générer les attributs
        $attributs = array(
            'url' => $image_src ? esc_url($image_src[0]) : esc_url(self::assets('images/default.jpg')),
            'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true) ? esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) : esc_attr(get_bloginfo('name')),
            'title' => get_the_title($image_id) ?: esc_attr(get_bloginfo('name')),
        );
        // Si un paramètre spécifique est demandé
        if (!empty($params) && isset($attributs[$params])) {
            return $attributs[$params];
        }
        // Retourner tous les attributs par défaut
        return $attributs;
    }

    public static function formattedDate(string $date): string
    {
        return date('d/m/Y', strtotime($date));
    }

    /**
     * Retourne le contenu d'un champ ACF ou un champ personnalisé
     * @param string $field Nom du champ
     * @param string $id ID de la page
     */
    public static function field_value($field, $id = "")
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

    /**
     *  Retourne l'url de l'image
     *  @param string $path Chemin de l'image ou nom de l'image
     *  @return string URL de l'image echappée
    */
    public static function assets(string $path): string
    {
        return esc_url(get_template_directory_uri() . '/assets/' . $path);
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
}