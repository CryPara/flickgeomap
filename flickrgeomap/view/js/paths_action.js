
/*

    This file is writen By Filippo Randazzo and Cristina Parasiliti and is part of FlickrGeomap.

    FlickrGeomap is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    FlickrGeomap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with FlickrGeomap.  If not, see <http://www.gnu.org/licenses/>.





*/


/* Javascript of all actions used in paths view file */



var datas= {};
var returned;
var map ;
var markers = [];

loadScript();

var markersArray = [];



//one user draw path function 

$("#showOneUser").click(function(){

    $(".showNow").hide();
    $(".showNow").removeClass("showNow");
    $("#oneUser").addClass("showNow");
    $("#oneUser").show();

});


$("#loadUsers").click(function(){

    var data = {
        from: $("#datafrom").val(),
        to: $("#datato").val()

    }


    $.ajax({
        url: "util/routes_manager.php",
        type: "POST",
        data: { controller: "paths_controller", function: "onePath", data: data },
        
        success: function (_result) {

            returned = jQuery.parseJSON(_result);


            datas = {};
            $.each(returned.result,function(index,obj){
                if(datas[obj.owner]==null)
                    datas[obj.owner]=new Array();
                datas[obj.owner].push(obj);

            });  

            $("#usersList").empty();
            count=0;
            $.each(datas,function(index,obj){
                

                $("#usersList").append("<option id="+count+" value='"+index+"'>"+index+"</option>");
                count++;
            });  

            $("#usersList").show();
            $("#loadMarker").show();



        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status+" "+thrownError);
        }
    });

});


$("#loadMarker").click(function(){
    clearOverlays();
    if(datas[$("#usersList").val()] != undefined){
       
        deleteMarkers();
        pointPan=null;

        var flightPlanCoordinates = [];



        $.each(datas[$("#usersList").val()],function(index,obj){
            
            isRed=0;
            if(pointPan==null){
                pointPan=new google.maps.LatLng(obj.lat,obj.lon);

            }

            if(index == 0 || index== datas[$("#usersList").val()].length-1){

                isRed=1;
            }
            
            flightPlanCoordinates.push(new google.maps.LatLng(obj.lat,obj.lon));

            addMarker(obj.lat,obj.lon,isRed);


        }); 

        var color = getRandomColor();
        

        var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: color,
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        flightPath.setMap(map);
        markersArray.push(flightPath);

        showMarkers();
        map.panTo(pointPan);
    }else{
        alert("No photos in this period!");   

    }

});














//more users draw paths function 

$("#showMoreUsers").click(function(){

    $(".showNow").hide();
    $(".showNow").removeClass("showNow");
    $("#moreUsers").addClass("showNow");
    $("#moreUsers").show();


});



$("#loadMultipleUsers").click(function(){
    datas= [];
    var data = {
        from: $("#datafrom").val(),
        to: $("#datato").val()

    }


    $.ajax({
        url: "util/routes_manager.php",
        type: "POST",
        data: { controller: "paths_controller", function: "onePath", data: data },
        //dataType: "json",
        success: function (_result) {

            returned = jQuery.parseJSON(_result);

            datas = {};

            $.each(returned.result,function(index,obj){
                if(datas[obj.owner]==null)
                    datas[obj.owner]=new Array();
                datas[obj.owner].push(obj);

            });  

            $("#multipleUsersList").empty();

            $.each(datas,function(index,obj){
                
                $("#multipleUsersList").append("<option value='"+index+"'>"+index+"</option>");

            });  

            $("#multipleUsersList").show();
            $("#loadMultipleMarker").show();
            $("#loadMultipleCentroidsMarker").show();
            $("#loadSingleCentroidsMarker").show();
            $("#multipleUserInfo").show();

           



        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status+" "+thrownError);
        }
    });

});






$("#loadMultipleMarker").click(function(){

    clearOverlays();
    //getSelectedOptions(this);
    selectedUsers=$("#multipleUsersList").val();


    if(selectedUsers != null){
        deleteMarkers();
        pointPan=null;



        // for every user selected draw path in map
        $.each(selectedUsers, function(index, user){

            var flightPlanCoordinates = [];

            $.each(datas[user],function(index,obj){

                isRed=0;
                
                if(pointPan==null)
                    pointPan=new google.maps.LatLng(obj.lat,obj.lon);
                
                flightPlanCoordinates.push(new google.maps.LatLng(obj.lat,obj.lon));


                if(index == 0 || index== datas[user].length-1){

                    isRed=1;
                }



                addMarker(obj.lat,obj.lon,isRed);


            }); 


            var color = getRandomColor();
            



            var flightPath = new google.maps.Polyline({
                path: flightPlanCoordinates,
                geodesic: true,
                strokeColor: color,
                strokeOpacity: 1.0,
                strokeWeight: 2
            });



            flightPath.setMap(map);  
            markersArray.push(flightPath);

        });




        showMarkers();
        map.panTo(pointPan); 

    }
    else{
        alert("No users selected!");   

    }
});








