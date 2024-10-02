
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/search.html  30 Nov 2019 04:12:16 GMT -->
<head>
		<meta charset="utf-8">
		<title>Doccure</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="doctor_assets/assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="doctor_assets/assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="doctor_assets/assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="doctor_assets/assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="doctor_assets/assets/plugins/select2/css/select2.min.css">
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="doctor_assets/assets/plugins/fancybox/jquery.fancybox.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="doctor_assets/assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>
		

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			
			
			<!-- Breadcrumb -->
		
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Search Filter -->
							{{-- <div class="card search-filter">
								<div class="card-header">
									<h4 class="card-title mb-0">Search Filter</h4>
								</div>
								<div class="card-body">
								<div class="filter-widget">
									<div class="cal-icon">
										<input type="text" class="form-control datetimepicker" placeholder="Select Date">
									</div>			
								</div>
								
								
									<div class="btn-search">
										<button type="button" class="btn btn-block">Search</button>
									</div>	
								</div>
							</div> --}}
							<!-- /Search Filter -->
							
						</div>
						
						<div class="col-md-12 col-lg-8 col-xl-9">

							<!-- Doctor Widget -->
							
							<form class="bookdoc{{$doctorId}}">
								@csrf
							<div class="card">
								<div class="card-body">
									<div class="doctor-widget">
										<div class="doc-info-left">
											<input type="hidden" name="did" id="did" value={{$doctorId}}>
											<div class="doc-info-cont">
												<h4 class="doc-name"><a href="doctor-profile.html"></a></h4>
												    <form method="POST" >
                                            @csrf
                                            <label for="schedule_id">Select Time Slot:</label>
                                            <select name="schedule_id">
                                                @foreach($schedules as $schedule)
                                                    <option value="{{ $schedule->id }}">
                                                        {{ $schedule->day }} - {{ $schedule->start_time }} to {{ $schedule->end_time }}
                                                    </option>
                                                @endforeach
                                            </select>


											
											</div>
										</div>
										<div class="doc-info-right">
											
											<div class="clinic-booking">
												<a class="apt-btn" onclick="bookP({{$doctorId}})" id="bookapp">Book Appointment</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							</form>
								
							
							
							<!-- /Doctor Widget -->

							

							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			<footer class="footer">
				
				<!-- Footer Top -->
			
				<!-- /Footer Top -->
				
				
				
			</footer>
			<!-- /Footer -->

		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="doctor_assets/assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="doctor_assets/assets/js/popper.min.js"></script>
		<script src="doctor_assets/assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="doctor_assets/assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="doctor_assets/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Select2 JS -->
		<script src="doctor_assets/assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="doctor_assets/assets/js/moment.min.js"></script>
		<script src="doctor_assets/assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Fancybox JS -->
		<script src="doctor_assets/assets/plugins/fancybox/jquery.fancybox.min.js"></script>
		
		<!-- Custom JS -->
		<script src="doctor_assets/assets/js/script.js"></script>
		
	</body>

<!-- doccure/search.html  30 Nov 2019 04:12:16 GMT -->
<script>
	function bookP(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let form = $('.bookdoc' + id).serialize();
	// console.log(form)
   $.ajax({
    type: 'post',
    url: "{{ route('book.request') }}",
    data: form,
    success: function(resp) {
        if (resp.status == 422) {
            alert('Validation failed: ' + resp.errors.schedule_id);
        } else if (resp.status == 500) {
            alert(resp.msg);
            location.reload();
        } else if (resp.status == 200) {
            alert(resp.msg);
            location.reload();
        }
    },
    error: function(error) {
        console.error("Error: " + error.responseText);
        // You can handle other error responses here
    }
});

}
</script>

</html>