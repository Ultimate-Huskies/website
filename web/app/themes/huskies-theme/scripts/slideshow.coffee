run = ($slides) ->
  changeTime = 5000
  mainOffset = $('main').offset().top
  $body = $(document)
  $slideshow = $('.slideshow')
  $pbOverlay = $('#pbOverlay')

  hide = (index) =>
    #check if photobox is shown, if so don't change
    return setTimeout hide.bind(@, index), changeTime if $pbOverlay.hasClass 'show'

    # check if the slideshow is out of visibility for the user, if so don't change
    return setTimeout hide.bind(@, index), changeTime if mainOffset < $body.scrollTop()

    $($slides[index]).removeClass 'slideshow__item--visible' # remove actual item
    show if index < $slides.length - 1 then index + 1 else 0 # show previous or first item

  show = (index) =>
    $($slides[index]).addClass 'slideshow__item--visible'
    setTimeout hide.bind(@, index), changeTime

  show 0

$ ->
  $slides = $('.slideshow__item')
  $slideshow = $('.slideshow')

  return unless $slides.length

  run $slides

  options = {
    thumbs: false
    zoomable: false
    history: false
  }

  $slideshow.photobox '.slideshow__item a', options
