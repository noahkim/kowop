<div class="row" id="wrapper">
    <div class="six columns offset-by-three login">
        <!---------------------------------------
                    Login
    ---------------------------------------->
        <h1>login to Kowop</h1>
        <?php echo CHtml::beginForm(array('class' => 'custom')); ?>
        <?php echo CHtml::activeTextField($form, 'username', array('placeholder' => 'email')); ?>
        <?php echo CHtml::activePasswordField($form, 'password', array('placeholder' => 'password')); ?>
        <div class="row">
            <div class="six columns">
                <label for="checkbox1">
                    <input type="checkbox" id="checkbox1" style="display: none;">
                    <span class="custom checkbox"></span> Remember me</label>
            </div>

            <div class="six columns">
                <?php echo CHtml::submitButton('Login', array('class' => 'button large radius twelve')); ?>
            </div>
        </div>
        <?php echo CHtml::endForm(); ?>
        <a href="#">Forgot my password</a> |
        <?php echo CHtml::link('Get an account', array('/user/create')); ?>
    </div>
    <!------- end main content container----->
</div>
