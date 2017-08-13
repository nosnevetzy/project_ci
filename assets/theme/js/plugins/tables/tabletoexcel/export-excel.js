jQuery(function ()
 {
     jQuery(document).on('click', '.csv_export', generate_excel);
 });
 function generate_excel() {
     var title = $(this).attr('id');
     $(".generate").table2excel({
         // exclude CSS class
         exclude: ".excludeThisClass",
         name: "Excel Document Name",
         filename: title
     });
 }