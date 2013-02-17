<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>My Customers</h1>

    <div class="row">
        <div class="two columns">
            <label class="right inline">Choose listing</label>
        </div>
        <div class="six columns">
            <select>
                <?php
                foreach ($model->experiences as $experience)
                {
                    echo "<option>{$experience->Name}</option>\n";
                }
                ?>
            </select>
        </div>
        <div class="one column">
            <label class="right inline">Search</label>
        </div>
        <div class="three columns">
            <input type="text" />
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
        foreach ($model->customerPayments as $payment)
        {
            $customer = $payment->buyer;

            $userLink = CHtml::link($customer->display, array('user/view', 'id' => $customer->User_ID));
            $date = date('n.j.Y', strtotime($payment->Created));

            echo <<<BLOCK
        <tr>
            <td>{$userLink}</td>
            <td>{$date}</td>
            <td>{$payment->code}</td>
            <td><a href="#" class="button small">Message</a> <a href="#" class="button small">Flag</a></td>
        </tr>

BLOCK;
        }
        ?>
    </table>
    <!--- pagination --->
    <ul class="pagination">
        <li class="arrow unavailable"><a href="">&laquo;</a></li>
        <li class="current"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">4</a></li>
        <li class="unavailable"><a href="">&hellip;</a></li>
        <li><a href="">12</a></li>
        <li><a href="">13</a></li>
        <li class="arrow"><a href="">&raquo;</a></li>
    </ul>
    <!----- end pagination---><!-------- end right column --------->
</div>
