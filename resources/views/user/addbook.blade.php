@extends('user.layouts.main')
@section('main-container')
@section('page_title','project-list') 
@section('project-list','active')
	<div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Add Book</h3>
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
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control title" name="title" id="title">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" class="form-control author" name="author" id="author">
                                </div>
                            </div>
                               <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>Description</label>
                                        <textarea id="description" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>Published Date</label>
                                    <input type="date" id="published_date" class="form-control" name="published_date" >
                                </div>
                            </div>
                           
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
        var title = $('input[name="title"]').val();
        var published_date = $('input[name="published_date"]').val();
        var author = $('input[name="author"]').val();
        if (title == "") {
             alert("Please Enter Your Title Name")
            return false; 
        }

        if (author == "") {
              alert("Please Enter a Author name");
            return false; 
        }
        if (published_date == "") {
             alert("Please Enter a publish Date");
            return false; 
        }
        
       
        $.ajax({
            type: "POST",
            url: "{{ route('insert.book') }}",
            processData: false,
            contentType: false,
            data: formData,
            success: function (resp) {
                $(".error-message").remove();
                if (resp.status === 422) {
                    let errorMessages = "";
                    $.each(resp.errors, function (field, messages) {
                         errorMessages += messages[0] + '\n';
                    });
                    alert(errorMessages)
                   
                } else if (resp.status !== 200 && resp.status !== 500) {
                   
                    alert(resp.msg)
                } else {
                    alert("Book Inserted Successfully")
                    url = "{{ url('/book-list') }} ";
                    window.location.href = url;
                    
                }
            },
        });

    });
    </script>