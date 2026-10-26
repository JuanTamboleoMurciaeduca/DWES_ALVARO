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

        public function cambiarEstado(EstadoEjemplar $estado): void {
            $this->estado = $estado;
        }
    }

    $e1 = new Ejemplar('E-01', EstadoEjemplar::Disponible);
    $e2 = new Ejemplar('E-02', EstadoEjemplar::Prestado);
    $e3 = new Ejemplar('E-03', EstadoEjemplar::Perdido);

    $ejemplares = [$e1, $e2, $e3];

    echo "--- Listado de ejemplares ---<br>";
    foreach ($ejemplares as $e) {
        echo "Codigo: {$e->codigo()} | Name: {$e->estado()->name} | Value: {$e->estado()->value}<br>";
    }

    // Filtrar disponibles
    $disponibles = array_filter($ejemplares, fn(Ejemplar $e): bool => $e->estado() === EstadoEjemplar::Disponible);
    echo "<br>--- Disponibles ---<br>";
    foreach ($disponibles as $d) {
        echo $d->codigo() . "<br>";
    }

    // Procesar cadenas: prestado, perdido y reservado para E-01
    echo "<br>--- Procesando cambios de estado en E-01 ---<br>";
    $entradas = ['prestado', 'perdido', 'reservado'];
    foreach ($entradas as $entrada) {
        $nuevoEstado = EstadoEjemplar::tryFrom($entrada);
        if ($nuevoEstado === null) {
            echo "Entrada '$entrada': Estado no válido<br>";
        } else {
            $e1->cambiarEstado($nuevoEstado);
        }
        echo "Estado actual de {$e1->codigo()}: {$e1->estado()->value}<br>";
    }

    // Recorrer casos de enum y calcular recuento
    echo "<br>--- Valores admitidos y conteo ---<br>";
    foreach (EstadoEjemplar::cases() as $case) {
        $conteo = count(array_filter($ejemplares, fn(Ejemplar $e): bool => $e->estado() === $case));
        echo "Estado {$case->value}: $conteo ejemplares<br>";
    }
?>
