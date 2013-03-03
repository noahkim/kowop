<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1>Payment Information</h1>

    <dl class="tabs">
        <dd class="active"><a href="#simple1">My Credit Card information</a></dd>
        <dd><a href="#simple2">Receving Payments (my bank account information)</a></dd>
    </dl>

    <ul class="tabs-content">
        <li class="active" id="simple1Tab">
            <h4>Saved credit cards</h4>

            <div id="savedCards"></div>

            <a href="#" class="button large" id='removeCards'>Remove selected cards</a>

            <h4>Enter a new credit card</h4>

            <div class="row">
                <div class="eight columns">
                    <label>Card Number</label>

                    <input type="text" value="" autocomplete="off" placeholder="Card Number" class="cc-number">
                </div>
                <div class="four columns">
                    <label>Security Code (CSC)</label>

                    <input type="text" value="" autocomplete="off" placeholder="CSC" class="cc-csc">
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

            <a class="button large" href="#" id="saveCard">Save</a>
        </li>

        <li id="simple2Tab">
            <label>Account Holder's Name</label>

            <input type="text" autocomplete="off" placeholder="Bank Account Holder's name" class="ba-name">

            <label>Routing Number</label>

            <input type="text" autocomplete="off" placeholder="Routing Number" class="ba-rn">

            <label>Account Number</label>

            <input type="text" autocomplete="off" placeholder="Account Number" class="ba-an">

            <label>Account Type</label>

            <select class='ba-type'>
                <option value="checking">CHECKING</option>
                <option value="savings">SAVINGS</option>
            </select>

            <button class="button large" id='saveAccount'>Save</button>
        </li>
    </ul>

</div>
<!---------- end right column ----------->

<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script>
    $(document).ready(function ()
    {
        balanced.init('<?php echo Yii::app()->params["balancedMarketPlaceURI"]; ?>');

        loadCards();
        loadBankAccount();

        $('#saveCard').click(function (e)
        {
            e.preventDefault();

            var card = {
                "card_number"     :$('.cc-number').val(),
                "security_code"   :$('.cc-csc').val(),
                "expiration_month":$('.cc-em').val(),
                "expiration_year" :$('.cc-ey').val()
            };

            balanced.card.create(card, cardCallbackHandler);
        });

        $('#removeCards').click(function (e)
        {
            e.preventDefault();
            deleteCards();
        });

        $('#saveAccount').click(function (e)
        {
            e.preventDefault();

            var bankAccount = {
                name          :$('.ba-name').val(),
                account_number:$('.ba-an').val(),
                routing_number:$('.ba-rn').val(),
                type          :$('.ba-type').val()
            };

            balanced.bankAccount.create(bankAccount, bankAccountCallbackHandler);
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

                $.ajax({
                    type   :'post',
                    url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/addCard'); ?>",
                    data   :{ data:dataString },
                    success:function (results)
                    {
                        loadCards();
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

                    $('#savedCards').append('<p><input type="checkbox" class="card" id="' + card.CreditCard_ID + '">' + card.data.brand + ' ending in ***********' + card.data.last_four + '</p>');
                }
            }
        });
    }

    function deleteCards()
    {
        var cards = [];

        $('.card').each(function ()
        {
            if ($(this).is(':checked'))
            {
                cards.push(parseInt($(this).attr('id')));
            }
        });

        var dataString = JSON.stringify(cards);

        $.ajax({
            type   :'post',
            url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/deleteCards'); ?>",
            data   :{ data:dataString },
            success:function (results)
            {
                loadCards();
            }
        });
    }

    function bankAccountCallbackHandler(response)
    {
        switch (response.status)
        {
            case 201:
                // WOO HOO!
                // response.data.uri == uri of the card or bank account resource
                var dataString = JSON.stringify(response.data);

                $.ajax({
                    type   :'post',
                    url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/addBankAccount'); ?>",
                    data   :{ data:dataString },
                    success:function (results)
                    {
                        loadBankAccount();
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

    function loadBankAccount()
    {
        $.ajax({
            type   :'get',
            url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/getBankAccount'); ?>",
            success:function (results)
            {
                if (results == "null")
                {
                    return;
                }

                var account = JSON.parse(results);

                $('.ba-name').val(account.data.name);
                $('.ba-an').val(account.data.account_number);
                $('.ba-rn').val(account.data.routing_number);
                $('.ba-type').val(account.data.type);
            }
        });
    }
</script>