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
		<th>ID</th>
		<td><input type="text" size="30" id="id" name="id" value="" class="readonly" readonly ></input></td>
		</tr>
		<tr>
			<th>PACIENTE</th>
			<td><input type="hidden" id="paciente_rut" name="paciente_rut" value="" ><input type="text" size="30" id="paciente_rut_aux" name="paciente_rut_aux" value="" class="required readonly"  readonly ></input>

			<span id="ib_paciente_rut" class="ibButton"></span>
			<span id="clean_paciente_rut" class="cleanButton" onclick="javascript:limpiar('paciente_rut');limpiar('paciente_rut_aux')"></span></td>
		</tr>
		<tr>
		<tr>
			<th>EXAMEN</th>
			<td><input type="hidden" id="examen_id" name="examen_id" value="" ><input type="text" size="30" id="examen_id_aux" name="examen_id_aux" value="" class="required readonly"  readonly ></input>

			<span id="ib_examen_id" class="ibButton"></span>
			<span id="clean_examen_id" class="cleanButton" onclick="javascript:limpiar('examen_id');limpiar('examen_id_aux')"></span></td>
		</tr>
		<tr>
			<th>USUARIO</th>
			<td><input type="hidden" id="usuario_user_name" name="usuario_user_name" value="" ><input type="text" size="30" id="usuario_user_name_aux" name="usuario_user_name_aux" value="" class="required readonly"  readonly ></input>

			<span id="ib_usuario_user_name" class="ibButton"></span>
			<span id="clean_usuario_user_name" class="cleanButton" onclick="javascript:limpiar('usuario_user_name');limpiar('usuario_user_name_aux')"></span></td>
		</tr>
		
		<tr>
			<th>DESCRIPCION</th>
			<td><input type="text" size="30" id="descripcion" name="descripcion" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>FECHA</th>
			<td><input type="text" size="30" id="fecha" name="fecha" value="" class="required"  ></input></td>
		</tr>
		
		<tr>
			<th>HORA</th>
			<td>
			<select name="hora_h" >
				<option value="08" >8 A.M</option>
				<option value="09" >9 A.M</option>
				<option value="10" >10 A.M</option>
				<option value="11" >11 A.M</option>
				<option value="12" >12 P.M</option>
				<option value="13" >13 P.M</option>
				<option value="14" >14 P.M</option>
				<option value="15" >15 P.M</option>
				<option value="16" >16 P.M</option>
				<option value="17" >17 P.M</option>
				<option value="18" >18 P.M</option>
				<option value="19" >19 P.M</option>
				<option value="20" >20 P.M</option>
				<option value="21" >21 P.M</option>
				<option value="22" >22 P.M</option>
				<option value="23" >23 P.M</option>
				<option value="00" >00 A.M</option>
				<option value="01" >1 A.M</option>
				<option value="02" >2 A.M</option>
				<option value="03" >3 A.M</option>
				<option value="04" >4 A.M</option>
				<option value="05" >5 A.M</option>
				<option value="06" >6 A.M</option>
				<option value="07" >7 A.M</option>
			</select>
			:
			<select name="hora_m" >
				<?php
				for($i=0;$i<=59;$i++){
					if($i<=9)
					$option='<option value="0'.$i.'" >0'.$i.'</option>';
					else
					$option='<option value="'.$i.'" >'.$i.'</option>';
					
					echo $option;
				}
				?>
			</select>
			
			
			</td>
		</tr>
		
		
		
		<tr>
			<th>CONFIRMACION</th>
			<td>
			<select name="confirmacion" >
				<option value="confirmado" >confirmado</option>
				<option value="suspendido" >suspendido</option>
			</select>
			</td>
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
$('#fecha').simpleDatepicker();
//SCRIPT grid
var mygrid<?=$nombreTab?>=jQuery("#grid<?=$nombreTab?>").jqGrid({
    url:'index.php?/<?=$controller?>/grid/<?=$keyTab?>',  
    datatype: "json",
    width:900,
    height:'auto',
    colNames:['ID','PACIENTE','EXAMEN','USUARIO','DESCRIPCION','FECHA','CONFIRMACION'],//@
    colModel:[//@
        {name:'id',index:'id', width:60},
		{name:'paciente_rut',index:'paciente_rut', width:60},
		{name:'examen_id',index:'examen_id', width:60},
		{name:'usuario_user_name',index:'usuario_user_name', width:60},
		{name:'descripcion',index:'descripcion', width:60},
		{name:'fecha',index:'fecha', width:60},
		{name:'confirmacion',index:'confirmacion', width:60}
    ],
    pager: jQuery('#paginador<?=$nombreTab?>'),
    rowNum:15,
	rowList:[10,20,30],
    sortname: 'id',//@
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
		fk_atencion_id(id);//@ 
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
$("#gs_id").attr("id","f_id<?=$nombreTab?>");
$("#gs_paciente_rut").attr("id","f_paciente_rut<?=$nombreTab?>");
$("#gs_examen_id").attr("id","f_examen_id<?=$nombreTab?>");
$("#gs_usuario_user_name").attr("id","f_usuario_user_name<?=$nombreTab?>");
$("#gs_descripcion").attr("id","f_descripcion<?=$nombreTab?>");
$("#gs_fecha").attr("id","f_fecha<?=$nombreTab?>");
$("#gs_confirmacion").attr("id","f_confirmacion<?=$nombreTab?>");


var timeoutHnd<?=$nombreTab?>;
jQuery("table .ui-search-toolbar :input").keyup(function(e){
	if(timeoutHnd<?=$nombreTab?>) {
		clearTimeout(timeoutHnd<?=$nombreTab?>); 
	}
	timeoutHnd<?=$nombreTab?> = setTimeout(grid<?=$nombreTab?>Reload,500);
});

function grid<?=$nombreTab?>Reload(){//@
	var f_id = jQuery("#f_id<?=$nombreTab?>").val();
	var f_paciente_rut = jQuery("#f_paciente_rut<?=$nombreTab?>").val();
	var f_examen_id = jQuery("#f_examen_id<?=$nombreTab?>").val();
	var f_usuario_user_name = jQuery("#f_usuario_user_name<?=$nombreTab?>").val();
	var f_descripcion = jQuery("#f_descripcion<?=$nombreTab?>").val();
	var f_fecha = jQuery("#f_fecha<?=$nombreTab?>").val();
	var f_confirmacion = jQuery("#f_confirmacion<?=$nombreTab?>").val();

	//@
	jQuery("#grid<?=$nombreTab?>").setGridParam({url:"index.php?/<?=$controller?>/grid/<?=$keyTab?>",postData:{"livesearch":true,"f_id":f_id,"f_paciente_rut":f_paciente_rut,"f_examen_id":f_examen_id,"f_usuario_user_name":f_usuario_user_name,"f_descripcion":f_descripcion,"f_fecha":f_fecha,"f_confirmacion":f_confirmacion},page:1}).trigger("reloadGrid");
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
			$('#form<?=$nombreTab?>Standard')[0].id.value=json.id;
			$('#form<?=$nombreTab?>Standard')[0].paciente_rut.value=json.paciente_rut;
			$('#form<?=$nombreTab?>Standard')[0].paciente_rut_aux.value=json.paciente_rut+' ['+json.paciente_rut_aux+']';
			$('#form<?=$nombreTab?>Standard')[0].examen_id.value=json.examen_id;
			$('#form<?=$nombreTab?>Standard')[0].examen_id_aux.value=json.examen_id+' ['+json.examen_id_aux+']';
			$('#form<?=$nombreTab?>Standard')[0].usuario_user_name.value=json.usuario_user_name;
			$('#form<?=$nombreTab?>Standard')[0].usuario_user_name_aux.value=json.usuario_user_name+' ['+json.usuario_user_name_aux+']';
			$('#form<?=$nombreTab?>Standard')[0].descripcion.value=json.descripcion;
			$('#form<?=$nombreTab?>Standard')[0].fecha.value=json.fecha;
			$('#form<?=$nombreTab?>Standard')[0].hora_h.value=json.hora_h;
			$('#form<?=$nombreTab?>Standard')[0].hora_m.value=json.hora_m;
			$('#form<?=$nombreTab?>Standard')[0].confirmacion.value=json.confirmacion;
		}
	});
	
	//SE MUESTRAN LOS IB BUTTON DE ESTE MODULO********************************
	$('#ib_lugar_id').show();
	$('#clean_lugar_id').show();
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
	$('#form<?=$nombreTab?>Standard')[0].lugar_id.value=<?=$keyTab?>;//@
	$('#form<?=$nombreTab?>Standard')[0].lugar_id_aux.value=<?=$keyTab?>;//@
	$('#ib_lugar_id').hide();
	$('#clean_lugar_id').hide();
}
///////
<?php } ?>




