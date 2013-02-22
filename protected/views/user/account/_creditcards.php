<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1>Credit Card Information</h1>

    <p>Manage the credit cards you use to pay for classes &amp; activities on Kowop.</p>

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
</div>
<!---------- end right column ----------->

<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script>
    $(document).ready(function ()
    {
        balanced.init('<?php echo Yii::app()->params["balancedMarketPlaceURI"]; ?>');

        loadCards();

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
</script>