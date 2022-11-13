<?php
class PostalCode extends Texto {
    function isValid(){
        if(strlen($this->getValue()) == 5  && preg_match('/^[0-9]{5}$/', $this->getValue())){
            return ['outcome' => true, 'message' => parent::isValid()['message']];
        } else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Formato de cod. postal incorrecto'];
    }
}
?>