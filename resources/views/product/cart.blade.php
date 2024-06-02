@extends('product.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
<style>
.listbuttonremove {
	margin: 10px;   
}
</style>    
@endsection

@section('main')

        <div class="cart_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="cart_container">
                            
                            <script>
                                window.carts = @json($carts); //!!!variable from php to js in blade
                            </script>                              

                            <!-- Cart Block -->
                            <div class="cart_block">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> 

@endsection

@section('js')
<!-- <script src="{{ asset('js/mainCart.js') }}"></script> -->

<script src="{{ mix('js/cart.js') }}"></script> <!-- !!!mix cart.js - only react -->
<script>
$(document).ready(function(){
   /* 
   $('.button_clear').click(function(){
      form_clearall.submit(); 
      return false; //!!!<a href="#">... 
   });
   */
   /*
   //$('.listbuttonremove').click(function(){
   $('body').on('click', '.listbuttonremove', function() { 
      BaseRecord.clearone($(this).attr('id')); //!!!
      return false;
   });
   */
});
</script>
@endsection