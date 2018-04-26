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
			<th width="20%" class="form_th" >ID</th>
			<td><input type="text" size="30" id="id" name="id" value="" class="" disabled></input></td>
		</tr>
				
		<tr>
			<th>NOMBRE</th>
			<td><input type="text" size="30" id="nombre" name="nombre" value="" class="required"></input></td>
		</tr>
		<tr>
			<th>DIRECCION</th>
			<td><input type="text" size="30" id="direccion" name="direccion" value="" class="required"></input></td>
		</tr>
		<tr>
			<th>COMUNA</th>
			<td><input type="text" size="30" id="comuna" name="comuna" value="" class="required"></input></td>

		</tr>
		<tr>
			<th>TELEFONO</th>
			<td><input type="text" size="30" id="telefono" name="telefono" value="" class="required"></input></td>
		</tr>
		<tr>
			<th>CONT NOMBRE</th>
			<td><input type="text" size="30" id="cont_nombre" name="cont_nombre" value="" class="required"></input></td>

		</tr>
		<tr>
			<th>CONT MAIL</th>
			<td><input type="text" size="30" id="cont_mail" name="cont_mail" value="" class="required"></input></td>
		</tr>
		<tr>
			<th>CONT TELEFONO</th>
			<td><input type="text" size="30" id="cont_telefono" name="cont_telefono" value="" class="required"></input></td>

		</tr>
		<tr>
			<th>DESCRIPCION</th>
			<td><input type="text" size="30" id="descripcion" name="descripcion" value="" class="required"></input></td>
		</tr>

		<tr>
			<th colspan="2"><input id="btnEnvio<?=$nombreTab?>" type="submit" value=""></input></th>
		</tr>
		
		<tr>
			<th colspan="3">
				<div id="menuTab" style="valign:left">
				Relaciones:
				<a href="#" c="index.php?/cancha_controller/cargaModulo/Cancha">Canchas</a> | 
				<B href="#" c="index.php?/cancha_controller/cargaModulo/Cancha">Partidos</a> | 
				<a href="#" c="index.php?/lugar_fotos_controller/cargaModulo/Fotos">Fotos</a>
				</div>
			</th>
		</tr>
	
	</table>
	</form>
	<?php $this->load->view('backend/common_tab');?>
	
</div>
<?php } ?> 



<script type="text/javascript">

//SCRIPT grid
var mygrid<?=$nombreTab?>=jQuery("#grid<?=$nombreTab?>").jqGrid({
    url:'index.php?/<?=$controller?>/grid/<?=$keyTab?>',  
    datatype: "json",
    width:900,
    height:'auto',
    colNames:['ID','NOMBRE','DIRECCION','COMUNA','TELEFONO','CONT NOMBRE','CONT MAIL','CONT TELEFONO'],//@
    colModel:[//@
        {name:'id',index:'id', width:60},
		{name:'nombre',index:'nombre', width:60},
		{name:'direccion',index:'direccion', width:60},
		{name:'comuna',index:'comuna', width:60},
		{name:'telefono',index:'telefono', width:60},
		{name:'cont_nombre',index:'cont_nombre', width:60},
		{name:'cont_mail',index:'cont_mail', width:60},
		{name:'cont_telefono',index:'cont_telefono', width:60}
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
		fk_lugar_id(id);//@ 
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
$("#gs_nombre").attr("nombre","f_nombre<?=$nombreTab?>");
$("#gs_direccion").attr("direccion","f_direccion<?=$nombreTab?>");
$("#gs_comuna").attr("comuna","f_comuna<?=$nombreTab?>");
$("#gs_telefono").attr("telefono","f_telefono<?=$nombreTab?>");
$("#gs_cont_nombre").attr("cont_nombre","f_cont_nombre<?=$nombreTab?>");
$("#gs_cont_mail").attr("cont_mail","f_cont_mail<?=$nombreTab?>");
$("#gs_cont_telefono").attr("cont_telefono","f_cont_telefono<?=$nombreTab?>");


var timeoutHnd<?=$nombreTab?>;
jQuery("table .ui-search-toolbar :input").keyup(function(e){
	if(timeoutHnd<?=$nombreTab?>) {
		clearTimeout(timeoutHnd<?=$nombreTab?>); 
	}
	timeoutHnd<?=$nombreTab?> = setTimeout(grid<?=$nombreTab?>Reload,500);
});

function grid<?=$nombreTab?>Reload(){//@
	var f_id = jQuery("#f_id<?=$nombreTab?>").val();
	var f_nombre = jQuery("#f_nombre<?=$nombreTab?>").val();
	var f_direccion = jQuery("#f_direccion<?=$nombreTab?>").val();
	var f_comuna = jQuery("#f_comuna<?=$nombreTab?>").val();
	var f_telefono = jQuery("#f_telefono<?=$nombreTab?>").val();
	var f_cont_nombre = jQuery("#f_cont_nombre<?=$nombreTab?>").val();
	var f_cont_mail = jQuery("#f_cont_mail<?=$nombreTab?>").val();
	var f_cont_telefono = jQuery("#f_cont_telefono<?=$nombreTab?>").val();

	//@
	jQuery("#grid<?=$nombreTab?>").setGridParam({url:"index.php?/<?=$controller?>/grid/<?=$keyTab?>",postData:{"livesearch":true,"f_id":f_id,"f_nombre":f_nombre,"f_direccion":f_direccion,"f_comuna":f_comuna,"f_telefono":f_telefono,"f_cont_nombre":f_cont_nombre,"f_cont_mail":f_cont_mail,"f_cont_telefono":f_cont_telefono},page:1}).trigger("reloadGrid");
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
			$('#form<?=$nombreTab?>Standard')[0].nombre.value=json.nombre;
			$('#form<?=$nombreTab?>Standard')[0].direccion.value=json.direccion;
			$('#form<?=$nombreTab?>Standard')[0].comuna.value=json.comuna;
			$('#form<?=$nombreTab?>Standard')[0].telefono.value=json.telefono;
			$('#form<?=$nombreTab?>Standard')[0].cont_nombre.value=json.cont_nombre;
			$('#form<?=$nombreTab?>Standard')[0].cont_mail.value=json.cont_mail;
			$('#form<?=$nombreTab?>Standard')[0].cont_telefono.value=json.cont_telefono;
			$('#form<?=$nombreTab?>Standard')[0].descripcion.value=json.descripcion;

		}
	});
	
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

</script>



