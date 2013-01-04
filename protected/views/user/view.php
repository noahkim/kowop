<?php if($section > 0) : ?>

<!--------- main content container------>
<div class="row" id="wrapper">

    <!-------------left column------------->
    <div class="three columns sideNav">
        <?php

        $imageLink = 'http://placehold.it/800x800';

        if ($model->profilePic != null)
        {
            $imageLink = $model->profilePic;
        }

        echo "<img src='{$imageLink}' />\n";

        $sections = array();
        for($i = 1; $i <= 4; $i++)
        {
            $sections[$i] = '';
        }

        $sections[$section] = 'class="active"';

        ?>

        <h2>Manage my account</h2>

        <ul class="side-nav">
            <li <?php echo $sections[1]; ?> >
                <?php echo CHtml::link('My Classes', array('/user/view', 'id' => $model->User_ID, 's' => 1)); ?>
            </li>
            <li <?php echo $sections[2]; ?> >
                <?php echo CHtml::link("Classes I'm teaching", array('/user/view', 'id' => $model->User_ID, 's' => 2)); ?>
            </li>
            <li <?php echo $sections[3]; ?> >
                <?php echo CHtml::link('Class Calendar', array('/user/view', 'id' => $model->User_ID, 's' => 3)); ?>
            </li>
            <li <?php echo $sections[4]; ?> >
                <?php echo CHtml::link('Account Information', array('/user/view', 'id' => $model->User_ID, 's' => 4)); ?>
            </li>
        </ul>
    </div>
    <!------- end left column -------->

    <?php

    switch ($section)
    {
        case 2:
            $page = 'account/_teaching';
            break;
        case 3:
            $page = 'account/_calendar';
            break;
        case 4:
            $page = 'account/_account';
            break;
        default:
            $page = 'account/_classes';
            break;
    }

    echo $this->renderPartial($page, array('model' => $model));

    ?>

    <!------- end main content container----->
</div>

<?php else : ?>

<?php echo $this->renderPartial('account/_profile', array('model' => $model)); ?>

<?php endif; ?>