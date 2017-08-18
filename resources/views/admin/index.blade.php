@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/plugins/slim/slim.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}">
    <style>
        .mt-20 {
            margin-top: 20px;
        }
        .add-new {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
@endsection


@section('content')

<div class="container">
    {{-- <div class="row"> --}}
        <div class="col-md-12">
            <button class="btn btn-primary btn-block add-new" data-toggle="modal" data-target="#add-product-modal"> Add New Product</button>
        </div>
        <div class="row mt-20">
                <div class="col-md-12">
                    <table class="table table-striped" id="myTable" style="border-collapse:collapse;" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Categories</th>
                                <th>photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
        </div>
    {{-- </div> --}}
</div>



<!--======================================
=            Add Product Modal              =
=======================================--> 
<div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="#" method="POST" id="add-product-form">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-center">Add Product</h4>
            </div>
            <div class="modal-body">
                <div class="form-group clearfix">
                    <div class="col-xs-4 col-xs-offset-4">
                        <div class="slim"
                            data-label="Drop ProductProduct Image"
                            data-size="240,240"
                            data-ratio="1:1">
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 prl-20">
                        <div class="form-group">
                            <label>Product Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 prl-20">
                        <div class="form-group">
                            <label>Product Categories </label>
                            <input type="text" name="categories" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!--====  End of Add Product Modal   ====-->


<!--======================================
=            Edit Product Modal             =
=======================================--> 
<div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="#" method="POST" id="edit-product-form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-center">Edit Product</h4>
            </div>
            <div class="modal-body">
                <div class="form-group clearfix">
                    <div class="col-xs-4 col-xs-offset-4">
                        <div class="slim"
                            data-label="Drop Product Image"
                            data-size="240,240"
                            data-ratio="1:1">
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-md-12 prl-20">
                        <div class="form-group">
                            <label>Product Title </label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 prl-20">
                        <div class="form-group">
                            <label>Product Categories </label>
                            <input type="text" name="categories" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!--====  End of Add Product Modal   ====-->


@endsection



@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        // $(document).ready(function(){
        //     $('#myTable').DataTable();
        // });


        $.ajax({
            url: "api/product",
            method: 'GET',
            success: function (response) {
                console.log('response:',response);
                //foreach
                for (var i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    draw(response[i]);
                }
            },
            error: function (error) {
            
            }
        });

        var output = '';
        var draw = function(data) {            
            output = "<tr><td>"+data.id+"</td><td>"+data.title+"</td>"+
                      "<td>"+data.categories+"</td><td>"+
                      "<td><img src='{{ asset('public/images/products') }}/"+data.image+"' alt='"+data.name+"'></td>"+
                      "<td><a class='btn btn-danger delete-product' data-delete='"+data.id+"'>Delete</a><a class='btn btn-info edit-product' data-edit='"+data.id+"'>Edit</a></td></tr>";

            $('#myTable tbody').append(output);

            $(".edit-product").on("click", function(){
                var id = $(this).data('edit');
                console.log(id);
                $.ajax({
                    url: "http://localhost/almasriya/task/api/product/"+id+"/edit",
                    data: {id: id},
                    method: 'GET',
                    success: function (response) {
                        // render data in modal
                        $("form#edit-product-form input[name='id']").val(response.id);
                        $("form#edit-product-form input[name='title']").val(response.title);
                        $("form#edit-product-form input[name='categories']").val(response.categories);
                        $("form#edit-product-form .slim img").attr('src', 'public/images/products/'+response.image);
                        // show this modal
                        $("#edit-product-modal").modal('show');
                    },
                    error: function (error) {

                    }
                });
            });

            $(".delete-product").on("click", function() {
            var id = $(this).data('delete');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Category!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: "http://localhost/almasriya/task/api/product/"+id,
                    data: {id: id, _token: '{{ csrf_token() }}', _method: 'DELETE'},
                    type: "DELETE",
                    success: function(response) {
                        swal("Deleted!", "Category has been deleted.", "success");
                        window.location.reload();
                    },
                    error: function(response) {
                        
                    },
                    beforeSend: function() {
                    }
                });    
            });
        });

        }

        $("form#edit-product-form").on('submit', function(event) {
                event.preventDefault();
                var id = $("form#edit-product-form input[name='id']").val();
                console.log(this);
                $.ajax({
                    url: "http://localhost/almasriya/task/api/product/"+id,
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(response) {
                    },
                    beforeSend: function() {
                    }
                });
        });

        $("form#add-product-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "api/product",
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: "POST",
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    var errors = response.responseJSON;
                },
                beforeSend: function() {
                }
            });
        });
        

    </script>
    	
@endsection