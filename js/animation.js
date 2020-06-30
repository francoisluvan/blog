$(document).on("scroll", function()
{
  if ($(document).scrollTop() >= 1350) // Change 5 par la valeur que tu veux, pour que ça te plaise, tu peux également utiliser scrollDown si tu veux l'agencement inverse
  {
    $("#a-propos").addClass('scale-img'); // Change 50px par la valeur que tu veux pour agrandir ton image
    $("#a-propos .section-heading").addClass('from-left');
    $(" #a-propos .section-subheading").addClass('from-left-2');
      $("#a-propos .section-heading, #a-propos .section-subheading").removeClass('before');
  }
  else  {
    $("#a-propos").removeClass('scale-img');
    $("#a-propos .section-heading").removeClass('from-left');
    $("#a-propos .section-subheading").removeClass('from-left-2');
    $("#a-propos .section-heading, #a-propos .section-subheading").addClass('before');
  }
});



$('#recipeCarousel').carousel({
  interval: 10000
})

$('.carousel .carousel-item').each(function(){
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
    next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
        	next = $(this).siblings(':first');
      	}

        next.children(':first-child').clone().appendTo($(this));
      }
});
