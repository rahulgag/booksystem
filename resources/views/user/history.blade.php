@extends('user.layouts.main')
@section('main-container')
@section('page_title','app-list') 
@section('app-list','active')
<meta name="csrf-token" content="{{ csrf_token() }}">

	<div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Aponitment History</h3>
                    </div>
                    <div class="col-sm-5 col">
                    </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->schedule->day }}</td>
                        <td>{{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
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
    
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>



