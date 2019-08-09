var vgchars = new Array("Á","É","Í","Ó","Ú",  					//Acentos
					     "Ä","Ë","Ï","Ö","Ü",  					//Dieresis
						 "À","È","Ì","Ò","Ù",					//Acentos Invertidos
						 "à","è","ì","ò","ù",					//Minusculas con Acentos Invertidos
						 "á","é","í","ó","ú",  					//Minúsculas con Acentos
						 "ä","ë","ï","ö","ü",  					//Minúsculas con Dieresis
						 "@","\"","'","`","´","&","~","Ñ","ñ",	//Simbolos	
						 "Â","Ê","Î","Ô","Û", 					//Gorritos
						 "%","+","=","º","ª","²","³",			//Operadores
						 "¡","!","?","¿","{","}",				//Mas simbolos
						 "(",")","[","]","«","“",				//Mas Simbolos
						 "”","£","Ç","¨","^","$","/","\\"		//Mas Simbolos
						 );
						
var vgcodes = new Array("#mAacute;", "#mEacute;", "#mIacute;", "#mOacute;", "#mUacute;",	//Acentos
						 "#mAuml;", "#mEuml;", "#mIuml;", "#mOuml;", "#mUuml;",						//Dieresis
						 "#mAgrave;","#mEgrave;","#mIgrave;","#mOgrave;","#mUgrave;",				//Acentos Invertidos
						 "#magrave;","#megrave;","#migrave;","#mograve;","#mugrave;",				//Minusculas con Acentos Invertidos
						 "#maacute;", "#meacute;", "#miacute;", "#moacute;", "#muacute;",			//Minúsculas con Acentos
						 "#mauml;", "#meuml;", "#miuml;", "#mouml;", "#muuml;",						//Minúsculas con Dieresis
						 "##64;","","","##96;","##146;","#amp;","","#mNtilde;","#mntilde;",			//Simbolos
						 "#mAcirc;","#mEcirc;","#mIcirc;","#mOcirc;","#mUcirc;",					//Gorritos
						 "##37;","##43;","##61;","##176;","##170;","##178;","##179;",				//Operadores
						 "##161;","##33;","##63;","#iquest;","","",									//Mas Simbolos
						 "##40;","##41;","##91;","##93;","##171;","##147;",							//Mas Simbolos
						 "##148;","##163;","#Ccedil;","##168;","","##36;","##47;",""				//Mas Simbolos
						 );

function fgCodeChars(ckdna){
	var nuevacadena = new String();
	nuevacadena = ckdna;
	for(j=0;j<vgchars.length; j++){
	   nuevacadena = fgReplaceAll(nuevacadena, vgchars[j], vgcodes[j]);
	}
	return nuevacadena;
}

function fgDecodeChars(ckdna){
	var nuevacadena = new String();
		nuevacadena = ckdna;
		for(j=0;j<vgcodes.length; j++){
			if (vgcodes[j] != "")
		   		nuevacadena = fgReplaceAll(nuevacadena, vgcodes[j], vgchars[j]);
		}
		return nuevacadena;
}

function fgCrearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}

function fgRunAjaxProc(cMetodo, vAjax, cUrl, cFunction, cParams){
	var cCodeLines = vAjax + "= fgCrearXMLHttpRequest();";
	cCodeLines = cCodeLines +  "fgConnectServer('" + cMetodo + "'," + vAjax + ",'" + cUrl + "'," + cFunction + ",'" + cParams + "');";
	var ajaxrun = new Function(cCodeLines);
	ajaxrun();
}

function fgConnectServer(cmetodo,hLaConexion,curl,cfuncion,cparametros){
	hLaConexion.onreadystatechange = cfuncion;
	if(cmetodo=="GET"){
		hLaConexion.open("GET",curl+"?"+cparametros, true);
		hLaConexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		hLaConexion.send(null);
	}
	else{
		hLaConexion.open("POST",curl, true);
		hLaConexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		hLaConexion.send(cparametros);
	}
}

