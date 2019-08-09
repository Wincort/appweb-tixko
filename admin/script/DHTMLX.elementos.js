var wVentana, treeInfo, gridMaster, winMaster, sbGen, dhxWins, myCalendar,myToolbar; 
var ruta="";
var contadorBusqueda=0;

/***************	DHTMLX WINDOW	*************************/
function abrirVentana(nombreVentana,parametro,archivo,titulo,ancho,alto,posX,posY){
	wVentana = dhxWins.createWindow(nombreVentana, posX, posY, ancho, alto);
	wVentana.setText(titulo);
	wVentana.attachURL(archivo+parametro);
	dhxWins.window(nombreVentana).denyPark();
	dhxWins.window(nombreVentana).button("minmax1").show();
	dhxWins.window(nombreVentana).button("minmax2").hide();
	dhxWins.window(nombreVentana).button("park").hide();		
	dhxWins.window(nombreVentana).center();
	//dhxWins.window(nombreVentana).centerOnScreen();	
	dhxWins.window(nombreVentana).setModal(true);
	dhxWins.window(nombreVentana).bringToTop();
}
function abrirVentanaMaxi(nombreVentana,parametro,archivo,titulo,ancho,alto,posX,posY){
	wVentana = dhxWins.createWindow(nombreVentana, posX, posY, ancho, alto);
	wVentana.setText(titulo);
	wVentana.attachURL(archivo+parametro);
	dhxWins.window(nombreVentana).denyPark();
	dhxWins.window(nombreVentana).button("minmax1").show();
	dhxWins.window(nombreVentana).button("minmax2").hide();
	dhxWins.window(nombreVentana).button("park").hide();		
	dhxWins.window(nombreVentana).center();
	dhxWins.window(nombreVentana).setModal(true);
	dhxWins.window(nombreVentana).bringToTop();	
	dhxWins.window(nombreVentana).maximize();
}
function abrirVentanaCentro(nombreVentana,parametro,archivo,titulo,ancho,alto,posX,posY){
	//alert(nombreVentana);
	wVentana = dhxWins.createWindow(nombreVentana, posX, posY, ancho, alto);
	wVentana.setText(titulo);
	wVentana.attachURL(archivo+parametro);
	dhxWins.window(nombreVentana).denyPark();
	dhxWins.window(nombreVentana).button("minmax1").show();
	dhxWins.window(nombreVentana).button("minmax2").hide();
	dhxWins.window(nombreVentana).button("park").hide();		
	dhxWins.window(nombreVentana).center();
	//dhxWins.window(nombreVentana).centerOnScreen();	
	dhxWins.window(nombreVentana).setModal(true);
	dhxWins.window(nombreVentana).bringToTop();
}
function abrirVentanaFull(nombreVentana,parametro,archivo,titulo,ancho,alto,posX,posY){
	wVentana = dhxWins.createWindow(nombreVentana, posX, posY, ancho, alto);
	wVentana.setText(titulo);
	wVentana.attachURL(archivo+parametro);
	dhxWins.window(nombreVentana).denyPark();
	dhxWins.window(nombreVentana).button("minmax1").show();
	dhxWins.window(nombreVentana).button("minmax2").hide();
	dhxWins.window(nombreVentana).button("park").hide();		
	dhxWins.window(nombreVentana).center();
	dhxWins.window(nombreVentana).setModal(true);
	dhxWins.window(nombreVentana).bringToTop();	
	dhxWins.window(nombreVentana).setToFullScreen(true);
}

function cerrarVentana(ventana){
	dhxWins.window(ventana).close(); 
}


/*********************** DHTMLX TOOLBAR********************/

