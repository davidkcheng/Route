<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Application</title>
	<style> 
		#map-canvas {
        height: 700px;
        width: 70%;
        margin: 0px;
        padding: 0px;
    
    }
    .map_div {
        border: 1px solid #CCCCCC;
        border-radius: 4px;
        float: left;
        height: 500px;
        margin-left: 4px;
        margin-top: 10px;
        padding: 10px;
        width: 700px;
    }


    </style>
   
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=geometry"></script>
    <script src="js/jquery-1.9.1.min.js"></script>
</head>
<body>
    <div style="float:right">
<table border="1" bordercolor="#888" cellspacing="0" style="text-align:left;border-collapse:collapse;border-color:rgb(136,136,136);border-width:1px">
<tbody>
<tr>
<td style="width:329px;height:20px">
<div style="display:block;text-align:left">
<div style="text-align:center;display:block"></div>
</div>
</td>
</tr>
<tr>
<td style="width:329px;height:281px">
<div style="display:block;text-align:center;margin-right:auto;margin-left:auto">
<div></div>
<div></div>
<div></div>
<div></div>
<br>
</div>
Project Contact:<br>
Dr. Louis A. Merlin, AICP<br>
Office 734-763-3082<br>
Phone: (734) 763-3082<br>
lmerlin@umich.edu&nbsp;<br>
&nbsp;<a href="http://taubmancollege.umich.edu/planning/faculty/directory/" target="_blank">Taubman College Urban Planning Faculty</a></td>
</tr>
</tbody>
</table>
</div>
<div style="text-align:left"><span style="font-size:x-large;background-color:transparent;line-height:1.25">Prospective Project Based Accessibility Evaluation</span></div>
<div style="font-weight:bold"><br>
</div>
<h2><b><font color="#0b5394">Website Description</font></b></h2>
This website helps to determine what sets of origins and destinations are impacted by local traffic impacts associated with a development project. &nbsp;This website is part of a broader suite of tools to understand the accessibility impacts of a development project at the regional scale.
<div><br>
</div>
<div>In specific, this website takes a set of point origins, a set of point destinations, and a set of affected intersections, and reports how much delay will be experienced by each origin-destination pair as a result of the known, intersection-level delays. &nbsp;Intersection level delays are determined from a prior Traffic Impact Analysis of the project.<br>
<h3 style="font-family:Arial,Helvetica,sans-serif;line-height:normal">
<strong><font color="#0b5394" size="3">Upload</font></strong></h3>
<ul><li><span style="background-color:transparent;line-height:1.25;font-size:10pt">Click here to upload your set of origin points.</span></li>
<li><span style="background-color:transparent;line-height:1.25;font-size:10pt">Click here to upload your set of destination points.</span></li>
<li><span style="background-color:transparent;line-height:1.25;font-size:10pt">Click here to upload your set of affected intersections and their associated delay.</span></li></ul>
<div>
<div></div>
<div></div>
<div></div>
<br>
</div>
</div>

    <!-- <input type="submit" value="showmap" id="showmap1" role="button" style="width: 20;"></td> -->
    <div style="width: 20%; margin-right: 10%; float: left;">
    <input type="submit" value="run" id = "run" role="button" style="width: 180px; height: 40px" onclick="run()">
    <input type="submit" value="save" id = "save" role="button" style="width: 180px; height: 40px" onclick="save()">
    <input type="submit" value="Show Table" id = "load" role="button" style="width: 180px; height: 40px" onclick="showtable()">
    <!-- <input type="submit" value="show" id = "run" role="button" style="width: 180px; height: 40px" onclick="showtable()"> -->

    <div id="table" style="margin-top:20px;"></div>
    </div>

    
    <div id="map-canvas"></div>
    <!-- <input type="submit" value="go" i role="button" style="width: 166px;" onclick="initialize()"> -->
	<!-- <form action="upload.php" method -->
	<?php
		include "readfile.php";
        include "loaddata.php";
	?>

	<script>
    var numofrow = 10;
    // function load() {

    //     $("#table").html(currentfile);
    // }
    
    function save() {
        // console.log(delayList);
        currentfile = JSON.stringify(delayList);
        var json_str = JSON.stringify(delayList);
        $.post('savedata.php', {data: json_str}, function(returnedData){ console.log(returnedData);});
        alert("done!!");
    }


    function showtable() {

        delayList = JSON.parse(currentfile);
        var table = "<table border='1'>";
        table = table + "<tr><td>ORIG</td><td>DEST</td><td>Intersections</td><td>Delay</td><td>Show on map</td></tr>"

        
        for (i = 0; i < delayList.length; i++) {
            table = table + "<tr>"
            table = table + "<td>"
            table = table + delayList[i].origin;
            // table = table + "<br>"
            // table = table + delayList[i].origin_coord;
            table = table + "</td>"
            table = table + "<td>"
            table = table + delayList[i].destination;
            // table = table + "<br>"
            // table = table + delayList[i].destination_coord
            table = table + "</td>"
            var affectinsection = "";
            for (j = 0; j < delayList[i].list.length; j++) {
                affectinsection = affectinsection + " " +delayList[i].list[j].name + "<br>";
            }
            table = table + "<td>"
            table = table + affectinsection;
            table = table + "</td>"

            table = table + "<td>"
            table = table + delayList[i].delay;
            table = table + "</td>"

            

            var button = '<td><input type="submit" value="Show Map" id="showmap'+i+'" role="button" style="width: 20;" onclick="display(this.id)"></td>'
            table = table + button;

            table = table + "</tr>"
        }
        table = table + "</table>"
       $("#table").html(table);


        // var data = "test";
        // for (var i=0; i < num_of_plugins; i++) {
        //    var list_number=i+1;
        //    document.write("<font color=red>Plug-in No." + list_number + "- </font>"+navigator.plugins[i].name+" <br>[Location: " + navigator.plugins[i].filename + "]<p>");
        //    data += "<font color=red>Plug-in No." + list_number + "- </font>"+navigator.plugins[i].name+" <br>[Location: " + navigator.plugins[i].filename + "]<p>"; 
        // }

     

    }

    var currentfile = <?php echo json_encode($currentdata); ?>;
    // console.log(currentfile);
    var allpairs = <?php echo json_encode($allpairs); ?>;
    var all_intersections = <?php echo json_encode($all_intersections); ?>;
  
    // console.log(allpairs)
  
    // var all_intersections1 = [{"id":"1","LAT":"42.256977","LONG":"-83.695747", "delay":"10"},
    //                     {"id":"2","LAT":"42.257692","LONG":"-83.700489", "delay":"15"},
    //                     {"id":"3","LAT":"42.719719","LONG":"-83.948470", "delay":"20"},
    //                     {"id":"4","LAT":"42.703132","LONG":"-83.896328", "delay":"25"},
    //                     {"id":"5","LAT":"42.73408","LONG":"-83.9442", "delay":"30"},
    //                     {"id":"6","LAT":"42.28458768","LONG":"-83.75012571", "delay":"35"}]; // example of all the intersections 
    // console.log(allpairs);
                    
	// var start = '42.73408,-83.9442';
 //    var end = '42.71075,-83.7282';    

    var all_intersection_markers=[];
    var all_origindestination_markers=[];
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map, response, marker;
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: 'us'}
    };
    var delayList = [];
    var Result = [];
    var times = 0;

    directionsDisplay = new google.maps.DirectionsRenderer();
        var mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(42.50, -83.70)
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        


    function initialize() {
        
        for (i = 0; i < all_intersections.length; i++) {
            var content = all_intersections[i].name
            // +Number(all_intersections[i].LAT).toFixed(2)+','+Number(all_intersections[i].LONG).toFixed(2);
        	all_intersection_markers.push(
                new google.maps.Marker({
                  position: new google.maps.LatLng(all_intersections[i].LAT, all_intersections[i].LONG),
                  map:map,
                  
                  icon:{url:'https://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|'+content+'|ffffff|000000' ,
                        anchor:new google.maps.Point(0,42)}
                  }));
        }


        for (i = 0; i < allpairs.length; i++) { 
            // console.log(i);
        	for (j = i; j < allpairs.length; j++) {
                // console.log(j);
        		if (j != i) {

	        		start = allpairs[i].LAT + ',' + allpairs[i].LONG;
		        	end = allpairs[j].LAT + ',' + allpairs[j].LONG;
                    a = allpairs[i]
                    b = allpairs[j];

                    doSetTimeout(a,b);             

		    	}
            }

        }


        directionsDisplay.setMap(map);
    }

    function doSetTimeout(a,b) {
      setTimeout(function() { 
            calcRoute(a, b);  
                    console.log("Run");
                    // if(times == (allpairs.length*allpairs.length)-1) {
                    //     alert("done");
                    // }
                }, times*500);
      times++;
    }


    function calcRoute(start_pt, end_pt) {

        start = start_pt.LAT + ',' + start_pt.LONG;
        end = end_pt.LAT + ',' + end_pt.LONG;

        var waypts = [];
        var L = []
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.WALKING
        };

        directionsService.route(request, function(response, status) {
  
            if (status == google.maps.DirectionsStatus.OK) {

                // directionsDisplay.setDirections(response);
                finding(new google.maps.Polyline({path:response.routes[0].overview_path}), start_pt, end_pt);
            }
        });
        
    }


    function finding(route, a, b) {
        // console.log("ttt");
        // console.log(a.TAZ);
        // console.log(b.TAZ); 
        var intersections = 0;
        var totaldelay = 0;
        var affectedList = [];
        var affectmarkers = [];
        var row = {};
        row.origin = a.TAZ;
        row.destination = b.TAZ;


        row.origin_coord = a.LAT + ',' + a.LONG;
        row.destination_coord = b.LAT + ',' + b.LONG;
        // var row = [];
        var flag = false;
        for (k = 0; k < all_intersections.length; k++) {
                
               if(google.maps.geometry.poly.isLocationOnEdge(all_intersection_markers[k].getPosition(),route,.0001)) { // test if the intersection s on the route     
                    // console.log(total)
                    // all_intersection_markers[i].setMap(map);
                    totaldelay = totaldelay + Number(all_intersections[k].avgDelay);
                    affectedList.push(all_intersections[k]);
                    affectmarkers.push(all_intersection_markers[k]);
                    flag = true;
               }
               else {
                    // all_intersection_markers[i].setMap(null);
               }

        }
        if (!flag) {
            affectedList.push("None");
            row.list = affectedList;
            row.delay = "0";
           
        }
        else{
            row.list = affectedList;
            // row.markers = affectmarkers;
            row.delay = totaldelay;
            delayList.push(row);
        }
        
        Result.push(row);
 
    }

   function display(id){
        all_intersection_markers = [];

        ID = id[id.length-1];
        target = delayList[Number(ID)];
         var mapOptions = {
                zoom: 12,
                center: new google.maps.LatLng(42.50, -83.70)
            }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


        // console.log(target.origin_coord);
        // console.log(target.destination_coord);
        var request = {
            origin: target.origin_coord,
            destination: target.destination_coord,
            travelMode: google.maps.TravelMode.WALKING
        };

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
                alert("TOO MANY QUERIES")
            }
            if (status == google.maps.DirectionsStatus.OK) {
                // console.log("work")
                directionsDisplay.setDirections(response);
                // finding(new google.maps.Polyline({path:response.routes[0].overview_path}), start_pt, end_pt);
            }
            
        });


        for (i =0; i<target.list.length;i++) {
            var content = target.list[i].name
            console.log(content);
            // +Number(all_intersections[i].LAT).toFixed(2)+','+Number(all_intersections[i].LONG).toFixed(2);
            all_intersection_markers.push(
                new google.maps.Marker({
                  position: new google.maps.LatLng(target.list[i].LAT, target.list[i].LONG),
                  map:map,
                  
                  icon:{url:'https://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|'+content+'|ffffff|000000' ,
                        anchor:new google.maps.Point(0,42)}
                  }));
        }


        directionsDisplay.setMap(map);
    }

    function run() {
        $('#save').fadeOut();
        $('#load').fadeOut();
        initialize();
        setTimeout(function(){
            $('#save').fadeIn();
            $('#load').fadeIn();
            alert("done");
        },(times+1)*500);
    }

 // google.maps.endvent.addDomListener(window, 'load', initialize);
</script>


</body>
</html>