<!-- CONTENIDO -->
<div class="mensaje" id="mensaje<?=$nombreTab?>"></div>

<?php if(!$inputBuscador){
$this->load->view('backend/comandos');
}?>


<div id="dataGrid<?=$nombreTab?>">
	<table id="grid<?=$nombreTab?>" class="scroll" cellpadding="0" cellspacing="0"></table>
	<div id="paginador<?=$nombreTab?>" class="scroll" style="text-align:center;"></div>
</div>

<?php if(!$inputBuscador){?>
<div id="dataForm<?=$nombreTab?>" style="display:none">
	<form id="form<?=$nombreTab?>Standard" name="form<?=$nombreTab?>Standard"   >
	
	
	<table  class="tabla_form" >
		<tr>
			<th>USERNAME</th>
			<td><input type="text" size="30" id="user_name" name="user_name" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>PASSWORD</th>
			<td><input type="text" id="password" name="password" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>NOMBRE</th>
			<td><input type="text" size="30" id="nombre" name="nombre" value="" class="required"  ></input></td>
		</tr>
		<tr>

			<th>APELLIDO PATERNO</th>
			<td><input type="text" size="30" id="apellido_paterno" name="apellido_paterno" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>APELLIDO MATERNO</th>
			<td><input type="text" size="30" id="apellido_materno" name="apellido_materno" value="" class="required"  ></input></td>
		</tr>
		<tr>

			<th>CARGO</th>
			<td><input type="text" size="30" id="cargo" name="cargo" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>ESTADO</th>
			<td>
			<select name="estado" >
				<option value="activo" >activo</option>
				<option value="inactivo" >inactivo</option>
			</select>
			</td>
		</tr>
		<tr>

			<th>RUT</th>
			<td><input type="text" size="30" id="rut" name="rut" value="" class="required" onchange="Valida_Rut(this);" ></input></td>
		</tr>
		<tr>

			<th>DIRECCION</th>
			<td><input type="text" size="30" id="direccion" name="direccion" value="" class="required"  ></input></td>
		</tr>
		<tr>

			<th>FECHA NACIMIENTO</th>
			<td><input type="text" size="30" id="fecha_nacimiento" name="fecha_nacimiento" value="" class="required"  ></input></td>
		</tr>
		<tr>

			<th>ESPECIALIDAD</th>
			<td><input type="text" size="30" id="especialidad" name="especialidad" value="" class="required"  ></input></td>
		</tr>

		
		<tr>
			<th colspan="2"><input id="btnEnvio<?=$nombreTab?>" type="submit" value=""></input></th>
		</tr>
	
	</table>
	
	
	</form>
	
	<?php $this->load->view('backend/common_ib'); ?>
	
</div>
<?php } ?> 



<script type="text/javascript">

//SCRIPT grid
var mygrid<?=$nombreTab?>=jQuery("#grid<?=$nombreTab?>").jqGrid({
    url:'index.php?/<?=$controller?>/grid/<?=$keyTab?>',  
    datatype: "json",
    width:900,
    height:'auto',
    colNames:['USERNAME','PASSWORD','NOMBRE','APELLIDO PATERNO','APELLIDO MATERNO','CARGO','ESTADO','RUT','DIRECCION','FECHA NACIMIENTO','ESPECIALIDAD'],//@
    colModel:[//@
        {name:'user_name',index:'user_name', width:60},
		{name:'password',index:'password', width:60},
		{name:'nombre',index:'nombre', width:60},
		{name:'apellido_paterno',index:'apellido_paterno', width:60},
		{name:'apellido_materno',index:'apellido_materno', width:60},
		{name:'cargo',index:'cargo', width:60},
		{name:'estado',index:'estado', width:60},
		{name:'rut',index:'rut', width:60},
		{name:'direccion',index:'direccion', width:60},
		{name:'fecha_nacimiento',index:'fecha_nacimiento', width:60},
		{name:'especialidad',index:'especialidad', width:60}
    ],
    pager: jQuery('#paginador<?=$nombreTab?>'),
    rowNum:15,
	rowList:[10,20,30],
    sortname: 'user_name',//@
   	mtype: "POST",
    viewrecords: true,
    sortorder: "asc",
    caption: "<?=$nombreModulo?>",
	multiselect:true,
	
    gridComplete: function() { 
		var firstrow = $("#grid<?=$nombreTab?> tr").attr('id');
		jQuery("#grid<?=$nombreTab?>").setSelection(firstrow);
	},
	
	onCellSelect: function(id , iCol , cellcontent, target) { 																				
		jQuery("#grid<?=$nombreTab?>").resetSelection();
		jQuery("#grid<?=$nombreTab?>").setSelection(id);
	},
	
	ondblClickRow:function(id){
		<?php if(!$inputBuscador){ ?>
		jQuery("#grid<?=$nombreTab?>").resetSelection();
		jQuery("#grid<?=$nombreTab?>").setSelection(id);
		form<?=$nombreTab?>Edit(id);
		<?php }else{ ?>
		fk_usuario_id(id);//@ 
		<?php } ?> 
	}
	
});

