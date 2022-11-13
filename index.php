<?php
    require('./UsersForm.php');
    require('./Becario.php');

    $form = new UsersForm($_POST);
    
    if($form->isValid()){

       $form->saveBecario();

    }else $form->printFormData();

?>