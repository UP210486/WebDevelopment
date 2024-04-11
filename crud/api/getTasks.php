<?php
// Conecta a la base de datos (ya deberías tener esta parte)
require_once("connection.php");

// Prepara la consulta para obtener todas las tareas
$query = "SELECT * FROM tasks";
$statement = $conn->query($query);

// Obtiene todas las tareas y las devuelve en formato JSON
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($tasks);
?>
