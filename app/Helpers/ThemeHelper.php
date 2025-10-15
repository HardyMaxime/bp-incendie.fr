<?php

namespace App\Helpers;

use App\Controllers\AbstractController;

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

    public function controller(string $controller_name): AbstractController
    {
        $fqcn = $this->resolveControllerFqcn($controller_name);
        if (!class_exists($fqcn)) {
            throw new \InvalidArgumentException("Le contrôleur {$fqcn} n'existe pas.");
        }
        if (!is_subclass_of($fqcn, AbstractController::class)) {
            throw new \InvalidArgumentException("{$fqcn} n'étend pas AbstractController.");
        }

        $instance = $fqcn::getInstance();
        return $instance;
    }

    /**
     * Convertit 'page' / 'PageController' en '\App\Controllers\PageController'
     */
    private function resolveControllerFqcn(string $name): string
    {
        // FQCN déjà fourni
        if (str_contains($name, '\\')) {
            return ltrim($name, '\\');
        }

        // 'page' -> 'PageController', 'PageController' -> 'PageController'
        $base = preg_replace('/Controller$/', '', $name);   // retire 'Controller' s'il existe
        $base = ucfirst($base) . 'Controller';

        return '\\App\\Controllers\\' . $base;
    }
}