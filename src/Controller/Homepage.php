<?php

namespace BuyMeACoffee\Controller;

use BuyMeACoffee\Kernel\PhpTemplate\View;

class Homepage {
    public function index(): void {
        View::render('home/index', 'Homepage', ['name' => 'Sarah']);
    }

    public function edit(): void {
        echo 'Edit hi';
    }
}
