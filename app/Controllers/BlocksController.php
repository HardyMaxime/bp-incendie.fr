<?php

namespace App\Controllers;

use App\Trait\SingletonTrait;
use App\Controllers\AbstractController;

final class BlocksController extends AbstractController
{
    use SingletonTrait;

    public function __construct()
    {
        add_filter("block_categories_all", [$this, 'create_category'], 10, 2);

        $this->register("block-title");
    }

    protected function register(string $block_name): void
    {
        $dir = get_template_directory(). "/blocks/" . $block_name;

        if (!function_exists('register_block_type')) {
            throw new \Exception("La fonction register_block_type n'existe pas");
        }
        if (!file_exists($dir . '/block.json')) {
            throw new \Exception("Le block $block_name n'a pas de fichier block.json");
        }

        add_action('init', function() use ($dir) {
            register_block_type($dir);
        });
        /*
        if(!function_exists('acf_register_block_type')) {
            return;
        }

        acf_register_block_type(array_merge([
            'category' => 'theme-blocks',
        ], $args));
        */
    }

    public function create_category($categories) 
    {
        $categories[] = [
            'slug' => 'theme-blocks',
            'title' => 'Blocs du thème BP Incendie',
            'icon'  => 'admin-customizer',
        ];
        return $categories;
    }
}