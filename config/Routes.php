<?php

use Eshop\core\Routing\Router;

Router::get('/', [new Eshop\Controllers\MainController(), 'mainAction']);

Router::get('/product/:id/', [new Eshop\Controllers\ProductController(), 'detailsAction']);