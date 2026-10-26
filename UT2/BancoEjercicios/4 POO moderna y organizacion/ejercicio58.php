<?php
    enum EstadoEjemplar: string {
        case Disponible = 'disponible';
        case Prestado = 'prestado';
        case Perdido = 'perdido';
    }

    class Ejemplar {
        private string $codigo;
        private EstadoEjemplar $estado;

        public function __construct(string $codigo, EstadoEjemplar $estado = EstadoEjemplar::Disponible) {
            $this->codigo = $codigo;
            $this->estado = $estado;
        }

        public function codigo(): string {
            return $this->codigo;
        }

        public function estado(): EstadoEjemplar {
            return $this->estado;
        }

        public function prestar(): void {
            if ($this->estado !== EstadoEjemplar::Disponible) {
                throw new LogicException("Solo se puede prestar un ejemplar disponible");
            }
            $this->estado = EstadoEjemplar::Prestado;
        }

        public function devolver(): void {
            if ($this->estado !== EstadoEjemplar::Prestado) {
                throw new LogicException("Solo se puede devolver un ejemplar prestado");
            }
            $this->estado = EstadoEjemplar::Disponible;
        }

        public function marcarPerdido(): void {
            if ($this->estado === EstadoEjemplar::Perdido) {
                throw new LogicException("El ejemplar ya está marcado como perdido");
            }
            $this->estado = EstadoEjemplar::Perdido;
        }
    }

    $e1 = new Ejemplar('E-01');

    // Secuencia de operaciones: prestar, devolver, prestar, marcarPerdido
    $e1->prestar();
    echo "{$e1->codigo()}: {$e1->estado()->value}<br>";

    $e1->devolver();
    echo "{$e1->codigo()}: {$e1->estado()->value}<br>";

    $e1->prestar();
    echo "{$e1->codigo()}: {$e1->estado()->value}<br>";

    $e1->marcarPerdido();
    echo "{$e1->codigo()}: {$e1->estado()->value}<br><br>";

    // Intentar devolver E-01 (ya esta perdido)
    try {
        $e1->devolver();
    } catch (LogicException $e) {
        echo "Rechazo al devolver {$e1->codigo()}: " . $e->getMessage() . "<br>";
    }

    // Crear E-02 disponible e intentar devolverlo antes de prestarlo
    $e2 = new Ejemplar('E-02');
    try {
        $e2->devolver();
    } catch (LogicException $e) {
        echo "Rechazo al devolver {$e2->codigo()}: " . $e->getMessage() . "<br>";
    }

    echo "<br>Estado final de {$e1->codigo()}: {$e1->estado()->value}<br>";
    echo "Estado final de {$e2->codigo()}: {$e2->estado()->value}<br>";
?>