function crearMenu(div,titulo,opciones,medida,soloIconos,input,opcInput){
	var toolElement=0;
	var separador=0;

	myToolbar = new dhtmlXToolbarObject({
		parent: div,
		icons_path: "../images/"
	});
    myToolbar.addText("info", toolElement, titulo);
	toolElement++;
    myToolbar.addSeparator("sep"+separador, toolElement);

/**/		 var Var = opciones;
	for (var opc in Var){
	    //alert(opc + "=" + Var[opc]);
		separador++;
		myToolbar.addSeparator("sep"+separador, toolElement);
		toolElement++;	
		if(soloIconos==1){
    	myToolbar.addButton(opc, toolElement, "", Var[opc]+".png", Var[opc]+".png");			
		}else if(soloIconos==2){
    	myToolbar.addButton(opc, toolElement, opc, Var[opc]+".png", Var[opc]+".png");
		}else if(soloIconos==3){
    	myToolbar.addButton(opc, toolElement, opc, "", "");
		}
		toolElement++;
	}
	//{type: "buttonInput", id: "inp", text: "Input", width: 50},
	if(input>0){
			for (var opc in opcInput){
				myToolbar.addText(opc, null, opc);
				myToolbar.addInput(opcInput[opc], null, "", 70);
				//myToolbar.addButton(opcInput[opc]+'_Btn', toolElement, "", "zoom.png","zoom.png");			
			}
	}
	myToolbar.setWidth('info',medida); //"550"
   	myToolbar.attachEvent("onClick", myToolbarListener);
	myToolbar.setItemText('info','<b style="color:#000;font-family:Verdana, Geneva, sans-serif; font-size:18px;font: message-box;font-weight: bolder;">'+titulo+'</b>');
	
	myToolbar.attachEvent("onEnter", function(id, value) {
		if(id=='folioCedEstructura')
		//mensaje("<b>onEnter event</b> was fired for input "+id +' Valor= '+ value);
		BuscaEstructuraxId(value,'');return false;
	});
	
	
/*	var Var = {uno: 1, dos: 2, tres: 3 };
	for (var k in Var){
	   alert(k + "=" + Var[k]);
	}
	var a = ["a", "b", "c"];
		a.forEach(function(entry) {
	    alert(entry);
	});*/}



/*********************** DHTMLX GRID********************/

function crearGrid(NombreGrid,sheader,scoltypes,sinitwidht,scolaligns,scolsorting,sfilter,xml,loader){
/*	try{
		gridMaster.destructor();
	}catch(error){}	*/
	//alert("Go report!");
	//$(NombreGrid).html('');
	gridMaster = new dhtmlXGridObject(NombreGrid);
	gridMaster.setIconsPath(ruta+"../script/DHTMLXS/codebase/imgs/");
	gridMaster.setImagePath(ruta+"../script/DHTMLXS/codebase/imgs/");
//mensaje("LLEGA POR AQUI EN EL GRID");
	//gridMaster.setColumnIds("sales,book,author,price,store,shipping,best,date");	
	gridMaster.setHeader(sheader);
	gridMaster.setColTypes(scoltypes);
	gridMaster.setInitWidths(sinitwidht);
	gridMaster.setColAlign(scolaligns);
	gridMaster.setColSorting(scolsorting);
	if(sfilter!='') gridMaster.attachHeader(sfilter);	
	gridMaster.enableMultiline(true);
	gridMaster.enableSmartRendering(true);
	try{gridMaster.setStyle("","font-size:12px;","","");}catch(err){}
	gridMaster.setSkin("dhx_skyblue");
	gridMaster.init();
	if(xml!='' && xml!=null){
		gridMaster.loadXML(xml,function(){
			gridMaster.selectRow(0);
			var filaId=gridMaster.getRowId(gridMaster.getRowIndex(gridMaster.getSelectedId()));
			//alert(filaId);
			var IdContribuyente=filaId.split("-")[0];
		 	var IdTipoFormato=filaId.split("-")[1];
			var persona=filaId.split("-")[2];
			/*mensaje(IdContribuyente);
			mensaje(IdTipoFormato);*/
			if(IdContribuyente=='SinContribuyente' && (IdTipoFormato>0)){
					contadorBusqueda++;	
					IntenteBuscar(IdContribuyente,IdTipoFormato,persona);
			}
			else if(IdContribuyente>0 && (IdTipoFormato>0)){
					contadorBusqueda++;	
					IntenteBuscar(IdContribuyente,IdTipoFormato,persona);
			}
					});
		}
	gridMaster.attachEvent("onRowSelect", function(){
		var id=gridMaster.getSelectedRowId();	
		if(id==null){
			mensaje("Por favor, seleccione un registro");
			return false;
		}
		else{
			//mensaje(id);
			}
	  });
	gridMaster.attachEvent("onXLS", function(grid_obj){ 			//CARGANDO
		//mensaje("CARGANDO");		
		$("#"+loader).css('display','block');
	});
	gridMaster.attachEvent("onXLE", function(grid_obj,count){ 	//CARGADO
		$("#"+loader).css('display','none');
	}); 
	  
	  
}
function IntenteBuscar(IdContribuyente,IdTipoFormato,persona){
			if(contadorBusqueda==2){
				mensaje("¡Intenta buscar de nuevo!");
			}
			else if(IdContribuyente=='SinContribuyente' && contadorBusqueda>2 && (IdTipoFormato>0)){
				mensaje("¡Si es necesario, puedes crear a la persona!");
				visible("#addContribuyente"+persona);
			}
			else if(IdContribuyente>0 && contadorBusqueda>2){
				mensaje("¡Si es necesario, puedes crear a la persona!!");
				visible("#addContribuyente"+persona);
			}
			else {invisible("#addContribuyente"+persona); }

	}

