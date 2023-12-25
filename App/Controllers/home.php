<?php

use App\Core\Page;

class home
{
    public static function index(): void
    {
        Page::Load("demo");
    }
}
