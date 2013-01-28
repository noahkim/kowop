<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1><?php echo $model->fullname; ?></h1>

    <p>Member since <?php echo date('F Y', strtotime($model->Created)); ?></p>

    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Profile image</div>
        <div class="nine columns">
            <?php
            $imgLink = 'http://placehold.it/800x800';

            if ($model->profilePic != null)
            {
                $imgLink = $model->profilePic;
            }

            echo "<img src='{$imgLink}'>\n";
            ?>
        </div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">About yourself</div>
        <div class="nine columns edit_description" id='Description'>
            <?php echo $model->Description; ?>
        </div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Instructor Title</div>
        <div class="nine columns edit_teacher_alias" id='Teacher_alias'>
            <?php echo $model->Teacher_alias; ?>
        </div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Networks</div>
        <div class="nine columns">
            Google+ <a href="#">(hookup)</a>, Twitter <a href="#">(hookup)</a>, Facebook <a
                href="#">(connected)</a>
        </div>
    </div>
</div>


</div>
<!---------- end right column ----------->

<script>
    $(document).ready(function () {

        $('.edit_teacher_alias').editable('<?php echo $this->createAbsoluteUrl('/user/submitProfileChange'); ?>', {
            select:true,
            submit:'OK',
            cancel:'cancel',
            tooltip:'Click to edit...'

        });

        $('.edit_description').editable('<?php echo $this->createAbsoluteUrl('/user/submitProfileChange'); ?>', {
            type:'textarea',
            cancel:'Cancel',
            rows:20,
            submit:'OK',
            indicator:'<img src="/ui/sitev2/images/loading.gif">',
            tooltip:'Click to edit...'
        });

    });
    /*
        $('.edit').editable('http://www.example.com/save.php', {
            cssclass:'jeditableinput',
            cancel:'Cancel',
            submit:'OK'
        });

        $('.editZipcode').editable('http://www.example.com/save.php', {
            cssclass:'jeditableinput',
            cancel:'Cancel',
            submit:'OK',
            maxlength:5
        });

        $('.editState').editable('http://www.example.com/save.php', {
            type:"select",
            data:"{'Alabama':'Alabama', 'Alaska':'Alaska','Arizona':'Arizona', 'Arkansas':'Arkansas', 'California':'California', 'Colorado':'Colorado', 'Connecticut':'Connecticut', 'Delaware':'Delaware', 'Florida':'Florida', 'Georgia':'Georgia', 'Hawaii':'Hawaii', 'Idaho':'Idaho', 'Illinois':'Illinois', 'Indiana':'Indiana', 'Iowa':'Iowa', 'Kansas':'Kansas', 'Kentucky':'Kentucky', 'Louisiana':'Louisiana', 'Maine':'Maine', 'Maryland':'Maryland', 'Massachusetts':'Massachusetts', 'Michigan':'Michigan', 'Minnesota':'Minnesota', 'Mississippi':'Mississippi', 'Missouri':'Missouri', 'Montana':'Montana', 'Nebraska':'Nebraska', 'Nevada':'Nevada', 'New Hampshire':'New Hampshire', 'New Jersey':'New Jersey', 'New Mexico':'New Mexico', 'New York':'New York', 'North Carolina':'North Carolina', 'North Dakota':'North Dakota', 'Ohio':'Ohio', 'Oklahoma':'Oklahoma', 'Oregon':'Oregon', 'Pennsylvania':'Pennsylvania', 'Rhode Island':'Rhode Island', 'South Carolina':'South Carolina', 'South Dakota':'South Dakota', 'Tennessee':'Tennessee', 'Texas':'Texas', 'Utah':'Utah', 'Vermont':'Vermont', 'Virginia':'Virginia', 'Washington':'Washington', 'West Virginia':'West Virginia', 'Wisconsin':'Wisconsin', 'Wyoming':'Wyoming'}",
            cssclass:'jeditableinput',
            cancel:'Cancel',
            submit:'OK'
        });*/

</script>