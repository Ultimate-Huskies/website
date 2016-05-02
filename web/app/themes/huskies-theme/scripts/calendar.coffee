$ ->
  $calendar = $('.simcal-calendar')
  return unless $calendar.length

  $calendar.on 'click', '.simcal-day-has-events', (event)->
    $events = $(this).find('.simcal-events')
    return if $events.css('position') == 'relative' || $(event.target).hasClass('simcal-events') || $(event.target).closest('.simcal-events').length

    $calendar.find('.simcal-events--visible').each (i, element) ->
      $element = $(element)
      console.log $(element), $events[0] != $element[0]
      $element.removeClass 'simcal-events--visible' if $events[0] != $element[0]

    $events.toggleClass 'simcal-events--visible'
