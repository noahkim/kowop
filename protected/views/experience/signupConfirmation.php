<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">
        <h1>yay!</h1>

        <div class="detailsMain">
            <div class="row">
                <div class="twelve columns text-center">
                    <h2>Thanks for signing up.</h2>

                    <p>You've been sent an email with your confirmation.</p>

                    <p>
                        You can view your classes &amp; activities under
                        <?php echo CHtml::link('account management', array('/user/view', 'id' => Yii::app()->user->id, 's' => AccountSections::Notifications)); ?>
                    </p>

                    <p>
                        <?php echo CHtml::link('Discover more classes &amp; activities', array('/experience/search')); ?>
                    </p>
                </div>
            </div>
        </div>
        <!------- end main content container----->
    </div>
</div>