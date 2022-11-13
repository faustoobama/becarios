<?php
require('./Texto.php');
require('./PostalCode.php');
require('./Correo.php');
require('./DniNie.php');
require('./Phone.php');
require('./BirthDate.php');

    class UsersForm {
        private $nombre;
        private $apellido;
        private $dniNie;
        private $correo;
        private $telefono;
        private $fechaNac;
        private $genero;
        private $comunidad;
        private $provincia;
        private $codPostal;
        private $domicilio;
        private $descripcion;
        public function __construct(array $array) {
            if(!empty($array) && count($array) > 1){
                $this->nombre = new Texto($array['nombre']);
                $this->apellido = new Texto($array['apellido']);
                $this->dniNie = new DniNie($array['dniNie']);
                $this->correo = new Correo($array['correo']);
                $this->telefono = new Phone($array['telefono']);
                $this->fechaNac = new BirthDate($array['fechaNac']);
                $this->genero = new Texto($array['genero']);
                $this->comunidad = new Texto($array['comunidad']);
                $this->provincia = new Texto($array['provincia']);
                $this->codPostal = new PostalCode($array['codPostal']);
                $this->domicilio = new Texto($array['domicilio']);
                $this->descripcion = new Texto($array['descripcion']);
            }else{
                $this->nombre = new Texto();
                $this->apellido = new Texto();
                $this->dniNie = new DniNie();
                $this->correo = new Correo();
                $this->telefono = new Phone();
                $this->fechaNac = new BirthDate();
                $this->genero = new Texto();
                $this->comunidad = new Texto();
                $this->provincia = new Texto();
                $this->codPostal = new PostalCode();
                $this->domicilio = new Texto();
                $this->descripcion = new Texto();
            }
        }
        public function getAttributes(){
            $thisObject= new ReflectionClass('UsersForm');
            $inputObjects = $thisObject->getProperties();
            return (array_map(fn($inp)=>$inp->name,$inputObjects));
        }
        public function isValid()
        {
            $result=false;
            $counter=0;
            $inputs = $this->getAttributes();
            do{
                $result = $this->{$inputs[$counter]}->isValid()['outcome'];
                $counter++;
            }
            while($result && $counter < count($inputs));
            return $result;
        }
        public function printFormData()
        {
            $labels = $this->getAttributes();
            $head = <<< EOF
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel='stylesheet' href='./extraFiles/styles.css'>
                    <title>Formulario de alta de becarios</title>
                </head>
                <body>
                    <form method='post' class='insercionBecarios'>
            EOF;
            $foot = <<< EOF
                        <div class='enviar'>
                            <input type='submit' value='enviar' id='enviar' name='enviar'>
                        <div>
                    </form>
                </body>
            </html>
            EOF;
            if(empty($_POST)){
                print($head);
                foreach ($labels as $key => $label) {
                    print("<div class='$label'>");
                    print("<label for='$label'> $label </label>");
                    switch($label){
                        case 'codPostal':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'telefono':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'correo':
                            print("<input type='email' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'fechaNac':
                            print("<input type='date' min='1962-01-01' max='2004-12-31' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'genero':
                            print("<div><input type='radio' id='gf' name='$label' value='femenino'><label for='gf'>Femenino</label></div>");
                            print("<div><input type='radio' id='gm' name='$label' value='masculino'><label for='gm'>Masculino</label></div>");
                            print("<div><input type='radio' id='x' name='$label' value='indefinido' ".('checked')."><label for='x'>Indefinido</label></div>");
                        break;
                        case 'comunidad':
                            print("<select id='$label' name='$label'><option value='femenino'>Femenino</option><option value='masculino'>Masculino</option><option value='otro'>Otro</option></select><br>");
                        break;
                        case 'provincia':
                            print("<select id='$label' name='$label'><option value='femenino'>Femenino</option><option value='masculino'>Masculino</option><option value='otro'>Otro</option></select><br>");
                        break;
                        case 'descripcion':
                            print("<textarea id='$label' name='$label' value='".$this->{$label}->getValue()."'></textarea><br>");
                        break;
                        default:
                                print("<input type='text' id='$label' name='$label'>".$this->{$label}->getValue()."<br>");
                        break;
                    }
                    print("</div>");
                }
                print($foot);
            }else{
                print($head);
                foreach ($labels as $key => $label) {
                    print("<div class='$label'>");
                    print("<label for='$label'> $label </label>");
                    switch($label){
                        case 'codPostal':
                            print("<input type='number' id='$label' name='$label' value='".$this->$label->getValue()."'><br>");
                        break;
                        case 'telefono':
                            print("<input type='number' id='$label' name='$label' value='".$this->$label->getValue()."'><br>");
                        break;
                        case 'correo':
                            print("<input type='email' id='$label' name='$label' value='".$this->$label->getValue()."'><br>");
                        break;
                        case 'fechaNac':
                            print("<input type='date' min='1962-01-01' max='2004-12-31' id='$label' name='$label' value='".$this->$label->getValue()."'><br>");
                        break;
                        case 'genero':
                            print("<div><input type='radio' id='gf' name='$label' value='femenino'><label for='gf'>Femenino</label></div>");
                            print("<div><input type='radio' id='gm' name='$label' value='masculino'><label for='gm'>Masculino</label></div>");
                            print("<div><input type='radio' id='x' name='$label' value='indefinido' ".('checked')."><label for='x'>Indefinido</label></div>");
                        break;
                        case 'comunidad':
                            print("<select id='$label' name='$label'><option value='femenino'>Femenino</option><option value='masculino'>Masculino</option><option value='otro'>Otro</option></select><br>");
                        break;
                        case 'provincia':
                            print("<select id='$label' name='$label'><option value='femenino'>Femenino</option><option value='masculino'>Masculino</option><option value='otro'>Otro</option></select><br>");
                        break;
                        case 'descripcion':
                            print("<textarea id='$label' name='$label'>".$this->{$label}->getValue()."</textarea><br>");
                        break;
                        default:
                                print("<input type='text' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                    }
                    print("<p> <b>".$this->$label->isValid()['message']."</b> </p> </div>");
                }
                print($foot);
            }
        }
        public function saveBecario()
        {
            echo "<table><tr><td>nombre</td><td>apellido</td><td>dniNie</td><td>correo</td><td>telefono</td><td>fechaNac</td><td>genero</td><td>comunidad</td><td>provincia</td><td>codPostal</td><td>domicilio</td><td>descripcion</td></tr>";
            echo "<tr><td>". $this->nombre->getValue() ."</td><td>". $this->apellido->getValue()."</td><td>". $this->dniNie->getValue() ."</td><td>". $this->correo->getValue() ."</td><td>". $this->telefono->getValue() ."</td><td>". $this->fechaNac->getValue() ."</td><td>". $this->genero->getValue()."</td><td>". $this->comunidad->getValue() ."</td><td>". $this->provincia->getValue() ."</td><td>". $this->codPostal->getValue() ."</td><td>". $this->domicilio->getValue() ."</td><td>". $this->descripcion->getValue() ."</td></tr></table>";
            unset($_POST);
            print("<a href='./index.php'><input type='button' value='Añadir nuevo becario'></a>");
        }
    
    }
?>