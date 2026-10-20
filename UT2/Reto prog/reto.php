<?php
    $stock = ['A'=>5, 'B'=>3, 'C'=>0]; 
$pedidos = [ 
    ['id'=>101, 'lineas'=>[['A',2], ['B',1]]], 
    ['id'=>102, 'lineas'=>[['A',2], ['B',1], ['A',2]]], 
    ['id'=>103, 'lineas'=>[['A',1], ['B',2]]], 
    ['id'=>104, 'lineas'=>[['C',1]]], 
    ['id'=>105, 'lineas'=>[['A',2]]], 
    ['id'=>106, 'lineas'=>[['D',1]]], 
];

    $prueba[] = procesarPedidos($stock, $pedidos);
    print_r($prueba);

    /* PRUEBA DE IMPRESION HECHA POR IA*/
    // Recorremos cada pedido
    foreach ($prueba as $pedido) {


        // Recorremos la demanda (array asociativo 'producto' => cantidad)
        foreach ($pedido as $producto => $cantidad) {
            
            echo "id $producto:\n";
        }
    }
    echo "========================================\n";

    function procesarPedidos(array $stock, array $pedidos){
        $resultado = array_map(
            fn(array $a):array=>
                ["id" => $a["id"],
                "lineas" => array_reduce(
                    $a["lineas"],
                    function(array $acumulador, array $b):array{
                        [$prod, $cantidad] = $b;
                        $acumulador[$prod] = ($acumulador[$prod] ?? 0) + $cantidad;
                        return $acumulador;
                    },
                    []
                ),
                ],
            $pedidos,
        );

        return array_reduce($resultado,
        ...
        , ['aceptados' => [], 'rechazados' => [], 'stock' => $stock]
        );
    }
?>