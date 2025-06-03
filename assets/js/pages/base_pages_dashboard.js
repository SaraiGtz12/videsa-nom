/*
 *  Document   : base_pages_dashboard.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Dashboard Page
 */

var BasePagesDashboard = function() {
    // Chart.js Chart, for more examples you can check out http://www.chartjs.org/docs
    var initDashChartJS = function(){
        // Get Chart Container
        var $dashChartLinesCon  = jQuery('.js-dash-chartjs-lines')[0].getContext('2d');

        // Set Chart and Chart Data variables
        var $dashChartLines, $dashChartLinesData;

        // Lines Chart Data
        var $dashChartLinesData = {
            labels: ['LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB', 'DOM'],
            datasets: [
                {
                    label: 'This Week',
                    fillColor: 'rgba(44, 52, 63, .07)',
                    strokeColor: 'rgba(44, 52, 63, .25)',
                    pointColor: 'rgba(44, 52, 63, .25)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(44, 52, 63, 1)',
                    data: [10, 10, 10, 10, 10, 10, 10]
                },
                {
                    label: 'Last Week',
                    fillColor: 'rgba(44, 52, 63, .1)',
                    strokeColor: 'rgba(44, 52, 63, .55)',
                    pointColor: 'rgba(44, 52, 63, .55)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(44, 52, 63, 1)',
                    data: [15, 15, 15, 15, 15, 15, 15]
                }
            ]
        };

        // Init Lines Chart
        $dashChartLines = new Chart($dashChartLinesCon).Line($dashChartLinesData, {
            scaleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
            scaleFontColor: '#999',
            scaleFontStyle: '600',
            tooltipTitleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
            tooltipCornerRadius: 3,
            maintainAspectRatio: false,
            responsive: true
        });
    };

    return {
        init: function () {
            // Init ChartJS chart
            initDashChartJS();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BasePagesDashboard.init(); });