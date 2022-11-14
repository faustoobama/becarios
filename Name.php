<?php

    class Name extends Texto{
        function isValid(){
            if((strlen($this->getValue()) < 25) && preg_match('/^[a-zA-Záéí óúüöäñ]{2,25}$/i', $this->getValue())) {
                return ['outcome' => true, 'message' => parent::isvalid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Dato no válido'];
        }


    }
?>