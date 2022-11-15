<?php
    class Parrafo extends Texto { //¿necesario poner un placeholder para indicar la longitud?
        function isValid(){
            if((strlen($this->getValue()) > 120) && preg_match('/^[a-zA-Záéí óúüöäñ0-9.\,\:ç\s]{120,400}$/iu', $this->getValue())) {
                return ['outcome' => true, 'message' => parent::isvalid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Parrafo contiene caracteres no válido o longitud inválida'];
        }
    }
?>