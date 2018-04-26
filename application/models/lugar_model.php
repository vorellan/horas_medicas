<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Lugar_model extends CI_Model {

	function grid($p,$o){
	
		//construct where clause 
		$where = "WHERE 1=1";
		
		//BLOQUE FILTRO //@
		if($o->id!='') $where.= " AND id = '$o->id' ";
		if($o->nombre!='') $where.= " AND nombre LIKE '$o->nombre%' ";
		if($o->direccion!='') $where.= " AND direccion LIKE '$o->direccion%' ";
		if($o->comuna!='') $where.= " AND comuna LIKE '$o->comuna%' ";
		if($o->telefono!='') $where.= " AND telefono LIKE '$o->telefono%' ";
		if($o->cont_nombre!='') $where.= " AND cont_nombre LIKE '$o->cont_nombre%' ";
		if($o->cont_mail!='') $where.= " AND cont_mail LIKE '$o->cont_mail%' ";
		if($o->cont_telefono!='') $where.= " AND cont_telefono LIKE '$o->cont_telefono%' ";
		//FIN BLOQUE FILTRO
		
		//PAGINADOR
		$queryCount="SELECT COUNT(*) AS count FROM pi_lugar ".$where;//@
		$resultCount=$this->db->query($queryCount);
		foreach($resultCount->result() as $rsCount){	
			$count =$rsCount->count;
		}
		if( $count >0 ) { $total_pages = ceil($count/$p->limit); } else { $total_pages = 0; } 
		if ($p->page > $total_pages) $p->page=$total_pages; 
		$start = $p->limit*$p->page - $p->limit; 
		//@
		$queryData = "SELECT * FROM pi_lugar ".$where." ORDER BY $p->sidx $p->sord LIMIT $p->limit offset $start "; 
		
		$result = $this->db->query($queryData);
        if ($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result() as $rs){//@
				$response->rows[$i]['id']=$rs->id; 
				$response->rows[$i]['cell']=array($rs->id,$rs->nombre,$rs->direccion,$rs->comuna,$rs->telefono,$rs->cont_nombre,$rs->cont_mail,$rs->cont_telefono);  
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
		"nombre" => $o->nombre,
		"direccion" => $o->direccion,
		"comuna" => $o->comuna,
		"telefono" => $o->telefono,
		"cont_nombre" => $o->cont_nombre,
		"cont_mail" => $o->cont_mail,
		"cont_telefono" => $o->cont_telefono,
		"descripcion" => $o->descripcion
		);

		$result=$this->db->insert("pi_lugar",$query);//@
		
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
		"nombre" => $o->nombre,
		"direccion" => $o->direccion,
		"comuna" => $o->comuna,
		"telefono" => $o->telefono,
		"cont_nombre" => $o->cont_nombre,
		"cont_mail" => $o->cont_mail,
		"cont_telefono" => $o->cont_telefono,
		"descripcion" => $o->descripcion
		);
		$this->db->where("id",$key);//@
		$result=$this->db->update("pi_lugar",$query);//@
		
		if($result)
	    return true;
	    else
	    return false;
	}
	
	//RETORNA TUPLA SOLICITADA
	function verEntidad($key){
		
        $query = "SELECT * FROM pi_lugar WHERE id='$key'  ";
		$result=$this->db->query($query);
        
        foreach ($result->result() as $rs)
		{
			$o=new stdClass();//@
			$o->id=$rs->id;
			$o->nombre=$rs->nombre;
			$o->direccion=$rs->direccion;
			$o->comuna=$rs->comuna;
			$o->telefono=$rs->telefono;
			$o->cont_nombre=$rs->cont_nombre;
			$o->cont_mail=$rs->cont_mail;
			$o->cont_telefono=$rs->cont_telefono;
			$o->descripcion=$rs->descripcion;
			
		}
		return $o;
	}
	
	//ELIMINA 1 TUPLA EN BD
	function eliminar($key){
		
		$this->db->where("id",$key);//@
		$result=$this->db->delete("pi_lugar");//@
	
		if($result)
        return true;
        else
        return false;

	}
	
	
	

}

?>