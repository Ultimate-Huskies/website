jQuery(document).ready ($) ->
  setTopLink()

  # needed for the contact plugin to set valid html5 placeholder instead of a title
  $('#contactform input, #contactform textarea').each ->
    $self = $(this)
    $self.attr('placeholder', $self.attr('title')).removeAttr('title')

  $('#interactiveMap').on 'DOMSubtreeModified', ->
    $('.mapp-dir-get').addClass 'btn btn-success'

  if $().tooltip?
    $('*[title]').tooltip
      animation:  true
      html:       true
      placement:  'bottom'

    $('.article_meta_comments').tooltip('destroy').tooltip
      placement: 'left'

  if $().popover?
    $('*[rel="popover"]').popover
      animation:  true
      html:       true
      trigger:    'hover'
      placement:  'bottom'

  $('#topHeader .form-search').on 'focus', 'input', ->
    $('#logo-disc, #searchform').addClass('expand')

  $('#topHeader .form-search').on 'blur', 'input', ->
    $('#logo-disc, #searchform').removeClass('expand')

  $('a[href="#footer"]').on 'click', (event) ->
    event.preventDefault()

    $('#secondFooter').slideToggle 800
    $('html, body').animate {scrollTop: $('body').height()}, 800

  if $().photobox?
    $('.gallery a').photobox()

  if $().select2?
    $selector = $('#bbp_forum_id')
    if $selector? and $selector[0]? and $selector[0].outerHTML[0...7] is "<select" then $('#bbp_forum_id').select2()
    $('#bbp_stick_topic').select2()
