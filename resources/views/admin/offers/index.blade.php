@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Manage Offer</h4>
                <p class="card-category">List of Offers</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <div class="gapMe" >
                    <a href="{{route('admin.offers.create')}}" class="btn btn-primary float-right">Add New</a>
                  </div>
                  <table class="tableRouteManager">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Offer Name</th>
                      <th>Description</th>
                      <th>Type</th>
                      <th>code</th>
                      <th>Start Date</th>
                      <th>Expiry Date</th>
                      <th>Min Package Amount</th>
                      <th>Max Discount</th>
{{--                      <th>Specific Item</th>--}}
{{--                      <th>Restricted Item</th>--}}

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
        ajax: "{{ route('admin.offers') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'type', name: 'type'},
            {data: 'code', name: 'code'},
            {data: 'start_date', name: 'start_date'},
            {data: 'expiry_date', name: 'expiry_date'},
            {data: 'min_package_amount', name: 'min_package_amount'},
            {data: 'max_discount', name: 'max_discount'},
            // {data: 'specific_item', name: 'specific_item'},
            // {data: 'restricted_item', name: 'restricted_item'},
            {{--{data: 'specific_item', name: 'specific_item',render: function( data, type, full, meta ) { return "<img src='"+ "{{asset('sliders')}}/" + data + "' height='50'/>"; }},--}}

            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true,
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