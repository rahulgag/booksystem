<script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
<style type="text/css" media="print">
	@page {
		size: auto;   /* auto is the initial value */
		margin: 0mm;  /* this affects the margin in the printer settings */
		size: portrait;		
/*		width: 90%;	*/
	}

</style>
<style>
    	.bt
	{
	    border-top: 0px solid #dee2e6;
	}
</style>
<style>
    .table3 {
        width: 100%;
        margin: 0 auto;
        padding: 3px;
        border-collapse: collapse;
    }

    .table3 th, .table3 td {
        border: 1px solid #dee2e6;
        padding: 8px;
        text-align: left;
    }

    .table3 th {
        background-color: #f2f2f2;
        font-weight: bold;
        font-size:13px;
    }
    
    .table3 tbody td {
       
        font-size:13px;
    }

    .table3 tr:first-child th {
        border-top: none;
    }
</style>

  <div class='mp' style='font-size:1px;margin:7px;font-family:Times New Roman'>
    <div class="modal-body">
        <div class="row">
    		<table class='table3 mt-4' style="border-collapse: collapse;">
                <tr>
                    @if($bookData)
                        <th style="border: 1px solid black;">Title:</th>
                        <td style="border: 1px solid black;"><i style="font-weight:300;font-style:normal">{{$bookData->title}}</i></td>
                        <br>
                        <th style="border: 1px solid black;">Author</th>
                        <td style="border: 1px solid black;"><i style="font-weight:300;font-style:normal">{{$bookData->author}}</i></td>
                        <th style="border: 1px solid black;">Description</th>
                        <td style="border: 1px solid black;"><i style="font-weight:300;font-style:normal">{{$bookData->description}}</i></td>
                        <th style="border: 1px solid black;">Published Date</th>
                        <td style="border: 1px solid black;"><i style="font-weight:300;font-style:normal">{{$bookData->published_date}}</i></td>
                        @else
                       <h4>No data available for the specified conditions.</h4>
                    @endif
                </tr>
          
                
            </table><br>
    		
    		 
    	</div>
    </div>
</div>
        </div>
    </div>
    </div>