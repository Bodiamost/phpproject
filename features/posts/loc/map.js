/**
 * Created by Sharanjeet Kaur on 2017-04-20.
 */

$(document).ready(function () {
    //var parent=$(".pmap");
    var output = ' <div class="pmap">';
    $.get("disMap.php",function (data) {
        //alert(data);
        var i=1;
        $.each(data,function (index,d) {
            //console.log(d.lat);


                output += '<div id="map' + i + '" style="height: 400px"></div>';
                $('#results').append(output);
                initMap(d.lat, d.lng, "map" + i);

                i=i+1;


        });
        output += '</div>';

    });




});

