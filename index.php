<?php
    require('./UsersForm.php');

    $form = new UsersForm($_POST);
    
    if($form->isValid()){

       $form->saveBecario();

       unset($form);

    }else $form->printFormData();

?>