
<div class="bar-filter">
    <?php
    global $post;
    if (get_query_var('course-cat')) {
        $slug = 'course-cat=' . get_query_var('course-cat');
    } elseif ($post->ID == 87) {
        $slug = 'page_id=87';
    } elseif (isset($_GET['s'])) {
        $slug = 's=' . $_GET['s'];
    }
    ?>
    <div class="col-sm-12 col-md-6 col-lg-3 br">
        <?php
        $price = '';
        if (isset($_GET['gia'])) {
            $price = $_GET['gia'];
            $strprice = split('-', $price);
            if (count($strprice) > 1) {
                $price1 = $strprice[0];
                $price2 = $strprice[1];
                $price = unit($price1) . ' - ' . unit($price2);
            } else {
                $price = '> ' . unit($price);
            }
        }
        ?>
        <div class="dropdown filter-item">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"><?php if (isset($_GET['gia'])) echo '<b>' . $price . '</b>';
        else echo 'Mức giá' ?> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&gia=1000000-2000000">1.000.000 - < 2.000.000</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&gia=2000000-4000000">2.000.000 - < 4.000.000</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&gia=4000000-6000000">4.000.000 - < 6.000.000</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&gia=6000000">Lớn hơn 6.000.000</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-3 br">
        <div class="dropdown filter-item">
            <?php
            $input = $_GET['dau-vao'];
            $key = split('-', $input)[1];
            $value = '';
            if ($key == 1) {
                $value = 'Beginer';
            } elseif ($key == 2) {
                $value = 'Medium';
            } elseif ($key == 3) {
                $value = 'Advance';
            }
            ?>
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Đầu vào <b><?php echo $value; ?></b> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&dau-vao=beginer-1">Beginer</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&dau-vao=medium-2">Medium</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&dau-vao=advance-3">Advance</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-3 br">
        <div class="dropdown filter-item">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Địa điểm <b><?php
            echo get_term($_GET['dia-diem'], 'city-center')->name;
            ?></b> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <?php $citys = get_terms('city-center', array('orderby'=>'name', 'order'=>'ASC', 'hide_empty'=>false)); ?>
                <?php foreach ($citys as $city) { ?>
                    <li><a href="<?= home_url() ?>/?<?= $slug ?>&dia-diem=<?= $city->term_id ?>"><?= $city->name ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-3 br br-last">
        <div class="dropdown filter-item">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Thời gian <b><?php if (isset($_GET['time'])) echo 'Tháng ' . $_GET['time']; ?></b> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" >
            <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <li><a href="<?= home_url() ?>/?<?= $slug ?>&time=<?= $i ?>">Tháng <?= $i ?></a></li>
            <?php } ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<script>

</script>
