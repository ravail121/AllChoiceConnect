/************************************************************************************
 *
 * pccService Module
 *
 ************************************************************************************/
 
angular.module("pccService", ["pccConfig"])
.value("version", "5.3")




/************************************************************************************
 *
 * pccMapService
 *
 ************************************************************************************/
 
.factory("pccMapService", ["pccSettings", function(pccSettings)
{
	var service				= {};
	
	// constants for Google Maps API Mercator projection
	var TILE_SIZE			= 256;
	var	pixelOrigin			= TILE_SIZE / 2;
	var pixelsPerLngDegree	= TILE_SIZE / 360;
	var pixelsPerLngRadian	= TILE_SIZE / (2 * Math.PI);
	var radiansPerDegree	= Math.PI / 180;
	
	service.mapBounds		= calculateMapBounds();
	service.mapCenter		= service.mapBounds.getCenter();
	service.mapWorldBounds	= calculateWorldBounds(service.mapBounds);
	service.mapWorldSize	= calculateWorldSize(service.mapWorldBounds);
	
	
	/********************************************************************************
	 * public buildMapLayers
	 ********************************************************************************/
	
	service.buildMapLayers = function(map, coverageArray)
	{
		// sanity check; must have a map and coverage array
		if (!map || !coverageArray)
		{
			return;
		}

		// always start with a blank set of layers
		map.overlayMapTypes.clear();
		
		// create coverage layer(s)
		service.swapMapCoverage(map, coverageArray);

		// create styled water layer
		if (pccSettings.mapStyles["middle"])
		{
			map.overlayMapTypes.push(createStyledLayer("water", pccSettings.mapStyles["middle"]));
		}
												 
		// create styled road and label layer
		if (pccSettings.mapStyles["top"])
		{
			map.overlayMapTypes.push(createStyledLayer("roads", pccSettings.mapStyles["top"]));
		}
	}


	/********************************************************************************
	 * public swapMapCoverage
	 ********************************************************************************/
	
	service.swapMapCoverage = function(map, coverageArray)
	{
		// sanity check; must have a map and coverage array
		if (!map || !coverageArray)
		{
			return;
		}

		// remove existing coverage layers
		for (var i = map.overlayMapTypes.getLength() - 1; i >= 0; i--)
		{
			if (map.overlayMapTypes.getAt(i).name === "coverage")
			{
				map.overlayMapTypes.removeAt(i);
			}
		}
		
		// create an image layer for each coverage tile set
		for (var i = coverageArray.length - 1; i >= 0; i--)
		{
			if (coverageArray[i].opacity > 0)
			{
				map.overlayMapTypes.insertAt(0, createImageLayer("coverage", coverageArray[i]));
			}
		}	
	}
	
	
	/********************************************************************************
	 * public toggleMapOverlay
	 ********************************************************************************/
	
	service.toggleMapOverlay = function(map, name, show)
	{
		// sanity check; must have a map, layer name and overlays array
		if (!map || !name || name === "" || !pccSettings.overlays)
		{
			return;
		}
		
		// a single overlay can be placed between the water and road layers
		// if an overlay is already being displayed, remove it
		var len = map.overlayMapTypes.getLength();
		if (!(map.overlayMapTypes.getAt(len - 2).name === "water"))
		{
			map.overlayMapTypes.removeAt(len - 2);
		}
		
		// insert an overlay if necessary
		if (show)
		{
			// find the named overlay
			for (var i = pccSettings.overlays.length - 1; i >= 0; i--)
			{
				var overlay = pccSettings.overlays[i];
				
				if (overlay.name === name)
				{
					map.overlayMapTypes.insertAt(len - 1, createImageLayer(name, overlay));
					break;
				}
			}
		}
	}
	
	
	/********************************************************************************
	 * public fitsInView
	 *
	 * Return TRUE if the map bounds fit entirely within the given viewport bounds
	 ********************************************************************************/

	service.fitsInView = function(viewBounds)
	{
		// Convert the view bounds (lat/lng) to world bounds (0..256) and size
		var viewWorldBounds	= calculateWorldBounds(viewBounds);
		var viewWorldSize 	= calculateWorldSize(viewWorldBounds);
		
		return (service.mapWorldSize.width  <= viewWorldSize.width &&
				service.mapWorldSize.height <= viewWorldSize.height);
	}


	/********************************************************************************
	 * public enforceBounds
	 *
	 * 
	 ********************************************************************************/

	service.enforceBounds = function(viewBounds, viewCenter)
	{
		// Convert the view bounds (lat/lng) to world bounds (0..256) and size
		var viewWorldBounds	= calculateWorldBounds(viewBounds);
		var viewWorldSize 	= calculateWorldSize(viewWorldBounds);
		
		if (service.mapWorldSize.width  <= viewWorldSize.width &&
			service.mapWorldSize.height <= viewWorldSize.height)
		{
			// Case 1: map fits entirely within view
			return service.mapBounds.getCenter();
		}
		else if (service.mapWorldSize.width <= viewWorldSize.width)
		{
			// Case 2A: map fits in view horizontally but not vertically
			var newLat = checkVerticalBounds(viewWorldBounds, viewWorldSize, viewCenter);
			
			return new google.maps.LatLng(newLat, service.mapCenter.lng());
		}
		else if (service.mapWorldSize.height <= viewWorldSize.height)
		{
			// Case 2B: map fits in view vertically but not horizontally
			var newLng = checkHorizontalBounds(viewWorldBounds, viewWorldSize, viewCenter);

			return new google.maps.LatLng(service.mapCenter.lat(), newLng);
		}
		else
		{
			// Case 3: map exceeds view boundaries in both directions
			var newLat = checkVerticalBounds(viewWorldBounds, viewWorldSize, viewCenter);
			var newLng = checkHorizontalBounds(viewWorldBounds, viewWorldSize, viewCenter);
			
			return new google.maps.LatLng(newLat, newLng);			
		}
	}


	/********************************************************************************
	 * public metersPerPixel
	 *
	 * 
	 ********************************************************************************/

	service.metersPerPixel = function(latitude, zoom)
	{
		var mppAtEquator	= 156543.034;
		var latRadians		= latitude * radiansPerDegree;
		
		return mppAtEquator * Math.cos(latRadians) / Math.pow(2, zoom);
	}



	return service;



	/********************************************************************************
	 * private createImageLayer
	 ********************************************************************************/
	
	function createImageLayer(name, layer)
	{
		var imageLayer = null;
		
		if (layer && layer.url && layer.opacity > 0)
		{
			imageLayer = new google.maps.ImageMapType(
			{
				getTileUrl: function(point, zoom)
				{
                    var level	= zoom + 1;
					var row		= point.y + 1;
					var col		= point.x + 1;
					var bounds	= this.tileBounds[zoom];

					if (bounds &&
						point.y >= bounds.rowMin && point.y <= bounds.rowMax &&
						point.x >= bounds.colMin && point.x <= bounds.colMax)
					{
						if (layer.version === 2)
						{
							// Spectrum Spatial URL style
							return layer.url + "/" + level + "/" + col + ":" + row + "/tile.png";
						}
						else
						{
							// Envinsa URL style
							return layer.url + "&level=" + level + "&row=" + row + "&col=" + col + "&output=" + layer.format;
						}
					}
					else
					{
						return null;
					}
				},
				maxZoom:	layer.maxZoom,
				minZoom:	layer.minZoom,
				name:		name,
				opacity:	parseFloat(layer.opacity),
				tileSize:	new google.maps.Size(256, 256),
				tileBounds:	getTileBounds(layer)
			});
		}
		
		return imageLayer;
	}

	
	/********************************************************************************
	 * private createStyledLayer
	 ********************************************************************************/
	
	function createStyledLayer(name, styles)
	{
		var styledLayer = null;
		
		if (styles)
		{
			styledLayer			= new google.maps.StyledMapType(styles);
			styledLayer.name	= name;
		}
		
		return styledLayer;
	}
	
	
	/********************************************************************************
	 * private getTileBounds
	 ********************************************************************************/

	function getTileBounds(layer)
	{
		var tileArray = [];

		for (var i = layer.minZoom; i <= layer.maxZoom; i++)
		{
			var tileMax	= Math.pow(2, i);
			var bounds	= calculateWorldBounds(new google.maps.LatLngBounds(new google.maps.LatLng(layer.boundsBottom, layer.boundsLeft),
																			new google.maps.LatLng(layer.boundsTop, layer.boundsRight)));
		
			var _colMin = Math.floor((bounds.botLeft.x  * tileMax) / TILE_SIZE);
			var _colMax = Math.floor((bounds.topRight.x * tileMax) / TILE_SIZE);
			var _rowMin = Math.floor((bounds.topRight.y * tileMax) / TILE_SIZE);
			var _rowMax = Math.floor((bounds.botLeft.y  * tileMax) / TILE_SIZE);
		
			tileArray[i] = {colMin: _colMin, colMax: _colMax, rowMin: _rowMin, rowMax: _rowMax};
		}
	
		return tileArray;
	}
	
	
	/********************************************************************************
	 * private calculateMapBounds
	 ********************************************************************************/

	function calculateMapBounds()
	{
		var mapBounds = null;

		for (var i = 0, len = pccSettings.coverage.length; i < len; i++)
		{
			var layer		= pccSettings.coverage[i];
			var layerBounds = new google.maps.LatLngBounds(new google.maps.LatLng(layer.boundsBottom, layer.boundsLeft),
														   new google.maps.LatLng(layer.boundsTop, layer.boundsRight));
	
			if (mapBounds === null)
			{
				mapBounds = layerBounds;
			}
			else
			{
				mapBounds.union(layerBounds);
			}
		}
			
		return mapBounds;
	}
	
	
	/********************************************************************************
	 * private checkVerticalBounds
	 ********************************************************************************/

	function checkVerticalBounds(viewWorldBounds, viewWorldSize, viewCenter)
	{
		// map top
		if (service.mapWorldBounds.topRight.y > viewWorldBounds.topRight.y)
		{
			var y = service.mapWorldBounds.topRight.y + (viewWorldSize.height / 2);
			return projectWorldYtoLat(y);
		}
		// map bottom
		else if (service.mapWorldBounds.botLeft.y < viewWorldBounds.botLeft.y)
		{
			var y = service.mapWorldBounds.botLeft.y - (viewWorldSize.height / 2);
			return projectWorldYtoLat(y);
		}
		
		return viewCenter.lat();
	}
	
	
	/********************************************************************************
	 * private checkHorizontalBounds
	 ********************************************************************************/

	function checkHorizontalBounds(viewWorldBounds, viewWorldSize, viewCenter)
	{
		// map left
		if (service.mapWorldBounds.botLeft.x > viewWorldBounds.botLeft.x)
		{
			var x = service.mapWorldBounds.botLeft.x + (viewWorldSize.width / 2);
			return projectWorldXtoLng(x);
		}
		// map right
		else if (service.mapWorldBounds.topRight.x < viewWorldBounds.topRight.x)
		{
			var x = service.mapWorldBounds.topRight.x - (viewWorldSize.width / 2);
			return projectWorldXtoLng(x);
		}
		
		return viewCenter.lng();
	}


	/********************************************************************************
	 * private calculateWorldBounds
	 ********************************************************************************/

	function calculateWorldBounds(latLngBounds)
 	{
		var swPoint	= projectMapToWorld(latLngBounds.getSouthWest());
		var nePoint	= projectMapToWorld(latLngBounds.getNorthEast()); 	
		
		if (nePoint.x < swPoint.x)
		{
			swPoint.x -= 256;
		}
		
		return {topRight: nePoint, botLeft: swPoint};
 	}
 	
 	
	/********************************************************************************
	 * private calculateWorldSize
	 ********************************************************************************/

	function calculateWorldSize(worldBounds)
	{
		// calculate the size in world units, accounting for wrap-around at 180° longitude
		var xSize	= (worldBounds.topRight.x - worldBounds.botLeft.x) % TILE_SIZE;
		var ySize	= worldBounds.botLeft.y - worldBounds.topRight.y;
		
		return new google.maps.Size(xSize, ySize);
	}
	
	
	/********************************************************************************
	 * private projectMapToWorld
	 *
	 * Convert a Lat/Long to a World coord (0..256) value using Mercator projection
	 ********************************************************************************/
	 
	function projectMapToWorld(latLng)
	{
		var latRadians	= latLng.lat() * radiansPerDegree;
		var siny		= Math.min(Math.max(Math.sin(latRadians), -0.9999), 0.9999);
		var x			= pixelOrigin + latLng.lng() * pixelsPerLngDegree;	
		var y			= pixelOrigin + 0.5 * Math.log((1 + siny) / (1 - siny)) * -pixelsPerLngRadian;
	
		return new google.maps.Point(x, y);
	}
	
	
	/********************************************************************************
	 * private projectWorldYtoLat
	 *
	 * Convert a World coord (0..256) value to the corresponding Latitude
	 ********************************************************************************/
	 
	function projectWorldYtoLat(y)
	{
		var latRadians	= (y - pixelOrigin) / -pixelsPerLngRadian;
		var lat			= (2 * Math.atan(Math.exp(latRadians)) - Math.PI / 2) / radiansPerDegree;
		
		return lat;
	}
	
	
	/********************************************************************************
	 * private projectWorldXtoLng
	 *
	 * Convert a World coord (0..256) value to the corresponding Longitude
	 ********************************************************************************/
	 
	function projectWorldXtoLng(x)
	{
		return (x - pixelOrigin) / pixelsPerLngDegree;
	}
}])




