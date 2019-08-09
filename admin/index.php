<?php
error_reporting(0);
include_once("classes/database.php");
include_once("classes/login.php");
$membership = new Login();
$membership->confirm_Member(); 
$db = new Database();
$db -> connect();

$id_usuario=$_SESSION['id_user'];
$user = $_SESSION['system_user'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN TIXKOKOB-APP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	
	<link rel="stylesheet" type="text/css" href="codebase/skins/tixcocob/dhtmlx.css"/>
	
	<script  src="script/jquery/jquery-1.7.2.min.js"></script>
	<script src="codebase/dhtmlx_2.js"></script>
    
	<style>
		html, body {
			width: 100%;
			height: 100%;
			margin: 0px;
			padding: 0px;
			background-color:#F0F0F0;
			overflow: hidden;
		}
		a{ color:#FFF;}
		.my_header {
	 		 background-color:#F5F5F5;
		}
		.my_footer {
			padding-top:5px; background-color:#053F8E; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;
		}
		.text_block {
			font-family: Roboto, Arial, Helvetica;
			font-size: 14px;
			color: #404040;
			padding: 5px 10px;
			height:20px;
			border: 1px solid #dfdfdf;
		}
	</style>
	<script>
		var myLayout, myMenu, myToolbar, myRibbon, sbObj, mySidebar, myCellA, myCellB, myCellC;
		
		function doOnLoad() {
			myLayout = new dhtmlXLayoutObject({
				parent: "contenido",
				pattern: "2U",
				skin: 'dhx_web',
				cells: [
					{id: "a", text: "Secciones", width: 200},
					{id: "b", text: "Administrador" }
				]
			});
			myCellA = myLayout.cells('a');
			myCellB = myLayout.cells('b');

			mySidebar = myLayout.cells("a").attachSidebar({
				width: 200,
				icons_path: "images/",
				json: "menu.json",
			});
				mySidebar.attachEvent("onSelect", function(id,text){
					cargaURL(id);
				});

			myLayout.cells('a').hideHeader();
			myLayout.cells('b').hideHeader();
			myLayout.cells("b").attachURL("pantalla.php");
			attachToolbar();
			attachStatusBar();

		}
		function cargaURL(URL){
			myCellB.attachURL("cat_"+URL+"/index.php");
			myCellB.setText(URL.toUpperCase());
		}
		function getId() {
			var sel = document.getElementById("sel");
			var id = sel.options[sel.selectedIndex].value;
			return id;
		}
		function progressOn(fullLayout) {
			if (fullLayout) {
				myLayout.progressOn();
			} else {
				myLayout.cells(getId()).progressOn();
			}
		}
		function progressOff(fullLayout) {
			if (fullLayout) {
				myLayout.progressOff();
			} else {
				myLayout.cells(getId()).progressOff();
			}
		}
		// toolbar
		function attachToolbar() {
			if (myToolbar != null) return;
			if (myRibbon != null) detachRibbon();
			myToolbar = myCellB.attachToolbar();
			myToolbar.setIconsPath("images/");
		
			var toolelement=0;
			myToolbar.addSeparator('sep1',toolelement);	
			//myToolbar.addButton('9tilogo',toolelement,"","../images/logo.png");toolelement++;			
			myToolbar.addText('LEYENDA',toolelement,"<b>** H. Ayuntamiento de Tixkokob **</b>");	
			toolelement++;
			myToolbar.addSeparator('sep2',toolelement);	
			toolelement++;
			myToolbar.addButton('sesion',toolelement,"Cerrar Sesion","salir.png");
			myToolbar.setAlign('right');
			myToolbar.attachEvent("onClick", mytoolbarListener);
			checkHeight();
		}
		function detachToolbar() {
			if (myToolbar == null) return;
			myLayout.detachToolbar();
			myToolbar = null;
			checkHeight();
		}
		// status bar
		function attachStatusBar() {
			if (sbObj != null) return;
			sbObj = myLayout.attachStatusBar({text:"<b>USUARIO: <?=$id_usuario;?>. <?=$user;?></b> <center>© Copyright 2019 - 9TINNOVATION.</center>"});	
			checkHeight();
		}
		function detachStatusBar() {
			if (sbObj == null) return;
			myLayout.detachStatusBar();
			sbObj = null;
			checkHeight();
		}
		// fix cells' height
		function checkHeight() {
			myLayout.cells("b").setHeight(Math.round(myLayout.cells("a").getHeight()/2));
		}
		function mytoolbarListener(id){
			if(id=="sesion"){
				document.location.href='user.login.php';
			}
			return true;	
		}
		
	</script>
</head>
<body onload="doOnLoad();">
	<div id="contenido" style="height:99%;"></div>
</body>
</html>