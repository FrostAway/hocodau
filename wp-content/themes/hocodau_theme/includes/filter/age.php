<?php
global $post;
if (get_query_var('tutor-cat')) {
    $slug = 'tutor-cat=' . get_query_var('tutor-cat');
}
?>

<div class="col-sm-12 col-md-6 col-lg-3 ">
    <?php
    $strtuoi = '';
    if (isset($_GET['tuoi'])) {
        $tuoi = $_GET['tuoi'];
        $spltuoi = split('-', $tuoi);
        if (count($spltuoi) > 1) {
            $strtuoi = $tuoi;
        } else {
            $strtuoi = ' > ' . $tuoi;
        }
    }
    ?>
    <div class="dropdown filter-item">
        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Độ tuổi <b><?php echo $strtuoi; ?></b> <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
<?php ?>
            <li><a href="<?= home_url() ?>/?<?= $slug ?>&tuoi=17-20">17 - 20</a></li>
            <li><a href="<?= home_url() ?>/?<?= $slug ?>&tuoi=20-22">20 - 22</a></li>
            <li><a href="<?= home_url() ?>/?<?= $slug ?>&tuoi=22">Trên 22</a></li>
        </ul>
    </div>
</div>
