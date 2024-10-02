@extends('doctor.layouts.main')
@section('main-container')
@section('page_title','book-list') 
@section('book-list','active')
<meta name="csrf-token" content="{{ csrf_token() }}">

	<div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Aponitment Schedule</h3>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{url('add-book')}}" class="btn bg-success-light float-right mt-2" style="color:black;">Add</a>
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
                                           <th>Title</th>
                                            <th>Author</th>
                                            <th>Published Date</th>
                                            <th>Actions</th>
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
    
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>



