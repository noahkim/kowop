<?php if ($section == 'rightColumnTop') : ?>

<?php if ($model->hasSessions) : ?>

    <div class="four columns">
        <div class="detailsNextSession">
            <h5>Next available session</h5>
            <span class="nextDay">Tues</span> <span class="nextDate">Nov 13</span> <span class="nextTime">6pm-7pm</span>

            <div class="enrollees">
                <h5>People in the next session</h5>

                <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a>
                <a href="#"><img src="http://placeskull.com/100/100/d70060"></a>
                <a href="#"><img src="http://placeskull.com/100/100/113f8c"></a>
                <a href="#"><img src="http://placehold.it/100x100"></a>
                <a href="#"><img src="http://placehold.it/100x100"></a>
                <a href="#"><img src="http://placehold.it/100x100"></a>

            </div>
        </div>

        <div class="spacebot10">
            <a href="#" class="button large twelve enrollButton">Sign up for this session</a>
        </div>
        <div>
            <a href="#enrolllater" class="button large twelve enrollButton">Sign up for a later session</a>
        </div>

    </div>

    <?php else : ?>

    <div class="four columns">
        <div class="row">
            <div class="four columns">
                <label class="inline right">Quantity</label>
            </div>
            <div class="eight columns">
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                </select>
            </div>
        </div>
        <div class="spacebot10">
            <a href="#" class="button large twelve enrollButton">Sign up</a>
        </div>
        <div class="detailsNextSession">
            <div class="enrollees">
                <h5>Recently signed up</h5>
                <a href="#"><img src="http://placeskull.com/100/100/01a4a4"></a> <a href="#"><img src="http://placeskull.com/100/100/d70060"></a> <a href="#"><img src="http://placeskull.com/100/100/113f8c"></a>
            </div>
        </div>
    </div>

    <?php endif; ?>

<?php elseif ($section == 'rightColumnBottom') : ?>

<?php endif; ?>

<script type='text/javascript'>

    $(document).ready(function ()
    {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header        :{
                left  :'',
                center:'title',
                right :'prev,next'
            },
            editable      :false,
            events        :[
            <?php
            $calendarJS = '';
            foreach ($model->sessions as $i => $session)
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
            eventMouseover:function (event, jsEvent, view)
            {
                if (typeof $(this).data("qtip") !== "object")
                {
                    $(this).qtip({
                        content :{
                            url:'<?php echo $this->createAbsoluteUrl("/experience/enrollDialog",
                                                                     array("id" => $model->Experience_ID)); ?>' + '?session=' + event.session
                        },
                        position:{
                            corner:{
                                target :'topLeft',
                                tooltip:'bottomMiddle'
                            }
                        },
                        hide    :{
                            fixed:true // Make it fixed so it can be hovered over
                        },
                        style   :{
                            padding:'10px' // Give it some extra padding
                        }});
                }
            }
        });
    });

</script>
