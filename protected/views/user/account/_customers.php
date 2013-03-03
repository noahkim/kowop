<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>My Customers</h1>

    <div class="row">
        <div class="two columns">
            <label class="right inline">Choose listing</label>
        </div>
        <div class="six columns">
            <select id='selectExperience'>
                <option value='all'>All</option>
                <?php
                foreach ($model->experiences as $experience)
                {
                    $selected = '';
                    if ($experience->Experience_ID == $data['experience'])
                    {
                        $selected = "selected='selected'";
                    }

                    echo "<option value='{$experience->Experience_ID}' {$selected}>{$experience->Name}</option>\n";
                }
                ?>
            </select>
        </div>
        <div class="one column">
            <label class="right inline">Search</label>
        </div>
        <div class="three columns">
            <input type="text" id='search' value='<?php echo ($data['search'] == null) ? '' : $data['search']; ?>' />
        </div>
    </div>
    <table class="stretch">
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Confirmation</th>
            <th></th>
        </tr>

        <?php
        foreach ($data['payments'] as $payment)
        {
            $customer = $payment->buyer;

            $userLink = CHtml::link($customer->display, array('user/view', 'id' => $customer->User_ID));
            $date = date('n.j.Y', strtotime($payment->Created));

            echo <<<BLOCK
        <tr id='payment{$payment->Payment_ID}'>
            <td>{$userLink}</td>
            <td>{$date}</td>
            <td>{$payment->code}</td>
            <td>
                <a href="#" class="button small" onclick="message({$customer->User_ID}, '{$customer->display}');">Message</a>
                <a href="#" class="button small" onclick="flagToggle('payment{$payment->Payment_ID}'); return false;">Flag</a>
            </td>
        </tr>

BLOCK;
        }
        ?>
    </table>

    <!--- pagination --->
    <ul class="pagination">
        <?php
        if ($data['page'] == 1)
        {
            echo "<li class='arrow unavailable'>&laquo;</li>\n";
        }
        else
        {
            $link = CHtml::link('&laquo;', array('user/view', 'id' => $model->User_ID, 's' => AccountSections::MyCustomers, 'page' => $data['page'] - 1));
            echo "<li class='arrow'>{$link}</li>\n";
        }

        for ($i = 1; ($i <= $data['totalPages']) && ($i <= 3); $i++)
        {
            $current = '';
            if ($i == $data['page'])
            {
                $current = "class='current'";
            }

            $link = CHtml::link($i, array('user/view', 'id' => $model->User_ID, 's' => AccountSections::MyCustomers, 'page' => $i));
            echo "<li {$current}>{$link}</li>\n";
        }

        if ($data['totalPages'] > 3)
        {
            echo "<li class='unavailable'><a href=''>&hellip;</a></li>\n";

            for ($i = $data['totalPages']; $i >= ($data['totalPages'] - 3); $i--)
            {
                $current = '';
                if ($i == $data['page'])
                {
                    $current = "class='current'";
                }

                $link = CHtml::link($i, array('user/view', 'id' => $model->User_ID, 's' => AccountSections::MyCustomers, 'page' => $i));
                echo "<li {$current}>{$link}</li>\n";
            }
        }

        if ($data['page'] == $data['totalPages'])
        {
            echo "<li class='arrow unavailable'>&raquo;</li>\n";
        }
        else
        {
            $link = CHtml::link('&raquo;', array('user/view', 'id' => $model->User_ID, 's' => AccountSections::MyCustomers, 'page' => $data['page'] + 1));
            echo "<li class='arrow'>{$link}</li>\n";
        }

        ?>
    </ul>
    <!----- end pagination--->

    <!-------- end right column --------->
</div>

<!----------------- Modal--------------------->
<div id="myModal" class="reveal-modal small">
    <h2>Send <span id='messageName'></span> a message</h2>

    <textarea name="message" rows="10" id='message'></textarea>

    <input type="hidden" id="customerID" />

    <button class="button secondary radius" onclick="sendMessage(); return false;">send</button>

    <a class="close-reveal-modal">&#215;</a>
</div>

<script>
    $(document).ready(function ()
    {
        $('#selectExperience').change(function ()
        {

        });
    });

    function message(id, name)
    {
        $("#customerID").val(id);
        $('#messageName').text(name);

        $("#myModal").reveal();
    }

    function sendMessage()
    {
        var customerID = $("#customerID").val();
        var message = $('#message').val();

        var url = "<?php echo Yii::app()->createAbsoluteUrl('/user/sendMessage', array('id' => '{ID}')); ?>";
        url = url.replace('{ID}', customerID);

        $.ajax({
            type   :'post',
            url    :url,
            data   :{ message:message },
            success:function (results)
            {
                $('#myModal').trigger('reveal:close');
            }
        });
    }

    function flagToggle(id)
    {
        var element = $('#' + id);

        if (element.hasClass('flagged'))
        {
            element.removeClass('flagged');
        }
        else
        {
            element.addClass('flagged');
        }
    }
</script>