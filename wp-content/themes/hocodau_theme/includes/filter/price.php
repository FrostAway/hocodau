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
