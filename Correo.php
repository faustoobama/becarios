<?php
class Correo extends Texto {
    function isValid(){
        if(preg_match('/^[a-zA-Z0-9_]+[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $this->getValue())){
            return ['outcome' => true, 'message' => parent::isValid()['message']];
        }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Formato de correo electrónico incorrecto'];
    }
}
?>