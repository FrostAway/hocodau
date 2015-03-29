<div class="form-group">
    <label class="control-label">Loại giảng viên</label>
    <?php
    if(isset($_GET['giang-vien']) && $_GET['giang-vien'] != ''){
        $gv = $_GET['giang-vien'];
    }
    ?>
    <select class="form-control" name="giang-vien">
        <option value="">Chọn giảng viên</option>
        <option value="viet-nam-1" <?php selected($gv, 'viet-nam-1', true) ?>>Việt Nam</option>
        <option value="nuoc-ngoai-2" <?php selected($gv, 'nuoc-ngoai-2', true) ?>>Nước Ngoài</option>
    </select>
</div>

