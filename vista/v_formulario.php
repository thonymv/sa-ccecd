<div class="px-5 pt-5">
    <form name="form_estadisticas">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Administrador:</label>
                <input name="administrador" value="<?=isset($_POST["administrador"])?$_POST["administrador"]:""?>"
                    type="text" class="form-control" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputState">Empleado:</label>
                <input name="empleado" value="<?=isset($_POST["empleado"])?$_POST["empleado"]:""?>" type="text"
                    class="form-control" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Desde:</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input value="<?=isset($_POST["fecha-inicio"])?$_POST["fecha-inicio"]:""?>" name="fecha-inicio"
                        type="date" class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Hasta:</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input value="<?=isset($_POST["fecha-fin"])?$_POST["fecha-fin"]:""?>" name="fecha-fin" type="date"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Estado</label>
                <select name="estado" id="inputState" class="form-control">
                    <option value="-1" <?=isset($_POST["estado"])?($_POST["estado"]=="-1"?"selected":""):"selected"?>>
                        Ninguno</option>
                    <option value="0" <?=isset($_POST["estado"])?($_POST["estado"]=="0"?"selected":""):""?>>En proceso
                    </option>
                    <option value="1" <?=isset($_POST["estado"])?($_POST["estado"]=="1"?"selected":""):""?>>Finalizado
                    </option>
                    <option value="2" <?=isset($_POST["estado"])?($_POST["estado"]=="2"?"selected":""):""?>>Cancelado
                    </option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Prioridad</label>
                <select name="prioridad" id="inputState" class="form-control">
                    <option value="-1"
                        <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="-1"?"selected":""):"selected"?>>Ninguna
                    </option>
                    <option value="0" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="0"?"selected":""):""?>>Baja
                    </option>
                    <option value="1" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="1"?"selected":""):""?>>
                        Moderada</option>
                    <option value="2" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="2"?"selected":""):""?>>Alta
                    </option>
                </select>
            </div>
        </div>
        <button onclick="enviar()" class="btn btn-primary">Aplicar</button>
        <button onclick="pdf()" class="btn btn-info">Exportar resultados en PDF</button>
        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Empleado</th>
                    <th scope="col">Administrador</th>
                    <th scope="col">C.I Empleado</th>
                    <th scope="col">C.I Administrador</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i < count($accesos); $i++) { ?>
                <tr>
                    <td><?=$accesos[$i]["mon_nombre"]?></td>
                    <td><?=$accesos[$i]["adm_nombre"]?></td>
                    <td><?=$accesos[$i]["ci_mon"]?></td>
                    <td><?=$accesos[$i]["ci_adm"]?></td>
                    <td><?=$accesos[$i]["prioridad"]>0?($accesos[$i]["prioridad"]>1?"Alta":"Moderada"):"Baja"?></td>
                    <td><?=$accesos[$i]["estado_acc"]>0?($accesos[$i]["estado_acc"]>1?"Cancelado":"Finalizado"):"En proceso"?>
                    </td>
                    <td><?=$accesos[$i]["fcha_inicio"]?><br><?=$accesos[$i]["fcha_final"]?></td>
                    <td><?=$accesos[$i]["motivo"]?></td>
                    <td>
                        <button 
                            class="btn btn-primary"
                            type="button" 
                            data-toggle="modal" 
                            data-target="#verAcceso<?=$accesos[$i]["id_acc"]?>"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" fill="white" d="M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </button>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="verAcceso<?=$accesos[$i]["id_acc"]?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Acceso del empleado <?=$accesos[$i]["mon_nombre"]?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>Nombre del Empleado:</strong> 
                                            <?=$accesos[$i]["mon_nombre"]?>@mppct.gob.ve
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Cédula del empleado:</strong> 
                                            <?=$accesos[$i]["ci_mon"]?>
                                        </li>
                                        <li class="list-group-item">
                                        <strong>Nombre del administrador:</strong> 
                                        <?=$accesos[$i]["adm_nombre"]?>
                                        </li>
                                        <li class="list-group-item">
                                        <strong>Cédula del administrador:</strong> 
                                        <?=$accesos[$i]["ci_adm"]?>
                                        </li>
                                        <li class="list-group-item">
                                        <strong>Motivo: </strong>
                                        <?=$accesos[$i]["motivo"]?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Prioridad de acceso:</strong> 
                                            <?=$accesos[$i]["prioridad"]>0?($accesos[$i]["prioridad"]>1?"Alta":"Moderada"):"Baja"?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Estado de acceso:</strong> 
                                            <?=$accesos[$i]["estado_acc"]>0?($accesos[$i]["estado_acc"]>1?"Cancelado":"Finalizado"):"En proceso"?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Fecha de ingreso:</strong> 
                                            <?=$accesos[$i]["fcha_inicio"]?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Fecha de ingreso:</strong> 
                                            <?=$accesos[$i]["fcha_final"]?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Avance:</strong> 
                                            <?=$accesos[$i]["avance"]?>
                                        </li>

                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button onclick="pdf_by(<?=$accesos[$i]['id_acc']?>)" class="btn btn-info">Exportar ficha de acceso en PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg">
                    <li class="page-item">
                        <button class="page-link" onclick="enviar(<?=$pagina_anterior?>)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </button>
                    </li>
                    <?php for ($i=1; $i <= $paginas; $i++) { ?>
                    <li class="page-item <?=$pagina==$i?"active":""?>"><button class="page-link"
                            onclick="enviar(<?=$i?>)"><?=$i?></button></li>
                    <?php } ?>
                    <li class="page-item">
                        <button class="page-link" onclick="enviar(<?=$pagina_siguiente?>)" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </form>

    <div>
        <script>
            function enviar(pag) {
                if (pag && pag != "0") {
                    document.form_estadisticas.action = "?c=gestionar_estadisticas_form&pag=" + pag + "&num=" + <?=$cantidad?>
                } else {
                    document.form_estadisticas.action = "?c=gestionar_estadisticas_form&num=" + <?=$cantidad?>
                }
                document.form_estadisticas.method = 'POST';
                document.form_estadisticas.removeAttribute("target");
            }

            function pdf() {
                document.form_estadisticas.action = "?c=pdf_estadisticas";
                document.form_estadisticas.method = 'POST';
                document.form_estadisticas.setAttribute("target", "_blank");
            }

            function pdf_by(id) {
                window.open("?c=pdf_acceso&id="+id,"_blank")
                event.preventDefault();
            }

        </script>