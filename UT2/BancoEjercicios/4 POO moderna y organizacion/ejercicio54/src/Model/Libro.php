<?php
namespace App\Model;

class Libro extends Recurso {
    public function tipo(): string {
        return 'libro';
    }
}