//multiple centroid users draw paths function 



$("#loadMultipleCentroidsMarker").click(function(){
    //getSelectedOptions(this);
    clearOverlays();
    selectedUsers=$("#multipleUsersList").val();


    if(selectedUsers != null){
        deleteMarkers();
        pointPan=null;



        // for every user selected draw path in map
        $.each(selectedUsers, function(index, user){

            var flightPlanCoordinates = [];

            var pathPolygons;
            var polygonCords = [];
            var bounds = new google.maps.LatLngBounds();

            $.each(datas[user],function(index,obj){

                isRed=0;
                
                if(pointPan==null)
                    pointPan=new google.maps.LatLng(obj.lat,obj.lon);
                
                flightPlanCoordinates.push(new google.maps.LatLng(obj.lat,obj.lon));


                if(index == 0 || index== datas[user].length-1){

                    isRed=1;
                }

                var chord= new google.maps.LatLng(obj.lat,obj.lon);
                polygonCords.push( chord);
                bounds.extend( chord);
                addMarker(obj.lat,obj.lon,isRed);


            }); 


            var color = getRandomColor();

            pathPolygons = new google.maps.Polygon({


                paths: polygonCords,
                strockeColor: color,
                strokeOpacity: 0.5,
                strokeWeight: 3,
                fillColor: color,
                fillOpacity: 0.35
            });

            
            addMarker(bounds.getCenter().lat(),bounds.getCenter().lng(),2);
            pathPolygons.setMap(map);
            markersArray.push(pathPolygons);



        });




        showMarkers();
        map.panTo(pointPan); 

    }
    else{
        alert("No users selected!");   

    }
});





// load single centroid for all photos selected

$("#loadSingleCentroidsMarker").click(function(){
    //getSelectedOptions(this);


    clearOverlays();
    selectedUsers=$("#multipleUsersList").val();


    if(selectedUsers != null){
        deleteMarkers();
        pointPan=null;

        var flightPlanCoordinates = [];

        var pathPolygons;
        var polygonCords = [];
        var bounds = new google.maps.LatLngBounds();

        // for every user selected draw path in map
        $.each(selectedUsers, function(index, user){

            isRed=0;
           
            $.each(datas[user],function(index,obj){


                
                if(pointPan==null)
                    pointPan=new google.maps.LatLng(obj.lat,obj.lon);

                flightPlanCoordinates.push(new google.maps.LatLng(obj.lat,obj.lon));




                var chord= new google.maps.LatLng(obj.lat,obj.lon);
                polygonCords.push( chord);
                bounds.extend( chord);
                addMarker(obj.lat,obj.lon,isRed);


            }); 




        });



        var color = getRandomColor();

        pathPolygons = new google.maps.Polygon({


            paths: polygonCords,
            strockeColor: color,
            strokeOpacity: 0.5,
            strokeWeight: 3,
            fillColor: color,
            fillOpacity: 0.35
        });


        addMarker(bounds.getCenter().lat(),bounds.getCenter().lng(),2);
        pathPolygons.setMap(map);
        markersArray.push(pathPolygons);




        showMarkers();
        map.panTo(pointPan); 

    }
    else{
        alert("No users selected!");   

    }
});











// UTILS FUNCTIONS

function getRandomColor() {

    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}



// GOOGLE MAPS FUNCTION



function clearOverlays() {
    for (var i = 0; i < markersArray.length; i++ ) {
        markersArray[i].setMap(null);
    }
    markersArray.length = 0;
}



function initialize()
{

    var myCenter=new google.maps.LatLng(37.50000000,15.10000000);

    var mapProp = {
        center: myCenter,
        zoom:7,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

function loadScript()
{
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDPycdjPaoBCx6N8_FUdzhhdnUN1WsbJow&sensor=false&callback=initialize";
    document.body.appendChild(script);
}





function addMarker(lat,lon,isRed) {
    
    if(isRed==1){
        imageUrl='view/assets/redpin50.png';
    }
    else if(isRed==0){
        imageUrl='view/assets/blackpin50.png';
    }else {

        imageUrl='view/assets/centroidpin.png';
    }


    var imageIcon = {
        url: imageUrl,
        size: new google.maps.Size(50, 50),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(25, 50),
        scaledSize: new google.maps.Size(50, 50)
    };


    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat,lon),
        icon: imageIcon,
        map: map
    });
    markers.push(marker);
    markersArray.push(marker);
}


// Sets the map on all markers in the array.
function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}



// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setAllMap(null);
}


// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

function showMarkers() {
    setAllMap(map);
}








