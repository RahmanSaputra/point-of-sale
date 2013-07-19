<?php
session_start();
if (ISSET($_SESSION['username'])){
}else{
header("location: login.php");
}
include "koneksi.php";
?>
<html>
<head>
<title>Sytem Point Of Sale | SpoS</title>
<script src="media/js/jquery.tools.min.js"></script>
<script src="media/js/jquery.easyui.min.js"></script>
<script src="media/js/highcharts.js"></script>
<script src="media/js/highcharts-more.js"></script>
<script src="media/js/jquery.edatagrid.js"></script>
<link rel="stylesheet" href="media/css/style2.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="media/css/easyui.css">
<link rel="stylesheet" type="text/css" href="media/css/icon.css">
<link rel="shortcut icon" href="media/images/fav.ico" />
</head>
<body>
<div id="header">
<table width="900" border="0" align="center">
<tr>
<td width="168"><img src="media/images/logo.png" width="168" height="32" align="middle"> </td>
<td width="274" align="right" valign="middle" class="header">
<h3>Hi.<?php echo $_SESSION['username'];

?> 
<img src="media/images/admin-icon.png" width="32" height="32" align="absmiddle">| <a href="logout.php">Log Out</a> | Search</h3></td>
<td width="344" align="left" valign="middle"> <form action="" method="post" name="form1" class="form">  
<div class="row">
<input name="Search" type="text" class="Search" id="Search" placeholder="Search" />
<input name="button" type="submit" class="form" id="button" value="Go">
</div>
</form>
</td>
</tr>
</table>   
</div>
<div id="menu">
<div><div class="easyui-tabs" style="width:950px;height:875px" >
<div title="Home" data-options="iconCls:'icon-home',closable:true" style="padding:10px">
<div class="demo-info">
<div class="demo-tip icon-tip"></div>
</div>
<div style="margin:10px 0;"></div>
<div style="padding:5px;border:0px solid #ddd">
<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mainmenu'">Main Menu</a>
<a href="#" class="easyui-menubutton" data-options="menu:'#mm0',iconCls:'icon-customer'">Customer</a>
<a href="#" class="easyui-menubutton" data-options="menu:'#mm00',iconCls:'icon-karyawan'">Karyawan</a>
<a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-edit'">Edit</a>
<a href="#" class="easyui-menubutton" data-options="menu:'#mm2',iconCls:'icon-help'">Help</a>
</div>
<div id="mm0" style="width:150px;">
<div data-options="iconCls:'icon-add'"><a href="javascript:void(0)"  plain="true" onClick="newUser()">New Customer</a></div>
<div class="menu-sep"></div>
</div>
<div id="mm1" style="width:150px;">
<div data-options="iconCls:'icon-undo'">Undo</div>
<div data-options="iconCls:'icon-redo'">Redo</div>
<div class="menu-sep"></div>
<div>Cut</div>
<div>Copy</div>
<div>Paste</div>
<div class="menu-sep"></div>
<div>
<span>Toolbar</span>
<div style="width:150px;">
<div>Address</div>
<div>Link</div>
<div>Navigation Toolbar</div>
<div>Bookmark Toolbar</div>
<div class="menu-sep"></div>
</div>
</div>
<div data-options="iconCls:'icon-remove'">Delete</div>
<div>Select All</div>
</div>
<div id="mm2" style="width:100px;">
<div>Help</div>
<div>Update</div>
<div>About</div>
</div>
<div id="dlg" class="easyui-dialog" style="width:325px;height:490px;padding:10px 20px"
closed="true" buttons="#dlg-buttons">
<div class="ftitle">Customer Information</div>
<form method="post" id="fm" novalidate>
<div class="fitem">
<label>Nama:</label>
<input name="nama" class="easyui-validatebox" required="true">
</div>
<div class="fitem">
<label>Company Name:</label>
<input name="company" class="easyui-validatebox" required="true">
</div>
<div class="fitem">
<label>Alamat:</label>
<textarea name="alamat" class="easyui-validatebox" required="true"></textarea>
</div>
<div class="fitem">
<label>Kota:</label>
<input name="kota" class="easyui-validatebox" required="true">
</div>
<div class="fitem">
<label>No. Telp:</label>
<input name="telp" class="easyui-validatebox" required="true">
</div>
<div class="fitem">
<label>Email:</label>
<input name="email" class="easyui-validatebox" required="true" validType="email">
</div>
</form>
</div>
<div id="dlg-buttons">
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onClick="saveUser()">Save</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').dialog('close')">Cancel</a>
</div>
<script type="text/javascript">
 var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Customer');
			$('#fm').form('clear');
			url = 'save_customer.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Customer');
				$('#fm').form('load',row);
				url = 'update_customer.php?id_customer='+row.id_customer;
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		
						$('#dg').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Apakah benar ingin dihapus?',function(r){
					if (r){
						$.post('remove_customer.php',{id_customer:row.id_customer},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
</script>
 <style type="text/css">
#fm{
margin:0;
padding:10px 30px;
}
.ftitle{
font-size:14px;
font-weight:bold;
padding:5px 0;
margin-bottom:10px;
border-bottom:1px solid #ccc;
}
.fitem{
margin-bottom:5px;
}
.fitem label{
display:inline-block;
width:80px;
}
</style>
<table width="450" height="300" border="0" align="left" style="font-family:Verdana, Geneva, sans-serif">
<tr>
<td width="500" height="300" align="center" valign="top" >
<div style="position:relative; width:450px;height:300px;border:0px solid #ccc;overflow:auto;">
<div id="w" class="easyui-window" data-options="title:'Grafik Produk',inline:true" style="width:450px;height:300px;padding:10px">
<script type="text/javascript">
var chart1,char2,char3,char4,char5,chart6,chart7,chart8,chart9; 
$(document).ready(function() {
chart1 = new Highcharts.Chart({
chart: {
renderTo: 'container',
type: 'column'
},   
title: {
text: 'Grafik Penjualan Produk '
},
xAxis: {
categories: ['Kategori']
},
yAxis: {
title: {
text: 'Jumlah terjual'
}
},
series:             
[
<?php 
$sql_jumlah   = "SELECT produk.nama, SUM(transaksi.qty)
FROM produk
RIGHT JOIN transaksi ON produk.id_produk = transaksi.id_produk
GROUP BY nama";  	        
$query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error()); 
while( $data = mysql_fetch_array( $query_jumlah ) ){  	               
?> 
{
name: '<?php echo $data['nama']; ?>',
data: [<?php echo $data['SUM(transaksi.qty)']; ?>]
},
<?php } ?>
]
});
});	 
$(document).ready(function() {
options = {
chart: {
renderTo: 'container2',
plotBackgroundColor: null,
plotBorderWidth: null,
plotShadow: false
},
title: {
text: 'Top Sales'
},
tooltip: {
formatter: function() {
return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
}
},
plotOptions: {
pie: {
allowPointSelect: true,
cursor: 'pointer',
dataLabels: {
enabled: true,
color: '#000000',
connectorColor: '#000000',
formatter: function() {
return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
}
}
}
},
series: [{
type: 'pie',
name: 'Sales',
data: []
}]
}
$.getJSON("datasales.php", function(json) {
options.series[0].data = json;
chart = new Highcharts.Chart(options);
});          
});  
$(document).ready(function() {
var options = {
chart: {
renderTo: 'container3',
defaultSeriesType: 'line',
marginRight: 130,
marginBottom: 25
},
title: {
text: 'Jam Terjual',
x: -20
},
subtitle: {
text: '',
x: -20
},
xAxis: {
type: 'datetime',
tickInterval: 3600 * 1000,
tickWidth: 0,
gridLineWidth: 1,
labels: {
align: 'center',
x: -3,
y: 20,
formatter: function() {
return Highcharts.dateFormat('%l%p', this.value);
}
}
},
yAxis: {
title: {
text: 'Produk Terjual'
},
plotLines: [{
value: 0,
width: 1,
color: '#808080'
}]
},
tooltip: {
formatter: function() {
return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
}
},
legend: {
layout: 'vertical',
align: 'right',
verticalAlign: 'top',
x: -10,
y: 100,
borderWidth: 0
},
series:             
[
{
name: 'Angka Terjual',
},
]
}
jQuery.get('datasales1.php', null, function(tsv) {
var lines = [];
traffic = [];
try {
tsv = tsv.split(/\n/g);
jQuery.each(tsv, function(i, line) {
line = line.split(/\t/);
date = Date.parse(line[0] +' UTC');
traffic.push([
date,
parseInt(line[1].replace(',', ''), 10)
]);
});
} catch (e) {  }
options.series[0].data = traffic;
chart = new Highcharts.Chart(options);
});
});			
$(document).ready(function() {
var options = {
chart: {
renderTo: 'container4',
plotBackgroundColor: null,
plotBorderWidth: null,
plotShadow: false
},
title: {
text: 'Top Sales'
},
tooltip: {
formatter: function() {
return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
}
},
plotOptions: {
pie: {
allowPointSelect: true,
cursor: 'pointer',
dataLabels: {
enabled: true,
color: '#000000',
connectorColor: '#000000',
formatter: function() {
return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
}
}
}
},
series: [{
type: 'pie',
name: 'Sales',
data: []
}]
}
$.getJSON("datasales.php", function(json) {
options.series[0].data = json;
chart4 = new Highcharts.Chart(options);
});          
});	
$(function () {
var chart5 = new Highcharts.Chart({
chart: {
	        renderTo: 'container5',
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false,
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,
            spacingBottom: 0
	    },
	
	    title: {
	        text: ''
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150
	    },	        
	
	    yAxis: [{
	        min: 0,
	        max: 100000000,
	        lineColor: '#339',
	        tickColor: '#339',
	        minorTickColor: '#339',
	        offset: -25,
	        lineWidth: 2,
	        labels: {
	            distance: -20,
	            rotation: 'auto'
	        },
	        tickLength: 5,
	        minorTickLength: 5,
	        endOnTick: false
	    }, {
	        min: 0,
	        max: 100,
	        tickPosition: 'outside',
	        lineColor: '#933',
	        lineWidth: 2,
	        minorTickPosition: 'outside',
	        tickColor: '#933',
	        minorTickColor: '#933',
	        tickLength: 5,
	        minorTickLength: 5,
	        labels: {
	            distance: 12,
	            rotation: 'auto'
	        },
	        offset: -20,
	        endOnTick: false
	    }],
	    series: [<?php
$result = mysql_query("SELECT id_transaksi, SUM( harga * qty ) AS Total
FROM transaksi");
$rows = array();
while($r = mysql_fetch_array($result)) {
$row[0] = $r[0];
$row[1] = $r[1];?>{
	        name: 'Total Penjualan Produk',
	        data: [<?php echo $row[1]?>]
	        }
			 <?php } ?>
	    ]
	}
	);          
        });
$(function () {
var chart7 = new Highcharts.Chart({
chart: {
	        renderTo: 'container7',
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false,
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,
            spacingBottom: 0
	    },
	
	    title: {
	        text: ''
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150
	    },	        
	
	    yAxis: [{
	        min: 0,
	        max: 100000000,
	        lineColor: '#339',
	        tickColor: '#339',
	        minorTickColor: '#339',
	        offset: -25,
	        lineWidth: 2,
	        labels: {
	            distance: -20,
	            rotation: 'auto'
	        },
	        tickLength: 5,
	        minorTickLength: 5,
	        endOnTick: false
	    }, {
	        min: 0,
	        max: 100,
	        tickPosition: 'outside',
	        lineColor: '#933',
	        lineWidth: 2,
	        minorTickPosition: 'outside',
	        tickColor: '#933',
	        minorTickColor: '#933',
	        tickLength: 5,
	        minorTickLength: 5,
	        labels: {
	            distance: 12,
	            rotation: 'auto'
	        },
	        offset: -20,
	        endOnTick: false
	    }],
	    series: [<?php
$result = mysql_query("SELECT id_transaksi, SUM( harga * qty ) AS Total
FROM transaksi");
$rows = array();
while($r = mysql_fetch_array($result)) {
$row[0] = $r[0];
$row[1] = $r[1];?>{
	        name: 'Total Penjualan Produk',
	        data: [<?php echo $row[1]?>]
	        }
			 <?php } ?>
	    ]
	}
	);          
        });
</script>  
<div id="container" style="width: 400px; height: 240px; margin: 0 auto">
</div>
</div></td>
<td width="600" height="300" align="left" valign="top" >
<div style="position:relative; width:450px;height:300px;border:0px solid #ccc;overflow:auto;">
<div id="w" class="easyui-window" data-options="title:'Top Sales',inline:true" style="width:450px; height:300px; padding:10px">   
<div id="container2" style="width: 400px; height: 240px; margin: 0 auto">
</div>
</div>
</div>
</td>
</tr>
<tr>
</tr>
</table>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p><br></p>
<table width="450" height="300" border="0" align="left" style="font-family:Verdana, Geneva, sans-serif">
<tr>
<td width="900" height="300" align="left" valign="top" >
<div style="position:relative; width:910px;height:450px;border:0px solid #ccc;overflow:hidden;">
<div id="w" class="easyui-window" data-options="title:'Customer',inline:true" style="width:910px; height:450px; padding:10px">
<table id="dg" title="Data Customer" class="easyui-datagrid" style="width:877px; height:400px"
url="media/php/datacustomer.php"
idField="id" pagination="true" toolbar="#toolbar" rownumbers="true" fitColumns="true" singleSelect="true"
iconCls="icon-save">
<thead>
<tr>
<th field="id_customer" width="75">ID</th>
<th field="nama" width="150" >Nama</th>
<th field="company" width="150">Company</th>
<th field="alamat" width="300">Alamat</th>
<th field="kota" width="75">Kota</th>
<th field="telp" width="125" >Telp</th>
<th field="email" width="200" >E-Mail</th>
</tr>
</thead>
</table> 
<div id="toolbar">
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newUser()">New Customer</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editUser()">Edit Customer</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="removeUser()">Remove Customer</a>
</div>
</div>
</div>
</div>
</td>
</tr>
</table>
<div>
</div>
</div>
<div title="Karyawan" data-options="iconCls:'icon-karyawan',closable:true" style="padding:10px">
<table width="200" border="0">
  <tr>
    <td align="left" valign="top">    <div style="width:200px;height:350;background:#7190E0;padding:5px;">  
        <div class="easyui-panel" title="Data Karyawan" collapsible="true" style="width:200px;height:auto;padding:10px;">  
            Grid data karyawan<br/>  
            Add via grid<br/>  
            Edit, delete via grid  
        </div>  
        <br/>  
        <div class="easyui-panel" title="Title Karyawan" collapsible="true" style="width:200px;height:auto;padding:10px;">  
            Web Development<br/>  
            Mobile Development<br/>  
            Desktop Development<br/>
            System Analisis<br/>
            Salesman 
        </div>  
        <br/>  
        <div class="easyui-panel" title="Help" collapsible="true" style="width:200px;height:auto;padding:10px;">  
            sms or call +62 81 555 369300<br/>  
        </div>  
        <br/>     
    </div>  
    </td>
    <td><div style="position:relative;width:700px;height:370px;border:0px solid #ccc;overflow:hidden;">
    <script type="text/javascript">
	$(function(){
			$('#dg1').edatagrid({
				url: 'datakaryawan.php',
				saveUrl: 'save_karyawan.php',
				updateUrl: 'update_karyawan.php',
				destroyUrl: 'remove_karyawan.php'
			});
		});	
		
		
		
	</script>
        <table id="dg1" title="Data Karyawan" style="width:700px;height:370px"  
            toolbar="#toolbar1" idField="id1"  pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">  
        <thead>  
            <tr>  
                <th field="id_karyawan" width="50" data-options="frozen:true">ID</th>  
                <th field="nama" width="100" editor="{type:'validatebox',options:{required:true}}">Nama</th>  
                <th field="alamat" width="170" editor="text">Alamat</th>  
                <th field="kota" width="50" editor="{type:'validatebox',options:{required:true}}">Kota</th>  
                <th field="telp" width="95" editor="{type:'validatebox',options:{required:true}}">No Telp</th>
                <th field="title" width="75" editor="{type:'validatebox',options:{required:true}}">Title</th>
                <th field="email" width="150" editor="{ validType:'email',type:'validatebox',options:{required:true}}">Email</th>
            </tr>  
        </thead>  
    </table>  
    <div id="toolbar1">  
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="javascript:$('#dg1').edatagrid('addRow')">New</a>  
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="javascript:$('#dg1').edatagrid('destroyRow')">Delete</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onClick="javascript:$('#dg1').edatagrid('saveRow')">Save</a>  
        <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onClick="javascript:$('#dg1').edatagrid('cancelRow')">Cancel</a>  
    </div>  
    </div>
    </td>
  </tr>
  <tr>
  <td colspan="2" align="left" valign="top" width="900">
<div  style="position:relative; width:920px; height:380px; border:0px solid #ccc; overflow:hidden;">
<div  id="w" class="easyui-window" data-options="title:'Karyawan Title',inline:true" style=" width:920px; height:360px; padding:10px">
<div id="container6" style="width: 850px; height: 290px; margin: 0 auto"> 
</div>
</div>
</div>
</td>
  </tr>
</table>


</div>

<div title="Graph" data-options="iconCls:'icon-graph',closable:true" style="padding:10px">
<table width="450" height="300" border="0" align="center" style="font-family:Verdana, Geneva, sans-serif">
<tr>
<td colspan="2" align="left" valign="top">
<div  style="position:relative; width:910px; height:320px; border:0px solid #ccc; overflow:hidden;">
<div   id="w" class="easyui-window" data-options="title:'Total Produk Terjual / Bulan',inline:true" style="width:900px;height:290px;padding:10px position:relative">
<div id="container9" style="width: 770px; height: 250px; margin: 0 auto"> </div></div></div></td>
</td>
</tr>
<tr>
<td align="left" valign="middle"">
<div style="position:relative; width:450px; height:400px; border:0px solid #ccc;overflow:hidden;"> 
<div id="w" class="easyui-window" data-options="title:'Top Sales',inline:true" style=" position:relative; overflow:visible; width:440px;height:375px;padding:10px">
<div id="container4" style=" overflow:hidden;  width: 405px; height: 300px; margin: 0 auto">
</div>
</div>
</div> </td>
<td align="left"><div style="position:relative; width:450px; height:400px; border:0px solid #ccc; overflow:hidden;">
<div id="w" class="easyui-window" data-options="title:'Total Penjualan',inline:true" style="width:440px;height:375px;padding:10px position:relative">
<div id="container5" style="width: 405px; height: 300px; margin: 0 auto"></div></div>
</div></td>
</tr>
</table>		
</div>
<div title="Order" data-options="iconCls:'icon-product',closable:true" style="padding:10px">
<div  style="position:relative; width:920px; height:290px; border:0px solid #ccc; overflow:hidden;">

      <table id="dg_transaksi" title="Data Transaksi" class="easyui-datagrid" style="width:920px; height:290px"
url="datatransaksi.php"
idField="id" pagination="true" toolbar="#toolbar9" rownumbers="true" fitColumns="true" singleSelect="true"
iconCls="icon-save">
<thead>
<tr>
<th field="id_transaksi" width="75">ID</th>
<th field="nama_customer" width="150">Customer</th>
<th field="nama_karyawan" width="150">Karyawan</th>
<th field="nama" width="150">Produk</th>
<th field="tgl_jual" width="120">Tanggal</th>
<th field="harga" formatter="formatPrice"; align="right" width="150">Harga</th>
<th field="qty" align="center" width="50" >qty</th>
<th field="TotalBayar" formatter="formatPrice"; align="right" width="200">Total</th>
</tr>
</thead>
</table> 
<div id="toolbar9">
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newTransaksi()">New Transaksi</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editTransaksi()">Edit Transaksi</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="removeTransaksi()">Remove Transaksi</a>
</div>
</div>
<div id="dlg_transaksi" class="easyui-dialog" style="width:325px;height:430px;padding:10px 20px"
closed="true" buttons="#dlg-buttons">
<div class="ftitle">Transaksi Information</div>
<form method="post" id="fm_transaksi" novalidate>
<div class="fitem">
<label>Customer:</label>
<input class="easyui-combobox"
name="customer"
data-options="
url:'combocustomer.php',
valueField:'id_customer',
textField:'nama',
panelHeight:'auto',
required:'true'
">
</div>
<div class="fitem">
<label>Karyawan:</label>
<input class="easyui-combobox"
name="karyawan"
data-options="
url:'combokaryawan.php',
valueField:'id_karyawan',
textField:'nama',
panelHeight:'auto',
required:'true'
">
</div>
<div class="fitem">
<label>Produk:</label>
<input class="easyui-combobox"
name="produk" id="combo"
data-options=" 
url:'comboproduk.php',
valueField:'id_produk',
textField:'nama',
panelHeight:'auto',
required:'true',
onSelect:function(val){
$('#hargaproduk').numberbox('setValue', val.harga);
}
">
</div>
<div class="fitem">
<label>Harga:</label>
<input class="easyui-numberbox" name="harga" id="hargaproduk" groupSeparator="."; data-options="required:true, frozen:true " ></input>
</div>
<div class="fitem">
<label>Qty:</label>
<input class="easyui-numberbox" name="qty" data-options="required:true " ></input>
</div>
<div class="fitem">
<label>Bulan:</label>
 <select class="easyui-combobox" name="bln" style="width:210px;" data-options="required:true">
<option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">Mei</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Agst</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select> 
</div>
<div class="fitem">
<input class="easyui-datebox" required style="width:210px" name="tgl_jual" data-options="required:true"></input>
</div>
</form>
</div>
<div id="dlg-buttons">
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onClick="saveTransaksi()">Save</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg_transaksi').dialog('close')">Cancel</a>
</div>  
<table width="400" border="0">
 <tr>
    <td>
   <div style="position:relative; width:380px; height:220px; border:0px solid #ccc; overflow:visible;">
<div id="w" class="easyui-window" data-options="title:'Total Harga Produk Terjual',inline:true" style="width:380px;height:220px;padding:10px position:relative">
<div id="container7" style="width: 360px; height: 200px; margin: 0 auto"></div></div>
</div>
  
    </td>
    <td rowspan="2"><div style="position:relative; width:535px; height:520px; border:0px solid #ccc; overflow:visible;">
    <table id="dg_produk" title="Data Produk" class="easyui-datagrid" style="width:535px; height:520px"
url="dataproduk.php"
idField="id" pagination="true" toolbar="#toolbar4" rownumbers="true" fitColumns="true" singleSelect="true"
iconCls="icon-save">
<thead>
<tr>
<th field="id_produk" width="75">ID</th>
<th field="nama" width="150" >Nama Produk</th>
<th field="harga" formatter="formatPrice"; align="right" width="200">Harga</th>
</tr>
</thead>

</table> 
<div id="toolbar4">
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newProduk()">New Produk</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editProduk()">Edit Produk</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="removeProduk()">Remove Produk</a>
</div>
  <div id="dlg_produk" class="easyui-dialog" style="width:325px;height:290px;padding:10px 20px"
closed="true" buttons="#dlg-buttons">
<div class="ftitle">Produk Information</div>
<form method="post" id="fm_produk" novalidate>
<div class="fitem">
<label>Nama Produk:</label>
<input name="nama" class="easyui-validatebox" required="true">
</div>
<div class="fitem">
<label>Harga:</label>
<input name="harga" class="easyui-numberbox" required="true">
</div>
</form>
</div>
<div id="dlg-buttons">
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onClick="saveProduk()">Save</a>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg_produk').dialog('close')">Cancel</a>
</div>  
    </td>
  </tr>
   <tr>
    <td>
    <div style="position:relative; width:380px; height:275px; border:0px solid #ccc; overflow:visible;">
<div id="w" class="easyui-window" data-options="title:'Grafik Produk',inline:true" style="width:380px;height:250px;padding:10px position:relative">
<div id="container8" style="width: 360px; height: 200px; margin: 0 auto""></div></div>
</div>
    </td>
  </tr>
</table>
<script type="text/javascript">
 var url;
		function newProduk(){
			$('#dlg_produk').dialog('open').dialog('setTitle','New Produk');
			$('#fm_produk').form('clear');
			url = 'save_produk.php';
		}
		function editProduk(){
			var row = $('#dg_produk').datagrid('getSelected');
			if (row){
				$('#dlg_produk').dialog('open').dialog('setTitle','Edit Produk');
				$('#fm_produk').form('load',row);
				url = 'update_produk.php?id_produk='+row.id_produk;
			}
		}
		function saveProduk(){
			$('#fm_produk').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg_produk').dialog('close');		
						$('#dg_produk').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		function removeProduk(){
			var row = $('#dg_produk').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Apakah benar ingin dihapus?',function(r){
					if (r){
						$.post('remove_produk.php',{id_produk:row.id_produk},function(result){
							if (result.success){
								$('#dg_produk').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
</script>
<script type="text/javascript">
 var url;
		function newTransaksi(){
			$('#dlg_transaksi').dialog('open').dialog('setTitle','New Transaksi');
			$('#fm_transaksi').form('clear');
			url = 'save_transaksi.php';
		}
		function editTransaksi(){
			var row = $('#dg_transaksi').datagrid('getSelected');
			if (row){
				$('#dlg_transaksi').dialog('open').dialog('setTitle','Edit Transaksi');
				$('#fm_transaksi').form('load',row);
				url = 'update_transaksi.php?id_transaksi='+row.id_transaksi;
			}
		}
		function saveTransaksi(){
			$('#fm_transaksi').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg_transaksi').dialog('close');		
						$('#dg_transaksi').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		function removeTransaksi(){
			var row = $('#dg_transaksi').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Apakah benar ingin dihapus?',function(r){
					if (r){
						$.post('remove_transaksi.php',{id_transaksi:row.id_transaksi},function(result){
							if (result.success){
								$('#dg_transaksi').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
</script>
</div>
<div title="Report" data-options="iconCls:'icon-report',closable:true" style="padding:10px">
<div class="demo-info">
<div class="demo-tip icon-tip"></div>
</br>
</br>
</br>
</br>
</br>
</br>
<table width="363" border="0" align="center">
  <tr align="left" valign="middle">
    <td width="200"><font style="font:Verdana, Geneva, sans-serif" color="#666666"> <strong>Total Penjualan Produk :</strong></font></td>
    <td width="136" valign="middle"><form action="printproduk.php" class="form" id="download">
      <div class="row">
        <input name="button2" type="submit" class="form" id="total" value="Download">
      </div>
    </form></td>
  </tr>
  <tr>
   <td width="200"><font style="font:Verdana, Geneva, sans-serif" color="#666666"> <strong>Top Sales :</strong></font></td>
    <td width="136" valign="middle"><form action="printsales.php" class="form" id="download">
      <div class="row">
        <input name="button2" type="submit" class="form" id="total" value="Download">
      </div>
    </form></td>
  </tr>
  <tr>
    <td width="200"><font style="font:Verdana, Geneva, sans-serif" color="#666666"> <strong>Total Uang Didapat :</strong></font></td>
     <td width="136" valign="middle"><form action="printuang.php" class="form" id="download">
      <div class="row">
        <input name="uang" type="submit" class="form" id="total" value="Download">
      </div>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>    
</div>
<div title="Feedback" data-options="iconCls:'icon-tip',closable:true" style="padding:10px">
<h2>Feedback Form</h2>
<div class="demo-info">
<div class="demo-tip icon-tip"></div>
<div>Beri saran tentang App ini.</div>
</div>
<div style="margin:10px 0;"></div>
<div class="easyui-panel" title="New Topic" style="width:400px">
<div style="padding:10px 0 10px 60px">
<form id="ffv" method="post">
<table>
<tr>
<td>Name:</td>
<td><input class="easyui-validatebox" type="text" name="name" data-options="required:true"></input></td>
</tr>
<tr>
<td>Email:</td>
<td><input class="easyui-validatebox" type="text" name="email" data-options="required:true,validType:'email'"></input></td>
</tr>
<tr>
<td>Subject:</td>
<td><input class="easyui-validatebox" type="text" name="subject" data-options="required:true"></input></td>
</tr>
<tr>
<td>Message:</td>
<td><textarea name="message" style="height:100px;"></textarea></td>
</tr>
<tr>
<td>Language:</td>
<td>
<select class="easyui-combobox" name="language"></option><option value="en">English</option><option value="id">Indonesia</option></select>
</td>
</tr>
</table>
</form>
</div>
<div style="text-align:center;padding:5px">
<a href="javascript:void(0)" class="easyui-linkbutton" onClick="submitForm()">Submit</a>
<a href="javascript:void(0)" class="easyui-linkbutton" onClick="clearForm()">Clear</a>
</div>

</div>

<script>
 var url;
    function submitForm(){
			url = 'save_transaksi.php';
                            $('#fff').form('submit',{	
                                    url:url,
                                    onSubmit: function(){
                                            return $(this).form('validate');
                                    },
                                    success: function(result){
                                            var result = eval('('+result+')');
                                            if (result.success){           
                                                    $('#dg12').datagrid('reload');   
                                            } else {
                                                    $.messager.show({
                                                            title: 'Error',
                                                            msg: result.msg
                                                    });
                                            }
                                    }
                            });
                    }


</script>
<script>
$(function () {
var chart6 = new Highcharts.Chart({
chart: {
renderTo: 'container6',
type: 'bar'
},   
title: {
text: 'Karyawan Title '
},
xAxis: {
categories: ['Title']
},
yAxis: {
min: 0,
title: {
text: 'Jumlah Karyawan',
align: 'high'
},
labels: {
overflow: 'justify'
}
},
tooltip: {
valueSuffix: ' Orang Karyawan'
},
legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 100,
                floating: true,
                borderWidth: 0,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
series:             
[<?php 
$sqx   = "SELECT title, COUNT(*)
FROM karyawan
GROUP BY title";  	        
$querx = mysql_query( $sqx ) or die(mysql_error()); 
while( $datax = mysql_fetch_array( $querx ) ){  	               
?> {
name: '<?php echo $datax['title']; ?>',
data: [<?php echo $datax['COUNT(*)']; ?>]
}, <?php } ?>
]
});
});	 
$(function () {
var chart8 = new Highcharts.Chart({
chart: {
renderTo: 'container8',
type: 'bar'
},   
title: {
text: 'Produk '
},
xAxis: {
categories: ['Produk']
},
yAxis: {
min: 0,
title: {
text: 'Total Terjual',
align: 'high'
},
labels: {
overflow: 'justify'
}
},
tooltip: {
valueSuffix: ' Terjual'
},
legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 100,
                floating: true,
                borderWidth: 0,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
series:             
[
<?php 
$sqlv   = "SELECT produk.nama, SUM(transaksi.qty)
FROM produk
RIGHT JOIN transaksi ON produk.id_produk = transaksi.id_produk
GROUP BY nama";  	        
$queryy = mysql_query( $sqlv ) or die(mysql_error()); 
while( $datav = mysql_fetch_array( $queryy ) ){  	               
?> 
{
name: '<?php echo $datav['nama']; ?>',
data: [<?php echo $datav['SUM(transaksi.qty)']; ?>]
},
<?php } ?>
]
});
});	 
$(function () {
    var chart9;
    $(document).ready(function() {
        $.getJSON("databulan.php", function(json) {
       
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container9',
                    type: 'line',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: 'Total Produk Terjual',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Total Jumlah'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: json
            });
        });
   
    });
   
});

	</script>
    
<script>
    function number_format (bilangan, desimal, desimal_poin, pecahan) {
      bilangan = (bilangan + '').replace(/[^0-9+\-Ee.]/g, '');
      var n = !isFinite(+bilangan) ? 0 : +bilangan,
        dipc = !isFinite(+desimal) ? 0 : Math.abs(desimal),
        pech = (typeof pecahan === 'undefined') ? ',' : pecahan,
        desp = (typeof desimal_poin === 'undefined') ? '.' : desimal_poin,
        s = '',
        toFixedFix = function (n, dipc) {
          var k = Math.pow(10, dipc);
          return '' + Math.round(n * k) / k;
        };
      s = (dipc ? toFixedFix(n, dipc) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, pech);
      }
      if ((s[1] || '').length < dipc) {
        s[1] = s[1] || '';
        s[1] += new Array(dipc - s[1].length + 1).join('0');
      }
      return s.join(desp);
    }
     
    function formatPrice(value) {
    return number_format(value, '',',','.');
    }



</script>
</div>

</body>
</html>
