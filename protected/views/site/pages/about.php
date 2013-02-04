<!--------- main content container------>
<div class="row" id="wrapper">

    <!---------------------------------------
                     left nav
    ---------------------------------------->
    <div class="three columns">
        <ul class="twelve side-nav">
            <li class="active"><a href="#">About Kowop</a></li>
            <li>
                <?php echo CHtml::link("Meet the Team", $this->createUrl("site/page", array('view' => 'meet'))); ?>
            </li>
        </ul>
    </div>
    <!---------------------------------------
                     right content
    ---------------------------------------->
    <div class="nine columns">
        <h1 class="spacebot20">The Story of Kowop</h1>

        <div class="storyKowop"><span>Kōwop - derived from Co-Op</span>working or acting together willingly for a common
            purpose or benefit...
        </div>
        <p>Like the birth of many ideas, Kowop was conceived from trying to solve a frustration. Prior to Kowop,
            <?php echo CHtml::link("Noah", $this->createUrl("site/page", array('view' => 'meet'))); ?>
            was trying to learn Python programming for one of his zany web application ideas. He started searching
            online for resources to learn. Like many people have discovered, consuming online tutorials on your own only
            took him so far.</p>

        <p>Being busy at work on the weekdays, and a father at nights and weekends, local schooling wasn't an attractive
            option despite the advantage learning in a class environment provides. Tutors (which didn't even exist for
            this particular subject matter in his area), was more convenient for scheduling, but were prohibitively
            expensive and didn't offer the valuable collaboration of fellow enrolled.</p>

        <p>So he went online, and started looking for some sort of community that would help facilitate him learning
            programming. To his surprise, none existed. Sure, there were sites where people could "meet up", but the
            emphasis was purely on networking and general pow-wow'ing. Other sites that focused on providing education
            services, were simply gateways to expensive tutors or online course material that wasn't free.</p>

        <p>So he started thinking....why do people have to pay &amp; go to a semester's worth of classes to quickly
            learn the jist of something?</p>

        <p class="storyRevelation">They don't.</p>

        <p>How are people staying engaged through online courses when there's no real instructor, and more importantly,
            no fellow peers to learn with?</p>

        <p class="storyRevelation">They aren't.</p>

        <p>Where are the affordable instructors that teach Python, or how to properly slow roast a rack of ribs, or how
            to replace the suspension on your car?</p>

        <p class="storyRevelation">Not anywhere we've looked.</p>

        <p>Where do busy people like me go to learn and retain new things that don't happen to be english, math, or a
            second language and may be a bit offbeat by "traditional" education standards?</p>

        <p class="storyRevelation">Nowhere.</p>

        <p>Instead of watching a movie for 2 hours on a Saturday, is there a place I can scope out classes in my
            neighborhood that me and a few friends can attend spur of the moment, and come out of the other end having
            made a bird house?</p>

        <p class="storyRevelation">There is now =).</p>

        <p>At Kowop, we thrive on the ideal that everyone is not only a student, but also a teacher. There's something
            that everyone is good at, and we believe there will always be someone willing to learn it.</p>
    </div>
    <!------- end main content container----->
</div>
