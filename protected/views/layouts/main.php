<?php $this->beginContent('//layouts/mainOuter'); ?>

<?php echo $this->renderPartial('/site/_headernav', array('search' => true)); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
