<?php

class Texto {
    private $value;
    public function __construct($val=''){
        $this->value = $val;
    }
    public function isValid(){
        if((strlen($this->value) > 0 && $this->value != ' ')){
            return ['outcome' => true, 'message' => 'Valor válido'];
        }else {
            return ['outcome' => false, 'message' => 'Cadena inválida. La cadena está vacia o no supera la longitud mínima'];
        }
    }
    public function getValue(){
        return $this->value;
    }
}


    //falta por poner lo necesario para evitar la inyección 
?>