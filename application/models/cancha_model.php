<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Cancha_model extends CI_Model {

	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->id!='') $where.= " AND id = '$o->id' ";
		if($o->numero!='') $where.= " AND numero = '$o->numero' ";
		if($o->costo!='') $where.= " AND costo = '$o->costo' ";
		if($o->lugar_id!='') $where.= " AND lugar_id = '$o->lugar_id' ";
		if($o->modalidad!='') $where.= " AND modalidad LIKE '$o->modalidad%' ";
		if($o->superficie!='') $where.= " AND superficie LIKE '$o->superficie%' ";
		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM pi_cancha ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT * FROM pi_cancha ".$where." ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->id; 
				$response->rows[$i]['cell']=array($rs->id,$rs->numero,$rs->costo,$rs->lugar_id,$rs->modalidad,$rs->superficie);  
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
		//"id" => $o->id,
		"numero" => $o->numero,
		"costo" => $o->costo,
		"lugar_id" => $o->lugar_id,
		"modalidad" => $o->modalidad,
		"superficie" => $o->superficie
		);

		$result=$this->db->insert("pi_cancha",$query);//@
		
		if($result)
		return true;
		else
		return false;
	}
	
	
	//ACTUALIZA 1 TUPLA EN BD
	function editar($key,$o){
		//@
		$query=array(
		//"id" => $o->id,
		"numero" => $o->numero,
		"costo" => $o->costo,
		"lugar_id" => $o->lugar_id,
		"modalidad" => $o->modalidad,
		"superficie" => $o->superficie
		);
		$this->db->where("id",$key);//@
		$result=$this->db->update("pi_cancha",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA
	function verEntidad($key){
		
        $query = "SELECT c.id,c.numero,c.costo,c.lugar_id,c.modalidad,c.superficie,l.nombre as nombreLugar FROM pi_cancha as c,pi_lugar as l 
		WHERE c.id='$key' and l.id=c.lugar_id ";
		$result=$this->db->query($query);
        
        foreach ($result->result() as $rs)
		{
			$o=new stdClass();//@
			$o->id=$rs->id;
			$o->numero=$rs->numero;
			$o->costo=$rs->costo;
			$o->lugar_id=$rs->lugar_id;
			$o->lugar_id_aux=$rs->nombreLugar;
			$o->modalidad=$rs->modalidad;
			$o->superficie=$rs->superficie;
			
		}
		return $o;
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("id",$key);//@
		$result=$this->db->delete("pi_cancha");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>