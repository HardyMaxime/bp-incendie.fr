<?php

class MenuController
{
    private static $_instance; // L'attribut qui stockera l'instance unique
    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new MenuController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        //add_filter('acf/fields/flexible_content/layout_title/name=header', array( $this, 'adminTitleHeader' ), 10, 4);
    }

    public static function getMainMenu()
    {
        $location = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($location[MAIN_MENU]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        return $menu_items;
    }

    public static function getArrayMenuItem(bool $show_all = false):array
    {
        $originalArray = self::getMainMenu();
        if(empty($originalArray)) return [];
        $primaryArray = array();
  
        foreach($originalArray as $item)
        {
            if(!$show_all && $item->menu_item_parent !== "0") continue;
            $primaryArray[$item->ID]['title'] = $item->title;
            $primaryArray[$item->ID]['url'] = $item->url;
            $primaryArray[$item->ID]['target'] = $item->target;
            $primaryArray[$item->ID]['parent'] = $item->menu_item_parent;
            $primaryArray[$item->ID]['child'] = self::getChildMenuItemByArray($originalArray, $item->object_id);
            $primaryArray[$item->ID]['object_id'] = $item->object_id;
        }

        return $primaryArray;
    }

    public static function getChildMenuItemByArray(array $currentMenu, string $parent_id)
    {
        if(empty($currentMenu)) return [];
        $children = array();
        foreach ($currentMenu as $menu_item) {
            if ($menu_item->menu_item_parent == $parent_id) {
                // Cet élément est un enfant de l'élément parent spécifié
                $children[] = $menu_item;
            }
        }
        return $children;
    }

    public static function getChildMenuItem(string $parent_id)
    {
        $originalArray = self::getArrayMenuItem(true);
        if(empty($originalArray)) return [];

        $filteredArray = array_filter($originalArray, function ($element) use ($parent_id) {
            return $element['parent'] == $parent_id;
        });

        return $filteredArray;
    }

    public static function getSecondaryMenu()
    {
        $location = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($location[SECONDARY_MENU]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        return $menu_items;
    }

}