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
			<td><input type="text" size="30" id="id" name="id" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>GRUPO_SANGUINEO</th>
			<td><input type="text" size="30" id="grupo_sanguineo" name="grupo_sanguineo" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>ENFERMEDADES</th>
			<td><input type="text" size="30" id="enfermedades" name="enfermedades" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>OPERACIONES</th>
			<td><input type="text" size="30" id="operaciones" name="operaciones" value="" class="required"  ></input></td>
		</tr>
		<tr>
			<th>ITEM_FICHA_CLINICA_ID</th>
			<td><input type="hidden" id="item_ficha_clinica_id" name="item_ficha_clinica_id" value="" ><input type="text" size="30" id="item_ficha_clinica_id_aux" name="item_ficha_clinica_id_aux" value="" class="required readonly"  readonly ></input>
			<span id="ib_item_ficha_clinica_id" class="ibButton"></span>
			<span id="clean_item_ficha_clinica_id" class="cleanButton" onclick="javascript:limpiar('item_ficha_clinica_id');limpiar('item_ficha_clinica_id_aux')"></span></td>
		</tr>
		<tr>
			<th>PACIENTE_RUT</th>
			<td><input type="hidden" id="paciente_rut" name="paciente_rut" value="" ><input type="text" size="30" id="paciente_rut_aux" name="paciente_rut_aux" value="" class="required readonly"  readonly ></input>
			<span id="ib_paciente_rut" class="ibButton"></span>
			<span id="clean_paciente_rut" class="cleanButton" onclick="javascript:limpiar('paciente_rut');limpiar('paciente_rut_aux')"></span></td>
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
    colNames:['ID','GRUPO_SANGUINEO','ENFERMEDADES','OPERACIONES','ITEM_FICHA_CLINICA_ID','PACIENTE_RUT'],//@
    colModel:[//@
        {name:'id',index:'id', width:60},
		{name:'grupo_sanguineo',index:'grupo_sanguineo', width:60},
		{name:'enfermedades',index:'enfermedades', width:60},
		{name:'operaciones',index:'operaciones', width:60},
		{name:'item_ficha_clinica_id',index:'item_ficha_clinica_id', width:60},
		{name:'paciente_rut',index:'paciente_rut', width:60},
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
		fk_ficha_clinica_id(id);//@ 
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
$("#gs_grupo_sanguineo").attr("id","f_grupo_sanguineo<?=$nombreTab?>");
$("#gs_enfermedades").attr("id","f_enfermedades<?=$nombreTab?>");
$("#gs_operaciones").attr("id","f_operaciones<?=$nombreTab?>");
$("#gs_item_ficha_clinica_id").attr("id","f_item_ficha_clinica_id<?=$nombreTab?>");
$("#gs_paciente_rut").attr("id","f_paciente_rut<?=$nombreTab?>");


var timeoutHnd<?=$nombreTab?>;
jQuery("table .ui-search-toolbar :input").keyup(function(e){
	if(timeoutHnd<?=$nombreTab?>) {
		clearTimeout(timeoutHnd<?=$nombreTab?>); 
	}
	timeoutHnd<?=$nombreTab?> = setTimeout(grid<?=$nombreTab?>Reload,500);
});

function grid<?=$nombreTab?>Reload(){//@
	var f_id = jQuery("#f_id<?=$nombreTab?>").val();
	var f_grupo_sanguineo = jQuery("#f_grupo_sanguineo<?=$nombreTab?>").val();
	var f_enfermedades = jQuery("#f_enfermedades<?=$nombreTab?>").val();
	var f_operaciones = jQuery("#f_operaciones<?=$nombreTab?>").val();
	var f_item_ficha_clinica_id = jQuery("#f_item_ficha_clinica_id<?=$nombreTab?>").val();
	var f_paciente_rut = jQuery("#f_paciente_rut<?=$nombreTab?>").val();
	//@
	jQuery("#grid<?=$nombreTab?>").setGridParam({url:"index.php?/<?=$controller?>/grid/<?=$keyTab?>",postData:{"livesearch":true,
	"f_id":f_id,"f_grupo_sanguineo":f_grupo_sanguineo,"f_enfermedades":f_enfermedades,"f_operaciones":f_operaciones,"f_item_ficha_clinica_id":f_item_ficha_clinica_id,"f_paciente_rut":f_paciente_rut},page:1}).trigger("reloadGrid");
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
			$('#form<?=$nombreTab?>Standard')[0].grupo_sanguineo.value=json.grupo_sanguineo;
			$('#form<?=$nombreTab?>Standard')[0].enfermedades.value=json.enfermedades;
			$('#form<?=$nombreTab?>Standard')[0].operaciones.value=json.operaciones;
			$('#form<?=$nombreTab?>Standard')[0].item_ficha_clinica_id.value=json.item_ficha_clinica_id;
			$('#form<?=$nombreTab?>Standard')[0].item_ficha_clinica_id_aux.value=json.item_ficha_clinica_id+' ['+json.item_ficha_clinica_id_aux+']';
			$('#form<?=$nombreTab?>Standard')[0].paciente_rut.value=json.paciente_rut;
			$('#form<?=$nombreTab?>Standard')[0].paciente_rut_aux.value=json.paciente_rut+' ['+json.paciente_rut_aux+']';
		}
	});
	
	//SE MUESTRAN LOS IB BUTTON DE ESTE MODULO
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
$('#ib_lugar_id').click(function()
	{
		$.ajax({
			type: "POST",
			url: 'index.php?/lugar_controller/cargaModulo/IBLugar/lugar_id',
			success: function(datos){
				$("#ib_content").html(datos);
				showIB();
			}
		});
	}
);

function fk_lugar_id(valor){//@
	$('#form<?=$nombreTab?>Standard')[0].lugar_id.value=valor;//@
	$('#form<?=$nombreTab?>Standard')[0].lugar_id_aux.value=valor+fkName('IBLugar',valor,2);//@ 
	$("#ib").hide();
}
//FIN CALL INPUT BUSCADOR 
<?php } ?>






</script>



