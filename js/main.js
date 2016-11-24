/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Site, Cookies */

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
    _this.bindFader();

    if (Cookies.get('faderValue')) {
      _this.setFromCookie();
    }
  },

  isLocalHost: function() {
    var _this = this;

    if (_this.getUrlParameter('isLocal')) {
      _this.isLocal = true;

      _this.setLocalStyles();
    } else {
      _this.isLocal = false;
    }

  },

  setLocalStyles: function() {
    var _this = this;

    _this.$cameraFeed.css('background-image', 'url(http://mch.local)');
  },

  setFromCookie: function() {
    var _this = this;
    var faderValueFromCookie = Cookies.get('faderValue');

    $({ val: 50 }).animate({ val: faderValueFromCookie }, {
        duration: 100,
        easing: 'linear',
        step: function(val) {
          _this.$fader.val(val);
          _this.setStyleFromFader(val);
        }
    });
  },

  bindFader: function() {
    var _this = this,
      faderValue;

    _this.$fader.on('input', function() {
      faderValue = $(this).val();
      Cookies.set('faderValue', faderValue);
      _this.setStyleFromFader(faderValue);
    });

    $(document).keydown(function(event) {
      if (event.keyCode >= 49 && event.keyCode <= 57) {
        faderValue = ((event.keyCode - 48) * 10);
        _this.$fader.val(faderValue);
        Cookies.set('faderValue', faderValue);
        _this.setStyleFromFader(faderValue);
      }
    });
  },

  setStyleFromFader: function(faderValue) {
    var _this = this;
    var projectOpacity = faderValue > 50 ? (100 - faderValue) * 0.02 : 100;
    var camOpacity = faderValue < 51 ? faderValue * 0.02 : 100;

    _this.$cameraFeed.css('opacity', camOpacity);
    _this.$projectThumbs.css('opacity', projectOpacity);

    // Zoom out
    if (faderValue < 51) {
      var zoomPercent = faderValue / 50;
      var faderEase = _this.easeInOutQuad(zoomPercent);
      var camZoom = 1.05 - (faderEase * 0.05);

      _this.$cameraFeed.css('transform', 'scale(' + camZoom + ')');
    }
  },

  easeInOutQuad: function(t) {
    return t<0.5 ? 2*t*t : -1+(4-2*t)*t;
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
