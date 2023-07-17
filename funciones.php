<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buscar parejas de números amigos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        label {
            margin-bottom: 10px;
        }
        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        button[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }
        .mensaje {
            margin-top: 20px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f2f2f2;
        }
        .mensaje.error {
            border-color: #f44336;
            background-color: #ffebee;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buscar parejas de números amigos</h1>
        <?php
        // Función para calcular la suma de los divisores propios de un número
        function suma_divisores_propios($numero) {
            $suma = 0;
            for ($i = 1; $i < $numero; $i++) {
                if ($numero % $i == 0) {
                    $suma += $i;
                }
            }
            return $suma;
        }

        // Función para encontrar las parejas de números amigos menores o iguales que m
        function encontrar_parejas_amigos($m) {
            $encontrado = false;
            $parejas_amigos = '';
            for ($n = 1; $n <= $m; $n++) {
                $suma_divisores_n = suma_divisores_propios($n);
                for ($m2 = $n + 1; $m2 <= $m; $m2++) {
                    $suma_divisores_m2 = suma_divisores_propios($m2);
                    if ($suma_divisores_m2 == $n && $suma_divisores_n == $m2) {
                        $parejas_amigos .= "$n y $m2 son números amigos.<br>";
                        $encontrado = true;
                    }
                }
            }
            if (!$encontrado) {
                $parejas_amigos = "No se encontraron parejas de números amigos menores o iguales que $m.";
                $clase_mensaje = 'error';
            } else {
                $clase_mensaje = '';
            }
            return "<div class='mensaje $clase_mensaje'>$parejas_amigos</div>";
        }

        // Verificar si se ha enviado el formulario
        if (isset($_POST['enviar'])) {
            // Obtener el valor de m desde la entrada de datos
            $m = (int) $_POST['m'];
            // Buscar parejas de números amigos
            $resultado = encontrar_parejas_amigos($m);
        } else {
            $resultado = '';
        }
        ?>
        <form method="post">
            <label for="m">Ingrese un número:</label>
            <input type="number" name="m" id="m" required>
            <button type="submit" name="enviar">Buscar parejas de números amigos</button>
        </form>
        <?php echo $resultado; ?>
    </div>
</body>
</html>