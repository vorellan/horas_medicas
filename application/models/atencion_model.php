<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Atencion_model extends CI_Model {//@

	function Atencion_model(){
		parent::CI_Model();
		$this->load->model('Backend_model','bModel');
	}

	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->id!='') $where.= " AND a.id LIKE '$o->id%' ";
		if($o->paciente_rut!='') $where.= " AND a.paciente_rut LIKE '$o->paciente_rut%' ";
		if($o->examen_id!='') $where.= " AND a.examen_id LIKE '$o->examen_id%' ";
		if($o->usuario_user_name!='') $where.= " AND a.usuario_user_name LIKE '$o->usuario_user_name%' ";
		if($o->descripcion!='') $where.= " AND a.descripcion LIKE '$o->descripcion%' ";
		if($o->fecha!='') $where.= " AND a.fecha LIKE '$o->fecha%' ";
		if($o->confirmacion!='') $where.= " AND a.confirmacion LIKE '$o->confirmacion%' ";

		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM atencion as a ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT a.*,e.nombre as nombreExamen,p.nombre as nombrePaciente,p.apellido_paterno as apellidoPaciente,
		DATE_FORMAT(a.fecha, '%e/%c/%Y %H:%i:%s') as fechaFormat
		FROM atencion as a,examen as e,paciente as p ".$where." 
		and e.id=a.examen_id and p.rut=a.paciente_rut ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->id; 
				$examen=" [".$rs->nombreExamen."]";
				$paciente=" [".$rs->nombrePaciente." ".$rs->apellidoPaciente."]";
				$response->rows[$i]['cell']=array($rs->id,$rs->paciente_rut.$paciente,$rs->examen_id.$examen,$rs->usuario_user_name,$rs->descripcion,$rs->fechaFormat,$rs->confirmacion);  
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
		
		$fecha=$this->bModel->formatDateToBD($o->fecha);
		$fecha.=" ".$o->hora_h.":".$o->hora_m.":00";
		
		//@
		$query=array(
		"id" => $o->id,
		"paciente_rut" => $o->paciente_rut,
		"examen_id" => $o->examen_id,
		"usuario_user_name" => $o->usuario_user_name,
		"descripcion" => $o->descripcion,
		"fecha" => $fecha,
		"confirmacion" => $o->confirmacion
		);

		$result=$this->db->insert("atencion",$query);//@
		
		if($result)
		return true;
		else
		return false;
	}
	
	
	//ACTUALIZA 1 TUPLA EN BD
	function editar($key,$o){
	
		$fecha=$this->bModel->formatDateToBD($o->fecha);
		$fecha.=" ".$o->hora_h.":".$o->hora_m.":00";
	
		//@
		$query=array(
		"id" => $o->id,
		"paciente_rut" => $o->paciente_rut,
		"examen_id" => $o->examen_id,
		"usuario_user_name" => $o->usuario_user_name,
		"descripcion" => $o->descripcion,
		"fecha" => $fecha,
		"confirmacion" => $o->confirmacion
		);
		$this->db->where("id",$key);//@
		$result=$this->db->update("atencion",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA**********************************
	function verEntidad($key){
		
		
        $query = "SELECT a.id,a.paciente_rut,a.examen_id,a.usuario_user_name,a.descripcion,a.fecha,a.confirmacion,
		e.nombre as nombreExamen,p.nombre as nombrePaciente,p.apellido_paterno as apellidoPaciente,
		u.nombre as nombreUsuario, u.apellido_paterno as apellidoUsuario,
		DATE_FORMAT(a.fecha, '%e/%c/%Y') as fechaFormat,
		DATE_FORMAT(a.fecha, '%H') as horaFormat,
		DATE_FORMAT(a.fecha, '%i') as minutoFormat
		FROM atencion as a,examen as e, paciente as p,usuario as u
		WHERE a.id='$key' and p.rut=a.paciente_rut and e.id=a.examen_id and u.user_name=a.usuario_user_name";
		
		
		//$query = "SELECT * FROM atencion as a WHERE a.id='$key' ";
		
		
		//si no tiene fk el and no va y en el select se pone *
		$result=$this->db->query($query);
        
        foreach($result->result() as $rs)
		{
			$o=new stdClass();//@****************************************************+
			$o->id=$rs->id;
			$o->paciente_rut=$rs->paciente_rut;
			$o->paciente_rut_aux=$rs->nombrePaciente." ".$rs->apellidoPaciente;
			$o->examen_id=$rs->examen_id;
			$o->examen_id_aux=$rs->nombreExamen;
			$o->usuario_user_name=$rs->usuario_user_name;
			$o->usuario_user_name_aux=$rs->nombreUsuario." ".$rs->apellidoUsuario;
			$o->descripcion=$rs->descripcion;
			$o->fecha=$rs->fechaFormat;
			$o->hora_h=$rs->horaFormat;
			$o->hora_m=$rs->minutoFormat;
			$o->confirmacion=$rs->confirmacion;

		}
		return $o;
		
		
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("id",$key);//@
		$result=$this->db->delete("atencion");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>