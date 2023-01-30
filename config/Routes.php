<?php

use Eshop\Core\Routing\Router;

Router::get('/', [new Eshop\Controllers\MainController(), 'mainAction']);

Router::get('/product/:id/', [new Eshop\Controllers\ProductController(), 'detailsAction']);

