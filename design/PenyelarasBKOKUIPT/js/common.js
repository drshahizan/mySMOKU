$(function() {
	"use strict";
	skinChanger();
    initSparkline();
    CustomJs();
    SearchDiv();
    
    setTimeout(function() {
        $('.page-loader-wrapper').fadeOut();
	}, 30);
});

// Sparkline chart
function initSparkline() {
	var values2 = getRandomValues();
	var paramsBar = {
        type: 'bar',
        barWidth: 3,
        height: 15,
        barColor: '#f46b45'
    };
    $('#mini-bar-chart1').sparkline(values2[0], paramsBar);
    paramsBar.barColor = '#2c83b6';
    $('#mini-bar-chart2').sparkline(values2[1], paramsBar);
    paramsBar.barColor = '#61bda1';
    $('#mini-bar-chart3').sparkline(values2[2], paramsBar);
	paramsBar.barColor = '#a5d8a2';

	function getRandomValues() {
        // data setup
        var values = new Array(20);

        for (var i = 0; i < values.length; i++) {
            values[i] = [5 + randomVal(), 10 + randomVal(), 15 + randomVal(), 20 + randomVal(), 30 + randomVal(),
                35 + randomVal(), 40 + randomVal(), 45 + randomVal(), 50 + randomVal()
            ];
        }

        return values;
    }
    function randomVal() {
        return Math.floor(Math.random() * 80);
	}
	
	$(".sparkline").each(function() {
		var $this = $(this);
		$this.sparkline('html', $this.data());
	});

	// Bar charts using inline values
	$('.sparkbar').sparkline('html', { type: 'bar' });	
}
// Skin changer
function skinChanger() {
	$('.choose-skin li').on('click', function() {
	    var $body = $('#body');
	    var $this = $(this);
  
	    var existTheme = $('.choose-skin li.active').data('theme');

	    $('.choose-skin li').removeClass('active');
	    $body.removeClass('theme-' + existTheme);
	    $this.addClass('active');
	    var newTheme = $('.choose-skin li.active').data('theme');
	    $body.addClass('theme-' + $this.data('theme'));
	});

	// Theme Setting 
	$('.themesetting .theme_btn').on('click', function() {
		$('.themesetting').toggleClass('open');
	});

	// RTL version
    $(".rtl_mode input").on('change',function() {
        if(this.checked) {
            $("body").addClass('rtl_active');
        }else{
            $("body").removeClass('rtl_active');
        }
    });
	// Rgradient mode version
    $(".gradient_mode input").on('change',function() {
        if(this.checked) {
            $(".theme-bg").addClass('gradient');
        }else{
            $(".theme-bg").removeClass('gradient');
        }
	});
}
// All page custom js
function CustomJs() {

	// sidebar navigation
	$('#main-menu').metisMenu();

	// sidebar nav scrolling
	$('#left-sidebar .sidebar-scroll').slimScroll({
		height: 'calc(100vh - 65px)',
		wheelStep: 10,
		touchScrollStep: 50,
		color: 'rgba(23,25,28,0.02',
		size: '3px',
		borderRadius: '3px',
		alwaysVisible: false,
		position: 'right',
	});

	// off-canvas menu toggle
	$('.btn-toggle-offcanvas').on('click', function() {
		$('body').toggleClass('offcanvas-active');
	});

	$('#main-content').on('click', function() {
		$('body').removeClass('offcanvas-active');
		$('.sticky-note').removeClass('open');
	});

	$('.right_toggle, .overlay').on('click', function() {
		$('#rightbar').toggleClass('open');
		$('.overlay').toggleClass('open');
	});

	// Sticky note 
	$('.right_note').on('click', function() {
		$('.sticky-note').toggleClass('open');
	});

	// Bootstrap tooltip init
	if($('[data-toggle="tooltip"]').length > 0) {
		$('[data-toggle="tooltip"]').tooltip();
	}
	if($('[data-toggle="popover"]').length > 0) {
		$('[data-toggle="popover"]').popover();
	}

	$(window).on('load', function() {
		// for shorter main content
		if($('#main-content').height() < $('#left-sidebar').height()) {
			$('#main-content').css('min-height', $('#left-sidebar').innerHeight() - $('footer').innerHeight());
		}
	});

	$(window).on('load resize', function() {
		if($(window).innerWidth() < 420) {
			$('.navbar-brand logo.svg').attr('src', 'assets/images/icon.svg');
		} else {
			$('.navbar-brand icon-light.svg').attr('src', 'assets/images/logo.svg');
		}
	});
    
    // Full screen class 
	$('.full-screen').on('click', function() {
		$(this).parents('.card').toggleClass('fullscreen');
    });
    
    // Full screen browser windows
    function toggleFullscreen(elem) {
        elem = elem || document.documentElement;
        if (!document.fullscreenElement && !document.mozFullScreenElement &&
			!document.webkitFullscreenElement && !document.msFullscreenElement) {
			if (elem.requestFullscreen) {
				elem.requestFullscreen();
			} else if (elem.msRequestFullscreen) {
				elem.msRequestFullscreen();
			} else if (elem.mozRequestFullScreen) {
				elem.mozRequestFullScreen();
			} else if (elem.webkitRequestFullscreen) {
				elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
			}
        } else {
			if (document.exitFullscreen) {
				document.exitFullscreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			}
        }
    }
      
    document.getElementById('btnFullscreen').addEventListener('click', function() {
        toggleFullscreen();
    });

	// progress bars
    $('.progress .progress-bar').progressbar({
		display_text: 'none'
	});	

	// header dropdown add new class
	$('.header-dropdown .dropdown-toggle').on('click', function() {
		$('.header-dropdown li .dropdown-menu').toggleClass('vivify fadeIn');
	});

	// Select all checkbox
	$('.check-all').on('click',function(){
	
		if(this.checked){
			$(this).parents('.check-all-parent').find('.checkbox-tick').each(function(){
				this.checked = true;
			});
		}else{
			$(this).parents('.check-all-parent').find('.checkbox-tick').each(function(){
				this.checked = false;
			});
		}
	});
	$('.checkbox-tick').on('click',function(){
		if($(this).parents('.check-all-parent').find('.checkbox-tick:checked').length == $(this).parents('.check-all-parent').find('.checkbox-tick').length){
			$(this).parents('.check-all-parent').find('.check-all').prop('checked',true);
		}else{
			$(this).parents('.check-all-parent').find('.check-all').prop('checked',false);
		}
	});

	// inbox star
	$('a.mail-star').on('click', function () {
		$(this).toggleClass('active')
    });
    
    // left menu toggle 
	$('.menu_toggle').on('click', function () {
		$('body').toggleClass('toggle_menu_active')
	});

	// sidebar active
    $(".sidebar_light input").on('change',function() {
        if(this.checked) {
            $(".sidebar").addClass('light_active');
        }else{
            $(".sidebar").removeClass('light_active');
        }
	});	
}
// recent search div 
function SearchDiv() {
    $(".search-form input").focus(function() {
        $('.recent_searche').show('slow');
        //return false;
    }); 
    
    $('.search-form input').blur(function(){
        if( !$(this).val() ) {
            $('.recent_searche').hide('slow');
        }
    });
}

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});
};

// Light/Dark
var toggleSwitch = document.querySelector('.dark_mode input[type="checkbox"]');
var currentTheme = localStorage.getItem('theme');

if (currentTheme) {
	document.documentElement.setAttribute('data-theme', currentTheme);

	if (currentTheme === 'dark') {
		toggleSwitch.checked = true;
	}
}

function switchTheme(e) {
	if (e.target.checked) {
		document.documentElement.setAttribute('data-theme', 'dark');
		localStorage.setItem('theme', 'dark');
	}
	else {        document.documentElement.setAttribute('data-theme', 'light');
		localStorage.setItem('theme', 'light');
	}    
}

toggleSwitch.addEventListener('change', switchTheme, false);



var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e44175da89cda5a188591ec/1e0t1qduj';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();