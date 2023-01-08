Drupal.behaviors.assignment = {
   attach: function (context, drupalSettings) {
   console.log(context);
   console.log(drupalSettings);
   jQuery.ajax({
      url: '/specbee/web/getupdatedDateTime',
      method: 'get',
      data: {},
      contentType: 'application/json',
      success: function(jsonresponse){
         console.log(jsonresponse);
         jQuery('#country').text(jsonresponse.location.country);
         jQuery('#city').text(jsonresponse.location.city);
         jQuery('#timezone').text(jsonresponse.location.timezone);
         jQuery('#time').text(jsonresponse.time);
      }
   });
}};