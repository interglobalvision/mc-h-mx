/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Cookies */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    if ($('.cam-feed').length) {
      _this.Camera.init();
    }

    $(document).ready(function () {

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
    var _this = this;

    _this.$cameraFeed = $('.cam-feed');
    _this.$fader = $('.cam-fader');
    _this.$projectThumbs = $('.home-project-item');

    _this.isLocalHost();
    _this.bindButtons();
    _this.bindFader();

    if (Cookies.get('faderValue')) {
      _this.setFromCookie();
    }
  },

  isLocalHost: function() {
    var _this = this;

    if (location.hostname === 'localhost' || _this.getUrlParameter('isLocal')) {
      _this.isLocal = true;

      _this.setLocalStyles();
    } else {
      _this.isLocal = false;
    }

  },

  setLocalStyles: function() {
    var _this = this;

    _this.$cameraFeed.css('background-image', 'url(http://192.168.1.70)');
  },

  setFromCookie: function() {
    var _this = this;
    var faderValueFromCookie = Cookies.get('faderValue');

    $({ val: 50 }).animate({ val: faderValueFromCookie }, {
        duration: 100,
        easing: 'linear',
        step: function(val) {
          _this.$fader.val(val);
          _this.setOpacitiesFromFader(val);
        }
    });
  },

  bindButtons: function() {
    var _this = this;
    var command;
    var baseUrl = 'http://estudioherrera.servehttp.com/api/';

    if (_this.isLocal) {
      baseUrl = 'http://192.168.1.70/api/';
    }

    $('.cam-button').on('click', function() {
      command = $(this).attr('data-command');

      $.ajax({
        method: 'POST',
        url: baseUrl + command,
      }).done(function( response ) {
        console.log(response);
      });
    });
  },

  bindFader: function() {
    var _this = this;

    _this.$fader.on('input', function() {
      var faderValue = $(this).val();

      Cookies.set('faderValue', faderValue);
      _this.setOpacitiesFromFader(faderValue);
    });
  },

  setOpacitiesFromFader: function(faderValue) {
    var _this = this;
    var projectOpacity = faderValue > 50 ? (100 - faderValue) * .02 : 100;
    var camOpacity = faderValue < 51 ? faderValue * .02 : 100;

    _this.$cameraFeed.css('opacity', camOpacity);
    _this.$projectThumbs.css('opacity', projectOpacity);
  },

  getUrlParameter: function(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1));
    var sURLVariables = sPageURL.split('&');
    var sParameterName;
    var i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
    }
  },

};

Site.init();