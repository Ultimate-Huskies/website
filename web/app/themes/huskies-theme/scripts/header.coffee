CLASS = 'header__mobile--inverse'

run = ($main, $header, $body) ->
  return unless $header.is(":visible")

  if ($main.offset().top - 25) <= $body.scrollTop()
    $header.addClass CLASS
  else
    $header.removeClass CLASS

$ ->
  $header = $('.header__mobile')
  $body = $('body')
  $main = $('main')

  $(window).on 'scroll', run.bind(@, $main, $header, $body)
  $(window).on 'resize', run.bind(@, $main, $header, $body)
  run $main, $header, $body
