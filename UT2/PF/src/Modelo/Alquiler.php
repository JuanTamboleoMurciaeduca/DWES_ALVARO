<?php
    namespace Clase\Alquileres\Modelo;

use Clase\Alquileres\Excepcion\AlquilerException;
use InvalidArgumentException;

    abstract class Alquiler{
        private readonly int $id;
        private string $cliente;
        private int $dias;
        private EstadoAlquiler $estado;

        public function __construct(int $id, string $cliente, int $dias, EstadoAlquiler $estado){
            $this->id = $id;
            $this->cliente = trim($cliente);
            $this->dias = $dias;
            $this->estado = $estado;

            if($this->id < 0){
                throw new InvalidArgumentException("El id tiene que ser mayor a 0");
            }

            if($this->cliente === ""){
                throw new InvalidArgumentException("El nombre no puede estar vacio");
            }

            if($this->dias < 1 || $this->dias > 7){
                throw new InvalidArgumentException("El numero de dias tiene que estar entre 1 y 7");
            }
        
        }

        public function id():int{
            return $this->id;
        }

        public function cliente():string{
            return $this->cliente;
        }

        public function dias():int{
            return $this->dias;
        }

        public function estado():EstadoAlquiler{
            return $this->estado;
        }

        public abstract function modalidad():string;
        protected abstract function tarifaDiaria():int;

        public function importe() : int {
            return $this->dias * $this->tarifaDiaria();
        }

        public function iniciar():void{
            if($this->estado === EstadoAlquiler::Activo){
                throw new AlquilerException("El estado al que quiere cambiar ya esta");
            }else{
                $this->estado = EstadoAlquiler::Activo;
            }
        }

        public function finalizar():void{
            if($this->estado === EstadoAlquiler::Finalizado){
                throw new AlquilerException("El estado al que quiere cambiar, ya lo tiene");
            }else{
                $this->estado = EstadoAlquiler::Finalizado;
            }
        }
    }
?>