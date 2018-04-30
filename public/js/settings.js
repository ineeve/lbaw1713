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

  // Add interest
  $('#interests form').submit(function(event) {
    event.preventDefault();
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: '/api/settings/interests',
      method: 'POST',
      data: {
        interest_id: event.target.interest_id.value
      },
      success: function (result) {
        console.log(result);
      }
    })
  });

  // Remove interest
  $('#interests a.remove_section').click(function(event) {
    event.preventDefault();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: '/api/settings/interests',
      method: 'DELETE',
      data: {
        interest_id: event.target.getAttribute('section-id')
      },
      success: function (result) {

      }
    });
  });

});