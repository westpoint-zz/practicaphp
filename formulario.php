<?php
// Inicializar variables y errores
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (empty($_POST["name"])) {
        $nameErr = "El nombre es obligatorio.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Validar correo electrónico
    if (empty($_POST["email"])) {
        $emailErr = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Formato de correo electrónico no válido.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Validar contraseña
    if (empty($_POST["password"])) {
        $passwordErr = "La contraseña es obligatoria.";
    } elseif (strlen($_POST["password"]) < 6) {
        $passwordErr = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = htmlspecialchars(trim($_POST["password"]));
    }

    // Si no hay errores, se puede procesar el registro
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        // Aquí iría el código para guardar en la base de datos, etc.
        $successMessage = "Registro exitoso.";
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

<?php
if (!empty($successMessage)) {
    echo "<p style='color:green;'>$successMessage</p>";
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Nombre:</label>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color:red;"><?php echo $nameErr; ?></span><br><br>

    <label for="email">Correo Electrónico:</label>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color:red;"><?php echo $emailErr; ?></span><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password">
    <span style="color:red;"><?php echo $passwordErr; ?></span><br><br>

    <input type="submit" value="Registrar">
</form>

</body>
</html>