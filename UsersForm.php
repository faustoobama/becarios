<?php
require('./Texto.php');
require('./PostalCode.php');
require('./Correo.php');
require('./DniNie.php');
require('./Phone.php');
require('./BirthDate.php');
require('./Name.php');
require('./TextArea.php');

    class UsersForm {
        private $nombre;
        private $apellido;
        private $dniNie;
        private $correo;
        private $telefono;
        private $fechaNac;
        private $genero;
        private $localidad;
        private $provincia;
        private $codPostal;
        private $domicilio;
        private $descripcion;
        public function __construct(array $array) {
            if(!empty($array) && count($array) > 1){
                $this->nombre = new Name($array['nombre']);
                $this->apellido = new Name($array['apellido']);
                $this->dniNie = new DniNie($array['dniNie']);
                $this->correo = new Correo($array['correo']);
                $this->telefono = new Phone($array['telefono']);
                $this->fechaNac = new BirthDate($array['fechaNac']);
                $this->genero = new Texto($array['genero']);
                $this->localidad = new Texto($array['localidad']);
                $this->provincia = new Texto($array['provincia']);
                $this->codPostal = new PostalCode($array['codPostal']);
                $this->domicilio = new Texto($array['domicilio']); // pending
                $this->descripcion = new Texto($array['descripcion']);
            }else{
                $this->nombre = new Texto();
                $this->apellido = new Texto();
                $this->dniNie = new DniNie();
                $this->correo = new Correo();
                $this->telefono = new Phone();
                $this->fechaNac = new BirthDate();
                $this->genero = new Texto();
                $this->localidad = new Texto(); 
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
                        case 'provincia':
                            $provincias = ['-- Seleccione provincia --','Albacete','Alicante','Almería','Álava','Asturias','Ávila','Badajoz','Islas Baleares','Barcelona','Bizkaia','Burgos','Cáceres','Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','A Coruña','Cuenca','Gipuzkoa','Girona','Granada','Guadalajara','Huelva','Huesca','Jaén','León','Lleida','Lugo','Madrid','Málaga','Murcia','Navarra','Ourense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Santa Cruz de Tenerife','Segovia','Sevilla','Soria','Tarragona','Teruel','Toledo','Valencia','Valladolid','Zamora','Zaragoza','Ceuta','Melilla'];
                            print("<select id='".$label."' name=".$label.">");
                            foreach ($provincias as $key => $provincia) {
                                print("<option value='".$provincia."'>".$provincia."</option>");
                            }

                            print('</select>');
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
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'telefono':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'correo':
                            print("<input type='email' id='$label' name='$label' value='".$this->{$label}->getValue()."'><br>");
                        break;
                        case 'fechaNac':
                            print("<input type='date' min='1962-01-01' max='2004-12-31' id='$label' name='$label' value='".$this->$label->getValue()."'><br>");
                        break;
                        case 'genero':
                            print("<div><input type='radio' id='gf' name='$label' value='femenino' ".(($this->{$label}->getValue() == 'femenino')?'checked':'')."><label for='gf'>Femenino</label></div>");
                            print("<div><input type='radio' id='gm' name='$label' value='masculino' ".(($this->{$label}->getValue() == 'masculino')?'checked':'')."><label for='gm'>Masculino</label></div>");
                            print("<div><input type='radio' id='x' name='$label' value='indefinido' ".(($this->{$label}->getValue() == 'indefinido')?'checked':'')."><label for='x'>Indefinido</label></div>");
                        break;
                        case 'provincia':
                            $provincias = ['-- Seleccione provincia --','Albacete','Alicante','Almería','Álava','Asturias','Ávila','Badajoz','Islas Baleares','Barcelona','Bizkaia','Burgos','Cáceres','Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','A Coruña','Cuenca','Gipuzkoa','Girona','Granada','Guadalajara','Huelva','Huesca','Jaén','León','Lleida','Lugo','Madrid','Málaga','Murcia','Navarra','Ourense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Santa Cruz de Tenerife','Segovia','Sevilla','Soria','Tarragona','Teruel','Toledo','Valencia','Valladolid','Zamora','Zaragoza','Ceuta','Melilla'];                            print("<select id='".$label."' name=".$label.">");
                            foreach ($provincias as $key => $provincia) {
                                //($this->{$label}->getValue() == $provincia)?print("<option value='".$provincia."' selected>".$provincia."</option>"):print("<option value='".$provincia."'>".$provincia."</option>");
                                print("<option value='".$provincia."' ".(($this->{$label}->getValue() == $provincia)?'selected':'').">".$provincia."</option>");
                            }
                            //print("<select id='$label' name='$label'><option value='Álava'>Álava</option><option value='Albacete'>Albacete</option><option value='Alicante'>Alicante</option><option value='Almería'>Almería</option><option value='Asturias'>Asturias</option><option value='Ávila'>Ávila</option><option value='Badajoz'>Badajoz</option><option value='Barcelona'>Barcelona</option><option value='Burgos'>Burgos</option><option value='Cáceres'>Cáceres</option><option value='Cádiz'>Cádiz</option><option value='Cantabria'>Cantabria</option><option value='Castellón'>Castellón</option><option value='Ceuta'>Ceuta</option><option value='Ciudad Real'>Ciudad Real</option><option value='Córdoba'>Córdoba</option><option value='La Coruña'>La Coruña</option><option value='Cuenca'>Cuenca</option><option value='Gerona'>Gerona</option><option value='Granada'>Granada</option><option value='Guadalajara'>Guadalajara</option><option value='Guipúzcoa'>Guipúzcoa</option><option value='Huelva'>Huelva</option><option value='Huesca'>Huesca</option><option value='Baleares'>Baleares</option><option value='Jaén'>Jaén</option><option value='León'>León</option><option value='Lérida'>Lérida</option><option value='Lugo'>Lugo</option><option value='Madrid'>Madrid</option>v<option value='Málaga'>Málaga</option><option value='Melilla'>Melilla</option><option value='Murcia'>Murcia</option><option value='Navarra'>Navarra</option><option value='Orense'>Orense</option><option value='Palencia'>Palencia</option><option value='Las Palmas'>Las Palmas</option><option value='Pontevedra'>Pontevedra</option><option value='La Rioja'>La Rioja</option><option value='Salamanca'>Salamanca</option><option value='Segovia'>Segovia</option><option value='Sevilla'>Sevilla</option><option value='Soria'>Soria</option><option value='Tarragona'>Tarragona</option><option value='Santa Cruz de Tenerife'>Santa Cruz de Tenerife</option><option value='Teruel'>Teruel</option><option value='Toledo'>Toledo</option><option value='Valencia'>Valencia</option><option value='Valladolid'>Valladolid</option><option value='Vizcaya'>Vizcaya</option><option value='Zamora'>Zamora</option><option value='Zaragoza'>Zaragoza</option></select><br>");
                            print('</select>');
                        break;
                        case 'descripcion':
                            print("<textarea id='$label' name='$label'>".$this->{$label}->getValue()."</textarea><br>");
                        break;
                        default:
                                print("<input type='text' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                    }
                    ($this->{$label}->isValid()['outcome'])?print("<p> <b>".$this->{$label}->isValid()['message']."</b> </p> </div>"):print("<p> <i>".$this->{$label}->isValid()['message']."</i> </p> </div>");
                }
                print($foot);
            }
        }
        public function saveBecario()
        {
            echo "<table><tr><td>nombre</td><td>apellido</td><td>dniNie</td><td>correo</td><td>telefono</td><td>fechaNac</td><td>genero</td><td>localidad</td><td>provincia</td><td>codPostal</td><td>domicilio</td><td>descripcion</td></tr>";
            echo "<tr><td>". $this->nombre->getValue() ."</td><td>". $this->apellido->getValue()."</td><td>". $this->dniNie->getValue() ."</td><td>". $this->correo->getValue() ."</td><td>". $this->telefono->getValue() ."</td><td>". $this->fechaNac->getValue() ."</td><td>". $this->genero->getValue()."</td><td>". $this->localidad->getValue() ."</td><td>". $this->provincia->getValue() ."</td><td>". $this->codPostal->getValue() ."</td><td>". $this->domicilio->getValue() ."</td><td>". $this->descripcion->getValue() ."</td></tr></table>";
            unset($_POST);
            print("<a href='./index.php'><input type='button' value='Añadir nuevo becario'></a>");

            ///

        }
    
    }
?>