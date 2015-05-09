
<div class="bar-filter">
    <div class="row">
        <form class="" id="filter-form" method="get" action="">
            
                <div class="col-sm-6 col-lg-3">
                    <?php include_once 'location.php'; ?>
                </div>
                <div class="col-sm-6  col-lg-3">
                    <?php include_once 'price.php'; ?>
                </div>
                <div class="col-sm-6  col-lg-2">
                    <?php include_once 'input.php'; ?>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <?php include_once 'time.php'; ?>
                </div>
            <div class="col-sm-6  col-lg-1">
                <div class="form-group">
                    <label class="control-label"> Tìm</label>
                    <div><input class="btn btn-success" type="submit" value="Lọc" /></div>
                </div>
            </div>
            <!--<input type="hidden" name="filter-submit" value="filter-submit" />-->
            <div class="col-sm-6  col-lg-1">
                <?php
                global $wp;
                $current_url = home_url(add_query_arg(array(), $wp->request))
                ?>
                <label class="control-label">Bỏ</label>
                <div class="form-group">
                    <a class="btn btn-danger" href="<?php echo $current_url ?>">Xóa</a>
                </div>
            </div>
        </form>

    </div>
</div>

