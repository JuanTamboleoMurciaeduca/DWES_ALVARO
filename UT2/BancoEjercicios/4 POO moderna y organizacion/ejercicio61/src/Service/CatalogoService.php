<?php
namespace App\Service;

use App\Contract\LibroRepository;
use App\Model\Libro;
use InvalidArgumentException;

class CatalogoService {
    public function __construct(private LibroRepository $repositorio) {}

    public function prestarPorId(int $id): void {
        $libro = $this->repositorio->buscarPorId($id);
        if ($libro === null) {
            throw new InvalidArgumentException("No se encontró el libro con ID $id");
        }
        $libro->prestar();
    }

    public function devolverPorId(int $id): void {
        $libro = $this->repositorio->buscarPorId($id);
        if ($libro === null) {
            throw new InvalidArgumentException("No se encontró el libro con ID $id");
        }
        $libro->devolver();
    }

    /**
     * @return Libro[]
     */
    public function buscarDisponibles(string $texto, int $maximo): array {
        if ($maximo < 1) {
            throw new InvalidArgumentException("El número máximo de páginas debe ser al menos 1");
        }

        $textoNormalizado = mb_strtolower(trim($texto), 'UTF-8');

        $disponibles = array_filter(
            $this->repositorio->todos(),
            function (Libro $libro) use ($textoNormalizado, $maximo): bool {
                if (!$libro->estaDisponible()) {
                    return false;
                }
                if ($libro->paginas() > $maximo) {
                    return false;
                }
                if ($textoNormalizado === '') {
                    return true;
                }
                return str_contains(mb_strtolower($libro->titulo(), 'UTF-8'), $textoNormalizado);
            }
        );

        $resultado = array_values($disponibles);

        usort($resultado, fn(Libro $a, Libro $b): int => $a->paginas() <=> $b->paginas());

        return $resultado;
    }
}
