<?php
declare(strict_types=1);

// TODO M5. Especializa JuegoMesa con su constructor, plazo y ficha.
class JuegoMesa extends Juego{
    private int $jugadores;

    public function __construct(int $id,string $nombre, int $jugadores){
        parent::__construct($id,$nombre);

        if($this->jugadores <=0){
            throw new InvalidArgumentException("Los jugadores no pueden ser 0 o menos");
        }
    }

    public function jugadores(): int
    {
        return $this->jugadores;
    }

    public function plazoMaximo(): int
    {
        return 14;
    }

    #[Override]
    public function ficha(): string
    {
        return parent::ficha() . ' · Jugadores: ' . $this->jugadores;
    }
}