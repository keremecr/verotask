<?php  include('head.php'); ?>
<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>Dashboard</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skin_color.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<?php
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.baubuddy.de/index.php/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"username\":\"365\", \"password\":\"1\"}",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz",
    "Content-Type: application/json"
  ],
]);


$response = curl_exec($curl);
$response=json_decode($response,true);
$access_token=$response['oauth']['access_token'];
curl_close($curl);
$curl1 = curl_init();
curl_setopt_array($curl1, [
  CURLOPT_URL => "https://api.baubuddy.de/dev/index.php/v1/tasks/select",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_HTTPHEADER => [
    'Authorization: Bearer '.$access_token.''
  ],
]);
$response = curl_exec($curl1);
$response=json_decode($response,true);
?>
  
	
<div class="wrapper">

  <?php  include('header.php'); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php  include('sidebar.php'); ?>



  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Data Table With Full Features</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="container">
						<div class="col-md-6" style="float:left;">
	            <div class="form-group">
	            <h5>Search Anything</h5>                   
	               <input type="text" name="text" class="form-control" id="search" onchange="gotoajax()"> 
	            </div>
	          </div>
	          <div class="col-md-6" style="float:left; margin-top:25px;">
	          <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#dosyamodal" style="margin-left:30px;">
					   Upload File
					  </button>
	          </div>
	        </div>
        </div>
					<div class="table-responsive">
					  <table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Task</th>
								<th>Title</th>
								<th>Description</th>
								<th>ColorCode</th>
							</tr>
						</thead>
						<tbody id="searchresults">
							<?php foreach($response as $res) { ?>
								<tr>
									<td><?php echo $res['task']; ?></td>
									<td><?php echo $res['title']; ?></td>
									<td><?php echo $res['description']; ?></td>
									<td style="color:<?php echo $res['colorCode']; ?>"><?php echo $res['colorCode']; ?></td>
								</tr>
						<?php	} ?>
							
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  
			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


   <?php  include('footer.php'); ?>

   <div id="dosyamodal" class="modal fade">
	  <div class="modal-dialog">
		<div class="modal-content bg-primary">
		  <div class="modal-header">
			<h4 class="modal-title">Primary Modal</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span></button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<div class="form-group">
					<h5>Upload Image</h5>
					<div class="controls">
						<input type="file" name="file" class="form-control" onChange="fileupload(this)" required>
						<img src="" id="image"> 
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-rounded btn-primary float-right">Save changes</button>
		  </div>
		</div>
		<!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
  </div>
  </div>

  </body>
</html>
 <script src="js/vendors.min.js"></script>
    <script src="../assets/icons/feather-icons/feather.min.js"></script>	<script src="../assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
	<script src="../assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	<script src="../assets/vendor_components/select2/dist/js/select2.full.js"></script>
	<script src="../assets/vendor_plugins/input-mask/jquery.inputmask.js"></script>
	<script src="../assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="../assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="../assets/vendor_components/moment/min/moment.min.js"></script>
	<script src="../assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="../assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="../assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="../assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="../assets/vendor_plugins/iCheck/icheck.min.js"></script>
	<script src="js/pages/advanced-form-element.js"></script>	
	 <script src="../assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js"></script>
	<script src="../assets/vendor_components/OwlCarousel2/dist/owl.carousel.js"></script>
	<script src="../assets/vendor_components/flexslider/jquery.flexslider.js"></script>
	<script src="js/pages/slider.js"></script>
	
	<!-- Sunny Admin App -->
	<script src="js/template.js"></script>
	
	<script src="js/pages/dashboard.js"></script>

  

<script type="text/javascript">
	function fileupload(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#image').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>

<script>
	function gotoajax(){
		var search=$('#search').val();
		console.log(search);
		$.ajax({
    method:'post',
    url: 'ajax.php',
    data:{search:search},
    dataType: 'html',
    success: function(datam){
      $('#searchresults').html(datam);
    }
  });
	}

</script>