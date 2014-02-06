jQuery(function($){
  $('ul.sidenav>li>a').each(function() {
    var next = $(this).next();
    if (next.is('ul.nav')) {
      next.hide();
      $(this).addClass('parent');
      $(this).prepend('<span class="glyphicon glyphicon-chevron-right pull-right"></span>');
    }
  });
  $('ul.sidenav>li>a.parent').click(function() {
    $(this).next().slideToggle();
  });
});