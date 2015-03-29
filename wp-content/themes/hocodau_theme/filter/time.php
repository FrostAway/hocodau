<div class="form-group">
    <label class="control-label">Thời gian</label>
    
    <?php if(isset($_GET['thoi-gian']) && $_GET['thoi-gian'] != ''){
        $time = $_GET['thoi-gian'];
    } ?>
    
    <select name="thoi-gian" class="form-control">
        <option value="">Chọn tháng</option>
        <?php for ($i = 1; $i <= 12; $i++) { ?>
        <option value="thang-<?= $i ?>" <?php selected($time, 'thang-'.$i, true) ?> >Tháng <?= $i ?></option>
        <?php } ?>
    </select>
</div>