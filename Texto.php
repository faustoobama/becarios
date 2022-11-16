<?php

class Texto { //la clase principal
    private $value;
    public function __construct($val=''){
        $this->value = strtolower($this->filtrar($val));
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
    public function filtrar($valor){
        // Esta funcion impedira la inyeccion HTML => htmlspecialchars()
        return htmlspecialchars(stripcslashes(trim($valor)));
    }
}

?>