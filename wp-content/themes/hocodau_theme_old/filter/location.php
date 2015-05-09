<div class="form-group">
    <label class="control-label">Địa điểm </label>
    <?php $terms = get_terms('city-center', array('hide_empty' => false, 'order' => 'DESC')); ?>

    <?php
    if (isset($_GET['dia-diem']) && $_GET['dia-diem'] != '') {
        $prov = $_GET['dia-diem'];
    }
    ?>
    <select name="dia-diem" class="form-control">
        <option value="">Chọn địa điểm</option>
        <?php foreach ($terms as $term) { ?>
        <option value="<?= $term->name . '-' . $term->term_id ?>" <?php selected($prov, $term->name.'-'.$term->term_id, true) ?>><?= $term->name ?></option>
        <?php } ?>
    </select>
</div>


