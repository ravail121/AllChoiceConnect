/************************************************************************************
 *
 * pccApp Module
 *
 ************************************************************************************/
 
angular.module('pccApp', ['ngCookies', 'ui.map', 'ui.keypress', 'pccConfig', 'pccDirective', 'pccService'])
.value('version', '5.3')


.filter('unsafe', function($sce)
{
    return function(val)
    {
        return $sce.trustAsHtml(val);
    };
})




/************************************************************************************
 *
 * appController
 *
 ************************************************************************************/
 
.controller('appController', ['$rootScope', '$scope', 'pccSettings', 'pccHistoryService',
			function($rootScope, $scope, pccSettings)
{
	$scope.labels					= pccSettings.labels;
	$scope.hasHeader				= pccSettings.flags["hasHeader"];
	$scope.hasLegend				= pccSettings.flags["hasLegend"];
	$scope.hasMultiSearch			= pccSettings.flags["hasMultiSearch"];
 	$scope.hasDeviceSelection		= pccSettings.flags["hasDeviceSelection"];
	$scope.hasCloseButton			= pccSettings.flags["hasCloseButton"];
	
	$scope.coverageMode				= "has700";
	$scope.zoom						= 0;
	$scope.showCompareButton		= false;
	$scope.showModeButton			= false;
	$scope.is700DeviceSelected		= true;	
	$scope.legendState				= pccSettings.flags["legendInitOpen"];
	
	var pccHeader = document.getElementById("pccHeader");
	pccHeader.style.display = "";
	
	// listen for incoming messages
	if (window.addEventListener)
	{
		// for standards-compliant web browsers
		window.addEventListener("message", handleInboundMessage, false);
	}
	else
	{
		// all others
		window.attachEvent("onmessage", handleInboundMessage)
	}
	
	
	function handleInboundMessage(evt)
	{
		// TODO check for event origin in expected domain
		
		try
		{
			var message = JSON.parse(evt.data);
			
			if (message["event"] === "drawStoreMarkers")
			{
				$rootScope.$emit("handleDrawStoreMarkers", message["data"]);
			}
			else if (message["event"] === "drawStoreRoute")
			{
				$rootScope.$emit("handleDrawStoreRoute", message["data"]);
			}
			else if (message["event"] === "selectStoreMarker")
			{
				$rootScope.$emit("handleSelectStoreMarker", message["data"]);
			}
		}
		catch (err)
		{
			// ignore malformed JSON
			console.log("*** Received malformed JSON: " + evt.data);
		}
	}


	$scope.appContainerClicked = function()
	{
		$rootScope.$emit("handleAppContainerClicked");
	}
	
	
	$rootScope.$on("handleGeocodeError", function(scope, data)
	{
		console.log("*** geocodeError *** " + data);
	});
	

	$rootScope.$on("handleCoverageError", function(scope, data)
	{
		console.log("*** coverageError *** " + data);
	});
	

	$rootScope.$on("handleSetCoverageMode", function(scope, coverageMode, is700DeviceSelected)
	{
		$scope.coverageMode			= coverageMode;
		$scope.is700DeviceSelected	= (is700DeviceSelected === true);
		updateFlags();
	});


	// Call any time the zoom level is changed to display the appropriate legend as defined by the tileset
	$rootScope.$on("handleZoomChange", function(scope, zoom)
	{
		$scope.zoom					= zoom;
		updateFlags();
	});
	
	
	// Called from multiple locations to record a user interaction
	$rootScope.$on("handleRecordEvent", function(scope, event, data)
	{
		var message					= JSON.stringify({"event":event,"data":data});
		
		//console.log("posting message: " + message);
		
		window.parent.postMessage(message, "*");
	});


	function updateFlags()
	{
		
		var hasDeviceSelection		= $scope.hasDeviceSelection;
		var hasToggleMap			= pccSettings.flags["hasToggleMap"];
		
		var is700Mode				= $scope.coverageMode === "has700";
		var isMobileSizeMode		= $rootScope.mobileSizeMode;
		var is700DeviceSelected		= $scope.is700DeviceSelected;
		var zoom					= $scope.zoom;
		var legendState				= $scope.legendState;

		$scope.showCompareButton	= hasDeviceSelection && !is700Mode && !isMobileSizeMode && zoom >= 13;
		$scope.showModeButton		= hasToggleMap || (isMobileSizeMode && zoom >= 13 && !is700DeviceSelected);
		$scope.showModeButtonInLegend		= hasToggleMap || (isMobileSizeMode && zoom >= 13 && !is700DeviceSelected && legendState);
	}
	
	$rootScope.$on("handleLegendToggle", function(scope, legendDrawer)
	{
		$scope.legendState		= legendDrawer;
		updateFlags();
	});
	
	$scope.closeMap = function()
	{
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "closeMapClicked", null);
	}
}])




/************************************************************************************
 *
 * busyController
 *
 ************************************************************************************/
 
.controller('busyController', ['$rootScope', '$scope', function($rootScope, $scope)
{
	$scope.spinCounter = 0;
	

	$rootScope.$on("handleStartSpinner", function()
	{
		$scope.spinCounter++;
	});
	

	$rootScope.$on("handleStopSpinner", function()
	{
		$scope.spinCounter--;
	});
}])




/************************************************************************************
 *
 * headerController
 *
 ************************************************************************************/
 
.controller('headerController', ['$rootScope', '$scope', '$sce', 'pccSettings', function($rootScope, $scope, $sce, pccSettings)
{
	$scope.template				= pccSettings.fragments["header"];
	
	$scope.hasCloseButton	= pccSettings.flags["hasCloseButton"];
	$scope.deviceListURL	= pccSettings.ExternalURLs;
	$scope.tmobileURL		= pccSettings.fragments["tmobileURL"];
	
	$scope.device			= "";
	
// 	$scope.selectedDevice	= "700Device";	
	
	
// 	$rootScope.$on("handleSeeCoverageForDevice", function(scope, device)
// 	{
// 		$scope.selectedDevice = device;			
// 	});	
// 	
// 	$rootScope.$on("handleSeeCoverageFor700Band12Device", function()
// 	{
// 		$scope.selectedDevice = "700Device";
// 	});
	
	
	$rootScope.$on("handleSetDevice", function(scope, device)
	{
		$scope.device = device;
	});
	
	//Called when "View here" link on header clicked for Devicelist
	$scope.showDeviceList = function()
	{
		$rootScope.$emit("handleShowDeviceList", "LTE-700Band12");
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "showDeviceListClicked", {"link":"header", "deviceList":"LTE-700Band12"});
	}
	
	
	$scope.closeMap = function()
	{
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "closeMapClicked", null);
	}
}])




/************************************************************************************
 *
 * legendController
 *
 ************************************************************************************/
 
.controller('legendController', ['$rootScope', '$scope', '$sce', 'pccSettings', function($rootScope, $scope, $sce, pccSettings)
{
	$scope.template				= pccSettings.fragments["legend"];
	
	// initial state is to show verified layer if we have one
	$scope.showVerified			= false;
	$scope.showOverlay			= pccSettings.flags["hasVerified"] && pccSettings.overlays;
	
	// initial state is to show legend
	$scope.showDrawer			= pccSettings.flags["legendInitOpen"];
	
	//initial/default value for the difference between 700map and non-700map
	$scope.coverageDifference	= 2; //defaulting it to 2 for the styling for toggle link
	
	//initial/default zoom value 
	$scope.zoomLevel			= 4;
	
	$scope.hasTechnologyDetails			= pccSettings.flags["hasTechnologyDetails"];;
	
	// Call from UI to expand/collapse legend
	$scope.toggleDrawer = function()
	{
		$scope.showDrawer = !$scope.showDrawer;
		$rootScope.$emit("handleHideDrawer","legendController");
		
		$scope.showVerified			= pccSettings.flags["hasVerified"] && pccSettings.overlays && $scope.zoomLevel >= 13;
		
		if (!$rootScope.mobileSizeMode) //ShowVerified checkbox as part of legend in desktop
		{
			$scope.showVerified			= $scope.showVerified && $scope.showDrawer;
		}		
		$rootScope.$emit("handleLegendToggle", $scope.showDrawer);
	};
	
	
	// Call from UI to show/hide verified coverage layer
	$scope.toggleVerified = function()
	{
		$scope.showOverlay = !$scope.showOverlay;	
		$rootScope.$emit("handleToggleLayer", "verified", $scope.showOverlay);
	};


	// Opens compareMap popup, maps centre position is passed to side-by-side maps
	$scope.openCompareMapPopup = function(coverageDiffValue)
	{
		$rootScope.$emit("showCompareMap", coverageDiffValue);
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "showCompareMapClicked", {"link":"legend", "value":coverageDiffValue.toString()});
	};
	
	
	$scope.toggleCoverageMode = function(coverageDiffValue)
	{
		$rootScope.$emit("handleSetCoverageMode", $scope.coverageMode === "has700" ? "has600" : "has700", null);
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "toggleCoverageModeClicked", {"link":"legend", "value":coverageDiffValue.toString(), "toggleToMode": $scope.coverageMode});
	};
	
	
	// Called when map element has been loaded; handle init tasks
	$rootScope.$on("handleMapLoaded", function()
	{
		// set initial display of verified layer
		$rootScope.$emit("handleToggleLayer", "verified", $scope.showOverlay);			
	});


	// Call any time the zoom level is changed to display the appropriate legend as defined by the tileset
	$rootScope.$on("handleZoomChange", function(scope, zoom)
	{
		$scope.zoomLevel = zoom;
		// cycle through the maps's legends
		for (var i = 0, len = pccSettings.legends.length; i < len; i++)
		{
			// find the first legend with minZoom at or below current zoom level
			if (zoom >= pccSettings.legends[i].minZoom)
			{
				$scope.legendType	= pccSettings.legends[i].id;
				$scope.legend		= pccSettings.legends[i].legend;
				
				break;
			}
		}
		
		$scope.showVerified			= pccSettings.flags["hasVerified"] && pccSettings.overlays && zoom >= 13;

		if (!$rootScope.mobileSizeMode) //ShowVerified checkbox as part of legend in desktop
		{
			$scope.showVerified			= $scope.showVerified && $scope.showDrawer;
		}
	});
	
	
	$rootScope.$on("handleHideDrawer", function(scope, value)
	{
		if ($rootScope.mobileSizeMode && value != "legendController")
		{
			$scope.showDrawer = false;
			$rootScope.$emit("handleLegendToggle", $scope.showDrawer);
		}
	});
	
	// Called when coverage has been retrieved for a center position of map. 
	//Update the "compareMap link" with different style based on the difference between 700Map and non-700map difference level
	$rootScope.$on("handleCoverageResult", function(scope, marker, coverageArray, speedtest)
	{	
		if (!(marker instanceof google.maps.Marker) && coverageArray && coverageArray.has700)
		{
			//$scope.coverageDifference	= coverageArray.has700.coverageDiffValue;
			$scope.coverageDifference	= 2; //defaulting it to 2 for the styling for toggle link
		}	
		
	});
		
}])




