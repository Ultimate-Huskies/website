CLASS = 'main_menu--sticky'

run = ($main, $menu, $body) ->
  unless $menu.css('background-color') is 'rgba(0, 0, 0, 0)'
    $menu.removeClass CLASS
    return

  top = $main.offset().top - 50
  bottom = top + $main.height() - 200
  bodyTop = $body.scrollTop()
  actualBottom = bodyTop + $menu.height()

  console.log 'scrolling', top, bottom, bodyTop, actualBottom
  if bodyTop > top
    if actualBottom >= bottom
      $menu.removeClass CLASS
      $menu.css top: $main.height() - $menu.height() - 200
    else
      $menu.addClass CLASS
      $menu.css top: ''
  else
    $menu.removeClass CLASS

$ ->
  $menu = $('.main_menu')
  $main = $('.main')
  $body = $('body')

  $(window).on 'scroll', run.bind(@, $main, $menu, $body)
  $(window).on 'resize', run.bind(@, $main, $menu, $body)
  run $main, $menu, $body

  $overlay = $('.main_menu__overlay')
  $('.main_menu__toggle').on 'click', (event) ->
    event.preventDefault();
    $body.addClass 'main_menu--is-open'
    $overlay.one 'click', -> $body.removeClass('main_menu--is-open')
