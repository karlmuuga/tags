$(document).ready(function(e) {
	
	//GOOGLE ANALYTCIS

	(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create", "UA-71746374", "auto");ga("send", "pageview");
	
	//TAGASISIDE
	
	$("#mess").click(function(e) {
		e.preventDefault();
		var name = $("#qc_name").val();
		var email = $("#qc_email").val();
		var mes = $("#mes_m").val();
			
		$.post("http://tags.ee/ajax/mes.php",
		{
			name: name,
			email: email,
			mes: mes
		},
		function(data, status){
			
			if(data == 1){
				$("#return_m").css("color","green");
				$("#return_m").html("Teie sõnum on edukalt saadetud!");
				setTimeout(function(){$("#qcf-btn").removeClass("active");
		$(".quick-contact").removeClass("visible");},1500);
			}else if(data == 0){
				$("#return_m").css("color","red");
				$("#return_m").html("Palun sisestage kõik andmed korrektselt!");
			}else{
				$("#return_m").css("color","green");
				$("#return_m").html("Vabandame, kuid midagi läks valesti :(");
			};
		});
	});
	
	
	//SISSELOGIMINE
	
	$("#logis").click(function(e){
		
	  e.preventDefault();
	  var logemail = $("#logemail").val();
	  var logpassword = $("#logpassword").val();
	  $(".logmess").css("color","red");
	  if(logemail == "" || logpassword == ""){
		$(".logmess").html("Palun sisestage kõik andmed korrektselt!");
	  }else{
	  
	  $.post("/ajax/chckAcc.php",
				{
					logemail: logemail,
					logpassword: logpassword
				},
				function(data, status){
					 if(data == "1"){
			  $(".logmess").html("Olete edukalt sisse logitud!");
	  		  $(".logmess").css("color","green");
  		      var page = $(location).attr("href");
		  	  setTimeout(function(){$(location).attr("href", page);},1500);
						
		    }else{
			  $(".logmess").html("Vabandame, kuid meie andmed ei ühti!");
		      $("#logpassword").val("");
		    };
				});
	  
	  };
	});
	
	
	/*TEMPLATE SKRIPT
	*******************************************/
	var $searchBtn = $('.search-btn');
	var $searchForm = $('.search-form');
	var $closeSearch = $('.close-search');
	var $subscrForm = $('.subscr-form');
	var $nextField = $('.subscr-next');
	var $loginBtn = $('.login-btn');
	var $loginForm = $('.modal .login-form');
	var $loginForm2 = $('.checkout .login-form');
	var $loginForm3 = $('.log-reg .login-form');
	var $regForm = $('.registr-form');
	var $qcForm = $('.quick-contact');
	var $contForm = $('.contact-form');
	var $checkoutForm = $('#checkout-form');
	var $cartTotal1 = $('.cart-dropdown .total');
	var $header = $('header');
	var $headerOffsetTop = $header.data('offset-top');
	var $headerStuck = $header.data('stuck');
	var $menuToggle = $('.menu-toggle');
	var $menu = $('.menu');
	var $submenuToggle = $('.menu .has-submenu > a > i');
	var $submenu = $('.menu .submenu');
	var $featureTab = $('.feature-tabs .tab');
	var $featureTabPane = $('.feature-tabs .tabs-pane');
	var $brandCarousel = $('.brand-carousel .inner');
	var $shareBtn1 = $('.tile .share-btn i');
	var $offersTabs = $('.offer-tabs .tab-navs a');
	var $offersTabsCarousel = $('.offer-tabs .tab-navs');
	var $sortToggle = $('.sorting a');
	var $activePage = $('.pagination li.active a');
	var $subcatToggle = $('.filter-section .categories .has-subcategory > a');
	var $filterToggle = $('.filter-toggle');
	var $scrollTopBtn = $('#scrollTop-btn');
	var $qcfBtn = $('#qcf-btn');
	var $addToCartBtn = $('#addItemToCart');
	var $addedToCartMessage = $('.cart-message');
	var $promoLabels = $('.promo-labels div');
	var $panelToggle = $('.panel-toggle');
	var $accordionToggle = $('.accordion .panel-heading a');
	
	/*Search Form Toggle
	*******************************************/
	$searchBtn.click(function(){
		$searchForm.removeClass('closed').addClass('open');
	});
	$closeSearch.click(function(){
		$searchForm.removeClass('open').addClass('closed');
	});
	$('.page-content, .subscr-widget, footer').click(function(){
		$searchForm.removeClass('open').addClass('closed');
	});
	
	/*Login Forms
	*******************************************/
	$loginForm.validate();
	$loginForm2.validate();
	$loginForm3.validate();
	$('#log-password').focus(function(){
		$(this).attr('type', 'password');
	});
	
	/*Quick Contact Form Validation
	*******************************************/
	//$qcForm.validate();
	
	/*Contact Form Validation
	*******************************************/
	$contForm.validate();
	
	/*Registration Form Validation
	*******************************************/
	$regForm.validate();
	
	/*Checkout Form Validation
	*******************************************/
	$checkoutForm.validate({
		rules: {
			co_postcode: {
				required: true,
				number: true
			},
			co_phone: {
				required: true,
				number: true
			}
		}	
	});
	
	/*Adding Placeholder Support in Older Browsers
	************************************************/
	$('input, textarea').placeholder();
		
	/*Shopping Cart Dropdown 
	*******************************************/
	//Deleting Items
	$(document).on('click', '.cart-dropdown .delete', function(){
		var $target = $(this).parent().parent();
		var $positions = $('.cart-dropdown .item');
		var $positionQty = parseInt($('.cart-btn a span').text());
		$target.hide(300, function(){
			$.when($target.remove()).then( function(){
				$positionQty = $positionQty -1;
				$('.cart-btn a span').text($positionQty);
				if($positions.length === 1) {
					$('.cart-dropdown .body').html('<h3>Cart is empty!</h3>');
				}
			});
		});
	});
	
	/*Shopping Cart Page
	*******************************************/
	//Deleting Items
	$(document).on('click', '.shopping-cart .delete i', function(){
		var $target = $(this).parent().parent();
		var $positions = $('.shopping-cart .item');
		$target.hide(300, function(){
			$.when($target.remove()).then( function(){
				if($positions.length === 1) {
					$('.shopping-cart .items-list').remove();
					$('.shopping-cart .title').text('Shopping cart is empty!');
				}
			});
		});
	});
	
	/*Wishlist Deleting Items
	*******************************************/
	$(document).on('click', '.wishlist .delete i', function(){
		var $target = $(this).parent().parent();
		$target.hide(300, function(){
			$.when($target.remove()).then( function(){
				if($positions.length === 1) {
					$('.wishlist .items-list').remove();
					$('.wishlist .title').text('Wishlist is empty!');
				}
			});
		});
	});
	
	/*Catalog 3-rd Level Submenu positioning
	*******************************************/
	$('.catalog .submenu .has-submenu').hover(function(){
		var $offseTop = $(this).position().top;
		$('.catalog .submenu .offer .col-1 p').hide();
		$(this).find('.sub-submenu').css({top: -$offseTop + "px"}).show();
	},function(){
		$(this).find('.sub-submenu').hide();
		$('.catalog .submenu .offer .col-1 p').show();
	});
	
	/*Small Header slide down on scroll
	*******************************************/
	if($(window).width() >= 500){
		$(window).on('scroll', function(){
				if($(window).scrollTop() > $headerOffsetTop ){
					$header.addClass('small-header');
				} else {
					$header.removeClass('small-header');
				}
				if($(window).scrollTop() > $headerStuck ){
					$header.addClass('stuck');
				} else {
					$header.removeClass('stuck');
				}
		});	
	}

	/*Mobile Navigation
	*******************************************/
	//Mobile menu toggle
	$menuToggle.click(function(){
		$menu.toggleClass('expanded');
	});
	
	//Submenu Toggle
	$submenuToggle.click(function(e){
		$(this).toggleClass('open');
		$(this).parent().parent().find('.submenu').toggleClass('open');
		
	});
	
	/*Subscription Form Widget
	*******************************************/
	$subscrForm.validate();
	$nextField.click(function(e){
		var $target = $(this).parent();
			if($subscrForm.valid() === true){
				$target.hide('drop', 300, function(){
					$target.next().show('drop', 300);
				});
			}
		
	});
	
	/*Custom Style Checkboxes and Radios
	*******************************************/
	$('input').iCheck({
    checkboxClass: 'icheckbox',
    radioClass: 'iradio'
  });
	
	/*Parallax Backgrounds
	*******************************************/
	$(window).on('load', function(){
		/*Checking if it's touch device we disable parallax feature due to inconsistency*/
		if (Modernizr.touch) { 
			$('body').removeClass('parallax'); 
		}
		$('.parallax').stellar({
			horizontalScrolling: false,
			responsive:true
		});
	});
	
	/*Features Tabs
	*******************************************/
	$featureTab.on('mouseover', function(){
		$featureTab.removeClass('active');
		$(this).addClass('active');
		var $curTab = $(this).attr('data-tab');
		$featureTabPane.removeClass('current');
		$('.feature-tabs .tabs-pane' + $curTab).addClass('current');
	});
	
	/*Enable Touch / swipe events for carousel 
	*******************************************/
	$(".carousel-inner").swipe( {
		//Generic swipe handler for all directions
		swipeRight:function(event, direction, distance, duration, fingerCount) {
			$(this).parent().carousel('prev'); 
		},
		swipeLeft: function() {
			$(this).parent().carousel('next'); 
		},
		//Default is 75px, set to 0 for demo so any distance triggers swipe
		threshold:0
	});
	
	/*Initializing Gallery Plugin
	*******************************************/
	gallery.init();
	$('.gallery-grid').lightGallery({
		speed: 400
	});
	
	/*Initializing Brands Carousel Plugin
	*******************************************/
	$brandCarousel.owlCarousel({
		// Define custom and unlimited items depending from the width
		// If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled
		// For better preview, order the arrays by screen size, but it's not mandatory
		// Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available.
		// In the example there is dimension with 0 with which cover screens between 0 and 450px
		itemsCustom : [
			[0, 1],
			[340, 2],
			[580, 3],
			[991, 4],
			[1200, 5]
		],
		navigation : true,
		theme: "",
		navigationText : ["",""]
	});
	
	/*Hero Slider
	*******************************************/
	if($('#hero-slider').length > 0) {
		var heroSlider = new MasterSlider();
		heroSlider.control('arrows');
		heroSlider.control('bullets');
		heroSlider.setup('hero-slider' , {
				width:1140,
				height:455,
				space:0,
				speed: 18,
				autoplay: true,
				loop: true,
				layout: 'fullwidth',
				preload:'all',
				view:'basic',
				instantStartLayers: true
		});
	}
	
	/*Hero Fullscreen Slider
	*******************************************/
	if($('#fullscreen-slider').length > 0) {
		var fullscreenSlider = new MasterSlider();
		fullscreenSlider.control('arrows');
		fullscreenSlider.control('bullets');
		fullscreenSlider.setup('fullscreen-slider' , {
				width:1140,
				height:455,
				space:0,
				view:'basic',
				layout:'fullscreen',
				fullscreenMargin: 116
		});
	}
	
	/*Category Slider
	*******************************************/
	if($('#cat-slider').length > 0) {
		var categorySlider = new MasterSlider();
		categorySlider.control('thumblist' , {autohide:false ,dir:'h', type:'tabs',width:164,height:280, align:'bottom', space:30 , margin:13, hideUnder:400});
		categorySlider.setup('cat-slider' , {
				width:1050,
				height:550,
				space:0,
				speed: 25,
				layout: 'fullwidth',
				preload:'all',
				view:'basic',
				instantStartLayers: true
		});
	}
	
	/*Offers Tabs
	*******************************************/
	$offersTabs.click(function(){
		$offersTabs.removeClass('active');
		$(this).addClass('active');
	});
	
	$offersTabsCarousel.owlCarousel({
		itemsCustom : [
			[0, 1],
			[420, 2],
			[880, 3],
			[1200, 3]
		],
		navigation : false,
		theme: ""
	});
	
	/*Catalog Sorting Toggles
	*******************************************/
	$sortToggle.click(function(e){
		$(this).toggleClass('sorted');
		
	});
	
	/*Disabling link on active page
	*******************************************/
	$activePage.click(function(e){
		
	});
	
	/*Catalog Filters
	*******************************************/
	//Price Slider Range
	var $minVal = parseInt($('#minVal').attr('data-min-val'));
	var $maxVal = parseInt($('#maxVal').attr('data-max-val'));
	var $startMin = parseInt($('#minVal').val());
	var $startMax = parseInt($('#maxVal').val());
	if($('#price-range').length > 0){
		$('#price-range').noUiSlider({	
			range: {
				'min': $minVal,
				'max': $maxVal
			},
			start: [$startMin,$startMax],
			connect: true,
			serialization: {
				lower: [
					$.Link({
						target: $('#minVal'),
						format: {
							decimals: 0
						}
					})
				],
				upper: [
					$.Link({
						target: $('#maxVal'),
						format: {
							decimals: 0
						}
					})
				]
			}
		});
	}
	
	//Clear price filters
	$('#clearPrice').click(function(){
		$('#price-range').val([$startMin, $startMax], { set: true });
	});
	
	//Clear Checkbox filters
	$('.clearChecks').click(function(){
		$(this).parent().find('.icheckbox').removeClass('checked');
	});
	
	//Categories accordion
	$subcatToggle.click(function(e){
		$(this).parent().toggleClass('opened');
		$(this).parent().find('.subcategory').toggleClass('open');
		
	});
	
	//Filter Toggle / Showing Filters in Modal
	$filterToggle.click(function(){
		$('.shop-filters').appendTo($('#filterModal .modal-body'));
		$('#filterModal .modal-body .shop-filters').css('display', 'block');
	});
	
	$('#filterModal').on('hide.bs.modal', function(){
		$('.shop-filters').appendTo('.filters-mobile');
	});
	
	$(window).resize(function(){
		if($(window).width() > 768){
			$('#filterModal').modal('hide');
		}
	});
	
	/*Catalog Single
	*******************************************/
	//Product Gallery
	if($('#prod-gal').length > 0) {
		var categorySlider = new MasterSlider();
		categorySlider.control('thumblist' , {autohide:false ,dir:'h',align:'bottom', width:137, height:130, margin:15, space:0 , hideUnder:400});
		categorySlider.setup('prod-gal' , {
				width:550,
				height:484,
				speed: 25,
				preload:'all',
				loop:true,
				view:'fade'
		});
	}
	
	//Add(+/-) Button Number Incrementers
	$(".incr-btn").on("click", function(e) {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			var newVal = parseFloat(oldValue) - 1;
		}
		$button.parent().find("input").val(newVal);
		
	});
	
	/*Added To Cart Message + Action (For Demo Purpose)
	**************************************************/
	$addToCartBtn.click(function(){
		$addedToCartMessage.removeClass('visible');
		var $itemName = $(this).parent().parent().find('h1').text();
		var $itemPrice = $(this).parent().parent().find('.price').text();
		var $itemQnty = $(this).parent().find('#quantity').val();
		var $cartTotalItems = parseInt($('.cart-btn a span').text()) +1;
		$addedToCartMessage.find('p').text('"' + $itemName + '"' + '  ' + 'was successfully added to your cart.');
		$('.cart-dropdown table').append(
			'<tr class="item"><td><div class="delete"></div><a href="#">' + $itemName + 
			'<td><input type="text" value="' + $itemQnty +
			'"></td><td class="price">' + $itemPrice + '</td>' 
		);
		$('.cart-btn a span').text($cartTotalItems);
		$addedToCartMessage.addClass('visible');
	});
	
	/*Promo Labels Popovers
	*******************************************/
	$promoLabels.popover({
		placement: 'top',
		trigger: 'hover'
	});
	
	/*Special Offer Autoheight
	*******************************************/
	$(window).load(function(){
		var tileH = $('.special-offer .tile').height();
		$('.special-offer .offer').css('height', tileH);
	});
	$(window).resize(function(){
		var tileH = $('.special-offer .tile').height();
		$('.special-offer .offer').css('height', tileH);
	});
	
	/*Expandable Panels
	*******************************************/
	$panelToggle.click(function(e){
		$(this).toggleClass('active');
		var $target = $(this).attr('href');
		$($target).toggleClass('expanded');
		
	});
	
	/*Accordion Widget
	*******************************************/
	$accordionToggle.click(function(){
		$accordionToggle.parent().removeClass('active');
		$(this).parent().addClass('active');
	});
	
	/*Sticky Buttons
	*******************************************/
	//Scroll to Top Button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 500) {
			$scrollTopBtn.parent().addClass('scrolled');
		} else {
			$scrollTopBtn.parent().removeClass('scrolled');
		}
	});
	$scrollTopBtn.click(function(){
		$('html, body').animate({scrollTop : 0}, {duration: 700, easing:"easeOutExpo"});
	});
	
	//Quick Contact Form
	$qcfBtn.click(function(){
		$(this).toggleClass('active');
		$(this).parent().find('.quick-contact').toggleClass('visible');
	});
	$('.page-content, .subscr-widget, footer, header').click(function(){
		$qcfBtn.removeClass('active');
		$('.quick-contact').removeClass('visible');
	});

	/*History page img switcher
	*******************************************/

	$('.panel-heading').click(function(){
		var hisroryID = $(this).data('img');
		$('.delivery-preview').removeClass('historyImgShow');
		$(hisroryID).addClass('historyImgShow');
	});

	
	
	/* =========================================================
 * bootstrap-datepicker.js 
 * http://www.eyecon.ro/bootstrap-datepicker
 * =========================================================
 * Copyright 2012 Stefan Petre
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */
 
