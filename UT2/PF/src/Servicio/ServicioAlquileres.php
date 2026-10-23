<?php
    namespace Clase\Alquileres\Servicio;

    use Clase\Alquileres\Modelo\EstadoAlquiler;
    use Clase\Alquileres\Modelo\Alquiler;

    class ServicioAlquileres{
        private array $alquileres;

        public function normalizar(string $texto):string{
            return mb_strtolower(trim($texto), "UTF-8");
        }

        public function __construct(array $alquileres){
            $this->alquileres[] = $alquileres;
        }

        public function todos():array{
            return $this->alquileres;
        }

        public function consultar(string $texto = "", ?EstadoAlquiler $estado = null):array{
            $filtrados = array_filter(
                $this->alquileres,
                fn(Alquiler $a):bool=>
                    (str_contains($this->normalizar($a->cliente()) ?: null, $this->normalizar($texto)) 
                    && ($a->estado() === $estado))
                );

            return $filtrados;
        }

        public function resumir(array $alquileres):array{
            return array_reduce(
                $alquileres,
                function(array $carry, Alquiler $a): array{ 
                    $carry["cantidad"] += 1;
                    $carry["importe"] += $a->importe();
                    return $carry;
                },
                ["cantidad", "importe"]
            );
        }

    }
?>