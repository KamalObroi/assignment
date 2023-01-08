Drupal.behaviors.assignment = {
   attach: function (context, drupalSettings) {   
   jQuery.ajax({
      url: '/specbee/web/getupdatedDateTime',
      method: 'get',
      data: {},
      contentType: 'application/json',
      success: function(jsonresponse){         
         jQuery('#country').text(jsonresponse.location.country);
         jQuery('#city').text(jsonresponse.location.city);
         jQuery('#timezone').text(jsonresponse.location.timezone);
         jQuery('#time').text(jsonresponse.time);
      }
   });
}};