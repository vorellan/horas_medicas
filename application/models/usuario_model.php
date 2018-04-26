<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Usuario_model extends CI_Model {//@

	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->user_name!='') $where.= " AND user_name LIKE '$o->user_name%' ";
		if($o->password !='') $where.= " AND password LIKE '$o->password%' ";
		if($o->nombre!='') $where.= " AND nombre LIKE '$o->nombre%' ";
		if($o->apellido_paterno!='') $where.= " AND apellido_paterno LIKE '$o->apellido_paterno%' ";
		if($o->apellido_materno!='') $where.= " AND apellido_materno LIKE '$o->apellido_materno%' ";
		if($o->cargo!='') $where.= " AND cargo LIKE '$o->cargo%' ";
		if($o->estado!='') $where.= " AND estado LIKE '$o->estado%' ";
		if($o->rut!='') $where.= " AND rut LIKE '$o->rut%' ";
		if($o->direccion!='') $where.= " AND direccion LIKE '$o->direccion%' ";
		if($o->fecha_nacimiento!='') $where.= " AND fecha_nacimiento LIKE '$o->fecha_nacimiento%' ";
		if($o->especialidad!='') $where.= " AND especialidad LIKE '$o->especialidad%' ";

		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM usuario ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT * FROM usuario ".$where." ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->user_name; 
				$response->rows[$i]['cell']=array($rs->user_name,$rs->password,$rs->nombre,$rs->apellido_paterno,$rs->apellido_materno,$rs->cargo,$rs->estado,$rs->rut,$rs->direccion,$rs->fecha_nacimiento,$rs->especialidad);  
				$i++;
			}
			
		}
		$response->page = $p->page; 
		$response->total = $total_pages; 
		$response->records = $count; 

		return $response;
	}
	
	//INSERTA 1 TUPLA EN BD
	function insertar($o){
		
		//@
		$query=array(
		"user_name" => $o->user_name,
		"password" => $o->password,
		"nombre" => $o->nombre,
		"apellido_paterno" => $o->apellido_paterno,
		"apellido_materno" => $o->apellido_materno,
		"cargo" => $o->cargo,
		"estado" => $o->edad,
		"rut" => $o->rut,
		"direccion" => $o->direccion,
		"fecha_nacimiento" => $o->fecha_nacimiento,
		"especialidad" => $o->especialidad
		);

		$result=$this->db->insert("usuario",$query);//@
		
		if($result)
		return true;
		else
		return false;
	}
	
	
	//ACTUALIZA 1 TUPLA EN BD
	function editar($key,$o){
		//@
		$query=array(
		"user_name" => $o->user_name,
		"password" => $o->password,
		"nombre" => $o->nombre,
		"apellido_paterno" => $o->apellido_paterno,
		"apellido_materno" => $o->apellido_materno,
		"cargo" => $o->cargo,
		"estado" => $o->estado,
		"rut" => $o->rut,
		"direccion" => $o->direccion,
		"fecha_nacimiento" => $o->fecha_nacimiento,
		"especialidad" => $o->especialidad
		);
		$this->db->where("user_name",$key);//@
		$result=$this->db->update("usuario",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA
	function verEntidad($key){
		
        $query = "SELECT * FROM usuario as u WHERE u.user_name='$key' ";
		
		//$query = "SELECT * FROM paciente as p WHERE p.rut='$key' ";
		
		
		//si no tiene fk el and no va y en el select se pone *
		$result=$this->db->query($query);
        
        foreach($result->result() as $rs)
		{
			$o=new stdClass();//@
			$o->user_name=$rs->user_name;
			$o->password=$rs->password;
			$o->nombre=$rs->nombre;
			$o->apellido_paterno=$rs->apellido_paterno;
			$o->apellido_materno=$rs->apellido_materno;
			$o->cargo=$rs->cargo;
			$o->estado=$rs->estado;
			$o->rut=$rs->rut;
			$o->direccion=$rs->direccion;
			$o->fecha_nacimiento=$rs->fecha_nacimiento;
			$o->especialidad=$rs->especialidad;
		}
		return $o;
		
		
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("user_name",$key);//@
		$result=$this->db->delete("usuario");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>