<?php if(!$inputBuscador){?>
//CALL INPUT BUSCADOR 
$('#ib_paciente_rut').click(function()
	{
		$.ajax({
			type: "POST",
			url: 'index.php?/paciente_controller/cargaModulo/IBPaciente/paciente_rut',
			success: function(datos){
				$("#ib_content").html(datos);
				showIB();
			}
		});
	}
);

function fk_paciente_id(valor){//@
	$('#form<?=$nombreTab?>Standard')[0].paciente_rut.value=valor;//@
	$('#form<?=$nombreTab?>Standard')[0].paciente_rut_aux.value=valor+fkName('IBPaciente',valor,3,4,5);//@ 
	$("#ib").hide();
}
//FIN CALL INPUT BUSCADOR 
<?php } ?>



<?php if(!$inputBuscador){?>
//CALL INPUT BUSCADOR 
$('#ib_examen_id').click(function()
	{
		$.ajax({
			type: "POST",
			url: 'index.php?/examen_controller/cargaModulo/IBExamen/examen_id',
			success: function(datos){
				$("#ib_content").html(datos);
				showIB();
			}
		});
	}
);

function fk_examen_id(valor){//@
	$('#form<?=$nombreTab?>Standard')[0].examen_id.value=valor;//@
	$('#form<?=$nombreTab?>Standard')[0].examen_id_aux.value=valor+fkName('IBExamen',valor,2);//@ 
	$("#ib").hide();
}
//FIN CALL INPUT BUSCADOR 
<?php } ?>


<?php if(!$inputBuscador){?>
//CALL INPUT BUSCADOR 
$('#ib_usuario_user_name').click(function()
	{
		$.ajax({
			type: "POST",
			url: 'index.php?/usuario_controller/cargaModulo/IBUsuario/usuario_user_name',
			success: function(datos){
				$("#ib_content").html(datos);
				showIB();
			}
		});
	}
);

function fk_usuario_id(valor){//@
	$('#form<?=$nombreTab?>Standard')[0].usuario_user_name.value=valor;//@
	$('#form<?=$nombreTab?>Standard')[0].usuario_user_name_aux.value=valor+fkName('IBUsuario',valor,3,4);//@ 
	$("#ib").hide();
}
//FIN CALL INPUT BUSCADOR 
<?php } ?>






</script>



