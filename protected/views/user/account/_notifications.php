<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>Notifications</h1>
    <!---- Notifications ---------->
    <div class="row">
        <div class="six columns"><span
                class="profileCount"><?php echo count($model->messages(array('condition' => '`Read` = 0 AND Deleted = 0'))); ?></span>

            <h2>updates since your last visit</h2>
        </div>
        <div class="two columns">
            <label class="right inline">View</label>
        </div>
        <div class="four columns">
            <select>
                <option>All</option>
                <option>Messages</option>
                <option>Questions</option>
                <option>Homie Activity</option>
                <option>Classes</option>
            </select>
        </div>
    </div>

    <?php
    foreach ($model->messages(array('condition' => 'Deleted = 0', 'order' => 'Created DESC')) as $message)
    {
        $newNotification = $message->Read ? '' : 'newnotification';

        $fromUser = null;
        if ($message->From != null)
        {
            $fromUser = User::model()->findByPk($message->From);
        }

        $imageLink = 'http://placehold.it/100x100';
        $fromUserLink = '';
        if ($fromUser != null)
        {
            $imageLink = $fromUser->profilePic;
            $fromUserLink = CHtml::link($fromUser->fullName, array('/user/view', 'id' => $fromUser->User_ID));
        }

        $time = date('g:i a \o\n l, F jS', strtotime($message->Created));

        switch ($message->Type)
        {
            case MessageType::Notification:
                echo <<<BLOCK
    <!----- 1 notification -------->
    <div class="row notification {$newNotification}">
        <div class="one column"><img src="{$imageLink}"></div>
        <div class="eleven columns">
            <span class="notificationtime">{$time}</span>
            <span class="notificationType">{$message->Subject}</a></span>
            <span class="notificationText">{$message->Content}</span>
        </div>
    </div>
    <!------ end 1 notification ----->
BLOCK;

                if (!$message->Read)
                {
                    $message->Read = true;
                    $message->save();
                }
                break;
            case MessageType::Message:

                $replyDialogURL = $this->createAbsoluteUrl('/user/getReplyDialog', array('id' => $fromUser->User_ID, 'replyTo' => $message->Message_ID));

                echo <<<BLOCK
    <!----- 1 notification -------->
    <div class="row notification {$newNotification}">
        <div class="one column"><img src="{$imageLink}"></div>
        <div class="eleven columns">
            <span class="notificationtime">{$time}</span>
            <span class="notificationType">Message from {$fromUserLink}</a></span>
            <span class="notificationText">{$message->Content}</span>
        <span class="notificationAction">
            <a href="#" onclick="showReplyDialog('{$replyDialogURL}');" class="small button">Reply</a>
            <a href="#" class="small button">Ignore</a></span>
        </div>
    </div>
    <!------ end 1 notification ----->
BLOCK;
                if (!$message->Read)
                {
                    $message->Read = true;
                    $message->save();
                }
                break;
            case MessageType::FriendRequest:

                $acceptLink = CHtml::link('Accept', array('/user/acceptFriend', 'id' => $fromUser->User_ID), array('class' => 'small button'));

                echo <<<BLOCK
    <!----- 1 notification -------->
    <div class="row notification {$newNotification}">
        <div class="one column"><img src="{$imageLink}"></div>
        <div class="eleven columns">
            <span class="notificationtime">{$time}</span>
          <span class="notificationType">Homie request from {$fromUserLink}</span>
          <span class="notificationText">"{$message->Content}"</span>
          <span class="notificationAction">
            {$acceptLink}
            <a href="#" class="small button">Reject</a>
          </span>
      </div>
    </div>
    <!------ end 1 notification ----->
BLOCK;

                if (!$message->Read)
                {
                    $message->Read = true;
                    $message->save();
                }
                break;
            default:
                break;
        }
    }
    ?>
</div>
<!-------- end right column --------->
</div>

<div id='replyDialog' class="reveal-modal small">
</div>

<script>
    function showReplyDialog(url) {
        $.get(url, function (data) {
            $('#replyDialog').html(data);
            $('#replyDialog').reveal();
        });
    }
</script>
