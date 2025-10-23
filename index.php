<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Turismo Brasil </title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 30px; }
        h2 { background: #079300ff; color: white; padding: 10px; border-radius: 5px; }
        form { background: white; padding: 15px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 0 5px #ccc; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type=submit] { background: #e1e801ff; color: white; border: none; cursor: pointer; }
        input[type=submit]:hover { background:#11fa05ff; }
    </style>
</head>
<body>

<h1>Turismo Brasil</h1>

<h2>Agregar Usuario</h2>
<form method="POST" action="">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="text" name="telefono" placeholder="Teléfono">
    <input type="email" name="email" placeholder="Correo electrónico">
    <input type="text" name="ciudad_origen" placeholder="Ciudad de origen">
    <input type="submit" name="guardar_usuario" value="Guardar Usuario">
</form>

<h2>Agregar Lugar</h2>
<form method="POST" action="">
    <input type="text" name="nombre_lugar" placeholder="Nombre del lugar" required>
    <input type="text" name="estado" placeholder="Estado" required>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <input type="text" name="categoria" placeholder="Categoría (Natural, Cultural, etc.)">
    <input type="submit" name="guardar_lugar" value="Guardar Lugar">
</form>

<?php
$usuarios = $conn->query("SELECT id_usuario, nombre FROM usuario");
$lugares = $conn->query("SELECT id_lugar, nombre_lugar FROM lugar");
?>

<h2>Agregar Recomendación</h2>
<form method="POST" action="">
    <label>Usuario:</label>
    <select name="id_usuario" required>
        <option value="">-- Seleccione un usuario --</option>
        <?php while($u = $usuarios->fetch_assoc()) echo "<option value='{$u['id_usuario']}'>{$u['nombre']}</option>"; ?>
    </select>

    <label>Lugar:</label>
    <select name="id_lugar" required>
        <option value="">-- Seleccione un lugar --</option>
        <?php 
        $lugares->data_seek(0);
        while($l = $lugares->fetch_assoc()) echo "<option value='{$l['id_lugar']}'>{$l['nombre_lugar']}</option>"; 
        ?>
    </select>

    <textarea name="motivo" placeholder="Motivo de recomendación"></textarea>
    <input type="submit" name="guardar_recomendacion" value="Guardar Recomendación">
</form>

<?php
if (isset($_POST['guardar_usuario'])) {
    $sql = "INSERT INTO usuario (nombre, telefono, email, ciudad_origen)
            VALUES ('{$_POST['nombre']}', '{$_POST['telefono']}', '{$_POST['email']}', '{$_POST['ciudad_origen']}')";
    echo $conn->query($sql) ? "<p>✅ Usuario agregado correctamente.</p>" : "<p>❌ Error: ".$conn->error."</p>";
}

if (isset($_POST['guardar_lugar'])) {
    $sql = "INSERT INTO lugar (nombre_lugar, estado, descripcion, categoria)
            VALUES ('{$_POST['nombre_lugar']}', '{$_POST['estado']}', '{$_POST['descripcion']}', '{$_POST['categoria']}')";
    echo $conn->query($sql) ? "<p>✅ Lugar agregado correctamente.</p>" : "<p>❌ Error: ".$conn->error."</p>";
}

if (isset($_POST['guardar_recomendacion'])) {
    $sql = "INSERT INTO recomendacion (id_usuario, id_lugar, motivo)
            VALUES ('{$_POST['id_usuario']}', '{$_POST['id_lugar']}', '{$_POST['motivo']}')";
    echo $conn->query($sql) ? "<p>✅ Recomendación agregada correctamente.</p>" : "<p>❌ Error: ".$conn->error."</p>";
}

$conn->close();
?>
</body>
</html>