/************************************************************************************
 *
 * searchController
 *
 ************************************************************************************/
 
.controller('searchController', ['$rootScope', '$scope', '$sce', 'pccSettings', 'pccGeocodeService', 'pccHistoryService',
			function($rootScope, $scope, $sce, pccSettings, pccGeocodeService, pccHistoryService)
{
	$scope.template			= pccSettings.fragments["search"];
	$scope.search			= {};
	$scope.searchInputError = false;
	$scope.searchInputErrorMessage = null;
	$scope.history  		= pccHistoryService.history;
	$scope.toggleKeyboard 	= "";
		
	$scope.searchText = function(searchTerm)
	{
		$scope.unfocus();
		
		// use the google geocoder to get latLng coordinates for this search term
		pccGeocodeService.geocode(searchTerm);	
	}
	
	$scope.searchPlace = function(place)
	{ 
		$scope.unfocus();
		
		// use the google geocoder to get latLng coordinates for this places result
		place.formatted_address = $scope.search.term;
		pccGeocodeService.geocodePlace(place);
	}
	
	$scope.clearSearchTerm = function()
	{ 
		$scope.search.term = "";
		document.getElementById("pccSearchBox").focus();
	}


	$scope.selectHistory = function(marker)
	{
		$scope.searchInputError = false;
		$rootScope.$emit("handleSelectHistory", marker);
	};


	$scope.home = function()
	{
		$scope.unfocus();
		$rootScope.$emit("handleHideDrawer","searchController");

		pccGeocodeService.geocodeDefaultLocation();
	}
	
	
	// Call when the search box is entered to select all the contents
	$scope.focus = function()
	{
		setTimeout(function()
		{
			// TODO pass in the searchbox rather than walking the DOM
			var searchBox = document.getElementById("pccSearchBox");
			if (typeof searchBox.setSelectionRange === "function")
			{
				searchBox.setSelectionRange(0, searchBox.value.length);
			}
			else
			{
				searchBox.select();
			}
		});
		
		$rootScope.$emit("handleHideDrawer","searchController");
	}
 
 
	// Call when the search box is exited
	$scope.unfocus = function()
	{
		// TODO pass in the searchbox rather than walking the DOM
		document.getElementById("pccSearchBox").blur();
	}
	
	
	$scope.toggleDrawer = function()
	{
		$scope.showDrawer = !$scope.showDrawer;	
		if($scope.showDrawer)
		{
			$scope.focus();
		}
	};
		
		
	$rootScope.$on("handleHideDrawer", function(scope, value)
	{
		if(value != "searchController"){
			
			$scope.toggleKeyboard = Date();
			
			if($rootScope.mobileSizeMode){
				$scope.showDrawer = false;
			}			
		}
	});
	
	
	// Called when an address has been found for a search term
	$rootScope.$on("handleGeocodeResult", function(scope, location)
	{
		$scope.searchInputError = false;
		setTimeout(function(){$scope.search.term = location.address;});
	});
	
	
	$rootScope.$on("handleGeocodeError", function(scope, status, searchTerm)
	{
		if(status == "OUTOFBOUND"){
			$scope.searchInputErrorMessage = pccSettings.labels["title-searchOutOfBoundError"];
		} else {
			$scope.searchInputErrorMessage = pccSettings.labels["title-searchError"];
		}
	
		$scope.searchInputError = true;	
		$scope.$apply();
	});


	// Called when an address has been found for a clicked latLng
	$rootScope.$on("handleReverseGeocodeResult", function(scope, clickLoc, location, zoom)
	{
		$scope.search.term		= location.address;
        $scope.searchInputError	= false;
	});
}])




/************************************************************************************
 *
 * multiSearchController
 *
 ************************************************************************************/
 
.controller('multiSearchController', ['$rootScope', '$scope', '$sce', 'pccSettings', 'pccGeocodeService', 'pccHistoryService',
			function($rootScope, $scope, $sce, pccSettings, pccGeocodeService, pccHistoryService)
{
	$scope.template		= pccSettings.fragments["multisearch"];
	$scope.routeFlag	= false;
 	$scope.searchCount	= 1;
 	$scope.searchCount	= 1;
	$scope.searchPlaces	= [];
	$scope.currentInput	= 0;
	$scope.showDrawer	= false;	
	$scope.searchError = false;
	$scope.myPlacesButtonDisabled = true;
	var searches = [];
	$scope.history 		= pccHistoryService.history;
	
	function initSearchMap()
	{
		$scope.searchMap = [	{ text: "", place: null, error: "" },
								{ text: "", place: null, error: "" }
							];
	}
	
	initSearchMap();
	
	$scope.mapSearchPlaces = function()
	{		
		for(i = 0; i < $scope.searchMap.length; i++ ){
			if($scope.searchMap[i].text == ""){
				$scope.searchMap[i].error = "Invalid input";
				$scope.searchError = true;
			} else{
				$scope.searchMap[i].error = "";
			}
		}
		
		for(i = 0; i < $scope.searchMap.length; i++ ){
			if($scope.searchMap[i].error  != ""){
				return;			
			}
		}		
		
		searches = [];
		for(i = 0; i < $scope.searchMap.length; i++ ){
		
			if( angular.isUndefined($scope.searchMap[i].place) || $scope.searchMap[i].place == null){
				searches[i] = $scope.searchMap[i].text;	
			} else {
				searches[i] = $scope.searchMap[i].place;	
			}
		}
		console.log(" --- multi searches --- : ");
		console.log(searches);	
		
		$rootScope.$emit("handleMyPlacesSearchTrigger", $scope.routeFlag);
		
		$scope.myPlacesButtonDisabled = true;
		$scope.searchError = false;
		pccGeocodeService.geocodeMulti(searches);
		
	}
	
	$scope.clearSearches = function()	{
		initSearchMap();
		setHeight();
	}
	
	$scope.addSearchPlace = function()	{
		if($scope.searchMap.length < 5 ){
			$scope.searchMap.push({ text: "", place: null, error: "" });
		}		
		setHeight();
	}
	
	$scope.removeSearchPlace = function(index)	{	
		
		if($scope.searchMap.length <= 5 ){
			$scope.searchMap.splice(index, 1);
		}		
		setHeight();
	}	
	
	$scope.updateIndex = function(index)	{	
		$scope.currentInput		= index;
		$scope.searchMap[$scope.currentInput].place = null;
		
		if( $scope.searchMap[$scope.currentInput].text != "" && $scope.searchMap[$scope.currentInput].text != searches[$scope.currentInput] ){			
			$scope.searchMap[$scope.currentInput].error = "";			
		}
		
		var error = false;
		for(i = 0; i < $scope.searchMap.length; i++ ){		
			if( $scope.searchMap[i].error != ""){
				error = true;
			}
		}
		$scope.searchError = error;
		
		for(i = 0; i < $scope.searchMap.length; i++ ){		
			if( $scope.searchMap[i].text == ""){			
				$scope.myPlacesButtonDisabled = true;
				return;
			}
		}
		if(!$scope.searchError){
			$scope.myPlacesButtonDisabled = false;
		}
	}
		
	$scope.searchText = function(searchTerm)	{
		$scope.searchMap[$scope.currentInput].text = searchTerm;
	}
	
	$scope.searchPlace = function(place)	{
		$scope.searchMap[$scope.currentInput].place = place;
	}
	
	$scope.selectHistory = function(marker)	{
		$scope.searchMap[$scope.currentInput].text = marker.location.address;
	}
	
	$scope.toggleRoute = function()	{
		$scope.routeFlag = !$scope.routeFlag;
		$rootScope.routeFlag = $scope.routeFlag;
	}
	
	$rootScope.$on("handleMultipleGeocodeResult", function(scope, locations)
	{		
		$scope.myPlacesButtonDisabled = false;
	});
	
	$rootScope.$on("handleGeocodeMultiError", function(scope, locations)
	{
		for(i=0; i<locations.length; i++)
		{
			if(locations[i] == "" || locations[i] == null){
				$scope.searchMap[i].error = "Invalid input";
				$scope.searchError = true;
			} else{
				$scope.searchMap[i].error = "";
			}
		}	  		
		$scope.$apply();
	});

	var watcher = true;
	$scope.toggleDrawer = function()
	{
		$scope.showDrawer = !$scope.showDrawer;
		
		if(watcher){		
			watcher = false;
			$scope.$watch( function(){ return window.innerHeight || document.documentElement.clientHeight; },
				function(val) { 
					//console.log("window height changed"); 
					setMyPlacesHeight(); 
				} 
			);
		}
		
		if($scope.showDrawer){
			setHeight();
		}
		
		$rootScope.$emit("handleHideDrawer","multiSearchController");
	};
	
	$rootScope.$on("handleHideDrawer", function(scope, value)
	{ 
		if(value != "multiSearchController")
		{
			$scope.showDrawer = false;
		}
	});
	
	function setHeight(){
		setTimeout(function(){			
			setMyPlacesHeight();
		}, 0);
	}
	function setMyPlacesHeight(){
		var element = document.getElementById("multilocationOverlay");
		var headerHeight = document.getElementById("pccHeader").offsetHeight + document.getElementById("pccTmoHeader").offsetHeight;
		var windowHeight =  window.innerHeight || document.documentElement.clientHeight ; 
		var vheight = windowHeight - headerHeight; 
		
		//console.log("window: " + windowHeight + ", element.scrollHeight: " + element.scrollHeight + ", offsetHeight: " + element.offsetHeight  + " , headerHeight: " + headerHeight + ", vheight : " + vheight);
		if( element.scrollHeight >= vheight){

			if(element.offsetHeight != vheight){
				//console.log(".......... chainging height....... ");
				element.style.overflow = "auto";
				element.style.height = vheight + "px";
			}
		} else {
			//console.log(".......... chainging height.......  ELSE");
			element.style.overflow = "";
			element.style.height = '';
		}
	}
}])



