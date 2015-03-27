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
