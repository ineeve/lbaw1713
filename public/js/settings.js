'use strict';

$(document).ready(function () {

  $('#notifications .custom-checkbox').click(function(e) {
    if (e.target.tagName.toUpperCase() === "LABEL") {
      return;
    }

    let method;
    if ($(this).find("[type=checkbox]").is(":checked")) { // turned on
      method = 'POST';
    } else { // turned off
      method = 'DELETE';
    }

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    jQuery.ajax({
      url: '/api/settings/notifications/' + e.target.id,
      method: method
    });
  });

  // $('#notifications .custom-checkbox').prop('checked', false) {

  // }

});

// function toggleNotification(checkbox) {

//   console.log(checkbox);

//   // jQuery.ajax({
//   //   url:,
//   //   method: 'POST',
//   //   success: function() {

//   //   }
//   //});
// }