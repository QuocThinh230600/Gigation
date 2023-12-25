/* ------------------------------------------------------------------------------
 *
 *  # statistical code
 *  # Author: Quốc Tuấn <contact.quoctuan@gmail.com>
 *  Place here all your statistical js. Make sure it's loaded after statistical.js
 *
 * ---------------------------------------------------------------------------- */
let StatisticalJS = function () {
    let _componentCheckUndefined = function (file) {
        if (domainPath === "http://localhost:8000" || domainPath === "http://127.0.0.1:8000") {
            console.warn(lang.translate('warning_load_js') + ' ' + file + '.js ' + lang.translate('js_not_load'));
        }
    };

    let _componentStatisticalBrowser = function () {
        if (typeof echarts == 'undefined') {
            _componentCheckUndefined('echarts.min.');
        }

        // Define element
        var pie_basic_element = document.getElementById('pie_basic'),
            browser = $("#pie_basic").data('browser'),
            topbrowser = $("#pie_basic").data('topbrowser');

        topbrowser = JSON.parse(JSON.stringify(topbrowser).split('"browser":').join('"name":').split('"sessions":').join('"value":'));


        if (pie_basic_element) {

            // Initialize chart
            var pie_basic = echarts.init(pie_basic_element);

            // Options
            pie_basic.setOption({

                // Colors
                color: [
                    '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                    '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                    '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                    '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089',
                    '#66bb6a'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: 'Browser popularity',
                    subtext: 'Open source information',
                    left: 'center',
                    textStyle: {
                        fontSize: 17,
                        fontWeight: 500,
                        color: '#fff'
                    },
                    subtextStyle: {
                        fontSize: 12,
                        color: '#fff'
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(255,255,255,0.9)',
                    padding: [10, 15],
                    textStyle: {
                        color: '#222',
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'horizontal',
                    bottom: 0,
                    data: browser,
                    itemHeight: 8,
                    itemWidth: 8,
                    textStyle: {
                        color: '#fff'
                    }
                },

                // Add series
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 2,
                            borderColor: '#353f53'
                        }
                    },
                    data: topbrowser
                }]
            });
        }

        // Resize function
        var triggerChartResize = function () {
            pie_basic_element && pie_basic.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelector('.sidebar-control');
        sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };

    let _componentVisitedPage = function () {
        if (typeof echarts == 'undefined') {
            _componentCheckUndefined('echarts.min.');
        }

        // Define element
        var pie_donut_element = document.getElementById('pie_donut'),
            type = $("#pie_donut").data('type'),
            visitedPages = $("#pie_donut").data('visitedpages');

        visitedPages = JSON.parse(JSON.stringify(visitedPages).split('"type":').join('"name":').split('"sessions":').join('"value":'));


        if (pie_donut_element) {

            // Initialize chart
            var pie_donut = echarts.init(pie_donut_element);

            // Options
            pie_donut.setOption({

                // Colors
                color: [
                    '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                    '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                    '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                    '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: 'Browser popularity',
                    subtext: 'Open source information',
                    left: 'center',
                    textStyle: {
                        fontSize: 17,
                        fontWeight: 500,
                        color: '#fff'
                    },
                    subtextStyle: {
                        fontSize: 12,
                        color: '#fff'
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(255,255,255,0.9)',
                    padding: [10, 15],
                    textStyle: {
                        color: '#222',
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'horizontal',
                    bottom: 0,
                    data: type,
                    itemHeight: 8,
                    itemWidth: 8,
                    textStyle: {
                        color: '#fff'
                    }
                },

                // Add series
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 2,
                            borderColor: '#353f53'
                        }
                    },
                    data: visitedPages
                }]
            });
        }

        // Resize function
        var triggerChartResize = function () {
            pie_donut_element && pie_donut.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelector('.sidebar-control');
        sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };

    var _componentVectorMaps = function () {
        if (!$().vectorMap) {
            _componentCheckUndefined('jvectormap.min.');
        }

        var nation = $("#map-national").data("nation");

        console.log(nation);

        $('.map-choropleth').vectorMap({
            map: 'world_mill_en',
            backgroundColor: 'transparent',

            series: {
                regions: [{
                    values: gdpData,
                    scale: ['#C8EEFF', '#0071A4'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionLabelShow: function (e, el) {
                if (typeof nation[el.html()] == 'undefined') {
                    el.html(el.html());
                } else {
                    el.html(el.html() + '<br>' + 'View: ' + nation[el.html()]);
                }

            }
        });
    }

    var _componentTotalVisitor = function () {
        if (!$().vectorMap) {
            _componentCheckUndefined('jvectormap.min.');
        }

        // Define element
        var columns_basic_element = document.getElementById('columns_basic'),
            date = $("#columns_basic").data('date'),
            page = $("#columns_basic").data('page'),
            visitor = $("#columns_basic").data('visitor');

        console.log(date);


        if (columns_basic_element) {

            // Initialize chart
            var columns_basic = echarts.init(columns_basic_element);

            // Options
            columns_basic.setOption({

                // Define colors
                color: ['#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 40,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Page View', 'Visitor'],
                    itemHeight: 8,
                    itemGap: 20,
                    textStyle: {
                        padding: [0, 5],
                        color: '#fff'
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(255,255,255,0.9)',
                    padding: [10, 15],
                    textStyle: {
                        color: '#222',
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: date,
                    axisLabel: {
                        color: '#fff'
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(255,255,255,0.25)'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: 'rgba(255,255,255,0.1)',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#fff'
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(255,255,255,0.25)'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(255,255,255,0.01)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Axis pointer
                axisPointer: [{
                    lineStyle: {
                        color: 'rgba(255,255,255,0.25)'
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Page View',
                        type: 'bar',
                        data: page,
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        },
                        markLine: {
                            data: [{type: 'average', name: 'Average'}]
                        }
                    },
                    {
                        name: 'Visitor',
                        type: 'bar',
                        data: visitor,
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        },
                        markLine: {
                            data: [{type: 'average', name: 'Average'}]
                        }
                    }
                ]
            });
        }

        // Resize function
        var triggerChartResize = function() {
            columns_basic_element && columns_basic.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelector('.sidebar-control');
        sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    }

    return {
        init: function () {
            _componentStatisticalBrowser();
            _componentVisitedPage();
            _componentVectorMaps();
            _componentTotalVisitor();
        }
    };
}();

// Initialize module
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    StatisticalJS.init();
});