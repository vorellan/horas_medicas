<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Ficha_Clinica_model extends CI_Model {//@

	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->id!='') $where.= " AND f.id LIKE '$o->id%' ";
		if($o->grupo_sanguineo!='') $where.= " AND f.grupo_sanguineo LIKE '$o->grupo_sanguineo%' ";
		if($o->enfermedades!='') $where.= " AND f.enfermedades LIKE '$o->enfermedades%' ";
		if($o->operaciones!='') $where.= " AND f.operaciones LIKE '$o->operaciones%' ";
		if($o->item_ficha_clinica_id!='') $where.= " AND f.item_ficha_clinica_id LIKE '$o->item_ficha_clinica_id%' ";
		if($o->paciente_rut!='') $where.= " AND f.paciente_rut LIKE '$o->paciente_rut%' ";

		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM ficha_clinica as f ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT f.*,p.nombre as nombrePaciente,p.apellido_paterno as apellidoPaciente
		FROM ficha_clinica as f,paciente as p
		".$where." and p.rut=f.paciente_rut ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->id; 
				$paciente=" [".$rs->nombrePaciente." ".$rs->apellidoPaciente."]";
				$response->rows[$i]['cell']=array($rs->id,$rs->grupo_sanguineo,$rs->enfermedades,$rs->operaciones,$rs->paciente_rut.$paciente);  
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
		"id" => $o->id,
		"grupo_sanguineo" => $o->grupo_sanguineo,
		"enfermedades" => $o->enfermedades,
		"operaciones" => $o->operaciones,
		"paciente_rut" => $o->paciente_rut
		);

		$result=$this->db->insert("ficha_clinica",$query);//@
		
		if($result)
		return true;
		else
		return false;
	}
	
	
	//ACTUALIZA 1 TUPLA EN BD
	function editar($key,$o){
		//@
		$query=array(
		"id" => $o->id,
		"grupo_sanguineo" => $o->grupo_sanguineo,
		"enfermedades" => $o->enfermedades,
		"operaciones" => $o->operaciones,
		"paciente_rut" => $o->paciente_rut
		);
		$this->db->where("id",$key);//@
		$result=$this->db->update("ficha_clinica",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA********************
	function verEntidad($key){
		
		
        $query = "SELECT f.id,f.grupo_sanguineo,f.enfermedades,f.operaciones,f.item_ficha_clinica_id,f.paciente_rut,
		p.nombre as nombrePaciente,p.apellido_paterno as apellidoPaciente
		FROM ficha_clinica as f,paciente as p
		WHERE f.id='$key' and p.rut = f.paciente_rut ";
		
		//$query = "SELECT * FROM ficha_clinica as f WHERE f.id='$key' ";
		
		
		//si no tiene fk el and no va y en el select se pone *
		$result=$this->db->query($query);
        
        foreach($result->result() as $rs)
		{
			$o=new stdClass();//@
			$o->id=$rs->id;
			$o->grupo_sanguineo=$rs->grupo_sanguineo;
			$o->enfermedades=$rs->enfermedades;
			$o->operaciones=$rs->operaciones;
			$o->paciente_rut=$rs->paciente_rut;
			$o->paciente_rut_aux=$rs->nombrePaciente." ".$rs->apellidoPaciente;/*************************************************/
		}
		return $o;
		
		
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("id",$key);//@
		$result=$this->db->delete("ficha_clinica");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>