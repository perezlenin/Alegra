var mjs_hora = 0;
var mjs_minuto = 0;
var mjs_segundo = 0;
var mjs_minutoFalso = 0;
var mjs_horaFalso = 0;
var mjs_intervalo;
var urlAct = 'react_qa';
// PERMITE SERIALIZAR INCLUSO LOS ELEMENTOS CON DISABLE

function menuDesplegado(){
    $(".main-container").addClass("menudesplegado");
    $(".header-right").addClass("menudesplegado2");
}
function menuOculto(){
    $(".main-container").removeClass("menudesplegado");
    $(".header-right").removeClass("menudesplegado2");
}
$(document).ready(function(){
    menuDesplegado();
    $(".menu-icon").click(function(){
        if($(".main-container").hasClass("menudesplegado"))
            menuOculto();
        else
             menuDesplegado();
    });
});

function validarSelect(idObjeto){

    var contSelect = $("#" + idObjeto + " option").length;
    var opcionVal = 0;
    $("#" + idObjeto + " option").each(function(){
       if($(this).val() == 0)
            {
                contSelect--;
                return 0;
            }
    });

    if (contSelect == 1)
    {
        $("#" + idObjeto + " option").each(function(){
        if($(this).text().toUpperCase() != "TODOS")
                {
                    opcionVal = $(this).val()
                }
        });
        $("#"+idObjeto).val(opcionVal);
        $("#"+idObjeto).trigger("change");
        $("#"+idObjeto).attr("disabled","disabled");
    }
}

// PERMITE SERIALIZAR INCLUSO LOS ELEMENTOS CON DISABLE

(function($){
    var proxy = $.fn.serializeArray;
    $.fn.serializeArray = function(){
        var inputs = this.find(':disabled');
        inputs.prop('disabled', false);
        var serialized = proxy.apply( this, arguments );
        inputs.prop('disabled', true);
        return serialized;
    };
})(jQuery);

$("body").on( "click",".mostrar-moneda", function() {
    $(this).find('.monedas').addClass("ver-moneda");            
});

$("body").on( "click",".cerrar-monedas", function(event) {
    event.stopPropagation();
    $(this).parent().removeClass("ver-moneda");
});

$("body").on("change",".cbo_lst_moneda",function(e){
    e.preventDefault();
    var idmoneda = $(this).val();
    var simbolo = $(this).find(':selected').data('simbolo');
    var a = $(this).parent().parent().find(".moneda-simbolo").text(simbolo);
    $(this).parent().find('.cerrar-monedas').trigger('click');
});

function goToByScroll(id) {
    // Reove "link" from the ID
    id = id.replace("link", "");
    // Scroll
    $('html,body').animate({ scrollTop: $("#" + id).offset().top - 70 }, 'slow');
}

function escapeHtml(text) {
    var asd = $('<div/>').text(text).html();
    var tre = asd.replace(/\n/g, "<br>");
    // console.log(tre);
    return tre;
}

function notification(heading = '', text = '', time = 3000, escapehtml = true) {
    $.toast({
        text: (escapehtml ? escapeHtml(text) : text), // Text that is to be shown in the toast
        heading: (escapehtml ? escapeHtml(heading) : heading), // Optional heading to be shown on the toast
        icon: 'info', // Type of toast icon
        bgColor: '#1ebea5',
        textColor: 'black',
        showHideTransition: 'plain', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: time, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

        textAlign: 'left', // Text alignment i.e. left, right or center
        loader: true, // Whether to show loader or not. True by default
        loaderBg: 'red', // Background color of the toast loader	    	    
    });
}

function toast(tipo, time, mensaje, titulo = '') {
    var fondo = '';
    var colorText = '';
    if (tipo.toLowerCase() == 'success') {
        fondo = '#0bc114'; // Background color of the toast
        colorText = '#ffffff';
    } else if (tipo.toLowerCase() == 'error') {
        fondo = '#ff0000';
        colorText = '#ffffff';
    } else if (tipo.toLowerCase() == 'info') {
        fondo = '#E0DE60';
        colorText = '#3E3D1C';
    } else if (tipo.toLowerCase() == 'warning') {
        fondo = '#FFCC00';
        colorText = '#000';
    }

    $.toast({
        heading: titulo,
        text: mensaje,
        allowToastClose: false,
        stack: false,
        position: 'top-center',
        hideAfter: time,
        loader: false, // Whether to show loader or not. True by default
        bgColor: fondo, // Background color of the toast
        textColor: colorText,
        textAlign: 'center'
    });

}

function tooltip() {
    $('[data-toggle="tooltip"]').tooltip({
        trigger : 'hover'
    });
}

