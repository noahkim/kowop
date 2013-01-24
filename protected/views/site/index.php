<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>

    <link rel="stylesheet" href="/ui/sitev2/fonts/proxima/stylesheet.css">
    <link rel="stylesheet" href="/ui/sitev2/fonts/susa/stylesheet.css">
    <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/foundation.css">
    <link rel="stylesheet" href="/ui/sitev2/stylesheets/main.css">

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/ui/sitev2/javascripts/modernizr.foundation.js"></script>
    <script src="/ui/sitev2/javascripts/foundation.min.js"></script>
    <script src="/ui/sitev2/javascripts/app.js"></script>
    <script src="/ui/sitev2/javascripts/account_toggle.js"></script>
    <title>Kowop | Hand-crafted experiences to share, learn and teach in the comfort of your neighborhood. Meet new
        people, experience new things.</title>
</head>
<body>
<!---------------------------------------
     Main Homepage Banner / Logo / header nav
---------------------------------------->
<div class="mainpic">

    <?php if (Yii::app()->user->isGuest) : ?>

    <!----- Homepage logo and header nav ---------->
    <div class="row">
        <div class="three columns">
            <div class="logo">
                <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                Teach. Learn. Meet.
            </div>
        </div>

        <div class="three columns notlogged">
            <span class="navWhatskowop"><a href="how_it_works.html">what's Kowop?</a></span>
            <span class="navSignup">
                <?php echo CHtml::link("sign up", $this->createUrl("site/login")); ?>
            </span>
            <span class="navLogin">
                <?php echo CHtml::link("log in", $this->createUrl("site/login")); ?>
            </span>
        </div>
    </div>
    <!----- End Homepage logo and header nav ---------->

    <?php else: ?>
    <?php $user = User::model()->findByPk(Yii::app()->user->id); ?>

    <div class="header spacebot20">
        <div class="row">
            <div class="three columns">
                <div class="logo">
                    <?php echo CHtml::link('<img src="/ui/sitev2/images/logo_small.png">', Yii::app()->homeUrl); ?>
                    Teach. Learn. Meet.
                </div>
            </div>

            <div class="three columns headernav">
                <span class="notifications">
                    <?php echo CHtml::link(count($user->messages(array('condition' => '`Read` = 0'))), array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
                </span>
                <!----- My account dropdown ------->
                <div class="dropdown">
                    <a href="#" class="account">
                        <span class="headerAccount">my account</span>
                    </a>

                    <div class="submenu" style="display: none;">
                        <ul class="root">
                            <li>
                                <?php echo CHtml::link('notifications', array('/user/view', 'id' => $user->User_ID, 's' => 1)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('my classes', array('/user/view', 'id' => $user->User_ID, 's' => 2)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('calendar', array('/user/view', 'id' => $user->User_ID, 's' => 4)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('account info', array('/user/view', 'id' => $user->User_ID, 's' => 5)); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link("sign out", $this->createUrl("site/logout")); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <!----- end my account dropdown----->
            </div>
        </div>
    </div>

    <?php endif; ?>

    <!----- Home blurb and search box --------->
    <div class="row">
        <div class="eight columns offset-by-two">
            <div class="homeBlurb"><span class="homeBlurbcopy">Learn, teach and experience new things with<br/>locals
        in the comfort of your neighborhood. </span>

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'search-form',
                    'action' => Yii::app()->createUrl('/class/search'),
                    'enableAjaxValidation' => false,
                    'method' => 'get'
                )); ?>

                <?php $model = new ClassSearchForm; ?>

                <div class="row">
                    <div class="five columns">
                        <?php echo $form->textField($model, 'keywords', array('value' => $model->keywords, 'class' => 'homeSearchinput twelve', 'placeholder' => 'What are you looking for?')); ?>
                    </div>
                    <div class="four columns">
                        <input type="text" class="homeSearchinput twelve" placeholder="city,state or zip">
                    </div>
                    <div class="three columns">
                        <a href="#" onclick="document.forms['search-form'].submit(); return false;"
                           class="large button twelve">Search</a>
                    </div>
                </div>

                <?php $this->endWidget('CActiveForm'); ?>

                <?php echo CHtml::link("or browse all classes", $this->createUrl("class/search")); ?>

            </div>
        </div>
    </div>
    <!----- end Home blurb and search box ------------>
    <!----- Featured class info ------------->
    <div class=" homeFeaturedinfo">
        <div class="row">
            <?php
            $randomClass = KClass::model()->findAll(array(
                'select' => '*, rand() as rand',
                'condition' => 'Status = ' . ClassStatus::Active,
                'limit' => 1,
                'order' => 'rand',
            ));

            $randomClass = $randomClass[0];
            $enrollees = '';
            foreach ($randomClass->students as $student)
            {
                $picLink = 'http://placeskull.com/100/100/868686';

                if ($student->profilePic != null)
                {
                    $picLink = $student->profilePic;
                }

                $enrolleeText ="<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />";
                $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $student->User_ID)) . "\n";
            }

            ?>

            <div class="twelve columns">
                <h2>Featured Class</h2>

                <div class="homeFeaturedstudents">
                    <?php echo $enrollees; ?>
                </div>
                <div class="homeFeaturedtext">
                    <h3><?php echo $randomClass->Name; ?></h3>
                    <span>Next available session begins <?php echo date('F jS', strtotime($randomClass->sessions[0]->lessons[0]->Start)); ?></span></div>
                <?php echo CHtml::link('More Info', array('class/view', 'id' => $randomClass->Class_ID), array('class' => 'button featuredButton')); ?>
        </div>
    </div>
    <!----- End Featured class info -------->
    </div>
