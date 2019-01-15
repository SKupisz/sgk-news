var a = 0;
var b = 0;
$("#u10ial").click(
  function() {
    if(a == 0)
    {
      $("#u10ic").show(500);
      a = 1;
    }
    else {
      $("#u10ic").hide(500);
      a = 0;
    }

  }
);