function num_entero(classInput = '.validanumero', restriccion = false, numeroMayor = '', numeroMenor = '', msg = '') {
    // $(classInput).on('input', function () {
    // 	this.value = this.value.replace(/[^0-9]/g, '');
    // });
    // modificado por LPEREZ
    $("body").on("input", classInput, function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    })

    if (restriccion == true) {
        $(classInput).keyup(function(event) {
            if (this.value > numeroMayor || this.value < numeroMenor) {
                if (msg != "") {
                    alert(msg);
                }
                this.value = "";
            }
        });
    }
}

function num_decimal(classInput = '.validadecimal') {
    $(classInput).on('input', function() {
        this.value = this.value.replace(/[^0-9.,]/g, '');
    });
}

function num_telefonico(inputClassID = '.validatelefono', preg_add = '') {
    $("body").on("input", inputClassID, function() {

        
            if (preg_add) {
                this.value = this.value.replace(/preg_add/g, '');
                if ($(inputClassID).val().length != 9) {
                    return false;
                }
            } else {
                this.value = this.value.replace(/[^0-9\-]/g, '');
                if ($(inputClassID).val().length != 9) {
                    return false;
                }
            }
            /*$(inputClassID).focus();
            $(inputClassID).select();*/
    });
    // MODIFCADO POR LPEREZ

    // $(inputClassID).on('input', function () {
    // 	if(preg_add){
    // 		this.value = this.value.replace(/preg_add/g, '');
    // 	}else{
    // 		this.value = this.value.replace(/[^0-9\-]/g, '');
    // 	}
    // });
}


function downloadFile(url, data = {}, cbSuccess, cbFail, cbPrepare, type = "json") {
    if (!url) {
        console.log("downalodFile : URL no válido")
        return false;
    }
    $.fileDownload(url, {
        httpMethod: 'POST',
        dataType: type, // data type of response
        contentType: "application/json",
        data: data,
        prepareCallback: function(url) {
            _showLoader();
            if (cbPrepare) {
                cbPrepare(url);
            }
        },
        successCallback: function(url) {
            _hideLoader();
            if (cbSuccess) {
                cbSuccess(url);
            }
        },
        failCallback: function(responseHtml, url, error) {
            _hideLoader();
            if (cbFail) {
                cbFail(responseHtml, url, error);
            }
        }
    });

    // _hideLoader();
}


function ajaxFile(url, data, callback, async = true) {
    $.ajax({
        url: url,
        data: data,
        type: "POST",
        async: async,
        // cache:svcache,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var data = response.data;
            if (data.status == 900) {
                if (data.motive) {
                    toast("error", 3000, data.motive);
                }
                $("#modal_general").html(data.html);
                $("#modal_general").modal("show");
            }else{
                if (callback) {
                    callback(response);
                }    
            }            
        },
    });
}

function loadDialogUi(url, data, callback, async = true, fixed = false, targetmodal = "#modal_general") {
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        async: async,
        dataType: 'json',
        beforeSend: function() {
            _showLoader();
        },
        success: function(response) {
            eliminar_intervalo_session();
            // mostrar_hora();
            var data = response.data;
            if (data) {
                if (data.status == 1) {
                    if (data.motive) {
                        toast("error", 3000, data.motive);
                    }
                }
                if (data.status == 900) {
                    if (data.motive) {
                        toast("error", 3000, data.motive);
                    }
                }

                if (fixed) {
                    $(targetmodal).attr('data-backdrop', 'static');
                }
                // console.log(targetmodal);
                if(data.html){
                    $(targetmodal).html(data.html);
                    $(targetmodal).modal("show");
                }
            }
            if (callback) {
                callback(response);
            }
        },
        error: function(xhr, status) {
            console.log("error en peticion ajax en la url: " + url + ", con error: " + xhr);
        },
        complete: function(xhr, status) {
            _hideLoader();
        }
    });
}

function cleanForm(idform, cl_inp_hiden = false) {
    $("#" + idform).find("input[type=email], textarea,input[type=text],input[type=password],input[type=file]").val("");
    $("#" + idform).find(":checkbox").prop('checked', false);
    $("#" + idform).find(":radio").prop('checked', false);
    $("#" + idform).find("select").val("0");
    if (cl_inp_hiden) {
        $("#" + idform).find("input[type=hidden]").val("");
    }
}

