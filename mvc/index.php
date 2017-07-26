
<?php
require 'App/autoload.php';

use Model\User; 

$users = User::findAll(); 

var_dump($users);

require 'views/index.view.php';
