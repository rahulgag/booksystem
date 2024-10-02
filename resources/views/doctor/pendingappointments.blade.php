@extends('doctor.layouts.main')
@section('main-container')
@section('page_title','list-appo') 
@section('list-appo','active')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                                <table class=" table table-hover table-center mb-0" id="category_table">
                                    <thead>
                                        <tr>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Time Slot</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->schedule->day }}</td>
                        <td>{{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>
                            <!-- Accept Button -->
                            <form action="{{ route('doctor.appointments.accept', $appointment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>

                            <!-- Reject Button -->
                            <form action="{{ route('doctor.appointments.reject', $appointment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                                        
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

</script>
<script>
     $(document).ready(function () {
         $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
         });
        $(document).on("click","#editid",function(e){
            e.preventDefault();
            var ids = $(this).data('id');
            var url = "{{ url('edit-book') }}?ids=" + ids;
            window.location.href = url;

        });
       
     });
</script>
    

