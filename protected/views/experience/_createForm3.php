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
            function navigateTo(page) {
                $('#step').val(page);
                document.forms['experience-create-form-nav'].submit();
            }
        </script>

        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="done"><a href="#" onclick='navigateTo(1); return false;'>1</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(2); return false;'>2</a></li>
                    <li class="active">3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->

        <h1>What age is best for your experience?</h1>

        <div class="row">
            <div class="six columns">
                <a href="#" onclick='submitForm(<?php echo ExperienceAudience::Everyone; ?>); return false;'>
                    <div class="createOption">
                        <span>Doesn't matter</span>

                        <p>Fun for the whole family!</p>
                    </div>
                </a>
            </div>
            <div class="six columns">
                <a href="#" onclick='submitForm(<?php echo ExperienceAudience::Kids; ?>); return false;'>
                    <div class="createOption">
                        <span>Primarily Kids</span>

                        <p>From babies up to early teens</p>
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

    <input name="step" type="hidden" value="4"/>
    <?php echo $form->hiddenField($model, 'Audience', array('id' => 'audience')); ?>

    <?php $this->endWidget(); ?>

    <!------- end main content container----->
</div>

<script>
    function submitForm(audience) {
        $("#audience").val(audience);
        document.forms['experience-create-form'].submit();
    }
</script>
