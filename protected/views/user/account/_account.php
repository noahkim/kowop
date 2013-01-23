<!---------- right column--------------->
<div class="nine columns accountInformation">
    <h1><?php echo $model->fullname; ?></h1>

    <p>Member since <?php echo date('F Y', strtotime($model->Created)); ?></p>

    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Profile image</div>
        <div class="two columns">
            <?php
                $imgLink = 'http://placehold.it/800x800';

                if($model->profilePic != null)
                {
                    $imgLink = $model->profilePic;
                }

                echo "<img src='{$imgLink}'>\n";
            ?>
        </div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Name</div>
        <div class="eight columns"><?php echo $model->fullname; ?></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">About yourself</div>
        <div class="eight columns">
            <?php echo $model->Description; ?>
        </div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Instructor Title</div>
        <div class="eight columns"><?php echo $model->Teacher_alias; ?></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Networks</div>
        <div class="eight columns"></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Location</div>
        <div class="eight columns"></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Timezone</div>
        <div class="eight columns"></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Payment Information</div>
        <div class="eight columns"></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
    <div class="row accountEditrow">
        <div class="three columns accountEditlabel">Bank account information</div>
        <div class="eight columns"></div>
        <div class="one column"><a href="#" class="button tiny secondary radius">Edit</a></div>
    </div>
</div>
<!---------- end right column ----------->