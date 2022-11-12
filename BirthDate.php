<?php
class BirthDate extends Texto {
    public function isValid(){
        
        if(parent::isValid()['outcome']){
            $year = intval(explode($this->value,'/')[2]);
            $now = intval(explode(Date('dd.mm.Y'),'/')[2]);
            if($year >= ($now - 18)){
                return ['outcome' => true, 'message' => parent::isValid()['message'].'. Fecha de nacimiento válida'];
            }
        }else {
            return ['outcome' => false, 'message' => parent::isValid()['message'].' o fecha de nacimiento superior al limite, usuario menor de edad'];
        }
    }
}
?>