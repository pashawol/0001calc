
jQuery(document).ready(function ($) {
  $(".calculator-block__aside-group").each(function(){
    var th = $(this);
    var $d3 = th.find(".slider-js");
    
    $d3.ionRangeSlider({
      skin: "round",
      hide_min_max: 'true',
      hide_from_to: 'true',
    });

    // th.find('.range-result-js').text(from); // FROM value
    th.find('.range-result-js').text($d3.prop("value").toString().split("").reverse().map((v,i,a) => (i<a.length && i%3==0) ? v + " ": v).reverse().join("")); // FROM value
  $d3.on("change", function () {
    var $inp = $(this);
    var from = $inp.prop("value").toString().split("").reverse().map((v,i,a) => (i<a.length && i%3==0) ? v + " ": v).reverse().join(""); // reading input value
    var from2 = $inp.data("from"); // reading input data-from attribute
    
    th.find('.range-result-js').text(from); // FROM value
  });
})

// большой рэндж
  $(".calculator-block__main-group").each(function(){
    var th = $(this);
    var $d3 = th.find(".slider-js");
    
    $d3.ionRangeSlider({
      skin: "round",
      // hide_min_max: 'true',
      hide_from_to: 'true',
    });

    // th.find('.range-result-js').text(from); // FROM value
    th.find('.result-js').val($d3.prop("value")); // FROM value
  $d3.on("change", function () {
    var $inp = $(this);
    var from = $inp.prop("value"); // reading input value
    var from2 = $inp.data("from"); // reading input data-from attribute
    
    th.find('.result-js').val(from); // FROM value
  });
  $('.calculator-block__main-group').on('change  input  cut  copy  paste', '.result-js', function () {
    var th = $(this);
    var data = th.val();
    var min = +data;
    // th.val(data + ' т')
    var $d3_instance = $(this).parents(".calculator-block__main-group").find(".slider-js").data("ionRangeSlider");
    
    $d3_instance.update({
      from: min,
    })
  });
})




});