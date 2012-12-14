<!------- right column ------------->
<div class="nine columns accountClasses">
    <h1>Classes I'm teaching</h1>
    <!----- currently teaching --------->
    <span class="profileCount"><?php echo count($model->kClasses); ?></span>
    <h2>Currently teaching</h2>
    <div class="row">
        <?php

        $index = 1;

        foreach ($model->kClasses as $class)
        {
            $imgLink = 'http://placehold.it/400x300';

            if (count($class->contents) > 0)
            {
                $imgLink = $class->contents[0]->Link;
            }

            $classLink = CHtml::link($class->Name, array('/class/view', 'id' => $class->Class_ID));

            $end = '';
            if($index == count($model->kClasses))
            {
                $end = 'end';
            }

            echo <<<BLOCK
                <div class="three columns {$end}">
                    <div class="profileTile">
                        <img src="{$imgLink}">
                        <span class="profileClassTitle">
                            {$classLink}
                        </span>
                    </div>
                </div>
BLOCK;

            $index++;
        }
        ?>
    </div>
    <!------ end currently teaching -------->
    <!------ Past taught classes ------------->
    <span class="profileCount">0</span>
    <h2>Past taught classes</h2>
    <div class="row">
<!--        <div class="three columns">
            <div class="profileTile"> <img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a href="class_detail.html">Class Title</a></span> </div>
        </div>
        <div class="three columns">
            <div class="profileTile"> <img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a href="class_detail.html">Class Title</a></span> </div>
        </div>
        <div class="three columns">
            <div class="profileTile"> <img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a href="class_detail.html">Class Title</a></span> </div>
        </div>
        <div class="three columns end">
            <div class="profileTile"> <img src="http://placehold.it/400x300"> <span class="profileClassTitle"><a href="class_detail.html">Class Title</a></span> </div>
        </div>-->
    </div>
    <!------ End Past taught classes ---->
    <!-------- end right column --------->
</div>