<?php

include_once("../classes/config.php");

    function TraerListaVisitas() {
        $db_host = SERVIDOR_HOST;
        $db_username = USUARIO_BD ; 
        $db_password = PASSWORD_BD;
        $db_name = BASE_DE_DATOS;
        $db_table = "cat_visitas";
        $counter_page = "access_page";
        $counter_field = "access_counter";
        $db = mysqli_connect ($db_host, $db_username, $db_password, $db_name) or die("Host o base de datos no disponible");
        $sql_call = "SELECT * FROM ".$db_table." ORDER BY access_counter desc";
        $sql_result = mysqli_query($db, $sql_call) or die("Error en la petición SQL");
        $resultados=array();
        while($row = mysqli_fetch_assoc($sql_result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro[$counter_page]=html_entity_decode($row[$counter_page]);
			$registro[$counter_field]=html_entity_decode($row[$counter_field]);
			$registro['access_date']=html_entity_decode($row['access_date']);
			array_push($resultados,$registro);
		}
        mysqli_close($db);
        return $resultados;
    }    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Visitas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css" />

        <script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 
        <script type="text/javascript" src="../script/bootstrap/js/bootstrap.min.js"></script>

        <style>
            .right{
                float:right;
            }
            .center{
                text-align:center;
            }
            thead {
                BACKGROUND: #39393e;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2 style="display:inline;">Contador de Visitas</h2>
                <a onclick="location.reload();" class="btn btn-success right" style="display:inline;"><span class="glyphicon glyphicon-refresh"></span> Recargar</a>
                <hr/>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <table id="visitas" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th width=50%;>Página</th>
                                <th class="center">Cantidad de visitas</th>
                                <th class="center">Último acceso</th>
                            </tr>
                        </thead>
                        <tbody id="ListaVisitas"></tbody>
                    </table>        	
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

        <script>
            let ListaVisitas= <?php echo json_encode(TraerListaVisitas()) ?>;
            $(document).ready(function() {
                GenerarContenido();
            });
            let GenerarContenido = () => {
                for(let i in ListaVisitas){
                    
                    let access_page=ListaVisitas[i].access_page!=""?ListaVisitas[i].access_page:"---";
                    let access_counter=ListaVisitas[i].access_counter!=""?ListaVisitas[i].access_counter:"---";
                    let access_date=ListaVisitas[i].access_date!=""?ListaVisitas[i].access_date:"---";
                    let StringHTML=`
                    <tr>
                        <td>${access_page}</td>
                        <td class="center">${access_counter}</td>
                        <td class="center">${access_date}</td>
                    </tr> 	
                    `;
                    $(StringHTML).appendTo(`#ListaVisitas`);
                }
            }
        </script>
    </body>
</html>
