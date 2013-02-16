<?php if ($section == 'rightColumnTop') : ?>

<?php if ($model->hasSessions && ($model->nextAvailableSession != null)) : ?>

    <div class="four columns">
        <div class="detailsNextSession">
            <h5>Next available session</h5>
            <span class="nextDay">
                <?php echo date('D', strtotime($model->nextAvailableSession->Start)); ?>
            </span>
            <span class="nextDate">
                <?php echo substr(date('F', strtotime($model->nextAvailableSession->Start)), 0, 3); ?>
                <?php echo date('j', strtotime($model->nextAvailableSession->Start)); ?>
            </span>
            <span class="nextTime">
                <?php echo date('ga', strtotime($model->nextAvailableSession->Start)); ?>
                -
                <?php echo date('ga', strtotime($model->nextAvailableSession->End)); ?>
            </span>

            <div class="enrollees">
                <h5>People in the next session</h5>

                <?php
                foreach ($model->nextAvailableSession->enrolled as $enrollee)
                {
                    echo CHtml::link("<img src='{$user->profilePic}' />", array('/user/view', 'id' => $enrollee->User_ID));
                }
                ?>
            </div>
        </div>

        <div class="spacebot10">
            <?php echo CHtml::link('Sign up for this session', array('/experience/join', 'id' => $model->Experience_ID, 'session' => $model->nextAvailableSession->Session_ID), array('class' => 'button large twelve enrollButton')); ?>
        </div>
        <div>
            <a href="#enrolllater" class="button large twelve enrollButton">Sign up for a later session</a>
        </div>

    </div>

    <?php else : ?>

    <div class="four columns">

        <?php if ($model->MaxPerPerson != null) : ?>

        <div class="row">
            <div class="four columns">
                <label class="inline right">Quantity</label>
            </div>
            <div class="eight columns">
                <select>
                    <?php
                    for ($i = 1; $i <= $model->MaxPerPerson; $i++)
                    {
                        echo "<option>{$i}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <?php endif; ?>

        <div class="spacebot10">
            <?php echo CHtml::link('Sign up', array('/experience/join', 'id' => $model->Experience_ID), array('class' => 'button large twelve enrollButton')); ?>
        </div>
        <div class="detailsNextSession">
            <div class="enrollees">
                <h5>Recently signed up</h5>
                <?php
                foreach ($model->enrolled as $enrollee)
                {
                    echo CHtml::link("<img src='{$user->profilePic}' />", array('/user/view', 'id' => $enrollee->User_ID));
                }
                ?>
            </div>
        </div>
    </div>

    <?php endif; ?>

<?php elseif ($section == 'rightColumnBottom') : ?>

<?php if ($model->hasSessions && ($model->nextAvailableSession != null)) : ?>

    <div class="six columns">
        <div class="row">
            <div class="twelve columns spacebot10 detailsMap">
                <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
            </div>
        </div>
        <!------- Stats------->
        <div class="row">
            <div class="twelve columns">
                <div class="detailStats">
                    <div class="statBox"> Attended<span>32</span></div>
                    <div class="statBox"> Signed Up<span>23</span></div>
                    <div class="statBox"> Views<span>536</span></div>
                </div>
            </div>
        </div>
        <!---- end stats---->
        <div class="detailEnrolllater" id="enrolllater">
            <h4 class="spacebot10">Enroll for a later session</h4>

            <div id='calendar'></div>
        </div>
    </div>

    <script type='text/javascript'>

        $(document).ready(function () {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header:{
                    left:'',
                    center:'title',
                    right:'prev,next'
                },
                editable:false,
                events:[
                    <?php
                    $calendarJS = '';
                    foreach ($model->currentSessions as $i => $session)
                    {
                        $title = 'Session ' . ($i + 1);
                        $link = $this->createAbsoluteUrl('/experience/join', array('id' => $model->Experience_ID,
                            'session' => $session->Session_ID));
                        $calendarJS .= <<<BLOCK
                {
                    id: {$i},
                    title: '{$title}',
                    start: new Date('{$session->Start}'),
                    end: new Date('{$session->End}'),
                    allDay: false,
                    url: '{$link}',
                    session: {$session->Session_ID}
                },
BLOCK;
                    }

                    $calendarJS = rtrim($calendarJS, ",");
                    echo $calendarJS;
                    ?>
                ],
                eventMouseover:function (event, jsEvent, view) {
                    if (typeof $(this).data("qtip") !== "object") {
                        $(this).qtip({
                            content:{
                                url:'<?php echo $this->createAbsoluteUrl("/experience/enrollDialog",
                                    array("id" => $model->Experience_ID)); ?>' + '?session=' + event.session
                            },
                            position:{
                                corner:{
                                    target:'topLeft',
                                    tooltip:'bottomMiddle'
                                }
                            },
                            hide:{
                                fixed:true // Make it fixed so it can be hovered over
                            },
                            style:{
                                padding:'10px' // Give it some extra padding
                            }});
                    }
                }
            });
        });

    </script>

    <?php else : ?>

    <div class="six columns">
        <div class="row">
            <div class="twelve columns spacebot10 detailsMap">
                <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020795,-118.410645&amp;sspn=0.911712,1.443329&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
            </div>
        </div>
    </div>

    <?php endif; ?>

<?php endif; ?>

