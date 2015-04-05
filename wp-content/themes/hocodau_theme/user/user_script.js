(function ($) {
    $(document).ready(function () {
        $('#default_role').change(function () {
            if ($(this).val() === 'english-center-role') {
                $('#user_option_role').html(
                        '<div class="form-group">'+
                                        '<label class="col-sm-2 control-label">Tên Trung Tâm</label>'+
                                        '<div class="col-sm-10">'+
                                            '<input type="text" id="first-name" name="first-name" class="form-control"  placeholder="Tên Đầy đủ của trung tâm" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label class="col-sm-2 control-label">Tên Giám Đốc</label>'+
                                        '<div class="col-sm-10">'+
                                            '<input type="text"  name="center-mana" class="form-control"  placeholder="Tên giám đốc" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label class="col-sm-2 control-label">Khóa học chủ đạo</label>'+
                                        '<div class="col-sm-10">'+
                                            '<input type="text"  name="center-course" class="form-control"  placeholder="Một vài Khóa học chủ đạo" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label class="col-sm-2 control-label">Địa chỉ</label>'+
                                        '<div class="col-sm-10">'+
                                            '<a href="#" class="btn btn-default btn-sm" id="add-center-addr"><span class="fa fa-plus"></span></a>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group" id="multi-address">'+
                                        '<div class="col-sm-10 col-sm-offset-2 addr-box">'+
                                            '<input type="text"  name="center-reg-addr[]" class="form-control"  placeholder="Địa chỉ" required="">'+
                                            
                                        '</div>'+
                                    '</div>'
                        );
                
                 $('#add-center-addr').click(function (e) {
            e.preventDefault();
            $('#multi-address .addr-box').append(
                    '<div class="row row-addr">' +
                    ' <div class="col-sm-11">' +
                    '<input style="margin-top: 10px;" type="text"  name="center-reg-addr[]" class="form-control"  placeholder="Địa chỉ cơ sở" required="">' +
                    '</div>' +
                    '<div class="col-sm-1">' +
                    '<a style="margin-top: 10px;" href="#" class="btn btn-danger btn-sm del-center-addr"><span class="fa fa-close"></span></a>' +
                    '</div>' +
                    '</div>'
                    );
            
            $('.addr-box .del-center-addr').click(function(e){
                e.preventDefault();
                $(this).closest('.row-addr').fadeOut().html('');
            });
        });
            }
        });

        $('#add-center-addr').click(function (e) {
            e.preventDefault();
            $('#multi-address .addr-box').append(
                    '<div class="row row-addr">' +
                    ' <div class="col-sm-11">' +
                    '<input style="margin-top: 10px;" type="text"  name="center-reg-addr[]" class="form-control"  placeholder="Địa chỉ cơ sở" required="">' +
                    '</div>' +
                    '<div class="col-sm-1">' +
                    '<a style="margin-top: 10px;" href="#" class="btn btn-danger btn-sm del-center-addr"><span class="fa fa-close"></span></a>' +
                    '</div>' +
                    '</div>'
                    );
            
            $('.addr-box .del-center-addr').click(function(e){
                e.preventDefault();
                $(this).closest('.row-addr').fadeOut().html('');
            });
        });
        
        $('.addr-box .del-center-addr').click(function(e){
                e.preventDefault();
                $(this).closest('.row-addr').fadeOut().html('');
            });
    });
})(jQuery);


