$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

let BaseRecord={

   clearone(id) {
      let ajaxSetting = {
         method: 'post', //!!!
         url: '/clearone', //!!!
         data: {
            id: id,
         },
         success: function(data) {
            $('.cart_items_list').html(data.table);
            //BaseRecord.cart();
         },
         error: function(data) {
            console.log(data.responseText);
         },
      };

      $.ajax(ajaxSetting);
   },

   cart() { //!!!NEW METHOD
      let ajaxSetting = {
         method: 'get',
         url: '/cart',
         data: {
            //id: id,
         },
         success: function(data) {
            console.log(data.table);

            $('.cart_items_list').html(data.table); //!!!<ul class="cart_items_list"> in cart.blade.php
         },
      };

      $.ajax(ajaxSetting);
   },      

};