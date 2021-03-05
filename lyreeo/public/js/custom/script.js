var pageContainer = $('#pagination');
var url = pageContainer.data('url');
var sortEntity = '';
var sortOrder = '';
var perPage = $('#perPage').val();
var keyword = '';
var ajaxReq = null;
var formData = '';
var container_type = '';
var token = $('meta[name="_token"]').attr('content');

var options = {
    autoClose: true,
};

var toast = new Toasty(options);
toast.configure(options);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#inputEmail,#inputPass").on("keyup", function(){
    if($('#inputEmail').val() != "" && $("#inputPass").val() != ""){
		$("#login_button_submit").prop('disabled', false);
        $("#login_button_submit").removeClass('disabled');
		
    } else { 
		$("#login_button_submit").prop('disabled', true);
        $("#login_button_submit").addClass('disabled');
    }
});

$("#inputEmail,#inputPass").on("change", function(){
     if($('#inputEmail').val() != "" && $("#inputPass").val() != ""){ 
		$("#login_button_submit").prop('disabled', false);
        $("#login_button_submit").removeClass('disabled');
		
    } else { 
		$("#login_button_submit").prop('disabled', true);
        $("#login_button_submit").addClass('disabled');
    }
});

$('body').on('submit', '#ajaxLoginForm', function(e) { //
        e.preventDefault();
        var formId = 'ajaxLoginForm';
        var formdataId = $(this).data("id");
      
        $('#'+formId).find(".error").remove();
        $('#'+formId).find(".login-field-error").removeClass('login-field-error');
         $('#'+formId).find(".border-red").removeClass('border-red');
        var form = $('#'+formId);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function() {
                showLoader();
            },
            success: function(data) {
                if (data.success)
                {
                    $(this).find("button[type='submit']").prop('disabled', true);
                    hideLoader();
                    $('.modal').modal('hide');
                    if (data.message != '') {
                        toast.success(data.message);
                    }
                    if (data.extra.redirect)
                    {

                        setTimeout(function() {
                            window.location.href = data.extra.redirect;
                        }, 2000);
                    }
                   
                } else {
                    if (data.status == 206) {
                        hideLoader();
                        $.each(data.errors, function(i, v) {
                            var error = '<div class="error">' + v + '</div>';
                            var split = i.split('.');
                            if (split[2]) {
                                var ind = split[0] + '[' + split[1] + ']' + '[' + split[2] + ']';
                                form.find("[name='" + ind + "']").addClass('login-field-error');
                                //form.find("[name='" + ind + "']").parent().append(error);
                            } else if (split[1]) { 
                                var ind = split[0] + '[' + split[1] + ']';
                                form.find("[name='" + ind + "']").addClass('login-field-error');
                                //form.find("[name='" + ind + "']").parent().append(error);
                            } else {
                                form.find("[name='" + i + "']").addClass('login-field-error');return false;
                                /*form.find("[name='email']").addClass('login-field-error');
                                form.find("[name='password']").addClass('login-field-error');*/
                                if(i == 'error'){
                                   // form.find("[name='" + i + "']").parent().append(error);
                                }
                                
                            }
                        });
                    } else if (data.status == 207) {
                        hideLoader();

                        if (data.message != '') {
                            toast.success(data.message);
                        }
                        if (data.extra.reload) {
                            $('.__modal').on('hidden.bs.modal', function(e) {
                                window.location.reload();
                            });
                        }

                        if (data.extra.redirect) {
                            if (data.message != '') {
                                $('.__modal').on('hidden.bs.modal', function(e) {
                                    window.location.href = data.extra.redirect;
                                });
                            } else {
                                window.location.href = data.extra.redirect;
                            }
                        }
                    }
                }
            },
            error: function(data) {
                console.log('An error occurred.');
            }
        });
    });

