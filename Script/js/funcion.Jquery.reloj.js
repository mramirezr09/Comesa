/* Reloj con Fecha*/
function IniciaReloj() {
	

    var hoy = new Date();
    var hora = hoy.getHours();
    var min = hoy.getMinutes();
    var sec = hoy.getSeconds();
    ap = (hora < 12) ? "<span>a.m.</span>" : "<span>p.m</span>";
    hora = (hora == 0) ? 12 : hora;
    hora = (hora > 12) ? hora - 12 : hora;
    //Add a zero in front of numbers<10
    hora = checkTime(hora);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hora + ":" + min + ":" + sec + " " + ap;
    
    var meses = [
	'Enero', 
	'Febrero', 
	'Marzo', 
	'Abril', 
	'Mayo', 
	'Junio', 
	'Julio', 
	'Agosto', 
	'Septiembre', 
	'Octubre', 
	'Noviembre', 
	'Diciembre'
	];
	
    var dias = 
	['Dom', 
	'Lun', 
	'Mar', 
	'Mie', 
	'Jue', 
	'Vie', 
	'Sab'
	];
	
    var curWeekDay = dias[hoy.getDay()];
    var curDay = hoy.getDate();
    var curMonth = meses[hoy.getMonth()];
    var curYear = hoy.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ IniciaReloj() }, 500);
	var close = setTimeout("window.open('../close','_top');",60000);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}



