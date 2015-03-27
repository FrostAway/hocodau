
<div class="bar-filter">
    <form class="" id="filter-form" method="get" action="">
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <div class="form-group">
                    <label class="control-label">Địa điểm </label>
                    <?php $terms = get_terms('city-center', array('hide_empty'=>false, 'order'=>'DESC')); ?>
                    <select name="dia-diem" class="form-control">
                        <option value="">Chọn địa điểm</option>
                    <?php foreach ($terms as $term){ ?>
                        <option value="<?= $term->name.'-'.$term->term_id ?>"><?= $term->name ?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="form-group">
                    <label class="control-label">Mức giá</label>
                    <select class="form-control" name="muc-gia">
                        <option value="">Chọn mức giá</option>
                        <option value="1000000-2000000">1 triệu - 2 triệu</option>
                        <option value="2000000-4000000">2 triệu - 4 triệu</option>
                        <option value="4000000-6000000">4 triệu - 6 triệu</option>
                        <option value="6000000">trên 6 triệu</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2">
                <div class="form-group">
                    <label class="control-label">Đầu vào</label>
                    <select class="form-control" name="dau-vao">
                        <option value="">Chọn đầu vào</option>
                        <option value="beginer-1">Beginer</option>
                        <option value="medium-2">Medium</option>
                        <option value="advance-3">Advance</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2">
                <div class="form-group">
                    <label class="control-label">Thời gian</label>
                    <select name="thoi-gian" class="form-control">
                        <option value="">Chọn tháng</option>
                        <?php for($i=1; $i<=12; $i++){ ?>
                        <option value="<?= $i ?>">Tháng <?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2">
                <div class="form-group">
                    <label class="control-label"> Tìm</label>
                    <div><input class="btn btn-success" type="submit" value="Lọc" /></div>
                </div>
            </div>
            <input type="hidden" name="filter-submit" value="filter-submit" />
        </div>
    </form>
</div>

