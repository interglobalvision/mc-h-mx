/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      if ($('.cam-feed').length) {
        _this.Camera.init();
      }
    });

  },

  onResize: function() {
    var _this = this;

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Camera = {
  init: function() {
    _this = this;

    _this.bindButtons();
    _this.bindFader();
  },

  bindButtons: function() {
    var command;
    // CHANGE THIS BASEURL //
    var baseUrl = 'http://www.interglobal.vision/';

    $('.cam-button').on('click', function() {
      command = $(this).attr('data-command');

      $.ajax({
        method: "POST",
        url: baseUrl + command,
      }).done(function( response ) {
        console.log(response);
      });
    });
  },

  bindFader: function() {
    $(document).on('input', '.cam-fader', function() {
      console.log($(this).val());
      $('.cam-feed').css('opacity', $(this).val() * .01);
      $('.home-project-item').css('opacity', (100 - $(this).val()) * .01);
    });
  },
};

Site.init();