$('body').on('submit', '.ajax-submit', function(e) {
        e.preventDefault();
        var formId = $(this).attr('id');
        var formdataId = $(this).data("id");
        
        $('#'+formId).removeClass('border-red-error');
        $('#'+formId).find(".login-field-error").removeClass('login-field-error');
        $('#'+formId).find(".error").remove();
        $('#'+formId).find(".border-red").removeClass('border-red');
        var form = $('#'+formId);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function() {
                showLoader();
            },
            success: function(data) {
                if (data.success)
                {
                    $(this).find("button[type='submit']").prop('disabled', true);
                    hideLoader();

                    $('.modal').modal('hide');
                    if(data.extra.picture) {
                       $('#row_picture_0').attr('src',window.location.origin+'/image/'+data.extra.picture);
                       $('#form_picture_0').attr('src', window.location.origin+'/image/'+data.extra.picture);
                       $('#picture_0').val(data.extra.picture);
                       $('#resetCropie').trigger('click');
                    } else{
                        if (data.message != '') {
                            toast.success(data.message);
                        }
                        refreshDiv();
                    }

                    if (data.extra.redirect)
                    {
						setTimeout(function() {
                            window.location.href = data.extra.redirect;
                        }, 1000);
                        //window.location.href = data.extra.redirect;
                    }
                } else {
                    if (data.status == 206) {
                        hideLoader();
                        $.each(data.errors, function(i, v) {
                            var error = '<div class="error">' + v + '</div>';
                            var split = i.split('.');
                            if (split[2]) { 
                                var ind = split[0] + '[' + split[1] + ']' + '[' + split[2] + ']';
                               form.find("[name='" + ind + "']").addClass('border-red');
                               // form.find("[name='" + ind + "']").parent().append(error);
                            } else if (split[1]) {
                                var ind = split[0] + '[' + split[1] + ']';
                                form.find("[name='" + ind + "']").addClass('border-red');
                                //form.find("[name='" + ind + "']").parent().append(error);
                            } else {
                                if(i == 'email' || formId == 'profile_edit'){
                                    form.find("[name='" + i + "']").addClass('login-field-error');
                                } else{
                                    form.find("[name='" + i + "']").addClass('border-red');
                                }
                            }
                        });
						if(formId != 'profile_edit' && formId != 'project_detail' && formdataId != 'form_edit' && formId != 'ActiveProject_Form') {
							$('#'+formId).addClass('border-red-error');
							
						}
						if (data.extra.message){
							toast.error(data.extra.message);
						}
						
                    } else if (data.status == 207) {
                        hideLoader();

                        if (data.message != '') {
                            toast.success(data.message);
                        }

                        if (data.extra.reload) {
                            $('.__modal').on('hidden.bs.modal', function(e) {
                                window.location.reload();
                            });
                        }

                        if (data.extra.redirect) {
                            if (data.message != '') {
                                $('.__modal').on('hidden.bs.modal', function(e) {
                                    window.location.href = data.extra.redirect;
                                });
                            } else {
                                window.location.href = data.extra.redirect;
                            }
                        } else{
                            refreshDiv();
                        }
                    }
                }
            },
            error: function(data) {
                console.log('An error occurred.');
            }
        });
    });



$('body').on('change', 'select', function(e) { console.log('here');
    var value = $(this).val();
	var type = $(this).attr('type');
    var form = $(this).closest('form')[0]; $(form).find("img").removeClass('btn-disabled');
    if(value == null || value == '' || type == "checkbox"){
        // $(form).find("button[type='submit']").parent().addClass('btn-disabled');
    } else{
		 $(form).find("button[type='submit']").prop('disabled', false);
         $(form).find("button[type='submit']").parent().removeClass('btn-disabled');
         $(form).find("button[type='submit']").removeClass('disabled');
    }
});


$('body').on('keyup', 'input', function(e) {
    var value = $(this).val();
    var form = $(this).closest('form')[0];
	 $(form).find("img").removeClass('btn-disabled');
    if(value == null || value == ''){ 
        // $(form).find("img").parent().addClass('btn-disabled');
    } else{ 
        $(form).find("img").removeClass('btn-disabled');
        $(form).find("button[type='submit']").parent().removeClass('btn-disabled');
        $(form).find("button[type='submit']").removeClass('disabled');
        $(form).find("button[type='submit']").prop('disabled', false);
    }
});


function showLoader() {
    $('.loading').show();
}

function hideLoader() {
    $('.loading').hide();
}

$('body').on('click', '.__toggle', function(e) {
    var id = $(this).attr('data-id');
    e.preventDefault();
    var option = { _token: token, _method: 'post', id:id };
    var route = $(this).attr('data-route');
	 showLoader();
    $.ajax({
        type: 'post',
        url: route,
        data: option,
        success: function(data) {
			 hideLoader();
            refreshDiv();
        },
        error: function(data) {
            alert('An error occurred.');
        }
    });
});

