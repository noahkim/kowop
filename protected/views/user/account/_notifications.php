<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>Notifications</h1>
    <!---- Notifications ---------->
    <div class="row">
        <div class="six columns"><span class="profileCount"><?php echo count($model->messages(array('condition' => '`Read` = 0'))); ?></span>

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
        foreach($model->messages(array('order' => 'Created DESC')) as $message)
        {
            $newNotification = $message->Read ? '' : 'newnotification';

            $fromUser = null;
            if($message->From != null)
            {
                $fromUser = User::model()->findByPk($message->From);
            }

            $imageLink = 'http://placehold.it/100x100';
            if($fromUser != null)
            {
                $imageLink = $fromUser->profilePic;
            }

            $time = date('g:i a \o\n l, F jS', strtotime($message->Created));

            switch($message->Type)
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

                    if(! $message->Read)
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
