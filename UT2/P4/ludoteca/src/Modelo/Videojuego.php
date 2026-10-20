<?php
declare(strict_types=1);

// TODO M6. Especializa Videojuego con su constructor, plazo y ficha.
class Videojuego extends Juego{
    private string $plataforma;

    #[Override]
    public function __construct(int $id, string $nombre, string $plataforma)
    {
        return parent::__construct($id, $nombre);

        if(trim($this->plataforma) === ""){
            throw new InvalidArgumentException("Plataforma vacia");
        }
    }

    public function plataforma():string{
        return $this->plataforma;
    }

    public function plazoMaximo(): int{
        return 7;
    }

    #[Override]
    public function ficha(): string
    {
        return parent::ficha() . ' · Plataforma: ' . $this->plataforma;
    }

    
}