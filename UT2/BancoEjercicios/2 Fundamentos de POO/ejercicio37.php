<?php
    final class Libro{
        public function __construct(
            public string $titulo,
            public int $paginas,
        ) {
            if (trim($titulo) === '' || $paginas <= 0) {
                throw new InvalidArgumentException("Titulo vacio o paginas no validas");
            }
        }
    }

    // Caso valido:
    $libro1 = new Libro('Dune', 412);
    print_r($libro1);

    // Casos invalidos (se prueban por separado para no detener el script):
    // $invalido1 = new Libro(' ', 100);
    // $invalido2 = new Libro('Solaris', 0);
    // $invalido3 = new Libro('Solaris', -5);

    // Cuando el constructor lanza una excepcion, new NO entrega ningun objeto ya que la construccion falla.
    // Validar al construir asegura que el objeto nace en un estado valido (estado inicial), 
    // pero como $paginas es una propiedad publica, otro codigo podria asignarle 0 mas tarde ($libro1->paginas = 0).
    // Para controlar todos los cambios posteriores se necesitarian propiedades privadas y metodos modificadores o readonly.
?>