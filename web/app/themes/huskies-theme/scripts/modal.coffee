$(document).ready ->
  $body = $('body')
  return unless $('.modal__wrapper').length

  $(document).on 'click', "a.modal__trigger", (event) ->
    event.preventDefault()
    if $body.hasClass('modal--open')
      $body.find('.modal--visible').removeClass 'modal--visible'

    $body.addClass 'modal--open'
    $body.find($(this).attr('href')).addClass 'modal--visible'

  $(document).on 'click', (event) ->
    $target = $(event.target)
    if $target.hasClass('modal__wrapper') or $target.hasClass('modal__close')
      $body.removeClass 'modal--open'
      $target.closest('.modal__wrapper').removeClass 'modal--visible'
