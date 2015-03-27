<form method="get" action="" id="search-form" class="input-group">
    <?php
    $posttype = 'Lựa chọn';
    if(isset($_GET['post_type'])){
        switch ($_GET['post_type']) {
            case 'course':
                $posttype = 'Khóa học';
                break;
            case 'english-center':
                $posttype = 'Trung tâm';
                break;
            case 'english-club':
                $posttype = 'Câu lạc bộ';
                break;
            default:
                break;
        }
    }
    ?>
    <span class="input-group-addon dropdown" id="basic-addon1" data-toggle="dropdown"><span class="text"><?= $posttype ?></span> <span class="caret"></span></span>
    <ul class="dropdown-menu" id="search-option">
        <li><a data-type="course" href="#">Khóa học</a></li>
        <li><a data-type="english-center" href="#">Trung tâm</a></li>
        <li><a data-type="english-club" href="#">Câu lạc bộ</a></li>
    </ul>
    <input type="text" name="s" class="form-control" placeholder="Tìm kiếm" aria-describedby="basic-addon2" />
    <input type="hidden" id="search-option-ap" name="post_type" value="course" />
    <span  class="input-group-addon" id="basic-addon2">Tìm kiếm</span>
    <input style="display: none;" id="search-submit" type="submit" name="search-submit" value="search-submit" />
</form>

