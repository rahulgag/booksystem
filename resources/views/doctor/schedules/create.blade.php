@extends('doctor.layouts.main')
@section('main-container')
@section('page_title','create-appo') 
@section('create-appo','active')
	<div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Create schedule </h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="add_project">
                        @csrf
                        <div class="row form-row">
                             <label for="day">Day:</label>
    <select name="day">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
    </select>

    <label for="start_time">Start Time:</label>
    <input type="time" name="start_time">

    <label for="end_time">End Time:</label>
    <input type="time" name="end_time">

                           
                        </div>
                        <button type="submit" class="btn bg-success-light " style="color:black;">Save</button>
                    </form>
                           
                        </div>
                    </div>
                </div>          
            </div>
        </div>          
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on("submit", "#add_project", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
      
        $.ajax({
            type: "POST",
            url: "{{ route('insert.appo') }}",
            processData: false,
            contentType: false,
            data: formData,
            success: function (resp) {
                $(".error-message").remove();
                if (resp.status === 433) {
                    let errorMessages = "";
                    $.each(resp.errors, function (field, messages) {
                         errorMessages += messages[0] + '\n';
                    });
                    alert(errorMessages)
                   
                } else if (resp.status !== 200 && resp.status !== 500) {
                   
                    alert(resp.msg)
                } else {
                    alert("Schedule crated Successfully")
                    url = "{{ url('/book-list') }} ";
                    window.location.href = url;
                    
                }
            },
        });

    });
    </script>