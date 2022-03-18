/************************************************************************************
 *
 * pccDirective Module
 *
 ************************************************************************************/
 
angular.module("pccDirective", ["pccConfig"])
.value("version", "5.3")

.directive('windowresize', function ($rootScope, $window) {
    return function (scope, element) {
        var win = angular.element($window);
        
		scope.getWindowDimensions = function () {
            return {
                'height': win[0].innerHeight,
                'width': win[0].innerWidth
            };
        };

        scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {
			$rootScope.mobileSizeMode = (newValue.width<=723);
			$rootScope.$emit("handleMobileSizeMode");
        }, true);
    }
})

.directive('pccsliderscroll', function()
{
	return function(scope, element, attrs)
	{
		element.bind("scroll",function()
		{
			scope.$emit("handleSliderScroll");
		});
	}
})

.directive('pie', function()
{
	return function($scope, element, attrs, model)
	{
		if (window.PIE)
		{
			PIE.attach(element[0]);
		}
	}
})

.directive('pccautocomplete', function ($parse, $http, $timeout, $sce, pccSettings) {
	return {
		templateUrl : 'pcc/fragments/pccautocomplete.html',
		restrict : 'EA',
		scope : {
			"id" : "@id",
			"placeholder" : "@placeholder",
			"selectedObject" : "=selectedobject",
			"searchStr": "=model",
			"inputClass" : "@inputclass",
			"searchtext" : "&",
			"searchplace" : "&",
			"ghistory": "=history",
			"searchistory": "&"
		},
		controller : function ($scope) {
			$scope.lastFoundWord = null;
			$scope.currentIndex = null;
			$scope.justChanged = false;
			$scope.searchTimer = null;
			$scope.searching = false;
			$scope.results = [];
			$scope.history = [];
			$scope.searchPlaceFlag = false;			
			$scope.labels = pccSettings.labels;
			
			$scope.updateSelections = function(result){
			
				if($scope.selectedObject){
					$scope.selectedObject = result;
				}
			}
			
			$scope.hoverRow = function (index) {				
				//console.log("......... on hoverRow..................");
			};
			$scope.onBlur = function (event) {
			
				$timeout(function(){ 
						if($scope.infocus != true)
							$scope.showDropdown = false; 
							
						$scope.searchPlaceFlag = false;			
					}, 400);				
			};			
			
			$scope.selectResult = function(event, result) {		
				
				$scope.updateSelections(result);
				$scope.searchStr = result.description;
				$scope.showDropdown = false;
				$scope.results = [];
				$scope.history = [];
				$scope.searchPlaceFlag = true;			
				
				var service = new google.maps.places.PlacesService(document.getElementById('pServiceDiv'));
				service.getDetails({ placeId : result.originalObject.place_id}, function(PlaceResult, status){
				
					if (status != google.maps.places.PlacesServiceStatus.OK) {
						return;
					}
					if(!angular.isUndefined($scope.searchplace)){					
						$scope.searchplace({place: PlaceResult});					
					}
					$scope.blurFlag = false;
				});
			}
			
			$scope.selectHistory = function(event, result) {		

				$scope.updateSelections(result);
				$scope.searchStr = result.description;
				$scope.showDropdown = false;
				$scope.results = [];
				$scope.history = [];				
				$scope.searchPlaceFlag = true;			
				
				if(!angular.isUndefined($scope.searchistory)){
					$scope.searchistory({marker: result.originalObject});	
				}				
				$scope.blurFlag = false;
			
			}
		},
		link : function ($scope, elem, attrs, ctrl) {

			var input = elem.find('input');
						
			input.bind('focus', function (event) {
				
				updateHistory();
				$scope.showDropdown = true;
				$scope.$apply();
				
				if(!(event.target.getAttribute("keyboard") == "true")){
				
					var texBox = input[0]; 
					setTimeout(function()
					{
						if (typeof texBox.setSelectionRange === "function")	{
							texBox.setSelectionRange(0, texBox.value.length);
						} else {
							texBox.select();
						}
					});	
				}
			
				event.target.setAttribute("keyboard", "false");
				
				$scope.infocus = true;
				$timeout(function(){ 
					$scope.infocus = false;
				}, 300);
				
				if(event.target.value != $scope.searchStr){
					$scope.searchStr = event.target.value;
					processInput();					
				}
			});
			
			elem.bind('blur', function(event) {
				$scope.onBlur(event);
			});
			
			elem.bind("keyup", function (event) {		
				
				var keyCode = event.which ? event.which : event.keyCode;
				
				if (keyCode === 40) {
					if (($scope.currentIndex + 1) < ($scope.results.length + $scope.history.length)) {
						$scope.currentIndex++;
						$scope.$apply();
						event.preventDefault;
						event.stopPropagation();
					}
					$scope.$apply();
				} else if (keyCode == 38) {
					if ($scope.currentIndex >= 1) {
						$scope.currentIndex--;
						$scope.$apply();
						event.preventDefault;
						event.stopPropagation();
					}
				} else if (keyCode == 13) {
					if ($scope.currentIndex >= 0 && $scope.currentIndex < ($scope.results.length + $scope.history.length)) {
						if($scope.currentIndex < $scope.results.length){
							$scope.selectResult(event, $scope.results[$scope.currentIndex]);
						} else{
							$scope.selectHistory(event, $scope.history[$scope.currentIndex - $scope.results.length] );
						}
						$scope.$apply();
						event.preventDefault;
						event.stopPropagation();
					} else {
						$scope.results = [];
						$scope.showDropdown = false;
						$scope.$apply();
						event.preventDefault;
						event.stopPropagation();
						$scope.onBlur(event);
						$scope.showDropdown = false; 
						$scope.searchtext({text: event.target.value});						
					}
				} else if (keyCode == 27) {
					$scope.results = [];
					$scope.showDropdown = false;
					$scope.$apply();
				} else if (!(keyCode == 38 || keyCode == 40 || keyCode == 27)) {
				
					processInput();
				} else {
					event.preventDefault();
				}
			});
			
			function processInput(){				
					
				updateHistory();
				
				$scope.showDropdown = true;
				$scope.currentIndex = -1;
				$scope.results = [];
				
				if (!$scope.searchStr || $scope.searchStr == "") {		
							
					$scope.$apply();	
				} else {		
								
					getPredictions($scope.searchStr);
				}
			}
			
			function updateHistory() {
				
				if(!angular.isUndefined($scope.ghistory)){
				
					$scope.history = [];
					for (var i = 0; i < $scope.ghistory.length; i++) {
						
						var item = $scope.ghistory[i];
						if(!angular.isUndefined(item.location)){
							var resultRow = {
								title 			: item.location.address,
								description 	: item.location.address,
								image 			: null,
								originalObject :item
							}
							$scope.history.push(resultRow);			
						}
					}
					$scope.$apply();
				}				
			};
			
			function formatDescription(prediction, match){
				var desc = "";
				var matchFound = false;
				if(prediction && match){
					var regEx = new RegExp(match, "ig");
					for(i = 0; i < prediction.terms.length; i++){
						var matches = prediction.terms[i].value.match(regEx);
						if(matchFound == false && matches){
							var newTerm = "<span class='pccSearchMatchedText'>" + prediction.terms[i].value + "</span>";
							desc += newTerm.replace(matches[0], '<b>' + matches[0] + '</b>');
							matchFound = true;
						} else{
							desc += "<span class='pccSearchPredictedText'>" + prediction.terms[i].value + "</span>";
						}
						if(i < (prediction.terms.length - 1))
							desc += ", ";
					}
				} 
				return desc;
			}
			
			function processResults(responseData) {
				$scope.results = [];
				if (responseData && responseData.length > 0) {					
					for (var i = 0; i < responseData.length; i++) {		

						var desc = formatDescription( responseData[i], $scope.searchStr);
						var resultRow = {
							title : responseData[i].description,
							description : responseData[i].description,
							rowContent: desc,
							image : null,
							originalObject : responseData[i]
						}
						$scope.results.push(resultRow);						
					}
					$scope.$apply();					
				} else {
					$scope.results = [];
				}
			};
			
			function getPredictions(input) {			
				var service = new google.maps.places.AutocompleteService();
				var bias	= pccSettings.defaults["searchBias"];
				service.getPlacePredictions({
						input : input,
						componentRestrictions: {country: bias}
					}, function (predictions, status) {				
						if (status != google.maps.places.PlacesServiceStatus.OK) {
							return;
						}
					processResults(predictions);
				});
			};
		}
	};
})

