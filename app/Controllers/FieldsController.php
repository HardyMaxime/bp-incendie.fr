<?php

namespace App\Controllers;

use App\Trait\SingletonTrait;
use App\Lib\PostType\PostType;
use App\Lib\PostType\Taxonomy;

final class FieldsController extends AbstractController
{
    use SingletonTrait;

    public function __construct()
    {
       $this->safe_init([$this, 'register_taxonomy']);
       $this->safe_init([$this, 'register_posttype']);
    }

    public function register_posttype(): void
    {
        $expertise_options = [
            "supports" => ["title", "editor"],
            "publicly_queryable" => true,
            "with_front" => false,
            "has_archive" => false,
            "hierarchical" => false,
            "rewrite" => ["slug" => "secteur-activite"],
        ];

        $expertise_labels = [
            'name' => __('Activités'),
            'singular_name' => __('Activité'),
            'menu_name' => __('Activités'),
            'add_new' => __('Ajouter une activité'),
            'add_new_item' => __('Ajouter une activité'),
            'all_items' => __('Toutes les activités'),
            'edit_item' => __('Éditer une activité'),
            'new_item' => __('Nouvelle activité'),
            'view_item' => __("Voir l’activité"),
            'search_items' => __('Rechercher une activité'),
            'not_found' => __('Aucune activité trouvée'),
            'not_found_in_trash' => __('Aucune activité trouvée dans la corbeille'),
        ];

        $expertise = new PostType( 'expertise', $expertise_options, $expertise_labels );
        $expertise->icon( 'dashicons-star-filled' );
        $expertise->taxonomy('service');

        $expertise->register();
    }

    public function register_taxonomy(): void
    {
        $names = [
            'name' => 'service',
            'singular' => 'Service',
            'plural' => 'Services',
            'slug' => 'services'
        ];
        $genres = new Taxonomy( $names );
        $genres->register();
    }
}