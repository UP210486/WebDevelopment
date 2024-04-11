<?php
// Verifica si la solicitud es de tipo POST y si se proporcionó un ID de tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"])) {
    // Obtiene los datos del formulario
    $task_id = $_POST["task_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $user_id = $_POST["user_id"]; // Asegúrate de que esto sea correcto, podría ser diferente dependiendo de cómo manejes los usuarios en tu aplicación

    // Conecta a la base de datos (ya deberías tener esta parte)
    require_once("connection.php");

    // Prepara la consulta para actualizar la tarea
    $query = "UPDATE tasks SET title = :title, description = :description, user_id = :user_id WHERE id = :task_id";
    $statement = $conn->prepare($query);

    // Asigna los valores y ejecuta la consulta
    $statement->bindParam(":task_id", $task_id);
    $statement->bindParam(":title", $title);
    $statement->bindParam(":description", $description);
    $statement->bindParam(":user_id", $user_id);
    $statement->execute();

    // Redirige a la página principal o muestra un mensaje de éxito
    header("Location: index.html");
    exit();
} else {
    // Si la solicitud no es de tipo POST o si no se proporcionó un ID de tarea, redirige a la página principal
    header("Location: index.html");
    exit();
}
?>
