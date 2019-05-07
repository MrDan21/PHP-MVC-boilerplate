<?php

use Core\Router;

Router::GET('user/home/', 'home@show');
Router::GET('user/register/', 'register@show');
Router::GET('user/login/', 'login@show');
Router::POST('user/register/', 'register@register');
Router::POST('user/login/', 'login@login');
Router::GET('user/logout/', 'logout@logout');
Router::GET('user/confirmation/', 'login@confirmation');
Router::GET('user/profile/', 'profile@show');
Router::POST('user/profile/', 'profile@update');
Router::GET('user/delete/', 'profile@delete');