</div>
<!--------------------------------------
 Staff picks and Popular Classes
 --------------------------------------->
<div class="homeClasses">
    <h3>Staff Picks in Los Angeles</h3>
    <!----------- 1 row of tiles---->
    <div class="row">
        <?php
        $classes = KClass::model()->findAll(array(
                'select' => '*, rand() as rand',
                'condition' => 'Status = ' . ClassStatus::Active,
                'limit' => 4,
                'order' => 'rand',
            )
        );
        foreach ($classes as $class)
        {
            $imageHTML = '<img src="' . ($class->picture ? $class->picture : 'http://placehold.it/400x300') . '" />';
            $imageLink = CHtml::link($imageHTML, array('/class/view', 'id' => $class->Class_ID));

            $teacherName = $class->createUser->Teacher_alias ? $class->createUser->Teacher_alias : $class->createUser->fullname;
            if (strlen($teacherName) > 25)
            {
                $teacherName = substr($teacherName, 0, 25);
                $teacherName .= ' ...';
            }

            $teacherLink = CHtml::link($teacherName, array('/user/view', 'id' => $class->Create_User_ID));
            $description = $class->Description;
            if (strlen($description) > 82)
            {
                $description = substr($description, 0, 82);
                $description .= ' ...';
            }

            $enrollees = '';
            foreach ($class->students as $student)
            {
                $picLink = 'http://placeskull.com/100/100/868686';

                if ($student->profilePic != null)
                {
                    $picLink = $student->profilePic;
                }

                $enrolleeText ="<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />";
                $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $student->User_ID)) . "\n";
            }

            $className = $class->Name;
            if (strlen($className) > 60)
            {
                $className = substr($className, 0, 60);
                $className .= ' ...';
            }
            $className = CHtml::link('<h5>' . $className . '</h5>', array('class/view', 'id' => $class->Class_ID));

            if (($class->Tuition == null) || ($class->Tuition == 0) || (count($class->sessions) == 0))
            {
                $sessionHTML = 'This class is free!';
            }
            else
            {
                $lessonCount = count($class->sessions[0]->lessons);
                $tuition = $class->Tuition * $lessonCount;

                $sessionHTML = "\${$tuition} ( {$lessonCount} lessons )";
            }

            echo <<<BLOCK
        <!----------- 1 tile ---------->
        <div class="three columns">
            <div class="classTile">{$imageLink}
                {$className}
                <span class="tileInstructor">by {$teacherLink}</span> <span
                        class="tileDescription">{$description}</span>

                <div class="tileStudents">
                    {$enrollees}
                </div>
            </div>
            <div class="classCost">
                {$sessionHTML}
            </div>
        </div>
        <!------- end 1 tile -------->
