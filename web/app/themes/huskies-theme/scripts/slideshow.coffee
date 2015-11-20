run = ($slides) ->
  changeTime = 5000
  mainOffset = $('main').offset().top
  $body = $('body')
  $slideshow = $('.slideshow')

  hide = (index) =>
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
  run $slides if $slides.length
