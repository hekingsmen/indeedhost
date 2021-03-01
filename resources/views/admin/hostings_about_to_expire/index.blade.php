@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Upcoming Hosting Expiry</h4>
                <p class="card-category"> List of Hostings</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  {{--<a href="{{route('admin.orders.create')}}" class="btn btn-primary">Add New</a>--}}
                  <!-- <div class="form-group">
                    <label for="sel1">Select Status:</label>
                    <select class="form-control" id="selectstatus">
                      <option value="process">Process</option>
                      <option value="completed">Completed</option>
                      <option value="cancel">Cancel</option>
                    </select>
                  </div> -->
                  <table class="tableHosting">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>Amount</th>
                      <th>Will Expired In (days) </th>
                      <th>Transaction ID</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Status</th>
                      <th>Action</th>
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
</div>
@endsection


@push('scripts')

<script type="text/javascript">
  
  	$(document).ready(function() {
    $('.tableHosting').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('admin/hostings/about/to/expire/') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'sub_total', name: 'sub_total'},
            {data: 'leftDays', name: 'leftDays'},
            {data: 'payment_id', name: 'payment_id'},
            {data: 'activation_date', name: 'activation_date'},
            {data: 'expire_date', name: 'expire_date'},
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },

        ]

    });

  } );



  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
      });
  function deleteData(e){
    var table = $('.tableHosting').DataTable();
    var id = e.getAttribute('data-id');
    var url = e.getAttribute('data-url');
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $.ajax({
                  url : url,
                  type : "POST",
                  data : {'_method' : 'DELETE'},
                  success: function(){
                      swal({
                          title: "Success!",
                          text : "Post has been deleted \n Click OK to refresh the page",
                          icon : "success",
                      },
                      function(){ 
                          location.reload();
                          table.row($(e).parents('tr')).remove().draw(false);
                      });
                  },
                  error : function(){
                      swal({
                          title: 'Opps...',
                          text : "Something Wrong",
                          type : 'error',
                          timer : '1500'
                      })
                  }
              })
          } else {
          swal("Your imaginary file is safe!");
          }
      });
  }
</script>

@endpush