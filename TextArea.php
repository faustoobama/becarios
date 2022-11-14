<?php
    class TextArea extends Texto { //¿necesario poner un placeholder para indicar la longitud?
        function isValid(){
            if((strlen($this->getValue()) > 120) && preg_match('/^[a-zA-Záéí óúüöäñ0-9.\,\:ç]{120,300}[.]{5}$/i', $this->getValue())) {
                return ['outcome' => true, 'message' => parent::isvalid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Texto no válido'];
        }
    }
?>