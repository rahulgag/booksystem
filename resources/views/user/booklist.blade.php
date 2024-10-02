@extends('user.layouts.main')
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
                        <h3 class="page-title">Book List</h3>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{url('add-book')}}" class="btn bg-success-light float-right mt-2" style="color:black;">Add</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <form action="{{ route('book.list') }}" method="GET">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or author" class="form-control mb-3">
    <button type="submit" class="btn bg-success-light" style="color:black;">Search</button>
</form>


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
                                        @foreach($books  as $book)
                                        <tr>
                                              <td>{{ $book->title }}</td>
                                              <td>{{ $book->author }}</td>
                                            <td>{{ $book->published_date }}</td>
                                             
                                            <td>
                                                <div class="actions">
                                                    <a class="btn btn-sm bg-success-light " data-id="{{ $book->id }}" id="editid">
                                                        <i class="fe fe-pencil"></i> Edit
                                                    </a>
                                                    <a   id="deleteid" class="btn btn-sm bg-danger-light " data-id="{{ $book->id }}">
                                                        <i class="fe fe-trash"></i> Delete
                                                    </a>
                                                     <a style="color:black;" data-toggle="modal" name="book" data-target="#bookss" href="#" id="{{$book->id}}" bid="{{$book->id}}" class="books btn btn-sm bg-primary-light"> 
                                                        <i class="fe fe-eye"></i>show
                                                    </a>
                                                </div>
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
        $(document).on("click", "#deleteid", function (event) {
            event.preventDefault();
            var projectid = $(this).data('id');
           
            $.ajax({
                type: "POST",
                url: "{{ route('delete.book', ':id') }}".replace(':id', projectid),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function (resp) {
                    $(".error-message").remove();
                    if (resp.status !== 200 && resp.status !== 500) {
                        alert(resp.msg);
                    } else {
                        alert("Book Deleted")
                       location.reload();
                        
                    }
                },
            });

        });
     });
</script>
    <script type="text/javascript">
    $(document).on('click', '.books', function() {
        var bid = $(this).attr("bid");
        $.get("{{ route('bookshow') }}", { bid: bid }, function(datas) {
             $("#book_row").html(datas);
          $("#bookss").appendTo("body").modal('show');
        });
    });
</script>

