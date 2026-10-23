<?php
    namespace App\contrato;

    use App\modelo\Envio;

    interface RepositorioEnvios{
        public function registrar(Envio $envio):void;
        public function todos():array;
        public function buscar(int $id):?Envio;
    }

?>