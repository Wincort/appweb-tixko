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
        var myLayout,menu,toolbar,masterGrid,masterForm,myCellA,myCellB;
        dhtmlxEvent(window,"load",function(){                                         
            myLayout = new dhtmlXLayoutObject(document.body,"2U");
            myCellA = myLayout.cells('a');
			myCellB = myLayout.cells('b');

            myCellA.setWidth(350);   

            myCellA.setText("Editar");                                    
            myCellB.setText("Detalles");

            myCellB.collapse();	                                                                 			

			toolbar = myLayout.attachToolbar({
				icons_path: "../images/",
				skin: 'dhx_terrace',
				xml: "data/toolbar.xml"
			});

            masterGrid = myCellA.attachGrid();                           
            masterGrid.setHeader("Imagen,Info,Publicar");                           
            masterGrid.setColumnIds("imagen,info,publicar");                         
            masterGrid.setInitWidthsP("40,40,20");                                
            masterGrid.setColAlign("center,justify,center");                            
            masterGrid.setColTypes("ro,ro,ro");                                 
            masterGrid.setColSorting("icon,str,str");                               
            masterGrid.attachHeader(",#text_filter,#select_filter");      
			masterGrid.attachEvent("onRowSelect",function(id){
				progressOn(false);
				myCellB.attachURL("subir.archivo.php?opc=UPD&tipo=IMAGEN&id="+id);
                myCellB.expand();	 
                
			});
			masterGrid.setSkin("dhx_web");
            masterGrid.init();                                                    
            masterGrid.load("data/xml.php");

			
            var dpg = new dataProcessor("data/datos.php");
            dpg.init(masterGrid);

            dpg.attachEvent("onAfterUpdate", function(sid, action, tid, tag){
                if (action == "inserted"){
                    masterGrid.selectRowById(tid);
                    masterForm.setFocusOnFirstActive();
                }
            })
            
			toolbar.attachEvent("onclick",function(id){                                
                if(id=="nuevoRegistro"){                                                  
                    var rowId=masterGrid.uid();                                      
                    var pos = masterGrid.getRowsNum();                               
                    masterGrid.addRow(rowId,["Nuevo Registro (Editar)",""],pos); 
                };
                if(id=="editarRegistro"){                                                  
 
                 };

                if(id=="eliminarRegistro"){
                    var rowId = masterGrid.getSelectedRowId();//gets the id of the currently selected row
                    var rowIndex = masterGrid.getRowIndex(rowId);   
                    dhtmlx.confirm({
                        type:"confirm-warning",	
                        title:"Eliminar",
                        ok:"Sí", cancel:"No",
                        text:"¿Desea Eliminar el Registro?<img src='../images/eliminar_16.png' width='16'/>",
                        callback:function(result){				
                            if(result){ 
                                if(rowId!=null){
                                    masterGrid.deleteRow(rowId);//deletes the currently selected row
                                    if(rowIndex!=(masterGrid.getRowsNum()-1)){
                                        //checks whether  the currently selected row is NOT last in the grid
                                        masterGrid.selectRow(rowIndex+1,true);
                                        //if the currently selected row isn't last - moves selection to the next row
                                    } else{                                     
                                         //otherwise, moves selection to the previous row
                                        masterGrid.selectRow(rowIndex-1,true)
                                    }
                                }
                            }
                        }
                    });
				}

            });

        });
		function doOnRowSelected(id){				
		}
		function recargarGrid(){
			masterGrid.clearAndLoad("data/xml.php");
		}
		function progressOn(fullLayout) {
			if (fullLayout) {
				myLayout.progressOn();
			} else {
				myCellB.progressOn();
			}
		}
		function progressOff(fullLayout) {
			if (fullLayout) {
				myLayout.progressOff();
			} else {
				myCellB.progressOff();
			}
		}	
    </script>
</head>
<body>
</body>
</html>

