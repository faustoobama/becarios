<?php
class Phone extends Texto {
    function isValid(){
        if(strlen($this->getValue()) == 9  && preg_match('/^[0-9]{9}$/', $this->getValue())){
            return ['outcome' => true, 'message' => parent::isValid()['message']];
        } else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Formato de telefono incorrecto'];

    }
}
?>