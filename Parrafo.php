<?php
    class Parrafo extends Texto { //¿necesario poner un placeholder para indicar la longitud?
        function isValid(){
            if((strlen($this->getValue()) < 300) && preg_match('/^[a-zA-Záéí óúüöäñ0-9.\,\:ç\s]{50,300}$/i', $this->getValue())) {
                return ['outcome' => true, 'message' => parent::isvalid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Texto no válido'];
        }
    }
?>