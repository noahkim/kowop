<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">
        <h1>Frequently Asked Questions</h1>

        <div id="faqs">
            <h5>What is Kowop?</h5>

            <div>
                <p>Kowop makes it really simple to find classes and activities for kids and their families.</p>

                <p>We also make it ridiculously easy to post. You can post once, and it stays available for as long as
                    you'd like. We handle payments for you. You can even manage scheduling right on Kowop.</p>

                <p>Unlike many sites, we don't make you jump through hoops and hurdles just to post. If you're an
                    individual or business who has a local class or activity you'd love to share, share on Kowop. It's
                    100% free to post, so there's nothing to lose.</p>
            </div>
            <h5>Do you screen or curate the available classes or activities on Kowop?</h5>

            <div>
                <p>For the most part, no. Kowop is an open marketplace just like your local neighborhood board at the
                    grocery store. We leave it up to you, the community, to leave feedback and let the rest of your
                    neighbors know if something is awesome or not. Classes and activities who aren't holding up their
                    end of the deal will naturally be weeded out by the community.</p>

                <p> That being said, if you attend a class or activity and have a really bad experience, please
                    <?php echo CHtml::link("contact", $this->createUrl("site/page", array('view' => 'contact'))); ?>
                    us so we can take care of you. Also, if your offering goes against our posting guidelines, we
                    reserve the right to blast it into oblivion (in the most friendly way possible).</p>
            </div>
            <h5>What are your posting guidelines?</h5>

            <div>
                <p>First and foremost, no spamming. If we discover that you're using Kowop to dubiously spam, we will
                    remove your listings and ask you nicely to scale it back. Second time we'll have to ask you to
                    leave, and by "ask", we mean "ban".</p>

                <p>Also, no activities or classes engaging in illegal or of a prohibitive nature can be allowed.</p>

                <p>Other then that, everything else is fair game.</p>
            </div>
            <h5>I'm not a business, just little ol' me, but I'd like to host an activity or teach a class, what do I
                need to do?</h5>

            <div>
                <p>All you have to do is take 5 minutes and dooeeet! You don't need anyone's permission. All we ask is
                    that you have the knowledge and passion for whatever experience you want to share. Be creative, be
                    honest, be yourself, and try it out.</p>
            </div>
            <h5>How are you different then Groupon/Living Social?</h5>

            <div>
                <p>Because of their nature as a "deals" site, their offers expire. Kowop's classes and activities stay
                    available as long as you'd like, so you stay visible year round. As an individual or business on
                    Kowop, posting your offering is 100% free. When people do sign up, we (Kowop) tip ourselves much...
                    much....much....much.....much..... MUCH less then these deal sites. That means more money in your
                    pocket even when you charge promotional pricing.</p>

                <p>Also, normal people (individuals, not businesses) like you and me who want to teach or provide a neat
                    experience are more then welcome to post on Kowop. We're an open marketplace driven by the culture
                    and demands of the neighborhood.</p>

                <p>Last but not least, Kowop is just as much about meeting new friends &amp; socializing as it is about
                    classes &amp; activities. When you meet awesome people, connect on Kowop so there's always a
                    friendly face at your next experience.</p>
            </div>
            <h5>How are you different from a tutoring site?</h5>

            <div>
                <p>For starters, we don't ask for nearly as much as most tutoring sites, which commonly range from
                    20-40%. Also, tutoring usually implies 1 on 1. At Kowop, we encourage classes (at least 2 people).
                    This helps tutors teach more efficiently, and make more moolah. It also helps people learn in a more
                    comfortable group setting.</p>
            </div>
            <h5>Do you allow online classes?</h5>

            <div>
                <p>Nope. Kowop is about neighborhoods, and hanging out with locals. We also believe the best way to
                    experience new things is hands on with a host who aims to please.</p>
            </div>
            <h5>Do you charge to post on Kowop?</h5>

            <div>
                <p>Absolutely not. It's free to post for both individuals and businesses.</p>
            </div>
            <h5>So how much do you charge?</h5>

            <div>
                <p>We only make money if you make money. It's free to post, but when someone signs up for your class or
                    activity, we tip ourselves 10%.</p>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>


<script type="text/javascript">
    /* accessible */
    $(document).ready(function ()
    {
        $('#faqs h5').each(function ()
        {
            var tis = $(this), state = false, answer = tis.next('div').hide().css('height', 'auto').slideUp();
            tis.click(function ()
            {
                state = !state;
                answer.slideToggle(state);
                tis.toggleClass('active', state);
            });
        });
    });
</script>