function validateCampos(lst_elem, type) {
    var control = false;
    $(lst_elem).removeClass('is-invalid');
    switch (type) {
        case "email":
            $.each(lst_elem, function(c, v) {
                if (!validateEmail($(v).val()) || $(v).val() == '') {
                    $(v).addClass('is-invalid');
                    $(v).focus();
                    control = true;
                    return false;
                }
            });
            break;
        case "telefono":
            $.each(lst_elem, function(c, v) {
                if ($(v).val() == '' || $(v).val().length < 5) {
                    $(v).addClass('is-invalid');
                    $(v).focus();
                    control = true;
                    return false;
                }
            });
            break;
    }
    return control;
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

var class_body;

function showConfirm(title, mensaje, nombreButton, cbSuccess, cbCancel = '', urltranslate) {
    class_body = $("body").prop("class");
    // document.getElementById("title_modal_confirm").setAttribute("data-translate",title);
    $("#title_modal_confirm").replaceWith('<h5 class="modal-title" id="title_modal_confirm" style="color:#fff;" data-translate="' + title + '">Modal Title</h5>');
    // document.getElementById("body_modal_confirm").setAttribute("data-translate",mensaje);
    $("#body_modal_confirm").replaceWith('<div class="modal-body" id="body_modal_confirm" data-translate="' + mensaje + '"></div>');
    // document.getElementById("btn_modal_confirm").setAttribute("data-translate",nombreButton);
    $("#btn_modal_confirm").replaceWith('<button type="button" class="btn btn-primary" id="btn_modal_confirm" data-translate="' + nombreButton + '">Aceptar</button>');
    traducirIdioma(IDIOMA, urltranslate);
    $('#modal_confirm').modal('show');

    $("#btn_modal_confirm").off("click");
    $("#btn_modal_confirm").click(function(e) {
        e.preventDefault();
        cbSuccess();
        $('#modal_confirm').modal('hide');
        $('body').attr("class", class_body);
    });
    $('#modal_confirm').on('hidden.bs.modal', function(e) {
        if (cbCancel) {
            cbCancel();
        }
        $('body').attr("class", class_body);
    });
}

function ajax(url, params, callback, method = 'POST', type = 'json', asyncm = true, svcache = false, show_loading = false) {
    $.ajax({
        url: url,
        data: params,
        type: method,
        async: asyncm,
        cache: svcache,
        dataType: type,
        beforeSend: function() {
            if (!show_loading) {
                _showLoader();
            }
        },
        success: function(response) {
            eliminar_intervalo_session();
            // mostrar_hora();
            var data = response.data;
            if (data) {
                if (data.status == 900) {
                    if (data.motive) {
                        toast("error", 3000, data.motive);
                    }
                    $("#modal_general").html(data.html);
                    $("#modal_general").modal("show");
                }
            }
            if (callback) {
                callback(response);
            }
        },
        error: function(xhr, status, message) {
            if (!show_loading) {
                _hideLoader();
            }
            console.log("error en peticion ajax en la url: " + url + ", con error: "+message);
        },
        complete: function(xhr, status) {
            if (!show_loading) {
                _hideLoader();
            }
        }
    });
};





function _showLoader() {
    $("#c_loader").show();
}

function _hideLoader() {
    $("#c_loader").hide();
}




function traducirIdioma(idioma, path) {
    if(idioma == 'US'){
        $(".footer-wrap #policy").attr("data-target","#modal_policy_en");
        $(".footer-wrap #terms").attr("data-target","#modal_terms_en");
    }else{
        $(".footer-wrap #policy").attr("data-target","#modal_policy_sp");
        $(".footer-wrap #terms").attr("data-target","#modal_terms_sp");
    }
    $("[data-translate]").jqTranslate(path, { asyncLangLoad: true, cache: false, fallbackLang: idioma, forceLang: idioma });
}

function searchTable(val, text, table) {

    var rex = new RegExp(val, 'gi');
    $(table + ' tr').hide();
    $(table + ' tr').filter(function() {
        return rex.test(text);
    }).show();
}

function reload() {
    window.location.reload();
}

function setclickinetapa(uripdf) {
    $("#btnprintbitacora").click(function(event) {
        event.preventDefault();
        if (confirm("se imprimirá la etapa")) {
            href(uripdf + "&all=1", true);
        }
    });

    $("#printasistencia").click(function(event) {
        event.preventDefault();
        if (confirm("se imprimirá la asistencia")) {
            href(uripdf + "&all=2", true);
        }
    });

}




function href(url, newtab = false) {
    if (newtab) {
        window.open(url, '_blank');
    } else {
        window.location.href = url;
    }
}

// function close() {
// 	window.close();
// }

function back() {
    window.history.back();
}

function each(data, element, extraConcat = '') {
    $.each(data, function(k, v) {
        $(element + " ." + k + "" + extraConcat).append(v);
    });
}

// para las clases que se pone como acordeon


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active1");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

function validDecimal(id) {
    //Para llamarlo en el objeto ---> onkeypress="solo_JQdecimal(this.id)"
    $('#' + id).on('keypress', function(e) {
        // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
        var field = $(this);
        key = e.keyCode ? e.keyCode : e.which;

        if (key == 8) return true;
        if (key > 47 && key < 58) {
            if (field.val() === "") return true;
            var existePto = (/[.]/).test(field.val());
            if (existePto === false) {
                regexp = /.[0-9]{10}$/; //Parte Entera 10
            } else {
                regexp = /.[0-9]{4}$/; //Parte Decimal 2
            }
            return !(regexp.test(field.val()));
        }

        if (key == 46) {
            if (field.val() === "") return false;
            regexp = /^[0-9]+$/;
            return regexp.test(field.val());
        }
        return false;
    });
}

/**
 *
 * validStringAndInt()
 * - @var id Input
 * - @var String
 * - @var Int
 *
 *  String = true si quieres validar solo letras
 * 	Int = true si quieres validas solo numeros
 *
 */

function validStringAndInt(input = 'validStringAndInt', varString = true, varInt = true) {
    if (varString == true && varInt == true) {
        $('#' + input).on('input', function() {
            this.value = this.value.replace(/[^0-9-a-z-A-Z]/g, '');
        });
    } else if (varString == true && varInt == false) {
        $('#' + input).on('input', function() {
            this.value = this.value.replace(/[^a-z-A-Z]/g, '');
        });
    } else if (varString == false && varInt == true) {
        $('#' + input).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    } else {
        return false;
    }
}

/**
 *
 * Function jQuety
 * Block Copy And Paste On Inputs
 *
 */

function blockCopyPaste(idInput) {
    $('#' + idInput).on('paste', function(e) {
        e.preventDefault();
        return false;
    });

    $('#' + idInput).on('copy', function(e) {
        e.preventDefault();
        // alert('Esta acción está prohibida');
        return false;
    });
}


function formdata(url, data, callback) {
    show_loading = false;
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            if (!show_loading) {
                _showLoader();
            }
        },
        success: function(response) {
            var data = response.data;
            if (data) {
                if (data.status == 900) {
                    if (data.motive) {
                        toast("error", 3000, data.motive);
                    }
                    $("#modal_general").html(data.html);
                    $("#modal_general").modal("show");
                }
            }
            if (callback) {
                callback(response);
            }
        },
        error: function(xhr, status, message) {
            if (!show_loading) {
                _hideLoader();
            }
            console.log("error en peticion ajax en la url: " + url + ", con error: ");
        },
        complete: function(xhr, status) {
            if (!show_loading) {
                _hideLoader();
            }
        }
    })

}