/************************************************************************************
 *
 * pccGeocodeService
 *
 ************************************************************************************/
 
.factory("pccGeocodeService", ["$rootScope", "pccSettings", "pccMapService",
		 function($rootScope, pccSettings, pccMapService)
{
	var service		= {};
	var geocoder	= new google.maps.Geocoder();
	var home		= null;
	
	
	/********************************************************************************
	 * public geocode
	 *
	 * 
	 ********************************************************************************/
	 
	service.geocode = function(searchTerm)
	{
		console.log("pccGeocodeService.geocode('" + searchTerm + "')");
		
		// start a busy indicator
		$rootScope.$emit("handleStartSpinner");

		geocoder.geocode({"address": searchTerm, "region": "us"}, function(results, status)
		{
			switch (status)
			{
				case google.maps.GeocoderStatus.OK:
					var location = buildLocation(results);
					
					if (location)
					{
						$rootScope.$emit("handleGeocodeResult", location);
					} else {
						$rootScope.$emit("handleGeocodeError", "OUTOFBOUND", searchTerm);
					}
					break;
					
				case google.maps.GeocoderStatus.ZERO_RESULTS:
					console.log("pccGeocodeService.geocode => zero results");
					$rootScope.$emit("handleGeocodeError", status, searchTerm);
					// ignore this error
					break;
					
				case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
				case google.maps.GeocoderStatus.UNKNOWN_ERROR:
					console.log("pccGeocodeService.geocode => error");
					$rootScope.$emit("handleGeocodeError", status, searchTerm);
					// TODO re-try after a brief wait?
					break;
				
				case google.maps.GeocoderStatus.REQUEST_DENIED:
				case google.maps.GeocoderStatus.INVALID_REQUEST:
				default:
					// more serious error		
					console.log("pccGeocodeService.geocode => ERROR");
					$rootScope.$emit("handleGeocodeError", status, searchTerm);
     				break;
    		}
		
			// stop a busy indicator
			$rootScope.$emit("handleStopSpinner");
		});
	}


	var locations = [];
	var geocodeCounter = 0;
	var searchLength;
	var geocoderStatusError = false;
	
	service.geocodeMulti = function(searchTerm)
	{		
	
		geocoderStatusError = false;
		geocodeCounter = 0;
		locations.length = 0;
		searchLength = 0;
		
		// start a busy indicator
		$rootScope.$emit("handleStartSpinner");
		
		searchLength = searchTerm.length;
		for(var i=0; i < searchTerm.length; i++)
		{
			var resultLoc = {};
			
			if((typeof searchTerm[i]) == "string"){		
				callGeoCode(searchTerm[i], i);
			} else {			
				locations[i] = buildLocation([searchTerm[i]]);
				
				checkCounterAndInvokeGeoCodeMultiHandler(i);			
			}
		}
	
	}
	
	function checkCounterAndInvokeGeoCodeMultiHandler(index){
		
		if(locations[index] == null) {
			geocoderStatusError = true;
		}

		geocodeCounter = geocodeCounter + 1;
		if (geocodeCounter == searchLength)
		{
			// stop a busy indicator
			$rootScope.$emit("handleStopSpinner");	
			
			if(!geocoderStatusError){			
				console.log(locations);
				$rootScope.$emit("handleMultipleGeocodeResult", locations);
			}
			else
			{
				$rootScope.$emit("handleGeocodeMultiError", locations);
			}
		}
	}
	
	function callGeoCode(searchTerm, index){
			
		geocoder.geocode({"address": searchTerm, "region": "us"}, function(results, status)
		{
			switch (status)
			{
				case google.maps.GeocoderStatus.OK:
						
						locations[index] = buildLocation(results);
						console.log("locations["+index+"] = " + locations[index]);						
						
					break;
					
				case google.maps.GeocoderStatus.ZERO_RESULTS:
				case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
				case google.maps.GeocoderStatus.UNKNOWN_ERROR:
				case google.maps.GeocoderStatus.REQUEST_DENIED:
				case google.maps.GeocoderStatus.INVALID_REQUEST:
				default:
					locations[index] = null;
					geocoderStatusError = true;
					console.log("pccGeocodeService.geocode => " + status);
					
					break;
			}
			
			checkCounterAndInvokeGeoCodeMultiHandler(index);			
		});
	}


	/********************************************************************************
	 * public geocodePlace
	 *
	 * Parse a Google Places result as if it were a geocode search result
	 ********************************************************************************/
	 
	service.geocodePlace = function(place)
	{
		console.log("pccGeocodeService.geocodePlace('" + place.formatted_address + "')");

		var location = buildLocation([place]);
		$rootScope.$emit("handleGeocodeResult", location);
	}
	
	
	/********************************************************************************
	 * public reverseGeocode
	 *
	 * 
	 ********************************************************************************/
	 
	service.reverseGeocode = function(position, marker)
	{
		console.log("pccGeocodeService.reverseGeocode('" + position.toString() + "')");

		// start a busy indicator
		$rootScope.$emit("handleStartSpinner");

		geocoder.geocode({"location": position}, function(results, status)
		{
			switch (status)
			{
				case google.maps.GeocoderStatus.OK:
					var location = buildLocation(results);
					$rootScope.$emit("handleReverseGeocodeResult", location, marker);
					break;
					
// 				case google.maps.GeocoderStatus.ZERO_RESULTS:
// 				case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
// 				case google.maps.GeocoderStatus.UNKNOWN_ERROR:
// 				case google.maps.GeocoderStatus.REQUEST_DENIED:
// 				case google.maps.GeocoderStatus.INVALID_REQUEST:
				default:
					$rootScope.$emit("handleGeocodeError", status, marker);
					break;
    		}

			// stop a busy indicator
			$rootScope.$emit("handleStopSpinner");
		});
	}


	/********************************************************************************
	 * public geolocate
	 *
	 * 
	 ********************************************************************************/
	 
	service.geolocate = function(fallbackSearch)
	{
		function success(position)
		{
			var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			console.log(latLng);
			
			geocoder.geocode({"location": latLng}, function(results, status)
			{				
				if (status === google.maps.GeocoderStatus.OK)
				{
					home = buildLocation(results);
					home.center = latLng;
					$rootScope.$emit("handleGeolocationResult", latLng, home);
				}
			});
			
			// stop a busy indicator
			$rootScope.$emit("handleStopSpinner");
		}
		
		function failure(error)
		{
			service.geocode(fallbackSearch);

			// stop a busy indicator
			$rootScope.$emit("handleStopSpinner");					
		}


		if (navigator.geolocation)
		{
			// start a busy indicator
			$rootScope.$emit("handleStartSpinner");

			navigator.geolocation.getCurrentPosition(success, failure, {maximumAge:60000, timeout:10000, enableHighAccuracy:true});
		}
	}


	/********************************************************************************
	 * public geocodeDefaultLocation
	 *
	 * 
	 ********************************************************************************/
	 
	service.geocodeDefaultLocation = function()
	{
		if (home)
		{
			console.log('home-getdefaultlocation')
			$rootScope.$emit("handleGeolocationResult", home.center, home);
		}
		else if (pccSettings.searchLocation)
		{
			service.geocode(pccSettings.searchLocation);
		}
		else if (pccSettings.flags["hasGeolocation"])
		{
			service.geolocate(pccSettings.defaults["search"] || "USA"); // || 
		}
		else
		{
			service.geocode(pccSettings.defaults["search"] || "USA"); // || 
		}	
	}
	
	
	
	return service;



	/********************************************************************************
	 * private getGeoCodeLocation
	 *
	 * 
	 ********************************************************************************/
	 
	function getGeoCodeLocation(arrSearch, arrlocations, index, objGeocodeCounter)
	{
		geocoder.geocode({"address": arrSearch[index], "region": "us"}, function(results, status)
		{
			switch (status)
			{
				case google.maps.GeocoderStatus.OK:
					arrlocations[index] = buildLocation(results);
					objGeocodeCounter.counter++;
					break;
					
				case google.maps.GeocoderStatus.ZERO_RESULTS:				
					console.log("pccGeocodeService.geocode => zero results");
					// ignore this error
					break;
					
				case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
				case google.maps.GeocoderStatus.UNKNOWN_ERROR:	
					console.log("pccGeocodeService.geocode => error");
					// TODO re-try after a brief wait?
					break;
				
				case google.maps.GeocoderStatus.REQUEST_DENIED:
				case google.maps.GeocoderStatus.INVALID_REQUEST:
				default:
					// more serious error
					console.log("pccGeocodeService.geocode => ERROR");
					$rootScope.$emit("handleGeocodeError", status, searchTerm);
					break;
			}
			
			if (objGeocodeCounter.counter == arrSearch.length)
			{
				// stop a busy indicator
				$rootScope.$emit("handleStopSpinner");
				
				$rootScope.$emit("handleMultipleGeocodeResult", arrlocations);
			}				
		});
	}


	/********************************************************************************
	 * private buildLocation
	 *
	 * 
	 ********************************************************************************/
	 
	function buildLocation(results)
	{
		function bestLocality(components)
		{
			if (getAddressComponent(components, "sublocality", "long_name"))
			{
				return getAddressComponent(components, "sublocality", "long_name");
			}
			else if (getAddressComponent(components, "locality", "long_name"))
			{
				return getAddressComponent(components, "locality", "long_name");
			}
			else if (getAddressComponent(components, "administrative_area_level_2", "long_name"))
			{
				return getAddressComponent(components, "administrative_area_level_2", "long_name");
			}
			
			if (pccSettings.flags.hasDebug)
			{
				console.log("!!! No Locality found for components:");
				console.log(components);
			}
			
			return "";
		}
		
		if (pccSettings.flags.hasDebug)
		{
			console.log("*** Building Location with GeoCode results:");
			console.log(results);
			console.log(results[0].types);
		}
		
		var knownTypes	= ["street_address","premise","subpremise","establishment","point_of_interest",
						   "country","administrative_area_level_1","administrative_area_level_2",
						   "locality","sublocality","postal_code","neighborhood","route","intersection"];
				
		for (var i = 0; i < results.length; i++)
		{
			// ignore results that do not fall within the map bounds
			// TODO may want to return physically nearest result if using geolocation
			if (pccMapService.mapBounds.contains(results[i].geometry.location))
			{
				var components	= results[i].address_components;
				var streetnum	= getAddressComponent(components, "street_number", "long_name");
				var streetname	= getAddressComponent(components, "route", "long_name");
				var locality	= bestLocality(components);
				var state		= getAddressComponent(components, "administrative_area_level_1", "short_name");
				var country		= getAddressComponent(components, "country", "short_name");
				var description	= country === "CA" || country === "MX" ? pccSettings.labels["title-areaCAMX"] : pccSettings.labels["title-area"];
		
				var location	=
				{
					"address"	: stripUSA(results[i].formatted_address, country),
					"bounds"	: results[i].geometry.viewport,
					"center"	: results[i].geometry.location,
					"country"	: country
				};
				
				for (var j = 0; j < knownTypes.length; j++)
				{
					if (results[i].types.indexOf(knownTypes[j]) > -1)
					{
						location.type = knownTypes[j];
			
						if (location.country === "MX")
						{
							switch (location.type)
							{
								case "street_address":
								case "establishment":
								case "point_of_interest":
									// "Eucalipto 5114, Ciudad Jardín, San Antonio, 22610 Tijuana, BC, Mexico"
									location.addressLine1	= streetname + (streetnum ? ", " + streetnum : "");
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.bounds			= null;
									return location;
									break;

								case "country":
								case "administrative_area_level_1":
								case "administrative_area_level_2":
								case "locality":
								case "postal_code":
								case "neighborhood":
								case "route":
								case "intersection":
								case "premise":
								case "subpremise":
									location.addressLine1	= results[i].formatted_address;
									location.description	= description;
									return location;
									break;

								default:
									break;
							}
						}
						else
						{
							switch (location.type)
							{
								// exact location with street address, city and state
								case "street_address":
									location.addressLine1	= (streetnum ? streetnum + " " : "") + streetname;
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.bounds			= null;
									return location;
									break;

								// exact location with name, city and state
								case "establishment":
								case "point_of_interest":
									location.addressLine1	= results[i].name ? results[i].name : getAddressComponent(components, "establishment", "short_name");
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.bounds			= null;
									return location;
									break;

								// exact location with name, city and state
								case "premise":
									location.addressLine1	= getAddressComponent(components, "premise", "short_name") ?
															  getAddressComponent(components, "premise", "short_name") :
															  (streetnum ? streetnum + " " : "") + streetname;
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.bounds			= null;
									return location;
									break;

								case "subpremise":
									location.addressLine1	= (streetnum ? streetnum + " " : "") + streetname +
															  (getAddressComponent(components, "subpremise", "short_name") ?
															  " #" + getAddressComponent(components, "subpremise", "short_name") : "");
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.bounds			= null;
									return location;
									break;

								// area with Google formatted address for country or state
								case "country":
								case "administrative_area_level_1":
									location.addressLine1	= results[i].formatted_address;
									location.description	= description;
									return location;
									break;

								// area with county and full state
								case "administrative_area_level_2":
									location.addressLine1	= getAddressComponent(components, "administrative_area_level_2", "long_name");
									location.addressLine2	= getAddressComponent(components, "administrative_area_level_1", "long_name");
									location.description	= description;
									return location;
									break;
								
								// area with city and state
								case "locality":
								case "sublocality":
									location.addressLine1	= (locality ? locality + ", " : "") + state;
									location.description	= description;
									return location;
									break;

								// area with city, state and zip
								case "postal_code":
									location.addressLine1	= (locality ? locality + ", " : "") + state + " " + getAddressComponent(components, "postal_code", "short_name");
									location.description	= description;
									return location;
									break;

								// area with neighborhood name, city and state
								case "neighborhood":
									location.addressLine1	= getAddressComponent(components, "neighborhood", "long_name");
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.description	= description;
									return location;
									break;

								// area with route, city and state
								case "route":						
								case "intersection":
									location.addressLine1	= streetname;
									location.addressLine2	= (locality ? locality + ", " : "") + state;
									location.description	= description;
									return location;
									break;

								default:
									break;
							}
						}
					}
				}
			}
		}
		
		return null;
	}
	

	/********************************************************************************
	 * private getAddressComponent
	 *
	 * 
	 ********************************************************************************/
	 
	function getAddressComponent(components, type, attribute)
	{
		function elvis(text)
		{
			return text != undefined ? text : "";
		}

		for (var i = 0; i < components.length; i++)
		{
			for (var j = 0; j < components[i].types.length; j++)
			{		
				if (components[i].types[j] === type)
				{	
					return elvis(components[i][attribute]);
				}
			}
		}
		
		return "";
	}
	
	
	/********************************************************************************
	 * private stripUSA
	 *
	 * 
	 ********************************************************************************/
	 
	function stripUSA(address, country)
	{
		if (address && country === "US")
		{
			return address.replace(", USA", "");
		}
		
		return address;
	}
}])




