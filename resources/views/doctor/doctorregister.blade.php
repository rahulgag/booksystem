<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
      <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/font-awesome.min.css')}}">

    <!-- Feathericon CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/feathericon.min.css')}}">


	<link rel="stylesheet" href="{{url('admin_assets/plugins/morris/morris.css')}}">

    <!-- Main CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/style.css')}}">
</head>
<body>
	<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Doctor Register</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<!-- Form -->
								<form id="user_register_form" >
                                    @csrf
                                    <div class="form-group">
                                        <label class="focus-label">Name</label>
										<input type="text" class="form-control" name="name">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="focus-label">Mobile Number</label>
										<input type="text" class="form-control" name="mobile_number">
                                        
                                    </div>
                                    <div class="form-group">
                                         <label class="focus-label">Email</label>
										<input type="email" class="form-control" name="emails">
                                       
                                    </div>
									<div class="form-group">
                                        <label class="focus-label">Create Password</label>
										<input class="form-control" type="password" placeholder="Password" name="passwordata">
                                        
                                    </div>
                                    <div class="text-right">
									    <a href="{{ url('doctorlogin') }}" style="color:black">Already have an account?</a>
									</div>
									<div class="form-group mb-0">
										<button class="btn btn-primary btn-block" type="submit">Register</button>
									</div>
								</form>
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<!-- /Main Wrapper -->

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(document).on("submit", "#user_register_form", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var name = $('input[name="name"]').val();
        var mnumber = $('input[name="mobile_number"]').val();
        var password = $('input[name="passwordata"]').val();
        var email = $('input[name="emails"]').val();
        if (name == "") {
             alert("Please Enter Your Name")
            return false; // Prevent form submission
        }
        if (mnumber == "") {
             alert("Please Enter Your Mobile Number")
            return false; // Prevent form submission
        }
        if (email == "") {
            alert("Please Enter Your Email")
            return false; // Prevent form submission
        }
        if (password == "") {
             alert("Please Enter Your Password")
            return false; // Prevent form submission
        }
        $.ajax({
            type: "POST",
            url: "{{ route('doctorregister') }}",
            processData: false,
            contentType: false,
            data: formData,
            success: function(resp) {
                 if (resp.status === 422) {
                        alert(resp.msg);
                    } 
                    else if (resp.status === 433) {
                        let errorMessages = "";
                        $.each(resp.errors, function (field, messages) {
                            errorMessages += messages[0] + '\n';
                        });
                        alert(errorMessages)
                    } 
                    else if (resp.status !== 200 && resp.status !== 500) {
                        alert(resp.msg);
                    } else {
                            alert("Register Successful");
                            window.location.href = "{{ url('doctorlogin') }}";  
                    }
            },
            error: function(xhr, status, error) {
            }
        });
      
      
    });

    
    });
</script>

</html>

