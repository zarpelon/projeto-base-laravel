$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

  ClassicEditor.create(document.querySelector('.ckeditor'))

  moment.updateLocale('pt-br', {
    week: {dow: 1} // Monday is the first day of the week
  })

  $('.date').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'pt-br'
  })

  $('.datetime').datetimepicker({
    format: 'DD/MM/YYYY HH:mm:ss',
    locale: 'pt-br',
    sideBySide: true
  })

  $('.timepicker').datetimepicker({
    format: 'HH:mm:ss'
  })

  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', '')
    $select2.trigger('change')
  })

  $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })
})
