<?php
    class Parrafo extends Texto {
        function isValid(){
            if((strlen($this->getValue()) > 120) && preg_match('/^[a-zA-Záéí óúüöäñÑ0-9.\,\:ç\s]{120,400}$/iu', $this->getValue())) {
                return ['outcome' => true, 'message' => parent::isvalid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>El párrafo contiene caracteres no válidos o longitud inválida'];
        }
    }
?>