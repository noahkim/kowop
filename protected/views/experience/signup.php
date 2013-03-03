<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">
        <h1>...one last look</h1>

        <div class="detailsMain">
            <div class="row">
                <div class="six columns">
                    <img src='<?php echo $model->picture; ?>' />
                </div>


                <div class="six columns">
                    <h2><?php echo $model->Name; ?></h2>

                    <?php if (isset($model->Price)) : ?>

                    <ul>
                        <li>Cost: $<?php echo $model->Price; ?></li>

                        <?php if ($quantity != null) : ?>
                        <li>Quantity: <?php echo $quantity; ?></li>
                        <?php endif; ?>

                        <?php if ($session != null) : ?>
                        <li> Session Date: <?php echo date('F j, Y', strtotime($session->Start)); ?></li>
                        <?php endif; ?>
                    </ul>

                    <?php
                    $price = $model->Price;
                    if ($quantity != null)
                    {
                        $price = $model->Price * $quantity;
                    }
                    ?>
                    <span class="checkoutTotal"> Total: $<?php echo number_format($price, 2); ?></span>

                    <h2> Payment Information </h2>

                    <label> Pay using the following credit card </label>

                    <select id="savedCards"></select>

                    <p> Enter in a new credit card </p>

                    <div class="row">
                        <div class="eight columns">
                            <label>Card Number</label>

                            <input type="text"
                                   value=""
                                   autocomplete="off"
                                   placeholder="Card Number"
                                   class="cc-number" />
                        </div>
                        <div class="four columns">
                            <label>Security Code (CSC)</label>

                            <input type="text" value="" autocomplete="off" placeholder="CSC" class="cc-csc" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="six columns">
                            <label>Exp. Month</label>

                            <select class="cc-em">
                                <option value='1'>January</option>
                                <option value='2'>February</option>
                                <option value='3'>March</option>
                                <option value='4'>April</option>
                                <option value='5'>May</option>
                                <option value='6'>June</option>
                                <option value='7'>July</option>
                                <option value='8'>August</option>
                                <option value='9'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                        <div class="six columns">
                            <label>Exp. Year</label>

                            <select class="cc-ey">
                                <option>2013</option>
                                <option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                            </select>
                        </div>
                    </div>

                    <label> Save payment information for future use? You can always make changes from your account
                        management section later .</label>

                    <input type="checkbox" id='saveCard' /> Yes, save this credit card

                    <button type="submit" class="button large twelve" id='signUp'>
                        Sign Up
                    </button>

                    <?php else : ?>

                    <ul>
                        <li>Cost: Free</li>
                        <?php if ($quantity != null) : ?>
                        <li>Quantity: <?php echo $quantity; ?></li>
                        <?php endif; ?>
                        <?php if ($session != null) : ?>
                        <li> Session Date: <?php echo date('F j, Y', strtotime($session->Start)); ?></li>
                        <?php endif; ?>
                    </ul>
                    <span class="checkoutTotal">Total: $0.00</span>

                    <button type="submit" class="button large twelve" id='signUpFree'>
                        Sign Up
                    </button>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!------- end main content container----->

<?php $form = $this->beginWidget('CActiveForm', array('id' => 'signup-form', 'enableAjaxValidation' => false)); ?>

<input type="hidden" name="confirm" value="confirm" />
<input type="hidden" name="CreditCard_ID" id="CreditCard_ID" />
<input type='hidden' name="quantity" value="<?php echo $quantity; ?>" />

<?php $this->endWidget('CActiveForm'); ?>

<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script>
    var signedUp = false;

    $(document).ready(function ()
    {
        balanced.init('<?php echo Yii::app()->params["balancedMarketPlaceURI"]; ?>');

        loadCards();

        $('#signUp').click(function (e)
        {
            e.preventDefault();

            $('#signUp').attr('disabled', 'disabled');

            if (($('.cc-number').val().length > 0) || ($('.cc-csc').val().length > 0))
            {
                var card = {
                    "card_number"     :$('.cc-number').val(),
                    "security_code"   :$('.cc-csc').val(),
                    "expiration_month":$('.cc-em').val(),
                    "expiration_year" :$('.cc-ey').val()
                };

                balanced.card.create(card, cardCallbackHandler);
            }
            else
            {
                signUp($('#savedCards').val());
            }
        });

        $('#signUpFree').click(function (e)
        {
            e.preventDefault();
            signUpFree();
        });
    });


    function cardCallbackHandler(response)
    {
        switch (response.status)
        {
            case 201:
                // WOO HOO!
                // response.data.uri == uri of the card or bank account resource
                var dataString = JSON.stringify(response.data);
                var saveCard = $('#saveCard').is(':checked') ? 1 : 0;

                $.ajax({
                    type   :'post',
                    url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/addCard'); ?>",
                    data   :{ data:dataString, save:saveCard },
                    success:function (results)
                    {
                        var data = JSON.parse(results);

                        if (data.success)
                        {
                            signUp(data.CreditCard_ID);
                        }
                    }
                });
                break;
            case 400:
                // missing field - check response.error for details
                console.log(response.error);
                break;
            case 402:
                // we couldn't authorize the buyer's credit card
                // check response.error for details
                console.log(response.error);
                break
            case 404:
                // your marketplace URI is incorrect
                console.log(response.error);
                break;
            case 500:
                // Balanced did something bad, please retry the request
                console.log(response.error);
                break;
        }
    }

    function loadCards()
    {
        $.ajax({
            type   :'get',
            url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/getCards'); ?>",
            success:function (results)
            {
                var cards = JSON.parse(results);

                $('#savedCards').empty();

                for (var i in cards)
                {
                    var card = cards[i];

                    $('#savedCards').append('<option class="card" value="' + card.CreditCard_ID + '">' + card.data.brand + ' ending in ***********' + card.data.last_four + '</option>');
                }
            }
        });
    }

    function signUp(cardID)
    {
        if (!signedUp)
        {
            signedUp = true;
            $('#CreditCard_ID').val(cardID);
            $('#signup-form').submit();
        }
    }

    function signUpFree()
    {
        if (!signedUp)
        {
            signedUp = true;
            $('#signup-form').submit();
        }
    }
</script>