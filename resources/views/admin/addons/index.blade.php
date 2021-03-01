@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Addons</h4>
                <p class="card-category"> List of addons</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="tableHosting">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Title</th>
                      <th>Addon Key</th>
                      <th>Crud</th>
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
        ajax: "#",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'tittle', name: 'tittle'},
            {data: 'addon_key', name: 'addon_key'},
            {data: 'actions', name: 'actions'},
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