!function( $ ) {
	
	// Picker object
	
	var Datepicker = function(element, options){
		this.element = $(element);
		this.format = DPGlobal.parseFormat(options.format||this.element.data('date-format')||'mm/dd/yyyy');
		this.picker = $(DPGlobal.template)
							.appendTo('body')
							.on({
								click: $.proxy(this.click, this)//,
								//mousedown: $.proxy(this.mousedown, this)
							});
		this.isInput = this.element.is('input');
		this.component = this.element.is('.date') ? this.element.find('.add-on') : false;
		
		if (this.isInput) {
			this.element.on({
				focus: $.proxy(this.show, this),
				//blur: $.proxy(this.hide, this),
				keyup: $.proxy(this.update, this)
			});
		} else {
			if (this.component){
				this.component.on('click', $.proxy(this.show, this));
			} else {
				this.element.on('click', $.proxy(this.show, this));
			}
		}
	
		this.minViewMode = options.minViewMode||this.element.data('date-minviewmode')||0;
		if (typeof this.minViewMode === 'string') {
			switch (this.minViewMode) {
				case 'months':
					this.minViewMode = 1;
					break;
				case 'years':
					this.minViewMode = 2;
					break;
				default:
					this.minViewMode = 0;
					break;
			}
		}
		this.viewMode = options.viewMode||this.element.data('date-viewmode')||0;
		if (typeof this.viewMode === 'string') {
			switch (this.viewMode) {
				case 'months':
					this.viewMode = 1;
					break;
				case 'years':
					this.viewMode = 2;
					break;
				default:
					this.viewMode = 0;
					break;
			}
		}
		this.startViewMode = this.viewMode;
		this.weekStart = options.weekStart||this.element.data('date-weekstart')||0;
		this.weekEnd = this.weekStart === 0 ? 6 : this.weekStart - 1;
		this.onRender = options.onRender;
		this.fillDow();
		this.fillMonths();
		this.update();
		this.showMode();
	};
	
	Datepicker.prototype = {
		constructor: Datepicker,
		
		show: function(e) {
			this.picker.show();
			this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
			this.place();
			$(window).on('resize', $.proxy(this.place, this));
			if (e ) {
				e.stopPropagation();
				e.preventDefault();
			}
			if (!this.isInput) {
			}
			var that = this;
			$(document).on('mousedown', function(ev){
				if ($(ev.target).closest('.datepicker').length == 0) {
					that.hide();
				}
			});
			this.element.trigger({
				type: 'show',
				date: this.date
			});
		},
		
		hide: function(){
			this.picker.hide();
			$(window).off('resize', this.place);
			this.viewMode = this.startViewMode;
			this.showMode();
			if (!this.isInput) {
				$(document).off('mousedown', this.hide);
			}
			//this.set();
			this.element.trigger({
				type: 'hide',
				date: this.date
			});
		},
		
		set: function() {
			var formated = DPGlobal.formatDate(this.date, this.format);
			if (!this.isInput) {
				if (this.component){
					this.element.find('input').prop('value', formated);
				}
				this.element.data('date', formated);
			} else {
				this.element.prop('value', formated);
			}
		},
		
		setValue: function(newDate) {
			if (typeof newDate === 'string') {
				this.date = DPGlobal.parseDate(newDate, this.format);
			} else {
				this.date = new Date(newDate);
			}
			this.set();
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},
		
		place: function(){
			var offset = this.component ? this.component.offset() : this.element.offset();
			this.picker.css({
				top: offset.top + this.height,
				left: offset.left
			});
		},
		
		update: function(newDate){
			this.date = DPGlobal.parseDate(
				typeof newDate === 'string' ? newDate : (this.isInput ? this.element.prop('value') : this.element.data('date')),
				this.format
			);
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},
		
		fillDow: function(){
			var dowCnt = this.weekStart;
			var html = '<tr>';
			while (dowCnt < this.weekStart + 7) {
				html += '<th class="dow">'+DPGlobal.dates.daysMin[(dowCnt++)%7]+'</th>';
			}
			html += '</tr>';
			this.picker.find('.datepicker-days thead').append(html);
		},
		
		fillMonths: function(){
			var html = '';
			var i = 0
			while (i < 12) {
				html += '<span class="month">'+DPGlobal.dates.monthsShort[i++]+'</span>';
			}
			this.picker.find('.datepicker-months td').append(html);
		},
		
		fill: function() {
			var d = new Date(this.viewDate),
				year = d.getFullYear(),
				month = d.getMonth(),
				currentDate = this.date.valueOf();
			this.picker.find('.datepicker-days th:eq(1)')
						.text(DPGlobal.dates.months[month]+' '+year);
			var prevMonth = new Date(year, month-1, 28,0,0,0,0),
				day = DPGlobal.getDaysInMonth(prevMonth.getFullYear(), prevMonth.getMonth());
			prevMonth.setDate(day);
			prevMonth.setDate(day - (prevMonth.getDay() - this.weekStart + 7)%7);
			var nextMonth = new Date(prevMonth);
			nextMonth.setDate(nextMonth.getDate() + 42);
			nextMonth = nextMonth.valueOf();
			var html = [];
			var clsName,
				prevY,
				prevM;
			while(prevMonth.valueOf() < nextMonth) {
				if (prevMonth.getDay() === this.weekStart) {
					html.push('<tr>');
				}
				clsName = this.onRender(prevMonth);
				prevY = prevMonth.getFullYear();
				prevM = prevMonth.getMonth();
				if ((prevM < month &&  prevY === year) ||  prevY < year) {
					clsName += ' old';
				} else if ((prevM > month && prevY === year) || prevY > year) {
					clsName += ' new';
				}
				if (prevMonth.valueOf() === currentDate) {
					clsName += ' active';
				}
				html.push('<td class="day '+clsName+'">'+prevMonth.getDate() + '</td>');
				if (prevMonth.getDay() === this.weekEnd) {
					html.push('</tr>');
				}
				prevMonth.setDate(prevMonth.getDate()+1);
			}
			this.picker.find('.datepicker-days tbody').empty().append(html.join(''));
			var currentYear = this.date.getFullYear();
			
			var months = this.picker.find('.datepicker-months')
						.find('th:eq(1)')
							.text(year)
							.end()
						.find('span').removeClass('active');
			if (currentYear === year) {
				months.eq(this.date.getMonth()).addClass('active');
			}
			
			html = '';
			year = parseInt(year/10, 10) * 10;
			var yearCont = this.picker.find('.datepicker-years')
								.find('th:eq(1)')
									.text(year + '-' + (year + 9))
									.end()
								.find('td');
			year -= 1;
			for (var i = -1; i < 11; i++) {
				html += '<span class="year'+(i === -1 || i === 10 ? ' old' : '')+(currentYear === year ? ' active' : '')+'">'+year+'</span>';
				year += 1;
			}
			yearCont.html(html);
		},
		
		click: function(e) {
			e.stopPropagation();
			e.preventDefault();
			var target = $(e.target).closest('span, td, th');
			if (target.length === 1) {
				switch(target[0].nodeName.toLowerCase()) {
					case 'th':
						switch(target[0].className) {
							case 'switch':
								this.showMode(1);
								break;
							case 'prev':
							case 'next':
								this.viewDate['set'+DPGlobal.modes[this.viewMode].navFnc].call(
									this.viewDate,
									this.viewDate['get'+DPGlobal.modes[this.viewMode].navFnc].call(this.viewDate) + 
									DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1)
								);
								this.fill();
								this.set();
								break;
						}
						break;
					case 'span':
						if (target.is('.month')) {
							var month = target.parent().find('span').index(target);
							this.viewDate.setMonth(month);
						} else {
							var year = parseInt(target.text(), 10)||0;
							this.viewDate.setFullYear(year);
						}
						if (this.viewMode !== 0) {
							this.date = new Date(this.viewDate);
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						this.showMode(-1);
						this.fill();
						this.set();
						break;
					case 'td':
						if (target.is('.day') && !target.is('.disabled')){
							var day = parseInt(target.text(), 10)||1;
							var month = this.viewDate.getMonth();
							if (target.is('.old')) {
								month -= 1;
							} else if (target.is('.new')) {
								month += 1;
							}
							var year = this.viewDate.getFullYear();
							this.date = new Date(year, month, day,0,0,0,0);
							this.viewDate = new Date(year, month, Math.min(28, day),0,0,0,0);
							this.fill();
							this.set();
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						break;
				}
			}
		},
		
		mousedown: function(e){
			e.stopPropagation();
			e.preventDefault();
		},
		
		showMode: function(dir) {
			if (dir) {
				this.viewMode = Math.max(this.minViewMode, Math.min(2, this.viewMode + dir));
			}
			this.picker.find('>div').hide().filter('.datepicker-'+DPGlobal.modes[this.viewMode].clsName).show();
		}
	};
	
	$.fn.datepicker = function ( option, val ) {
		return this.each(function () {
			var $this = $(this),
				data = $this.data('datepicker'),
				options = typeof option === 'object' && option;
			if (!data) {
				$this.data('datepicker', (data = new Datepicker(this, $.extend({}, $.fn.datepicker.defaults,options))));
			}
			if (typeof option === 'string') data[option](val);
		});
	};

	$.fn.datepicker.defaults = {
		onRender: function(date) {
			return '';
		}
	};
	$.fn.datepicker.Constructor = Datepicker;
	
	var DPGlobal = {
		modes: [
			{
				clsName: 'days',
				navFnc: 'Month',
				navStep: 1
			},
			{
				clsName: 'months',
				navFnc: 'FullYear',
				navStep: 1
			},
			{
				clsName: 'years',
				navFnc: 'FullYear',
				navStep: 10
		}],
		dates:{
			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
			daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
			months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		isLeapYear: function (year) {
			return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0))
		},
		getDaysInMonth: function (year, month) {
			return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month]
		},
		parseFormat: function(format){
			var separator = format.match(/[.\/\-\s].*?/),
				parts = format.split(/\W+/);
			if (!separator || !parts || parts.length === 0){
				throw new Error("Invalid date format.");
			}
			return {separator: separator, parts: parts};
		},
		parseDate: function(date, format) {
			var parts = date.split(format.separator),
				date = new Date(),
				val;
			date.setHours(0);
			date.setMinutes(0);
			date.setSeconds(0);
			date.setMilliseconds(0);
			if (parts.length === format.parts.length) {
				var year = date.getFullYear(), day = date.getDate(), month = date.getMonth();
				for (var i=0, cnt = format.parts.length; i < cnt; i++) {
					val = parseInt(parts[i], 10)||1;
					switch(format.parts[i]) {
						case 'dd':
						case 'd':
							day = val;
							date.setDate(val);
							break;
						case 'mm':
						case 'm':
							month = val - 1;
							date.setMonth(val - 1);
							break;
						case 'yy':
							year = 2000 + val;
							date.setFullYear(2000 + val);
							break;
						case 'yyyy':
							year = val;
							date.setFullYear(val);
							break;
					}
				}
				date = new Date(year, month, day, 0 ,0 ,0);
			}
			return date;
		},
		formatDate: function(date, format){
			var val = {
				d: date.getDate(),
				m: date.getMonth() + 1,
				yy: date.getFullYear().toString().substring(2),
				yyyy: date.getFullYear()
			};
			val.dd = (val.d < 10 ? '0' : '') + val.d;
			val.mm = (val.m < 10 ? '0' : '') + val.m;
			var date = [];
			for (var i=0, cnt = format.parts.length; i < cnt; i++) {
				date.push(val[format.parts[i]]);
			}
			return date.join(format.separator);
		},
		headTemplate: '<thead>'+
							'<tr>'+
								'<th class="prev">&lsaquo;</th>'+
								'<th colspan="5" class="switch"></th>'+
								'<th class="next">&rsaquo;</th>'+
							'</tr>'+
						'</thead>',
		contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
	};
	DPGlobal.template = '<div class="datepicker dropdown-menu">'+
							'<div class="datepicker-days">'+
								'<table class=" table-condensed">'+
									DPGlobal.headTemplate+
									'<tbody></tbody>'+
								'</table>'+
							'</div>'+
							'<div class="datepicker-months">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
								'</table>'+
							'</div>'+
							'<div class="datepicker-years">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
								'</table>'+
							'</div>'+
						'</div>';

}( window.jQuery );
	

});/*Document Ready End*//////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Gallery Filtering and Responsiveness Function
*******************************************/
var gallery = (function( $ ) {
	'use strict';

	var $grid = $('.gallery-grid'),
			$filterOptions = $('.filters'),
			$sizer = $grid.find('.shuffle__sizer'),

	init = function() {

		// None of these need to be executed synchronously
		setTimeout(function() {
			listen();
			setupFilters();
		}, 100);

		$grid.on('loading.shuffle done.shuffle shrink.shuffle shrunk.shuffle filter.shuffle filtered.shuffle sorted.shuffle layout.shuffle', function(evt, shuffle) {
			// Make sure the browser has a console
			if ( window.console && window.console.log && typeof window.console.log === 'function' ) {
				console.log( 'Shuffle:', evt.type );
			}
		});

		// instantiate the plugin
		$grid.shuffle({
			itemSelector: '.gallery-item',
			sizer: $sizer
		});
	},

	// Set up button clicks
	setupFilters = function() {
		var $btns = $filterOptions.children();
		$btns.on('click', function(e) {
			var $this = $(this),
					isActive = $this.hasClass( 'active' ),
					group = $this.data('group');
					$('.filters .active').removeClass('active');
					$this.addClass('active');

			// Filter elements
			$grid.shuffle( 'shuffle', group );
			
		});

		$btns = null;
	},

	listen = function() {
		var debouncedLayout = $.throttle( 300, function() {
			$grid.shuffle('update');
		});

		// Get all images inside shuffle
		$grid.find('img').each(function() {
			var proxyImage;

			// Image already loaded
			if ( this.complete && this.naturalWidth !== undefined ) {
				return;
			}

			// If none of the checks above matched, simulate loading on detached element.
			proxyImage = new Image();
			$( proxyImage ).on('load', function() {
				$(this).off('load');
				debouncedLayout();
			});

			proxyImage.src = this.src;
		});

		// Because this method doesn't seem to be perfect.
		setTimeout(function() {
			debouncedLayout();
		}, 500);
	};

	return {
		init: init
	};

	
	
	
}( jQuery ));	
	
/************************************************************************/