/************************************************************************************
 *
 * mapController
 *
 ************************************************************************************/

.controller('mapController', ['$rootScope', '$scope', '$sce', 'pccSettings', 'pccMapService', 'pccGeocodeService', 'pccRouteService', 'pccCoverageService', 'pccHistoryService',
							  function($rootScope, $scope, $sce, pccSettings, pccMapService, pccGeocodeService, pccRouteService, pccCoverageService, pccHistoryService)
{
	$scope.template			= pccSettings.fragments["coverage"];
	
	$scope.poiMarkers		= [];
	$scope.routeMarkers		= [];
	$scope.storeMarkers		= [];
	$scope.userMarkers		= [];
	$scope.currentMarker	= null;
	$scope.deviceListURL	= pccSettings.ExternalURLs;
	$scope.hasShopDevices	= pccSettings.flags["hasShopDevices"];
	
	$scope.mapOptions		=
	{
		disableDefaultUI:	true,
		center:				pccMapService.mapCenter,
		maxZoom:			pccSettings.maxZoom,
		minZoom:			pccSettings.minZoom,
		zoom:				pccSettings.minZoom,
		zoomControl:		true,
		zoomControlOptions:	{position: google.maps.ControlPosition.RIGHT_BOTTOM, style: google.maps.ZoomControlStyle.LARGE},
		styles:				pccSettings.mapStyles["bottom"],
        scaleControl:       true,
		clickableIcons:		false,
	};
	
	var routeOptions 		=
	{
		draggable:			true,
		hideRouteList:		true,
		preserveViewport:	true,
		suppressInfoWindows:true,
		suppressMarkers:	true,
		polylineOptions:	pccSettings.defaults["routeStrokeColor"] ? {strokeColor: pccSettings.defaults["routeStrokeColor"]} : null
	}	
	var routeRenderer		= new google.maps.DirectionsRenderer(routeOptions);


	/********************************************************************************
	 * Map Creation
	 ********************************************************************************/
	
	// Called once after the "map" div has been loaded in the DOM
	$scope.$watch("map", function()
	{
		pccMapService.buildMapLayers($scope.map, pccSettings.coverage);
				
		// offset the popup info window so the caret will point to the marker
		$scope.mapInfoWindow.setOptions({"pixelOffset":new google.maps.Size(13, -75),
										 "closeBoxURL":"",
										 "infoBoxClearance":new google.maps.Size(10, 10)});
	
		// set the initial tile set to display
		if (pccSettings.defaults["coverageMode"])
		{
			$rootScope.$emit("handleSetCoverageMode", pccSettings.defaults["coverageMode"], true);
		}
		
		// let other controllers talk back to the map
		$rootScope.$emit("handleMapLoaded");
		$rootScope.$emit("handleRecordEvent", "mapLoaded", null);

		if (pccSettings.defaults["viewport"])
		{
			var latlngArray	= pccSettings.defaults["viewport"];
			var viewport	= new google.maps.LatLngBounds(latlngArray[0], latlngArray[1]);
			$scope.map.fitBounds(viewport);
		}
		else
		{
			// initiate search for default location
			pccGeocodeService.geocodeDefaultLocation();
		}
	});
	
	
	/********************************************************************************
	 * Google Map Events - Map Movement
	 ********************************************************************************/
	
	$scope.mapBoundsChanged = function()
	{
		if (!$scope.isDragging)
		{
			enforceBounds();
		}
	}


	$scope.mapDrag = function()
	{
		// enforce the map bounds continually while dragging
		enforceBounds();
	}
	
	
	$scope.mapDragStart = function()
	{
		// hide all extraneous pop-ups when dragging the map
		hideDrawers();
		
		$scope.isDragging = true;		
	}
	
	
	$scope.mapDragEnd = function()
	{
		// enforce the map bounds after dragging to clean-up any remaining changes
		enforceBounds();
		
		$scope.isDragging = false;
	}
	


	/********************************************************************************
	 * Google Map Event - Click Handlers
	 ********************************************************************************/
	
	$scope.mapClicked = function($event, $params)
	{
		if (pccSettings.flags.isClickable)
		{
			// hide all extraneous pop-ups when clicking on the map
			hideDrawers();

			// show a google marker at the clicked point
			var position 	= $params[0].latLng;
			var	extendRoute	= window && window.event && window.event.shiftKey;
			var icon		= getMarkerIcon("address", 0, false);
			var marker		= createMarker(position, icon, null);
		
			addUserMarkerToMap(marker);
			selectMarker(marker, true);
		
			// request location information for this clicked point
			// NB: don't request the coverage yet since we don't know the country
			pccGeocodeService.reverseGeocode(position, marker);
		}
	}


	$scope.mapDoubleClicked = function($event, $params)
	{
		if (pccSettings.flags.isClickable)
		{
			// NOTE: never get here since a marker is added when a single click has occurred
			console.log("Map Double-Clicked at: " + $params[0].latLng.toString());
		}	
	}


	$scope.markerClicked = function(marker, hilite)
	{
		// hide all extraneous pop-ups when clicking on a marker
		hideDrawers();
		
		selectMarker(marker, hilite);
		showMarkerInfo(marker);
		
		// update the ribbon if a poi marker was clicked
		if (marker.poi)
		{
			$rootScope.$emit("handlePOIMarkerClicked", marker);
		}
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "markerClicked", {"position":marker.position,"location":marker.location,"coverage":marker.coverage,"index":$scope.storeMarkers.indexOf(marker)});
	}
	
	
	$scope.markerDoubleClicked = function(marker)
	{
		// re-center on the marker and zoom in
		$scope.map.setCenter(marker.getPosition());
		$scope.map.setZoom($scope.map.getZoom() + 1);
	}

	
	$scope.infoWindowCloseClicked = function(event)
	{
		hideMarkerInfo();
		
		// prevent the click from being passed through to the map
		event.cancelBubble = true;
		if (event.stopPropagation)
		{
			event.stopPropagation();
		}
	}
	
	//Called when "View here" link on coverage popup clicked for Devicelist
	$scope.showDeviceList = function(type)
	{	
		$rootScope.$emit("handleShowDeviceList", type);	 	

		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "showDeviceListClicked", {"link":"pin", "deviceList":type});		
	}

	/********************************************************************************
	 * Marker Management
	 ********************************************************************************/

	function getMarkerIcon(type, index, selected)
	{
		function validatedArrayItem(array, index)
		{
			return (array && array.length > index) ? array[index] : null;
		}
		
		if (type === "address")
		{
			return { scaledSize:	new google.maps.Size(25,33),
					 url:			validatedArrayItem(pccSettings.brand["addressMarkers"], index),
					 type:			type,
					 index:			index};
		}
		else if (type === "area")
		{
			return { anchor:		new google.maps.Point(18,18),
					 scaledSize:	new google.maps.Size(37,37),
					 url:			validatedArrayItem(pccSettings.brand["areaMarkers"], index),
					 type:			type,
					 index:			index};
		}
		else if (type === "store")
		{
			return { url:			validatedArrayItem(pccSettings.brand[selected ? "storeMarkersSelected" : "storeMarkers"], index),
					 type:			type,
					 index:			index};
		}
		else if (type === "poi")
		{
			return null;
		}		
	}
	
	
	function createMarker(position, icon, location)
	{
		var marker = new google.maps.Marker(
		{
			map:			null,
			position:		position,
			icon:			icon,
			visible:		true,
			location:		location
		});
		
		return marker;
	}
	
	
	function selectMarker(marker, hilite)
	{
		if ($scope.currentMarker !== marker)
		{
			deselectMarker($scope.currentMarker);
		}

		marker.setIcon(getMarkerIcon(marker.icon.type, marker.icon.index, hilite));		
		
		$scope.currentMarker = marker;
	}
	
	
	function deselectMarker(marker)
	{
		if ($scope.currentMarker === marker)
		{
			hideMarkerInfo();
		}
		
		if (marker)
		{
			marker.setIcon(getMarkerIcon(marker.icon.type, marker.icon.index, false));		
		}
	}


	function deleteMarkers(arrayOfMarkers)
	{
		for (var i = 0, len = arrayOfMarkers.length; i < len; i++)
		{
			var marker = arrayOfMarkers[i];
			
			if (marker)
			{
				marker.setMap(null);
			}		
		}
		
		arrayOfMarkers.length = 0;
	}
	
	
	function clearAllMarkers()
	{
		// remove the route and route markers
		routeRenderer.setMap(null);		
		deleteMarkers($scope.routeMarkers)
		
		// remove any store markers
		deleteMarkers($scope.storeMarkers);
		
		// also remove any single marker(s)
		deleteMarkers($scope.userMarkers);		
	}
	
	
	function addUserMarkerToMap(marker)
	{
		deleteMarkers($scope.userMarkers);
		if (marker)
		{
			marker.setMap($scope.map);
			$scope.userMarkers.push(marker);
		}
	}
	
	
	function addRouteMarkersToMap(arrayOfMarkers, showRoute)
	{
		// copy the new markers into the existing array
		for (var i = 0, len = arrayOfMarkers.length; i < len; i++)
		{
			var marker = arrayOfMarkers[i];
			if (marker)
			{
				marker.setMap($scope.map);
				$scope.routeMarkers.push(marker);
			}
		}
		
		// request the route if we have enough points
		if (showRoute && $scope.routeMarkers.length >= 2)
		{
			pccRouteService.getRoute($scope.routeMarkers);
		}
	}
	
	
	function addStoreMarkersToMap(arrayOfMarkers)
	{
		// copy the new markers into the existing array
		deleteMarkers($scope.storeMarkers);		
		for (var i = 0, len = arrayOfMarkers.length; i < len; i++)
		{
			var marker = arrayOfMarkers[i];
			if (marker)
			{
				marker.setMap($scope.map);
				$scope.storeMarkers.push(marker);
			}
		}
	}
	
	
	function focusMarker(marker, newZoomLevel)
	{
		if (marker.location && marker.location.bounds)
		{
			// area marker, auto-zoom to fit the entire area in the viewport
			$scope.map.fitBounds(marker.location.bounds);
		}
		else
		{
			// specific location marker, ensure the marker is within the viewport
			$scope.map.panTo(marker.position);
			
			// change the zoom level if necessary
			if (newZoomLevel && newZoomLevel != $scope.map.getZoom())
			{
				$scope.map.setZoom(newZoomLevel);
			}
		}
	}
	

	// pan and zoom to show the bounds containing each marker in the array
	function focusMarkers(arrayOfMarkers)
	{
		var bounds = new google.maps.LatLngBounds();
		
		for (var i = 0, len = arrayOfMarkers.length; i < len; i++)
		{
			if (arrayOfMarkers[i] != null)
			{
				bounds.extend(arrayOfMarkers[i].position);
			}
		}
		
		$scope.map.fitBounds(bounds);
	}
	
	
	/********************************************************************************
	 * Marker Info Management
	 ********************************************************************************/

	function showMarkerInfo(marker)
	{
// 		ensure the marker with the info window is the "current" marker
// 		selectMarker(marker, hilite);
// 		
		// set the correct coverage to display
		marker.coverage	= pccCoverageService.getCoverageForMode(marker.coverageArray, $scope.coverageMode);
		
		if (marker.coverage)
		{
			marker.coverage.requiresCapableDevice = (marker.coverage['hasNewBands'] || marker.coverage['type'] == 'type-roam850');								
		}
		
		if (pccSettings.flags.hasDebug && marker.coverageArray)
		{
			marker.coverage.debug = marker.coverageArray.raw;
		}
		
		// display a marker info window if poi or coverage has been retrieved
		var hasPopup	= pccSettings.fragments["coverage"] != "";
		var isArea		= marker.location && marker.location.bounds;
		var isCoverage	= (marker.coverage != null && marker.coverage.type != "type-none");
		var	isPOI		= marker.poi != null;		
		
		if (hasPopup && $scope.mapInfoWindow && (isArea || isCoverage || isPOI))
		{
			var offset = new google.maps.Size(13, isArea ? -53 : -75);
			$scope.mapInfoWindow.setOptions({"pixelOffset":offset});			
			$scope.mapInfoWindow.open($scope.map, marker);
		}
		
		//$rootScope.$emit("handleShowMarkerInfo", marker);
	}


	function hideMarkerInfo()
	{
		if ($scope.mapInfoWindow)
		{
			$scope.mapInfoWindow.close();
		}
	}
	
	
	// called from the UI to determine the type of coverage dialog to display (via ng-switch)
	$scope.markerInfoType = function(marker)
	{
		if (marker && marker.poi)
		{
			return "poi";
		}
		
		if (marker && marker.location && marker.location.bounds)
		{
			return "area";
		}
		
		if (marker && marker.coverage && marker.coverage.type === "type-none")
		{
			return "none";
		}

		if (marker && marker.coverage && marker.coverage.type.substr(0,9) === "type-roam")
		{
			return "roam";
		}

		if (marker && marker.coverage)
		{
			return "coverage";
		}
		
		if (marker && $scope.storeMarkers.indexOf(marker) != -1)
		{
			return "store";
		}
		
		return null;
	}



	/********************************************************************************
	 * Google Map Event - Idle Handlers
	 ********************************************************************************/

	$scope.mapIdle = function()
	{
		// don't allow the map to be dragged when it fits entirely within the viewport
		$scope.map.setOptions({draggable: !pccMapService.fitsInView($scope.map.getBounds())});

		// request POIs once the map has settled down
// 		if (pccSettings.flags.hasPOIs && $scope.map.getZoom() > 11)
// 		{
// 			var center	= $scope.map.getCenter();
// 			var bounds	= $scope.map.getBounds();
// 		
// // 			pccPOIService.getPOIs(center, bounds);
// 		}

//		var hasDeviceSelection		= $scope.hasDeviceSelection;
//		var hasToggleMap			= pccSettings.flags["hasToggleMap"];
		
		//Get coverage difference for the maps center position
//		if(($scope.map.getZoom() >= 13 && hasDeviceSelection) || hasToggleMap)
//		{
//			var center	= $scope.map.getCenter();
//			var fakeMarker	= {"position" : center};
//			pccCoverageService.getCoverage(fakeMarker);
			
			//pccCoverageService.getCoverageDifference(center);
//		}
	}


	/********************************************************************************
	 * Google Map Event - mapZoomChanged (zoom_changed)
	 ********************************************************************************/
	
	$scope.mapZoomChanged = function()
	{
		//console.log("••• MAP ZOOMED •••");
		
		// remove old poi markers (they may be replaced by new ones at idle time)
		deleteMarkers($scope.poiMarkers);
		
		// hide the extraneous pop-ups then alert other controllers
		hideDrawers();
		$rootScope.$emit("handleZoomChange", $scope.map.getZoom());
		
		$scope.zoomValue = $scope.map.getZoom();		
	}


	/********************************************************************************
	 * enforceBounds
	 ********************************************************************************/
	
	function enforceBounds()
	{
		// NB: the center returned by oldBounds.getCenter() may be different from map.getCenter()!
		var oldBounds = $scope.map.getBounds();
		var oldCenter = $scope.map.getCenter();
		var newCenter = pccMapService.enforceBounds(oldBounds, oldCenter);

		if (!oldCenter.equals(newCenter))
		{
			$scope.map.setCenter(newCenter);
		}
	}


	/********************************************************************************
	 * hideDrawers
	 ********************************************************************************/
	
	function hideDrawers()
	{
		$rootScope.$emit("handleHideDrawer", "mapController");
	}


	/********************************************************************************
	 * PCC Service Event Handlers
	 ********************************************************************************/
	 
	// Called when latLng coordinates have been found for a searched address
	$rootScope.$on("handleGeocodeResult", function(scope, location)
	{
		var marker			= null;
		var newZoomLevel	= 10;		// TODO get from settings
		
		if (location.bounds)
		{
			// create a marker for a search that returned an area (e.g., city, zip, neighborhood)
			marker = createMarker(location.center, getMarkerIcon("area", 0, false), location);
			
			// record this user interaction
			$rootScope.$emit("handleRecordEvent", "coverageResult", {"location":location,"coverage":null});
		}
		else
		{
			// create a marker for a search that returned an exact address match
			marker = createMarker(location.center, getMarkerIcon("address", 0, false), location);

			// we have the country, request coverage for this exact location
			pccCoverageService.getCoverage(marker);
			
			// zoom to the highest level
			newZoomLevel = 99;			// TODO get max level from settings
		}
		
		// clear any route markers and add the new marker
		clearAllMarkers();
		if (pccSettings.flags.isClickable)
		{
			// make this the current marker
			addUserMarkerToMap(marker);
			selectMarker(marker, true);
		}
		
		// ensure the marker is in view
		focusMarker(marker, newZoomLevel);

		// if the marker is an area, show the info window
		if (marker.location.bounds)
		{
			showMarkerInfo(marker);
		}

 		// add the pcc marker to the history
 		pccHistoryService.addHistory(marker);
 		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "geocodeResult", [location]);
	});
	

	// Called when a multi-search request has completed
	$rootScope.$on("handleMultipleGeocodeResult", function(scope, locations, showRoute)
	{
		var markers = [];
		
		// iterate over results, building a marker for each location
		for (var i = 0, len = locations.length; i < len; i++)
		{
			console.log("Location in handle result ************: "+ locations[i].address);
			var location = locations[i];
			
			if (location.bounds)
			{
				// create a marker for a search that returned an area (e.g., city, zip, neighborhood)
				markers[i] = createMarker(location.center, getMarkerIcon("area", i+1, false), location);
				
				// record this user interaction
				$rootScope.$emit("handleRecordEvent", "coverageResult", {"location":location,"coverage":null});
			}
			else
			{
				// create a marker for a search that returned an exact address match
				markers[i] = createMarker(location.center, getMarkerIcon("address", i+1, false), location);
			
				// request coverage for each location
				pccCoverageService.getCoverage(markers[i]);
			}
		}
		
		// clear any user markers and add the new route markers
		clearAllMarkers();
		addRouteMarkersToMap(markers, $rootScope.routeFlag);
		
		// pan and zoom to show the full set of markers, then select the first one
		focusMarkers(markers);
		selectMarker(markers[0], true);
		
		// if the first marker is an area, show the info window
		if (markers[0].location.bounds)
		{
			showMarkerInfo(markers[0]);
		}
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "geocodeResult", locations);
	});


	// Called when an address has been found for a clicked latLng
	$rootScope.$on("handleReverseGeocodeResult", function(scope, location, marker)
	{
		// update the marker with the full location information
		marker.location = location;
		
		if (location != null)
		{
			// geocode was the result of a click, by definition it is an exact search
			location.bounds	= null;
		
			// auto-zoom if necessary
			if ($scope.currentMarker === marker && $scope.map.getZoom() < 9)
			{
				focusMarker(marker, 9);
			}
		
			// now that we have the country, request coverage for this clicked position
			pccCoverageService.getCoverage(marker);
		}
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "reverseGeocodeResult", location);
	});


	// Called when an address has been found for the physical location
	$rootScope.$on("handleGeolocationResult", function(scope, clickLoc, location)
	{
		if (location.bounds)
		{
			var marker = createMarker(clickLoc, getMarkerIcon("area", 0, false), location);
		}
		else
		{
			var marker = createMarker(clickLoc, getMarkerIcon("address", 0, false), location);
		}

		// clear any route markers and add the new marker
		clearAllMarkers();
		if (pccSettings.flags.isClickable)
		{
			// make this the current marker
			addUserMarkerToMap(marker);
			selectMarker(marker, true);
		}
		
		// ensure the marker is in view
		focusMarker(marker, 99);

		// request coverage for the geolocated location
		pccCoverageService.getCoverage(marker);
	});


	// Called when coverage has been retrieved for a given marker
	$rootScope.$on("handleCoverageResult", function(scope, marker, coverageArray, speedtest, technologyDetailsArray)
	{	
		marker.coverageArray			= coverageArray;
		marker.speedtest				= speedtest;
		marker.technologyDetailsArray	= technologyDetailsArray;
		
		// display the coverage info if this marker is the current marker
		if ($scope.currentMarker === marker)
		{
			showMarkerInfo(marker);
			
			// record this user interaction
			var coverage			= pccCoverageService.getCoverageForMode(marker.coverageArray, $scope.coverageMode);
			$rootScope.$emit("handleRecordEvent", "coverageResult", {"location":marker.location,"coverage":coverage});
		}	
		
	});
	

	// Called when a route has been created for a set of markers
	$rootScope.$on("handleRouteResult", function(scope, routeResult)
	{
		// •••TODO check if this route belongs to current set of route markers
		
		// add the route to the map
		routeRenderer.setDirections(routeResult);
		routeRenderer.setMap($scope.map);
	});
	
	
	// Called when a route could not be created for a set of markers
	$rootScope.$on("handleRouteError", function(scope, status)
	{
		// remove the route from the map
		routeRenderer.setMap(null);
	});


	// Called when POI service has returned at least one POI in the viewport
	$rootScope.$on("handlePOIResult", function(scope, pois)
	{
		console.log("MapController - " + pois.length + " POIs retrieved");
		
		deleteMarkers($scope.poiMarkers);
		
		for (var i = 0, len = pois.length; i < len; i++)
		{
			var poi				= pois[i];
			var marker			= createMarker(poi.location.center, getMarkerIcon("poi", i+1, false), poi.location);
			
			marker.poi			= poi.poi;
			marker.coverage		= poi.coverage;
			marker.speedtest	= poi.speedtest;
			
			$scope.poiMarkers.push(marker);
		}
		
		$rootScope.$emit("handlePOIItemsChanged", $scope.poiMarkers);
	});


	/********************************************************************************
	 * PCC UI Inter-Controller Event Handlers
	 ********************************************************************************/

	// Called to show/hide toggleable layer from outside this controller
	$rootScope.$on("handleToggleLayer", function(event, name, show)
	{
		pccMapService.toggleMapOverlay($scope.map, name, show);
	});


	// Called when a history row has been clicked
	$rootScope.$on("handleSelectHistory", function(scope, marker)
	{
		clearAllMarkers();
		addUserMarkerToMap(marker);
		
		focusMarker(marker, $scope.map.getZoom());
		selectMarker(marker, true);

		showMarkerInfo(marker);
	});


	// Called when a POI has been clicked in the ribbon
	$rootScope.$on("handlePOIClicked", function(scope, marker)
	{
		console.log("MapController - POI clicked");
		
		// make this the current marker
		focusMarker(marker, $scope.map.getZoom());
		showMarkerInfo(marker);		
	});
	
	
	// Called when the map div should change size
	$rootScope.$on("handleResize", function(scope, bottom)
	{
		angular.element(document.getElementById("map")).css("bottom", bottom + "px");
		
		// tell the google api that the map's viewport has changed size
		google.maps.event.trigger($scope.map, 'resize');
	});	
		
	
	
	/********************************************************************************
	 * 700 vs. non-700 handlers
	 ********************************************************************************/

	// Opens compareMap popup, current marker position is passed to side-by-side maps
	$scope.openCompareMapPopup = function(coverageDiffValue)
	{
		$rootScope.$emit("openCompareMap", $scope.currentMarker.position, $scope.map.getZoom(), coverageDiffValue);

		// record this user interaction
		var coverageType = $scope.currentMarker.coverage ? $scope.currentMarker.coverage['type-text'] : "";
		$rootScope.$emit("handleRecordEvent", "showCompareMapClicked", {"link":"pin", "value":coverageDiffValue.toString(), "type": coverageType});
	};
	
	
	$scope.toggleCoverageMode = function(coverageDiffValue)
	{
		$rootScope.$emit("handleSetCoverageMode", $scope.coverageMode === "has700" ? "has600" : "has700", null);
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "toggleCoverageModeClicked", {"link":"pin", "value":coverageDiffValue.toString(), "toggleToMode": $scope.coverageMode});
	};

	//Called when SHOP Devices clicked
	$scope.shopDevices = function(coverageDiffValue)
	{	
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "shopDevicesClicked", {"link":"pin", "value":coverageDiffValue.toString()});
	}

	$rootScope.$on("handleSetCoverageMode", function(scope, coverageMode, is700DeviceSelected)
	{
		if ($scope.currentMarker)
		{
			$scope.currentMarker.coverage = pccCoverageService.getCoverageForMode($scope.currentMarker.coverageArray, coverageMode);
			
			if($scope.currentMarker.coverage)
			{
				$scope.currentMarker.coverage.requiresCapableDevice = ($scope.currentMarker.coverage['hasNewBands'] || 
														$scope.currentMarker.coverage['type'] == 'type-roam850');								
			}
			
		}

		if (pccSettings.coveragesets && pccSettings.coveragesets[coverageMode])
		{
			pccMapService.swapMapCoverage($scope.map, pccSettings.coveragesets[coverageMode]);
		}
	});	

	$rootScope.$on("showCompareMap", function(scope, coverageDiffValue)
	{
		$rootScope.$emit("openCompareMap", $scope.map.getCenter(), $scope.map.getZoom(), coverageDiffValue);
	}); 
	
	$scope.seePartnerCoverage = function()
	{
		$rootScope.$emit("openPartnerCoveragePopup");
	};	
	
	
	
	
	/********************************************************************************
	 * Store Locator Handlers
	 ********************************************************************************/

	$rootScope.$on("handleDrawStoreMarkers", function(scope, dataArray)
	{
		if (dataArray instanceof Array)
		{
			// TODO may want to make this optional in phase 2
			clearAllMarkers();
			
			var storeMarkers = [];
			
			for (var i = 0, len = dataArray.length; i < len; i++)
			{
				var datum		= dataArray[i];
				var position	= sanitizeLatLng(datum["position"]);
							
				var storeMarker	= position ? createMarker(position, getMarkerIcon("store", i, false), null) : null;
				storeMarkers.push(storeMarker);
			}
			
			addStoreMarkersToMap(storeMarkers);
			focusMarkers(storeMarkers);
		}
	});
	
	
	$rootScope.$on("handleSelectStoreMarker", function(scope, data)
	{
		var index		= data["index"];
		
		if (validateIndex(index, $scope.storeMarkers))
		{
			selectMarker($scope.storeMarkers[index], true);
			focusMarker($scope.storeMarkers[index], $scope.map.getZoom());
		}
	});
	
	
	$rootScope.$on("handleDrawStoreRoute", function(scope, data)
	{
		var startIndex	= data[0]["index"];
		var endIndex	= data[1]["index"];
		
		if (validateIndex(startIndex, $scope.storeMarkers) && validateIndex(endIndex, $scope.storeMarkers))
		{
			var routeArray	= [$scope.storeMarkers[startIndex], $scope.storeMarkers[endIndex]];
		
			pccRouteService.getRoute(routeArray);
			focusMarkers(routeArray);
		}
	});
	
	
	function sanitizeLatLng(position)
	{
		// first, look for LatLngLiteral, e.g. {"lat":yyy,"lng":xxx}
		if (position && position["lat"] && position["lng"])
		{
			return new google.maps.LatLng(position);
		}
		// look for coordinates in a string, e.g. {yyy,xxx}
		else if (position instanceof String)
		{
			var lat		= position.split(",")[0];		
			var lng		= position.split(",")[1];
			
			return new google.maps.LatLng(lat,lng);
		}
		else
		{
			return null;
		}
	}
	
	
	function validateIndex(index, array)
	{
		return index >= 0 && index < array.length && array[index] != null;
	}
}])




