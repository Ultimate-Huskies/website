$ ->
  $password = $('#password-strength-meter')
  return unless $password.length

  states = ['short', 'bad', 'good', 'strong', 'mismatch']
  stateTranslations = $password.data('states').split(',')
  $pass1 = $("##{$password.data('pass1')}")
  $pass2 = $("##{$password.data('pass2')}")

  $(document).on 'keyup', "##{$password.data('pass1')}, ##{$password.data('pass2')}", ->
    strength = passwordStrength $pass1.val(), '', $pass2.val()
    $password.removeClass().addClass("password-strength-meter--#{states[strength]}").text stateTranslations[strength]
