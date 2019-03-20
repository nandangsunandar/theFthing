<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List Barang</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
</head>
<body>
<div class="container">
	<!-- Page Heading -->
        <div class="row">
            <h1 class="page-header">Data
                <small>COSTOMER</small>
            </h1>
            <button id="add" class="btn btn-success btn-sm"  onclick="add()" title="Input Data">Add</i></button> 
            <button id="close" class="btn btn-danger btn-sm"  onclick="closes()" title="Input Data">Close</i></button> 
        </div>

        <div class="row" id="forminput">
                    <div class=" form">
                <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="Id_customer"/>
                <input type="hidden" value="1" name="proses"/>
                <div class="panel-body">
            
                    <div class="form-group">
                        <label class="control-label col-md-4">Name</label>
                        <div class="col-md-6">
                            <input type="text" 
                                                        name="name"
                                                        id="name"                                                                                      
                                                        class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Email</label>
                        <div class="col-md-6">
                            <input type="text" 
                                                        name="email"
                                                        id="email"                                        
                                                        class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Password</label>
                        <div class="col-md-6">
                            <input type="Password" 
                                                        name="password"
                                                        id="password"                                                                                      
                                                        class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-4">Gender</label>
                    <div class="col-md-3">
                        <select class="form-control" tabindex="2" name="gender" required>
                        <option value="">-Pilih-</option>
                        <option value="1"> Male </option>
                        <option value="2"> Female </option>
                        
                        </select>
                    </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-md-4">Status</label>
                        <div class="col-md-3">
                            <select class="form-control" tabindex="2" name="status" required>
                            <option value="">-Pilih-</option>
                            <option value="1"> Single </option>
                            <option value="2"> Married </option>
                            
                            </select>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-md-4">Address</label>
                        <div class="col-md-6">
                            <textarea  type="text" 
                                                        name="address"
                                                        id="address"
                                                                    
                                                        class="form-control">
                                                            
                                                        </textarea>
                        </div>
                    </div>
                    
     
                   
                   
 

                </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="savecustomer()" class="btn btn-primary">Simpan</button>
                    </div>
                 
   
        </div>
	<div class="row">
		<table class="table table-striped" id="datacustomer" width="80%">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Password</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Alamat</th>
				</tr>
			</thead>
			<tbody id="show_data">
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript" src="./assets/js/jquery.js"></script>
<script type="text/javascript" src="./assets/js/bootstrap.js"></script>
<script type="text/javascript" src="./assets/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $('#forminput').hide();	
    $('#close').hide();	
		
	//	$('#datacustomer').dataTable();
		 


// ditulis disini
 function load_ajax(){
 	const ajax = new XMLHttpRequest();
 	ajax.open('GET', 'http://localhost/RestAPI/index.php/customer/index_get', true);
 	ajax.onreadystatechange = function(){
 		if(this.readyState ===4 && this.status ===200){
 			let data = JSON.parse(this.responseText)
 			for (var i=0; i<data.length; i++) {
                 var gen =data[i].gender;
                 var married =data[i].is_married;
                 if(gen==1){var gender='Male';}else{var gender='Female';}
                 if(married==1){var status='Married';}else{var status='Single';}
			   document.getElementById('show_data').innerHTML += '<tr>'+
		                  		'<td width="10%">'+data[i].name+'</td>'+
		                        '<td width="10%">'+data[i].email+'</td>'+
                                '<td width="10%">'+data[i].Password+'</td>'+
                                '<td width="10%">'+gender+'</td>'+
                                '<td width="10%">'+status+'</td>'+
                                '<td width="10%">'+data[i].address+'</td>'+
                                '<td width="10%"> <button class="btn btn-warning btn-xs" onclick="editcustomer('+data[i].Id_customer+')">edit</i></button> <button class="btn btn-danger btn-xs" onclick="deleted('+data[i].Id_customer+')">delete</i></button></td>'
		                        '</tr>';
			}
 		}
 	}
 	ajax.send();
 }
 load_ajax();

	});
    
    function closes()
    {
      //$('#forminput')[0].reset(); 
      $('#forminput').hide(); 
      $('#close').hide();
      $('#add').show();
    }
    function add()
    {
        save_method = 'add';
      $('#forminput').show(); 
      $('#close').show();
      $('#add').hide();
    }
    
    function editcustomer(idcustomer)
    {
      save_method = 'update';
      //$('#form')[0].reset(); // reset form on modals
     
      //Ajax Load data from ajax
      $.ajax({
        url : "http://localhost/RestAPI/index.php/customerprocess/edit/" + idcustomer,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="name"]').val(data.name);
            $('[name="email"]').val(data.email);
            $('[name="password"]').val(data.Password);
            $('[name="gender"]').val(data.gender);
            $('[name="status"]').val(data.is_married);
            $('[name="address"]').val(data.address);
            $('[name="Id_customer"]').val(data.Id_customer);
            $('#forminput').show(); 
          

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      
    });

    }
    function savecustomer()
    {
       

      var url;
    
          url = "http://localhost/RestAPI/index.php/customer/index_post/";
  

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
            
			 alert(' Data Telah Di Simpan ..!');
             location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error proses simpan data');
            }
        });
    }

    function deleted(Id_customer)
    {
      if(confirm('Apakah anda yakin akan menghapus data ini?'))
      {
        
          $.ajax({
            url : "http://localhost/RestAPI/index.php/customerprocess/delete/" +Id_customer,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }
</script>

</body>
</html>