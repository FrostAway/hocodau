<div class="form-group">
    <label class="control-label">Đầu vào</label>

    <?php
    if (isset($_GET['dau-vao']) && $_GET['dau-vao'] != '') {
        $dv = $_GET['dau-vao'];
    }
    ?>

    <select class="form-control" name="dau-vao">
        <option value="">Chọn đầu vào</option>
        <option value="beginer-1" <?php selected($dv, 'beginer-1', true) ?>>Beginer</option>
        <option value="medium-2" <?php selected($dv, 'medium-2', true) ?>>Medium</option>
        <option value="advance-3" <?php selected($dv, 'advance-3', true) ?>>Advance</option>
    </select>
</div>