// Función para calcular los días transcurridos entre dos fechas
function restaFechas(f1, f2) {
    var aFecha1 = f1.split('/');
    var aFecha2 = f2.split('/');
    var fFecha1 = Date.UTC(aFecha1[2], aFecha1[0] - 1, aFecha1[1]);
    var fFecha2 = Date.UTC(aFecha2[2], aFecha2[0] - 1, aFecha2[1]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    return dias;
}





function eliminar_intervalo_session() {
    clearTimeout(mjs_intervalo);
    mjs_hora = 0;
    mjs_minuto = 0;
    mjs_segundo = 0;
    mjs_minutoFalso = 0;
    mjs_horaFalso = 0;
}

function mostrar_hora() {

    mjs_segundo++;

    if (mjs_segundo < 10) {
        mjs_segundo = '0' + mjs_segundo;
    }

    if (mjs_segundo == 60) {
        mjs_minuto = mjs_minuto + 1;
        if (mjs_minuto < 10) {
            mjs_minutoFalso = '0' + mjs_minuto;
        } else {
            // if(mjs_minuto == 30)
            // {
            // ajax()
            // }
            mjs_minutoFalso = mjs_minuto;
        }

        if (mjs_minuto == 60) {
            mjs_hora = mjs_hora + 1;
            if (mjs_hora < 10) {
                mjs_horaFalso = '0' + mjs_hora;
            } else {
                mjs_horaFalso = mjs_hora;
            }
            mjs_minuto = 0;
        }
        mjs_segundo = 0;
    }

    horaImprimible = mjs_horaFalso + " : " + mjs_minutoFalso + " : " + mjs_segundo;

    document.getElementById('imprimirhora').innerHTML = horaImprimible;

    mjs_intervalo = setTimeout(mostrar_hora, 1000);

}

function colorBarraLateral(barraVal) {
    var barra = $('#' + barraVal).data('colorbutton1');
    if (barra == barra) {
        $('#' + barraVal).css({ "background-color": "#0069d9", "color": "#ffff" });

    }
}