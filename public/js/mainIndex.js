/*
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
*/

let BaseRecord = {

   more: 0,
   search: '',

   showMore() {
      let ajaxSetting = {
         method: 'get',
         url: '/home',
         data: {
            more: this.more,
         },
         success: function(data) {
            console.log(data.table);

            $('.row.products_row').html(data.table);
         },
      };

      $.ajax(ajaxSetting);
   },

   showSearch() {
      let ajaxSetting = {
         method: 'get',
         url: '/home',
         data: {
         	more: 1,
            search: this.search,
         },
         success: function(data) {
            console.log(data.table);

            $('.row.products_row').html(data.table);
         },
      };

      $.ajax(ajaxSetting);
   },   

};