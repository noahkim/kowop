<!---------------------------------------
                 Search Summary
---------------------------------------->
<div class="row spacebot20">
    <div class="twelve columns">
    <span>
        <?php echo count($results); ?> Search results for "<?php echo $model->keywords; ?>".
    </span>
        Can't find what you're looking for?
        <?php echo CHtml::link('Request it', array('/request/create'), array('class' => 'button small radius')); ?>
    </div>
</div>
<!--------- main content container------>
<div class="row" id="wrapper">
<!---------------------------------------
            Results Grid
---------------------------------------->
<div class="nine columns resultsGrid spacebot20">
    <div class="row">
        <?php
        foreach ($results as $i => $item)
        {
            $teacherName = $item->createUser->Teacher_alias ? $item->createUser->Teacher_alias : $item->createUser->fullname;
            $teacherLink = CHtml::link($teacherName, array('/user/view', 'id' => $item->Create_User_ID));
            $description = $item->Description;
            if (strlen($description) > 100)
            {
                $description = substr($description, 0, 100);
                $description .= ' ...';
            }

            $sessionHTML = 'Request';
            if ($item instanceof KClass)
            {
                if (($item->Tuition == null) || ($item->Tuition == 0) || (count($item->sessions) == 0))
                {
                    $sessionHTML = 'This class is free!';
                }
                else
                {
                    $sessionCount = count($item->sessions);
                    $tuition = $item->Tuition * $sessionCount;

                    $sessionHTML = "\${$tuition} ({$sessionCount} sessions)";
                }
            }

            $itemNumber = $i + 1;

            $name = "<h3> {$item->Name} </h3>";
            if ($item instanceof KClass)
            {
                $name = CHtml::link($name, array('/class/view', 'id' => $item->Class_ID));
            }
            elseif ($item instanceof Request)
            {
                $name = CHtml::link($name, array('/request/view', 'id' => $item->Request_ID));
            }

            $end = '';
            if ($itemNumber == count($results))
            {
                $end = 'end';
            }

            if ($item instanceof KClass)
            {
                //<span class="ribbon staffpick"></span>

                echo <<<BLOCK
  <!----- 1 tile/result ------->
  <div class="four columns spacebot20 {$end}">
    <div class="resultsTile"> <span class="tilenumber">{$itemNumber}</span>
      <div class="resultsImage">
        <img src="http://flickholdr.com/400/300/bbq"/>
      </div>
      <div class="row" class="spacebot10">
      <!----- row with the current enrollees thumbnails---->
      <div class="twelve columns enrollees">
        <img src="http://placeskull.com/100/100/868686">
        <img src="http://placeskull.com/100/100/868686">
        <img src="http://placeskull.com/100/100/868686">
        <img src="http://placeskull.com/100/100/868686">
        <img src="http://placeskull.com/100/100/868686">
      </div>
    </div>
    {$name}
     <span class="resultsInstructor">with {$teacherLink}</span>
     <span class="resultsCategory food">in {$item->category->Name}</span>
     <span class="resultsDescription spacebot10"> {$description} </span>
     </div>
  <div class="resultsSession">
    <div>{$sessionHTML}</div>
  </div>
</div>
<!----- End 1 tile/result---->
BLOCK;
            }
            elseif ($item instanceof Request)
            {
                $joinLink = CHtml::link('Quick Join', array('/request/join', 'id' => $item->Request_ID));

                echo <<<BLOCK
<!----- 1 tile/result REQUEST ------->
<div class="four columns spacebot20 {$end}">
<span class="ribbon request"></span>
  <div class="requestTile">
    <div class="row" class="spacebot10"></div>
  {$name}
  <span class="resultsCategory food">in {$item->category->Name}</span>
  <span class="resultsDescription spacebot10"> {$description} </span>
  <!----- row with the current enrollees thumbnails---->
  <div class="row">
    <div class="twelve columns enrollees"> <img src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686"> <img src="http://placeskull.com/100/100/868686"> </div>
  </div>
  <!---- end enrollees ----->
</div>
    <div class="requestQuickjoin">
    {$joinLink}
    </div>
</div>
<!----- End 1 tile/result REQUEST---->
BLOCK;

            }
        }
        ?>
        <!----- End results grid----->
    </div>
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
</div>
<!---------------------------------------
             Sidebar
---------------------------------------->
<div class="three columns sidebar">
    <div class="resultsMap">
        <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=90232&amp;aq=&amp;sll=34.020479,-118.411732&amp;sspn=0.841143,1.461182&amp;ie=UTF8&amp;hq=&amp;hnear=Culver+City,+California+90232&amp;t=m&amp;z=14&amp;ll=34.023688,-118.39002&amp;output=embed"></iframe>
    </div>

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form-filters',
    'action' => Yii::app()->createUrl('/class/search'),
    'enableAjaxValidation' => false,
    'method' => 'get'
)); ?>
    <!------ Search Filters ------->
    <div class="searchFilters">
        <h4>Filter Results</h4>

        <label>Seats in next class</label>
        <?php echo $form->dropDownList($model, 'seatsInNextClass', SearchForm::$seatsInNextClassLookup); ?>

        <label>Tuition</label>
        <?php echo $form->textField($model, 'minTuition', array('placeholder' => 'min')); ?>
        <?php echo $form->textField($model, 'maxTuition', array('placeholder' => 'max')); ?>

        <label>Next class starts by:</label>
        <?php echo $form->textField($model, 'nextClassStartsBy', array('placeholder' => 'ex.10/24/13')); ?>
        <?php
        $classTypeData = array(0 => "don't care");
        $classTypeData = array_merge($classTypeData, ClassType::$Lookup);
        ?>
        <label>Class type:</label>
        <?php echo $form->dropDownList($model, 'classType', $classTypeData); ?>

        <?php echo $form->hiddenField($model, 'keywords', array('value' => $model->keywords)); ?>
        <a href="#" class="button radius" onclick="document.forms['search-form-filters'].submit(); return false;">Apply
            Filters</a>
    </div>
    <!---- Categories & tags resulting from search return ----->
    <div class="searchCategories">
        <h4>Categories &amp; Tags</h4>

        <?php
        $categories = array();
        $tags = array();

        foreach ($results as $item)
        {
            $categories[$item->category->Category_ID] = $item->category->Name;
            $tags = array_merge($tags, $item->taglist);
        }

        $tags = array_unique($tags);
        $tags = array_values($tags);

        /*            print_r($model->categories);
                    foreach ($categories as $i => $category)
                    {
                        $checked = null;

                        $opts = array('id' => "checkbox{$i}");
                        if(isset($model->categories[$i]) && ($model->categories[$i] == '1'))
                        {
                            $opts = array_merge($opts, array('checked' => 'checked'));
                        }

                        echo "<label for='checkbox{$i}'>";
                        echo $form->checkBox($model, 'categories[]', $opts);
                        echo "<span class='custom checkbox'></span> {$category} </label>\n";
                    }*/

        $opts = array('separator' => "\n");
        echo $form->checkBoxList($model, 'categories', $categories, $opts);

        ?>
        <ul class="sidebartags">
            <?php
            foreach ($tags as $tag)
            {
                $link = CHtml::link($tag, array('/class/search', 'SearchForm[keywords]' => $tag));
                echo "<li>{$link}</li>";
            }
            ?>
        </ul>

        <?php $this->endWidget('CActiveForm'); ?>
    </div>
</div>
<!------- end main content container----->
</div>