//////////////////////

 
<?php if(!$nombreTab || $inputBuscador){ ?>
//SCRIPT FILTRO
mygrid<?=$nombreTab?>.filterToolbar();//DECLARO FILTRO
	<?php if(!$inputBuscador){?>
	mygrid<?=$nombreTab?>[0].toggleToolbar();//OCULTO FILTRO PARA LA PRIMERA VEZ SI ES QUE NO ES INPUT BUSCADOR
	<?php } ?>
//SE ADAPTAN LOS NOMBRES DE LOS FILTROS //@
$("#gs_user_name").attr("id","f_user_name<?=$nombreTab?>");
$("#gs_password").attr("id","f_password<?=$nombreTab?>");
$("#gs_nombre").attr("id","f_nombre<?=$nombreTab?>");
$("#gs_apellido_paterno").attr("id","f_apellido_paterno<?=$nombreTab?>");
$("#gs_apellido_materno").attr("id","f_apellido_materno<?=$nombreTab?>");
$("#gs_cargo").attr("id","f_cargo<?=$nombreTab?>");
$("#gs_estado").attr("id","f_estado<?=$nombreTab?>");
$("#gs_rut").attr("id","f_rut<?=$nombreTab?>");
$("#gs_direccion").attr("id","f_direccion<?=$nombreTab?>");
$("#gs_fecha_nacimiento").attr("id","f_fecha_nacimiento<?=$nombreTab?>");
$("#gs_especialidad").attr("id","f_especialidad<?=$nombreTab?>");



var timeoutHnd<?=$nombreTab?>;
jQuery("table .ui-search-toolbar :input").keyup(function(e){
	if(timeoutHnd<?=$nombreTab?>) {
		clearTimeout(timeoutHnd<?=$nombreTab?>); 
	}
	timeoutHnd<?=$nombreTab?> = setTimeout(grid<?=$nombreTab?>Reload,500);
});

function grid<?=$nombreTab?>Reload(){//@
	var f_user_name = jQuery("#f_user_name<?=$nombreTab?>").val();
	var f_password = jQuery("#f_password<?=$nombreTab?>").val();
	var f_nombre = jQuery("#f_nombre<?=$nombreTab?>").val();
	var f_apellido_paterno = jQuery("#f_apellido_paterno<?=$nombreTab?>").val();
	var f_apellido_materno = jQuery("#f_apellido_materno<?=$nombreTab?>").val();
	var f_cargo = jQuery("#f_cargo<?=$nombreTab?>").val();
	var f_estado = jQuery("#f_estado<?=$nombreTab?>").val();
	var f_rut = jQuery("#f_rut<?=$nombreTab?>").val();
	var f_direccion = jQuery("#f_direccion<?=$nombreTab?>").val();
	var f_fecha_nacimiento = jQuery("#f_fecha_nacimiento<?=$nombreTab?>").val();
	var f_especialidad = jQuery("#f_especialidad<?=$nombreTab?>").val();
	//@
	jQuery("#grid<?=$nombreTab?>").setGridParam({url:"index.php?/<?=$controller?>/grid/<?=$keyTab?>",postData:{"livesearch":true,"f_user_name":f_user_name,"f_password":f_password,"f_nombre":f_nombre,"f_apellido_paterno":f_apellido_paterno,"f_apellido_materno":f_apellido_materno,"f_cargo":f_cargo,"f_estado":f_estado,"f_rut":f_rut,"f_fecha_nacimiento":f_fecha_nacimiento,"f_direccion":f_direccion,"f_especialidad":f_especialidad},page:1}).trigger("reloadGrid");
}
//////////////////////
<?php } ?>

