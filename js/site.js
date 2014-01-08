var menuItem = ".menu-item",
    subMenu = ".sub-menu",
    subMenuItem = ".sub-title",
    menuToggle = ".menu-toggle",
    menuLink = ".menu > .menu-item > a",
    clickEvent = "click",
    mouseEvent = "mouseenter mouseleave";

function debounce(func, wait, immediate) {
  var result;
  var timeout = null;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) result = func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) result = func.apply(context, args);
    return result;
  };
}

// Resets events so $.on can be fired again
function resetEvents()
{
  $(menuItem)
    .off(mouseEvent)
  	.on(mouseEvent);

  $(menuLink)
  	.off(clickEvent)
  	.on(clickEvent);

	$(menuToggle)
  	.off(clickEvent)
  	.on(clickEvent);
}

function initDesktopMenu()
{
  //Enable hover events for desktop menus
  $(menuItem).on({
    mouseenter: function() {
      $(this).find(subMenu).show();
    },
    mouseleave: function() {
      $(this).find(subMenu).hide();
    }
  });
}

function initMobileMenu()
{
  //Click / tap logic for top-level
	$(menuLink).on(clickEvent, function (e) {
    //$(this).next(subMenu).hide();
    e.preventDefault();
    if (!$(this).next(subMenu).is(':visible')) {
      $(this).next(subMenu).show();
      $(this).addClass('active');
    }
    else {
      $(this).next(subMenu).hide();
      $(this).removeClass('active');
    }
	});

  //Click / tap logic for toggle button
	$(menuToggle).on(clickEvent, function (e) {
		e.preventDefault();
    $(this).toggleClass('menu-toggle--active');
		$('nav').toggle();
	});
}

function unloadMobileMenu()
{
  //Reset menu-toggle
  $(menuToggle)
    .removeClass('menu-toggle--active');

  $('a.active').each(function() {
    $(this).removeClass('active');
  });

  //Reset sub-menus
	$(subMenu).each(function () {
    $(this).hide();
	});

  //Remove nav inline style
  $('nav').removeAttr('style');
}

function setMenu()
{
  //if (Modernizr.mq('only all'))
  //{
    var mq = window.matchMedia("(min-width: 50rem)");

    if (mq.matches) {
      resetEvents();
      unloadMobileMenu();
      initDesktopMenu();
    }

    else {
      resetEvents();
      initMobileMenu();
    }
  //}
}

$(document).ready(function () {

  var prevImg = '<svg width="30" height="48" class="prev-btn"><image xlink:href="http://cdn2.valleychurch.eu/img/icons/icon-prev.svg" src="http://cdn2.valleychurch.eu/img/icons/icon-prev.png" width="30" height="48" class="prev-btn" /></svg>';
  var nextImg = '<svg width="30" height="48" class="next-btn"><image xlink:href="http://cdn2.valleychurch.eu/img/icons/icon-next.svg" src="http://cdn2.valleychurch.eu/img/icons/icon-next.png" width="30" height="48" class="next-btn" /></svg>';

  $('.no-js').removeClass('no-js');

  $('.no-follow').click(function (e) {
    e.preventDefault();
  });

  $('.slides').responsiveSlides({
    speed: 500,
    timeout: 8000,
    auto: true,
    nav: true,
    pager: true,
    navContainer: '.slide-control',
    prevText: prevImg,
    nextText: nextImg
  });

  $(".container").fitVids();

  $('p > .fluid-width-video-wrapper').parent('p').addClass('aligncenter');

  FastClick.attach(document.body);

});

$(window).on('load resize orientationchange', function () {
  debounce(setMenu());
});