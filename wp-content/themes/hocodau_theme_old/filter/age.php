<div class="form-group">
    <label class="control-label">Độ tuổi</label>
    <?php if(isset($_GET['do-tuoi']) && $_GET['do-tuoi'] != ''){
        $tuoi = $_GET['do-tuoi'];
    } ?>
    <select class="form-control" name="do-tuoi">
        <option value="">Chọn độ tuổi</option>
        <option value="18-20" <?php selected($tuoi, '18-20', true) ?>>18 - 20 tuổi</option>
        <option value="21-24" <?php selected($tuoi, '21-24', true) ?>>21 - 24 tuổi</option>
        <option value="25" <?php selected($tuoi, '25', true) ?>>trên 25 tuổi</option>
    </select>
</div>
