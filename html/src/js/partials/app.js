;(function ($) {
	var $rangeSlider = $(".js-range-slider");
	var $rangeCalendar = $("#range-calendar");
	var $counter = $('.counter');
	var $inputNao = $('.input__field--nao');
	var $chart = $('.chart');

	if ($counter.length) {
		$("#test-circle1").circliful({
			animation: 1,
			animationStep: 5,
			foregroundBorderWidth: 2,
			backgroundBorderWidth: 0,
			backgroundColor: "none",
			foregroundColor: '#000000',
			percent: 12,
			noPercentageSign: true,
			percentageTextSize: '36',
			fontColor: '#000',
			multiPercentage: 0
		});
		$("#test-circle2").circliful({
			animation: 1,
			animationStep: 5,
			foregroundBorderWidth: 2,
			backgroundBorderWidth: 0,
			backgroundColor: "none",
			foregroundColor: '#000000',
			percent: 80,
			percentageTextSize: '36',
			fontColor: '#000',
			multiPercentage: 0
		});
		$("#test-circle3").circliful({
			animation: 1,
			animationStep: 5,
			foregroundBorderWidth: 2,
			backgroundBorderWidth: 0,
			backgroundColor: "none",
			foregroundColor: '#000000',
			percent: 30,
			percentageTextSize: '36',
			fontColor: '#000',
			multiPercentage: 0
		});
		$("#test-circle4").circliful({
			animation: 1,
			animationStep: 5,
			foregroundBorderWidth: 2,
			backgroundBorderWidth: 0,
			backgroundColor: "none",
			foregroundColor: '#000000',
			percent: 2,
			noPercentageSign: true,
			percentageTextSize: '36',
			fontColor: '#000',
			multiPercentage: 0
		});
	}

	$(window).on('scroll', function() {
		var $sticky = $('.sticky');
		var scroll = $(window).scrollTop();

		if (scroll > 0) {
			$sticky.addClass('fixed');
		} else {
			$sticky.removeClass('fixed');
		}

	});

	if ($rangeCalendar.length) {
		$rangeCalendar.rangeCalendar({
			lang:"ru",
			theme:"default-theme",
			themeContext: this,
			startDate: moment(),
			endDate: moment().add('months', 12),
			start :"+7",
			startRangeWidth : 1,
			minRangeWidth: 1,
			maxRangeWidth: 1,
			weekends:true,
			autoHideMonths:false,
			visible:true,
			trigger:null,

			changeRangeCallback : function( el, cont, dateProp ) {
				return false
			}
		});
	}

	if ($rangeSlider.length) {
		$rangeSlider.ionRangeSlider({
			min: 0,
			max: 24,
			from: 17,
			step: 1,
			postfix: ".00",
			skin: 'round',
			hide_min_max: true,
			hide_min_to: true
		});
	}

	$inputNao.on('focus blur input', function() {

		if ($(this).val() !== '') {
			$(this).addClass('input--filled');
		} else {
			$(this).removeClass('input--filled');
		}
	});

	if ($chart.length) {
		Highcharts.chart('chart', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie',
				height: 125,
				width: 125,
				margin: [0, 0, 0, 0]
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: false
				}
			},
			credits: {
				enabled: false
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: [{
					name: 'Chrome',
					y: 61.41,
					sliced: true,
					selected: true
				}, {
					name: 'Internet Explorer',
					y: 11.84
				}, {
					name: 'Firefox',
					y: 10.85
				}, {
					name: 'Edge',
					y: 4.67
				}, {
					name: 'Safari',
					y: 4.18
				}, {
					name: 'Other',
					y: 7.05
				}]
			}]
		});
	}

})(jQuery);
