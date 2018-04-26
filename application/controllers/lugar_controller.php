<?php

class Lugar_controller extends Controller {
    private $data;
	private $myModel='Lugar_model';//@
    
    function Lugar_controller(){//@
        parent::Controller();
		$this->load->model($this->myModel,'model');
		$this->load->model('Backend_model','bModel');
    }

	
	
	function cargaModulo($nombreTab='',$inputBuscador=false,$keyTab=''){//@ AGREGAR TANTOS KEYTAB COMO FK TENGA LA TABLA
		
		$this->data['inputBuscador']=($inputBuscador=='false')?false:$inputBuscador;
		$this->data['keyTab']=$keyTab;
		$this->data['nombreTab']=$nombreTab;
		$this->data['controller']="lugar_controller";//@lowercase
		$this->data['nombreModulo']="Lugares";//@
        $this->load->view('backend/lugar',$this->data);//@
    }
	
	
	function grid(){
		//PARAMETROS
		$p=new stdClass();
		
		$p->page = $_REQUEST['page']; // get the requested page 
		$p->limit = $_REQUEST['rows']; // get how many rows we want to have into the grid 
		$p->sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort 
		$p->sord = $_REQUEST['sord']; // get the direction 
		
		//OBJETO ENTIDAD PARA FILTRO
		$o=new stdClass();//@
		$o->id=(isset($_REQUEST['f_id']))?$_REQUEST['f_id']:'';
		$o->nombre=(isset($_REQUEST['f_nombre']))?$_REQUEST['f_nombre']:'';
		$o->direccion=(isset($_REQUEST['f_direccion']))?$_REQUEST['f_direccion']:'';
		$o->comuna=(isset($_REQUEST['f_comuna']))?$_REQUEST['f_comuna']:'';
		$o->telefono=(isset($_REQUEST['f_telefono']))?$_REQUEST['f_telefono']:'';
		$o->cont_nombre=(isset($_REQUEST['f_cont_nombre']))?$_REQUEST['f_cont_nombre']:'';
		$o->cont_mail=(isset($_REQUEST['f_cont_mail']))?$_REQUEST['f_cont_mail']:'';
		$o->cont_telefono=(isset($_REQUEST['f_cont_telefono']))?$_REQUEST['f_cont_telefono']:'';
		
		//INSTANCIA AL MODELO
		$response=$this->model->grid($p,$o);
		echo json_encode($response);
		
	}
	
	function insertar(){
	
		//CREAR OBJETO QUE SE VA A INSERTAR CON LOS $_REQUEST RECIBIDOS DEL FORMULARIO
		$o=new stdClass();//@
		//$o->id=$_REQUEST['id'];
		$o->nombre=$_REQUEST['nombre'];
		$o->direccion=$_REQUEST['direccion'];
		$o->comuna=$_REQUEST['comuna'];
		$o->telefono=$_REQUEST['telefono'];
		$o->cont_nombre=$_REQUEST['cont_nombre'];
		$o->cont_mail=$_REQUEST['cont_mail'];
		$o->cont_telefono=$_REQUEST['cont_telefono'];
		$o->descripcion=$_REQUEST['descripcion'];
			
		//INSTANCIA AL MODELO
		$result=$this->model->insertar($o);//RESPUESTA TRUE/FALSE
	
		$response=new StdClass();
		if($result){
			$response->exito=true;
			$response->msg=$this->bModel->MSG_EXITO_INSERTAR;
		}else{
			$response->exito=false;
			$response->msg=$this->bModel->MSG_ERROR_INSERTAR;
		}
		echo json_encode($response); 
	}
	
	function editar($key){
		//CREAR OBJETO QUE SE VA A EDITAR CON LOS $_REQUEST RECIBIDOS DEL FORMULARIO
		$o=new stdClass();//@
		//$o->id=$_REQUEST['id'];
		$o->nombre=$_REQUEST['nombre'];
		$o->direccion=$_REQUEST['direccion'];
		$o->comuna=$_REQUEST['comuna'];
		$o->telefono=$_REQUEST['telefono'];
		$o->cont_nombre=$_REQUEST['cont_nombre'];
		$o->cont_mail=$_REQUEST['cont_mail'];
		$o->cont_telefono=$_REQUEST['cont_telefono'];
		$o->descripcion=$_REQUEST['descripcion'];
       
		//$key DEBE SER LA PK DE LA TABLA, PARAMETRO RECIBIDO DEL ACTION DEL FORMULARIO
		//INSTANCIA AL MODELO
		$result=$this->model->editar($key,$o);//RESPUESTA TRUE/FALSE
			
		$response=new StdClass();
		if($result){
			$response->exito=true;
			$response->msg=$this->bModel->MSG_EXITO_EDITAR;
		}else{
			$response->exito=false;
			$response->msg=$this->bModel->MSG_ERROR_EDITAR;
		}
		echo json_encode($response);
	
	}
	
	function verEntidad($key){
		//INSTANCIA AL MODELO
		$response=$this->model->verEntidad($key);
		echo json_encode($response);
	}
	
	function eliminar($key){
	
		//$key DEBE SER LA PK DE LA TABLA, 
		//INSTANCIA AL MODELO
		$result=$this->model->eliminar($key);
		
		$response=new StdClass();
		if($result){
			$response->exito=true;
			$response->msg=$this->bModel->MSG_EXITO_ELIMINAR;
		}else{
			$response->exito=false;
			$response->msg=$this->bModel->MSG_ERROR_ELIMINAR;
		}
		echo json_encode($response);
	
	}
    
	
}
