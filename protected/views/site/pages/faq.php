<!--------- main content container------>
<div class="row" id="wrapper">
    <div class="twelve columns">
        <div id="faqs">
            <h3>This is question 1?</h3>

            <div>
                <p>This is the answer to question #1. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 2?</h3>

            <div>
                <p>This is the answer to question #2. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 1?</h3>

            <div>
                <p>This is the answer to question #1. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 2?</h3>

            <div>
                <p>This is the answer to question #2. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 1?</h3>

            <div>
                <p>This is the answer to question #1. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 2?</h3>

            <div>
                <p>This is the answer to question #2. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 1?</h3>

            <div>
                <p>This is the answer to question #1. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 2?</h3>

            <div>
                <p>This is the answer to question #2. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 1?</h3>

            <div>
                <p>This is the answer to question #1. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 2?</h3>

            <div>
                <p>This is the answer to question #2. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 1?</h3>

            <div>
                <p>This is the answer to question #1. Pellentesque habitant morbi....</p>
            </div>
            <h3>This is question 2?</h3>

            <div>
                <p>This is the answer to question #2. Pellentesque habitant morbi....</p>
            </div>
        </div>
    </div>
    <!------- end main content container----->
</div>

<script type="text/javascript">
    /* accessible */
    $(document).ready(function() {
        $('#faqs h3').each(function() {
            var tis = $(this), state = false, answer = tis.next('div').hide().css('height','auto').slideUp();
            tis.click(function() {
                state = !state;
                answer.slideToggle(state);
                tis.toggleClass('active',state);
            });
        });
    });
</script>