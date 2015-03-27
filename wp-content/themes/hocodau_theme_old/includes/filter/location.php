<div class="col-sm-12 col-md-6 col-lg-3 br">
    <div class="dropdown filter-item">
        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Địa điểm <b><?php
                global $provices;
                echo $provices[$_GET['dia-diem']];
                ?></b> <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
            <?php global $provices; ?>
            <?php foreach ($provices as $key => $value) { ?>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&dia-diem=<?= $key ?>"><?= $value ?></a></li>
<?php } ?>
        </ul>
    </div>
</div>