//SCRIPT ELIMINAR
function eliminar<?=$nombreTab?>(id){	
	//ELIMINACION
	$.ajax({
		type: "POST",
		url: 'index.php?/<?=$controller?>/eliminar/'+id,
		
		success: function(datos) {
			json=JSON.parse(datos);
			$('#mensaje<?=$nombreTab?>').html(json.msg);
			$('#mensaje<?=$nombreTab?>').fadeIn(500);
			$('#mensaje<?=$nombreTab?>').fadeOut(2000);
			if(json.exito){//SE HACE LA ELIMINACIÓN CORRECTAMENTE
				$('#dataGrid<?=$nombreTab?>').fadeIn(500);
				$('#dataForm<?=$nombreTab?>').fadeOut(500);
				$('#comandosGrid<?=$nombreTab?>').show();
				$('#comandosForm<?=$nombreTab?>').hide();
				jQuery("#grid<?=$nombreTab?>").clearGridData(true);
				jQuery("#grid<?=$nombreTab?>").setGridParam({url:"index.php?/<?=$controller?>/grid/<?=$keyTab?>",postData:{"livesearch":true},page:1}).trigger("reloadGrid");
			}
        }
		
	});
}
//////////////////////

//SCRIPT FORMULARIOS
function form<?=$nombreTab?>Edit(id){
	$('#dataGrid<?=$nombreTab?>').fadeOut(500);
	$('#dataForm<?=$nombreTab?>').fadeIn(500);
	$('#form<?=$nombreTab?>Standard').attr("action","index.php?/<?=$controller?>/editar/"+id);
	$('#btnEnvio<?=$nombreTab?>').attr("value","Editar");
	$('#comandosGrid<?=$nombreTab?>').hide();
	$('#comandosForm<?=$nombreTab?>').show();
	
	//TRAER DATA PARA LLENAR EL FORM
	$.ajax({
		type: "POST",
		url: "index.php?/<?=$controller?>/verEntidad/"+id,
		success: function(data){
			json=JSON.parse(data);
			//LLENAR EL FORMULARIO CON LOS DATOS //@
			$('#form<?=$nombreTab?>Standard')[0].user_name.value=json.user_name;
			$('#form<?=$nombreTab?>Standard')[0].password.value=json.password;
			$('#form<?=$nombreTab?>Standard')[0].nombre.value=json.nombre;
			$('#form<?=$nombreTab?>Standard')[0].apellido_paterno.value=json.apellido_paterno;
			$('#form<?=$nombreTab?>Standard')[0].apellido_materno.value=json.apellido_materno;
			$('#form<?=$nombreTab?>Standard')[0].cargo.value=json.cargo;
			$('#form<?=$nombreTab?>Standard')[0].estado.value=json.estado;
			$('#form<?=$nombreTab?>Standard')[0].rut.value=json.rut;
			$('#form<?=$nombreTab?>Standard')[0].direccion.value=json.direccion;
			$('#form<?=$nombreTab?>Standard')[0].fecha_nacimiento.value=json.fecha_nacimiento;
			$('#form<?=$nombreTab?>Standard')[0].especialidad.value=json.especialidad;
		}
	});
	
	//SE MUESTRAN LOS IB BUTTON DE ESTE MODULO
	$('#ib_usuario_id').show();
	$('#clean_usuario_id').show();
}

    
// Interceptamos el evento submit
$("#form<?=$nombreTab?>Standard").submit(function(){
	//Formulario valido
	if(!$(this).valid()) return false;
	// Enviamos el formulario usando AJAX
	var url = $(this).attr("action");
    $.ajax({
        type: 'POST',
        url: url,
        data: $(this).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(datos) {
			json=JSON.parse(datos);
			$("#mensaje<?=$nombreTab?>").html(json.msg);
			$('#mensaje<?=$nombreTab?>').fadeIn(500);
			$('#mensaje<?=$nombreTab?>').fadeOut(2000);
			if(json.exito){//SE HACE LA INSERCIÓN CORRECTAMENTE
				$('#dataGrid<?=$nombreTab?>').fadeIn(500);
				$('#dataForm<?=$nombreTab?>').fadeOut(500);
				$('#comandosGrid<?=$nombreTab?>').show();
				$('#comandosForm<?=$nombreTab?>').hide();
				jQuery("#grid<?=$nombreTab?>").clearGridData(true);
				jQuery("#grid<?=$nombreTab?>").setGridParam({url:"index.php?/<?=$controller?>/grid/<?=$keyTab?>",postData:{"livesearch":true},page:1}).trigger("reloadGrid");
			}
        }
    })        
   return false;
}); 
//////////////////////
//VALIDADOR DE FORMULARIOS
$("#form<?=$nombreTab?>Standard").validate();
//////////////////////
////  HASTA AQUI
<?php if($keyTab){ ?>
//FK DEFAULT FOR TAB - SIEMPE SE ASUME 1 KEY TAB
function fk<?=$nombreTab?>Default(){//NO TOCAR
	$('#form<?=$nombreTab?>Standard')[0].usuario_id.value=<?=$keyTab?>;//@
	$('#form<?=$nombreTab?>Standard')[0].usuario_id_aux.value=<?=$keyTab?>;//@
	$('#ib_usuario_id').hide();
	$('#clean_usuario_id').hide();
}
///////
<?php } ?>