/************************************************************************************
 *
 * deviceSelectionController
 *
 ************************************************************************************/
 
.controller('deviceSelectionController', ['$rootScope', '$scope', '$sce', 'pccSettings', 'pccDeviceService', 
                                          function($rootScope, $scope, $sce, pccSettings, pccDeviceService)
{
	$scope.template						= pccSettings.fragments["deviceSelection"];
	
	$scope.showDeviceSelectionPopup 	= false;
	$scope.devices 						= {};
	$scope.manufacturers				= [];
	var defaultOrPreviousZoomValue 		= 4;
	var triggerDeviceSelection			= $scope.hasDeviceSelection; //true;
	var isAppleOnlyDeviceSelection		= (pccSettings.defaults["deviceSelection"] == "apple");	
	$scope.devicesInGroup				= [];
	$scope.isDeviceSelected				= false;
	
	//Called when other overlays are open to close deviceselection overlay
	$rootScope.$on("handleHideDrawer", function(scope, value)
	{ 
		if (value != "deviceSelectionController")
		{
			$scope.showDeviceSelectionPopup = false;
		}
	});
	
	//Called for Mobile mode. Sets the DeviceSelector Height, and add scroll if required
	function setDeviceSelectorHeight()
	{	
		var element = document.getElementById("pccDeviceSelectOverlay");
		var headerHeight = document.getElementById("pccHeader").offsetHeight + document.getElementById("pccTmoHeader").offsetHeight;
		var windowHeight =  window.innerHeight || document.documentElement.clientHeight ; 
		var vheight = windowHeight - headerHeight; 
		
		if( element.scrollHeight >= vheight)
		{

			if(element.offsetHeight != vheight)
			{
				element.style.overflow = "auto";
				element.style.height = vheight + "px";
			}
		} else 
		{
			element.style.overflow = "";
			element.style.height = '';
		}
	}
	
	
	$scope.toggleDeviceSelectionDrawer = function()
	{
		if(!$scope.showDeviceSelectionPopup)
		{
			$scope.$emit("handleDeviceSelectionEvent");
			$scope.$emit("handleHideDrawer", "deviceSelectionController")
			
			// record this user interaction
			$rootScope.$emit("handleRecordEvent", "chooseDeviceClicked", null);
		}
		else
		{ //SKIP option, continue to popup the device selection next time zoom paases over 11
			$scope.showDeviceSelectionPopup = false;

			// record this user interaction
			$rootScope.$emit("handleRecordEvent", "skipDeviceClicked", null);
		}  	
	}
	
	
	// For zoom >11, opens the deviceSelection popup if a device is not selected already
	$rootScope.$on("handleZoomChange", function(scope, zoom)
	{		
		if(triggerDeviceSelection && zoom >= 11 && defaultOrPreviousZoomValue < zoom && defaultOrPreviousZoomValue <11)
		{
			$scope.$emit("handleDeviceSelectionEvent");
		}
		defaultOrPreviousZoomValue = zoom;
	});
	
	//Called when device selection is triggered
    $scope.$on("handleDeviceSelectionEvent", function(scope)
	{
    	if($scope.manufacturers.length == 0) //Dont call the getDevices service if it already called once
		{
	    	//var language	= getQueryVariable("language", "en"); 
			var deviceList	= pccSettings.defaults["deviceList"]; 
			pccDeviceService.getDevicesForType("LTE-700Band12", "en", deviceList, "handle700Band12DevicesResult");
		}
    	else
    	{
    		$scope.showDeviceSelectionPopup = true;
    	}
	});
	
    var resizeWatcher = true;
	//Called from getDevices service  
	$rootScope.$on("handle700Band12DevicesResult", function(event, devices)
	{
		$scope.devices = devices;
		if(isAppleOnlyDeviceSelection)
		{
			$scope.manufacturers = ["Apple"];
		}
		else
		{
			angular.forEach(devices, function(value, key)
			{
				$scope.manufacturers.push(key);
			});
		}	
		$scope.showDeviceSelectionPopup = true;
		
		//Watch for windowresize (changing to portrait or landscape mode of mobile) and Set the DeviceSelector Height, and add scroll if required
		if($rootScope.mobileSizeMode)
		{
			if(resizeWatcher)
    		{	
				resizeWatcher = false;
    			$scope.$watch( function(){ return window.innerHeight || document.documentElement.clientHeight; },
    				function(val) 
    				{ 
    					setDeviceSelectorHeight(); 
    				} 
    			);
    		}
			
			setTimeout(function()
			{			
				setDeviceSelectorHeight();
			}, 0);
		}
	});
	
	//reset the devices dropdown, sets it to "Choose a Device"
	$scope.manufacturerChangedEvent = function()
	{
		$scope.devicesInGroup.selectedDevice = "";
	};
	
	$scope.deviceChangedEvent	= function(device)
	{
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "deviceChanged", device);		
	}
	
	
	$scope.setDevice = function(device)
	{
		if (device === "*unknownDevice*" || device === "*nonTMoDevice*")
		{
			// non-700 mode
			$rootScope.$emit("handleSetDevice", "");
			$rootScope.$emit("handleSetCoverageMode", "non700", false);
		}
		else
		{
			// has-700 mode
			$rootScope.$emit("handleSetDevice", device);
			$rootScope.$emit("handleSetCoverageMode", "has700", true);
		}

		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "deviceSelected", device.length > 0 ? device : null);
		
		triggerDeviceSelection				= false;
		$scope.showDeviceSelectionPopup 	= false;
		$scope.isDeviceSelected 			= (device != '');
	};
}])




