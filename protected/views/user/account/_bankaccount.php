<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1>Receive Payments</h1>

    <p>Complete the information below if you plan on listing paid classes or activities on Kowop. Payments from your
        customers will be directly transferred into the account you provide below.</p>

    <div id="billingInfo">

        <h4>Billing Information</h4>

        <div class="row">
            <div class="four columns">
                <label class="inline right">Are you an individual or business?</label>
            </div>
            <div class="eight columns">
                <select id="posterType">
                    <option value="<?php echo UserPosterType::Individual; ?>">Individual</option>
                    <option value="<?php echo UserPosterType::Business; ?>">Business</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="inline right" id='nameLabel'>Name</label>
            </div>
            <div class="eight columns">
                <input type="text" id="name" />
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="inline right">Phone Number</label>
            </div>
            <div class="two columns">
                <input id="areaCode" type="text" placeholder="area code" maxlength="3" />
            </div>
            <div class="two columns">
                <input id="number1" type="text" placeholder="555" maxlength="3" />
            </div>
            <div class="four columns">
                <input id="number2" type="text" placeholder="1234" maxlength="4" />
            </div>
        </div>
        <div class="row">
            <div class="four columns">
                <label class="inline right">Address</label>
            </div>
            <div class="eight columns">
                <input id="address" type="text" placeholder="Street Address" />
            </div>
        </div>
        <div class="row">
            <div class="three columns offset-by-four">
                <input id="city" type="text" placeholder="City">
            </div>
            <div class="two columns">
                <select id="state">
                    <?php
                    foreach (Location::GetStates() as $state)
                    {
                        echo "<option value='{$state}}'>{$state}</option>\n";
                    }
                    ?>
                </select>
            </div>
            <div class="three columns">
                <input id="zip" type="text" maxlength="5" placeholder="Zip Code" />
            </div>
        </div>

    </div>

    <h4>Bank Account Information</h4>

    <div class="row">
        <div class="four columns">
            <label class="inline right">Account Holder's Name</label>
        </div>
        <div class="eight columns">
            <input type="text" autocomplete="off" placeholder="Bank Account Holder's name" class="ba-name">
        </div>
    </div>
    <div class="row">
        <div class="four columns">
            <label class="inline right">Routing Number</label>
        </div>
        <div class="eight columns">
            <input type="text" autocomplete="off" placeholder="Routing Number" class="ba-rn">
        </div>
    </div>
    <div class="row">
        <div class="four columns">
            <label class="inline right">Account Number</label>
        </div>
        <div class="eight columns">
            <input type="text" autocomplete="off" placeholder="Account Number" class="ba-an">
        </div>
    </div>
    <div class="row">
        <div class="four columns">
            <label class="inline right">Account Type</label>
        </div>
        <div class="eight columns">
            <select class='ba-type'>
                <option value='' disabled selected style='display:none;'> Select Account Type</option>
                <option value="checking">CHECKING</option>
                <option value="savings">SAVINGS</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="four columns offset-by-four">
            <button class="button large twelve" id='saveAccount'>Save</button>
        </div>
    </div>
</div>
<!---------- end right column ----------->

<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script>
    $(document).ready(function ()
    {
        $('#billingInfo').hide();

        balanced.init('<?php echo Yii::app()->params["balancedMarketPlaceURI"]; ?>');

        loadBankAccount();

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

        $('#posterType').change(function ()
        {
            if ($(this).val() == <?php echo UserPosterType::Individual; ?>)
            {
                $('#nameLabel').text('Name');
            }
            else
            {
                $('#nameLabel').text('Business Name');
            }
        });
    });

    function bankAccountCallbackHandler(response)
    {
        switch (response.status)
        {
            case 201:
                // WOO HOO!
                // response.data.uri == uri of the card or bank account resource
                var dataString = JSON.stringify(response.data);

                var phone = '+1' + $('#areaCode').val() + $('#number1').val() + $('#number2').val();
                var type = 'person';
                if ($('#posterType').val() == <?php echo UserPosterType::Business ?>)
                {
                    type = 'business';
                }

                var merchantDataObject = {
                    phone_number  :phone,
                    name          :$('#name').val(),
                    street_address:$('#address').val(),
                    postal_code   :$('#zip').val(),
                    type          :type
                };

                var merchantDataString = JSON.stringify(merchantDataObject);

                $.ajax({
                    type   :'post',
                    url    :"<?php echo Yii::app()->createAbsoluteUrl('/payment/addBankAccount'); ?>",
                    data   :{ data:dataString, merchantData:merchantDataString },
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
                    $('#billingInfo').show();
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