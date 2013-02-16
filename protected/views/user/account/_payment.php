<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1>Payment Information</h1>

    <dl class="tabs">
        <dd class="active"><a href="#simple1">Receving Payments (my bank account information)</a></dd>
        <dd><a href="#simple2">My Credit Card information</a></dd>
    </dl>

    <ul class="tabs-content">
        <li class="active" id="simple1Tab">

            <form action="#" method="POST" id="bank-account-form">
                <label>Account Holder's Name</label> <input type="text"
                                                            autocomplete="off"
                                                            placeholder="Bank Account Holder's name"
                                                            class="ba-name">

                <label>Routing Number</label> <input type="text"
                                                     autocomplete="off"
                                                     placeholder="Routing Number"
                                                     class="ba-rn">

                <label>Account Number</label> <input type="text"
                                                     autocomplete="off"
                                                     placeholder="Account Number"
                                                     class="ba-an">

                <label>Account Type</label> <select>
                <option value='' disabled selected style='display:none;'>
                    Select Account Type
                </option>
                <option value="checking">CHECKING</option>
                <option value="savings">SAVINGS</option>
            </select>

                <button type="submit" class="button large">
                    Save
                </button>
            </form>

        </li>
        <li id="simple2Tab">

            <h4>Saved credit cards</h4>

            <p><input type="checkbox">Visa ending in ***********3254</p>

            <p><input type="checkbox">Visa ending in ***********3254</p>
            <a href="#" class="button large">Remove selected cards</a>

            <form action="#" method="POST" id="credit-card-form">

                <h4>Enter in a new credit card</h4>

                <div class="row">
                    <div class="eight columns">
                        <label>Card Number</label> <input type="text"
                                                          autocomplete="off"
                                                          placeholder="Card Number"
                                                          class="cc-number">
                    </div>
                    <div class="four columns">
                        <label>Security Code (CSC)</label> <input type="text"
                                                                  autocomplete="off"
                                                                  placeholder="CSC"
                                                                  class="cc-csc">

                    </div>
                </div>
                <div class="row">
                    <div class="six columns">
                        <label>Exp. Month</label> <input type="text"
                                                         autocomplete="off"
                                                         placeholder="Expiration Month"
                                                         class="cc-em">
                    </div>
                    <div class="six columns">
                        <label>Exp. Year</label> <input type="text"
                                                        autocomplete="off"
                                                        placeholder="Expiration Year"
                                                        class="cc-ey">

                    </div>
                </div>
                <a class="button large" href="checkout2.html">Save</a>
            </form>

        </li>
    </ul>

</div>
<!---------- end right column ----------->

<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script>
    $(document).ready(function() {
        balanced.init('<?php echo Yii::app()->params["balancedMarketPlaceURI"]; ?>');
    });
</script>