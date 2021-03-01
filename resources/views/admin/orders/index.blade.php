@extends('admin.layouts.app')

@section('content')

<div class="main-panel">

  <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="card-header card-header-primary">

                <h4 class="card-title ">Orders</h4>

                <p class="card-category"> List of orders</p>

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

                      <th>Payment Status</th>

                      <th>Transaction ID</th>

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

  // var table = $('#tableHosting').DataTable();

  // $('#selectstatus').on( 'change', function () {

  //     table.search( this.value ).draw();

  // } );

  	$(document).ready(function() {

    $('.tableHosting').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('admin.orderslist',$type) }}",

        columns: [

            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'email', name: 'email'},

            {data: 'sub_total', name: 'sub_total'},

            {data: 'payment_status', name: 'payment_status'},

            {data: 'payment_id', name: 'payment_id'},

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