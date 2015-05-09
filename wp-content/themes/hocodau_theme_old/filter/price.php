<div class="form-group">
    <label class="control-label">Mức giá</label>

    <?php
    if (isset($_GET['muc-gia']) && $_GET['muc-gia'] != '') {
        $price = $_GET['muc-gia'];        
    }
    ?>

    <select class="form-control" name="muc-gia">
        <option value="">Chọn mức giá</option>
        <option value="1000000-2000000" <?php selected($price, '1000000-2000000', true) ?>>1 triệu - 2 triệu</option>
        <option value="2000000-4000000" <?php selected($price, '2000000-4000000', true) ?>>2 triệu - 4 triệu</option>
        <option value="4000000-6000000" <?php selected($price, '4000000-6000000', true) ?>>4 triệu - 6 triệu</option>
        <option value="6000000" <?php selected($price, '6', true) ?> >trên 6 triệu</option>
    </select>
</div>
