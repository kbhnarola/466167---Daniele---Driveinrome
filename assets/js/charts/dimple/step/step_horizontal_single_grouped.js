/* ------------------------------------------------------------------------------
 *
 *  # Dimple.js - grouped horizontal steps
 *
 *  Demo of grouped steps chart. Data stored in .tsv file format
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {

    // Construct chart
    var svg = dimple.newSvg("#dimple-step-horizontal-single-grouped", "100%", 500);


    // Chart setup
    // ------------------------------

    d3.tsv("assets/demo_data/dimple/demo_data.tsv", function (data) {

        // Filter data
        data = dimple.filterData(data, "Owner", ["Aperture", "Black Mesa"])


        // Create chart
        // ------------------------------

        // Define chart
        var myChart = new dimple.chart(svg, data);

        // Set bounds
        myChart.setBounds(0, 0, "100%", "100%")

        // Set margins
        myChart.setMargins(55, 10, 10, 45);


        // Create axes
        // ------------------------------

        // Horizontal
        var x = myChart.addCategoryAxis("x", ["Owner", "Month"]);
            x.addGroupOrderRule("Date");

        // Vertical
        var y = myChart.addMeasureAxis("y", "Unit Sales");


        // Construct layout
        // ------------------------------

        // Add line
        var s = myChart
            .addSeries("Owner", dimple.plot.line)
            .interpolation = "step";

        // Line space
        s.barGap = 0.05;

        
        // Add styles
        // ------------------------------

        // Font size
        x.fontSize = "12";
        y.fontSize = "12";

        // Font family
        x.fontFamily = "Roboto";
        y.fontFamily = "Roboto";


        //
        // Draw chart
        //

        // Draw
        myChart.draw();


        // Resize chart
        // ------------------------------

        // Add a method to draw the chart on resize of the window
        $(window).on('resize', resize);
        $('.sidebar-control').on('click', resize);

        // Resize function
        function resize() {

            // Redraw chart
            myChart.draw(0, true);
        }
    });

});