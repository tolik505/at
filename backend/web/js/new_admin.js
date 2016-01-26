/**
 * Created by Viacheslav on 04-Aug-15.
 */
function customSelect2(){

	/*********************************************
	 * SELECT2 FILLED
	 */
	var customSelect = $('select.form-control');
	var customSelectFilter = $('select.form-control-filters');
	var customSelectFilter2 = $('.input-md');
	var customSelectFilterDots = $('select.form-control-filters.form-control-dots');

	customSelect.select2();

	customSelect
			.on('select2-loaded', function() {
				var $this = $(this);
				var formGroup = $this.closest('.form-group');

				if ( !formGroup.hasClass('filled') ) {
					formGroup.addClass('filled');
				}
			})
			.on('select2-close', function() {
				var $this = $(this);
				var formGroup = $this.closest('.form-group');
				//  #remove
				if ( !formGroup.find('.select2-chosen').text().trim().length ) {
					formGroup.removeClass('filled');
				}
			});

	/*********************************************
	 * PLUGINS
	 */

	customSelect.select2({
		containerCssClass       : "select2-custom",
		dropdownCssClass        : "select2-custom-drop",
		showSearchBox           : false,
		minimumResultsForSearch : -1,
		dropdownAutoWidth       : true
	});

	customSelectFilter.select2({
		containerCssClass       : "select2-custom       select2-filters",
		dropdownCssClass        : "select2-custom-drop  select2-drop-filters",
		//showSearchBox           : false,
		//minimumResultsForSearch : -1,
		dropdownAutoWidth       : true,
		placeholderOption: function () {
			return undefined;
		}
	});

	customSelectFilterDots.select2({
		containerCssClass       : "select2-custom       select2-filters         select2-filter-dots",
		dropdownCssClass        : "select2-custom-drop  select2-drop-filters    select2-drop-dots",
		showSearchBox           : false,
		minimumResultsForSearch : -1,
		dropdownAutoWidth       : true,
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) { return m; },
		placeholderOption: function () {
			return undefined;
		}
	});

	function format(state) {
		var originalOption = state.element;
		return "<span class='filter-dot-" +  $(originalOption).data('dot') + "'></span>" + state.text;
	}

	$(document).on("select2-open", customSelect, function() {
		var el;
		var s2result = $('.select2-results');
		s2result.each(function() {
			var api = $(this).data('jsp');

			if (api !== undefined) api.destroy();
		});

		s2result.each(function() {
			if ($(this).parent().css("display") != 'none') el = $(this);

			if (el === undefined) return;

			el.mCustomScrollbar({
				mouseWheel: true,
				theme: 'dark',
				advanced: {
					updateOnContentResize: true
				},
				mouseWheelPixels: 200
			});
		});
	});

	$(".field-product-variants").sortable({
		handle: ".glyphicon-move",
		placeholder: "sortable-highlight"
	});
	$(".field-product-variants").disableSelection();

	customSelect.each(function () {
		var $this = $(this);
		var formGroup = $this.closest('.form-group');
		if ( formGroup.find('.select2-chosen').text().trim().length ) {
			formGroup.addClass('filled');
		}
	});
}