function fgSwapImage(obj_img,url_img) {
   obj_img.src = url_img;
   return(false);
}

function fgHideLayer(clayer){
  document.getElementById(clayer).style.visibility="hidden";
}

function fgShowLayer(clayer){
  document.getElementById(clayer).style.visibility="visible";
}

function fgMinimizaLayer(clayer){
  document.getElementById(clayer).style.display = "none";
}

function fgMaximizaLayer(clayer){
  document.getElementById(clayer).style.display = "block";
}

function fgTRIM( str ) {
	var resultStr = "";
	resultStr = fgLTRIM(str);
	resultStr = fgRTRIM(resultStr);
	return resultStr;
}

function fgLTRIM( str ) {
	var resultStr = "";
	var i = len = 0;
	if (str+"" == "undefined" || str == null) return null;
	str += "";
	if (str.length == 0) resultStr = "";
	else { 
		len = str.length;
		while ((i <= len) && (str.charAt(i) == " ")) i++;
		resultStr = str.substring(i, len);
	}
	return resultStr;
}

function fgRTRIM( str ) {
	var resultStr = "";
	var i = 0;
	if (str+"" == "undefined" || str == null) return null;
	str += "";
	if (str.length == 0) resultStr = "";
	else {
		i = str.length - 1;
		while ((i >= 0) && (str.charAt(i) == " ")) i--;
		resultStr = str.substring(0, i + 1);
	}
	return resultStr; 
}

function fgReplaceAll(text, strA, strB) 
{
    while ( text.indexOf(strA) != -1)
    {
        text = text.replace(strA,strB);
    }
    return text;
}

//onkeypress="return fgSoloNumeros(event);"
function fgSoloNumeros(evento)
{
   if(window.event) var codigonum = evento.keyCode; // Internet Explorer
   else if(evento.which) var codigonum = evento.which; // Los Demas
   if ((codigonum >= 48 && codigonum <= 57) || (codigonum == 8) || (codigonum == undefined)) return true;
   else return false;
}

//onkeypress="return fgFormatoDecimal(event,this.value);"
function fgFormatoDecimal(evento,obj_valor)
{
   if(window.event) var codigonum = evento.keyCode; // Internet Explorer
   else if(evento.which) var codigonum = evento.which; // Los Demas
   if ((codigonum >= 48 && codigonum <= 57) || (codigonum == 8) || (codigonum == undefined) || (codigonum == 46)){
   		if (codigonum == 46){
			if(obj_valor.indexOf(".") != -1) return false;
			else return true;
		}
		else return true;
   }
   else return false;
}


function fgHideCombos() {
   var x = document.getElementsByTagName('select');
   for (var i=0;i<x.length;i++) x[i].style.visibility = 'hidden';
   return true;
}

function fgShowCombos() {
   var x = document.getElementsByTagName('select');
   for (var i=0;i<x.length;i++) x[i].style.visibility = 'visible';
   return true;
}

function fgLookup(clista,cbusca,cseparador)
{
	var cArrayLista=clista.split(cseparador);
	var iposicion=0;
	if (cArrayLista.length>0){
		for (var icont=0; icont<cArrayLista.length; icont++) {
			if (cbusca==cArrayLista[icont]) return icont+1;
		}
	}
	return iposicion;
}

function fgTomaCamposFormulario(formid){ 
	 var Formulario=document.getElementById(formid); 
	 var longitudFormulario=Formulario.elements.length; 
	 var cadenaFormulario="";
	 var sepCampos;
	 sepCampos = ""; 
	 for (var i=0; i <= Formulario.elements.length-1;i++) { 
	 	cadenaFormulario += sepCampos+Formulario.elements[i].name+'='+Formulario.elements[i].value; 
	 	sepCampos="&"; 
	 } 
	 return cadenaFormulario;
}


function fgIsEnter(evento){
 	var bandera=false;		
	if(window.event) var codigonum = evento.keyCode; // Internet Explorer
	else if(evento.which) var codigonum = evento.which; // Los Demas
	if(codigonum==13){
		bandera=true;
	}
	return bandera;
}
