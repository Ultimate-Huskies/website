handle = ($input, $label) ->
  $label.addClass('is-active')

  $input.one 'blur', ->
    $label.removeClass('is-active') unless $input.is(':valid')

$(document).ready ->
  $form = $('form#loginform, form#wppb-register-user, form#wppb-recover-password, form.wpcf7-form')
  return unless $form.length

  $labelLogins = $form.find('label + input')
  $spanLogins = $form.find('span > input, span > textarea')

  # make input fields required so html validation is kicking in
  $labelLogins.attr('required', true)
  $spanLogins.attr('required', true)

  $labelLogins.on 'focus', ->
    handle $(this), $(this).prev('label')

  $spanLogins.on 'focus', ->
    handle $(this), $(this).parent().nextAll('label')
