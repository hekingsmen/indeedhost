@extends('admin.layouts.app')
@section('content')

<div class="main-panel">

  <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="card-header card-header-primary">

                <h4 class="card-title ">Users</h4>

                <p class="card-category">List of users</p>

              </div>

              <div class="card-body">

                <div class="table-responsive">

                	<div class="gapMe" >
                    
                    <a href="{{route('admin.users.create')}}" class="btn btn-primary givemesomespace float-right">Add New</a>

                  </div> 


                  <table class="tableUser">

                    <thead class=" text-primary">

                      <th>ID</th>

                      <th>Name</th>

                      <th>email</th>

                      <th>User Role</th>

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

    $('.tableUser').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('admin.users.index') }}",

        columns: [

            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'email', name: 'email'},

            {data: 'user_role', name: 'user_role'},

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

    var table = $('.tableUser').DataTable();

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