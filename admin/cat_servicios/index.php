<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Páginas</title>
    <script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 
    <?php require_once("../script/DHTMLX.includes.php");?>
    <script src="../script/DHTMLX.elementos.js" type="text/javascript"></script>

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            overflow: hidden;
            background-color:white;
        }
    </style>

    <script type="text/javascript">
        let myLayout,toolbar,GridLista,GridDetalles,myCellA;
        dhtmlxEvent(window,"load",function(){                                         
            myLayout = new dhtmlXLayoutObject(document.body,"1C");
            myCellA = myLayout.cells('a');


            var pagingId = "pagingArea_"+window.dhx.newId();
            myCellA.attachStatusBar({
                text: "<div id='"+pagingId+"'></div>",
                paging: true
            });
            
            toolbar = myLayout.attachToolbar({
				icons_path: "../images/",
				skin: 'dhx_terrace',
				xml: "data/toolbar.xml"
            });
              
			toolbar.attachEvent("onclick",function(id){                                
                if(id=="nuevoRegistro"){
                    CrearRegistro();
                };
            }); 

            myCellA.setText("Servicios");                                    

            GridLista = myCellA.attachGrid();                           
            GridLista.setHeader("Trámite,Área Responsable,Pie de Página,Publicar,Editar");
            GridLista.setColumnIds("nombre,responsable,footer,publicar,editar");                         
            GridLista.setInitWidthsP("40,39,10,6,5");                                
            GridLista.setColAlign("left,center,center,center,center");                            
            GridLista.setColTypes("ro,ro,ro,ro,ro");                                 
            GridLista.setColSorting("str,str,str,str,str");                               
            GridLista.attachHeader("#text_filter,#select_filter,#select_filter,#select_filter,");  
            GridLista.enableMultiline(true);      
			GridLista.attachEvent("onRowSelect",function(id){
                	 
			});
            GridLista.setSkin("dhx_web");
            GridLista.i18n.paging={
                results:"Resultados",
                records:"Registros del ",
                to:" al ",
                page:"Página ",
                perpage:"Filas por página",
                first:"A primera página",
                previous:"Página anterior",
                found:"Registros encontrados",
                next:"Página siguiente",
                last:"A última página",
                of:" de ",
                notfound:"Sin registros" 
            };
            GridLista.enablePaging(true,10,5,pagingId);
            GridLista.setPagingSkin("toolbar");
            GridLista.init();                                                    
            GridLista.clearAndLoad("data/xml.php");
        });

    let AbrirEditor = (UrlEdicion) =>{
		let titulo="Editor de registro";
        abrirVentana("vEditar",UrlEdicion,titulo,1000,350,0,0); 
    }

    let CrearRegistro = () =>{
        let UrlArchivo="pagina.formulario.php";
		let titulo="Nuevo registro";
        abrirVentana("vEditar",UrlArchivo,titulo,1000,350,0,0); 
    }

    function abrirVentana(nombreVentana,archivoURL,titulo,ancho,alto,posX,posY){
        wVentana = dhxWins.createWindow(nombreVentana, posX, posY, ancho, alto);
        wVentana.setText(titulo);
        wVentana.attachURL(archivoURL);
        dhxWins.window(nombreVentana).denyPark();
        dhxWins.window(nombreVentana).button("minmax1").show();
        dhxWins.window(nombreVentana).button("minmax2").hide();
        dhxWins.window(nombreVentana).button("park").hide();		 
        dhxWins.window(nombreVentana).center();
        dhxWins.window(nombreVentana).setModal(true);
        dhxWins.window(nombreVentana).bringToTop();
        dhxWins.window(nombreVentana).maximize();
    }

    function cerrarVentana(){
        dhxWins.window("vEditar").close(); 
    }

    function recargaInformacion(){
        GridLista.clearAndLoad("data/xml.php");
    }
    </script>
</head>
<body>
</body>
</html>

