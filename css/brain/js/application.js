/* ========================================================
*
* It's Brain - premium responsive admin template
*
* ========================================================
*
* File: application_blank.js;
* Description: Minimum of necessary js code for blank page.
* Version: 1.0
*
* ======================================================== */
if (window.addEventListener){ // W3C standard
	window.addEventListener('load', initApplication, false);
}else if (window.attachEvent){ // Microsoft
	window.attachEvent('onload', initApplication);
}
function initApplication(){
	$(function() {
		/* # Bootstrap Plugins
		================================================== */
			//===== Loading button =====//
			$('.btn-loading').click(function () {
				var btn = $(this)
				btn.button('loading')
				setTimeout(function () {
					btn.button('reset')
				}, 3000)
			});
			//===== Add fadeIn animation to dropdown =====//
			$('.dropdown, .btn-group').on('show.bs.dropdown', function(e){
				$(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100);
			});
			//===== Add fadeOut animation to dropdown =====//
			$('.dropdown, .btn-group').on('hide.bs.dropdown', function(e){
				$(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
			});
		/* # Interface Related Plugins
		================================================== */
			//===== Collapsible navigation =====//
			$('.expand').collapsible({
				defaultOpen: 'second-level,third-level',
				cssOpen: 'level-opened',
				cssClose: 'level-closed',
				speed: 150
			});
		/* # Default Layout Options
		================================================== */
			//===== Hiding sidebar =====//
			$('.sidebar-toggle').click(function () {
				if($('.page-container').hasClass('hidden-sidebar'))
					$('.sidebar').show();
				else
					$('.sidebar').hide();
				$('.page-container').toggleClass('hidden-sidebar');
			});
	});
} //init application
