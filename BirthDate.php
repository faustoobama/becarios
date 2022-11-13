<?php
class BirthDate extends Texto {
    public function isValid(){
        if(parent::isValid()['outcome']){
            $year = intval(explode('-',$this->getValue())[0]);
            $now = intval(explode('-',Date('Y-m-d'))[0]);
            if($year <= ($now - 18) && $year >= ($now - 60)){
                return ['outcome' => true, 'message' => parent::isValid()['message']];
            }else return ['outcome' => false, 'message' => parent::isValid()['message'].'<br>Fecha de nacimiento inválida. Debe estar entre los 18 y los 60 años'];
        }else {
            return ['outcome' => false, 'message' => parent::isValid()['message']];
        }
    }
}
?>