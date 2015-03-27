<div id="slide">
    <div class="sl-items">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
            <div class="sl-item"><a href="<?= get_option('link-to' . $i) ?>"><img class="img-responsive" src="<?= get_option('slide-img' . $i) ?>" /></a></div>
        <?php } ?>
    </div> 
    <div class="pagesl">
        <span id="prev"><img src="<?php bloginfo('template_directory') ?>/assets/images/body/icon-07.png" /></span>
        <span id="next"><img src="<?php bloginfo('template_directory') ?>/assets/images/body/icon-08.png" /></span>
    </div>
    <script>
        $(document).ready(function(){
           $('#slide .sl-item img').load(function(){
               $(this).fadeIn(300);
           }) ;
        });
    </script>
</div>


<?php if(is_home()){ ?>

<?php     include_once 'small-menu.php'; ?>

<?php } ?>

