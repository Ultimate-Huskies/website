$(document).ready ->
  s = skrollr.init
    forceHeight: false
    mobileCheck: -> return false

  $body = $('body')
  $overlay = $('.main_menu__overlay')
  $('.main_menu__toogle').on 'click', (event) ->
    event.preventDefault();
    $body.addClass 'main_menu--is-open'
    $overlay.one 'click', -> $body.removeClass('main_menu--is-open')
