/*$(function(){
            $('#curp_input').on('change', calcularF);
        });
        
        function calcularF() {
            
			var miCurp = document.getElementById("curp_input").value;
			
			&anio = int( miCurp(&str, 1, 2) )
&mes = int( miCurp(&str, 3, 2) )
&dia = int( miCurp(&str, 5, 2) )
&fecha = ymdtod(&anio, &mes, &dia)
            $('#miCurp').val(fechan);
        }
		




/*
var miCurp = 

$(function(){
	         
            $('#curp_input').on('change', calculaF);
			
        });
function calculaF(curp) {
 
	var m = miCurp.match( /^\w{4}(\w{2})(\w{2})(\w{2})/ );
	//miFecha = new Date(año,mes,dia) 
	var anyo = parseInt(m[1],10)+1900;
	if( anyo < 1950 ) anyo += 100;
	var mes = parseInt(m[2], 10)-1;
	var dia = parseInt(m[3], 10);
	return (new Date( anyo, mes, dia ));
	


}

Date.prototype.toString = function() {
	var anyo = this.getFullYear();
	var mes = this.getMonth()+1;
	if( mes<=9 ) mes = "0"+mes;
	var dia = this.getDate();
	if( dia<=9 ) dia = "0"+dia;
	return anyo+"-"+mes+"-"+dia;
}

	document.write(calculaF(curp));
	
	*/