<?php if(!$inputBuscador){?>
//CALL INPUT BUSCADOR 
$('#ib_usuario_id').click(function()
	{
		$.ajax({
			type: "POST",
			url: 'index.php?/usuario_controller/cargaModulo/IBUsuario/usuario_id',
			success: function(datos){
				$("#ib_content").html(datos);
				showIB();
			}
		});
	}
);

function fk_lugar_id(valor){//@
	$('#form<?=$nombreTab?>Standard')[0].usuario_id.value=valor;//@
	$('#form<?=$nombreTab?>Standard')[0].usuario_id_aux.value=valor+fkName('IBUsuario',valor,2);//@ 
	$("#ib").hide();
}
//FIN CALL INPUT BUSCADOR 
<?php } ?>



function Valida_Rut( Objeto )
{
	var tmpstr = "";
	var intlargo = Objeto.value
	if (intlargo.length> 0)
	{
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 )
		{
			alert('rut inválido')
			Objeto.focus()
			return false;
		}
		for ( i=0; i <crut.length ; i++ )
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' )
		{
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
	
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);
	
		dv = crut.charAt(largo-1);
	
		if ( rut == null || dv == null )
		return 0;
	
		var dvr = '0';
		suma = 0;
		mul  = 2;
	
		for (i= rut.length-1 ; i>= 0; i--)
		{
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
	
		res = suma % 11;
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else
		{
			dvi = 11-res;
			dvr = dvi + "";
		}
	
		if ( dvr != dv.toLowerCase() )
		{
			alert('El Rut Ingreso es Invalido')
			Objeto.focus()
			return false;
		}
		//alert('El Rut Ingresado es Correcto!')
		Objeto.focus()
		return true;
	}
}



</script>



