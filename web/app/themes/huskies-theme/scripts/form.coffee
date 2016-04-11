
$(document).ready ->
  $form = $('.form')
  $formUploadArea = $form.find('.form__upload--area')
  formUploadTemplate = $form.find('.form__upload--template').html()
  return unless $form.length

  $form.on 'click', '.form__infos--trigger', ->
    $(this).closest('.form__section').find('.form__infos').toggleClass 'form__infos--hidden'

  $form.on 'click', '.form__upload--button', ->
    $trigger = $(this)
    $input = $trigger.prev("input[type='file']")
    $input.one 'change', (event) -> $trigger.text this.files[0].name
    $input.trigger 'click'

  $form.on 'click', '.form__upload--new-file', (event) ->
      event.stopImmediatePropagation();
      event.preventDefault();

      if (gdbbPressAttachments.storage.files_counter < gdbbPressAttachmentsInit.max_files)
          $formUploadArea.append formUploadTemplate
          gdbbPressAttachments.storage.files_counter++

      if (gdbbPressAttachments.storage.files_counter == gdbbPressAttachmentsInit.max_files)
          $(this).remove()
