jQuery(document).ready ($) ->
  setTopLink()
  $('*[title]').tooltip
    html: true
    placement: 'bottom'

  $('.article_meta_comments').tooltip('destroy').tooltip
    placement: 'left'

  $('#searchform').on 'focus', 'input', ->
    $('#disc, #searchform').addClass('expand')

  $('#searchform').on 'blur', 'input', ->
    $('#disc, #searchform').removeClass('expand')

  $('a[href="#footer"]').on 'click', (event) ->
    event.preventDefault()

    $('#secondFooter').slideToggle 800
    $('html, body').animate {scrollTop: $('body').height()}, 800

  $('.affix').affix()
