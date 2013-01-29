<?php if(isset($hasJoined) && $hasJoined) : ?>
Joined class <?php echo $model->Name; ?>.
<?php else : ?>
Error joining class <?php echo $model->Name; ?>.
<?php endif; ?>