BLOCK;

        }
        ?>
    </div>
    <!------ end 1 row of tiles ----->
    <h3>Popular Classes in Los Angeles</h3>
    <!----------- 1 row of tiles---->
    <div class="row">
        <?php
        $classes = KClass::model()->findAll(array(
                'select' => '*, rand() as rand',
                'condition' => 'Status = ' . ClassStatus::Active,
                'limit' => 4,
                'order' => 'rand',
            )
        );
        foreach ($classes as $class)
        {
            $imageHTML = '<img src="' . ($class->picture ? $class->picture : 'http://placehold.it/400x300') . '" />';
            $imageLink = CHtml::link($imageHTML, array('/class/view', 'id' => $class->Class_ID));

            $teacherName = $class->createUser->Teacher_alias ? $class->createUser->Teacher_alias : $class->createUser->fullname;
            $teacherLink = CHtml::link($teacherName, array('/user/view', 'id' => $class->Create_User_ID));
            $description = $class->Description;
            if (strlen($description) > 82)
            {
                $description = substr($description, 0, 82);
                $description .= ' ...';
            }

            $enrollees = '';
            foreach ($class->students as $student)
            {
                $picLink = 'http://placeskull.com/100/100/868686';

                if ($student->profilePic != null)
                {
                    $picLink = $student->profilePic;
                }

                $enrolleeText ="<img src='{$picLink}' alt='{$student->fullname}' title='{$student->fullname}' />";
                $enrollees .= CHtml::link($enrolleeText, array('user/view', 'id' => $student->User_ID)) . "\n";
            }

            $className = CHtml::link('<h5>' . $class->Name . '</h5>', array('class/view', 'id' => $class->Class_ID));

            if (($class->Tuition == null) || ($class->Tuition == 0) || (count($class->sessions) == 0))
            {
                $sessionHTML = 'This class is free!';
            }
            else
            {
                $lessonCount = count($class->sessions[0]->lessons);
                $tuition = $class->Tuition * $lessonCount;

                $sessionHTML = "\${$tuition} ( {$lessonCount} lessons )";
            }

            echo <<<BLOCK
        <!----------- 1 tile ---------->
        <div class="three columns">
            <div class="classTile">{$imageLink}
                {$className}
                <span class="tileInstructor">by {$teacherLink}</span> <span
                        class="tileDescription">{$description}</span>

                <div class="tileStudents">
                    {$enrollees}
                </div>
            </div>
            <div class="classCost">
                {$sessionHTML}
            </div>
        </div>
        <!------- end 1 tile -------->
BLOCK;

        }
        ?>
    </div>
    <!------ end 1 row of tiles ----->
</div>
<!---------------------------------------
              Footer
---------------------------------------->
<div class="footer">
    <div class="row">
        <div class="two columns footerlinks discover">
            <h5>Discover</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("teach a class", $this->createUrl("class/create")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("take a class", $this->createUrl("class/search")); ?>
                </li>
                <li>
                    <?php echo CHtml::link("request a class", $this->createUrl("request/create")); ?>
                </li>
                <li><a href="#">how it works</a></li>
            </ul>
        </div>
        <div class="two columns footerlinks company">
            <h5>Company</h5>
            <ul>
                <li>
                    <?php echo CHtml::link("our story", $this->createUrl("site/page", array('view' => 'about'))); ?>
                </li>
                <li>
                    <?php echo CHtml::link("join the team", $this->createUrl("site/page", array('view' => 'meet'))); ?>
                </li>
                <li><a href="#">press</a></li>
                <li><a href="#">blog</a></li>
                <li>
                    <?php echo CHtml::link("FaQ", $this->createUrl("site/page", array('view' => 'faq'))); ?>
                </li>
                <li><a href="#">policies</a></li>
                <li><a href="#">contact</a></li>
                <li><a href="#">terms &amp; privacy</a></li>
            </ul>
        </div>
        <div class="two columns footerlinks joinuson">
            <h5>Join us on:</h5>
            <ul>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Google+</a></li>
                <li><a href="#">Newsletter</a></li>
            </ul>
        </div>
        <div class="six columns"></div>
    </div>
    <div class="row">
        <div class="two columns offset-by-five footerlogo"><img src="/ui/sitev2/images/logo_small.png"></div>
    </div>
</div>

<!---------------------MODAL -------------------------->

<div id="welcome" class="reveal-modal medium">
    <h2>Welcome to the development instance of Kowop.com</h2>

    <p class="lead">You are a brave, brave soul.</p>

    <p>Thanks for checking out/testing/using our development instance of Kowop.com.</p>

    <p>As with any dev instance, things aren't always going to be pretty or tick perfectly. We make A LOT of changes on
        here daily, always improving, tweaking, and refining.</p>

    <p>Since you're aware of our existence, you've probably been invited here by a member of the Kowop team, so feel
        free to look around. Just keep in mind, that this is our "ground zero", and some things that work may break, and
        some things that don't work will inexplicabily work the next minute.</p>

    <p>If you run into something that REALLY grinds your gears, feel free to contact noah at kowop.com</p>

    <p><3 Noah &amp; Ilija</p>
    <a class="close-reveal-modal">&#215;</a>
</div>

<script>
    $(document).ready(function () {
        $('#welcome').reveal();
    });
</script>

</body>