<?php

class User_Model extends CI_Model
{
	public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }



    public function getMovimiento(){
    $consulta = $this->db->query('SELECT MAX(id_movi) as id FROM movimiento ');
    return $consulta->result();
    }


    public function getUsuarios(){
    $consulta = $this->db->query('select * from users');
    return $consulta->result();
    }


    public function getUsuario($id){
    $consulta = $this->db->query('select * from users where id ='.$id);
    return $consulta->result();
    }


    public function updatesaldo($id,$saldo){
    $consulta = $this->db->query('update users set saldo = '.$saldo.' where id ='.$id);
    return $consulta;
    }



    public function insertmovimiento($data){
    $consulta = $this->db->insert('movimiento', $data);
    return $consulta;
    }

	

}
?>