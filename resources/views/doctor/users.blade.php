@extends('doctor.layouts.main')
@section('main-container')
@section('page_title','doctor-users') 
@section('list-appo','active')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


	<div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Book List</h3>
                    </div>
                      @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
            


                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="datatable table table-hover table-bordered" id="userslist">
                                    <thead>
                                        <tr>
                    <th> Name</th>
                    <th>email</th>
                    <th>mobile number</th>
                   
                </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>          
    </div>
    <div class="modal fade" id="bookss" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="form-group row m-1 modal-header">
                <div class="col-sm-10">
                    <h4 class="modal-title" style="text-align:left;font-weight:bold">Book Details</h4>
                </div>
                <div class="col-sm-2  text-right">
                    <button type="button" class="btn btn-secondary fa fa-close text-right btn btn-danger" style="padding: 1px 3px;" data-dismiss="modal"></button>
                </div>
            </div>
            <div id='book_row' class="modal-body">
                
            </div>
        </div>
    </div>
</div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script>
let user_datatable;

$(document).ready(function() {
    var _token = $('meta[name="csrf-token"]').attr('content');

    if ($.fn.DataTable.isDataTable('#userslist')) {
        $('#userslist').DataTable().destroy();
    }

    user_datatable = $("#userslist").DataTable({
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        lengthChange: false,
        responsive: true,
        colReorder: true,
        searching: false,
        ajax: {
            url: "{{ url('users-data-list') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': _token
            },
              data: {
                "_token": "{{ csrf_token() }}",
                // other data
            },
        
        },
        // Specify how DataTables maps the data returned from the server
        
    });
});


</script>

    

