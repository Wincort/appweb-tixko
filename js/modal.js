function PintarModal(d,c){document.getElementById(c);modal=document.getElementById(d);modal.style.display="block";var a=document.getElementsByClassName("close"),b;for(b in a)a[b].onclick=function(){modal.style.display="none"};window.onclick=function(a){a.target==modal&&(modal.style.display="none")}};