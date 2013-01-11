jQuery(document).ready ($) ->
  setTopLink()
  $('*[title]').tooltip
    html: true
    placement: 'bottom'

   $('*[rel="popover"]').popover
    html: true
    trigger: 'hover'
    placement: 'bottom'

  $('.article_meta_comments').tooltip('destroy').tooltip
    placement: 'left'

  $('#topHeader .form-search').on 'focus', 'input', ->
    $('#disc, #searchform').addClass('expand')

  $('#topHeader .form-search').on 'blur', 'input', ->
    $('#disc, #searchform').removeClass('expand')

  $('a[href="#footer"]').on 'click', (event) ->
    event.preventDefault()

    $('#secondFooter').slideToggle 800
    $('html, body').animate {scrollTop: $('body').height()}, 800

  $('.gallery a').photobox()
