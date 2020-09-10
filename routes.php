<?php
$router->get('', 'IndexControllers@index');
$router->post('new-todo', 'IndexControllers@newTodo');
$router->post('edit-todo', 'IndexControllers@editTodo');
$router->post('delete', 'IndexControllers@delete');
$router->get('delete-complete', 'IndexControllers@deleteComplete');
$router->post('get-todo', 'IndexControllers@getTodo');

$router->get('mark-all', 'IndexControllers@markAllTodo');