$(document).ready(function() {


	var viewport = {
		width  : $(window).width(),
		height : $(window).height()
	};

	var mobile;
	if ( viewport.width <= 767 ) {
		mobile = true;
	}


	$('.navbar-toggle').on("click", function (e) {
		e.stopPropagation();
		var el = $(this);
		el.toggleClass('collapsed');
		el.parent().next().toggleClass('collapsed').find('.navbar-left').fadeToggle();
		if (!(el.hasClass('collapsed'))) closeMenu();
	});


	/*********************************************
	 * DROPDOWN TOGGLE
	 */

	$('.dropdown-toggle').on('click', function() {
		var $this = $(this);
		$this
			.parent()
				.siblings()
					.find('.dropdown-menu')
					.fadeOut()
					.end()
				.end()
			.closest('.navbar-nav')
				.siblings()
				.find('.dropdown-menu')
				.fadeOut();

		$this.next().fadeIn();

		if($this.parent().hasClass('open') && !$this.parent().hasClass('dropdown-submenu')) {
			$this.next().fadeOut();
		}

		/*if($this.parent().siblings().hasClass('active')) {
			$this.parent().siblings().removeClass('active');
		}*/
	});

	if (mobile) {

		$('.dropdown-toggle').on('click', function() {
			var $this = $(this);
			if( $this.parent().hasClass('dropdown') ) {
				$this.closest('.navbar-left').addClass('level-two');
			}
			if( $this.parent().hasClass('dropdown-submenu') ) {
				$this.closest('.navbar-left').addClass('level-three');
			}
		});

		var navbarLeft = $('.navbar-left.nav');
		// append nav-back
		navbarLeft
			.find('.dropdown-menu')
			.append('<li class="nav-back"><a href="#">Вернуться назад</a></li>');
		// use nav-back
		$(document).on('click','.nav-back', function(e) {

			e.preventDefault();
			e.stopImmediatePropagation();
			e.stopPropagation();

			if ( navbarLeft.hasClass('level-three') ) {
				navbarLeft.removeClass('level-three')
			} else {
				navbarLeft.removeClass('level-two');
				$(this)
					.closest('.dropdown.open').removeClass('open');
			}

		});
	}


	$(document).on('click', function (e) {
			closeMenu();
	});

	var closeMenu = function() {
		$('.dropdown-menu, .navbar-collapse.collapsed .navbar-left').fadeOut();
		$('.navbar-toggle, .navbar-collapse, .navbar-left .dropdown.open').removeClass('collapsed open');
		$('.navbar-left').removeClass('level-two level-three');
	};


	/*********************************************
	 *  FORM FILLED CONTROL
	 */

	var formGroup   = $('.form-group');




	formGroup.on('focus', '.form-control, .redactor-editor', function () {
		// filled for non-select2
		if ( !$(this).parent().find('.select2-custom').length ) {
			$(this).closest('.form-group').removeClass('filled');
		}
	});

	formGroup.on('blur', '.form-control, .redactor-editor', function () {
		var $this = $(this);
		// rules for non-redactor non-select2 inputs
		if ( $this.val() === '' && !$this.parent().hasClass('redactor-box') && !$(this).parent().find('.select2-custom').length ) {
			$this.closest('.form-group').removeClass('filled');
		} else {
			$this.closest('.form-group').addClass('filled');
		}
		// rules for redactor
		if ( !$this.text().trim().length &&  $this.parent().hasClass('redactor-box') ) {
			$this.closest('.form-group').removeClass('filled');
		}
	});




	/**
	 * FILLED ON LOAD
	 */

	function inpFilled(){
		$('.form-control').each(function() {
			if ( $(this).val() !== '' ) {
				$(this).closest('.form-group').addClass('filled');
			}
		});
	}

	inpFilled();

	$('button[type="reset"]').on('click', function(){
		setTimeout(function(){
			inpFilled();
		},10);
	});

	$(window).on('load', function() {
		$('.redactor-editor').each(function(){
			var $this = $(this);
			if ( $this.text().trim().length ) {
				$this.closest('.form-group').addClass('filled');
			} else if ($this.find('*').length) {
				$this.closest('.form-group').addClass('filled');
			}
		});


	});
	$('input[type="checkbox"]').each(function(){
		var that = $(this);
		if (!that.parents('.checkbox').length) {
			that.parent('label').wrap('<div class="checkbox"></div>')
		}
	});

	$('.checkbox input[type="checkbox"]').on('change', function(){
		if($(this).prop('checked')){
			$(this).closest('label').addClass('active');
		} else{
			$(this).closest('label').removeClass('active');
		}
	});

	$('.checkbox input[type="checkbox"]').each(function(){
		if($(this).prop('checked')){
			$(this).closest('label').addClass('active');
		}
	});

	customSelect2();


});
