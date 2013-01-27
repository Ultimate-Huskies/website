// Generated by CoffeeScript 1.3.3
(function() {
  var $topLink, addTopLink, scrolling, setTopLink;

  jQuery(document).ready(function($) {
    setTopLink();
    $('#contactform input, #contactform textarea').each(function() {
      var $self;
      $self = $(this);
      return $self.attr('placeholder', $self.attr('title')).removeAttr('title');
    });
    $('#interactiveMap').on('DOMSubtreeModified', function() {
      return $('.mapp-dir-get').addClass('btn btn-success');
    });
    $('*[title]').tooltip({
      animation: true,
      html: true,
      placement: 'bottom'
    });
    $('*[rel="popover"]').popover({
      animation: true,
      html: true,
      trigger: 'hover',
      placement: 'bottom'
    });
    $('.article_meta_comments').tooltip('destroy').tooltip({
      placement: 'left'
    });
    $('#topHeader .form-search').on('focus', 'input', function() {
      return $('#logo-disc, #searchform').addClass('expand');
    });
    $('#topHeader .form-search').on('blur', 'input', function() {
      return $('#logo-disc, #searchform').removeClass('expand');
    });
    $('a[href="#footer"]').on('click', function(event) {
      event.preventDefault();
      $('#secondFooter').slideToggle(800);
      return $('html, body').animate({
        scrollTop: $('body').height()
      }, 800);
    });
    return $('.gallery a').photobox();
  });

  $topLink = "";

  scrolling = function(target) {
    var animationTarget;
    if (jQuery.browser.opera) {
      animationTarget = 'html';
    } else {
      animationTarget = 'html,body';
    }
    return jQuery(animationTarget).animate({
      scrollTop: jQuery(target).offset().top
    }, 800);
  };

  setTopLink = function() {
    $topLink = jQuery("#top_navigator");
    addTopLink({
      min: 200,
      fadeSpeed: 500
    });
    return $topLink.on('click', function(e) {
      e.preventDefault();
      return scrolling('html');
    });
  };

  addTopLink = function(settings) {
    settings = jQuery.extend({
      min: 1,
      fadeSpeed: 200
    }, settings);
    return $topLink.each(function() {
      var el;
      el = jQuery(this);
      el.hide();
      return jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() >= settings.min) {
          return el.fadeIn(settings.fadeSpeed);
        } else {
          return el.fadeOut(settings.fadeSpeed);
        }
      });
    });
  };

}).call(this);
