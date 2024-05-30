<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Validar que las contraseñas coincidan
    if ($contrasena !== $confirmar_contrasena) {
        echo "Error: Las contraseñas no coinciden.";
        exit(); // Detener la ejecución del script si las contraseñas no coinciden
    }

    // Aquí puedes realizar cualquier otra validación necesaria

    // Guardar los datos en la base de datos o hacer cualquier otra acción necesaria
    // Por ejemplo, podrías usar la función mail() para enviar un correo de confirmación al usuario

    // Redirigir al usuario a una página de confirmación
    header("Location: confirmacion_registro.html");
    exit();
} else {
    // Si no se envió el formulario, mostrar un mensaje de error
    echo "Error: El formulario no ha sido enviado correctamente.";
}
?>
