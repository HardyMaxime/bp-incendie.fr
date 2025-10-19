<?php

namespace App\Controllers;

use App\Trait\SingletonTrait;

final class PageController extends AbstractController
{
    use SingletonTrait;

    public function __construct()
    {
        $this->add_admin_flexible_content_title(
            "section-mission",
            "title",
            "Paragraphe"
        );
    }
}