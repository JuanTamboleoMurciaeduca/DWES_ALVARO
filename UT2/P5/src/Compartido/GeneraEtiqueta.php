<?php
declare(strict_types=1);

// TODO M3. Declara el trait GeneraEtiqueta y su método etiqueta.
trait GeneraEtiqueta{
    function etiqueta(string $prefijo=""):string{
        return $prefijo . $this->id . " · " . mb_strtolower(trim($this->nombre()), "UTF-8");
    }
}