/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Site, Cookies */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    if ($('#cam-feed').length) {
      _this.Camera.init();
    }

    Site.Parallax.init();

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

Site.Parallax = {
  init: function() {

    $.stellar({
      // Set scrolling to be in either one or both directions
      horizontalScrolling: false,
      verticalScrolling: true,

      // Set the global alignment offsets
      horizontalOffset: 0,
      verticalOffset: 0,

      // Refreshes parallax content on window load and resize
      responsive: false,

      // Select which property is used to calculate scroll.
      // Choose 'scroll', 'position', 'margin' or 'transform',
      // or write your own 'scrollProperty' plugin.
      scrollProperty: 'scroll',

      // Select which property is used to position elements.
      // Choose between 'position' or 'transform',
      // or write your own 'positionProperty' plugin.
      positionProperty: 'transform',

      // Enable or disable the two types of parallax
      parallaxBackgrounds: true,
      parallaxElements: true,

      // Hide parallax elements that move outside the viewport
      hideDistantElements: false,
    });

  },
};

Site.Camera = {
  init: function() {
    var _this = this;

    _this.maxZoom = 1.7; // times. eg 2x

    _this.$cameraFeed = $('#cam-feed');
    _this.$xfader = $('#xfader');
    _this.$zoomfader = $('#zoomfader');
    _this.$projectThumbs = $('.home-project-item');

    _this.zoomed = false;

    _this.isLocalHost();
    _this.bind();

    if (Cookies.get('faderValue')) {
      _this.animateFader(Cookies.get('faderValue'));
    } else {
      _this.animateFader(100);
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

  animateFader: function(value) {
    var _this = this;

    $({ val: 50 }).animate({ val: value }, {
        duration: 300,
        easing: 'linear',
        step: function(val) {
          _this.$xfader.val(val);
          _this.setOpacity(val);
        }
    });
  },

  bind: function() {
    var _this = this;

    // Bind crossfader
    _this.$xfader.on('input', function() {
      var faderValue = $(this).val();
      _this.setOpacity(faderValue);
    });


    // Bind zoomfader
    _this.$zoomfader.on('input', function() {
      var faderValue = parseInt($(this).val());
      _this.setZoom(faderValue);
    }).on('change', function() {
      _this.zooming = false;
    });

    // Bind pointer position
    $(document).mousemove(function(e) {
      if(_this.zoomed && !_this.zooming) {
        var valX = e.pageX / window.innerWidth;
        var valY = (e.pageY - window.pageYOffset) / window.innerHeight;

        _this.setLocation(valX,valY);
      }

    });

    // Bind keyboard shortcuts
    $(document).keydown(function(event) {
      if (event.keyCode >= 49 && event.keyCode <= 57) {
        var faderValue = ((event.keyCode - 48) * 10);
        _this.$xfader.val(faderValue);
        _this.setOpacity(faderValue);
      }
    });

    _this.$cameraFeed.imagesLoaded( { background: true }, function() {
      $('#cam-feed-loader').remove();
    });
  },

  setLocation: function(x,y) {
    var _this = this;

    var zoomValue = _this.$zoomfader.val();
    var zoom = ((zoomValue * 0.01 *(_this.maxZoom - 1) ) + 1);

    var range =  1 - 1 / zoom;

    var posX = ((x * range) - (range / 2)) * 100;
    var posY = ((y * range) - (range / 2)) * 100;

    _this.$cameraFeed.css('transform', 'scale(' + zoom + ') translate(' + posX + '%, ' + posY + '%)');
  },

  setOpacity: function(value) {
    var _this = this;

    var projectOpacity = value > 50 ? (100 - value) * 0.02 : 100;
    var camOpacity = value < 51 ? value * 0.02 : 100;

    _this.$cameraFeed.css('opacity', camOpacity);
    _this.$projectThumbs.css('opacity', projectOpacity);

    Cookies.set('faderValue', value);
  },

  setZoom: function(value) {
    var _this = this;

    _this.zooming = true;

    var zoom = ((value * 0.01 *(_this.maxZoom - 1) ) + 1);

    _this.$cameraFeed.css('transform', 'scale(' + zoom + ')');

    if (value > 0) {
      _this.zoomed = true;
    } else {
      _this.zoomed = false;
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