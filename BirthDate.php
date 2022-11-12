<?php
class BirthDate extends Texto {
    public function isValid(){
        
        if(parent::isValid()['outcome']){
            $year = intval(explode('/',$this->getValue())[2]);
            $now = intval(explode('/',Date('d/m./Y'))[2]);
            if($year <= ($now - 18) && $year >= ($now - 60)){
                return ['outcome' => true, 'message' => parent::isValid()['message'].'. Fecha de nacimiento válida'];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].' Fecha de nacimiento inválida. Menor de edad'];
        }else {
            return ['outcome' => false, 'message' => parent::isValid()['message']];
        }
    }
}
?>