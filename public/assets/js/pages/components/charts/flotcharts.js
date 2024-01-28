"use strict";

// Class definition
var KTFlotchartsDemo = function() {

	// Private functions

    var messages = {
        'ar': {
            "Female":"إناث",
            "Male":"ذكور",
            "Children":"أطفال"
        }
    };

    let locator = new KTLocator(messages);

    var demo1 = function() {
        var data = [
            {label: locator.__("Female"), data: female_patients_no, color:  KTApp.getStateColor("danger")},
            {label: locator.__("Male"), data: male_patients_no, color:  KTApp.getStateColor("success")},
            {label: locator.__("Children"), data: child_patients_no, color:  KTApp.getStateColor("info")}
        ];

        $.plot($("#kt_flotcharts_1"), data, {
            series: {
                pie: {
                    show: true,
                    label: {
                        show: true,
                        formatter: function(label, series) {
                            return  '<p style="font-size:12pt;text-align:center;font-weight:500">' + label + '<br/>' + Math.round(series.percent) + '%' + '</p>';
                        },
                    }
                }
            }
        });
    }

    var demo2 = function() {
        var data = [
            {label: locator.__("Female"), data: female_home_visits_no, color:  KTApp.getStateColor("danger")},
            {label: locator.__("Male"), data: male_home_visits_no, color:  KTApp.getStateColor("success")},
            {label: locator.__("Children"), data: child_home_visits_no, color:  KTApp.getStateColor("info")}
        ];

        $.plot($("#kt_flotcharts_2"), data, {
            series: {
                pie: {
                    show: true,
                    label: {
                        show: true,
                        formatter: function(label, series) {
                            return  '<p style="font-size:12pt;text-align:center;font-weight:500">' + label + '<br/>' + Math.round(series.percent) + '%' + '</p>';
                        },
                    }
                }
            }
        });
    }


	return {
		// public functions
		init: function() {
			// pie charts
			demo1();
            demo2();

        }
	};
}();

jQuery(document).ready(function() {
	KTFlotchartsDemo.init();
});
