<!--------- main content container------>
<div class="row" id="wrapper">
    <!--------- end left column ------------->
    <div class="nine columns">
        <div class=" createContainer">
            <h1>Create a class</h1>
            <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'class-create-form',
            'enableAjaxValidation' => false,
            'stateful' => true
        )); ?>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Name your class</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'name',
                    array('size' => 60, 'maxlength' => 255, 'class' => 'ten', 'placeholder' => 'ex. Real Life Guitar Hero for the absolute beginner')); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Category</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->dropDownList($model, 'category', Category::GetCategories(), array('class' => 'five')); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Tags</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'tags', array('placeholder' => 'ex. music, guitar, acoustic')); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Zip Code</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'locationZip', array('size' => 45, 'maxlength' => 5, 'class' => 'five')); ?>
                </div>
            </div>

            <?php echo $form->hiddenField($model, 'classType', array('value' => ClassType::Online)); ?>
            <?php echo $form->hiddenField($model, 'fromRequest_ID'); ?>

            <div class="row borderTop">
                <div id="searchExisting">
                    Similar classes and requests: <br />
                    <div id="results"></div>
                </div>

                <div class="twelve columns alignRight">
                    <?php echo CHtml::submitButton('Save & Continue', array('name' => 'step2', 'class' => 'button radius')); ?>

                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
    <!-------------- end left column ----------->
    <!-------------- right column -------------->
    <div class="three columns">
        <h3>FAQ</h3>
    </div>
    <!---------------end right column---------->
    <!------- end main content container----->
</div>

<script type='text/javascript'>
    $(document).ready(function () {

        $('#searchExisting').hide();

        var timeoutHandle1;
        var timeoutHandle2;

        var timeout = 1000;

        $('form :input[type=text]').keyup (function() {
            clearTimeout(timeoutHandle1);
            timeoutHandle1 = setTimeout(updateSearch, timeout);
        });

        $('form select').change(function() {
            clearTimeout(timeoutHandle2);
            timeoutHandle2 = setTimeout(updateSearch, timeout);
        });
    });

    function updateSearch()
    {
        var keywords = '';
        $('form :input[type=text]').each(function() {
            keywords += $(this).val() + ' ';
        });

        var category = $('form select').val();

        $('#searchExisting').show();

        getResults(keywords, category);
    }

    function getResults(keywords, category)
    {
        var data = "SearchForm[keywords]=" + keywords;

        if(arguments.length == 2)
        {
            data += '&SearchForm[category]=' + category;
        }

        data +=  "&json";

        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("class/search"); ?>',
            data: data,
            dataType: 'json',
            success: function(data)
            {
                var output = '';

                for(i in data)
                {
                    var item = data[i];
                    output += item.Name + '<br />';
                    output += item.Description + '<br /><br />';
                }

                $('#results').html(output);
            }
        });
    }
</script>