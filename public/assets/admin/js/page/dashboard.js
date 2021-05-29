
"use strict";
$(function() {
    $(".drop-day").on('click',function(){
       var days={
          0:"Today",
          7:"7 Days",
          15:"15 Days",
          30:"30 Days"
        };
        var id=$(this).data("id");
        var val=$(this).data("val");
        $.ajax({
          url: adminUrl+"/dashboard-data/"+val+"/"+id,
      }).always(function (data) { 
        $("#"+id+"-count").html(data.count)
        $("#"+id+"-growth").html(data.growth)
        $("#"+id+"-class").removeClass()
        $("#"+id+"-class").addClass(data.class)
        $("#"+id+"-day").html(days[val])
      });
    })
    $(".dashboard-table-row").on('click',function(){
      window.location.href=$(this).data('href');
    })
  })