$('body').on('click', '.__drop', function(e) {
    var data_heading = $(this).attr('data-heading');
    var data_message = $(this).attr('data-message');
    $('#delete_heading').html(data_heading);
    $('#delete_message').html(data_message);
    var route = $(this).attr('data-url');
    $('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete_record', function (e) {
            var option = { _token: token };
            showLoader();
            $.ajax({
                type: 'post',
                url: route,
                data: option,
                success: function(data) {
                    if (data.success && data.status == 200) {
                        showLoader();
                        if (data.message != '')
                        {
                            hideLoader();
                            $('#confirm').modal('toggle');
                             toast.success(data.message);
                             refreshDiv();
                        }
                    }
                },
                error: function(data) {
                    console.log('An error occurred.');
                }
            });
        });
    e.preventDefault();
}).on('click', '._back', function(event) {
    history.back(1);
});

$('body').on('click', '.__statusUpdate', function(e) {
    var data_heading = $(this).attr('data-heading');
    var project_id = $(this).attr('data-project-id');
    var data_message = $(this).attr('data-message');//alert(data_heading);
    $('#status_heading').html(data_heading);
    $('#status_message').html(data_message);
    $('#project_id').val(project_id);
});

function refreshDiv(){
    //$('body').load(window.location.href);
   $("#data_table").load(location.href+" #data_table>*","");
    //$("#data_table").load(location.href+" #data_table");
}
function showForm(formId){
	//$('.row-top-table').hide();
	$( ".form_row" ).each(function( index ) {
		var selectedFormId = $(this).attr('data-id');
	   $('#row_'+selectedFormId).show();
	   $('#form_'+selectedFormId).hide();
	     $('#button_'+selectedFormId).addClass('btn-disabled');
	});
    $('#form_'+formId).show();
    $('#row_'+formId).hide();
    $('#button_'+formId).removeClass('btn-disabled');
   // $(".disableIfOneActive").css("pointer-events","none");
}

function hideForm(formId){
	
    $('#form_'+formId).hide();
    $('#row_'+formId).show();
  $('#button_'+formId).addClass('btn-disabled');
  //  $(".disableIfOneActive").removeProperty("pointer-events");
}

$('body').on('click', '.sorting a', function(e) {
    e.preventDefault();
    var type = $(this).parent().parent().parent().data('type');
    if(type != undefined){
        container_type = type;
         pageContainer = $('#pagination1');
    }

    sortEntity = $(this).attr('data-sortEntity');
    sortOrder = $(this).attr('data-sortOrder');
    pagination();
    window.history.pushState('', '', url);
});

function pagination()
{
    if (formData != '') {
        formData = formData + '&';
    }

    var option = formData + 'sortEntity=' + sortEntity +
        '&sortOrder=' + sortOrder +
        '&container_type=' + container_type +
        '&_token=' + token;

    ajaxReq = $.ajax({
        type: 'GET',
        url: url,
        data: option,
        beforeSend: function() {
            showLoader();
        },
        success: function(data) { 
            ajaxReq = null;
            if ((data.success == false) && (data.status == 206)) {
                $.each(data.message, function(i, v) {
                    var error = '<div class="error">' + v + '</div>';
                    $('#form-search').find("[name='" + i + "']").parent().append(error);
                });
            } else {
                pageContainer.html(data);
            }
            hideLoader();
        },
        error: function(data) {
            console.log('An error occurred.');
        }
    });
}

$(document).ready(function(){
	
	$(".toggle-main").click(function(){
		$("body").addClass("close-toggle");
	});
  $(".toggle-close").click(function(){
	$("body").removeClass("close-toggle");
  });
});




$(document).on("click",".removeDoc",function() {
    var table = $(this).attr('data-table');
    var project_id = $(this).attr('data-projectId');
    var id = $(this).attr('data-id');
    var route =$(this).attr('route');
    $(this).closest('.removeMaindiv').remove();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(
        route,
        {table: table, id: id,project_id:project_id},
        function (data) {
            
        }
    );
     
});


function removePic(li){
        var fileFiledId= $(li).parent('div').parent('li').parent('ul').attr('data-id');
        $(li).parent('div').parent('li').remove();
        if(fileFiledId != null && fileFiledId != undefined){
            $('#'+fileFiledId).val("");
        }else{
            $('#upload2').val("");
        }
}

    $("#upload2").change(function(){
        images(this, '#previews');
    });