/************************************************************************************
 *
 * deviceListPopupController
 *
 ************************************************************************************/
.controller('deviceListPopupController', ['$rootScope', '$scope', '$sce', 'pccSettings', 'pccDeviceService', '$window',
										function($rootScope, $scope, $sce, pccSettings, pccDeviceService, $window)
{
	$scope.template 			= pccSettings.fragments["deviceListPopup"];
	$scope.deviceListURL		= pccSettings.ExternalURLs;
	$scope.title 				=  pccSettings.labels["deviceList-popup-title"];
	$scope.group_OtherPhones 	= "Other Phones" ; //pccSettings.labels["deviceList-group-other-phones"];
	$scope.group_tabletDevicesLabel = "Tablets and internet devices" ; //pccSettings.labels["deviceList-group-tablet-devices"];
	$scope.group_tabletDevices 	= "Tablets and internet devices" ;
	
	$scope.showPopup		= false;
	
	$scope.deviceGroupToggle = [];
// 	$scope.coverage; 		
	$scope.devices = {};
	$scope.technology;
	
	$scope.hideDialog = function()
	{
		$scope.showPopup = false;
    };
  
  
    $scope.toggleShow = function(event)
    {	  
		$scope.showPopup = true;	  
    };
	
	
	function getQueryVariable(variableName, defaultValue)
	{
		var query	= $window.location.search.substring(1);
		var vars	= query.split("&");

		for (var i = 0; i < vars.length; i++)
		{
			var pair = vars[i].split("=");

			if (pair[0].toUpperCase() === variableName.toUpperCase())
			{
				return vars[i].substring(variableName.length + 1);
			}
		}

		return defaultValue;
	}
	
	
	$rootScope.$on("handleShowDeviceList", function(scope, type)
	{	
		//open the devicelist in modal window, if devicelisturl is null
		var openDeviceListInModalWindow = (!pccSettings.flags.hasExternalUrls  
											|| (type == 'LTE-700Band12' && !$scope.deviceListURL.LTE_700) 
											|| (type == 'LTE-1900Band2' && !$scope.deviceListURL.LTE_1900) 
											|| (type == 'type-roam850' && !$scope.deviceListURL.ROAM_850) 
											|| (type == 'LTE-600Band71' && !$scope.deviceListURL.LTE_700)
										  );
									 
		if (openDeviceListInModalWindow) 
		{
			$scope.type = type;
			
			if (type == 'type-roam850')
			{
				$scope.showPopup = true;
			}
			else
			{
				var language	= getQueryVariable("language", "en"); 
				var deviceList	= pccSettings.defaults["deviceList"]; 
				pccDeviceService.getDevicesForType(type, language, deviceList, "handleDevicesForCoverageResult");			
			}
		}		
	});


	$rootScope.$on("handleDevicesForCoverageResult", function(event, devices)
	{
		$scope.devices = devices;
		 
		var technologyType = $scope.type.toLowerCase(); 
		$scope.technology = pccSettings.labels[technologyType];
		
		$scope.toggleShow();
		
	});
		
			
    $scope.toggleDeviceGroup = function(index)
	{	
		$scope.deviceGroupToggle[index] = !$scope.deviceGroupToggle[index];
    };
}])




