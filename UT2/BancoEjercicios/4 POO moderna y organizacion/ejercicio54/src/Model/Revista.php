<?php
namespace App\Model;

class Revista extends Recurso {
    public function tipo(): string {
        return 'revista';
    }
}
