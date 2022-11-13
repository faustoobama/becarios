<?php

    class Becario {
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
        public function __construct(UsersForm $user){
            $this->nombre = $user->nombre;
            $this->apellido = $user->apellido;
            $this->dniNie = $user->dniNie;
            $this->correo = $user->correo;
            $this->telefono = $user->telefono;
            $this->fechaNac = $user->fechaNac;
            $this->sexo = $user->genero;
            $this->comunidad = $user->comunidad;
            $this->provincia = $user->provincia;
            $this->codPostal = $user->codPostal;
            $this->domicilio = $user->domicilio;
            $this->descripcion = $user->descripcion;
        }

        public function printBecario()
        {
            echo "<table><tr><td>nombre</td><td>apellido</td><td>dniNie</td><td>correo</td><td>telefono</td><td>fechaNac</td><td>sexo</td><td>comunidad</td><td>provincia</td><td>codPostal</td><td>domicilio</td><td>descripcion</td></tr>";
            echo "<tr><td>". $this->nombre->getValue() ."</td><td>". $this->apellido->getValue()."</td><td>". $this->dniNie->getValue() ."</td><td>". $this->correo->getValue() ."</td><td>". $this->telefono->getValue() ."</td><td>". $this->fechaNac->getValue() ."</td><td>". $this->sexo->getValue()."</td><td>". $this->comunidad->getValue() ."</td><td>". $this->provincia->getValue() ."</td><td>". $this->codPostal->getValue() ."</td><td>". $this->domicilio->getValue() ."</td><td>". $this->descripcion->getValue() ."</td></tr></table>";
        }
    
    }
?>