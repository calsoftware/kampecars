var CRL = CRL || {};

CRL.Utils = {
	loadModels: function(element, install_folder){
		JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjListings&action=pjActionLoadModels&make_id=' + element.value, function (req) {
			document.getElementById('crl_model_container').innerHTML = req.responseText;
		});
	},
	doCompare: function(element, install_folder, status){
		var id = element.getAttribute('rev');
		
		// @@@ loading button
		jQuery(element).find('.i').hide().after(jQuery('<span>').addClass('icon-loading-spin native-svg i i-loading'));
		if (window.doc){
			window.doc.initSvg(jQuery(element));
		}

		if(status == 'add')
		{
			JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjListings&action=pjActionAddCompare&id=' + id, function (req) {
				document.getElementById('crl_add_compare').style.display = "none";
				document.getElementById('crl_remove_compare').style.display = "block";
				document.getElementById('crl_compare_cars').innerHTML = req.responseText;
				document.getElementById('crl_compare_menu').style.display = 'block';

				// @@@ loading button
				jQuery(element).find('.i-loading').remove();
				jQuery(element).find('.i').show();
			});
		}else{
			JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjListings&action=pjActionRemoveCompare&id=' + id, function (req) {
				
				// @@@ extend
				if (status == 'remove-reload'){
					window.location.reload();
					return false;
				}

				document.getElementById('crl_add_compare').style.display = "block";
				document.getElementById('crl_remove_compare').style.display = "none";
				document.getElementById('crl_compare_cars').innerHTML = req.responseText;
				if(parseInt(req.responseText, 10) == 0)
				{
					document.getElementById('crl_compare_menu').style.visibility = 'none';
				}

				// @@@ loading button
				jQuery(element).find('.i-loading').remove();
				jQuery(element).find('.i').show();
				
			});
		}

	},
	submitRequest : function (event, formName, containerId) {
		var postData = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			name = document.forms[formName].name,
			register_email = document.forms[formName].register_email,
			register_password = document.forms[formName].register_password,
			register_password_repeat = document.forms[formName].register_password_repeat,
			verification = document.forms[formName].verification,
			login_password = document.forms[formName].login_password,
			login_email = document.forms[formName].login_email,
			contact_name = document.forms[formName].contact_name,
			contact_email = document.forms[formName].contact_email,
			contact_message = document.forms[formName].contact_message;
		
		var err_container = document.getElementById(containerId);
		
		if (login_email) {
			if (login_email.value == '') {
				msg += '<li>' + CRL.Msg.email + '</li>';
			}
			if (login_email.value != '' && login_email.value.match(re) == null) {
				msg += '<li>' + CRL.Msg.email_inv + '</li>';
			}
		}
		if (login_password && login_password.value == '') {
			msg += '<li>' + CRL.Msg.password + '</li>';
		}
		
		if (register_email) {
			if (!register_email || register_email.value == '') {
				msg += '<li>' + CRL.Msg.email + '</li>';
			}

			if (register_email.value.length > 0 && register_email.value != '' && register_email.value.match(re) == null) {
				msg += '<li>' + CRL.Msg.email_inv + '</li>';
			}
			
		}
		
		if (register_password) {
			if (!register_password || register_password.value == '') {
				msg += '<li>' + CRL.Msg.password + '</li>';
			}
		}
		
		if (register_password_repeat) {
			if (!register_password_repeat || register_password_repeat.value == '') {
				msg += '<li>' + CRL.Msg.retype_password + '</li>';
			}
		}
		
		if (register_password && register_password_repeat) {
			if ((register_password && register_password.value != '') && (register_password_repeat && register_password_repeat.value != '')) {
				if(register_password.value != register_password_repeat.value)
				{
					msg += '<li>' + CRL.Msg.password_match + '</li>';
				}
			}
		}
		if (name) {
			if (!name || name.value == '') {
				msg += '<li>' + CRL.Msg.name + '</li>';
			}
		}
		if(verification){
			if (!verification || verification.value == '') {
				msg += '<li>' + CRL.Msg.captcha + '</li>';
			}
		}
		
		if (contact_name) {
			if (!contact_name || contact_name.value == '') {
				msg += '<li>' + CRL.Msg.name + '</li>';
			}
		}
		if (contact_email) {
			if (!contact_email || contact_email.value == '') {
				msg += '<li>' + CRL.Msg.email + '</li>';
			}

			if (contact_email.value.length > 0 && contact_email.value != '' && contact_email.value.match(re) == null) {
				msg += '<li>' + CRL.Msg.email_inv + '</li>';
			}
		}
		if (contact_message) {
			if (!contact_message || contact_message.value == '') {
				msg += '<li>' + CRL.Msg.your_question + '</li>';
			}
		}
		
		if (msg != '') {
			err_container.innerHTML = msg;
			err_container.style.display = "block";
		}else{
			if(verification)
			{				
				var captcha_inc = CRL.Msg.captcha_inc,
					install_folder = document.getElementById('crl_install_folder').value;
				JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjFront&action=pjActionCheckCaptcha&captcha=' + verification.value, function (resp) {
					var code = resp.responseText;
					if(code == 100){
						document.forms[formName].submit();
					}else{
						msg = '<li>' + captcha_inc + '</li>';
						err_container.innerHTML = msg;
						err_container.style.display = "block";
					}
				});
			}else{
				document.forms[formName].submit();
			}
		}
	},
	
	contactForm: function(element, status)
	{
		if(status == 'show')
		{
			element.style.display = 'none';
			document.getElementById('crl_contact_form_container').style.display = 'block';
		}else{
			document.getElementById('crl_contact_dealer').style.display = 'block';
			document.getElementById('crl_contact_form_container').style.display = 'none';
		}
	},
	
	formatMileage: function(opt, km)
	{
		var format = '';
		switch (opt)
		{
			case 'miles':
				format = km + ' miles';
				break;
			case 'km':
			default:
				format = km + ' km';
				break;
		}
		return format;
	},
	
	formatPower: function(opt, power)
	{
		var format = '';
		switch (opt)
		{
			case 'hp':
				format = power + ' HP';
				break;
			default:
				format = power + ' kW';
				break;
		}
		return format;
	},
	
	formatCurrency: function(price, currency)
	{
		var format = '';
		switch (currency)
		{
			case 'USD':
				format = "$" + price;
				break;
			case 'GBP':
				format = "&pound;" + price;
				break;
			case 'EUR':
				format = "&euro;" + price;
				break;
			case 'JPY':
				format = "&yen;" + price;
				break;
			case 'AUD':
			case 'CAD':
			case 'NZD':
			case 'CHF':
			case 'HKD':
			case 'SGD':
			case 'SEK':
			case 'DKK':
			case 'PLN':
				format = price + currency;
				break;
			case 'NOK':
			case 'HUF':
			case 'CZK':
			case 'ILS':
			case 'MXN':
				format = currency + price;
				break;
			default:
				format = price + currency;
				break;
		}
		return format;
	}
};

