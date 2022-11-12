<?php

require('./UsersForm.php');

$form = new UsersForm($_POST);

if($form->isValid()){
    print('Formulario valido <br>');
}else{
    print($form->getFailureMessages());
}

?>