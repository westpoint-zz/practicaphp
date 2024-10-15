<?php
// Inicializar variables
$name = "";
$email = "";
$password = "";
$errors = [];

// Comprobar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if ($_POST["name"] == "") {
        $errors['name'] = "El nombre es obligatorio.";
    } else {
        $name = $_POST["name"]; // Falta htmlspecialchars
    }

    // Validar correo electrónico
    if ($_POST["email"] == "") {
        $errors['email'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Formato de correo electrónico no válido.";
    } else {
        $email = $_POST["email"]; // Falta htmlspecialchars
    }

    // Validar contraseña
    if ($_POST["password"] == "") {
        $errors['password'] = "La contraseña es obligatoria.";
    } elseif (strlen($_POST["password"]) < 6) {
        $errors['password'] = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = $_POST["password"]; // Falta htmlspecialchars
    }

    // Guardar en la base de datos (falta código de conexión)
    if (count($errors) == 0) {
        // Simulación de registro
        echo "Registro exitoso.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>

<h2>Formulario de Registro</h2>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="name">Nombre:</label>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color:red;"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span><br><br>

    <label for="email">Correo Electrónico:</label>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color:red;"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password">
    <span style="color:red;"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span><br><br>

    <input type="submit" value="Registrar">
</form>

</body>
</html>