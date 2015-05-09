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
