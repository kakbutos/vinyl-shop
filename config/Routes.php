<?php

use Eshop\core\Routing\Router;

Router::get('/', [new Eshop\Controllers\MainController(), 'catalog']);


Router::get('/product/:id/', [new Eshop\Controllers\ProductController(), 'detail']);


Router::get('/tag/:id/', [new Eshop\Controllers\MainController(), 'catalogByTag']);

Router::get('/find', [new Eshop\Controllers\MainController(), 'catalogBySearch']);


Router::get('/order/:id/', [new Eshop\Controllers\OrderController(), 'getOrder']);

Router::post('/createOrder', [new Eshop\Controllers\OrderController(), 'createOrder']);


Router::get('/admin', [new Eshop\Controllers\AdminController(), 'getAdmin']);

Router::get('/admin/getList', [new Eshop\Controllers\AdminController(), 'getList']);

Router::get('/admin/getSelectFieldData', [new Eshop\Controllers\AdminController(), 'getSelectFieldData']);

Router::get('/admin/newItem', [new Eshop\Controllers\AdminController(), 'newItem']);

Router::post('/admin/setItem', [new Eshop\Controllers\AdminController(), 'setItem']);

Router::post('/admin/deleteItem', [new Eshop\Controllers\AdminController(), 'deleteItem']);


Router::get('/login', [new Eshop\Controllers\userAdminController(), 'login']);

Router::post('/login', [new Eshop\Controllers\userAdminController(), 'auth']);

Router::get('/logout', [new Eshop\Controllers\userAdminController(), 'logout']);


Router::get('/admin/image/:id/', [new Eshop\Controllers\ImageController(), 'getImage']);

Router::post('/admin/image/add/:id/', [new Eshop\Controllers\ImageController(), 'addImage']);

Router::get('/admin/image/delete/:id/', [new Eshop\Controllers\ImageController(), 'deleteImage']);

Router::get('/admin/image/isMain/:id/', [new Eshop\Controllers\ImageController(), 'getIsMainImage']);


Router::get('/admin/order/:id/', [new Eshop\Controllers\OrderItemController(), 'getOrderItems']);

Router::get('/admin/order/add/:id/', [new Eshop\Controllers\OrderItemController(), 'addOrderItem']);

Router::get('/admin/order/delete/:id/', [new Eshop\Controllers\OrderItemController(), 'deleteOrderItem']);