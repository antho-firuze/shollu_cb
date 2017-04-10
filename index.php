<?php	$base_url = "http://localhost/ci/app1/"; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/shollu_cb-white.css">
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="js/shollu_cb.js"></script>
	<script src="plugins/bootstrap.helper.js"></script>
	<script src="plugins/common.func.js"></script>
</head>
<body>
<script>
var col = []; a = [];
var form = $('<form />', { autocomplete:'off', style:'margin:15px;' });
col.push(BSHelper.Combobox({ label:"Country", idname:"country_id", url:"<?=$base_url;?>systems/c_1country", remote:true }));
col.push(BSHelper.Combobox({ label:"Province", idname:"province_id", url:"<?=$base_url;?>systems/c_2province", remote:true }));
col.push(BSHelper.Combobox({ label:"City", idname:"city_id", url:"<?=$base_url;?>systems/c_3city", value: -1, remote:true }));
col.push(BSHelper.Combobox({ label:"District", idname:"district_id", url:"<?=$base_url;?>systems/c_4district", value: -1, remote:true }));
col.push(BSHelper.Combobox({ label:"Village", idname:"village_id", url:"<?=$base_url;?>systems/c_5village", value: -1, remote:true }));
col.push(BSHelper.Combobox({ label:"Role (Default)", idname:"user_role_id", textField:"code_name", url:"<?=$base_url;?>systems/a_user_role?filter=user_id=11", remote:true }));
col.push(BSHelper.Combobox({ label:"Date Format", idname:"date_format", required:true, 
	list:[
		{ id:"dd/mm/yyyy", name:"dd/mm/yyyy" },
		{ id:"mm/dd/yyyy", name:"mm/dd/yyyy" },
		{ id:"dd-mm-yyyy", name:"dd-mm-yyyy" },
		{ id:"mm-dd-yyyy", name:"mm-dd-yyyy" },
	], 
}));
a.push(BSHelper.Button({ type:"button", idname:"btn-1", label:"setValue", cls:"btn-primary", 
	onclick:"$('#date_format').shollu_cb('setValue','dd-mm-yyyy');" 
}));
a.push(BSHelper.Button({ type:"button", idname:"btn-2", label:"getValue", cls:"btn-primary",
	onclick:"alert($('#date_format').shollu_cb('getValue'));" 
}));
col.push(subRow(subCol(12, a)));
form.append(subRow(subCol(12, col)));
col = [];
col.push('<br>');
col.push( BSHelper.Button({ type:"button", idname:"btn-disable", label:"Disable", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-enable", label:"Enable", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-init", label:"Init", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-destroy", label:"Destroy", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-setParams", label:"setParams Village (district_id = 3276030)", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-getValue", label:"getValue Village", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-setValue", label:"setValue Village (1101010012:Labuhan Bakti)", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-setValue2", label:"setValue Village (null/-1)", cls:"btn-primary" }) );
col.push( BSHelper.Button({ type:"button", idname:"btn-version", label:"Version", cls:"btn-primary" }) );
form.append(subRow(subCol(12, col)));
$('body').append( form );

$("#country_id").shollu_cb({ addition: { "id":0, "name":"Non Standard" } });

// $("#country_id").shollu_cb('setValue', 1);
$("#date_format").shollu_cb('setValue', 'dd-mm-yyyy');

$("#country_id").shollu_cb({ 
	onChange: function(rowData){
		console.log('onChange:');
		console.log(rowData);
		$("#province_id")
			.shollu_cb({ queryParams: { "country_id":rowData.id } })
			.shollu_cb('setValue', '');
	},
	onSelect: function(rowData){
		console.log('onSelect:');
		console.log(rowData);
		$("#province_id")
			.shollu_cb({ queryParams: { "country_id":rowData.id } })
			.shollu_cb('setValue', '');
	}
});

$("#province_id").shollu_cb({ 
	onSelect: function(rowData){
		console.log('onSelect:');
		console.log(rowData);
		$("#city_id")
			.shollu_cb({ queryParams: { "province_id":rowData.id } })
			.shollu_cb('setValue', '');
	},
	onChange: function(rowData){
		console.log('onChange:');
		console.log(rowData);
	}
});

$("#city_id").shollu_cb({ 
	onSelect: function(rowData){
		console.log('onSelect:');
		console.log(rowData);
		$("#district_id")
			.shollu_cb({ queryParams: { "city_id":rowData.id } })
			.shollu_cb('setValue', '');
	}
});


$("#district_id").shollu_cb({ 
	onSelect: function(rowData){
		console.log('onSelect:');
		console.log(rowData);
		$("#village_id")
			.shollu_cb({ queryParams: { "district_id":rowData.id } })
			.shollu_cb('setValue', '');
	}
});

$("#village_id").shollu_cb({ 
	onSelect: function(rowData){
		console.log('onSelect:');
		console.log(rowData);
	},
	onChange: function(rowData){
		console.log('onChange:');
		console.log(rowData);
	}
});

form.find('.btn').click(function(){
	var i = $('.btn').index(this),
	n = $('.btn:eq('+i+')').attr('id');
	switch(n){
		case 'btn-disable':
			form.find("#village_id").shollu_cb('disable', true);
			break;
		case 'btn-enable':
			form.find("#village_id").shollu_cb('disable', false);
			break;
		case 'btn-init':
			form.find("#village_id").shollu_cb('init');
			break;
		case 'btn-destroy':
			form.find("#village_id").shollu_cb('destroy');
			break;
		case 'btn-setParams':
			form.find("#village_id").shollu_cb({ 'queryParams':{"district_id":3276030} });
			break;
		case 'btn-setValue':
			form.find("#village_id").shollu_cb('setValue', '1101010012');
			break;
		case 'btn-setValue2':
			form.find("#village_id").shollu_cb('setValue', -1);
			break;
		case 'btn-getValue':
			console.log(form.find("#village_id").shollu_cb('getValue'));
			break;
		case 'btn-version':
			console.log(form.find("#village_id").shollu_cb('version'));
			break;
	}
});
</script>
</body>
</html>