/************************************************************************************
 *
 * compareMapController
 *
 ************************************************************************************/
 
.controller('compareMapController', ['$rootScope', '$scope', '$sce', 'pccSettings', 'pccMapService', function($rootScope, $scope, $sce, pccSettings, pccMapService)
{
	$scope.template				= "";
	$scope.coverageDiffValue	= 1;
	$scope.hasShopDevices		= pccSettings.flags["hasShopDevices"];
	
	var mapOptions				=
	{
		disableDefaultUI:		true,
		center:					pccMapService.mapCenter,
		maxZoom:				15,
		minZoom:				13,
		zoom:					13,
		zoomControl:			true,
		zoomControlOptions:		{position: google.maps.ControlPosition.RIGHT_BOTTOM, style: google.maps.ZoomControlStyle.SMALL},
		styles:					pccSettings.mapStyles["bottom"],
		clickableIcons:			false,
	};

	
	$scope.initMaps = function()
	{
		var left	= document.getElementById("mapLeftSide");
		var right	= document.getElementById("mapRightSide");
		console.log('initmap.....')
		$scope.leftMap	= new google.maps.Map(left, mapOptions);
		$scope.rightMap	= new google.maps.Map(right, mapOptions);
		
		pccMapService.buildMapLayers($scope.leftMap, pccSettings.coveragesets["non700"]);		
		pccMapService.buildMapLayers($scope.rightMap, pccSettings.coveragesets["has700"]);
		
		$scope.rightMap.bindTo("center", $scope.leftMap, "center");
		$scope.rightMap.bindTo("zoom", $scope.leftMap, "zoom");
		
		google.maps.event.trigger($scope.leftMap, 'resize');
		google.maps.event.trigger($scope.rightMap, 'resize');
	};
	

	// Closes compareMap popup
	$scope.hideCompareMapPopup = function()
	{
		$scope.template				= "";
		
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "closeCompareMapClicked", null);
	};
	
	$scope.shopDevices = function(coverageDiffValue)
	{
		// record this user interaction
		$rootScope.$emit("handleRecordEvent", "shopDevicesClicked", {"link":"compareMap", "value":coverageDiffValue.toString()});
	}
	
	$rootScope.$on("openCompareMap", function(scope, center, zoom, coverageDiffValue)
	{
		$scope.template				= pccSettings.fragments["compareMap"];

		$scope.shop700DevicesUrl	= pccSettings.ExternalURLs ? pccSettings.ExternalURLs.SHOP_700 : "";
	
		mapOptions.center			= center;
		mapOptions.zoom				= zoom;	
		
		$scope.coverageDiffValue	= coverageDiffValue;
		
		//set Legend's TOP in compare map window to correct position
		//setTimeout(function()
		//{
			//var windowHeight			=	document.getElementById("comparePopupDialog").offsetHeight;
			//var compareMapLegend		=	document.getElementById("compareMapLegend");
			//compareMapLegend.style.top	=	windowHeight - 70 +"px";
		//},10);
	});
}])



