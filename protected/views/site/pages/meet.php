<!--------- main content container------>
<div class="row" id="wrapper">

    <!---------------------------------------
                     left nav
    ---------------------------------------->
    <div class="three columns">
        <ul class="twelve side-nav">
            <li>
                <?php echo CHtml::link("About Kowop", $this->createUrl("site/page", array('view' => 'about'))); ?>
            </li>
            <li class="active"><a href="#">Meet the Team</a></li>
        </ul>
    </div>
    <!---------------------------------------
                     right content
    ---------------------------------------->
    <div class="nine columns meetTheteam">
        <h1 class="spacebot20">Meet the team</h1>

        <div class="row">
            <div class="six columns spacebot20"><img src="/ui/site/images/sample_amit.jpg"></div>
            <div class="six columns">
                <h2 class="green">Amit Bhatia</h2>
                <span class="meetTitle">Founder of ACBR (Amit Coffee Bean Run)</span>

                <p>As the head of operations, Amit ensures that we only hire people who aren't convicted murderers and
                    that things run smoothly within the Kowop team. As a former business analyst, Amit has a leg up on
                    the technical side and is an invaluable contributor to the application side of Kowop. He's probably
                    one of the few COO's who can identify issues in a data model faster then a data modeler. He also
                    knows how to hack a standard cup of coffee at Coffee Bean into a Vanilla Latte without having to pay
                    more. His book "How to Hack CBTL" is a number 1 best seller on the NY Times list (in his head).
                </p>
            </div>
        </div>
        <div class="row">
            <div class="six columns spacebot20">
                <h2 class="teal">Ilija Stevcev</h2>
                <span class="meetTitle">Aspring Physicist/Musician/Star Fleet Captian</span>

                <p>A coding wizard that makes Neo look like Keanu Reeves (oh wait...), Ilija's (not) been featured in
                    Wired magazine as number 4 in their 2012 "Hottest Programmers of Silicon Valley" issue. In all
                    seriousness, Captain Stevcev aspires to be a one-of-a-kind musician while simultaneously discovering
                    the secrets of the universe. If you ever need to ask a question that involves explaining why a
                    drumset dropped out of the sky actually falls to the ground, and why concentrated tachion bursts
                    from the deflector array doesn't actually create time wormholes (contrary to Noah's claims), Ilija
                    is your man.
                </p>
            </div>
            <div class="six columns"><img src="/ui/site/images/sample_ilija.jpg"></div>
        </div>
        <div class="row">
            <div class="six columns spacebot20"><img src="/ui/site/images/sample_noah.jpg"></div>
            <div class="six columns">
                <h2 class="magenta">Noah Kim</h2>
                <span class="meetTitle">Ex-wannabe-pro-Starcraft-player</span>

                <p>Prior to starting Kowop, Noah pretended to be an interactive Art Director for the better part of this
                    millenium. Pressed with doing something that actually improved peoples lives, he struck out to do so
                    with the help of the two aforementioend talented individuals. During his off hours, he still
                    fantasizes about beating the best Korean Starcraft players, and subliminally trains his 3.5 year
                    old's finger dexterity, while the child sleeps, for future gaming domination.
                </p>
            </div>
        </div>
    </div>
</div>
<!------- end main content container----->
</div>