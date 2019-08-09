<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contacto</title>
	<script  src="../script/jquery/jquery-2.1.3.min.js"></script>
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
        var myLayout,menu,toolbar,masterGrid,masterForm,myCellA,myCellB,myCellC;
        dhtmlx.image_path = "codebase/img/";
        dhtmlxEvent(window,"load",function(){
            myLayout = new dhtmlXLayoutObject(document.body,"2U");
            myLayout.cells("b").setText("Redes Sociales");
            myLayout.cells("a").setText("Direcciones");   
			myCellA = myLayout.cells('a');
			myCellB = myLayout.cells('b');
			myLayout.cells("b").attachURL("redes.sociales.php");
			myLayout.cells("a").attachURL("direcciones.php");
        });
		function doOnRowSelected(id){
						
		}
		function recargarGrid(){
			//masterGrid.clearAndLoad("data/xml.php");
		}
		function progressOn(fullLayout) {
			if (fullLayout) {
				myLayout.progressOn();
			} else {
				myLayout.cells("b").progressOn();
			}
		}
		function progressOff(fullLayout) {
			if (fullLayout) {
				myLayout.progressOff();
			} else {
				myLayout.cells("b").progressOff();
			}
		}		
    </script>
</head>

<body>
</body>
</html>

