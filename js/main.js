var DIEGO = {};

DIEGO.Main = function() {
    var exec = function(controller) {
        var myClass = DIEGO,
            action = "init";
        if (controller !== "" && myClass[controller] && typeof myClass[controller][action] == "function") {
            myClass[controller][action]();
        }
    },
    init = function() {
        var m = $('body'),
            controller = m.attr("data-controller");
            exec(controller);
    };
    return {
        init: init
    }
}();

DIEGO.PortfolioHome = function(){
    var settings = $.extend({
      // Get the form.
      form: $('#contact'),
      // Get the messages div.
      formMessages: $('#form-messages'),
    });

    var sticky_relocate = function (){
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-anchor').offset().top;
        if (window_top > div_top) {
            $('#tf-menu').addClass('stick');
        } else {
            $('#tf-menu').removeClass('stick');
        }
    },
    scrollBehaviour = function (){
      $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top - 70
            }, 1000);
            return false;
          }
        }
      });
    },
    // Set up an event listener for the contact form.
    sendEmail = function(event) {
        // Stop the browser from submitting the form.
        event.preventDefault();
        // Serialize the form data.
        var formData = $(settings.form).serialize();
        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(settings.form).attr('action'),
            data: formData
        })
        .done(function(response){
          // Make sure that the formMessages div has the 'success' class.
          $(settings.formMessages).removeClass('error');
          $(settings.formMessages).addClass('success');

          // Set the message text.
          $(settings.formMessages).html(response);

          // Clear the form.
          $('#name').val('');
          $('#email').val('');
          $('#message').val('');
      })
      .fail(function(data) {
          // Make sure that the formMessages div has the 'error' class.
          $(settings.formMessages).removeClass('success');
          $(settings.formMessages).addClass('error');

          // Set the message text.
          if (data.responseText !== '') {
              $(settings.formMessages).html(data.responseText);
          } else {
              $(settings.formMessages).html('Oops! An error occured and your message could not be sent.');
          }
      });
    },
    init = function (){
      scrollBehaviour();
      $(window).scroll(sticky_relocate);
      sticky_relocate();
      $(settings.form).submit(sendEmail);
    };
    return {
      init : init
    }
}();

$(document).ready(function(){
  DIEGO.Main.init();
});
