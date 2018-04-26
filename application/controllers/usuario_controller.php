<?php

class Usuario_controller extends Controller {//@
    private $data;
	private $myModel='Usuario_model';//@
    
    function Usuario_controller(){//@
        parent::Controller();
		$this->load->model($this->myModel,'model');
		$this->load->model('Backend_model','bModel');
    }

	function cargaModulo($nombreTab='',$inputBuscador=false,$keyTab=''){//@ AGREGAR TANTOS KEYTAB COMO FK TENGA LA TABLA
		
		$this->data['inputBuscador']=($inputBuscador=='false')?false:$inputBuscador;
		$this->data['keyTab']=$keyTab;
		$this->data['nombreTab']=$nombreTab;
		$this->data['controller']="usuario_controller";//@lowercase
		$this->data['nombreModulo']="Usuario";//@
        $this->load->view('backend/usuario',$this->data);//@
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
		$o->user_name=(isset($_REQUEST['f_user_name']))?$_REQUEST['f_user_name']:'';
		$o->password=(isset($_REQUEST['f_password ']))?$_REQUEST['f_password']:'';
		$o->nombre=(isset($_REQUEST['f_nombre']))?$_REQUEST['f_nombre']:'';
		$o->apellido_paterno=(isset($_REQUEST['f_apellido_paterno']))?$_REQUEST['f_apellido_paterno']:'';
		$o->apellido_materno=(isset($_REQUEST['f_apellido_materno']))?$_REQUEST['f_apellido_materno']:'';
		$o->cargo=(isset($_REQUEST['f_cargo']))?$_REQUEST['f_cargo']:'';
		$o->estado=(isset($_REQUEST['f_estado']))?$_REQUEST['f_estado']:'';
		$o->rut=(isset($_REQUEST['f_rut']))?$_REQUEST['f_rut']:'';
		$o->direccion=(isset($_REQUEST['f_direccion']))?$_REQUEST['f_direccion']:'';
		$o->fecha_nacimiento=(isset($_REQUEST['f_fecha_nacimiento']))?$_REQUEST['f_fecha_nacimiento']:'';
		$o->especialidad=(isset($_REQUEST['f_especialidad']))?$_REQUEST['f_especialidad']:'';

		
		if($keyTab)//APLICA A FK
		$o->lugar_id=$keyTab;
		
		//INSTANCIA AL MODELO
		$response=$this->model->grid($p,$o);
		echo json_encode($response);
		
	}
	
	function insertar(){
	
		//CREAR OBJETO QUE SE VA A INSERTAR CON LOS $_REQUEST RECIBIDOS DEL FORMULARIO
		$o=new stdClass();//@
		$o->user_name=$_REQUEST['user_name'];
		$o->password=$_REQUEST['password'];
		$o->nombre=$_REQUEST['nombre'];
		$o->apellido_paterno=$_REQUEST['apellido_paterno'];
		$o->apellido_materno=$_REQUEST['apellido_materno'];
		$o->cargo=$_REQUEST['cargo'];
		$o->estado=$_REQUEST['estado'];
		$o->rut=$_REQUEST['rut'];
		$o->direccion=$_REQUEST['direccion'];
		$o->fecha_nacimiento=$_REQUEST['fecha_nacimiento'];
		$o->especialidad=$_REQUEST['especialidad'];

			
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
	    $o->user_name=$_REQUEST['user_name'];
		$o->password=$_REQUEST['password'];
		$o->nombre=$_REQUEST['nombre'];
		$o->apellido_paterno=$_REQUEST['apellido_paterno'];
		$o->apellido_materno=$_REQUEST['apellido_materno'];
		$o->cargo=$_REQUEST['cargo'];
		$o->estado=$_REQUEST['estado'];
		$o->rut=$_REQUEST['rut'];
		$o->direccion=$_REQUEST['direccion'];
		$o->fecha_nacimiento=$_REQUEST['fecha_nacimiento'];
		$o->especialidad=$_REQUEST['especialidad'];

       
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