var quill = new Quill('#editor', {
  theme: 'snow'
});

$('#ql-editor-submit').on('click', function() {
  if($('#assunto').val().length > 0){
    if (confirm('Deseja mesmo enviar este e-mail?')) {
      alert('Enviando e-mails para todos os clientes. Isso pode demorar alguns minutos...');
      $(this).html('Enviando...')
      $.ajax({
        url: '/admin/e-mails',
        type: 'post',
        data: {subject: $('#assunto').val(), html: $('.ql-editor').html()},
        success: function(response) {
          location.href = "/admin/e-mails"
        }
      })
    }
  } else {
    $('#assunto').focus()
  }
})