<script src="admin/codebase/sources/dhtmlxMessage/codebase/dhtmlxmessage.js"></script>
<link rel="stylesheet" href="admin/codebase/sources/dhtmlxMessage/codebase/skins/dhtmlxmessage_dhx_green.css">

<style type="text/css">
.dhtmlx-cssAviso{
	font-weight:bold !important;
	color:black !important;
	background-color:#F9CD33 /*#FAFAFA /*#ecefa9*/ !important;
}
.dhtmlx-myCss{
	font-weight:bold !important;
	color: black !important;
	background-color: #F5F3E9/* #ECEBCE #EBEBEB #DDEDB5*/ !important;
}
.dhtmlx_popup_title{
	font-weight:bold !important;
	color: #DDC99A !important;
	background-color: #DDEDB5 !important;
	}
/*.dhtmlx_popup_button{
	background-color: #6C3;}*/
</style>
    
    <script type="text/javascript">
	function nota(mensaje,tipo){	
		dhtmlx.message({type:tipo,text:"<div style='margin:2px 0 0 2px;font-weight:bold;'><a target='blank' href=''></a></div><div style='margin-top:10px;'>"+mensaje+"</div>",  expire:500 });
	}
 	
	function notificacion(mensaje,tipo){/*<img src='../images/alert_small.gif' style='float:left;'> */
		var imagen="good.png";
		if(tipo=='error'){ imagen='eli.png';}else{ imagen="good.png";}
	
		dhtmlx.message({type:tipo,text:"<div style='margin:2px 0 0 2px;font-weight:bold;'><img src='../images/"+imagen+"' style='float:left;margin-left:1px;'><a target='blank' href=''></a></div><div style='margin-top:10px;'>"+mensaje+"</div>",  expire:600 });
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

	function mensaje(mensaje){
	  	dhtmlx.alert({title:"Mensaje", type:"myCss", ok:"OK",text: mensaje, callback:function(){} });
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

	function confirma(mensaje,href){
		var x=dhtmlx.confirm("<img src='../images/alert_medium.png' style='float:left;margin-left:30px;'> <div style='font-weight:bold;margin-top:10px;text-align:left;width:350px'>Need rich <a target='blank' href='"+href+"'>"+mensaje+".</a></div>");
		if(x==true){ alert("entro");} else{ alert("me das ascoooo!");}
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
</script>