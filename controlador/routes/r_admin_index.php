<?php
    if (!isset($_SESSION['email_otic']) || ($_SESSION['pri_otic'] == 0)) {
        header("Location: ./");
        die();
    }
    $pagina = isset($_GET["pag"])?intval($_GET["pag"]):1;
    $cantidad = (isset($_GET["num"])?intval($_GET["num"]):4);
    require_once("modelo/m_Empleado.php"); // Clase Modelo de CRUD Empleado
    $empleado_instancia = new Empleado();
    if (isset($_GET["search"])) {
        if (strlen(str_replace(' ', '',$_GET["search"])) > 0) {
            $search = $_GET["search"];
            if (!(strpos($search, "@") === false)) {
                if (count(explode("@", $search))>1 && explode("@", $search)[1] == "mppct.gob.ve" ) {
                    $search = explode("@", $search)[0];
                }
            }
            $empleados = $empleado_instancia->searchByEmail($search,$cantidad,(($pagina-1)*$cantidad));
            $total = $empleado_instancia->searchByEmail_count($search);
            if (count($empleados) < 1) {
                $empleados = $empleado_instancia->searchByCi(intval($search),$cantidad,(($pagina-1)*$cantidad));
                $total = $empleado_instancia->searchByCi_count(intval($search));
            }
        }else{
            $empleados = $empleado_instancia->all($cantidad,(($pagina-1)*$cantidad));
            $total = $empleado_instancia->all_count($cantidad);
        }
    }else{
        $empleados = $empleado_instancia->all($cantidad,(($pagina-1)*$cantidad));
        $total = $empleado_instancia->all_count($cantidad);
    }
    $paginas = ceil($total/$cantidad);
    $pagina_anterior = isset($_GET['pag'])?intval($_GET['pag'])-1:0;
    if (isset($_GET['pag'])) {
        if (intval($_GET['pag'])+1 <= $paginas) {
            $pagina_siguiente = intval($_GET['pag'])+1;
        }else{
            $pagina_siguiente = intval($_GET['pag']);
        }
    }else{
        if ($paginas > 1) {
            $pagina_siguiente = 2;
        }else{
            $pagina_siguiente = 0;
        }
    }


    include("vista/v_index_admin.php");

?>