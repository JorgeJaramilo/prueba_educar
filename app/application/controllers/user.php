<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	
    public function __construct() {
        

    	header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Allow: GET, POST, OPTIONS, PUT, DELETE");

        parent::__construct();
         
        
        $this->load->helper("url"); 
         
        
        $this->load->model("User_Model");
              
    }
     


	public function list_usuarios(){

 	$consulta = $this->User_Model->getUsuarios();

 	$result = '<table class="table table-hover table-dark table-bordered">
	<thead>
	    <tr>
	      <th scope="col">MÉTODO</th>
	      <th scope="col">RUTA API</th>
	      <th scope="col">RESULTADO</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>GET</td>
	      <td>http://localhost/educar/app/user/lista_usuarios</td>
	      <td>'.(json_encode($consulta)).'</td>
	    </tr>
	  </tbody>
	</table>';

	echo $result;
 	
	}


	public function list_usuarios_tabla(){


	$consulta = $this->User_Model->getUsuarios();
	
	$result = '<div class="table-responsive-lg"><table class="table table-hover table-bordered">
	<thead>
	    <tr>
	      <th scope="col" >NOMBRE Y APELLIDO</th>
	      <th scope="col">CONSULTAR PROPIEDADES</th>
	    </tr>
	  </thead>
	  <tbody>
	  ';

	  foreach ($consulta as $key){
	  	
	  	$result .= '<tr>
	  	<td  >'.$key->nombre.' '.$key->apellidos.'</td>
	  	<td><button type="button" class="btn btn-success" onclick="get_suario('.$key->id.')";>CONSULTAR</button></td>
	  	</tr>';

	  }


	$result .= '</tbody></table></div>';

	echo $result;
 	
	}	



	public function get_usuario(){


	$consulta = $this->User_Model->getUsuario($this->input->post('id_usua'));
	$result = '<div class="table-responsive-lg">
<table class="table table-hover table-dark table-bordered">
	<thead>
	    <tr>
	      <th scope="col">MÉTODO</th>
	      <th scope="col">RUTA API</th>
	      <th scope="col">DATA</th>
	      <th scope="col">RESULTADO</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	       <td>POST</td>
	      <td>http://localhost/educar/app/user/get_usuario</td>
	       <td>data: {id_usua: id}</td>
	      <td>'.(json_encode($consulta)).'</td>
	    </tr>
	  </tbody>
	</table></div>';


	echo $result;

	}

 	public function list_usuarios_tabla_recargar(){


	$consulta = $this->User_Model->getUsuarios();
	
	$result = '<div class="table-responsive-lg"><table class="table table-hover  table-bordered">
	<thead>
	    <tr>
	      <th scope="col" >USUARIO</th>
	      <th scope="col">SALDO ACTUAL</th>
	      <th scope="col">VALOR RECARGA</th>
	      <th scope="col">NUEVO SALDO</th>
	    </tr>
	  </thead>
	  <tbody>
	  ';

	$select = '<div class="input-group mb-3"><select class="form-select" id="selectUsua"  aria-label="Default select example" onchange = "saldoUsuario()";"">';
	$select .= '';
  	foreach ($consulta as $key){
  	$select .='<option value="'.$key->id.'">'.$key->nombre.' '.$key->apellidos.'</option>';
  	}
  	$select .= '</select></div>';

  	$result .= '<tr><td>'.$select.'</td>

  	<td>
  	<div class="input-group mb-3">
  	<span class="input-group-text">$</span>
  	<input type="number" class="form-control" id="saldo" readonly>
	</div>
  	</td>

  	<td>
  	<div class="input-group mb-3">
  	<span class="input-group-text">$</span>
  	<input type="number" class="form-control" onkeyup="newsaldo3(this.value)" id="entrada" value=0 min="0">
	</div>
  	</td>

  	<td>
  	<div class="input-group mb-3">
  	<span class="input-group-text">$</span>
  	<input type="number" class="form-control" id="new_saldo" readonly>
	</div>
  	</td>

  	<td>
  	<button type="button" class="btn btn-secondary" onclick="update_saldo()";>RECARGAR</button>
  	</td>
  	</tr>


  	';

	$result .= '</tbody></table></div>';

	echo $result;
 	
	}



	public function get_saldo(){
	$consulta = $this->User_Model->getUsuario($this->input->post('id_usua'));
	echo $consulta[0]->saldo;
	}


	public function update_saldo(){

	$fechaActual = date('Y-m-d');
	$horaActual = date('H:i:s');
	
	$data = array(
		"id_movi"=> "",
		"id_usu"=> $this->input->post('id_usua'),
		"saldo_ant"=> $this->input->post('ant_saldo'),
		"saldo_nue"=> $this->input->post('new_saldo'),
		"fech_mov" => $fechaActual,
		"hora_mov" => $horaActual,
		"tipo_mov" => 1,
		"usua_mov" => $this->input->post('id_usua'),
		"saldo_mov" => $this->input->post('movi_saldo')

	);

	$consulta = $this->User_Model->updatesaldo($this->input->post('id_usua'),$this->input->post('new_saldo'));
	switch ($consulta) {
		case 1:
			$consulta = $this->User_Model->insertmovimiento($data);
			$r = json_encode(array("result"=>true,"mensaje"=>"Datos Actualizados Correctamente")); 
			break;
		case 0:
			$r = json_encode(array("result"=>false,"mensaje"=>"Error!")); 
			break;	
		

	}


	$result = '<div class="table-responsive-lg">
	<table class="table table-hover table-dark table-bordered">
	<thead>
	    <tr>
	      <th scope="col">MÉTODO</th>
	      <th scope="col">RUTA API</th>
	      <th scope="col">DATA</th>
	      <th scope="col">RESULTADO</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	       <td>POST</td>
	      <td>http://localhost/educar/app/user/update_saldo</td>
	      <td>data: {id_usua: id_usuario, new_saldo: saldo_nuevo, ant_saldo: saldo_anterior, movi_saldo: valor_recargado}</td>
	      <td>'.($r).'</td>
	    </tr>
	  </tbody>
	</table></div>';


	echo $result;


	
	}


 	public function list_usuarios_tabla_trasfe(){


	$consulta = $this->User_Model->getUsuarios();
	
	$result = '<div class="table-responsive-lg"><table class="table table-hover  table-bordered">
	<thead>
	    <tr>
	      <th scope="col">USUARIO EMISOR</th>
	      <th scope="col">SALDO ACTUAL</th>
	      <th scope="col">VALOR TRANSFERENCIA</th>
	      <th scope="col">USUARIO RECEPTOR</th>
	      <th scope="col">NUEVO SALDO</th>
	    </tr>
	  </thead>
	  <tbody>
	  ';

	$select = '<div class="input-group mb-3"><select class="form-select" id="UsuaEmi"  aria-label="Default select example" onchange = "saldo_usuario(this.value)";"">';
	$select .= '';
  	foreach ($consulta as $key){
  	$select .='<option value="'.$key->id.'">'.$key->nombre.' '.$key->apellidos.'</option>';
  	}
  	$select .= '</select></div>';


  	$select_ = '<div class="input-group mb-3"><select class="form-select" id="UsuaRece"  aria-label="Default select example" >';
	$select_ .= '';
  	foreach ($consulta as $key){
  	$select_ .='<option value="'.$key->id.'">'.$key->nombre.' '.$key->apellidos.'</option>';
  	}
  	$select_ .= '</select></div>';

  	$result .= '<tr><td>'.$select.'</td>

  	<td>
  	<div class="input-group mb-3">
  	<span class="input-group-text">$</span>
  	<input type="number" class="form-control" id="saldo" readonly>
	</div>
  	</td>

  	<td>
  	<div class="input-group mb-3">
  	<span class="input-group-text">$</span>
  	<input type="number" class="form-control" onkeyup="newsaldo4(this.value)" id="entrada" value=0>
	</div>
  	</td>

  	<td>'.$select_.'</td>

  	<td>
  	<div class="input-group mb-3">
  	<span class="input-group-text">$</span>
  	<input type="number" class="form-control" id="new_saldo" readonly>
	</div>
  	</td>

  	<td>
  	<button type="button" class="btn btn-secondary" onclick="transferir()";>TRANSFERIR</button>
  	</td>
  	</tr>


  	';

	$result .= '</tbody></table></div>';

	echo $result;
 	
	}


	public function transferir_saldo(){


	$fechaActual = date('Y-m-d');
	$horaActual = date('H:i:s');

	$error = 0;

	// UPDATE DATOS USUARIO EMISOR

	

	$consulta = $this->User_Model->getUsuario($this->input->post('id_emi'));

	$saldoEmi = $consulta[0]->saldo-$this->input->post('new_saldo');

	


	$data = array(
		"id_movi"=> "",
		"id_usu"=> $this->input->post('id_emi'),
		"saldo_ant"=> $consulta[0]->saldo,
		"saldo_nue"=> $saldoEmi,
		"fech_mov" => $fechaActual,
		"hora_mov" => $horaActual,
		"tipo_mov" => 2,
		"usua_mov" => $this->input->post('id_rec'),
		"saldo_mov" => $this->input->post('new_saldo')

	);
	$consulta = $this->User_Model->insertmovimiento($data);


	$consulta = $this->User_Model->updatesaldo($this->input->post('id_emi'),$saldoEmi);


	if($consulta != 1){
	$error++;	
	}

	// UPDATE DATOS USUARIO RECEPTOR


	$consulta = $this->User_Model->getUsuario($this->input->post('id_rec'));

	$saldoRec = $consulta[0]->saldo+$this->input->post('new_saldo');

	




		$data = array(
		"id_movi"=> "",
		"id_usu"=> $this->input->post('id_rec'),
		"saldo_ant"=> $consulta[0]->saldo,
		"saldo_nue"=> $saldoRec,
		"fech_mov" => $fechaActual,
		"hora_mov" => $horaActual,
		"tipo_mov" => 3,
		"usua_mov" => $this->input->post('id_emi'),
		"saldo_mov" => $this->input->post('new_saldo')

	);
	$consulta = $this->User_Model->insertmovimiento($data);

	$consulta = $this->User_Model->updatesaldo($this->input->post('id_rec'),$saldoRec);


	if($consulta != 1){
	$error++;	
	}

	if($error==0){

		$r = json_encode(array("result"=>true,"mensaje"=>"Datos Actualizados Correctamente")); 	
	}else{
	    $r = json_encode(array("result"=>false,"mensaje"=>"Error!")); 
	}


	$result = '<div class="table-responsive-lg">
	<table class="table table-hover table-dark table-bordered">
	<thead>
	    <tr>
	      <th scope="col">MÉTODO</th>
	      <th scope="col">RUTA API</th>
	      <th scope="col">DATA</th>
	      <th scope="col">RESULTADO</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>POST</td>
	      <td>data: {id_emi: id_emisor, valor_trans: valor_transferencia, id_rec: id_receptor}</td>
	      td>POST</td>
	      <td>'.($r).'</td>
	    </tr>
	  </tbody>
	</table></div>';


	echo $result;	


	
	
	}






 	





}

