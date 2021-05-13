function ejercicio(valor){
console.log(valor);	
switch (valor) {
  case 1:
    $("#tituloEjer").text("EJERCICIO #1");
        $.post({
           url: '../educar/app/user/list_usuarios',
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data) {
           		$("#contentAux").html("");
                $("#content").html(data);

           }
        });


    break;


    case 2:
    $("#tituloEjer").text("EJERCICIO #2");
        $.post({
           url: '../educar/app/user/list_usuarios_tabla',
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data) {
           		 $("#contentAux").html("");
                 $("#content").html(data);

           }
        });


    break;



    case 3:
    $("#tituloEjer").text("EJERCICIO #3");
        $.post({
           url: '../educar/app/user/list_usuarios_tabla_recargar',
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data) {
           		   $("#contentAux").html("");
                 $("#content").html(data);
                 saldoUsuario();


           }
        });


    break;


    case 4:
    $("#tituloEjer").text("EJERCICIO #4");
        $.post({
           url: '../educar/app/user/list_usuarios_tabla_trasfe',
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data) {
           		 $("#contentAux").html("");
               $("#content").html(data);
               saldo_usuario();

           }
        });


    break;
  
}	

}


function get_suario(id){

	     $.post({
           url: '../educar/app/user/get_usuario',
           data: {id_usua: id},
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data){
           	$("#contentAux").html(data);
           	
      
           }
        });

}

function saldo_usuario(){
   $.post({
           url: '../educar/app/user/get_saldo',
           data: {id_usua: $("#UsuaEmi").val()},
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data){
           $("#saldo").val(data);
           $("#new_saldo").val(data);
            
      
           }
        });
  
}


function saldoUsuario(){
	 $.post({
           url: '../educar/app/user/get_saldo',
           data: {id_usua: $("#selectUsua").val()},
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data){
   		     $("#saldo").val(data);
           $("#new_saldo").val(data);
           	
      
           }
        });
	
}



function newsaldo3(){
  
  var saldo = $("#entrada").val();
	var oper = $("#saldo").val();

	
  var new_saldo = parseFloat(oper) + parseFloat(saldo);

	$("#new_saldo").val(new_saldo);

}

function newsaldo4(saldo){
	var oper = $("#saldo").val();
	var new_saldo =   parseFloat(oper)-parseFloat(saldo);
	$("#new_saldo").val(new_saldo);

}


function update_saldo(){
	
	var oper = $("#new_saldo").val();
	var ant = $("#saldo").val();
	var id = $("#selectUsua").val();
	var movi = $("#entrada").val();
	


		$.post({
           url: '../educar/app/user/update_saldo',
           data: {id_usua: id, new_saldo: oper, ant_saldo: ant , movi_saldo: movi},
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data){

            $("#contentAux").html(data);
           	
      
           }
        });

}


function transferir(){

  var msj ="";

	var oper   = $("#entrada").val();
	var id_emi = $("#UsuaEmi").val();
	var id_rec = $("#UsuaRece").val();
	var movi = $("#entrada").val();
	var ant = $("#saldo").val();
	var error = 0;
  
  console.log(movi);
  console.log(ant);

  if(parseFloat(movi)>parseFloat(ant)){
  
   error++;
   msj = msj+"El valor de la transferencia es mayor al saldo actual";
  
  }


  if(id_emi==id_rec){
  
  error++;
  msj = msj+", Los usuarios son iguales";
  
  }

  if(error == 0){



		$.post({
           url: '../educar/app/user/transferir_saldo',
           data: {id_emi: id_emi, new_saldo: oper, id_rec: id_rec},
           type: 'POST',
           error: function() {
              alert('Ocurrio un error!');
           },
           success: function(data){
           $("#contentAux").html(data);
           	
      
           }
        });


}else{

      alert(msj);


}    

}


