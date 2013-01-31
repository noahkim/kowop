<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">
        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->
        <h1>Are you a business or individual?</h1>

        <div class="row">
            <div class="six columns">
                <a href="#" onclick='submitForm(<?php echo ExperiencePosterType::Business; ?>); return false;'>
                    <div class="createOption">
                        <span>Business</span>

                        <p>I do this full time, and have my own space.</p>
                    </div>
                </a>
            </div>
            <div class="six columns">
                <a href="#" onclick='submitForm(<?php echo ExperiencePosterType::Individual; ?>); return false;'>
                    <div class="createOption">
                        <span>Individual</span>

                        <p>I don't have an "official" location.</p>
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

    <input name="step" type="hidden" value="2"/>
    <?php echo $form->hiddenField($model, 'PosterType', array('id' => 'posterType')); ?>

    <?php $this->endWidget(); ?>

    <!------- end main content container----->
</div>

<script>
    function submitForm(posterType)
    {
        $("#posterType").val(posterType);
        document.forms['experience-create-form'].submit();
    }
</script>
