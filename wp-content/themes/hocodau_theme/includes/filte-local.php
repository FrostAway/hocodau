
<div class="bar-filter-lc">
    <?php
    global $post;
    if($post->ID == 64){
        $slug = 'page_id=64';
    }elseif($post->ID == 68){
        $slug = 'page_id=68';
    }elseif($post->ID == 66){
        $slug = 'page_id=66';
    }
    ?>
   
   
    <div class="col-sm-12 col-md-6 col-lg-3 br">
        <div class="dropdown filter-item">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                <?php if($post->ID == 68) echo 'Địa điểm Lớp học'; else echo 'Lọc theo Địa điểm ';  ?>
                <b><?php global $provices;
            echo get_term($_GET['dia-diem'], 'city-center')->name;
            ?></b> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <?php $citys = get_terms('city-center', array('orderby'=>'name', 'order'=>'ASC', 'hide_empty'=>false)); ?>
                <?php foreach ($citys as $city) { ?>
                    <li><a href="<?= home_url() ?>/?<?= $slug ?>&dia-diem=<?= $city->term_id ?>"><?= $city->name ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    
    <?php if($post->ID == 68){ ?>
    <div class="col-sm-12 col-md-6 col-lg-3 br">
        <?php 
        $strtuoi = '';
        if(isset($_GET['tuoi'])){
            $tuoi = $_GET['tuoi'];
            $spltuoi = split('-', $tuoi);
            if(count($spltuoi)>1){
                $strtuoi = $tuoi;
            }else{
                $strtuoi = ' > '.$tuoi;
            }
        } ?>
        <div class="dropdown filter-item">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Độ tuổi <b><?php echo $strtuoi; ?></b> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <?php 
                ?>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&tuoi=18-20">18 - 20</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&tuoi=20-24">20 - 24</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&tuoi=24">Trên 24</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-3 br">
        <?php 
        $strgv = '';
        if(isset($_GET['giangvien'])){
            $gv = split('-', $_GET['giangvien'])[1];
            if($gv == '1'){
                $strgv = 'Việt Nam';
            }else{
                $strgv = 'Nước ngoài';
            }
        }
        ?>
        <div class="dropdown filter-item">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Loại giảng viên <b><?php echo $strgv; ?></b> <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <?php 
                ?>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&giangvien=vietnam-1">Giảng viên Việt Nam</a></li>
                <li><a href="<?= home_url() ?>/?<?= $slug ?>&giangvien=nuocngoai-2">Giảng viên Nước ngoài</a></li>
            </ul>
        </div>
    </div>
    <?php } ?>
    
    <div class="clearfix"></div>
</div>

<script>

</script>