/************************************************************************************
 *
 * pccRouteService
 *
 ************************************************************************************/
 
.factory("pccRouteService", ["$rootScope", "pccSettings", "pccMapService",
		 function($rootScope, pccSettings, pccMapService)
{
	var service		= {};
	var directions	= new google.maps.DirectionsService();

	
	/********************************************************************************
	 * public getRoute
	 *
	 * 
	 ********************************************************************************/
	 
	service.getRoute = function(arrayOfMarkers)
	{
		// start a busy indicator
		$rootScope.$emit("handleStartSpinner");
		
		var count		= arrayOfMarkers.length;
 		var startPoint	= arrayOfMarkers[0].position;
 		var endPoint	= arrayOfMarkers[count - 1].position;
		var midPoints	= [];

		for (var i = 1; i < count - 1; i++)
		{
			var waypoint =
			{
 				location:	arrayOfMarkers[i].position
			}
			
			midPoints.push(waypoint);
		}

		var request =
		{
			origin:				startPoint,
			destination:		endPoint,
			travelMode:			google.maps.TravelMode.DRIVING,
			waypoints:			midPoints
		}
		
		directions.route(request, function(response, status)
		{
			switch (status)
			{
				case google.maps.DirectionsStatus.OK:
					$rootScope.$emit("handleRouteResult", response);
					break;
					
// 				case google.maps.DirectionsStatus.ZERO_RESULTS:
// 				case google.maps.DirectionsStatus.MAX_WAYPOINTS_EXCEEDED:
// 				case google.maps.DirectionsStatus.OVER_QUERY_LIMIT:
// 				case google.maps.DirectionsStatus.UNKNOWN_ERROR:
// 				case google.maps.DirectionsStatus.REQUEST_DENIED:
// 				case google.maps.DirectionsStatus.INVALID_REQUEST:
				default:
					$rootScope.$emit("handleRouteError", status);
     				break;
    		}
		
			// stop a busy indicator
			$rootScope.$emit("handleStopSpinner");
		});
	}


	return service;
}])




