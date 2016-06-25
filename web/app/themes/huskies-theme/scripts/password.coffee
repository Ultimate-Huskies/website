$ ->
  $password = $('#password-strength-meter')
  return unless $password.length

  states = ['very_bad', 'bad', 'good', 'strong',  'very_strong', 'mismatch']
  stateTranslations = $password.data('states').split(',')
  $pass1 = $("##{$password.data('pass1')}")
  $pass2 = $("##{$password.data('pass2')}")

  $(document).on 'keyup', "##{$password.data('pass1')}, ##{$password.data('pass2')}", ->
    strength = wp.passwordStrength.meter $pass1.val(), wp.passwordStrength.userInputBlacklist(), $pass2.val()
    $password.removeClass().addClass("password-strength-meter--#{states[strength]}").text stateTranslations[strength]
