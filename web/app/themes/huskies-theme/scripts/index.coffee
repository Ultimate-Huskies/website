require './slideshow'
require './header'
require './menu'

$(document).ready ->
  $gallery = $('.gallery')

  if $gallery
    options = {
      thumbs: false
      zoomable: false
      history: true
    }

    $gallery.photobox '.gallery__item a', options
