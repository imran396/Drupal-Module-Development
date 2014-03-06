<?php
drupal_add_css(path_to_theme() . '/css/visitors.css');
?>
<div  class="visitors"  width="100%">
 <?php
foreach($data as $key=>$val):?>
   <div class="visitor_flag">
       <img title="<?php echo $val['name'] ?>" src="<?php echo drupal_get_path('module','visitor_flag_counter');?>/images/<?php echo strtolower($val['code']).'.png';?>">
       <?php echo format_number($val['total_visit']);?>
   </div>
<?php endforeach; ?>
</div>
