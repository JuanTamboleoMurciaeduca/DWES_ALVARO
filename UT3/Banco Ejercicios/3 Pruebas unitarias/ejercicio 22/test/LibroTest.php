<?php

use App\Model\Libro;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

    final class LibroTest extends TestCase{
        public function testConservaLibro():void{
            $libro = new Libro("dune", "frank herbert", 412);

            assertSame("dune", $libro->titulo());
        }
    }
?>