/************************************************************************************
 *
 * pccCoverageService
 *
 ************************************************************************************/
 
.factory('pccCoverageService', ['$rootScope', '$sce', '$http', 'pccSettings', 'pccMapService', function($rootScope, $sce, $http, pccSettings, pccMapService)
{
	var service = {};


	/********************************************************************************
	 * public getCoverage
	 *
	 * 
	 ********************************************************************************/
	 
	service.getCoverage = function(marker)
	{
//		$rootScope.$emit("handleStartSpinner");

		var position	= marker.position;
		var country;
		if(marker.location)
		{
			country		= marker.location.country;
		}
		
 		var url			= "https://maps.t-mobile.com/Rest/pcc-getcoverage.php?point=" + position.toUrlValue();
// 		var url			= "http://10.154.95.112:8080/Rest/pcc-getcoverage.php?point=" + position.toUrlValue();
		
		if (window.XDomainRequest)
		{
			xdr = new XDomainRequest();
			if (xdr)
			{
				xdr.onerror		= onError;
				xdr.ontimeout	= onError;
				xdr.onload		= onSuccess;
				xdr.open("get", url);
				xdr.send();
			}
		}
		else 
		{ 
			$http.get(url)
			.success(function(results)
			{
				handleResult(results);
			})
			.error(function()
			{
				onError();
			});
		}
		

		function onSuccess()
		{
			var results = JSON.parse( xdr.responseText);
			handleResult(results);
		}
		

		function onError()
		{	
			$rootScope.$emit("handleCoverageError", position);
			$rootScope.$emit("handleStopSpinner");
		}

		function handleResult(results)
		{	
			if (results.response)
			{
				var has700			= parseCoverage(results.response, country, false);
				var has600			= parseCoverage(results.response, country, true);

				var coverageArray	= {has700:has700, has600:has600, raw:results.response};
				var speedtest		= parseSpeedtest(results.response);
				var technologyDetailsArray		= parseTechnologyDetails(results.response, country);

				console.log("Coverage results: " + results.response);
								
				$rootScope.$emit("handleCoverageResult", marker, coverageArray, speedtest, technologyDetailsArray);
			}
			else
			{
				$rootScope.$emit("handleCoverageError", position);
			}
				
			$rootScope.$emit("handleStopSpinner");
		}		
		
	}
	
	
	function hasExtendedRangeLTE(arrayName, elementName) {
	    for (var i = 0; i < arrayName.length; i++) {
	        if (arrayName[i] === elementName) {
	            return true;
	        }
	    }
	    return false;
	}
	
	
	service.getCoverageForMode = function(coverageArray, coverageMode)
	{
		if (coverageArray)
		{
			switch (coverageMode)
			{
				case "has700":
				case "has600":
					return coverageArray[coverageMode];

				default:
					return coverageArray["has700"];
			}
		}
		
		return null;
	}

	return service;


	function parseTechnologyDetails(codedString, country)
	{
		
		// extract radio types and signal levels from codedString
		var	signal2G			= +codedString.charAt(0);
		var signal3G			= +codedString.charAt(1);
		var signal4G			= +codedString.charAt(2) === 1 ? signal3G : 0;
		var signalBand4			= +codedString.charAt(3);
		var signalBand2			= +codedString.charAt(4);
		var signalBand12		= +codedString.charAt(5);
		var signalBand71		= +codedString.charAt(23);
		var roamSignal			= +codedString.charAt(7);
		var roamType			= +codedString.charAt(8);
		var verifiedType		= +codedString.charAt(9);
		var coverageDiffValue	= +codedString.charAt(20) ? +codedString.charAt(20) : 0;
		var signalU1900			= +codedString.charAt(21);
		var signalU2100			= +codedString.charAt(22);
		

		var flags				= pccSettings.flags;

		var typeSignalStrengthArray = [];
		if (flags.hasLTE && signalBand4 > 0)
		{
			var typeSignal = buildSignalStrength("type-LTE2100", signalBand4);
			typeSignalStrengthArray.push(typeSignal);
		}
		if (flags.hasLTE && signalBand2 > 0)
		{
			var typeSignal = buildSignalStrength("type-LTE1900", signalBand2);
			typeSignalStrengthArray.push(typeSignal);
		}
		if (flags.hasLTE && signalBand12 > 0)
		{
			var typeSignal = buildSignalStrength("type-LTE700", signalBand12);
			typeSignalStrengthArray.push(typeSignal);
		}
		if (flags.hasLTE && signalBand71 > 0)
		{
			var typeSignal = buildSignalStrength("type-LTE600", signalBand71);
			typeSignalStrengthArray.push(typeSignal);
		}
		if (flags.has4G && (signal3G > 0 || signal4G))
		{
			if (signalU2100 > 0)
			{
				var typeSignal = buildSignalStrength("type-3G-4G-U2100", signalU2100);
				typeSignalStrengthArray.push(typeSignal);
			}
			if (signalU1900 > 0)
			{
				var typeSignal = buildSignalStrength("type-3G-4G-U1900", signalU1900);
				typeSignalStrengthArray.push(typeSignal);
			}
		} 
		if (flags.has3G && signal3G > 0 && !flags.has4G) //only for 3G map
		{
			if (signalU2100 > 0)
			{
				var typeSignal = buildSignalStrength("type-3G-U2100", signalU2100);
				typeSignalStrengthArray.push(typeSignal);
			}
			if (signalU1900 > 0)
			{
				var typeSignal = buildSignalStrength("type-3G-U1900", signalU1900);
				typeSignalStrengthArray.push(typeSignal);
			}
		}
		if (flags.has2G && signal2G > 0)
		{
			var typeSignal = buildSignalStrength("type-2G-GSM", signal2G);
			typeSignalStrengthArray.push(typeSignal);
		} 
		if ((flags.hasRoam && roamType > 1) || (flags.hasPrepaidRoam && roamType === 1))
		{
			if ((country === "US" && flags.hasDomesticRoam) ||
				(country === "PR" && flags.hasDomesticRoam) ||
				(country === "VI" && flags.hasDomesticRoam) ||
				(country === "CA" && flags.hasCanadaRoam)	||
				(country === "MX" && flags.hasMexicoRoam))
			{
				var typeSignal = buildSignalStrength(roamType, roamSignal);
				typeSignalStrengthArray.push(typeSignal);
			}
		}
		return typeSignalStrengthArray;
	}
	
	function buildSignalStrength(type, strength)
	{
		var typeSignal	=
		{
			"type":				type,
			"type-text":		pccSettings.labels[type],
			"strength":     	strength
		}
		
		return typeSignal;
	}

	/********************************************************************************
	 * private parseCoverage
	 *
	 * 
	 ********************************************************************************/
	 
	function parseCoverage(codedString, country, includeBand71)
	{
		function bestLTE(band4, band2, band12, band71)
		{
			for (var i = 1; i <= 4; i++)
			{
				if (band4 === i || band2 === i || band12 === i || band71 === i)
					return i;
			}
			
			return 0;
		}
		
		
		// extract radio types and signal levels from codedString
		var	signal2G			= +codedString.charAt(0);
		var signal3G			= +codedString.charAt(1);
		var signal4G			= +codedString.charAt(2) === 1 ? signal3G : 0;
		var signalBand4			= +codedString.charAt(3);
		var signalBand2			= +codedString.charAt(4);
		var signalBand12		= +codedString.charAt(5);
		var signalBand71		= includeBand71 ? +codedString.charAt(23) : 0;
		var signalLTE			= bestLTE(signalBand4, signalBand2, signalBand12, signalBand71);
		var roamSignal			= +codedString.charAt(7);
		var roamType			= +codedString.charAt(8);
		var verifiedType		= +codedString.charAt(9);
		var coverageDiffValue	= +codedString.charAt(20) ? +codedString.charAt(20) : 0;

		var flags				= pccSettings.flags;

		// return a coverage structure for the best radio type supported by the map instance
		// e.g. LTE > 4G > 3G > 2G > Roam > None
		if (flags.hasLTE && signalLTE > 0)
		{
			var coverage = buildCoverage("type-LTE", signalLTE, verifiedType === 1, coverageDiffValue);
			
			// for LTE radio type, also include an array of available bands 
			coverage.bands	= [];
			if (signalBand4  > 0) {coverage.bands.push("lteBand4");}
			if (signalBand2  > 0) {coverage.bands.push("LTE-1900Band2");}
			if (signalBand12 > 0) {coverage.bands.push("LTE-700Band12");}
			if (signalBand71 > 0) {coverage.bands.push("LTE-600Band71");}
			
			// set a flag if there is no traditional LTE at this location
			coverage.hasNewBands = coverage.bands[0] != "lteBand4";
			
			return coverage;
		}
		else if (flags.has4G && signal4G > 0)
		{
			return buildCoverage("type-4G", signal4G, verifiedType === 2, coverageDiffValue);
		} 
		else if (flags.has3G && signal3G > 0)
		{
			return buildCoverage("type-3G", signal3G, verifiedType === 2, coverageDiffValue);
		} 
		else if (flags.has2G && signal2G > 0)
		{
			return buildCoverage("type-2G", signal2G, verifiedType === 3, coverageDiffValue);
		} 
		else if ((flags.hasRoam && roamType > 1) || (flags.hasPrepaidRoam && roamType === 1))
		{
			if ((country === "US" && flags.hasDomesticRoam) ||
				(country === "PR" && flags.hasDomesticRoam) ||
				(country === "VI" && flags.hasDomesticRoam) ||
				(country === "CA" && flags.hasCanadaRoam)	||
				(country === "MX" && flags.hasMexicoRoam))
			{
				return buildPartnerCoverage(roamType, roamSignal, coverageDiffValue);
			}
		}
		
		return buildNoneCoverage(coverageDiffValue);
	}
	
	
	/********************************************************************************
	 * private buildCoverage
	 *
	 * 
	 ********************************************************************************/
	 
	function buildCoverage(type, strength, isVerified, coverageDiffValue)
	{
		var coverage	=
		{
			"type":				type,
			"type-text":		pccSettings.labels[type],
			"type-head":		pccSettings.labels["subhead-" + type],
			"type-desc":		pccSettings.labels["description-" + type],
            "strength":     	strength,
 			"strength-text":	pccSettings.labels["strength-" + strength],
			"strength-desc":	pccSettings.labels["description-" + strength],
			"verified":			pccSettings.flags["hasVerified"] && isVerified,
			"coverageDiffValue": coverageDiffValue
		}
		
		return coverage;
	}


	/********************************************************************************
	 * private buildPartnerCoverage
	 *
	 * 
	 ********************************************************************************/
	 
	function buildPartnerCoverage(roamType, strength, coverageDiffValue)
	{
		var keyArray	=		["type-none", "type-roamPost", "type-roam", "type-roam850", "type-roamLTE",
								 "type-roamNoData", "type-none", "type-none", "type-none", "type-roamCAMX"];
		var key			= 		keyArray[roamType];
		var coverage	=
		{
			"type":				key,
			"type-text":		pccSettings.labels[key],
			"type-desc":		pccSettings.labels["description-" + key],
			"coverageDiffValue": coverageDiffValue
		}
		
		if (key === "type-roamLTE" && strength > 0)
		{
			coverage["strength"]		= strength;
			coverage["strength-text"]	= pccSettings.labels["strength-" + strength];
			coverage["strength-desc"]	= pccSettings.labels["description-" + strength];
		}
		
		return coverage;
	}
                                

	/********************************************************************************
	 * private buildNoneCoverage
	 *
	 * 
	 ********************************************************************************/
	 
	function buildNoneCoverage(coverageDiffValue)
	{
		var coverage =
		{
			"type":				"type-none",
			"type-desc":		pccSettings.labels["description-type-none"],
			"coverageDiffValue": coverageDiffValue
		}
		
		return coverage;
	}
	
	
	/********************************************************************************
	 * private parseSpeedtest
	 *
	 * 
	 ********************************************************************************/
	 
	function parseSpeedtest(codedString)
	{
		function calculateDial(speed)
		{
			var thresholds	= pccSettings.defaults["speedtestThresholds"];
			var len			= thresholds.length;
			
			for (var i = 0; i < len; i++)
			{
				if (speed < thresholds[i])
				{
					return i + 1;
				}
			}
			
			return len;
		}
		
		
		if (!pccSettings.flags["hasSpeedTest"] || codedString.substr(10, 10) === "0000000000")
		{
			return null;
		}
		
		var count	= +codedString.substr(10, 5);
		var speed	= +codedString.substr(15, 5) / 100.0;
		
		var speedtest =
		{
			"dial":				calculateDial(speed),
			"speed":			speed.toFixed(speed < 1 ? 2 : 1).toLocaleString(),
			"count":			count.toFixed(0).toLocaleString()
		}
		
		return speedtest;
	}
}])




