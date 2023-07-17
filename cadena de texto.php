<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contador de palabras clave</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333333;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 5px;
            max-width: 500px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333333;
        }

        input[type="text"],
        input[type="submit"] {
            display: block;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        p {
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 5px;
            max-width: 500px;
            text-align: center;
        }

        .highlight {
            background-color: yellow;
            font-weight: bold;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Contador de palabras clave</h1>
    <form method="POST">
        <label for="frase">Ingrese una frase:</label>
        <input type="text" id="frase" name="frase"><br>
        <label for="palabra">Ingrese la palabra clave a buscar:</label>
        <input type="text" id="palabra" name="palabra"><br>
        <input type="submit" name="submit" value="Contar">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        if (empty($_POST["frase"])) {
            echo "<p class='error'>Por favor, ingrese una frase.</p>";
        } elseif (empty($_POST["palabra"])) {
            echo "<p class='error'>Por favor, ingrese una palabra clave.</p>";
        } else {
            $frase = $_POST["frase"];
            $palabra_clave = $_POST["palabra"];
            $contador = 0;
            $palabras = str_word_count($frase, 1);
            foreach ($palabras as $palabra) {
                if (strtolower($palabra) == strtolower($palabra_clave)) {
                    $contador++;
                }
            }
            if ($contador == 0) {
                echo "<p>No se encontró la palabra clave en la frase.</p>";
            } else {
                $frase_resaltada = str_ireplace($palabra_clave, "<span class='highlight'>$palabra_clave</span>", $frase);
                echo "<p>La palabra clave aparece $contador veces en la frase:</p>";
                echo "<p>$frase_resaltada</p>";
            }
        }
    }
    ?>
</body>
</html>