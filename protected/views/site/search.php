<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
    function placeMarkers(locations)
    {
        var geocoder = new google.maps.Geocoder();
        var mapOptions =
        {
            zoom:8,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var firstLocation = locations[0];
        geocoder.geocode({ 'address' : firstLocation }, function (results, status) {
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

        for(var i = 1; i < locations.length; i++)
        {
            geocoder.geocode({ 'address' : locations[i] }, function (results, status) {
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

<div>
    <?php
    foreach ($results as $item)
    {
        echo $item->Name . '<br />';
    }
    ?>
</div>

<div id="map" style="height: 400px; width: 400px;">
</div>

<script>
    var locations = new Array();
    <?php
    foreach ($results as $item)
    {
        $location = $item->location;
        $address = "{$location->Address},{$location->City},{$location->State} {$location->Zip}";
        echo "locations.push('{$address}');\n";
    }
    ?>

    placeMarkers(locations);
</script>