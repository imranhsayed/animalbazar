var map = null;
var circle = null;
	var geocoder = new google.maps.Geocoder();
	var check_rand	= 0;
	var max_zoom	=	10;
	var min_zoom	=	11;

(function($) {
    "use strict";
        var markerImage = new google.maps.MarkerImage(imageUrl, new google.maps.Size(50, 77));
        var marker = new google.maps.Marker({
            'icon': markerImage,
            'optimized': false
        });

    function mainMap() {
        var mapZoomAttr = $('#map').attr('data-map-zoom');
        var mapScrollAttr = $('#map').attr('data-map-scroll');
        if (typeof mapZoomAttr !== typeof undefined && mapZoomAttr !== false) {
            var zoomLevel = parseInt(mapZoomAttr);
        } else {
            var zoomLevel = search_map_zoom;
        }
        if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
            var scrollEnabled = parseInt(mapScrollAttr);
        } else {
            var scrollEnabled = false;
        }
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoomLevel,
            scrollwheel: scrollEnabled,
            center: new google.maps.LatLng(search_map_lat, search_map_long),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]}]
        });
        var boxText = document.createElement("div");
        boxText.className = 'grid-style-2'
        var currentInfobox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: true,
            alignBottom: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-60, -55),
            zIndex: null,
            boxStyle: {
                width: "240px"
            },
            closeBoxMargin: "0",
             closeBoxURL: close_url,
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
        };
        var markerCluster, marker, i;
        var allMarkers = [];
        var clusterStyles = [{
            textColor: 'white',
            url: '',
            height: 50,
            width: 50
        }];
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);

        function ZoomControl(controlDiv, map) {
            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "custom-zoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "custom-zoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function() {
                map.setZoom(map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function() {
                map.setZoom(map.getZoom() - 1);
            });
        }
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: locations[i][4],
                id: i
            });
            allMarkers.push(marker);
            var ib = new InfoBox();
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    ib.setOptions(boxOptions);
                    boxText.innerHTML = locations[i][0];
                    ib.open(map, marker);
                    currentInfobox = marker.id;
                    var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.panTo(latLng);
                    map.panBy(0, -180);
                    google.maps.event.addListener(ib, 'domready', function() {
                        $('.infoBox-close').click(function(e) {
                            e.preventDefault();
                            ib.close();
                        });
                    });
                }
            })(marker, i));
        }
        var options = {
            imagePath: 'images/',
            styles: clusterStyles,
            minClusterSize: 2
        };
        markerCluster = new MarkerClusterer(map, allMarkers, options);
        google.maps.event.addDomListener(window, "resize", function() {
			
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
       
		if( show_radius != "" )
		{
			google.maps.event.addListenerOnce(map, 'tilesloaded', radius_search);
		}

        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(pos);
                    map.setZoom(12);
                });
            }
        }
        $('#nextpoint').click(function(e) {
            e.preventDefault();
            map.setZoom(15);
            var index = currentInfobox;
            if (index + 1 < allMarkers.length) {
                google.maps.event.trigger(allMarkers[index + 1], 'click');
            } else {
                google.maps.event.trigger(allMarkers[0], 'click');
            }
        });
        $('#prevpoint').click(function(e) {
            e.preventDefault();
            map.setZoom(15);
            if (typeof(currentInfobox) == "undefined") {
                google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
            } else {
                var index = currentInfobox;
                if (index - 1 < 0) {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                } else {
                    google.maps.event.trigger(allMarkers[index - 1], 'click');
                }
            }
        });
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            map.setOptions({
                draggable: false
            });
        }
			// close infobox when click on map
			google.maps.event.addListener(map, 'click', function() {
				ib.close();
			});
    }
    map = document.getElementById('map');
    if (typeof(map) != 'undefined' && map != null) {
        google.maps.event.addDomListener(window, 'load', mainMap);
        google.maps.event.addDomListener(window, 'resize', mainMap);
		

		//google.maps.event.addListener(map,'resize', updateMapBounds);
    }
	

	
})(this.jQuery);

jQuery(document).ready(function($) {
	$("#reset_state").click(function() {
	 var infowindow = new InfoBox();
      infowindow.close();
	  map.setCenter(new google.maps.LatLng(search_map_lat, search_map_long));
	  map.setZoom(search_map_zoom);
    });
	
	// You current location 
	$("#you_current_location").click(function() {
		$.ajax({
		url: "https://geoip-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {
			//$('#country').html(location.country_name);
			//$('#state').html(location.state);
			//$('#city').html(location.city);
			//$('#latitude').html(location.latitude);
			//$('#longitude').html(location.longitude);
			//$('#ip').html(location.IPv4);
			var pos = new google.maps.LatLng(location.latitude, location.longitude);
			map.setCenter(pos);
			map.setZoom(search_map_zoom);
			}
	});		
	});		
	$("#you_current_location_text").click(function() {
		$.ajax({
		url: "https://geoip-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {
			$('#sb_user_address').val(location.city + ", " + location.country_name );
		}
	});		
	});

});
	
function radius_search()
{
        var address = document.getElementById('sb_user_address').value;
		var km = document.getElementById('map_radius').value;
        var radius = parseInt(km, 10)*1000;
       // var radius = parseInt(25, 10)*1000;
	   if( address != "" && km != "" )
	   {
		   jQuery('#sb_loading').show();
			geocoder.geocode( { 'address': address}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				circle_zoom = 10;
				if( km <= 6 )
					circle_zoom = 12;
				else if( km > 6 &&  km <= 12 )
					circle_zoom = 11;
				else if( km > 30 )
					circle_zoom = 9;
					
				
				
				map.setZoom(circle_zoom);

			
/*				if( km <= 10 && km > 6 )
				{
					max_zoom = 11;
					min_zoom = 13;
				}
				else if( km <= 6 )
				{
					max_zoom = 12;
					min_zoom = 13;
					
				}
			
				var random_num	=	Math.floor(Math.random() * (max_zoom - min_zoom)) + min_zoom;
				if(check_rand != random_num  )
				{
					check_rand = random_num;
					map.setZoom(random_num);
				}
				else
				{
					var new_rad = random_num + 1;
					if( new_rad >= max_zoom )
					{
						map.setZoom(random_num - 1);
						check_rand = random_num - 1;	
					}
					else
					{
						map.setZoom(random_num + 1);
						check_rand = random_num + 1;
					}
				}*/

				var searchCenter = results[0].geometry.location;
				/*
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
				*/
				if (circle) circle.setMap(null);
				circle = new google.maps.Circle({center:searchCenter,
												 radius: radius,
												 strokeColor: "#f58936",
												 strokeOpacity: 0.8,
												 fillOpacity: 0.25,
												 fillColor: "#696969",
												 map: map});
	
				// makeSidebar();
				// google.maps.event.addListenerOnce(map, 'bounds_changed', makeSidebar);
				jQuery('#sb_loading').hide();
	
			  } else {
				alert('Geocode was not successful for the following reason: ' + status);
			  }
			});
	   }	
}

function updateMapBounds(){
    clearTimeout(mapBoundsTimer);
    mapBoundsTimer = setTimeout(function() {
      updateBounds();
   }, 500);
 }
function updateBounds(){
   //code to get map_div or gm_style class size and compare it to the
   if($('.gm_style').height()===window.innnerHeight &&
      $('.gm_style').width() === window.innerWidth){
      //fit_markers
   }
}