/************************************************************************************
 *
 * pccHistoryService
 *
 ************************************************************************************/
 
.factory('pccHistoryService', ['pccSettings', function(pccSettings)
{
	var service	= {};
	service.history	= [];


	/********************************************************************************
	 * public addHistory
	 ********************************************************************************/

	service.addHistory = function(marker)
	{
		var maxHistory = pccSettings.defaults["maxHistory"];
		
		if (maxHistory > 0)
		{
			// remove any existing history entry for this marker
			service.clearHistory(marker);
		
			// add this marker to the end of the history
			service.history.push(marker);
		
			// keep the history at a reasonable length
			if (service.history.length > maxHistory)
			{
				service.history.shift();
			}
		}
	}


	/********************************************************************************
	 * public clearHistory
	 ********************************************************************************/

	service.clearHistory = function(marker)
	{
		var index = service.history.indexOf(marker);
		
		if (index >= 0)
		{
			service.history.splice(index, 1);
		}		
	}


	/********************************************************************************
	 * public clearAllHistory
	 ********************************************************************************/

	service.clearAllHistory = function()
	{
		service.history.length = 0;
	}


	return service;
}])



/************************************************************************************
 *
 * pccDeviceService
 *
 ************************************************************************************/

.factory('pccDeviceService',  ['$rootScope', '$sce', '$http', 'pccSettings', function($rootScope, $sce, $http, pccSettings)
{
	var service	= {};
	var devices = [];
	var coverageType;
	service.getDevicesForType = function(type, language, deviceList, resultHandler) //resultHandler can be either in devicelistPopController or DeviceSelectionController
	{
		var url = "https://maps.t-mobile.com/Rest/pcc-getDevicesForCoverage.php?band="+type+"&language="+language+"&devicelist="+deviceList;
		
		if(devices.length == 0 || coverageType !== type)
		{
			$http.get(url)
			.success(function(results)
			{	
				if(results["error"])
				{
					console.log("error... devicelist file not found ");
				}
				else
				{
					coverageType = type;
					devices = results;
					console.log("success device service ");
				}
				$rootScope.$emit(resultHandler,  devices);
			})
			.error(function()
			{
				console.log(" error.... device service " );	
			});
		}
		else
		{
			$rootScope.$emit(resultHandler,  devices);
		}
	}
	
	return service;
}]);
