//[Dashboard Javascript]

//Project:	Hyper Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	 /*---Monthly Sales---*/
	
    if($("#monthly-sales").length > 0) {
        Morris.Bar({
            element: 'monthly-sales',
            data: [{month: 'Jan', sales: 1835 }, {month: 'Feb', sales: 2356 }, {month: 'Mar', sales: 1459 }, {month: 'Apr', sales: 1289 }, {month: 'May', sales: 1647 }, {month: 'Jun', sales: 2156 }, {month: 'Jul', sales: 1835 }, {month: 'Aug', sales: 2356 }, {month: 'Sep', sales: 1459 }, {month: 'Oct', sales: 1289 }, {month: 'Nov', sales: 1647 }, {month: 'Dec', sales: 2156 }],
            xkey: 'month',
            ykeys: ['sales'],
            labels: ['Sales'],
            barGap: 4,
            barSizeRatio: 0.3,
            gridTextColor: '#bfbfbf',
            gridLineColor: '#E4E7ED',
            numLines: 5,
            gridtextSize: 14,
            resize: true,
            barColors: ['#E6155E'],
            hideHover: 'auto',
        });
    }

    
	if($("#sparkline-1").length > 0) {	
	  // Sparkline charts
	  var myvalues = [1300, 500, 1920, 927, 831, 1127, 719, 1930, 1221];
	  $('#sparkline-1').sparkline(myvalues, {
		type     : 'line',
		lineColor: '#67757c',
		fillColor: '#7231F5',
		height   : '50',
		width    : '70'
	  });
    }

    if($("#sparkline-2").length > 0){
		myvalues = [715, 319, 620, 342, 662, 990, 730, 467, 559, 340, 881];
	    $('#sparkline-2').sparkline(myvalues, {
    		type     : 'line',
    		lineColor: '#67757c',
    		fillColor: '#E6155E',
    		height   : '50',
    		width    : '70'
	    });
    }

    if($("#sparkline-3").length > 0){
		  myvalues = [88, 49, 22,35, 45, 72, 11, 55, 25, 19, 27];
		  $('#sparkline-3').sparkline(myvalues, {
			type     : 'line',
			lineColor: '#67757c',
			fillColor: '#faa700',
			height   : '50',
			width    : '70'
		  });
    }

	//map	
    if(jQuery('#world-map-markers').length > 0) {
    	jQuery('#world-map-markers').vectorMap(
    	{
    		map: 'world_mill_en',
    		backgroundColor: 'rgba(255,255,255,0)',
    		borderColor: '#818181',
    		borderOpacity: 0.25,
    		borderWidth: 1,
    		color: '#f4f3f0',
    		regionStyle : {
    			initial : {
    			  fill : '#1e88e5'
    			}
    		  },
    		markerStyle: {
    		  initial: {
    						r: 9,
    						'fill': '#fff',
    						'fill-opacity':1,
    						'stroke': '#000',
    						'stroke-width' : 5,
    						'stroke-opacity': 0.4
    					},
    					},
    		enableZoom: true,
    		hoverColor: '#0a89c1',
    		markers : [{
    			latLng : [37.00, 96.00],
    			name : 'Text'

    		  }],
    		hoverOpacity: null,
    		normalizeFunction: 'linear',
    		scaleColors: ['#b6d6ff', '#005ace'],
    		selectedColor: '#c9dfaf',
    		selectedRegions: [],
    		showTooltip: true,
    		onRegionClick: function(element, code, region)
    		{
    			var message = 'You clicked "'
    				+ region
    				+ '" which has the code: '
    				+ code.toUpperCase();

    			alert(message);
    		}
    	});
    }


	//dashboard_daterangepicker
	
	if(0!==$("#dashboard_daterangepicker").length) {
		var n=$("#dashboard_daterangepicker"),
		e=moment(),
		t=moment();
		n.daterangepicker( {
			startDate:e, endDate:t, opens:"left", ranges: {
				Today: [moment(), moment()], Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")], "Last 7 Days": [moment().subtract(6, "days"), moment()], "Last 30 Days": [moment().subtract(29, "days"), moment()], "This Month": [moment().startOf("month"), moment().endOf("month")], "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
			}
		}
		, a),
		a(e, t, "")
	}
	function a(e, t, a) {
		var r="",
		o="";
		t-e<100||"Today"==a?(r="Today:", o=e.format("MMM D")): "Yesterday"==a?(r="Yesterday:", o=e.format("MMM D")): o=e.format("MMM D")+" - "+t.format("MMM D"), n.find(".subheader_daterange-date").html(o), n.find(".subheader_daterange-title").html(r)
	}
	
}); // End of use strict


                


