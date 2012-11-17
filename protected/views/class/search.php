<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
    function placeMarkers(locations) {
        if(locations.length == 0)
        {
            return;
        }

        var geocoder = new google.maps.Geocoder();
        var mapOptions =
        {
            zoom:8,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var firstLocation = locations[0];
        geocoder.geocode({ 'address':firstLocation }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker(
                        {
                            map:map,
                            position:results[0].geometry.location
                        }
                );
            }
        });

        for (var i = 1; i < locations.length; i++) {
            geocoder.geocode({ 'address':locations[i] }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker(
                            {
                                map:map,
                                position:results[0].geometry.location
                            }
                    );
                }
            });
        }
    }
</script>

<div>
    Search Results
</div>

<br />

<div>
    <?php
    foreach ($results as $item)
    {
        echo "<div style='border: 1px solid gainsboro; width: 600px; margin-bottom: 10px; padding: 10px; border-radius: 10px;'>";

        if ($item instanceof KClass)
        {
            echo CHtml::link($item->Name, array('/class/view', 'id' => $item->Class_ID));
            if ($item->location == null)
            {
                echo ' (Online class)';
            }
            else
            {
                echo " ({$item->location->City}, {$item->location->State})";
            }

            echo '<br />';
            echo 'with ' . CHtml::link($item->createUser->fullname, array('/user/view', 'id' => $item->Create_User_ID)) . '<br />';
        }
        elseif($item instanceof Request)
        {
            echo CHtml::link($item->Name, array('/request/view', 'id' => $item->Request_ID));
            echo ' (Class request) <br />';
        }
        echo 'Description: ' . $item->Description . '<br />';
        echo 'Category: ' . $item->category->Name . '<br />';
        echo 'Tags: ' . $item->tagstring . '<br />';

        if($item instanceof KClass)
        {
            if(($item->Tuition == null) || ($item->Tuition == 0) || (count($item->sessions) == 0))
            {
                echo 'This class is free! <br />';
            }
            else
            {
                echo count($item->sessions) . ' sessions for $' . (count($item->sessions) * $item->Tuition) . '<br />';
            }
        }
        elseif ($item instanceof Request)
        {
            echo count($item->requestToUsers) . ' people want this to become a reality<br />';
        }
        echo '</div>';
    }
    ?>
</div>

<br/>

<div id="map" style="height: 400px; width: 400px;">
</div>

<script>
    var locations = new Array();
    <?php
    foreach ($results as $item)
    {
        $location = $item->location;
        if ($location != null)
        {
            $address = "{$location->Address},{$location->City},{$location->State} {$location->Zip}";
            echo "locations.push('{$address}');\n";
        }
    }
    ?>

    placeMarkers(locations);
</script>