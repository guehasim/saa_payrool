//[Dashboard Javascript]

//Project:	Hyper Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	/*--- Project Stats ---*/
    
        var projectStats = new Chartist.Line('#project-stats', {
    
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July'],
            series: [
                [25, 175, 115, 34, 75, 55, 25],
                [74, 111, 48, 76, 142, 71, 132],
                [124, 44, 75, 24, 92, 165, 0]
            ]
        }, {
                lineSmooth: Chartist.Interpolation.simple({
                    divisor: 2
                }),
                fullWidth: true,
                showArea: true,
                chartPadding: {
                    right: 35
                },
    
                axisX: {
                    showGrid: false,
                },
                axisY: {
                     labelInterpolationFnc: function (value) {
                        return value + 'k';
                    },
                    scaleMinSpace: 40,
                    showGrid: false,
                },
                plugins: [
                    Chartist.plugins.tooltip({
                        appendToBody: true,
                        pointClass: 'ct-point'
                    })
                ],
                low: 0,
                onlyInteger: true,
            });
    
        projectStats.on('created', function (data) {
            var defs = data.svg.querySelector('defs') || data.svg.elem('defs');
            defs.elem('linearGradient', {
                id: 'area-gradient',
                x1: 1,
                y1: 0,
                x2: 0,
                y2: 0
            }).elem('stop', {
                offset: 0,
                'stop-color': '#0bb2d4'
            }).parent().elem('stop', {
                offset: 1,
                'stop-color': '#E6155E'
            });
    
            return defs;
    
    
        }).on('draw', function (data) {
            var circleRadius = 9;
            if (data.type === 'point') {
                var circle = new Chartist.Svg('circle', {
                    cx: data.x,
                    cy: data.y,
                    'ct:value': data.y,
                    r: circleRadius,
                    class: data.value.y === 175 || data.value.y === 165 ? 'ct-point-circle ct-point' : 'ct-point ct-point-circle-transperent'
                });
                data.element.replace(circle);
            }
            if (data.type === 'line' || data.type == 'area') {
                data.element.animate({
                    d: {
                        begin: 1000,
                        dur: 1000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });
	
	var verticalBar = new Chartist.Bar('#vertical-bar', {
        labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5'],
        series: [
            [7458, 13548, 15428, 13548, 9542],
        ]
    }, {
            axisY: {
                labelInterpolationFnc: function (value) {
                    return (value / 1000) + 'k';
                },
                scaleMinSpace: 50,
            },
            axisX: {
                showGrid: false
            },
            plugins: [
                Chartist.plugins.tooltip({
                    appendToBody: true
                })
            ]
        });
    verticalBar.on('draw', function (data) {
        if (data.type === 'bar') {
            data.element.attr({
                style: 'stroke-width: 30px',
                y1: 350,
                x1: data.x1 + 0.001
            });
            data.group.append(new Chartist.Svg('circle', {
                cx: data.x2,
                cy: data.y2,
                r: 15
            }, 'ct-slice-pie'));
        }
    });
	
	
	var plot = $.plot('#flotChart', [{
          data: flotSampleData3,
          color: '#E6155E',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.5 }]}
          }
        },{
          data: flotSampleData4,
          color: '#7231F5',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.5 }]}
          }
        }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 8
          },
    			yaxis: {
            			show: true,
    					min: 0,
    					max: 100,
            			ticks: [[0,''],[20,'20K'],[40,'40K'],[60,'60K'],[80,'80K']],
            			tickColor: 'rgba(0, 0, 0, 0.10)',
						font: {
							color: '#333333'
						  }
    			},
    			xaxis: {
            			show: true,
            			color: 'rgba(0, 0, 0, 0.10)',
            			ticks: [[25,'OCT 21'],[75,'OCT 22'],[100,'OCT 23'],[125,'OCT 24']],
						font: {
							color: '#333333'
						  }
          }
        });

        	
	// [ Widget-line-chart ] start
    var chartDatac = [{
        "day": "Mon",
        "value": 60
    }, {
        "day": "Tue",
        "value": 45
    }, {
        "day": "Wed",
        "value": 70
    }, {
        "day": "Thu",
        "value": 55
    }, {
        "day": "Fri",
        "value": 70
    }, {
        "day": "Sat",
        "value": 55
    }, {
        "day": "Sun",
        "value": 70
    }];
    var chartc = AmCharts.makeChart("Widget-line-chart", {
        "type": "serial",
        "addClassNames": true,
        "defs": {
            "filter": [{
                    "x": "-50%",
                    "y": "-50%",
                    "width": "200%",
                    "height": "200%",
                    "id": "blur",
                    "feGaussianBlur": {
                        "in": "SourceGraphic",
                        "stdDeviation": "30"
                    }
                },
                {
                    "id": "shadow",
                    "x": "-10%",
                    "y": "-10%",
                    "width": "120%",
                    "height": "120%",
                    "feOffset": {
                        "result": "offOut",
                        "in": "SourceAlpha",
                        "dx": "0",
                        "dy": "20"
                    },
                    "feGaussianBlur": {
                        "result": "blurOut",
                        "in": "offOut",
                        "stdDeviation": "10"
                    },
                    "feColorMatrix": {
                        "result": "blurOut",
                        "type": "matrix",
                        "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                    },
                    "feBlend": {
                        "in": "SourceGraphic",
                        "in2": "blurOut",
                        "mode": "normal"
                    }
                }
            ]
        },
        "fontSize": 15,
        "dataProvider": chartDatac,
        "autoMarginOffset": 0,
        "marginRight": 0,
        "categoryField": "day",
        "categoryAxis": {
            "color": '#fff',
            "gridAlpha": 0,
            "axisAlpha": 0,
            "lineAlpha": 0,
            "offset": -20,
            "inside": true,
        },
        "valueAxes": [{
            "fontSize": 0,
            "inside": true,
            "gridAlpha": 0,
            "axisAlpha": 0,
            "lineAlpha": 0,
            "minimum": 0,
            "maximum": 100,
        }],
        "chartCursor": {
            "valueLineEnabled": false,
            "valueLineBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false,
            "valueZoomable": false,
            "cursorColor": "#fff",
            "categoryBalloonColor": "#51b4e6",
            "valueLineAlpha": 0
        },
        "graphs": [{
            "id": "g1",
            "type": "line",
            "valueField": "value",
            "lineColor": "#ffffff",
            "lineAlpha": 1,
            "lineThickness": 3,
            "fillAlphas": 0,
            "showBalloon": true,
            "balloon": {
                "drop": true,
                "adjustBorderColor": false,
                "color": "#ffffff",
                "fillAlphas": 0.2,
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
            }
        }],
    });
    // [ Widget-line-chart ] end
	
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




                


