<?php
    trait TieneFechaCreacion {
        private string $fechaCreacion;

        private function inicializarFechaCreacion(string $fecha): void {
            $this->fechaCreacion = $fecha;
        }

        public function fechaCreacion(): string {
            return $this->fechaCreacion;
        }

        public function etiquetaCreacion(): string {
            return "Creado el " . $this->fechaCreacion;
        }
    }

    class Libro {
        use TieneFechaCreacion;

        private string $titulo;

        public function __construct(string $titulo, string $fecha) {
            $this->titulo = $titulo;
            $this->inicializarFechaCreacion($fecha);
        }

        public function titulo(): string {
            return $this->titulo;
        }
    }

    class Socio {
        use TieneFechaCreacion;

        private string $nombre;

        public function __construct(string $nombre, string $fecha) {
            $this->nombre = $nombre;
            $this->inicializarFechaCreacion($fecha);
        }

        public function nombre(): string {
            return $this->nombre;
        }
    }

    $dune = new Libro('Dune', '2026-10-01');
    $solaris = new Libro('Solaris', '2026-10-02');
    $socia = new Socio('Ana', '2026-10-03');

    echo "Dato: {$dune->titulo()} | Fecha: {$dune->fechaCreacion()}<br>";
    echo "Dato: {$solaris->titulo()} | Fecha: {$solaris->fechaCreacion()}<br>";
    echo "Dato: {$socia->nombre()} | Fecha: {$socia->fechaCreacion()}<br><br>";

    // Mostrar etiquetas de creacion desde el trait
    echo $dune->etiquetaCreacion() . "<br>";
    echo $solaris->etiquetaCreacion() . "<br>";
    echo $socia->etiquetaCreacion() . "<br>";
?>
