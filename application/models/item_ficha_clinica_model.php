<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Item_ficha_clinica_model extends CI_Model {//@
	
	
	function Item_ficha_clinica_model(){
		parent::CI_Model();
		$this->load->model('Backend_model','bModel');
	}
	
	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->id!='') $where.= " AND id LIKE '$o->id%' ";
		if($o->fecha!='') $where.= " AND fecha LIKE '$o->fecha%' ";
		if($o->observacion!='') $where.= " AND observacion LIKE '$o->observacion%' ";
		if($o->ficha_clinica_id!='') $where.= " AND ficha_clinica_id = '$o->ficha_clinica_id%' ";

		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM item_ficha_clinica ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT *,
		DATE_FORMAT(fecha, '%e/%c/%Y') as fechaFormat
		FROM item_ficha_clinica ".$where." ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->id; 
				$response->rows[$i]['cell']=array($rs->id,$rs->fechaFormat,$rs->observacion,$rs->ficha_clinica_id);  
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
		//@
		$query=array(
		"id" => $o->id,
		"fecha" => $fecha,
		"observacion" => $o->observacion,
		"ficha_clinica_id" => $o->ficha_clinica_id
		);

		$result=$this->db->insert("item_ficha_clinica",$query);//@
		
		if($result)
		return true;
		else
		return false;
	}
	
	
	//ACTUALIZA 1 TUPLA EN BD
	function editar($key,$o){
		$fecha=$this->bModel->formatDateToBD($o->fecha);
		//@
		$query=array(
		"id" => $o->id,
		"fecha" => $fecha,
		"observacion" => $o->observacion,
		"ficha_clinica_id" => $o->ficha_clinica_id
		);
		$this->db->where("id",$key);//@
		$result=$this->db->update("item_ficha_clinica",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA
	function verEntidad($key){
		
		/*
        $query = "SELECT i.id,i.fecha,i.observacion,i.ficha_clinica_id,
		f.id as ficha_clinica_id
		FROM item_ficha_clinica as i,f as ficha_clinica 
		WHERE i.id='$key' and f.id=i.ficha_clinica_id";
		*/
		$query = "SELECT *,
		DATE_FORMAT(fecha, '%e/%c/%Y') as fechaFormat
		FROM item_ficha_clinica as i WHERE i.id='$key' ";
		
		
		//si no tiene fk el and no va y en el select se pone *
		$result=$this->db->query($query);
        
        foreach($result->result() as $rs)
		{
			$o=new stdClass();//@
			$o->id=$rs->id;
			$o->fecha=$rs->fechaFormat;
			$o->observacion=$rs->observacion;
			$o->ficha_clinica_id=$rs->ficha_clinica_id;
			

		}
		return $o;
		
		
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("id",$key);//@
		$result=$this->db->delete("item_ficha_clinica");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>