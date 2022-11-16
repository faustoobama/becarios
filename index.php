<?php
    require('./UsersForm.php');

    $form = new UsersForm($_POST);
    
    if($form->isValid()){

       $form->saveBecario();

    }else $form->printFormData(); //se imprime el formulario vacío ($_POST vacío) para ingreso de datos la primera vez y las siguientes con los errores hasta que se válido

?>