.directive('virtualkeyboard', function ($parse, $http, $timeout) {
return {
		templateUrl : 'pcc/fragments/keyboard.html',
		restrict : 'A',
		transclude: true,
		scope : {
			"id" : "@id",
			"virtualkeyboard" : "@",
			"togglekeyboard": "=togglekeyboard"
		},
		controller : function ($scope) {		
			$scope.showKeyboard = false;				
			$scope.currentInputElement = null;
			$scope.activeKey = null;
			
			$scope.hideKeyboard = function(){
				$scope.showKeyboard = false;
				//event.stopPropagation();
			};					
			$scope.keyPressed = function(event){
				
				setTimeout( function(){
					
					$scope.currentInputElement.setAttribute("keyboard", "true");
				
					$scope.currentInputElement.focus();	
					var value = event.target.getAttribute("value");
					
					if(value && $scope.activeKey != value){
					
						$scope.activeKey = value;
						
						var val = $scope.currentInputElement.value; 
						var selection = getInputSelection($scope.currentInputElement);
							
						if(value == "Backspace")
						{
							$scope.currentInputElement.value = val.substring(0, val.length - 1);
								
							/* if(selection && selection.start == val.length ){
								$scope.currentInputElement.value = val.substring(0, val.length - 1);
							} else if(selection && selection.end > selection.start ){
								var charAry = val.split("");
								charAry.splice(selection.start, (selection.end - selection.start));
								var newValue = charAry.join("");
								$scope.currentInputElement.value = newValue;
							} else if (selection && selection.end == selection.start){
								var charAry = val.split("");
								charAry.splice(selection.start, 1);
								var newValue = charAry.join("");
								$scope.currentInputElement.value = newValue;
							}  */
							
						} else {							

							$scope.currentInputElement.value += value;
							/* if(selection && selection.start == val.length ){
								console.log(".... adding to iput bvalue ");
								$scope.currentInputElement.value += value;					
							} else if(selection && selection.end > selection.start){
								var charAry = val.split("");
								charAry.splice(selection.start, (selection.end - selection.start));
								var newValue = charAry.join("");
								var output = [newValue.slice(0, selection.start), value, newValue.slice(selection.start)].join('');
								$scope.currentInputElement.value = output;	
							} else if (selection && selection.end == selection.start){
								var output = [val.slice(0, selection.start), value, val.slice(selection.start)].join('');
								$scope.currentInputElement.value = output;	
							} else {
								
							} */
							
						}
						angular.element($scope.currentInputElement).triggerHandler('input');
						angular.element($scope.currentInputElement).triggerHandler('change');
						
						setTimeout( function(){ 
							$scope.activeKey = null;
						}, 200);
					}
				}, 100);
			};
			
			function getInputSelection(el) {    
				var start = 0, end = 0, normalizedValue, range, textInputRange, len, endRange;

				if (typeof el.selectionStart == "number" && typeof el.selectionEnd == "number") {
					start = el.selectionStart;
					end = el.selectionEnd;
				} else {
					range = document.selection.createRange();

					if (range && range.parentElement() == el) {
						len = el.value.length;
						normalizedValue = el.value.replace(/\r\n/g, "\n");

						// Create a working TextRange that lives only in the input
						textInputRange = el.createTextRange();
						textInputRange.moveToBookmark(range.getBookmark());

						// Check if the start and end of the selection are at the very end
						// of the input, since moveStart/moveEnd doesn't return what we want
						// in those cases
						endRange = el.createTextRange();
						endRange.collapse(false);

						if (textInputRange.compareEndPoints("StartToEnd", endRange) > -1) {
							start = end = len;
						} else {
							start = -textInputRange.moveStart("character", -len);
							start += normalizedValue.slice(0, start).split("\n").length - 1;

							if (textInputRange.compareEndPoints("EndToEnd", endRange) > -1) {
								end = len;
							} else {
								end = -textInputRange.moveEnd("character", -len);
								end += normalizedValue.slice(0, end).split("\n").length - 1;
							}
						}
					}
				}
				
				var selection = {
					start: start,
					end: end
				};
				
				return selection;
			}
			
		},
		link : function ($scope, elem, attrs, ctrl) {
			
			$scope.$watch('togglekeyboard', function(val){
				console.log("***************************** watching show keyboard *****************");
				console.log($scope.togglekeyboard);
					$scope.showKeyboard = false;
				
			}); 
			 
			if($scope.virtualkeyboard == 'true'){
					
				$scope.$watch(
					function () { return elem; }, 
					function(elem){
					
						setTimeout(function()
						{
							var allinputs = elem[0].getElementsByTagName("input");
							var array = [];
							// iterate backwards ensuring that length is an UInt32
							for (var i = allinputs.length >>> 0; i--;) { 
								array[i] = allinputs[i];
							}
							inputList = array;						
							
							for(var i = 0; i < allinputs.length; i++){
								var textBox = angular.element(allinputs[i]);
								
								if(textBox.attr('type') == 'text'){
										
									allinputs[i].onfocus = function(){
										//alert("on focus fired");
										$scope.currentInputElement = this;
										
										if(!$scope.showKeyboard)
										{											
											$scope.showKeyboard = true;
											$scope.$apply();
										}
									}
		
									/* textBox.bind("focus", function(event){
										//console.log("........... keyboard binding input focus..............." + event.target.id);
										////console.log(textBox);							
										
										$scope.currentInputElement = event.target;
										event.target.setAttribute("keyboard", true);
										
										if(!$scope.showKeyboard)
										{
											$scope.showKeyboard = true;
											$scope.$apply();
										}
									}); */
								}
							}
						}, 300);
				});			
			}
		}
	};
})


//Adding below directive to bind the educational tile info into the bubble popup.
//The issue with ng-bind-html is that it isn't compiling the html included (angular isn't parsing it to find ng-clicks)
//So, below compile directive can bind the content, and compiles it.
.directive('compile', ['$compile', function ($compile) 
{
      return function(scope, element, attrs) 
      {
          var ensureCompileRunsOnce = scope.$watch(
            function(scope) 
            {
               // watch the 'compile' expression for changes
              return scope.$eval(attrs.compile);
            },
            function(value) 
            {
              // when the 'compile' expression changes
			  // assign it into the current DOM
              element.html(value);

              // compile the new DOM and link it to the current
              // scope.
              // NOTE: we only compile .childNodes so that
              // we don't get into infinite loop compiling ourselves
              $compile(element.contents())(scope);
                
              // Use Angular's un-watch feature to ensure compilation only happens once.
              ensureCompileRunsOnce();
            }
        );
    };
}]);