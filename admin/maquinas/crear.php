<?php
    //base de datos
    require '../../includes/config/database.php';
    $db = conectarDb();

    // consultar para obtener las categorias productos
    $consulta = "SELECT * FROM ejercicios";
    $resultado = mysqli_query($db, $consulta);


    // Arreglo con mensaje de errorres
    $errores = [];

    $titulo = '';
    $ejercicioId = '';

    // ejecurtar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $ejercicioId = mysqli_real_escape_string( $db, $_POST['categoria'] );

        // asignar files hacia una variable
        $imagen = $_FILES['imagen'];
        
        if(!$titulo){
            $errores[] = "Nome da Maquiina é Obligatorio";
        }
        if(!$ejercicioId){
            $errores[] = "Todas as Maquinas tem a sua Categoria";
        }
        if(!$imagen['name'] || $imagen['error']){
            $errores[] = 'La Imagen es Obligatoria';
        }

        //validar por tamaño (3mb de tamaño imagen)
        $medida = 1000 * 3000;

        if($imagen['size'] > $medida){
            $errores[] = 'La imagen es muy pesada';
        } 

        //revisar quel el array de errores este vacio
        if(empty($errores)){

            /** Subida de Archivos **/

            //crear una carpeta
            $carpetaImagenes = '../../imagenes';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            exit;

            //insertare en la base de datos
            $query = " INSERT INTO maquinas (titulo, ejercicioId ) VALUES ( '$titulo', '$ejercicioId' ) ";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                // redireccionar al usuario despues de crear producto
                header('Location: /admin');
            } 
        }

    }

    $navEffect = true;
    $inicio =false;
    require '../../includes/funciones.php';
    include '../../includes/templates/header.php' 
?>


    <main class="contenedor seccion">
        <h1>--Criar--</h1>

        <a href="/admin/" class="boton boton-verde">Voltar</a>

        <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/maquinas/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacao da Maquina</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Producto" value="<?php echo $titulo; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen">

            </fieldset>

            <fieldset>
                <legend>Categoria Exercicio</legend>

                <select name="categoria">
                    <option value="">--Escolher--</option>
                    <?php while($row = mysqli_fetch_assoc($resultado) ) : ?>

                        <option <?php echo $ejercicioId === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"> <?php echo $row['categoria']; ?></option>

                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Producto" class="boton boton-verde">

        </form>
    </main>


<?php
    incluirTemplate('footer');
?>