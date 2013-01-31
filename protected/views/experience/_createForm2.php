<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">

        <?php
        $navForm = $this->beginWidget('CActiveForm', array(
            'id' => 'experience-create-form-nav',
            'enableAjaxValidation' => false,
            'stateful' => true,
            'htmlOptions' => array('style' => 'margin: 0;'),
        ));
        ?>
        <input id="step" name="step" type="hidden"/>
        <?php $this->endWidget(); ?>

        <script>
            function navigateTo(page)
            {
                $('#step').val(page);
                document.forms['experience-create-form-nav'].submit();
            }
        </script>

        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="done"><a href="#" onclick='navigateTo(1); return false;'>1</a></li>
                    <li class="active">2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->
        <h1>Is this experience an activity or a class?</h1>

        <p>If it fits both, choose what you think is more appropriate.</p>

        <div class="row">
            <div class="six columns">
                <a href="#" onclick='submitForm(<?php echo ExperienceType::Activity; ?>); return false;'>
                    <div class="createOption">
                        <span>Activity</span>

                        <p>I'm showing people a good time.</p>
                    </div>
                </a>
            </div>
            <div class="six columns">
                <a href="#" onclick='submitForm(<?php echo ExperienceType::Class_; ?>); return false;'>
                    <div class="createOption">
                        <span>Class</span>

                        <p>I'm teaching something epic.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'experience-create-form',
        'enableAjaxValidation' => false,
        'stateful' => true
    ));
    ?>

    <input name="step" type="hidden" value="3"/>
    <?php echo $form->hiddenField($model, 'ExperienceType', array('id' => 'experienceType')); ?>

    <?php $this->endWidget(); ?>

    <!------- end main content container----->
</div>

<script>
    function submitForm(experienceType)
    {
        $("#experienceType").val(experienceType);
        document.forms['experience-create-form'].submit();
    }
</script>
