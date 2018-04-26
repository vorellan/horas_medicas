<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Paciente_model extends CI_Model {//@

	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->rut!='') $where.= " AND p.rut LIKE '$o->rut%' ";
		if($o->prevision_id!='') $where.= " AND p.prevision_id LIKE '$o->prevision_id%' ";
		if($o->nombre!='') $where.= " AND p.nombre LIKE '$o->nombre%' ";
		if($o->apellido_paterno!='') $where.= " AND p.apellido_paterno LIKE '$o->apellido_paterno%' ";
		if($o->apellido_materno!='') $where.= " AND p.apellido_materno LIKE '$o->apellido_materno%' ";
		if($o->fecha_nacimiento!='') $where.= " AND p.fecha_nacimiento LIKE '$o->fecha_nacimiento%' ";
		if($o->edad!='') $where.= " AND p.edad LIKE '$o->edad%' ";
		if($o->direccion!='') $where.= " AND p.direccion LIKE '$o->direccion%' ";

		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM paciente as p ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT p.*,pr.nombre as nombrePrevision FROM paciente as p,prevision as pr ".$where." AND pr.id=p.prevision_id ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->rut; 
				$prevision=" [".$rs->nombrePrevision."]";
				$response->rows[$i]['cell']=array($rs->rut,$rs->prevision_id.$prevision,$rs->nombre,$rs->apellido_paterno,$rs->apellido_materno,$rs->fecha_nacimiento,$rs->edad,$rs->direccion);  
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
		"rut" => $o->rut,
		"prevision_id" => $o->prevision_id,
		"nombre" => $o->nombre,
		"apellido_paterno" => $o->apellido_paterno,
		"apellido_materno" => $o->apellido_materno,
		"fecha_nacimiento" => $o->fecha_nacimiento,
		"edad" => $o->edad,
		"direccion" => $o->direccion
		);

		$result=$this->db->insert("paciente",$query);//@
		
		if($result)
		return true;
		else
		return false;
	}
	
	
	//ACTUALIZA 1 TUPLA EN BD
	function editar($key,$o){
		//@
		$query=array(
		"rut" => $o->rut,
		"prevision_id" => $o->prevision_id,
		"nombre" => $o->nombre,
		"apellido_paterno" => $o->apellido_paterno,
		"apellido_materno" => $o->apellido_materno,
		"fecha_nacimiento" => $o->fecha_nacimiento,
		"edad" => $o->edad,
		"direccion" => $o->direccion
		);
		$this->db->where("rut",$key);//@
		$result=$this->db->update("paciente",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA
	function verEntidad($key){
		
        
		$query = "SELECT p.rut,p.prevision_id,p.nombre,p.apellido_paterno,p.apellido_materno,p.fecha_nacimiento,p.edad,p.direccion,
		pr.nombre as nombrePrevision
		FROM paciente as p,prevision as pr 
		WHERE p.rut='$key' and pr.id=p.prevision_id ";
		
		//$query = "SELECT * FROM paciente as p WHERE p.rut='$key' ";
		
		
		//si no tiene fk el and no va y en el select se pone *
		$result=$this->db->query($query);
        
        foreach($result->result() as $rs)
		{
			$o=new stdClass();//@
			$o->rut=$rs->rut;
			$o->prevision_id=$rs->prevision_id;
			$o->prevision_id_aux=$rs->nombrePrevision;
			$o->nombre=$rs->nombre;
			$o->apellido_paterno=$rs->apellido_paterno;
			$o->apellido_materno=$rs->apellido_materno;
			$o->fecha_nacimiento=$rs->fecha_nacimiento;
			$o->edad=$rs->edad;
			$o->direccion=$rs->direccion;
		}
		return $o;
		
		
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("id",$key);//@
		$result=$this->db->delete("paciente");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>