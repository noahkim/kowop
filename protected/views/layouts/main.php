<?php $this->beginContent('//layouts/mainNoSearch'); ?>
<!---------------------------------------
                 Search
---------------------------------------->
<?php $this->widget('SearchWidget'); ?>

<!-- Main Content !-->
<?php echo $content; ?>
<?php $this->endContent(); ?>
