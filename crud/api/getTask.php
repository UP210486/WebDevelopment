<?php
// Verifica si se proporcionó un ID de tarea
if (isset($_GET["task_id"])) {
    // Obtiene el ID de la tarea
    $task_id = $_GET["task_id"];

    // Conecta a la base de datos (ya deberías tener esta parte)
    require_once("connection.php");

    // Prepara la consulta para obtener los detalles de la tarea
    $query = "SELECT * FROM tasks WHERE id = :task_id";
    $statement = $conn->prepare($query);

    // Asigna el valor del ID de la tarea y ejecuta la consulta
    $statement->bindParam(":task_id", $task_id);
    $statement->execute();

    // Obtiene y devuelve los detalles de la tarea en formato JSON
    $task = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($task);
} else {
    // Si no se proporcionó un ID de tarea, devuelve un mensaje de error
    echo json_encode(["error" => "ID de tarea no proporcionado"]);
}
?>
