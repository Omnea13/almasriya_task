@extends('layouts.app')

@section('styles')
<style>
    .info {
         border-bottom:1px solid black;
    }
</style>

@endsection

@section('content')

    <section id="items">
        <div class="container-fluid">
            <div class="row">
                <h2>Product Details</h2>
                <div class="container">    
                    <div class="jumbotron">
                      <div class="row" id="container">
                          
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>

    var output = '';
    var draw = function(data) {            
        output = "<div class='col-md-4 col-xs-12 col-sm-6 col-lg-4'><img alt='stack photo' src='{{ asset('public/images/products') }}/"+data.image+"'/></div><div class='col-md-8 col-xs-12 col-sm-6 col-lg-8'><div class='container info'><h2>"+data.title+"</h2></div><hr><ul class='container'><li><p>Categories: "+data.categories+"</p></li></ul></div>";

        $('#container').append(output);
    }

    var url = window.location;
    var id = url.pathname.substring(url.pathname.lastIndexOf('/') + 1);

    console.log(id);
	$.ajax({
        url: "http://localhost/almasriya/task/api/product/"+id,
        method: 'GET',
        success: function (response) {
            console.log(response);
            draw(response);
        },
        error: function (error) {
        }
    });
</script>
@endsection