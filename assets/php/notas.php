<?php
    chdir("assets"); chdir("txt");
    $dir = getcwd();
    chmod($dir, 0777);
    $cs = array_diff(scandir($dir), array('..', '.'));
    $notas = array();
    foreach($cs as $c){
        if(is_dir($c)){
            $c = array_diff(scandir($dir."/".$c), array('..', '.'));
            foreach($c as $d){
                $notas[] = $d;
            }
        } else{
            $notas[] = $c;
        }
    }

    if(isset($_POST['CN']) && $_POST['CN'] == 'Crear Nota'){
        $nota = $_POST['txtNota'];
        $nota = str_replace(" ", "__", $nota);
        echo $dir;
        if(!file_exists($nota.".txt")){
            $fp = fopen($nota.".txt", "w");
            fclose($fp);
        } else{
            echo 'The file already exists.';
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['CC']) && $_POST['CC'] == 'Crear Carpeta'){
        $carpeta = $_POST['txtCarpeta'];
        $carpeta = str_replace(" ", "__", $carpeta);
        if(!file_exists($dir."/".$carpeta)){
            mkdir($carpeta);
        } else{
            echo 'The folder already exists.';
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['BN']) && $_POST['BN'] == 'Borrar Nota'){
        $nota = $_POST['selectBorrarNota'];
        $nota = str_replace(" ", "__", $nota).".txt";
        $cs = array_diff(scandir($dir), array('..', '.'));
        if(!unlink($dir."/".$nota)){
            $cs = array_diff(scandir($dir), array('..', '.'));
            foreach($cs as $c){
                if(is_dir($c)){
                    unlink($dir."/".$c."/".$nota);
                }
            }
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['BC']) && $_POST['BC'] == 'Borrar Carpeta'){
        $carpeta = $_POST['selectBorrarCarpeta'];
        $carpeta = str_replace(" ", "__", $carpeta);
        $cs = array_diff(scandir($dir."/".$carpeta), array('..', '.'));
        foreach($cs as $c){
            unlink(realpath($dir."/".$carpeta."/".$c));
        }
        rmdir($carpeta);
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['MN']) && $_POST['MN'] == 'Mover Nota'){
        $nota = $_POST['selectNota'];
        $carpeta = $_POST['selectCarpeta'];
        $nota = str_replace(" ", "__", $nota).".txt";
        $carpeta = str_replace(" ", "__", $carpeta);
        $cs = array_diff(scandir($dir), array('..', '.'));
        if($carpeta == "txt"){
            foreach($cs as $c){
                if(is_dir($c)){
                    rename(realpath($dir."/".$c."/".$nota), $dir."/".$nota);
                }
            }
        } else{
            foreach($cs as $c){
                if(is_dir($c)){
                    rename($dir."/".$c."/".$nota, $dir."/".$carpeta."/".$nota);        
                } else{
                    rename($dir."/".$nota, $dir."/".$carpeta."/".$nota);
                }
            }
        }
        $ff = array_diff(scandir($dir."/".$carpeta), array('..', '.'));
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['GN'])){
        foreach($notas as $n){
            if($_POST['GN'] == substr($n, 0, strrpos($n, '.'))){
                $cs = array_diff(scandir($dir), array('..', '.'));
                foreach($cs as $c){
                    if(is_dir($c)){
                        chdir($c);
                        if(!empty(realpath($n))){
                            $contents = $_POST["mensaje".substr($n, 0, strrpos($n, '.'))];
                            $fp = fopen($n, "w");
                            fwrite($fp, $contents);
                            fclose($fp);
                            chdir("../");
                            return;
                        }
                        chdir("../");
                    } 
                }
                $contents = $_POST["mensaje".substr($n, 0, strrpos($n, '.'))];
                $fp = fopen($n, "w");
                fwrite($fp, $contents);
                fclose($fp);
            }
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }
?>