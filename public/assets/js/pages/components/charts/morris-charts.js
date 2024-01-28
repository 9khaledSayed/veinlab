"use strict";
// Class definition
var KTMorrisChartsDemo = function() {

    var messages = {
        'ar': {
            "Patients : ":"المرضي : "
        }
    };

    let locator = new KTLocator(messages);

    var demo3 = function() {
        // BAR CHART
        new Morris.Bar({
            element: 'kt_morris_3',
            data: companies,
            xkey: 'y',
            ykeys: ['a'],
            labels: [locator.__("Patients : ")],
            barColors: [ '#1DC9B7'],
            resize:true,
            gridTextWeight:'bold',
            gridTextSize:10,
            gridTextColor:'#000000',
            grid:false,
            redraw:true
        });
    }



    var demo4 = function() {
        // BAR CHART
        new Morris.Bar({
            element: 'kt_morris_4',
            data:hospitals,
            xkey: 'y',
            ykeys: ['a'],
            labels: [locator.__("Patients : ")],
            barColors: [ '#D2061E'],
            resize:true,
            gridTextWeight:'bold',
            gridTextSize:10,
            gridTextColor:'#000000',
        });
    }


    var demo5 = function() {
        // BAR CHART
        new Morris.Bar({
            element: 'kt_morris_5',
            data:doctors,
            xkey: 'y',
            ykeys: ['a'],
            labels: [locator.__("Patients : ")],
            barColors: [ '#282A3C'],
            resize:true,
            gridTextWeight:'bold',
            gridTextSize:10,
            gridTextColor:'#000000',
        });
    }


    var demo6 = function() {
        // BAR CHART
        new Morris.Bar({
            element: 'kt_morris_6',
            data:sectors,
            xkey: 'y',
            ykeys: ['a'],
            labels: [locator.__("Patients : ")],
            barColors: [ '#D2061E'],
            resize:true,
            gridTextWeight:'bold',
            gridTextSize:10,
            gridTextColor:'#000000',
        });
    }

    return {
        // public functions
        init: function() {
            demo3();
            demo4();
            demo5();
            demo6();

        }
    };
}();

jQuery(document).ready(function() {
    KTMorrisChartsDemo.init();
});
