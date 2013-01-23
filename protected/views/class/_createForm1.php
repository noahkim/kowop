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
                    <?php echo $form->textField($model, 'tags', array('placeholder' => 'ex. music, guitar, acoustic', 'class' => 'ten')); ?>
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

            <?php echo $form->hiddenField($model, 'fromRequest_ID'); ?>
            <input type='hidden' name='step2' />

            <?php $this->endWidget(); ?>

            <div class="row borderTop">
                <div class="four columns offset-by-eight">
                    <input class="button large twelve" onclick="document.forms['class-create-form'].submit(); return false;" type="submit" value="Save &amp; Continue" />
                </div>
            </div>

            <div id="searchExisting">
                <h4>
                    Similar classes and requests:
                </h4>

                <div id="results"></div>
            </div>
        </div>
    </div>
    <!-------------- end left column ----------->
    <!-------------- right column -------------->
    <div class="three columns">
        <h3>Tips</h3>
        <ul>
            <li>You can only pick 1 category, but put in as many tags as you like</li>
            <li>We'll do a quick search for you to see if there's any existing requests that you can pick up, instead of
                creating a class from scratch
            </li>
        </ul>
    </div>
    <!---------------end right column---------->
    <!------- end main content container----->
</div>

<script type='text/javascript'>
    $(document).ready(function () {

        $('#searchExisting').hide();

        var timeoutHandle1;
        var timeoutHandle2;

        var timeout = 750;

        $('form :input[type=text]').keyup(function () {
            clearTimeout(timeoutHandle1);
            timeoutHandle1 = setTimeout(updateSearch, timeout);
        });

        $('form select').change(function () {
            clearTimeout(timeoutHandle2);
            timeoutHandle2 = setTimeout(updateSearch, timeout);
        });
    });

    function updateSearch() {
        var keywords = '';
        $('form :input[type=text]').each(function () {
            keywords += $(this).val() + ' ';
        });

        if(($.trim(keywords)).length == 0)
        {
            $('#searchExisting').hide();
            return;
        }

        //var category = $('form select').val();

        $('#searchExisting').show();
        getResults(keywords);
    }

    function getResults(keywords, category) {
        var data = "ClassSearchForm[keywords]=" + keywords;

        if (arguments.length == 2) {
            data += '&ClassSearchForm[category]=' + category;
        }

        $.ajax({
            type:'GET',
            url:'<?php echo Yii::app()->createAbsoluteUrl("class/searchResults"); ?>',
            data:data,
            success:function (result) {
                $('#results').html(result);
            }
        });
    }
</script>