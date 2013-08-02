// JavaScript Document
function obtenXHR(){
	//instanciamos el objeto XMLHttpRequest() dependiendo del navegador
	var req = false;
	var ActiveXObject = null;
	
	if(window.XMLHttpRequest){
		//todos los navegadores excepto internet Exprorer x
		req = new  XMLHttpRequest();
	}
	else{
		//Para internet exprorer, debemos verificar que la instancias del objeto cumpla con la version
		if(ActiveXObject){
			//Definimos unn vector con las distintas posibilidades
			var vectorVersiones = ["MSXML2.XMLHttp.5.0","MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0","MSXML2.XMLHttp","Microsoft.XMLHttp"];
			
			//Lo recorremos e intentamos instanciar cada uno
			for(var i=0; i < vectorVersiones.length; i++){
				try{
					req = new ActiveXObject(vertorVersiones[i])
					return req;
				}catch(e){
				}
			}
		}
	}
	return req;
}


	