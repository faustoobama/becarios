<?php
    require('./UsersForm.php');

    $form = new UsersForm($_POST);

    if($form->isValid()){

        print('Enviado');

    }else $form->printData();
?>