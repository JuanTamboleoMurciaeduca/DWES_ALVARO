<?php
    namespace Clase\Alquileres\Modelo;

    use Override;

    class AlquilerBicicleta extends Alquiler{
        #[Override]
        public function modalidad(): string
        {
            return "bicicleta";
        }

        #[Override]
        protected function tarifaDiaria(): int
        {
            return 500;
        }
    }
?>