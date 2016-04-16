$(document).ready ->
  $form = $('form#loginform, form#wppb-register-user, form#wppb-recover-password')
  return unless $form.length

  $inputsLoginForm = $form.find('label + input')
  $inputsLoginForm.attr('required', true) # make input fields required so html validation is kicking in
  $inputsLoginForm.on 'focus', ->
    $input = $(this)
    $label = $(this).prev('label')

    $label.addClass('is-active')

    $input.one 'blur', ->
      $label.removeClass('is-active') unless $input.is(':valid')
