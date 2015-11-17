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

    $('#wpadminbar *[title]').tooltip 'destroy'

    $('.article_meta_comments').tooltip('destroy').tooltip
      animation:  true
      placement: 'left'

    if $(window).width() > 767
      $('.user-navigation li[data-original-title]').each ->
        $(this).tooltip('destroy').tooltip
          animation:  true
          placement: 'right'

  if $().popover?
    $('*[rel="popover"]').popover
      animation:  true
      html:       true
      trigger:    'hover'
      placement:  'bottom'

    $('.icon-file-alt').popover
      animation:  true
      html:       true
      placement:  'left'

  $('#topHeader .form-search').on 'focus', 'input', ->
    $('#logo-disc, #searchform').addClass('expand')

  $('#topHeader .form-search').on 'blur', 'input', ->
    $('#logo-disc, #searchform').removeClass('expand')

  $('a[href="#footer"]').on 'click', (event) ->
    event.preventDefault()

    $('#secondFooter').slideToggle 800
    $('html, body').animate {scrollTop: $('body').height()}, 800

  if $().photobox? and $('.gallery').length > 0
    $('.gallery').photobox 'a', {history: false}

  if $().photobox? and $('.bbp-attachments ol').length > 0
    $('.bbp-attachments ol').photobox 'a', {history: false}

  if $().select2?
    $selector = $('#bbp_forum_id')
    if $selector? and $selector[0]? and $selector[0].outerHTML[0...7] is "<select" then $('#bbp_forum_id').select2()
    $('#bbp_stick_topic').select2()
    $('#bbp_destination_topic').select2()
    $('#display_name, #role, #bbp-forums-role').select2()

  if $().carousel?
    $('.carousel').carousel()

  $(".d4p-attachment-addfile").on "click", (e) ->
    e.stopImmediatePropagation()
    e.preventDefault()
    if gdbbPressAttachments.storage.files_counter < gdbbPressAttachmentsInit.max_files 
      $(this).prev().append $(this).next('.file-template').html()
      gdbbPressAttachments.storage.files_counter++

    if gdbbPressAttachments.storage.files_counter == gdbbPressAttachmentsInit.max_files then $(this).remove();

  if $('#plugin_additions').length > 0
    $file = $('#plugin_additions .form-table input[type="file"]')
    $file.next().remove()
    template = $('#plugin_additions .file-template').html()
    $file[0].outerHTML = template

  $('.bbp-attachments-form, #plugin_additions').on 'click', '.file-wrapper span', (e) ->
    $(this).prev().trigger 'click' 

  $('.bbp-attachments-form, #plugin_additions').on 'change', '.file-wrapper input[type="file"]', (e) ->
    file = $(this).val()
    index = file.lastIndexOf('\\')
    if index != -1 then file = file.substring(index + 1, file.length)
    $(this).parent().find('.file_chosen').text file

  # if $().affix?
  #   $('#single-user-details').affix
  #     offset: 
  #       top: -> return $(window).width() <= 980 ? 290 : 210
  #       bottom: 575