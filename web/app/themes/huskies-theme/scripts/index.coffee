runSlideshow = ($slides) ->
  baseTime = 5000
  showTime = baseTime
  stepTime = baseTime / 10
  paused = false
  mainOffset = $('.main').offset().top
  $body = $('body')
  $slideshow = $('.slideshow')

  hide = (index) =>
    # check if its paused through mouseevents
    return setTimeout hide.bind(@, index), stepTime if paused

    # check if the slideshow is out of visibility for the user and don't change
    return setTimeout hide.bind(@, index), stepTime if mainOffset < $body.scrollTop()

    # check if reached the changed time already
    if showTime >= stepTime
      showTime = showTime - stepTime
      return setTimeout hide.bind(@, index), stepTime

    # reset change time
    showTime = baseTime
    # remove actual item
    $($slides[index]).removeClass 'slideshow__item--visible'
    # show previous or last item
    show(if index > 0 then index - 1 else $slides.length - 1)

  show = (index) =>
    $($slides[index]).addClass 'slideshow__item--visible'
    setTimeout hide.bind(@, index), stepTime

  # register mouseevents to be able to pause/resume the slideshow
  $slideshow.on 'mouseenter', -> paused = true
  $slideshow.on 'mouseleave', -> paused = false

  show $slides.length - 1 # start slideshow at last, most actual item

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

  $slides = $('.slideshow__item')
  runSlideshow $slides if $slides.length
