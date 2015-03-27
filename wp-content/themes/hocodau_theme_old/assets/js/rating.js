$(document).ready(function () {
    $('.stars a').hover(function () {
        $(this).prevAll().andSelf().addClass('rate-hover');
        $(this).nextAll().removeClass('rate-hover');
    }, function () {
        $(this).prevAll().andSelf().removeClass('rate-hover');
    });

    $('.stars a').click(function (e) {
        e.preventDefault();
        var num = parseInt($(this).text());
        $(this).prevAll().andSelf().addClass(('rate-set'));
        $(this).nextAll().removeClass('rate-set');
        $('#rating').val(num);
    });
    
    $('#commentform').submit(function(){
       var rate = $('#commentform #rating').val();
       if(rate===''){
           alert('Vui lòng chọn đánh giá của bạn');
           return false;
       }
    });
    
    
    $('.star-rating span .num').each(function(index){
        var num = parseFloat($(this).text());
        $(this).parent("span").css("width", num*100/5+"%");
    });
});


