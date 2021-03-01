@extends('admin.layouts.app')

@section('content')

<div class="main-panel">

  <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="card-header card-header-primary">

                <h4 class="card-title ">Routes Manager</h4>

                <p class="card-category">List of Routes</p>

              </div>

              <div class="card-body">

                <div class="table-responsive">
                  <div class="gapMe" >
                  <a href="{{route('admin.routesmanager.create')}}" class="btn btn-primary float-right">Add New</a>
                  </div>

                  <table class="tableRouteManager">

                    <thead class=" text-primary">

                      <th>ID</th>

                      <th>Route Name</th>

                      <!-- <th>Route Slag</th> -->

                      <th>Route Url</th>

                      <th>Route Action</th>

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

    $('.tableRouteManager').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('admin.routesmanager.index') }}",

        columns: [

            {data: 'id', name: 'id'},

            {data: 'route_name', name: 'route_name'},

            // {data: 'route_slag', name: 'route_slag'},

            {data: 'route_url', name: 'route_url'},

            {data: 'route_action', name: 'route_action'},

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

    var table = $('.tableRouteManager').DataTable();

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

                      }).then(function(){

                          $(e).closest("tr").remove();

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