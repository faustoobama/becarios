<?php
class Nif extends Texto {
    function isValid(){
        if (!preg_match('/[0-9]{1}$/',substr($this->getValue(),0,1))){
            if(preg_match('/^[XYZT]{1}[0-9]{7}[QZK]{1}$/i', $this->getValue())){
                return ['outcome' => true, 'message' => parent::isValid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Formato de NIE incorrecto'];
        }else{
            if(preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}$/i', $this->getValue())){
                return ['outcome' => true, 'message' => parent::isValid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Formato de DNI incorrecto'];
        }
    }    
}
?>