<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Usuarios</title>
	
	<script  src="../script/jquery/jquery-2.1.3.min.js"></script>
	<?php require_once("../script/DHTMLX.includes.php");?>
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
        var layout,menu,toolbar,contactsGrid,contactForm;
        dhtmlxEvent(window,"load",function(){                       
            layout = new dhtmlXLayoutObject(document.body,"2U");                    
            layout.cells("a").setText("Usuarios");                           
            layout.cells("b").setText("Detalles del Usuario");                         
            layout.cells("b").setWidth(350);                                     
			toolbar = layout.attachToolbar({
				icons_path: "icons/",
				skin: 'dhx_terrace',
				xml: "data/toolbar.xml"
			});

            contactsGrid = layout.cells("a").attachGrid();                             
            contactsGrid.setHeader("Nombre,Apellidos,Login,Contraseña,Email,Teléfono,Estatus");                          
            contactsGrid.setColumnIds("nombre,primer_apellido,login,contrasena,email,telefono,estatus");                        
            contactsGrid.setInitWidths("150,150,*,*,*,*,*");                             
            contactsGrid.setColAlign("left,left,left,left,left,left,left");                            
            contactsGrid.setColTypes("ro,ro,ro,ro,ro,ro,ch");                                     
            contactsGrid.setColSorting("str,str,str,str,str,str,str");                               
            contactsGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#select_filter");
			contactsGrid.setSkin("dhx_web");
            contactsGrid.init();                                                       
            contactsGrid.load("data/usuarios.php");

			var formData = [
				{type: "settings", position: "label-left", labelWidth: 130, inputWidth: 160},
				{type: "label", label: "Datos de Usuario"},
				{type: "input", label: "Nombre (s)", name:"nombre", value: "", validate: "NotEmpty"},
				{type: "input", label: "Apellidos", name:"primer_apellido", value: "", validate: "NotEmpty"},
				{type: "label", label: "Datos de Usuario"},
				{type: "input", label: "Login", name:"login", value: "", validate: "NotEmpty"},
				{type: "password", label: "Contraseña", name:"contrasena", value: "", validate: "NotEmpty"},
				{type: "label", label: "Datos de Contacto"},				
				{type: "input", label: "E-mail", name:"email", value: "", validate: "NotEmpty,ValidEmail"},
				{type: "input", label: "Teléfono", name:"telefono", value: "", validate: "NotEmpty"},
				{type: "checkbox", label: "Activar", name:"estatus"},
				{type: "button", value: "Guardar"}
			];

			contactForm = layout.cells("b").attachForm(formData);
			contactForm.enableLiveValidation(true);
			contactForm.attachEvent("onButtonClick",function(){
				contactForm.validate();
			});
			contactForm.bind(contactsGrid); 
			
            var dpg = new dataProcessor("data/usuarios.php");                          //inits dataProcessor
            dpg.init(contactsGrid);                                                    //associates the dataProcessor instance with the grid

            dpg.attachEvent("onAfterUpdate", function(sid, action, tid, tag){
                if (action == "inserted"){
                    contactsGrid.selectRowById(tid);                                   //selects a row
                    contactForm.setFocusOnFirstActive();                               //sets focus to the 1st form's input
                }
            })

            contactForm.attachEvent("onButtonClick", function(id){                     //attaches a handler function to the "onButtonClick" event
                contactForm.save();                                                    //sends the values of the updated row to the server
            });

            toolbar.attachEvent("onclick",function(id){                                //attaches a handler function to the "onclick" event
                if(id=="newContact"){                                                  //'newContact' is the id of the button in the toolbar
                    var rowId=contactsGrid.uid();                                      //generates an unique id
                    var pos = contactsGrid.getRowsNum();                               //gets the number of rows in the grid
                    contactsGrid.addRow(rowId,["Nuevo Usuario (Editar)","",""],pos);              //adds a new row to the grid. The 'addRow()' method takes 3 parameters: the row id (must be unique), the initial values of the row, the  position where the new must be inserted
                };
                if(id=="delContact"){					 
					dhtmlx.confirm({type:"confirm-warning",	title:"Eliminar",ok:"Sí", cancel:"No",text:"¿Desea Eliminar el Registro?<img src='../images/eliminar_16.png' width='16'/>",callback:function(result){				
						if(result){ 													//'delContact' is the id of the button in the toolbar
							var rowId = contactsGrid.getSelectedRowId();                //gets the id of the currently selected row
							var rowIndex = contactsGrid.getRowIndex(rowId);             //gets the index of the row with the specified id
							if(rowId!=null){
								contactsGrid.deleteRow(rowId);                          //deletes the currently selected row
								if(rowIndex!=(contactsGrid.getRowsNum()-1)){            //checks whether  the currently selected row is NOT last in the grid
									contactsGrid.selectRow(rowIndex+1,true);            //if the currently selected row isn't last - moves selection to the next row
								}
								else{                                                 //otherwise, moves selection to the previous row
									contactsGrid.selectRow(rowIndex-1,true)
								}
							}
						}
					}});
				}
            });
        })
    </script>
</head>
<body>
</body>
</html>

