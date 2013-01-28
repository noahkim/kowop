<?php if ($section > 0) : ?>

<?php

    $imageLink = 'http://placehold.it/800x800';

    if ($model->profilePic != null)
    {
        $imageLink = $model->profilePic;
    }

    $sections = array();
    for ($i = 1; $i <= 5; $i++)
    {
        $sections[$i] = '';
    }

    $sections[$section] = 'class="active"';

    ?>

<!--------- main content container------>
<div class="row" id="wrapper">

    <!-------------left column------------->
    <div class="three columns sideNav">
        <img src='<?php echo $imageLink; ?>'/>

        <h2>My account</h2>
        <ul class="side-nav">
            <li <?php echo $sections[1]; ?> >
                <?php echo CHtml::link('Notifications', array('/user/view', 'id' => $model->User_ID, 's' => 1)); ?>
            </li>
            <li <?php echo $sections[2]; ?> >
                <?php echo CHtml::link('My Classes', array('/user/view', 'id' => $model->User_ID, 's' => 2)); ?>
            </li>
            <li <?php echo $sections[3]; ?> >
                <?php echo CHtml::link("Classes I'm teaching", array('/user/view', 'id' => $model->User_ID, 's' => 3)); ?>
            </li>
            <li <?php echo $sections[4]; ?> >
                <?php echo CHtml::link('Class Calendar', array('/user/view', 'id' => $model->User_ID, 's' => 4)); ?>
            </li>
            <li <?php echo $sections[5]; ?> >
                <?php echo CHtml::link('Account Information', array('/user/view', 'id' => $model->User_ID, 's' => 5)); ?>
            </li>

            <li>
                <?php echo CHtml::link("View public profile", array("user/view", 'id' => $model->User_ID)); ?>
            </li>

            <li><a href="user_profile_reviews.html">Feedback</a></li>
        </ul>
        <div class="spacebot10">
            <?php echo CHtml::link("Teach a class", $this->createUrl("class/create"), array('class' => 'button twelve')); ?>
        </div>
        <div>
            <?php echo CHtml::link("Request a class", $this->createUrl("request/create"), array('class' => 'button twelve')); ?>
        </div>
    </div>
    <!------- end left column -------->

    <?php

    switch ($section)
    {
        case 2:
            $page = 'account/_classes';
            break;
        case 3:
            $page = 'account/_teaching';
            break;
        case 4:
            $page = 'account/_calendar';
            break;
        case 5:
            $page = 'account/_account';
            break;
        default:
            $page = 'account/_notifications';
            break;
    }

    echo $this->renderPartial($page, array('model' => $model));

    ?>

    <!------- end main content container----->
</div>

<?php else : ?>

<?php echo $this->renderPartial('account/_profile', array('model' => $model)); ?>

<?php endif; ?>