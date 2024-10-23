<?php 

class Paginator
{
    public static function clbs_create_pagination($paged)
    {
        $pages = paginate_links([
            'type' => 'array',
            'prev_next' => false,
            'current'    => max( 1, $paged )
        ]);
        if ($pages === null) {
            return;
        }
        echo '<nav class="pagination-wrapper reset-list" aria-label="Pagination"  >';
        echo '<ul class="pagination">';
        foreach ($pages as $page) {
            $active = strpos($page, 'current') !== false;
            $class = 'pagination-item';
            if ($active) {
                $class .= ' active';
            }
            echo '<li class="' . $class . '">';
            echo str_replace('page-numbers', 'realisation-pagination-item-child', $page);
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}