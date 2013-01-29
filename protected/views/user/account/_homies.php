<!---------- right column--------------->
<div class="nine columns homies">
    <h1>Homies</h1>
    <span class="profileCount">
        <?php

        $friendRequests = $model->friendOf(array('condition' => 'Status = ' . FriendStatus::AwaitingApproval));

        echo count($friendRequests);
        ?>
    </span>

    <h2>New homie requests</h2>

    <?php

    foreach ($friendRequests as $request)
    {
        $profilePic = $request->user->profilePic;
        $userLink = CHtml::link("<img src='{$profilePic}' />", array('/user/view', 'id' => $request->user->User_ID));

        echo <<<BLOCK
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns">
            {$userLink}
        </div>
        <div class="ten columns">
            <h2>{$request->user->fullName}</h2>

            <p>
                {$request->RequestMessage}
            </p>

            <a href="#" class="button">Aw Yeah!</a>
            <a href="#" class="button">Um, No</a>
        </div>
    </div>
    <!-----------end 1 Homie----->

BLOCK;

    }

    ?>

    <span class="profileCount">
        <?php echo count($model->friends); ?>
    </span>

    <h2>My homies</h2>

    <?php

    foreach ($model->friends as $friend)
    {
        $profilePic = $friend->profilePic;
        $userLink = CHtml::link("<img src='{$profilePic}' />", array('/user/view', 'id' => $friend->User_ID));

        $recentActivity = '';

        echo <<<BLOCK
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns">
            {$userLink}
        </div>
        <div class="ten columns">
            <h2>{$friend->fullName}</h2>
            {$recentActivity}
        </div>
    </div>
    <!-----------end 1 Homie----->

BLOCK;

        /*<span class="homieUpdate">Followed class<a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Enrolled in <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Request a class: <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>*/

    }

    ?>
</div>
<!---------- end right column ----------->
