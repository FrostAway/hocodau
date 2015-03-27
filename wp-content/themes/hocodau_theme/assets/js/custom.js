$(document).ready(function(){
   $('#basic-addon2').click(function(){
       $('.search-form').submit();
   }) ;
   
   
   $('#search-option li a').click(function(){
       $('#basic-addon1 .text').html($(this).text());
       var posttype = $(this).attr('data-type');
       $('#search-option-ap').val(posttype);
       $('#search-form').removeClass('open');
       return false;
   });
   
   $('#comment-more').click(function(){
       $('.reviews-list li').fadeIn(300);
       $('#btn-load-comment').html('');
       return false;
   });
});


