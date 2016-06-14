formData = ($form) ->
  data =
    action: $form.attr('action')

  $.each $form.serializeArray(), (index, element) ->
    data[element['name']] = element['value']

  return data

start = ($form) ->
  $form.find('.account-form__loader').addClass 'account-form__loader--visible'

finish = ($form) ->
  $form.find('.account-form__loader').removeClass 'account-form__loader--visible'

success = ($form, res) ->
  $form.addClass('account-form--hidden')
  $form.prev('.account-form__success').addClass('account-form__success--visible').text res.data

  if redirectUrl = $form.data('redirect-uri')
    window.location.href = redirectUrl

failed = ($form, data) ->
  $form.find('.account-form__error').addClass('account-form__error--visible').text data.responseJSON.error

resetError = ($form) ->
  $form.find('.account-form__error').removeClass('account-form__error--visible').text ''

resetSuccess = ($form) ->
  $form.prev('.account-form__success').removeClass('account-form__success--visible').text ''
  $form.removeClass('account-form--hidden')

reset = ($form) ->
  resetError $form
  resetSuccess $form
  $form.find('input[required]').val ''

$ ->
  $accountForm = $('.account-form')
  return unless $accountForm.length

  $(document).on 'modal:closed', (e, modal) ->
    $modal = $(modal)
    $form = $modal.find('.account-form')
    return unless $form.length
    reset $form

  $accountForm.on 'submit', (e) ->
    e.preventDefault()
    $form = $(this)

    request = {
      type: 'POST',
      dataType: 'json',
      url: $form.data('url'),
      data: formData($form)
    }

    start($form)
    $.ajax(request)
      .done(success.bind(@, $form))
      .fail(failed.bind(@, $form))
      .always(finish.bind(@, $form))
