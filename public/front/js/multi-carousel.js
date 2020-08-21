
//three item in row slider
// Instantiate the Bootstrap carousel
$('.multi-three-in-row-carousel').carousel({
    interval: false
    });
    // for every slide in carousel, copy the next slide's item in the slide.
    // Do the same for the next, next item.
$('.multi-three-in-row-carousel .item').each(function(){
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
    
    if (next.next().length>0) {
      next.next().children(':first-child').clone().appendTo($(this));
    } else {
      $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
    }
    
});
    
    
    
    
//four item in a row
// Instantiate the Bootstrap carousel
$('.multi-four-in-row-carousel').carousel({
    interval: false
});
// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
$('.multi-four-in-row-carousel .item').each(function(){
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
    
    if (next.next().length>0) {
      next.next().children(':first-child').clone().appendTo($(this));
    } else {
      $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
    }
    
    if (next.next().next().length>0) {
        next.next().next().children(':first-child').clone().appendTo($(this));
    }
    else {
        $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
    }
    
});
    