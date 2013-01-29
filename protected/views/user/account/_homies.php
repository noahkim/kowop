<!---------- right column--------------->
<div class="nine columns homies">
    <h1>Homies</h1>
    <span class="profileCount">
        <?php
        echo count($model->friends(array('condition' => 'Status = ' . FriendStatus::AwaitingApproval)));
        ?>
    </span>

    <h2>New homie request</h2>
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns"><a href="user_profile_public.html"><img src="images/sample_amit.jpg"></a></div>
        <div class="ten columns">
            <h2>Amit Bhatia</h2>

            <p>Hey man, really enjoyed taking the Python class with you. Thanks for helping me out on the 2nd day. Mind
                if we homie-up? Wouldn't mind taking more programming classes with you!</p>
            <a href="#" class="button">Aw Yeah!</a>
            <a href="#" class="button">Um, No</a>
        </div>
    </div>
    <!-----------end 1 Homie----->
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns"><a href="user_profile_public.html"><img src="images/sample_ilija.jpg"></a></div>
        <div class="ten columns">
            <h2>Ilija Stevcev</h2>

            <p>It was great to meet you during our wood-working class!</p>
            <a href="#" class="button">Aw Yeah!</a>
            <a href="#" class="button">Um, No</a>
        </div>
    </div>
    <!-----------end 1 Homie----->
    <span class="profileCount">
        <?php
        echo count($model->friends(array('condition' => 'Status = ' . FriendStatus::Friend)));
        ?>
    </span>

    <h2>My Homies</h2>
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns"><a href="user_profile_public.html"><img src="images/sample_noah.jpg"></a></div>
        <div class="ten columns">
            <h2>Jay Park</h2>
            <span class="homieUpdate">Followed class<a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Enrolled in <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Request a class: <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
        </div>
    </div>
    <!-----------end 1 Homie----->
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns"><a href="user_profile_public.html"><img src="images/sample_ilija.jpg"></a></div>
        <div class="ten columns">
            <h2>Robert Redford</h2>
            <span class="homieUpdate">Followed class<a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Enrolled in <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Request a class: <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
        </div>
    </div>
    <!-----------end 1 Homie----->
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns"><a href="user_profile_public.html"><img src="images/sample_annie.jpg"></a></div>
        <div class="ten columns">
            <h2>Annie Na</h2>
            <span class="homieUpdate">Followed class<a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Enrolled in <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Request a class: <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
        </div>
    </div>
    <!-----------end 1 Homie----->
    <!------- 1 Homie --------->
    <div class="row accountHomies">
        <div class="two columns"><a href="user_profile_public.html"><img src="images/sample_ilija.jpg"></a></div>
        <div class="ten columns">
            <h2>Scott Summers</h2>
            <span class="homieUpdate">Followed class<a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Enrolled in <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
            <span class="homieUpdate">Request a class: <a href="class_detail.html">"How to teach a pigeon to do
                cartwheels"</a></span>
        </div>
    </div>
    <!-----------end 1 Homie----->
</div>
<!---------- end right column ----------->
