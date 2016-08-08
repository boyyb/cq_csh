$(document).ready(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);

	$('#jqjs_left .accordion li:first').addClass('open');
	$('#jqjs_left .accordion li').click(function(){
		var index = $('#jqjs_left .accordion li').index(this);
		$(this).siblings().removeClass('open');
		$('#jqjs_right .jqjs'+index).css('display','').siblings().css('display','none');
	});

	$('#jqjs_left .submenu li').click(function(){
		var index = $('#jqjs_left .submenu li').index(this)+1;
		$('#jqjs_right .other'+index).css('display','').siblings().css('display','none');
		$('#jqjs_right div[class^=jqjs]').css('display','none');

	});
});