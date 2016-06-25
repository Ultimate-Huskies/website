open = ($body, $target) ->
  if $body.hasClass('modal--open')
    close($body, $body.find('.modal--visible'))

  $body.addClass 'modal--open'
  $body.find($target.attr('href')).addClass 'modal--visible'

  $(document).trigger 'modal:opened', $target

close = ($body, $target) ->
  $body.removeClass 'modal--open'
  $modal = $target.closest('.modal__wrapper')

  $modal.removeClass 'modal--visible'
  $(document).trigger 'modal:closed', $modal

$(document).ready ->
  $body = $('body')
  return unless $('.modal__wrapper').length

  $(document).on 'click', "a.modal__trigger", (event) ->
    event.preventDefault()
    open $body, $(this)

  $(document).on 'click', (event) ->
    $target = $(event.target)
    # if $target.hasClass('modal__wrapper') or $target.hasClass('modal__close')
    if $target.hasClass('modal__close')
      close $body, $target

  if $(document).find('.modal--visible').length
    $body.addClass 'modal--open'
