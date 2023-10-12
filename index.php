<?php
    include_once('assets/php/notas.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <h1 class="text-center">Bloc de Notas</h1>
        <div class="container">
            <div class="row">
                <h1 class="text-wrap text-success col col-sm-3 col-3">Notas</h1>
                <h1 class="text-wrap text-warning col col-sm-3 col-3 offset-sm-6 offset-5">Carpetas</h1>
                <button type="button" class="btn btn-primary btn-lg text-wrap col col-sm-3 col-3" data-bs-toggle="modal" data-bs-target="#crearNota">Crear Nota</button>
                <button type="button" class="btn btn-primary btn-lg text-wrap col col-sm-3 col-3 offset-sm-6 offset-6" data-bs-toggle="modal" data-bs-target="#crearCarpeta">Crear Carpeta</button>
                <button type="button" class="btn btn-danger btn-lg text-wrap col col-sm-3 col-3" data-bs-toggle="modal" data-bs-target="#borrarNota">Borrar Nota</button>
                <button type="button" class="btn btn-danger btn-lg text-wrap col col-sm-3 col-3 offset-sm-6 offset-6" data-bs-toggle="modal" data-bs-target="#borrarCarpeta">Borrar Carpeta</button>
                <button type="button" class="btn btn-primary btn-lg text-wrap col col-sm-3 col-3" data-bs-toggle="modal" data-bs-target="#moverNota">Mover Nota</button>
            </div>
        </div>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" id="crearNota" tabindex="-1" aria-labelledby="crearNotaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="crearNotaLabel">Título de la nota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" name="txtNota" placeholder="Ingrese aquí el título de la nota" aria-label="Username" aria-describedby="addon-wrapping"  maxlength="50" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$+[0-9]">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-primary" value="Crear Nota" name="CN">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" id="crearCarpeta" tabindex="-1" aria-labelledby="crearCarpetaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="crearCarpetaLabel">Título de la carpeta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" name="txtCarpeta" placeholder="Ingrese aquí el título de la carpeta" aria-label="Username" aria-describedby="addon-wrapping"  maxlength="50" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$+[0-9]">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-primary" value="Crear Carpeta" name="CC">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" id="borrarNota" tabindex="-1" aria-labelledby="borrarNotaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="borrarNotaLabel">Borrar Nota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <?php  
                                    $files = array_diff(scandir($dir), array('..', '.'));
                                ?>
                                <select class="form-select" aria-label="Default select example" name="selectBorrarNota" required>
                                    <option selected hidden disabled>Seleccione la nota</option>
                                    <?php 
                                        foreach($files as $file){
                                            if(!is_dir($file)){
                                            	$file = str_replace("__", " ", $file);
                                    ?>
                                    <option value="<?php echo substr($file, 0, strrpos($file, '.')); ?>"><?php echo substr($file, 0, strrpos($file, '.')); ?></option>
                                    <?php } else{ 
                                        $ff = array_diff(scandir($file), array('..', '.'));
                                        foreach($ff as $f){
                                        	$f = str_replace("__", " ", $f);
                                    ?>
                                    <option value="<?php echo substr($f, 0, strrpos($f, '.')); ?>"><?php echo substr($f, 0, strrpos($f, '.')); ?></option>
                                    <?php }}} ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-danger" value="Borrar Nota" name="BN">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" id="borrarCarpeta" tabindex="-1" aria-labelledby="borrarCarpetaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="borrarCarpetaLabel">Borrar Carpeta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <?php  
                                    $files = array_diff(scandir($dir), array('..', '.'));
                                ?>
                                <select class="form-select" aria-label="Default select example" name="selectBorrarCarpeta" required>
                                    <option selected hidden disabled>Seleccione la carpeta</option>
                                    <?php 
                                        foreach($files as $file){
                                            if(is_dir($file)){
                                            	$file = str_replace("__", " ", $file);
                                    ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-danger" value="Borrar Carpeta" name="BC">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" id="moverNota" tabindex="-1" aria-labelledby="moverNotaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="moverNotaLabel">Seleccione la nota a mover</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <?php
                                    $files = array_diff(scandir($dir), array('..', '.'));
                                ?>
                                <select class="form-select" aria-label="Default select example" name="selectNota" required>
                                    <option selected hidden disabled>Seleccione la nota</option>
                                    <?php 
                                        foreach($files as $file){
                                            if(!is_dir($file)){
                                            	$file = str_replace("__", " ", $file);
                                    ?>
                                    <option value="<?php echo substr($file, 0, strrpos($file, '.')); ?>"><?php echo substr($file, 0, strrpos($file, '.')); ?></option>
                                    <?php } else{
                                        $ff = array_diff(scandir($file), array('..', '.'));
                                        foreach($ff as $f){
                                        	$f = str_replace("__", " ", $f);
                                    ?>
                                    <option value="<?php echo substr($f, 0, strrpos($f, '.')); ?>"><?php echo substr($f, 0, strrpos($f, '.')); ?></option>
                                    <?php }}} ?>
                                </select>
                                <select class="form-select" aria-label="Default select example" name="selectCarpeta" required>
                                    <option selected hidden disabled>Seleccione la carpeta</option>
                                    <option value="txt">Carpeta Principal</option>
                                    <?php
                                        foreach($files as $file){
                                            if(is_dir($file)){
                                            	$file = str_replace("__", " ", $file);
                                    ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-primary" value="Mover Nota" name="MN">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <?php
            $files = array_diff(scandir($dir), array('..', '.'));
            foreach($files as $file){
                if(!is_dir($file)){
        ?>
        <button type="button" class="btn btn-success col col-sm-10 col-10 offset-sm-1 offset-1" data-bs-toggle="modal" data-bs-target="#<?php echo substr($file, 0, strrpos($file, '.')); ?>">
            <?php echo substr(str_replace("__", " ", $file), 0, strrpos(str_replace("__", " ", $file), '.')); ?>
        </button>
        <div class="container">
            <div class="modal fade" id="<?php echo substr($file, 0, strrpos($file, '.')); ?>" tabindex="-1" aria-labelledby="<?php echo substr($file, 0, strrpos($file, '.')); ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="<?php echo substr($file, 0, strrpos($file, '.')); ?>Label"><?php echo substr(str_replace("__", " ", $file), 0, strrpos(str_replace("__", " ", $file), '.')); ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" name="mensaje<?php echo substr($file, 0, strrpos($file, '.')); ?>"><?php $fp = fopen($file, "a+"); if(filesize($file) > 0){ $contents = fread($fp, filesize($file)); echo $contents; }?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success" type="submit" name="GN" value="<?php echo substr($file, 0, strrpos($file, '.')); ?>">Guardar Nota</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <br>
        <?php } else{ ?>
        <div class="accordion accordion-flush" id="carpetas">
            <?php
                $ff = array_diff(scandir($dir."/".$file), array('..', '.'));
                if(count($ff) == 0){
            ?>
            <div class="accordion-item col col-sm-10 offset-sm-1">
                <h2 class="accordion-header">
                <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $file; ?>" aria-expanded="true" aria-controls="<?php echo $file; ?>">
                    <?php echo str_replace("__", " ", $file); ?>
                </button>
                </h2>
                <div id="<?php echo $file; ?>" class="accordion-collapse collapse show" data-bs-parent="#carpetas">
                    <div class="accordion-body">
                        <strong>Esta carpeta está vacía.</strong> 
                    </div>
                </div>
            </div> <br>
            <?php } else{ ?>
            <div class="accordion-item col col-sm-10 offset-sm-1">
                <h2 class="accordion-header">
                <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $file; ?>" aria-expanded="true" aria-controls="<?php echo $file; ?>">
                    <?php echo str_replace("__", " ", $file); ?>
                </button>
                </h2>
                <div id="<?php echo $file; ?>" class="accordion-collapse collapse show" data-bs-parent="#carpetas">
                    <div class="accordion-body">
                        <?php foreach($ff as $f){ ?>
                        <button type="button" class="btn btn-success col col-sm-10 col-10 offset-sm-1 offset-1" data-bs-toggle="modal" data-bs-target="#<?php echo substr($f, 0, strrpos($f, '.')); ?>">
                            <?php echo substr(str_replace("__", " ", $f), 0, strrpos(str_replace("__", " ", $f), '.')); ?>
                        </button>
                        <div class="container">
                            <div class="modal fade" id="<?php echo substr($f, 0, strrpos($f, '.')); ?>" tabindex="-1" aria-labelledby="<?php echo substr($f, 0, strrpos($f, '.')); ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="<?php echo substr($f, 0, strrpos($f, '.')); ?>Label"><?php echo substr(str_replace("__", " ", $f), 0, strrpos(str_replace("__", " ", $f), '.')); ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="form-control" name="mensaje<?php echo substr($f, 0, strrpos($f, '.')); ?>"><?php chdir($file); $fp = fopen($f, "r+"); if(filesize($f) > 0){ $contents = fread($fp, filesize($f)); echo $contents;} chdir("../"); ?></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button class="btn btn-success" type="submit" name="GN" value="<?php echo substr($f, 0, strrpos($f, '.')); ?>">Guardar Nota</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div> <br>
        <?php }}} ?>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
</body>
</html>