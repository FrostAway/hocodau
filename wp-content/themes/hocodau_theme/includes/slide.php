<div id="slide">
    <div class="sl-items">
        <div class="sl-item">
            <a href="#"><img class="img-responsive banner" src="<?php echo get_option('banner-img')  ?>" /></a>
            <div class="row">
                <div class="col-xs-12 col-sm-6 banner-title">
                    <h3><?= get_option('banner-title-1') ?></h3>
                    <h4><?= get_option('banner-title-2'); ?></h4>
                </div>
                <div class="col-xs-12 col-sm-6 ad-search-box">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" ><a href="#s-course" aria-controls="s-course" role="tab" data-toggle="tab"><span class="fa fa-book"> </span> Khóa học</a></li>
                            <li role="presentation" ><a href="#s-center" aria-controls="s-center" role="tab" data-toggle="tab"><span class="fa fa-university"> </span> Trung tâm</a></li>
                            <li role="presentation" ><a href="#s-club" aria-controls="s-club" role="tab" data-toggle="tab"><span class="fa fa-users"> </span> Club</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="s-course">
                            <form method="get" action="" class="ad-searchform"> 
                                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm khóa học" />
                                <input type="hidden" id="search-option-ap" name="post_type" value="course" />
                                <input type="submit" class="btn btn-success pull-right" value="Tìm kiếm" />
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="s-center">
                            <form method="get" action="" class="ad-searchform"> 
                                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm Trung tâm" />
                                <input type="hidden" id="search-option-ap" name="post_type" value="english-center" />
                                <input type="submit" class="btn btn-success pull-right" value="Tìm kiếm" />
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="s-club">
                            <form method="get" action="" class="ad-searchform"> 
                                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm Câu lạc bộ" />
                                <input type="hidden" id="search-option-ap" name="post_type" value="english-club" />
                                <input type="submit" class="btn btn-success pull-right" value="Tìm kiếm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script>
        $(document).ready(function () {
            $('#slide .sl-item img').load(function () {
                $(this).fadeIn(300);
            });
        });
    </script>
</div>


<?php if (is_home()) { ?>

    <?php include_once 'small-menu.php'; ?>

<?php } ?>