/************************************************************************************
 *
 * partnerCoverageController
 *
 ************************************************************************************/
 
.controller('partnerCoverageController', ['$rootScope', '$scope', '$sce', 'pccSettings', function($rootScope, $scope, $sce, pccSettings)
{
	$scope.template				= pccSettings.fragments["partnerCoverage"];
	
	$scope.showPartnerCoverage	= false;

	$rootScope.$on("openPartnerCoveragePopup", function()
	{
		$scope.showPartnerCoverage	= true;
	});
	
	$scope.hidePartnerCoverage = function()
	{
		$scope.showPartnerCoverage 	= false;
	};
			
	
}])


/************************************************************************************
 *
 * disclaimerController
 *
 * NOTE - this will change when we get new design for disclaimer
 *
 ************************************************************************************/
 
.controller('disclaimerController', ['$rootScope', '$scope', '$sce', 'pccSettings', function($rootScope, $scope, $sce, pccSettings)
{
	$scope.template		= pccSettings.fragments["disclaimer"];
	$scope.showDrawer	= false;

	// Call from UI to expand/collapse disclaimer
	$scope.toggleDrawer = function()
	{
		$scope.showDrawer = !$scope.showDrawer;
	};
	
	
	// Called to expand/collapse disclaimer from outside this controller
	$rootScope.$on("handleToggleDisclaimer", function()
	{
		$scope.toggleDrawer();
	});


	// Called when starting an action that should force collapse of disclaimer
	$rootScope.$on("handleHideDisclaimer", function()
	{
		$scope.showDrawer = false;
	});
}])




/************************************************************************************
 *
 * ribbonController
 *
 ************************************************************************************/
 
