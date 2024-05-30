<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombres = $_POST['nombres'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $fecha_solicitud = $_POST['fecha_solicitud'];
    $tipo_servicio = $_POST['tipo_servicio'];
    $comentario = $_POST['comentario'];

    // Guardar los datos en la base de datos
    $host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="llantas_nissi"; // Cambiar por el nombre de tu base de datos

    // Crear una conexión con la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO formulario (nombres, direccion, correo, telefono, fecha_solicitud, tipo_servicio, comentario)
            VALUES ('$nombres', '$direccion', '$correo', '$telefono', '$fecha_solicitud', '$tipo_servicio', '$comentario')";

    // Ejecutar la consulta SQL y verificar si se realizó con éxito
    if ($conn->query($sql) === TRUE) {
        // Si los datos se guardaron correctamente, enviar el correo electrónico
        enviarCorreo($nombres, $direccion, $correo, $telefono, $fecha_solicitud, $tipo_servicio, $comentario);
        echo "¡El formulario se ha enviado correctamente!";
    } else {
        echo "Error al enviar el formulario: " . $conn->error;
    }

    // Cerrar la conexión con la base de datos
    $conn->close();
} else {
    // Si no se envió el formulario, mostrar un mensaje de error
    echo "Error: El formulario no ha sido enviado correctamente.";
}

// Función para enviar el correo electrónico
function enviarCorreo($nombres, $direccion, $correo, $telefono, $fecha_solicitud, $tipo_servicio, $comentario) {
    // Configurar PHPMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kaisehun9412@gmail.com'; // Cambiar por tu dirección de correo Gmail
    $mail->Password = 'Mariafernanda1999'; // Cambiar por tu contraseña de Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurar el correo electrónico
    $mail->setFrom('kaisehun9412@gmail.com', 'PENDIENTES');
    $mail->addAddress('kaisehun9412@gmail.com'); // Cambiar por la dirección de correo del destinatario
    $mail->Subject = 'Nuevo formulario de solicitud';
    $mail->Body = "Nombres: $nombres\nDirección: $direccion\nCorreo: $correo\nTeléfono: $telefono\nFecha de Solicitud: $fecha_solicitud\nTipo de Servicio: $tipo_servicio\nComentario: $comentario";

    // Enviar el correo electrónico
    $mail->send();
}
?>