/*	DHTMLX_MESSAGE*/
	function nota(mensaje,tipo){	
		dhtmlx.message({type:tipo,text:"<div style='margin:2px 0 0 2px;font-weight:bold;'><div style='margin-top:10px;'>"+ mensaje +" <img src='../images/load-rojo.gif' style='float:left;margin-left:1px;width:18px;height:18px;'></div><a target='blank' href=''></a></div>",  expire:3000 });
	}
 	
	function notificacion(mensaje,tipo){/*<img src='../images/alert_small.gif' style='float:left;'> */
		var imagen="good.png";
		if(tipo=='error'){ imagen='eli.png';}else{ imagen="good.png";}
	
		dhtmlx.message({type:tipo,text:"<div style='margin:2px 0 0 2px;font-weight:bold;'><img src='../images/"+imagen+"' style='float:left;margin-left:1px;'><a target='blank' href=''></a></div><div style='margin-top:10px;'>"+mensaje+"</div>",  expire:3000 });
	}
	function avisoLoad(mensaje,tipo){/*<img src='../images/alert_small.gif' style='float:left;'> */		
		dhtmlx.message({type:tipo,text:"<div style='margin:2px 0 0 2px;font-weight:bold;'><a target='blank' href=''></a></div><div style='margin-top:10px;'>"+mensaje+"</div>",  expire:5000 });
	}

	function aviso(mensaje,tipo){/*<img src='../images/alert_small.gif' style='float:left;'> */
		dhtmlx.message({type:tipo,type:"cssAviso",text:"<div style='margin:2px 0 0 2px;font-weight:bold;'><img src='../images/alert_small.png' style='float:left;margin-left:1px;'><a target='blank' href=''></a></div><div style='margin-top:10px;'>"+mensaje+"</div>",  expire:1200 });
	}
	function alerta(mensaje){
		dhtmlx.alert("<div style='font-weight:bold;margin-top:10px;text-align:center;width:100%;'>"+mensaje+"</div>");
	}
	
	function alertaImagen(mensaje){
		dhtmlx.alert("<img src='../images/alert_small.png' style='float:left;margin-left:5px;'><div style='font-weight:bold;margin-top:10px;text-align:center;width:100%;'>"+mensaje+"</div>");
	}
	function mensajeImagen(mensaje,tipo){
		var imagen="accepted.png";
		if(tipo=='error'){ imagen='alert_medium.png';}else{ imagen="accepted.png";}
		dhtmlx.alert("<div style='font-weight:bold;margin-top:20px;text-align:left;width:85%;'>"+mensaje+"</div><img src='../images/"+imagen+"' style='float:right;margin-left:1px;width:30px;'>");
	}

	function mensajeFormulario(mensaje,tipo){
		var imagen="accepted.png";
		if(tipo=='error'){ imagen='alert_medium.png';}else{ imagen="accepted.png";}
		dhtmlx.alert("<div style='font-weight:bold;margin-top:20px;text-align:left;width:85%;'>"+mensaje+"</div> <form><label for='Colonia'>Colonia:</label><input id='Colonia' type='text' value=''/></form>");
	}

	/*ESTE SIRVE MÁS PARA TODO*/
	function mensaje(mensaje,tipo,titulo){
		if(titulo=='' || titulo==null){titulo='Mensaje';}
		if(tipo=='error'){tipo="confirm-error";}else if(tipo=="bien"){tipo="confirm-warning";} else{tipo="myCss"}		
	  	dhtmlx.alert({title:titulo, type:tipo, ok:"OK",text: mensaje, callback:function(){} });
	}

	function mensajeFuncion(mensaje,funcion){
		alert("OK, va!");
	  	dhtmlx.alert({title:"Mensaje",	ok:"OK",text: mensaje, callback:function(){
			if(funcion!=''){
				alert(funcion);
				funcion;
				}else{
					alert("No hay función");
					}
			}				
				});
	}
	function confirmarFuncion(titulo,mensaje,funcion){
 			dhtmlx.confirm({type:"confirm-warning",	title:titulo,ok:"Sí", cancel:"No",text:mensaje,callback:function(result){				
				if(result){}
					funcion;
				}
			});	 
	}

	function confirmarse(mensaje,href){
		var x=dhtmlx.confirm("<img src='../images/alert_medium.png' style='float:left;margin-left:30px;'> <div style='font-weight:bold;margin-top:10px;text-align:left;width:350px'>Need rich <a target='blank' href='"+href+"'>"+mensaje+".</a></div>");
		if(x==true){ alert("entro");} else{ alert("me das ascoooo!");}
		}
		
	function confirmarFuncionHref(mensaje,funcion,href){
		if(href!=''){ href = href;} else{href='';}
		var x=dhtmlx.confirm("<img src='../images/alert_medium.png' style='float:left;margin-left:30px;'> <div style='font-weight:bold;margin-top:10px;text-align:left;width:350px'>Need richD <a target='blank' href='"+href+"'>"+mensaje+".</a></div>");
		if(x==true){ alert("entro");
			if(funcion!=''){
				alert(funcion);
				funcion;
				}else{
					alert("No hay función");
					}		
		} else{ /*alert("me das ascoooo!");*/}
		}


	function TestConfirm(){
			dhtmlx.confirm("Test confirm", function(result){
			dhtmlx.confirm({title:"Custom title",ok:"Yes", cancel:"No",	text:"Result: "+result,	callback:function(){
				
				if(result)
					dhtmlx.confirm({type:"confirm-warning",	text:"Warning",	callback:function(){
							dhtmlx.confirm({title:"Important!",	type:"confirm-error",text:"Error"});
						}
					});
				}
			});
		});	
	}
	function rich_confirm(mensaje,href){
		var x=dhtmlx.confirm("<img src='../images/alert_medium.png' style='float:left;margin-left:30px;'> <div style='font-weight:bold;margin-top:10px;text-align:left;width:350px'>Need rich <a target='blank' href='"+href+"'>"+mensaje+".</a></div>");
		if(x==true){ alert("entro");} else{ alert("me das ascoooo!");}
		}
	 /*var statusConfirm = confirm("¿Deseas Cambiar el Tipo de Formato?"); 
            if (statusConfirm == true){ 
				 if(primeraEntrada==1 && segundaEntrada==0){
						location.href="formato2.nl.php?id="+id+"&clave=2&mini=1";
				 	}
			}else{			
				//return false;
			}*/
		
	function rich_alert(mensaje,href){
			dhtmlx.alert("<img src='../images/alert_medium.png' style='float:left;margin-left:30px;'> <div style='font-weight:bold;margin-top:10px;text-align:left;width:350px'>Need rich <a target='blank' href='"+href+"'>"+mensaje+".</a>!</div>");
			}
			
	function rich_message(mensaje,tipo){
		dhtmlx.message({type:tipo,text:"<img src='../images/alert_small.gif' style='float:left;'> <div style='margin:2px 0 0 40px;font-weight:bold;'><a target='blank' href=''></a></div><div style='margin-top:10px;'>"+mensaje+".</div>",expire: -1});
			}

