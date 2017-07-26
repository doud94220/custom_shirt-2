<?php

require 'layout/top.view.php';
?>


<h1>Utilisateur</h1>
<table class='table'>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Adresse</th>
        
    </tr>
    <?php
    foreach ($users as $user):
        ?>
    <tr>
        <td><?= $user-> getId(); ?></td>
        <td><?= $user-> getLastname(); ?></td>
        <td><?= $user-> getFirstname(); ?></td>
        <td><?= $user-> getEmail(); ?></td>
        <td><?= $user-> getAddress(); ?></td>
        
    </tr>
   <?php endforeach;
   ?>
</table>

<?php
require 'layout/bottom.view.php';
