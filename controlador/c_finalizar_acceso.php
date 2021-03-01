<?php
    if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic']  < 1) {
        header("Location: ./");
        die();
    }else{
        require_once('modelo/m_Acceso.php');
        $acceso = new Acceso();
        $acceso->setID_acc($_GET['id']);
        $acceso->setReporte($_POST['reporte']);
        if($acceso->finalizar_acceso()){
            header("location: ./?c=gestionar_acceso&ms=Se ha finalizado el acceso exitosamente");
        }else{
            header("location: ./?c=gestionar_acceso&mf=No se ha podido finalizar el acceso por algún fallo interno. Por favor, consulte con soporte.");
        }
    }
?>