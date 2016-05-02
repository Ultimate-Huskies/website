require './slideshow'
require './header'
require './modal'
require './form'
require './input'
require './calendar'

$(document).ready ->
  $body = $('body')
  $overlay = $('.main_menu__overlay')
  $('.main_menu__toggle').on 'click', (event) ->
    event.preventDefault();
    $body.addClass 'main_menu--is-open'
    $overlay.one 'click', -> $body.removeClass('main_menu--is-open')

  $gallery = $('.gallery')

  if $gallery
    options = {
      thumbs: false
      zoomable: false
      history: true
    }

    $gallery.photobox '.gallery__item a', options
