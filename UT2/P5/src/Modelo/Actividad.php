<?php
declare(strict_types=1);

// TODO M6. Implementa la clase abstracta Actividad, sus reglas y las operaciones final.
abstract class Actividad implements Reservable{
    use GeneraEtiqueta;

    public function __construct(private readonly int $id, private readonly string $nombre,
                                private readonly int $capacidad, private int $ocupadas,
                                private readonly EstadoActividad $estado, private readonly ?Responsable $responsable)
    {
        if($this->id <= 0 || trim($this->nombre) === "" || $this->capacidad <=0){
            throw new InvalidArgumentException("El id tiene que ser mayor que 0, el nombre esta vacio o la capacidad es menor a 0");
        }

        if($this->ocupadas <= 0 && $this->ocupadas >= $this->capacidad){
            throw new InvalidArgumentException("No puede haber mas o menos ocupado que de capaicidad");
        }

        if($this->estado !== "abierta" || $this->estado !== "cerrado"){
            throw new InvalidArgumentException("Esta caso no esta contemplado");
        }
        if($this->responsable !== null){
            throw new InvalidArgumentException("No es objeto o nulo");
        }
    }

    public function id():int{
        return $this->id;
    }

    public function nombre():string{
        return $this->nombre;
    }

    public function capacidad():int{
        return $this->capacidad;
    }

    public function ocupadas():int{
        return $this->ocupadas;
    }

    public function estado():EstadoActividad{
        return $this->estado;
    }

    public function responsable():Responsable{
        return $this->responsable;
    }

    #[Override]
    public function plazasLibres(): int{
        return $this->capacidad - $this->ocupadas;
    }

    public abstract function tipo():string;
    public abstract function importe(int $cantidad):int;

    #[Override]
    public final function reservar(int $cantidad): void{
        if($cantidad <= 0){
            throw new InvalidArgumentException("No puede ser 0 o menor");
        }

        if($this->estado::Cerrada){
            throw new ReservaException("Activa cerrada. Aforo al maximo");
        }

        if($this->capacidad === $this->ocupadas){
            throw new PlazasInsuficientesException("Activa cerrada. Aforo al maximo");
        }

        $this->ocupadas = $cantidad + $this->ocupadas;
    }

    #[Override]
    public function cancelar(int $cantidad): void{
        if($cantidad <= 0){
            throw new InvalidArgumentException("No puede ser 0 o menor");
        }

        if($cantidad > $this->ocupadas){
            throw new ReservaException("No se puede cancelar mas de lo ocupado");
        }

        if($cantidad < $this->ocupadas){
            $this->ocupadas = $this->ocupadas - $cantidad;
        }
    }
}