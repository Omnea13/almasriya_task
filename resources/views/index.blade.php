@extends('layouts.app')

@section('styles')
<style>
    .post-img-content {
        height: 196px;
        /*width: 290px;*/
        overflow: hidden;
    }
    .fa {
        margin-right: 5px;
        margin-left: 5px;
    }

</style>

@endsection


@section('content')


<section id="items">
    <div class="container-fluid">
        <div class="row">
            <h2>Products</h2>
            <div class="container" id="Container">
                <a class="btn btn-info" style="float: right;" href="javascript:;" data-toggle="modal" data-target="#CartModal" ><i class='fa fa-shopping-cart'></i>View Cart</a>
            </div>
        </div>
    </div>
</section>

<!-- CartModal -->
<div class="modal fade" id="CartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
            You have 
            <span class="simpleCart_quantity">
            </span> items in your Cart.
            {{-- Cart total: 
            <div class="simpleCart_total">
            </div> --}}
            <div class="simpleCart_items">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" href="javascript:;" class="simpleCart_empty btn btn-danger">Empty Cart</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')   	

    <script>

        var output = '';
        var draw = function(data) {            
            output = "<div class='col-xs-12 col-sm-6 col-md-3'><div class='col-item simpleCart_shelfItem'><div class=''><img class='img-responsive' src='{{ asset('public/images/products') }}/"+data.image+"'/></div><div class='info'><div class='row'><div class='col-md-12'><h3 class='item_name'><a href='details/"+data.id+"'>"+data.title+"</a></h3><div><h5>Categories</h5><h5 class='item_price price-text-color'> "+data.categories+"</h5></div><div style='float: right;'><i class='fa fa-shopping-cart'></i><a href='javascript:;' class='item_add hidden-sm'>Add to cart</a></p></div></div></div>";

            $('#Container').append(output);
        }



    	$.ajax({
            url: "api/product",
            method: 'GET',
            success: function (response) {
                console.log(response);
                //foreach
                for (var i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    draw(response[i]);
                }
            },
            error: function (error) {
            }
        });
    </script>
@endsection