function setActiveStyleSheet(title){
	var links=document.getElementsByTagName("link");
	for(var i=0;i<links.length;i++){
		if(links[i].getAttribute("title")&&links[i].getAttribute("demo"))links[i].disabled=(links[i].getAttribute("title")!=title);
		}};
setActiveStyleSheet("Skyblue");
var count=0;
var lines=[{expire: -1,text:"dhtmlxMessage - a good way to communicate with application users"},{id:1,text:"Simple and Elegant"},{id:2,text:"Just 4kb (gziped)"},"Easy customizable",{type:"error",expire:20000,id:4,text:"Different styles"},"FF, Chrome, Safari, Opera, IE7+","Dual license: GPL and Free license"];

function show_message(){
	dhtmlx.message(lines[count%7]);count++;
	};
	

/*************		Layout		*********************/
 	$(document).ready(function(){
	});
var dhxLayout;
var sel = document.getElementById("sel");
function doOnLoad() {
    dhxLayout = new dhtmlXLayoutObject("divLayout", "3L");
    //, "dhx_black");
    dhxLayout.forEachItem(function(item) {
        sel.options.add(new Option(item.getId(), item.getIndex()));
    });
}
function getInd() {
    var sel = document.getElementById("sel");
    var id = sel.options[sel.selectedIndex].value;
    return id;
}
function progressOn(fullLayout) {
    if (fullLayout) {
        dhxLayout.progressOn();
    } else {
        dhxLayout.items[getInd()].progressOn();
    }
}
function progressOff(fullLayout) {
    if (fullLayout) {
        dhxLayout.progressOff();
    } else {
        dhxLayout.items[getInd()].progressOff();
    }
}	//**********************************************
	
	
	
	
function exportarExcel(gridRegistros,nombreArchivo){
	gridRegistros.toExcel('../script/DHTMLXS/grid-excel-php/generate.php?nombreArchivo='+nombreArchivo)
}
function exportarPDF(gridRegistros){
	gridRegistros.toPDF('../script/DHTMLXS/grid-pdf-php/generate.php?nombreArchivo=ListadoUsuarioSyscam')
}

	
	
	
	