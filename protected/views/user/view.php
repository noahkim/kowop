<?php if ($section > 0) : ?>

<?php

    $imageLink = 'http://placehold.it/800x800';

    if ($model->profilePic != null)
    {
        $imageLink = $model->profilePic;
    }

    $sections = array();
    foreach (AccountSections::$Lookup as $sectionID => $name)
    {
        $sections[$sectionID] = '';
    }

    $sections[$section] = 'class="active"';

    ?>

<!--------- main content container------>
<div class="row" id="wrapper">

    <!-------------left column------------->
    <div class="three columns sideNav">
        <img src='<?php echo $imageLink; ?>' />

        <h2>My account</h2>
        <ul class="side-nav">
            <?php
            foreach (AccountSections::$Lookup as $sectionID => $name)
            {
                echo "<li {$sections[$sectionID]}> \n";
                echo CHtml::link($name, array('/user/view', 'id' => $model->User_ID, 's' => $sectionID));
                echo "</li>\n";
            }
            ?>

            <li>
                <?php echo CHtml::link("View public profile", array("user/view", 'id' => $model->User_ID)); ?>
            </li>

            <li>
                <a href="user_profile_reviews.html">Feedback</a>
            </li>
        </ul>
        <div class="spacebot10">
            <?php echo CHtml::link("I'd like to post", $this->createUrl("experience/create"), array('class' => 'button twelve')); ?>
        </div>
        <div>
            <?php echo CHtml::link("make a request", $this->createUrl("request/create"), array('class' => 'button twelve')); ?>
        </div>
    </div>
    <!------- end left column -------->

    <?php

    switch ($section)
    {
        case AccountSections::Friends:
            $page = 'account/_homies';
            break;
        case AccountSections::MyExperiences:
            $page = 'account/_experiences';
            break;
        case AccountSections::MyListings:
            $page = 'account/_listings';
            break;
        case AccountSections::MyCalendar:
            $page = 'account/_calendar';
            break;
        case AccountSections::AccountInformation:
            $page = 'account/_account';
            break;
        case AccountSections::PaymentInformation:
            $page = 'account/_payment';
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