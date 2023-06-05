// select language
$('.language').on('click', function(){
    $('.language .list').toggleClass('active');

    $('.language .list a').on('click', function(){
        $('.select').html('<img src='+$(this).data('src')+'>');
    });
});

// notification
$('#close-alert').on('click', function(){
    $('.alert').remove();
});

$('.validate-mail').on('input', function(){
    if($(this).val().length < 3) console.log('-3');
});

$(".item-menu").on('click', function(){
    $(this).toggleClass('active');
    var data = $(this).data('submenu');
    $('#'+data).toggleClass('active');
});


$('.hamburguer').on('click', function() {
    $('.menu').toggleClass('active');
    $(this).toggleClass('active');
});

///////////////
// functions //
///////////////

/* function alert(){
    setTimeout(() => {
        $('.alert').remove();
        console.log('foi');
    }, 1000);
}
 */

function triggerModal(url, id){
    var modal = document.getElementById('delete');

    modal.classList.toggle('open');

    document.querySelector('.main').classList.toggle('zIndex');

    document.querySelector('#delete form').setAttribute('action', url);
    
    $('#id_delete').val(id);

    document.querySelector('#delete .modal-overlay').onclick = function(){
        document.querySelector('.main').classList.toggle('zIndex');
        modal.classList.remove('open');
    }
    
    document.querySelector('#delete [data-modal="cancel"]').onclick = function(){
        document.querySelector('.main').classList.toggle('zIndex');
        modal.classList.remove('open');
    }

    document.querySelector('#delete [data-modal="close"]').onclick = function(){
        document.querySelector('.main').classList.toggle('zIndex');
        modal.classList.remove('open');
    }
}

// nav tab
$('[data-tab]').on('click', function(){
    $('.tab-link').removeClass('active');
    $(this).toggleClass('active');
    var src = $(this).data('tab');
    $('.tab-pane').removeClass('show');
    $(this).removeClass('show');
    $(src).toggleClass('show');
});

// libera o acesso a alteração
$('[data-trigger="edit"]').on('click', function(){
    $(this).css('display', 'none');
    var id = $(this).data('form');
    $(id+' [data-trigger="save"]').removeClass('d-none');
    $(id+' .on-change').prop("disabled", false);
    $(id+' .on-change select').prop("disabled", false);
    $(id+' .form-select').toggleClass("disabled");
});

// adiciona um novo form na table
$('[data-form="add"], [data-trigger="close"]').on('click', function(){
    $('[data-form="new"]').toggleClass('d-none');
});

function removeRowForm(key)
{
    $('[data-form="'+key+'"]').remove();
}

$('[data-trigger="delete"]').on('click', function() {
    
});

///////////////////////////////////
///////////////////////////////////
///////////////////////////////////
///////////////////////////////////
/////// INPUT DRAG & DROP /////////
///////////////////////////////////
///////////////////////////////////
///////////////////////////////////
///////////////////////////////////

var $fileInput = $('.file-input');
var $droparea = $('.file-drop-area');

// highlight drag area
$fileInput.on('dragenter focus click', function() {
  $droparea.addClass('is-active');
});

// back to normal state
$fileInput.on('dragleave blur drop', function() {
  $droparea.removeClass('is-active');
});

// change inner text
$fileInput.on('change', function() {
  var filesCount = $(this)[0].files.length;
  var $textContainer = $(this).prev();

  if (filesCount === 1) {
    // if single file is selected, show file name
    var fileName = $(this).val().split('\\').pop();
    $textContainer.text(fileName);
  } else {
    // otherwise show number of files
    $textContainer.text(filesCount + ' files selected');
  }
});
