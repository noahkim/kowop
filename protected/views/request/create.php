<!--------- main content container------>
<div class="row" id="wrapper">
    <!--------- end left column ------------->
    <div class="twelve columns">
        <div class=" createContainer">
            <h1>Request a class</h1>

            <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'request-form',
            'enableAjaxValidation' => false,
        )); ?>

            <div class="row">
                <div class="three columns">
                    <label class="right inline">Requested class name?</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'Name', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'placeholder' => 'ex. Real Life Guitar Hero for the absolute beginner',
                    'class' => 'ten'
                )); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Describe what you want to learn</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textArea($model, 'Description', array('size' => 60, 'maxlength' => 2000, 'rows' => '10', 'class' => 'ten')); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Category</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->dropDownList($model, 'Category_ID', Category::GetCategories(), array('class' => 'five')); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Is tuition okay?</label>
                </div>
                <div class="nine columns">
                    <?php
                    echo $form->dropDownList($model, 'HasTuition', array(
                        0 => "ehhh, I'd prefer it be free",
                        1 => 'Yes, knowledge is priceless'
                    ), array('class' => 'five'));
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Tags</label>
                </div>
                <div class="nine columns">
                    <input type="text" class="ten" name="tags" id="tags" placeholder="ex. music, guitar, acoustic"/>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">Zip Code</label>
                </div>
                <div class="nine columns">
                    <?php echo $form->textField($model, 'Zip', array('size' => 45, 'maxlength' => 5, 'class' => 'five')); ?>
                </div>
            </div>
            <div class="row">
                <div class="three columns">
                    <label class="right inline">What's your general availability?</label>
                </div>
                <div class="nine columns">
                    <table class="requestAvailability twelve">
                        <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tues</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            $dayOptions = array(
                                0 => "don't know",
                                1 => 'n/a',
                                2 => 'daytime',
                                3 => 'evening',
                                4 => 'all day'
                            );

                            foreach (DayOfWeek::$Lookup as $i => $name)
                            {
                                echo "<td>\n";
                                echo $form->dropDownList($modelJoin, "availability[{$i}]", $dayOptions);
                                echo "</td>\n";
                            }

                            ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row borderTop">
                <div class="twelve columns alignRight">
                    <?php echo CHtml::submitButton('Create my request', array('class' => 'button radius')); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
    <!-------------- end left column ----------->
<!------- end main content container----->
</div>