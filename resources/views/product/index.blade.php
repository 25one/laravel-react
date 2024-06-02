@extends('product.layout')

@section('css')
<style>
.mr-auto {
   margin-bottom: 1em;	
}
</style>    
@endsection

@section('main')

<div class="super_container_inner">
    <div class="super_overlay"></div>
    
        <!-- Products -->

        @php
        //print_r($products);
        @endphp

        <div class="products">
          <div class="container">
            <div class="row products_row">

                    @include('product.brick-standard')               

            </div>
            </div>
          </div>
        </div>

        <div class="button load_more ml-auto mr-auto"><a href="#" class="link_again">more</a></div>

</div>

@endsection

@section('js')
<script src="{{ asset('js/mainIndex.js') }}"></script>
<script>
$(document).ready(function(){
   //alert('hi');
   $('.load_more').click(function() {
      BaseRecord.more = 1;
      BaseRecord.showMore();
      return false;
   });

   $('.header_search_button').click(function() {
      BaseRecord.search = $('.search_input').val(); 
      BaseRecord.showSearch();
   });
});
</script>  
@endsection