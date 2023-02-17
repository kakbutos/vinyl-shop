<?php

use Eshop\core\Routing\Router;

Router::get('/', [new Eshop\Controllers\MainController(), 'catalog']);

Router::get('/product/:id/', [new Eshop\Controllers\ProductController(), 'detail']);

Router::get('/tag/:id/', [new Eshop\Controllers\MainController(), 'catalogByTag']);

Router::get('/find', [new Eshop\Controllers\MainController(), 'catalogBySearch']);

Router::get('/order/:id/', [new Eshop\Controllers\OrderController(), 'getOrder']);

Router::post('/CreateOrder', [new Eshop\Controllers\OrderController(), 'CreateOrder']);

Router::get('/admin', [new Eshop\Controllers\AdminController(), 'getAdmin']);

Router::get('/admin/getList', [new Eshop\Controllers\AdminController(), 'getList']);

Router::get('/admin/newItem', [new Eshop\Controllers\AdminController(), 'newItem']);

Router::post('/admin/setItem', [new Eshop\Controllers\AdminController(), 'setItem']);

Router::post('/admin/deleteItem', [new Eshop\Controllers\AdminController(), 'deleteItem']);

Router::get('/login', [new Eshop\Controllers\AdminController(), 'login']);

Router::post('/login', [new Eshop\Controllers\AdminController(), 'auth']);

Router::get('/logout', [new Eshop\Controllers\AdminController(), 'logout']);