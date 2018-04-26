<?php

class Ficha_Clinica_controller extends Controller {//@
    private $data;
	private $myModel='Ficha_Clinica_model';//@
    
    function Ficha_Clinica_controller(){//@
        parent::Controller();
		$this->load->model($this->myModel,'model');
		$this->load->model('Backend_model','bModel');
    }

	function cargaModulo($nombreTab='',$inputBuscador=false,$keyTab='',$keyTab=''){//@ AGREGAR TANTOS KEYTAB COMO FK TENGA LA TABLA******************************
		
		$this->data['inputBuscador']=($inputBuscador=='false')?false:$inputBuscador;
		$this->data['keyTab']=$keyTab;
		$this->data['nombreTab']=$nombreTab;
		$this->data['controller']="ficha_clinica_controller";//@lowercase
		$this->data['nombreModulo']="Ficha_Clinica";//@
        $this->load->view('backend/ficha_clinica',$this->data);//@
    }
	
	function grid($keyTab=''){
		//PARAMETROS
		$p=new stdClass();
		
		$p->page = $_REQUEST['page']; // get the requested page 
		$p->limit = $_REQUEST['rows']; // get how many rows we want to have into the grid 
		$p->sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort 
		$p->sord = $_REQUEST['sord']; // get the direction 
		
		//OBJETO ENTIDAD PARA FILTRO
		$o=new stdClass();//@
		$o->id=(isset($_REQUEST['f_id']))?$_REQUEST['f_id']:'';
		$o->grupo_sanguineo=(isset($_REQUEST['f_grupo_sanguineo']))?$_REQUEST['f_grupo_sanguineo']:'';
		$o->enfermedades=(isset($_REQUEST['f_enfermedades']))?$_REQUEST['f_enfermedades']:'';
		$o->operaciones=(isset($_REQUEST['f_operaciones']))?$_REQUEST['f_operaciones']:'';
		$o->item_ficha_clinica_id=(isset($_REQUEST['f_item_ficha_clinica_id']))?$_REQUEST['f_item_ficha_clinica_id']:'';
		$o->paciente_rut=(isset($_REQUEST['f_paciente_rut']))?$_REQUEST['f_paciente_rut']:'';
	
	
		if($keyTab)//APLICA A FK
		$o->lugar_id=$keyTab;
		
		//INSTANCIA AL MODELO
		$response=$this->model->grid($p,$o);
		echo json_encode($response);
		
	}
	
	function insertar(){
	
		//CREAR OBJETO QUE SE VA A INSERTAR CON LOS $_REQUEST RECIBIDOS DEL FORMULARIO
		$o=new stdClass();//@
		$o->id=$_REQUEST['id'];
		$o->grupo_sanguineo=$_REQUEST['grupo_sanguineo'];
		$o->enfermedades=$_REQUEST['enfermedades'];
		$o->operaciones=$_REQUEST['operaciones'];
		$o->paciente_rut=$_REQUEST['paciente_rut'];
	
			
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
		$o->id=$_REQUEST['id'];
		$o->grupo_sanguineo=$_REQUEST['grupo_sanguineo'];
		$o->enfermedades=$_REQUEST['enfermedades'];
		$o->operaciones=$_REQUEST['operaciones'];
		$o->paciente_rut=$_REQUEST['paciente_rut'];
		
		

       
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
