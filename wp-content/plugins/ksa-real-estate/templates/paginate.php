<ul class="propery_filter_paginate">
    <?php for($i = 1; $i <=  $total ; $i++) : ?>
    <li class="propery_filter_paginate_item<?php echo $current == $i ? ' current' : '' ?>" data-page="<?php echo $i ?>" ><?php echo $i ?></li>
    <?php endfor ?>
</ul>
<!--<div class="propery_filter_paginate_box">-->
<?php
//echo paginate_links( [
//'base'    => $base,
//'current' => $current,
//'total'   => $total,
//] );
//?>
<!--</div>-->

