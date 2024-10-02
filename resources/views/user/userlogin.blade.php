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
								<h1>User</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<!-- Form -->
								<form id="user_log_form" >
                                    @csrf
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Email" name ="emails">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" placeholder="Password" name="passwordata">
                                    </div>
									<div class="form-group mb-0">
										<button class="btn btn-primary btn-block" type="submit">Login</button>
									</div>
                                    <div class="text-right">
									    <a href="{{ url('user-register') }}" style="color:black">Create New  account?</a>
									</div>
								</form>
								<!-- /Form -->
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

    $(document).on("submit", "#user_log_form", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var password = $('input[name="passwordata"]').val();
        var email = $('input[name="emails"]').val();

        // Basic validation before sending AJAX request
        if (email === "") {
            alert("Please Enter Your Email");
            return false;
        }
        if (password === "") {
            alert("Please Enter Your Password");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('user.login') }}",
            processData: false,
            contentType: false,
            data: formData,
            success: function(resp) {
                if (resp.status === 422) {
                    alert(resp.msg); // Invalid login message
                } 
                else if (resp.status === 433) {
                    let errorMessages = "";
                    // Loop through errors and concatenate the messages
                    $.each(resp.errors, function (field, messages) {
                        errorMessages += messages[0] + '\n'; // Show first error for each field
                    });
                    alert(errorMessages); // Show all validation errors
                } 
                else if (resp.status === 200) {
                    alert("Login Successful");
                    window.location.href = "{{ url('app-list') }}"; // Redirect on successful login
                } else {
                    alert("Something went wrong");
                }
            },
            error: function(xhr, status, error) {
                alert("An error occurred: " + error); // Display server error
            }
        });
    });
});

</script>
</html>

