<?php
  // unset($_COOKIE['contador']);
    if (isset($_COOKIE['contador'])) {
        setcookie('contador', $_COOKIE['contador'] + 1, time()+ 90*24*60*60);
        $salida = "Has visitado mi página: " . $_COOKIE['contador']. ' veces';

        if ($_COOKIE['contador'] > 5 and $_COOKIE['contador'] < 10) {
            $salida = $salida . '<br>' . 'Gracias por visitar la página varias veces';
        }

        if ($_COOKIE['contador'] >= 10) {
            $salida = "Has visitado mi página: " . $_COOKIE['contador']. ' veces <br>' . 'Felicidades, eres un visitante frecuente';
        }

    } else {
        setcookie('contador', 1, time() + 90*24*60*60);
        $salida = "Bienvenido a mi página";
    }
?>

<!DOCTYPE html>
 <html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width = device-width, initial-scale=1.0">
        <title>Palabras Reservadas PHP</title>
        <script src="acciones_Pr.js"></script>
        <link rel="stylesheet" href="estilos.css">

        <?php

            $ruta = "DefinicionesR.txt";
            $ruta2 = "PalabrasR.txt";

            $dato = file($ruta2);
            $dato2 = file($ruta);
            for ($i = 0; $i < sizeof($dato); $i++) {
                $dato[$i] = preg_replace("[\n|\r|\n\r]","", $dato[$i]);
            }

            for ($i = 0; $i < sizeof($dato2); $i++) {
                $dato2[$i] = preg_replace("[\n|\r|\n\r]","", $dato2[$i]);
            }

            $diccionario = array($dato[0] => $dato2[0]);

            for ($i = 1; $i < sizeof($dato2); $i++) {
                $diccionario[$dato[$i]] = $dato2[$i];
            }

            ksort($diccionario);

            $array = json_encode($dato);
            $array2 = json_encode($dato2);
            $array3 = json_encode($diccionario);    
            
            ?>     
    </head>

    <header id="heead_R">
        Palabras Reservadas PHP
        <?php
            echo '<br>'. $salida;
        ?>
        <section id="secc_principal">
            <ul>
            <li>
                |<a href="index.html">Página Principal</a>|
            </li>
        </ul>
        </section>
    </header>
    <body onload='cargar(<?php echo $array3; ?>)' id="contenedor_padre">

        <?php
                
            if (isset($_GET['palabra']) and isset($_GET['definicion'])) {
                if (array_key_exists($_GET['palabra'], $diccionario)) {

                    $diccionario[$_GET['palabra']] = $_GET['definicion'];
                    $dato2 = array_values($diccionario);
                    $dato = array_keys($diccionario);


                    $archivo2 = fopen($ruta, "w");
                    $archivo = fopen($ruta2, "w");

                    fwrite($archivo2, $dato2[0].PHP_EOL);
                    fwrite($archivo, $dato[0].PHP_EOL);

                    fclose($archivo2);
                    fclose($archivo);

                    $archivo2 = fopen($ruta, "a");
                    $archivo = fopen($ruta2, "a");
                   
                    for ($i = 1; $i < sizeof($dato2); $i++) {
                        fwrite($archivo2, $dato2[$i].PHP_EOL);
                        fwrite($archivo, $dato[$i].PHP_EOL);
                    }

                   fclose($archivo2);
                   fclose($archivo);
                } else {
                    $archivo = fopen($ruta2, "a");
                    $archivo2 = fopen($ruta, "a");

                    fwrite($archivo2, $_GET['definicion'].PHP_EOL);
                    fwrite($archivo, $_GET['palabra'].PHP_EOL);

                    fclose($archivo);
                    fclose($archivo2);
                }
            }

            if (isset($_GET['eliminar'])) {
                if (array_key_exists($_GET['eliminar'], $diccionario)) {
                    $indice = array_search($_GET['eliminar'], array_keys($diccionario));
                   // echo $indice;
                    unset($diccionario[$_GET['eliminar']]);
                  //  unset($dato2[$indice]);
                    $dato11 = array_keys($diccionario);
                    $dato22 = array_values($diccionario);

                    $archivo = fopen($ruta2, "w");
                    $archivo2 = fopen($ruta, "w");

                    fclose($archivo);
                    fclose($archivo2);

                    $archivo = fopen($ruta2, "a");
                    $archivo2 = fopen($ruta, "a");

                    for ($i = 0; $i < sizeof($dato11); $i++) {                        
                        fwrite($archivo2, $dato22[$i].PHP_EOL);
                        fwrite($archivo, $dato11[$i].PHP_EOL);
                    }

                    fclose($archivo);
                    fclose($archivo2);
                }
               
            }
        ?>      
    </body>

    <aside>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" id="form_agregar">
            <fieldset>
                <legend>Agregar o modificar elemento</legend>
                <input type="text" name="palabra" id="palabra_agregar" placeholder="Agregue su palabra" onkeyup="validarDatos()">
                <p>               
                <textarea name="definicion" id="definicion_agregar" cols="30" rows="10" placeholder="Agregue su definición" onkeyup="validarDatos()" onkeypress="cancelar()"></textarea>
                <p></p>
                <input type="submit" value= "Agregar" disabled id="boton_enviar" class="boton">    
            </fieldset>          
        </form>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" id="form_eliminar">
        <fieldset>
            <legend>Eliminar elemento</legend>
            <input type="text" name='eliminar' id="palabra_eliminar" placeholder="Elimine su palabra" onkeyup="validarDato()">
            <p></p>
            <input type="submit" value="Eliminar" id="btn_eliminar" disabled class="boton">
        </fieldset>     
        </form>
    </aside>
 </html>