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
        var myLayout,GridLista,GridDetalles,myCellA,myCellB;
        dhtmlxEvent(window,"load",function(){                                         
            myLayout = new dhtmlXLayoutObject(document.body,"2U");
            myCellA = myLayout.cells('a');
			myCellB = myLayout.cells('b');   

            myCellA.setText("Mensajes");                                    
            myCellB.setText("Detalles");

            myCellB.collapse();
            
            GridDetalles = myCellB.attachGrid();                           
            GridDetalles.setHeader("Dato,Información");                           
            GridDetalles.setColumnIds("dato,info");                         
            GridDetalles.setInitWidthsP("30,70");                                
            GridDetalles.setColAlign("left,justify");                            
            GridDetalles.setColTypes("ro,txt");                                 
            GridDetalles.setColSorting("icon,str,str");                               
            GridDetalles.attachHeader("#select_filter,#text_filter");  
            GridDetalles.enableMultiline(true);    
            GridDetalles.setSkin("dhx_web");
            GridDetalles.setColumnColor("#ededed");
            GridDetalles.setStyle(
                "", "border-color:black;","", ""
            );
            GridDetalles.init();  

            GridLista = myCellA.attachGrid();                           
            GridLista.setHeader("Nombre,Email,Fecha");                           
            GridLista.setColumnIds("nombre,correo,FC");                         
            GridLista.setInitWidthsP("40,30,30");                                
            GridLista.setColAlign("left,left,center");                            
            GridLista.setColTypes("ro,ro,ro");                                 
            GridLista.setColSorting("str,str,str");                               
            GridLista.attachHeader("#text_filter,#text_filter,#text_filter");  
            GridLista.enableMultiline(true);      
			GridLista.attachEvent("onRowSelect",function(id){
                myCellB.expand();
                GridDetalles.clearAndLoad(`data/xml-info.php?id=${id}`);	 
			});
			GridLista.setSkin("dhx_web");
            GridLista.init();                                                    
            GridLista.clearAndLoad("data/xml.php");
        });
    </script>
</head>
<body>
</body>
</html>

