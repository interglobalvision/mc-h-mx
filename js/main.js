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

      if ($('.lang-toggle').length) {
        _this.bindLangToggle();
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

  bindLangToggle: function() {
    $('.lang-toggle').bind('click', function() {
      $('.page-content').toggleClass('active');
    });
  },
};

Site.Camera = {
  init: function() {
    _this = this;

    _this.isLocalHost();
    _this.bindButtons();
    _this.bindFader();
  },

  isLocalHost: function() {
    _this = this;

    if (location.hostname === "localhost" || _this.getUrlParameter('isLocal')) {
      _this.isLocal = true; 

      _this.setLocalStyles();
    } else {
      _this.isLocal = false; 
    }

  },

  setLocalStyles: function() {
    $('.cam-feed').css('background-image', 'url(http://192.168.1.70)');
  },

  bindButtons: function() {
    var command;
    // CHANGE THIS BASEURL //
    var baseUrl = 'http://estudioherrera.servehttp.com/api/';

    if(_this.isLocal) {
      baseUrl = 'http://192.168.1.70/api/';
    }

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
      var projectOpacity = $(this).val() > 50 ? (100 - $(this).val()) * .02 : 100,
        camOpacity = $(this).val() < 51 ? $(this).val() * .02 : 100;

      $('.cam-feed').css('opacity', camOpacity);
      $('.home-project-item').css('opacity', projectOpacity);
    });
  },

  getUrlParameter: function(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
    }
  },

};

Site.init();
