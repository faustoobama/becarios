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
        private $sexo;
        private $comunidad;
        private $provincia;
        private $codPostal;
        private $domicilio;
        private $descripcion;
        public function __construct(array $array) {
            if(!empty($array)){
                $this->nombre = new Texto($array['nombre']);
                $this->apellido = new Texto($array['apellido']);
                $this->dniNie = new DniNie($array['dniNie']);
                $this->correo = new Correo($array['correo']);
                $this->telefono = new Phone($array['telefono']);
                $this->fechaNac = new BirthDate($array['fechaNac']);
                $this->sexo = new Texto($array['sexo']);
                $this->comunidad = new Texto($array['comunidad']);
                $this->provincia = new Texto($array['provincia']);
                $this->codPostal = new PostalCode($array['codPostal']);
                $this->domicilio = new Texto($array['domicilio']);
                $this->descripcion = new Texto($array['descripcion']);
            }else{
                $this->printForm();
            }
        }
        public function isValid()
        {
            return true;
        }
        public function printForm()
        {
            $object = <<< EOF
                <div class='mainContainer' id='mainContainer'>
                <h1>FORMULARIO</h1>
                <form class='Container' id='form' action='' method='post'>
                <div class='inputCont'>
                    <label for='nombre'>Nombre: </label><br>
                    <input type='text' name='nombre' id='nombre'> <br>
                    <label for='apellido'>Apellido: </label><br>
                    <input type='text' name='apellido' id='apellido'> <br>
                    <label for='dni'>DNI / NIE</label> <br>
                    <input type='text' name='dni' id='dni' pattern='[0-9|Yy|Xx]{1}[0-9]{7}[A-Za-z]{1}'> <br>
                </div>

                <div class='inputCont'>
                    <label for='email'>Correo:</label> <br>
                    <input type='email' name='email' id='email' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$'> <br>
                    <label for='telefono'>Telefono:</label> <br>
                    <input type='number' name='telefono' id='telefono'> <br>
                    <label for='fechaNac'>Fecha de nacimiento: </label> <br>
                    <input type='date' name='fechaNac' id='fechaNac'> <br>
                </div>

                <div class='inputCont ofRadios'>
                    <label>Sexo:</label>
                    <div class='radios'>
                        <input type='radio' name='genero' id='generom' value='m'> <label for='generom'>Hombre</label> <br>
                        <input type='radio' name='genero' id='generof' value='f'> <label for='generof'>Mujer</label> <br>
                        <input type='radio' name='genero' id='generox' value='x'> <label for='generox'>Otro</label>
                    </div>
                    <label for='grado'>Grado: </label>
                    <select name='grado' id='grado' class='inputSel'>
                        <option value='void'>Seleccione el grado</option>
                        <option value='asir'>ASIR</option>
                        <option value='daw'>DAW</option>
                        <option value='dam'>DAM</option>
                    </select>

                    <label for='inicio'>Inicio de Practicas: </label>
                    <input type='date' name='inicio' id='inicio'>
                </div>

                <div class='inputCont'>
                <label for='grado'>Comunidad Autonoma: </label> <br>
                    <select name='comunidad' id='comunidad' class='inputSel'>
                        <option value='void'>Seleccione su comunidad</option>
                        <option value='madrid'>Madrid</option>
                        <option value='barcelona'>Barcelona</option>
                        <option value='andalucia'>Andalucia</option>
                    </select>
                    
                    <label for='provincia'>Provincia: </label> <br>
                    <select name='provincia' id='provincia' class='inputSel'>
                        <option value='void'>Seleccione su localidad</option>
                        <option value='ciempozuelos'>Ciempozuelos</option>
                        <option value='sranjuez'>Aranjuez</option>
                        <option value='villaverde'>Villa Verde</option>
                    </select>

                    <label for='postalcode'>Cod. postal:</label> <br>
                    <input type='number' name='postalcode' id='postalcode'> <br>

                    <label for='domicilio'>Domicilio</label> <br>
                    <input type='text' name='domicilio' id='domicilio'> <br>
                </div>

                <div class='inputCont checkboxs'>
                    <label for='idiomas'>Idiomas</label> <br>
                        <div><input type='checkbox' name='es' id='es'> <label for='es'>Español</label> </div>
                        <div><input type='checkbox' name='en' id='en'> <label for='en'>Ingles</label> </div>
                        <div><input type='checkbox' name='fr' id='fr'> <label for='fr'>Frances</label> </div>
                        <div><input type='checkbox' name='pt' id='pt'> <label for='pt'>Portugués</label> </div>
                </div>

                <div class='inputCont checkboxs'>
                    <label for='preferencias'>Preferencias: </label> <br>
                        <div><input type='checkbox' name='bd' id='bd'> <label for='bd'>Bases de datos</label> </div>
                        <div><input type='checkbox' name='redes' id='redes'> <label for='redes'>Redes</label> </div>
                        <div><input type='checkbox' name='sre' id='sre'> <label for='sre'>Sistemas</label> </div>
                        <div><input type='checkbox' name='devs' id='devs'> <label for='devs'>Desarrollo</label> </div>
                </div>

                <div class='inputCont' style='grid-column:1/3; grid-row:4/5;'>
                    <label for=''>Presentacion: </label> <br>
                    <textarea name='presentacion' id='presentacion' cols='30' rows='10' placeholder='Acerca de ti ...'></textarea> <br>
                </div>

                <div class='inputCont' style='grid-column:1/3; grid-row:5/6;display; flex; flex-direction: column; justify-content: space-between'>
                    <input type='file' name='curriculum' id='curriculum'> <label for='curriculum' id='curr'>Adjuntar fichero</label>
                    <input type='submit' name='enviar' id='enviar' class='enviar'>
                    <input type='button' value='enviar' id='enviarFalse' class='enviar'>
                </div>
                    
                </form>

                <div id='confirmBanner'>
                <div id='formInfo' style='grid-column: 1/3;grid-row: 1/2;'></div>

                <label for='enviar' class='bannerButton' id='confirmButton' style='grid-column: 1/2;grid-row: 2/3;'>Confirmar</label>

                <div class='bannerButton' id='cancelButton' style='grid-column: 2/3;grid-row: 2/3;'>Cancelar</div>
                </div>
                </div>
            EOF;
            print($object);
        }
    
    }
?>