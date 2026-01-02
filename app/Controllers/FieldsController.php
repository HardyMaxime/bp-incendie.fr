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
       //$this->safe_init([$this, 'register_taxonomy']);
       $this->safe_init([$this, 'register_posttype']);

        $this->add_admin_flexible_content_title(
            "paragraphe",
            "text",
            "Paragraphe"
        );
        $this->add_admin_flexible_content_title(
            "service-paragraphe",
            "text",
            "Paragraphe"
        );
    }

    public function register_posttype(): void
    {
        $expertise_options = [
            "supports" => ["title"],
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
        //$expertise->taxonomy('service');

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

    /**
     * Récupère et résume le premier champ répéteur ACF "paragraphe" d'une expertise
     *
     * @param int|null $post_id ID du post (null pour le post courant)
     * @return string Le résumé en 6 lignes maximum
     */
    public function get_excerpt($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }

        // Vérifier que c'est bien un post de type expertise
        if (get_post_type($post_id) !== 'expertise') {
            return '';
        }

        // Récupérer le champ répéteur
        $paragraphes = get_field('paragraphe', $post_id);

        if (!$paragraphes || !is_array($paragraphes) || empty($paragraphes)) {
            return '';
        }

        // Récupérer le premier paragraphe
        $first_paragraph = $paragraphes[0];

        if (empty($first_paragraph['text'])) {
            return '';
        }

        $text = $first_paragraph['text'];
        // Nettoyer le HTML
        $max_chars = 300; // Limite de caractères
        $text = wp_strip_all_tags($text);
        $text = trim($text);

        // Limiter au nombre de caractères maximum
        if (mb_strlen($text) > $max_chars) {
            $text = mb_substr($text, 0, $max_chars);
            // Couper au dernier mot complet
            $last_space = mb_strrpos($text, ' ');
            if ($last_space !== false) {
                $text = mb_substr($text, 0, $last_space);
            }
            $text .= '...';
        }

        return $text;
    }
}