var jQuery_1_8_2 = $.noConflict();
(function ($, undefined) {
	$(function () {
		if($('#crl_year_slider').length > 0)
		{
			$( "#crl_year_slider" ).slider({
				range: true,
				min: CRL.Opts.min_year,
				max: CRL.Opts.max_year,
				values: [ parseInt(CRL.Opts.year_from, 10), parseInt(CRL.Opts.year_to, 10)  ],
				slide: function( event, ui ) {
					var filter_year_from = parseInt(ui.values[0], 10),
						filter_year_to = parseInt(ui.values[1], 10);
					$( "#crl_year_filter" ).html(filter_year_from + ' - ' + filter_year_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$( "#crl_year_slider" ).slider({ disabled: true });
					var url = $( "#crl_year_slider" ).attr('lang');
					window.location.href = url + '&year_from=' + slider_value_from + '&year_to=' + slider_value_to;
				}
			});
		}
		
		if($('#crl_mileage_slider').length > 0)
		{
			$( "#crl_mileage_slider" ).slider({
				range: true,
				min: CRL.Opts.min_mileage,
				max: CRL.Opts.max_mileage,
				step: 5000,
				values: [ parseInt(CRL.Opts.mileage_from, 10), parseInt(CRL.Opts.mileage_to, 10) ],
				slide: function( event, ui ) {
					var mileage_in = $( "#crl_mileage_filter" ).attr('lang'),
						filter_mileage_from = CRL.Utils.formatMileage(mileage_in, parseInt(ui.values[0], 10)),
						filter_milage_to = CRL.Utils.formatMileage(mileage_in, parseInt(ui.values[1], 10));
						
					$( "#crl_mileage_filter" ).html(filter_mileage_from + ' - ' + filter_milage_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$( "#crl_mileage_slider" ).slider({ disabled: true });
					var url = $( "#crl_mileage_slider" ).attr('lang');
					window.location.href = url + '&mileage_from=' + slider_value_from + '&mileage_to=' + slider_value_to;
				}
			});
		}
		
		if($('#crl_price_slider').length > 0)
		{
			$( "#crl_price_slider" ).slider({
				range: true,
				min: CRL.Opts.min_price,
				max: CRL.Opts.max_price,
				step: 1000,
				values: [ parseInt(CRL.Opts.price_from, 10), parseInt(CRL.Opts.price_to, 10) ],
				slide: function( event, ui ) {
					var currency = $( "#crl_price_filter" ).attr('lang'),
						filter_price_from = CRL.Utils.formatCurrency(parseInt(ui.values[0], 10), currency),
						filter_price_to = CRL.Utils.formatCurrency(parseInt(ui.values[1], 10), currency);
						
					$( "#crl_price_filter" ).html(filter_price_from + ' - ' + filter_price_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$( "#crl_price_slider" ).slider({ disabled: true });
					var url = $( "#crl_price_slider" ).attr('lang');
					window.location.href = url + '&price_from=' + slider_value_from + '&price_to=' + slider_value_to;
				}
			});
		}
		
		if($('.crl-select-filter').length > 0)
		{
			$( ".crl-select-filter" ).change(function() {
				var url = $( this ).attr('lang') + '&' + $( this ).attr('name') + '=' + $( this ).val();
				window.location.href = url;
			});
		}
		
		
		if($('#crl_year_search_slider').length > 0)
		{
			$( "#crl_year_search_slider" ).slider({
				range: true,
				min: CRL.Opts.min_year,
				max: CRL.Opts.max_year,
				values: [ CRL.Opts.min_year, CRL.Opts.max_year  ],
				slide: function( event, ui ) {
					var filter_year_from = parseInt(ui.values[0], 10),
						filter_year_to = parseInt(ui.values[1], 10);
					$( "#crl_year_filter" ).html(filter_year_from + ' - ' + filter_year_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$('#crl_search_year_from').val(slider_value_from);
					$('#crl_search_year_to').val(slider_value_to);
				}
			});
		}
		
		if($('#crl_power_search_slider').length > 0)
		{
			$( "#crl_power_search_slider" ).slider({
				range: true,
				min: CRL.Opts.min_power,
				max: CRL.Opts.max_power,
				values: [ CRL.Opts.min_power, CRL.Opts.max_power  ],
				slide: function( event, ui ) {
					var power_in = $( "#crl_power_filter" ).attr('lang'),
						filter_power_from = CRL.Utils.formatPower(power_in, parseInt(ui.values[0], 10)),
						filter_power_to = CRL.Utils.formatPower(power_in, parseInt(ui.values[1], 10));
						
					$( "#crl_power_filter" ).html(filter_power_from + ' - ' + filter_power_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$('#crl_search_power_from').val(slider_value_from);
					$('#crl_search_power_to').val(slider_value_to);
				}
			});
		}
		
		if($('#crl_mileage_search_slider').length > 0)
		{
			$( "#crl_mileage_search_slider" ).slider({
				range: true,
				min: CRL.Opts.min_mileage,
				max: CRL.Opts.max_mileage,
				step: 5000,
				values: [ CRL.Opts.min_mileage, CRL.Opts.max_mileage  ],
				slide: function( event, ui ) {
					var mileage_in = $( "#crl_mileage_filter" ).attr('lang'),
						filter_mileage_from = CRL.Utils.formatMileage(mileage_in, parseInt(ui.values[0], 10)),
						filter_milage_to = CRL.Utils.formatMileage(mileage_in, parseInt(ui.values[1], 10));
						
					$( "#crl_mileage_filter" ).html(filter_mileage_from + ' - ' + filter_milage_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$('#crl_search_mileage_from').val(slider_value_from);
					$('#crl_search_mileage_to').val(slider_value_to);
				}
			});
		}
		
		if($('#crl_price_search_slider').length > 0)
		{
			$( "#crl_price_search_slider" ).slider({
				range: true,
				min: CRL.Opts.min_price,
				max: CRL.Opts.max_price,
				step: 5000,
				values: [ CRL.Opts.min_price, CRL.Opts.max_price  ],
				slide: function( event, ui ) {
					var currency = $( "#crl_price_filter" ).attr('lang'),
						filter_price_from = CRL.Utils.formatCurrency(parseInt(ui.values[0], 10), currency),
						filter_price_to = CRL.Utils.formatCurrency(parseInt(ui.values[1], 10), currency);
						
					$( "#crl_price_filter" ).html(filter_price_from + ' - ' + filter_price_to);
				},
				stop: function( event, ui ) {
					var slider_value_from = parseInt(ui.values[0], 10),
						slider_value_to = parseInt(ui.values[1], 10);
					$('#crl_search_price_from').val(slider_value_from);
					$('#crl_search_price_to').val(slider_value_to);
				}
			});
		}
		
		if($('.crl-cartype-filter').length > 0)
		{
			$('.crl-cartype-filter').click(function() {
				if($(this).attr('checked') == 'checked')
				{
					$(this).next('label').addClass('crl-checkbox-filter-active');
				}else{
					$(this).next('label').removeClass('crl-checkbox-filter-active');
				}
				var type_arr = [];
				$('.crl-cartype-filter').each(function( index ) {
					if($(this).attr('checked') == 'checked')
					{
						type_arr.push($(this).val());
					}
				});
				window.location.href = $(this).attr('lang') + '&car_type=' + type_arr.join(',');
			});
		}
		
		if($('.crl-cartype-search').length > 0)
		{
			$('.crl-cartype-search').click(function() {
				
				var type_arr = [];
				$('.crl-cartype-search').each(function( index ) {
					if($(this).attr('checked') == 'checked')
					{
						type_arr.push($(this).val());
					}
				});
				$('#crl_cartype_search').val(type_arr.join(','));
			});
		}
		if($('.crl-dash-icon').length > 0)
		{
			$('.crl-dash-icon').click(function() {
				if($('.crl-menu-container').css('display') == 'none'){ 
					$('.crl-menu-container').show('slow'); 
				} else { 
				   $('.crl-menu-container').hide('slow'); 
				}
			});
		}
		
		$('.crl-menu-toggle').click(function() {
			if($('.crl-menu-container').css('display') == 'none'){ 
				$('.crl-car-filter').css('display', 'none');
				$('.crl-menu-container').show('slow'); 
			} else { 
			   $('.crl-menu-container').hide('slow'); 
			}
		});
		$('.crl-menu-filter').click(function() {
			if($('.crl-car-filter').css('display') == 'none'){ 
				$('.crl-menu-container').css('display', 'none');
				$('.crl-car-filter').show('slow'); 
			} else { 
			   $('.crl-car-filter').hide('slow'); 
			}
		});
		$('.btnCalculate').click(function(e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var install_folder = document.getElementById('crl_install_folder').value;
			$.ajax({
				type: "GET",
				dataType: 'html',
				url: install_folder + 'index.php?controller=pjListings&action=pjActionGetPrice&listing_id=' + $("#listing_id").val() + '&location_id=' + $("#location_id").val(),
				success: function (res) {
					$('#price_container').html(res);
				}
			});
			return false;
		});
		
		$('.btnOrder').click(function(e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			if ($dialogOrder.length > 0 && dialog) {
				$dialogOrder.dialog("open");
			}
			return false;
		});

		var $dialogOrder = $("#dialogOrder"), validator = null, dialog = ($.fn.dialog !== undefined), validate = ($.fn.validate !== undefined);

		if ($dialogOrder.length > 0 && dialog) {
			var install_folder = document.getElementById('crl_install_folder').value;
			
			$dialogOrder.dialog({
				modal: true,
				resizable: false,
				draggable: false,
				autoOpen: false,
				width: 640,
				open: function () {
					$dialogOrder.html("");
					$.get(install_folder + 'index.php?controller=pjListings&action=pjActionOrder&listing_id=' + $("#listing_id").val() + '&location_id=' + $("#location_id").val()).done(function (data) {
						$dialogOrder.html(data);
						$('.ui-button-text').each(function (i) {
					        $(this).html($(this).parent().attr('text'));
					    })
						validator = $dialogOrder.find("form").validate({
							errorPlacement: function (error, element) {
								error.insertAfter(element);
							},
							errorClass: "error"
						});
						$dialogOrder.dialog("option", "position", "center");
					});
				},
				buttons: (function () {
					var buttons = {};
					buttons['Send'] = function () {
						if (validator != null && validator != 'undefined' && validator.form()) {
							$.post(install_folder + 'index.php?controller=pjListings&action=pjActionOrder&listing_id=' + $("#listing_id").val() + '&location_id=' + $("#location_id").val(), $dialogOrder.find("form").serialize()).done(function (data) {
								$dialogOrder.dialog("close");
							});
						}
					};
					buttons['Cancel'] = function () {
						$dialogOrder.dialog("close");
					};
					
					return buttons;
				})()
			});
			
		}
	});
})(jQuery_1_8_2);