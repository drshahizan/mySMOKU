$(function(){
    "use strict";

    // BASIC CANDLESTICK
    $(document).ready(function() {
        var options = {
            chart: {
                height: 423,
                type: 'candlestick',
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                candlestick: {
                    colors: {
                        upward: '#FFA117',
                        downward: '#85888a',
                    },
                    wick: {
                        useFillColor: true
                    }
                }
            },

            series: [{
                data: [{
                    x: new Date(1538778600000),
                    y: [6629.81, 6650.5, 6623.04, 6633.33]
                    },{
                    x: new Date(1538780400000),
                    y: [6632.01, 6643.59, 6620, 6630.11]
                    },{
                    x: new Date(1538782200000),
                    y: [6630.71, 6648.95, 6623.34, 6635.65]
                    },{
                    x: new Date(1538784000000),
                    y: [6635.65, 6651, 6629.67, 6638.24]
                    },{
                    x: new Date(1538785800000),
                    y: [6638.24, 6640, 6620, 6624.47]
                    },{
                    x: new Date(1538787600000),
                    y: [6624.53, 6636.03, 6621.68, 6624.31]
                    },{
                    x: new Date(1538789400000),
                    y: [6624.61, 6632.2, 6617, 6626.02]
                    },{
                    x: new Date(1538791200000),
                    y: [6627, 6627.62, 6584.22, 6603.02]
                    },{
                    x: new Date(1538793000000),
                    y: [6605, 6608.03, 6598.95, 6604.01]
                    },{
                    x: new Date(1538794800000),
                    y: [6604.5, 6614.4, 6602.26, 6608.02]
                    },{
                    x: new Date(1538796600000),
                    y: [6608.02, 6610.68, 6601.99, 6608.91]
                    },{
                    x: new Date(1538798400000),
                    y: [6608.91, 6618.99, 6608.01, 6612]
                    },{
                    x: new Date(1538800200000),
                    y: [6612, 6615.13, 6605.09, 6612]
                    },{
                    x: new Date(1538802000000),
                    y: [6612, 6624.12, 6608.43, 6622.95]
                    },{
                    x: new Date(1538803800000),
                    y: [6623.91, 6623.91, 6615, 6615.67]
                    },{
                    x: new Date(1538805600000),
                    y: [6618.69, 6618.74, 6610, 6610.4]
                    },{
                    x: new Date(1538807400000),
                    y: [6611, 6622.78, 6610.4, 6614.9]
                    },{
                    x: new Date(1538809200000),
                    y: [6614.9, 6626.2, 6613.33, 6623.45]
                    },{
                    x: new Date(1538811000000),
                    y: [6623.48, 6627, 6618.38, 6620.35]
                    },{
                    x: new Date(1538812800000),
                    y: [6619.43, 6620.35, 6610.05, 6615.53]
                    },{
                    x: new Date(1538814600000),
                    y: [6615.53, 6617.93, 6610, 6615.19]
                    },{
                    x: new Date(1538816400000),
                    y: [6615.19, 6621.6, 6608.2, 6620]
                    },{
                    x: new Date(1538818200000),
                    y: [6619.54, 6625.17, 6614.15, 6620]
                    },{
                    x: new Date(1538820000000),
                    y: [6620.33, 6634.15, 6617.24, 6624.61]
                    },{
                    x: new Date(1538821800000),
                    y: [6625.95, 6626, 6611.66, 6617.58]
                    },{
                    x: new Date(1538823600000),
                    y: [6619, 6625.97, 6595.27, 6598.86]
                    },{
                    x: new Date(1538825400000),
                    y: [6598.86, 6598.88, 6570, 6587.16]
                    },{
                    x: new Date(1538827200000),
                    y: [6588.86, 6600, 6580, 6593.4]
                    },{
                    x: new Date(1538829000000),
                    y: [6593.99, 6598.89, 6585, 6587.81]
                    },{
                    x: new Date(1538830800000),
                    y: [6587.81, 6592.73, 6567.14, 6578]
                    },{
                    x: new Date(1538832600000),
                    y: [6578.35, 6581.72, 6567.39, 6579]
                    },{
                    x: new Date(1538834400000),
                    y: [6579.38, 6580.92, 6566.77, 6575.96]
                    },{
                    x: new Date(1538836200000),
                    y: [6575.96, 6589, 6571.77, 6588.92]
                    },{
                    x: new Date(1538838000000),
                    y: [6588.92, 6594, 6577.55, 6589.22]
                    },{
                    x: new Date(1538839800000),
                    y: [6589.3, 6598.89, 6589.1, 6596.08]
                    },{
                    x: new Date(1538841600000),
                    y: [6597.5, 6600, 6588.39, 6596.25]
                    },{
                    x: new Date(1538843400000),
                    y: [6598.03, 6600, 6588.73, 6595.97]
                    },{
                    x: new Date(1538845200000),
                    y: [6595.97, 6602.01, 6588.17, 6602]
                    },
                ]
            }],
                
            xaxis: {
                type: 'datetime'
            },
            yaxis: {
                tooltip: {
                    enabled: true
                }
            }
        }
    
        var chart = new ApexCharts(
            document.querySelector("#apex-Crypto_statistics"),
            options
        );

        chart.render();
    });  
	
	
    var randomizeArray = function (arg) {
        var array = arg.slice();
        var currentIndex = array.length,
        temporaryValue, randomIndex;
  
        while (0 !== currentIndex) {  
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
    
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }  
        return array;
    }

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

    // topb big chart    
    var spark1 = {
        chart: {
            type: 'area',
            height: 120,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            width: 1
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        colors: ['#85888a'],
        title: {
            text: '$424,652',
            offsetX: 0,
            style: {
                fontSize: '24px',
                cssClass: 'apexcharts-yaxis-title'
            }
        },
        subtitle: {
            text: 'Ethereum',
            offsetX: 0,
            style: {
                fontSize: '14px',
                cssClass: 'apexcharts-yaxis-title'
            }
        }
    }
    var spark1 = new ApexCharts(document.querySelector("#apexspark1"), spark1);
    spark1.render();
    
    var spark2 = {
        chart: {
            type: 'area',
            height: 120,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            width: 1
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        colors: ['#85888a'],
        title: {
            text: '$235,312',
            offsetX: 0,
            style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
            }
        },
        subtitle: {
            text: 'Litecoin',
            offsetX: 0,
            style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
            }
        }
    }
    var spark2 = new ApexCharts(document.querySelector("#apexspark2"), spark2);
    spark2.render();
    
    var spark3 = {
        chart: {
            type: 'area',
            height: 120,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            width: 1
        },
        colors: ['#85888a'],
        series: [{
            data: randomizeArray(sparklineData)
        }],
        xaxis: {
            crosshairs: {
            width: 1
            },
        },
        title: {
            text: '$135,965',
            offsetX: 0,
            style: {
                fontSize: '24px',
                cssClass: 'apexcharts-yaxis-title'
            }
        },
        subtitle: {
            text: 'Bitcoin',
            offsetX: 0,
            style: {
                fontSize: '14px',
                cssClass: 'apexcharts-yaxis-title'
            }
        }
    }
    var spark3 = new ApexCharts(document.querySelector("#apexspark3"), spark3);
    spark3.render();
});