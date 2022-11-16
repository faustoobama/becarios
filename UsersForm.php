<?php
require('./Texto.php');
require('./PostalCode.php');
require('./Correo.php');
require('./Nif.php');
require('./Phone.php');
require('./BirthDate.php');
require('./Name.php');
require('./Parrafo.php');

    class UsersForm {
        private $nombre;
        private $apellido;
        private $nif;
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
                $this->nif = new Nif($array['nif']);
                $this->correo = new Correo($array['correo']);
                $this->telefono = new Phone($array['telefono']);
                $this->fechaNac = new BirthDate($array['fechaNac']);
                $this->genero = new Texto($array['genero']);
                $this->localidad = new Texto($array['localidad']);
                $this->provincia = new Texto($array['provincia']);
                $this->codPostal = new PostalCode($array['codPostal']);
                $this->domicilio = new Texto($array['domicilio']);
                $this->descripcion = new Parrafo($array['descripcion']);
            }else{
                $this->nombre = new Texto();
                $this->apellido = new Texto();
                $this->nif = new Nif();
                $this->correo = new Correo();
                $this->telefono = new Phone();
                $this->fechaNac = new BirthDate();
                $this->genero = new Texto();
                $this->localidad = new Texto(); 
                $this->provincia = new Texto();
                $this->codPostal = new PostalCode();
                $this->domicilio = new Texto();
                $this->descripcion = new Parrafo();
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
                    <script src='./extraFiles/index.js' type='text/javascript'></script>
                    <title>Formulario de alta de becarios</title>
                </head>
                <body>
                    <div class='Titulo'>Formulario <br> de registro de Becarios</div>
                    <form method='post' class='insercionBecarios'>
            EOF;
            $foot = <<< EOF
                        <div class='enviar'>
                            <input type='submit' value='ENVIAR' id='enviar' name='enviar'>
                        <div>
                    </form>
                </body>
            </html>
            EOF;
            $generos = [['id'=>'Indefinido','value'=>'indefinido'],['id'=>'Femenino','value'=>'femenino'],['id'=>'Masculino','value'=>'masculino']];
            $provincias = ['-- Seleccione provincia --','Albacete','Alicante','Almería','Álava','Asturias','Ávila','Badajoz','Islas Baleares','Barcelona','Bizkaia','Burgos','Cáceres','Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','A Coruña','Cuenca','Gipuzkoa','Girona','Granada','Guadalajara','Huelva','Huesca','Jaén','León','Lleida','Lugo','Madrid','Málaga','Murcia','Navarra','Ourense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Santa Cruz de Tenerife','Segovia','Sevilla','Soria','Tarragona','Teruel','Toledo','Valencia','Valladolid','Zamora','Zaragoza','Ceuta','Melilla'];

            if(empty($_POST)){
                print($head);
                foreach ($labels as $key => $label) {
                    print("<div class='$label'>");
                    print("<label for='$label'>".(($label == 'fechaNac')?strtoupper('fecha de nacimiento'):(($label == 'codPostal')?strtoupper('codigo postal'):(strtoupper($label))))."</label>");
                    switch($label){
                        case 'codPostal':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                        case 'telefono':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                        case 'correo':
                            print("<input type='email' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                        case 'fechaNac':
                            print("<input type='date' min='1962-01-01' max='2004-12-31' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                        case 'genero':
                            foreach($generos as $genero){
                                print("<div><input type='radio' id='".$genero['value']."' name='$label' value='".$genero['value']."' ".(($genero['value'] == 'indefinido')?'checked':'')."><label for='".$genero['value']."'>".$genero['id']."</label></div>");
                            }
                        break;
                        case 'provincia':
                            print("<select id='".$label."' name=".$label.">");
                            foreach ($provincias as $key => $provincia) {
                                print("<option value='".(($provincia != '-- Seleccione provincia --')?strtolower($provincia):'')."' ".(($this->{$label}->getValue() == strtolower($provincia))?'selected':'').">".$provincia."</option>");
                            }
                            print('</select>');
                        break;
                        case 'descripcion':
                            print("<textarea id='$label' name='$label' value='".$this->{$label}->getValue()."'></textarea>");
                        break;
                        default:
                        print("<input type='text' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                    }
                    print("</div>");
                }
                print($foot);
            }else{
                print($head);
                foreach ($labels as $key => $label) {
                    print("<div class='$label'>");
                    print("<label for='$label'>".(($label == 'fechaNac')?strtoupper('fecha de nacimiento'):(($label == 'codPostal')?strtoupper('codigo postal'):(strtoupper($label))))."</label>");
                    switch($label){
                        case 'codPostal':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                        case 'telefono':
                            print("<input type='number' id='$label' name='$label' value='".$this->{$label}->getValue()."' maxlength='9'>");
                        break;
                        case 'correo':
                            print("<input type='email' id='$label' name='$label' value='".$this->{$label}->getValue()."'>");
                        break;
                        case 'fechaNac':
                            print("<input type='date' min='1962-01-01' max='2004-12-31' id='$label' name='$label' value='".$this->$label->getValue()."'>");
                        break;
                        case 'genero':
                            foreach($generos as $genero){
                                print("<div><input type='radio' id='".$genero['value']."' name='$label' value='".$genero['value']."' ".(($this->{$label}->getValue() == $genero['value'])?'checked':'')."><label for='".$genero['value']."'>".$genero['id']."</label></div>");
                            }
                        break;
                        case 'provincia':
                            print("<select id='".$label."' name=".$label.">");
                            foreach ($provincias as $key => $provincia) {
                                print("<option value='".(($provincia != '-- Seleccione provincia --')?strtolower($provincia):'')."' ".(($this->{$label}->getValue() == strtolower($provincia))?'selected':'').">".$provincia."</option>");
                            }
                            print('</select>');
                        break;
                        case 'descripcion':
                            print("<textarea id='$label' name='$label'>".$this->{$label}->getValue()."</textarea>");
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
            $inputs = $this->getAttributes();
            $totalInputs = count($inputs);
            $head = <<< EOF
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel='stylesheet' href='./extraFiles/morestyles.css'>
                    <title>Formulario de alta de becarios</title>
                </head>
                <body>
                    <div class='added'>
                        <div class='addedTitle'>BECARIO AÑADIDO EXITOSAMENTE!</div>
                        <div class='addedCont'>

            EOF;
            $foot = <<< EOF
                            <div class='input12'>
                                <a href='./index.php'>
                                    <input type='button' id='nuevoB' class='nuevoBec' value='Añadir otro becario'>
                                </a>
                             
                                <input type='button' id='listaB' class='nuevoBec' value='Listado de becarios'>

                            </div>
                        </div>
                    </div>
                </body>
            </html>
            EOF;

            $fichero = './listadoBecarios/becarios.csv';
            // Abre el fichero para obtener el contenido existente
            $contenido = file_get_contents($fichero);
            // Añade una nueva persona al fichero
            foreach ($inputs as $key => $input) {
                $contenido .= $this->{$input}->getValue().(($key != ($totalInputs - 1))?';':'');
            }
            $contenido .= "\n";
            // Escribe el contenido al fichero
            file_put_contents($fichero, $contenido);

            unset($_POST);

            print($head);
                foreach($inputs as $key => $input){
                    print("<p class=input".$key."><b>".(strtoupper($input)).":</b> <i>". (strtoupper($this->{$input}->getValue()))."</i></p>");
                }
            print($foot);
        }
    
    }
?>