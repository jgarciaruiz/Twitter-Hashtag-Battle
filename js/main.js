(function ($) {

	$(document).ready(function(){
		load(100);
	});//dom ready


	function load(refreshTimer) {
	    setTimeout(function () {

	    	//initial counter values
			var prevCounterGreen = $("#oldval-green").val(),
				prevCounterWhite = $("#oldval-white").val(),
				prevCounterRed = $("#oldval-red").val();

    	
			$.ajax({
			    type: "POST",
			    url: "counters.php",
	            dataType : 'json',
			    success: function(response){
			    	console.info("ajax");
			    	var countGreen = response['totalMayas'];
			    	var countWhite = response['totalZacatecas'];
			    	var countRed = response['totalCabrones'];
					        
			        //animate counter
			        $('#counter-mayas').each(function () {
					    $("#counter-mayas").prop('Counter',prevCounterGreen).animate({
					        Counter: countGreen
					    }, {
					        duration: 3000,
					        easing: 'swing',
					        step: function (now) {
					            $(this).text(Math.ceil(now));
					        }
					    });
					});	

			        $('#counter-zacatecas').each(function () {
					    $("#counter-zacatecas").prop('Counter',prevCounterWhite).animate({
					        Counter: countWhite
					    }, {
					        duration: 3000,
					        easing: 'swing',
					        step: function (now) {
					            $(this).text(Math.ceil(now));
					        }
					    });
					});	

			        $('#counter-cabrones').each(function () {
					    $("#counter-cabrones").prop('Counter',prevCounterRed).animate({
					        Counter: countRed
					    }, {
					        duration: 3000,
					        easing: 'swing',
					        step: function (now) {
					            $(this).text(Math.ceil(now));
					        }
					    });
					});						

								
					//udpdate initial counter values with new values	    
					$("#oldval-green").val(countGreen);
					$("#oldval-white").val(countWhite);
					$("#oldval-red").val(countRed);		


			    	//debuging
			        console.log("Mayas: "+countGreen);
			        console.log("zacatecas: "+countWhite);
			        console.log("Cabrones: "+countRed);

			        load(12000);

			    }
			});

	    }, refreshTimer);
	}

}(jQuery));

(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());