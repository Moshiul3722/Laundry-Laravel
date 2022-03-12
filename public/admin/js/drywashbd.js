$('.metismenu, .nav-second-level').on('click', 'li', function () {
    $('.metismenu li.active, .nav-second-level li.active').removeClass('active');
    $(this).addClass('active');
});