.controller('ribbonController', ['$http','$rootScope', '$scope', '$sce', 'pccSettings', function($http, $rootScope, $scope, $sce, pccSettings)
{
	if (pccSettings.flags.hasRibbon)
    {
		$scope.ribbonTemplate		= pccSettings.fragments["ribbon"];		
		var ribbonDataURL			= pccSettings.fragments["ribbonDataURL"];		
		$scope.disclaimerTemplate	= pccSettings.fragments["disclaimer"];		
		$scope.partnerCoverageTemplate	= pccSettings.fragments["partnerCoverage"];
		
        $scope.showRibbon			= true;
		$scope.showRibbonDrawer		= pccSettings.flags["ribbonInitOpen"];		
		$scope.showDisclaimerDrawer	= false;
		$scope.showEduPopUp			= false;
		$scope.sliderTileClicked 	= false;
		$scope.showPccSliderBubble 	= 0;
        $scope.poiItems				= [];
        $scope.ribbonData			= [];
        $scope.selectedItem;
        $scope.showPartnerCoveragePopup	= true;
		$scope.deviceListURL		= pccSettings.ExternalURLs;
		$scope.hasShopDevices		= pccSettings.flags["hasShopDevices"];
		
		//pull the FAQ tiles data from ribbonData json file
		$http.get(ribbonDataURL).success(function(data)
		{
			$scope.ribbonData = data;
			
			for(var i=0; i<$scope.ribbonData.eduSlides.length; i++)
			{
				$scope.ribbonData.eduSlides[i].url = $scope.ribbonData.eduSlides[i].url;
			}
			
		});
		
        function setMapHeight()
        {	
			if ($scope.showRibbon)
			{
				angular.element(document.getElementById("pccFooter")).ready(
				function (){
					var pccFooterHeight = document.getElementById("pccFooter").offsetHeight;
					$rootScope.$emit("handleResize", pccFooterHeight);
				});
			}
			else
			{
				$rootScope.$emit("handleResize", 0);
			}		
        }

		// set initial map height
		setMapHeight();

		$scope.sliderTileClicked = function(index)
		{
			if(index == $scope.showPccSliderBubble)
			{
				$scope.showPccSliderBubble = 0;
			}
			else
			{
				var scrollSliderBy = selectedSlideOffset(index);
				if(scrollSliderBy != null)
				{
					pccSliderBody.scrollLeft = pccSliderBody.scrollLeft + ((scrollSliderBy < 0) ? (scrollSliderBy - 8) : (scrollSliderBy + 8));
				}
				
				alignSliderBubble(index);
				$scope.showPccSliderBubble = index;
			}
			
			//hide the disclaimer popup
			$scope.showDisclaimerDrawer = false;
			$rootScope.$emit("handleHideDrawer","ribbonController");
	    };
		
		function selectedSlideOffset(index)
		{
			var slideLeft = document.getElementById("slide" + index).offsetLeft;
			var pccSliderBody = document.getElementById("pccSliderBody");
			var slideRight = slideLeft + document.getElementById("slide" + index).offsetWidth;
			var scrolledRight = pccSliderBody.offsetWidth + pccSliderBody.scrollLeft;
			if(pccSliderBody.scrollLeft > slideLeft)
			{
				return -(pccSliderBody.scrollLeft - slideLeft);
			}
			else if(slideRight > scrolledRight)
			{
				return +(slideRight - scrolledRight);
			}
			
			return null;
		}
		
		function alignSliderBubble(index)
		{
			var pccSliderBubble = document.getElementById("pccbubbleOverlay" + index);
			
			var slideLeft = document.getElementById("slide" + index).offsetLeft;
			var sliderScrollLeft = document.getElementById("pccSliderBody").scrollLeft;
			var sliderRibbonHeight = document.getElementById("sliderRibbonBottom").offsetHeight;

			pccSliderBubble.style.bottom = sliderRibbonHeight + "px";
			
			if($rootScope.mobileSizeMode)
			{
				var pccSliderCaret = document.getElementById("pccBubbleCaretDown" + index);
				var slideWidth = document.getElementById("slide" + index).offsetWidth;
			
				//caret to be exactly in middle of the slide
				pccSliderCaret.style.left = (slideLeft - sliderScrollLeft + (slideWidth-20)/2) + "px";
			}
			else
			{
				pccSliderBubble.style.left = (slideLeft - sliderScrollLeft) + "px";
			}
		}
		
		$scope.$on("handleSliderScroll", function()
		{
			if($scope.showPccSliderBubble != 0)
			{	
				var selectedSlideIsOffScreen = selectedSlideOffset($scope.showPccSliderBubble);
				if(selectedSlideIsOffScreen == null)
				{
					alignSliderBubble($scope.showPccSliderBubble);
				}
				else
				{
					$scope.showPccSliderBubble = 0;
					$scope.$apply();
				}
			}
		});
		
		/********************************************************************************
         * setMapHeight
         *
         * Called to set Map Height based on the height of pccFooter from outside this controller	 
         ********************************************************************************/
		$scope.setMapHeight = function()
        {
			setMapHeight();
		}
		
		$scope.toggleRibbonDrawer = function()
        {
			$scope.showDisclaimerDrawer = false;
			$scope.showRibbonDrawer = !$scope.showRibbonDrawer;
            if(!$scope.showRibbonDrawer)
			{
				$scope.showPccSliderBubble=0;
			}
			else
			{
				$rootScope.$emit("handleHideDrawer","ribbonController");
			}
			
			setMapHeight();
        };
				
        
        /********************************************************************************
         * poiClicked
         *
         * Call from UI when a POI in the ribbon is clicked
         ********************************************************************************/

        $scope.poiClicked = function(poiItem)
        {
            console.log("RibbonController - poi item clicked");
            $scope.selectedItem = poiItem;

            $scope.showEduPopUp = false;

            // TODO handle hilight/etc in ribbon

            $rootScope.$emit("handlePOIClicked", poiItem);
        };


        /********************************************************************************
         * eduClicked
         *
         * Call from UI when an educational item in the ribbon is clicked
         ********************************************************************************/

        $scope.eduClicked = function(eduItem)
        {
            console.log("RibbonController - edu item clicked");
            $scope.selectedItem = eduItem;

            $scope.showEduPopUp = true;
            $scope.eduTemplate = "pcc/fragments/eduPopup.html";
        };

        $scope.closeEduPopup = function()
        {
            $scope.showEduPopUp = false;
            $scope.selectedItem = null;
        };


        /********************************************************************************
         * handleZoomChange
         *
         * Called when the zoom level is changed, either by user or programmatically
         ********************************************************************************/

        $rootScope.$on("handleZoomChange", function(scope, zoom)
        {
			   //$scope.showRibbon = zoom >= 11;
			   //setMapHeight();
        });

		/********************************************************************************
         * handleMobileSizeMode
         *
         * Called from the windowresize directive
         ********************************************************************************/

        $rootScope.$on("handleMobileSizeMode", function(scope)
        {
			if ($rootScope.mobileSizeMode) //hide or minimise the drwaers only in mobile when changing the ovientation
			{
				$scope.showRibbonDrawer 	= false;
				$scope.showPccSliderBubble 	= 0;
				$scope.showDisclaimerDrawer = false;
			}        	
			
			setMapHeight();
        });

        /********************************************************************************
         * handleToggleRibbon
         *
         * Called to expand/collapse ribbon from outside this controller	 
         ********************************************************************************/

        $rootScope.$on("handleToggleRibbon", function()
        {
            $scope.toggleRibbonDrawer();
        });


        /********************************************************************************
         * handleHideRibbon
         *
         * Called when starting an action that should force collapse of ribbon
         ********************************************************************************/

        $rootScope.$on("handleHideRibbon", function()
        {
            $scope.showRibbonDrawer = false;
        });
		
		$rootScope.$on("handleHideDrawer", function(scope, value)
		{
			if(value != "ribbonController")
			{
				$scope.showPccSliderBubble = 0;
				$scope.showDisclaimerDrawer = false;
			}
		});
		
		
		/********************************************************************************
        * DISCLAIMER SECTION
        ********************************************************************************/
		$scope.toggleDisclaimerDrawer = function()
        {
			var ribbonBodyBottom = document.getElementById("ribbonBody").offsetHeight;
			var disclaimerOverlay = document.getElementById("disclaimerOverlay");
			disclaimerOverlay.style.bottom = ribbonBodyBottom + 15 +"px";
			
			$scope.showDisclaimerDrawer = !$scope.showDisclaimerDrawer;
			
			//Hide SliderBubble
			$scope.showPccSliderBubble = 0;
			
			$rootScope.$emit("handleHideDrawer","ribbonController");
        };

		// Called to expand/collapse disclaimer from outside this controller
		$rootScope.$on("handleToggleDisclaimer", function()
		{
			$scope.toggleDisclaimerDrawer();
		});


		// Called when starting an action that should force collapse of disclaimer
		$rootScope.$on("handleHideDisclaimer", function()
		{
			$scope.showDisclaimerDrawer = false;
		});
		
		//Called when "View here" link on FQA tile clicked for Devicelist
		$scope.showDeviceList = function()
		{
			$rootScope.$emit("handleShowDeviceList", "LTE-700Band12");
			
			// record this user interaction
			$rootScope.$emit("handleRecordEvent", "showDeviceListClicked", {"link":"faqs", "deviceList":"LTE-700Band12"});
		};
		
		$scope.seePartnerCoverage = function()
		{
			$rootScope.$emit("openPartnerCoveragePopup");
		};				
    }
}]);
