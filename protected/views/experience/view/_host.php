<?php if ($section == 'rightColumnTop') : ?>

<?php if ($model->hasSessions && ($model->nextAvailableSession != null)) : ?>

    <div class="four columns">
        <div class="detailsNextSession">
            <h5>Next session taking place on</h5>
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
            <?php echo CHtml::link("Edit experience details",
            array('/experience/update', 'id' => $model->Experience_ID),
            array('class' => 'button large twelve')); ?>
        </div>

        <div class="spacebot10">
            <?php echo CHtml::link("Scheduling",
            array('/experience/updateScheduling', 'id' => $model->Experience_ID),
            array('class' => 'button large twelve')); ?>
        </div>

        <div>
            <a href="#" class="button twelve large" data-reveal-id="confirmCancel">Cancel Experience</a>
        </div>
    </div>

    <?php else : ?>

    <div class="four columns">
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

        <div class="spacebot10">
            <?php echo CHtml::link("Edit experience details",
            array('/experience/update', 'id' => $model->Experience_ID),
            array('class' => 'button large twelve')); ?>
        </div>

        <div>
            <a href="#" class="button twelve large" data-reveal-id="confirmCancel">Cancel Experience</a>
        </div>
    </div>

    <?php endif; ?>

<?php elseif ($section == 'rightColumnBottom') : ?>


<div class="six columns">
    <div class="row">
        <div class="twelve columns spacebot10 detailsMap">
            <div id="map"></div>
        </div>
    </div>
</div>

<!----------------- Modal--------------------->
<div id="confirmCancel" class="reveal-modal small">
    <h2>Confirm experience cancellation</h2>

    <p>
        Do you really want to cancel the experience "<?php echo $model->Name; ?>"? </p>

    <div>
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'experience-delete-form', 'enableAjaxValidation' => false,
            'action' => Yii::app()->createUrl('//experience/delete',
                array('id' => $model->Experience_ID))));
        ?>

        <input type="submit" value="Confirm Cancellation" class="button secondary radius" />

        <?php $this->endWidget(); ?>
    </div>

    <a class="close-reveal-modal">&#215;</a>
</div>

<script>
    $(document).ready(function ()
    {
        google.load('maps', '3.x', {other_params:'sensor=true', callback:function ()
        {
            $("#map").gmap3({
                map   :{
                    options :{
                        mapTypeId         :google.maps.MapTypeId.ROADMAP,
                        mapTypeControl    :false,
                        streetViewControl :false,
                        zoomControlOptions:{
                            position:google.maps.ControlPosition.TOP_RIGHT
                        },
                        panControlOptions :{
                            position:google.maps.ControlPosition.TOP_RIGHT
                        },
                        zoom              :15,
                        center            :[<?php echo $model->location->Latitude . ', ' . $model->location->Longitude; ?>],
                    },
                    callback:function ()
                    {
                    }
                },
                marker:{
                    latLng:[<?php echo $model->location->Latitude . ', ' . $model->location->Longitude; ?>]
                }
            });
        }});
    });
</script>

<?php endif; ?>


