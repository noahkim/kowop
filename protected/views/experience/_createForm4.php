<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="nine columns">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'class-create-form-nav',
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
                document.forms['class-create-form-nav'].submit();
            }
        </script>

        <!---- progress bar ------>
        <div class="row">
            <div class="twelve columns">
                <ul class="progress">
                    <li class="done"><a href="#" onclick='navigateTo(1); return false;'>1</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(2); return false;'>2</a></li>
                    <li class="done"><a href="#" onclick='navigateTo(3); return false;'>3</a></li>
                    <li class="active">4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
        <!---- end progress bar---->

        <h1>Let's start with the basics...</h1>

        <form>
            <div class="row">
                <div class="four columns">
                    <label class="right inline">Name your experience</label>
                </div>
                <div class="eight columns">
                    <input type="text" placeholder=""/>
                </div>
            </div>
            <div class="row">
                <div class="four columns">
                    <label class="right inline">Category</label>
                </div>
                <div class="eight columns">
                    <select class="five">
                        <option>Adventure</option>
                        <option>Schoolastic</option>
                        <option>Handy Work</option>
                        <option>Fitness &amp; Athletics</option>
                        <option>Entertainment</option>
                        <option>Food &amp; Beverage</option>
                        <option>Business &amp; Finance</option>
                        <option>Creative &amp; Art</option>
                        <option>Music</option>
                        <option>Technology</option>
                        <option>Family Fun</option>
                        <option>Romantic</option>
                        <option>Off beat</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="four columns">
                    <div class="helptip"><span class="has-tip tip-top noradius" data-width="300"
                                               title="Tags are any words you'd like to associate with your experience. It'll help people discover it when they search.">?</span>
                    </div>
                    <label class="right inline">Tags</label>
                </div>
                <div class="eight columns">
                    <input type="text" placeholder="ex. risky, adrenaline, skydiving, birthday suit, bucket list"/>
                </div>
            </div>
            <div class="row">
                <div class="four columns">
                    <label class="right inline">Image</label>
                </div>
                <div class="eight columns">
                    <input type="text" placeholder="upload"/>
                </div>
            </div>
            <div class="row">
                <div class="four columns">
                    <div class="helptip"><span class="has-tip tip-top noradius" data-width="300"
                                               title="These are the dates your class or activity will remain available on Kowop. It can be as short or as long as you'd like.">?</span>
                    </div>
                    <label class="right inline">Availability</label>
                </div>
                <div class="three columns">
                    <input id="datepicker-example7-start" type="text">
                </div>
                <div class="three columns end">
                    <input id="datepicker-example7-end" type="text">
                </div>
            </div>
            <div class="row">
                <div class="four columns">
                    <label class="right inline">Location</label>
                </div>
                <div class="eight columns">
                    <input type="text" placeholder="Street ex. 444 Charles Ave"/>
                </div>
            </div>
            <div class="row">
                <div class="three columns offset-by-four">
                    <input type="text" placeholder="City"/>
                </div>
                <div class="three columns">
                    <select name="state">
                        <option value="CA">CA</option>
                        <option value="AL">AL</option>
                        <option value="AK">AK</option>
                        <option value="AZ">AZ</option>
                        <option value="AR">AR</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DE">DE</option>
                        <option value="DC">DC</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="IA">IA</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="ME">ME</option>
                        <option value="MD">MD</option>
                        <option value="MA">MA</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MS">MS</option>
                        <option value="MO">MO</option>
                        <option value="MT">MT</option>
                        <option value="NE">NE</option>
                        <option value="NV">NV</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NY">NY</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VT">VT</option>
                        <option value="VA">VA</option>
                        <option value="WA">WA</option>
                        <option value="WV">WV</option>
                        <option value="WI">WI</option>
                        <option value="WY">WY</option>
                    </select>
                </div>
                <div class="two columns">
                    <input type="text" placeholder="ZIP" maxlength="5"/>
                </div>
            </div>
            <!----- Only show this if they previously selected that this is a kids experience------>
            <div class="row">
                <div class="four columns">
                    <label class="right inline">Age appropriateness</label>
                </div>
                <div class="eight columns">
                    <input type="checkbox" name="age" value="0-3">
                    0-3 years
                    <input type="checkbox" name="age" value="3-5">
                    3-5 years
                    <input type="checkbox" name="age" value="5-10">
                    5-10 years
                    <input type="checkbox" name="age" value="10+">
                    10+ years
                </div>
            </div>
            <!----- End conditional div--------->
        </form>

        <div class="row">
            <div class="four columns offset-by-eight">
                <a href="create_experience5.html" class="button twelve">Pricing &amp; Description</a>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>

<script>
    $(document).ready(function () {
        $('#datepicker-example7-start').Zebra_DatePicker({
            direction:true,
            pair:$('#datepicker-example7-end')
        });

        $('#datepicker-example7-end').Zebra_DatePicker({
            direction:1
        });
    });
</script>