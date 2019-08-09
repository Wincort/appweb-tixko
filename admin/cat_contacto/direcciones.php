<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Direcciones</title>
	<script  src="../script/jquery/jquery-1.7.2.min.js"></script>
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
            myLayout = new dhtmlXLayoutObject(document.body,"2E");  
			myCellA = myLayout.cells('a');
			myCellB = myLayout.cells('b');
			
            myCellA.setText("Editar");                                    
            myCellB.setText("Detalles"); 

			myCellB.collapse();		
			
			toolbar = myLayout.attachToolbar({
				icons_path: "../images/",
				skin: 'dhx_terrace',
				xml: "data/toolbar.xml"
			});

            masterGrid = myCellA.attachGrid();                             
            masterGrid.setHeader("Registro,Dirección");                            
            masterGrid.setColumnIds("registro,descripcion");                          
            masterGrid.setInitWidthsP("50,50");                                
            masterGrid.setColAlign("left,left");                               
            masterGrid.setColTypes("ro,ro");                                   
            masterGrid.setColSorting("icon,str,str,str,str,str");
            masterGrid.attachHeader("#select_filter,#text_filter,#text_filter,#text_filter");      
			masterGrid.attachEvent("onRowSelect",function(id){
				progressOn(false);
				//myCellB.attachURL("direcciones.subir.archivo.php?opc=UPD&tipo=IMAGEN&id="+id);
				myCellB.attachURL("direcciones.formulario.php?opc=UPD&&id="+id);
				myCellB.expand();
				myCellA.collapse();
			});
			masterGrid.setSkin("dhx_web");
            masterGrid.init();                                                  //renders  dhtmlxGrid on the page
            masterGrid.load("data/direcciones.xml.php");                     //loads data from the "data/contacts.php" file to the grid
			
            var dpg = new dataProcessor("data/direcciones.datos.php");         	//inits dataProcessor
            dpg.init(masterGrid);                                               //associates the dataProcessor instance with the grid

            dpg.attachEvent("onAfterUpdate", function(sid, action, tid, tag){
                if (action == "inserted"){
                    //masterGrid.selectRowById(tid);                              //selects a row
                    //masterForm.setFocusOnFirstActive();                         //sets focus to the 1st form's input
                }
            })

			toolbar.attachEvent("onclick",function(id){                                
                if(id=="nuevoRegistro"){                                                  
                    var rowId=masterGrid.uid();                                      
                    var pos = masterGrid.getRowsNum();                               
                    masterGrid.addRow(rowId,["Nuevo Registro (Editar)","",""],pos); 
                };
                if(id=="editarRegistro"){                                                  
 
                };
                if(id=="eliminarRegistro"){					 
                    var rowId = masterGrid.getSelectedRowId();                      
                    var rowIndex = masterGrid.getRowIndex(rowId);   
					dhtmlx.confirm({
						type:"confirm-warning",	
						title:"Eliminar",
						ok:"Sí", cancel:"No",
						text:"¿Desea Eliminar el Registro?<img src='../images/eliminar_16.png' width='16'/>",
						callback:function(result){				
							if(result){ 
								if(rowId!=null){
									masterGrid.deleteRow(rowId);                 //deletes the currently selected row
									if(rowIndex!=(masterGrid.getRowsNum()-1)){   //checks whether  the currently selected row is NOT last in the grid
										masterGrid.selectRow(rowIndex+1,true);   //if the currently selected row isn't last - moves selection to the next row
									} else{                                      //otherwise, moves selection to the previous row
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
			masterGrid.clearAndLoad("data/direcciones.xml.php");
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

