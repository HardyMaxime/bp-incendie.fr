<?php

namespace App\Helpers;

final class ThemeHelper
{
    /**
     * Retourne le contenu d'un champ ACF ou un champ personnalisé
     * @param string $field Nom du champ
     * @param string $id ID de la page
     */
    public static function value($field, $id = "")
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
     *  Retourne l'url de l'image
     *  @param string $path Chemin de l'image ou nom de l'image
     *  @return string URL de l'image echappée
    */
    public function assets(string $path): string
    {
        return esc_url(get_template_directory_uri() . '/assets/' . $path);
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
}