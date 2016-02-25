$(document).ready ->
  $modal = $('.modal')
  $modalWrapper = $('.modal__wrapper')
  $body = $('body')
  return unless $modal.length

  $(document).on 'click', "a[href='#modal']", (event) ->
    event.preventDefault()
    $body.addClass 'modal--open'

  $(document).on 'click', (event) ->
    $body.removeClass('modal--open') if $(event.target)[0] is $modalWrapper[0] or $(event.target).hasClass('modal__close')
