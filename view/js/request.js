var http_request = false;

function makeRequest(opcao,curso) {
	url = "controller/CarregaPeriodos.php";
http_request = false;
	if (window.XMLHttpRequest) { // Mozilla, Safari,...
			http_request = new XMLHttpRequest();
			if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/xml');
			// See note below about this line
			}
	} else if (window.ActiveXObject) { // IE
				try {
				http_request = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
					http_request = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {}
				}
			}
if (!http_request) {
	alert('Giving up :( Cannot create an XMLHTTP instance');
	return false; 
	}
	

		http_request.onreadystatechange = alertContents;
		http_request.open('GET', url+'?curso='+curso+'&periodo=0&turno='+opcao, true);

	http_request.send(null);
}

function alertContents() {
	var periodos = document.getElementById("periodoCurso");
/*	if(tipo == 'turno'){
		var periodos = document.getElementById("turnoCurso");
	}else{
		var periodos = document.getElementById("periodoCurso");
	}
	
	var novaInfo = document.createElement("option");*/
	//periodos.parentNode.removeChild(novaInfo);

/*	
	var loading = document.getElementById("loading");
	if (http_request.readyState != 4){
		loading.style.display = "block";
		minhaDiv.style.display = "block";
	}*/
	if (http_request.readyState == 4) { 
		if (http_request.status == 200) { 
			
			//loading.style.display = "none";
			
			/*novaInfo.innerHTML = http_request.responseText;
			periodos.appendChild(novaInfo);*/
			
			periodos.innerHTML = http_request.responseText
			
			//alert(http_request.responseText); 
		} else {
		alert('There was a problem with the request.');
		} 
	}
} 