<?php
include_once('./conf/conex.php');

try {
    // Preparar la consulta
    $stmt = $pdo->prepare('SELECT code, nombre, existencia, fecharegistro, precio FROM medicamentos');

    // Ejecutar la consulta
    $stmt->execute();

    // Recuperar los resultados en un array 
    $medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error de base de datos: ' . $e->getMessage();
}

try{
    $stmt = $pdo->prepare('INSERT INTO medicamentos (code, nombre, existencia, fecharegistro, precio) VALUES (:code, :nombre, :existencia, :fecharegistro, :precio )');

    $code = 15;
    $nombre = 'Acetaminofen';
    $existencia = 100;
    $fecharegistro = '2023-09-19';
    $precio = 9.99;

    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':existencia', $existencia);
    $stmt->bindParam(':fecharegistro', $fecharegistro);
    $stmt->bindParam(':precio', $precio);

    $stmt->execute();

    echo 'Datos ingresados yei';
}catch(PDOException $e) {
    echo 'Error de base de datos: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Lista de Medicamentos</h1>
        <button type="button" class="btn btn-primary mb-3"><b>Agregar</b></button>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Fecha de Registro</th>
                        <th>Precio</th>
                    </tr>
                    <?php foreach ($medicamentos as $medicamento): ?>
                    <tr>
                        <td><?php echo $medicamento['code']; ?></td>
                        <td><?php echo $medicamento['nombre']; ?></td>
                        <td><?php echo $medicamento['existencia']; ?></td>
                        <td><?php echo $medicamento['fecharegistro']; ?></td>
                        <td><?php echo $medicamento['precio']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
</body>
</html>
