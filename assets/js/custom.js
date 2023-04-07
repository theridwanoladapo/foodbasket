//	PopOver
(function(window, document, $, undefined){
	
	$('#reg-success').click(function(e) {
		swal({
			type: 'success',
			title: 'Registration Successful',
			text: 'We\'ve sent your account details to your email',
			footer: '<a href>Why do I have this issue?</a>',
			allowOutsideClick: false
		})
	});
	
})(window, document, window.jQuery);

//	Clipboard
(function(window, document, $, undefined){
	
	var clipboard = new ClipboardJS('.btn');

	clipboard.on('success', function(e) {
		console.log(e);
	});

	clipboard.on('error', function(e) {
		console.log(e);
	});
	
})(window, document, window.jQuery);

//	DataTable
(function(window, document, $, undefined){
	
	$(function(){
		var dataTable = jQuery(".datatable-wrapper");
		if (dataTable.length > 0) {
			$('#datatable, #datatable2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": true,
				"info": false,
				"autoWidth": true
			});
		}
	});
	
	$(function(){
		var dataTable = jQuery(".datatable-wrapper");
		if (dataTable.length > 0) {
			$('#credit, #debit').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": true,
				"info": false,
				"autoWidth": true
			});
		}
	});
	
	$(function(){
		$('#referrals').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": true
		});
	});
	
	$(function(){
		$('#members, #agents, #merchants').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": true
		});
	});
	
	$(function(){
		$('#requests, #approved, #disapproved').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": true
		});
	});
	
})(window, document, window.jQuery);

(function(window, document, $, undefined){
	// jobportaldemo3
	var jobportaldemo3 = jQuery('#jobportaldemo3');
	if (jobportaldemo3.length > 0)
	{
		var options = {
			chart: {
				height: 280,
				type: 'radialBar',
			},
			plotOptions: {
				radialBar: {
					dataLabels: {
						name: {
							fontSize: '18px',
						},
						value: {
							fontSize: '16px',
						},
						total: {
							show: true,
							label: 'Total',
							formatter: function (w) {
								// By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
								return 100 + '%'
							}
						}
					}
				}
			},
			fill: {
				type: 'gradient',
				gradient: {
					shade: 'dark',
					type: "vertical",
					shadeIntensity: 1,
					opacityFrom: 1,
					opacityTo:0.5,
					gradientToColors: ['#00afef', '#28a745', '#6c757d'],
					stops: [0, 90, 100]
				}
			},
			colors:['#00afef', '#28a745', '#6c757d'],
			series: [45, 55, 43],
			labels: ['Members', 'Merchants', 'Agents'],
			responsive: [{
				breakpoint: 400,
				options: {
					chart: {
						offsetY:0,
						offsetX:0,
						height: 300,
					}
				},
			}]
		}
		
		var chart = new ApexCharts(
			document.querySelector("#jobportaldemo3"),
			options
		);
		
		chart.render();
	}
	
	
	// demo4
	/*function generateDayWiseTimeSeries(baseval, count, yrange) {
		var i = 0;
		var series = [];
		while (i < count) {
			var x = baseval;
			var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

			series.push([x, y]);
			baseval += 86400000;
			i++;
		}
		return series;
	}*/

})(window, document, window.jQuery);
/*
(function(window, document, $, undefined){
	
})(window, document, window.jQuery);
*/
