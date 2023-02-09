<?php

use Eshop\core\Routing\Router;

Router::get('/', [new Eshop\Controllers\MainController(), 'catalog']);

Router::get('/product/:id/', [new Eshop\Controllers\ProductController(), 'detail']);

Router::get('/tag/:id/', [new Eshop\Controllers\MainController(), 'catalogByTag']);

Router::get('/find', [new Eshop\Controllers\MainController(), 'catalogBySearch']);

Router::get('/order/:id/', [new Eshop\Controllers\OrderController(), 'order']);