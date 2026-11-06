<?php

use App\Model\Libro;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

    final class LibroTest extends TestCase{
        public function testConservaLibro():void{
            $libro = new Libro("dune", "frank herbert", 412);

            assertSame("dune", $libro->titulo());
        }

        //+
        public function testDisponible():void{
            $libro = new Libro("dune", "frank herbert", 412);
            $libro->prestar();
            assertTrue($libro->estaDisponible());
            
            assertSame($libro->paginas(), "412");
            assertEquals($libro->paginas(), "412");

            assertSame("Solaris", $libro->titulo());
        }

        // Ejercicio 24
        public function testPrestar() : void {
            
        }
    }
?>