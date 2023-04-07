	<!-- Plugin scripts -->
	<script src="assets/js/vendors.js"></script>

	<!-- App script -->
	<script src="assets/js/app.js"></script>

	<!-- Custom script -->
	<script src="assets/js/custom.js"></script>




	<?php
	function getLastNdays($days, $format = 'd/m') {
		$m = date('m');
		$de = date('d');
		$y = date('Y');
		$dateArray = array();
		for ($i = 0; $i <= $days-1; $i++) {
			$date = date($format, mktime(0, 0, 0, $m, ($de-$i), $y));
			$dateArray[] = $date;
		}
		return array_reverse($dateArray);
	}
	$darray = getLastNdays(7, 'Y-m-d');
	$dates = array();
	for ($x = 0; $x < 7; $x++)
	{
		$d = $darray[$x];
		$dates[] = $d;
	}
	?>
	<script type="text/javascript">
		var categories = <?php echo json_encode($dates);?>;
		var apexdemo3 = jQuery('#apexdemo3');
		if (apexdemo3.length > 0)
		{
			var options = {
				chart: {
					height: 350,
					type: 'area',
					stacked: true,
					toolbar: {
						show: false,
					},
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: 'smooth',
					width: 4
				},
				series: [

				],
				noData: {
					text: 'Loading....'
				},
				fill: {
					gradient: {
						enabled: true,
						opacityFrom: 0.7,
						opacityTo: 0.2,
					}
				},
				legend: {
					show: false,
					showForSingleSeries: false,
					showForZeroSeries: false,
					position: 'top',
					horizontalAlign: 'right'
				},
				colors: ['#8E54E9', '#2bcbba', '#928ae9'],
				xaxis: {
					type: 'datetime',
					categories: categories,
					labels: {
						offsetX: -5
					}
				},
				tooltip: {
					x: {
						format: 'dd-MM-yyyy'
					},
				},
			}

			var chart = new ApexCharts(
				document.querySelector("#apexdemo3"),
				options
			);

			chart.render();

			var url = "<?php echo base_url().'?admin/userchart/'?>";
			$.ajax(
			{
				url: url,
				cache: false,
				success: function(response)
				{
					var datas = JSON.parse(response);

					chart.updateSeries([
						{
							name: datas.name1,
							data: datas.data1
						},
						{
							name: datas.name2,
							data: datas.data2
						},
						{
							name: datas.name3,
							data: datas.data3
						}
					])
				}
			})
		}
	</script>
