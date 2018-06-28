$(document).ready(function () {
    var times = [];
    var fadeSpeed = 500;
    var lesson_dates = [];
    var current_teacher_key = 0;
    var current_date;
    var current_event;
    var takenColors = 0;

    $('.collapsible').collapsible();
    $('.sidenav').sidenav();
    $('.times').modal();
    $('.times_create_edit').modal();
    $('.lesson_edit_modal').modal();
    $('.lesson_date_create_modal').modal();
    $('#eventModal').modal();
    $('#addEventModal').modal();
    $('.modal').modal();
    $('select').formSelect();


    $('.tooltipped').tooltip();
    $('.tap-target').tapTarget();
    $('.excel-tabs').tabs();
    $('.commentModal').modal();

    $('#excelFilemanager').filemanager('xlsx', 'xls');

    $('#lfm').filemanager('image');

    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote'],
        })
        .catch(error => {
            console.log(error);
        });

    $('#deadline').datepicker(
        {
            minDate: new Date(moment().add('5', 'days').format()),
            format: 'dd/mm/yyyy'
        }
    );


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#datepicker").change(function () {
        $("#times").fadeIn(300).focus();
    });


    $("body").on("click", ".swal-show-warning", function (e) {
        e.preventDefault();
        elem = $(this);

        confirmDelete('Weet je het zeker?', $(this).attr('data-message'), 'Ja, verwijderen', $(this).attr('data-loading-message'), elem);
    });

    $("body").on("click", ".check-all", function () {
        var check = false;
        if (this.checked) {
            check = true
        }
        $(":checkbox[name='delete[]']").each(function () {
            this.checked = check;
        });
    });

    if ($('#calendar_lessondate').length > 0) {
        $('#calendar_lessondate').fullCalendar({
            defaultView: 'month',
            header: {
                left: 'myCustomButton',
                center: 'title',
                right: 'today, prev,next'
            },
            eventLimit: 6, // If you set a number it will hide the itens
            eventLimitText: "lessen",
            eventOrder: 'teacher_id',
            events: events,
            timeFormat: 'H:mm',
            validRange: {
                start: moment(new Date()).format("YYYY-MM-DD"),
                end: moment(deadline, "YYYY-MM-DD").subtract(4, 'days'),
            },
            eventClick: function (event, jsEvent, view) {
                current_event = $(this);
                $('#eventModal').modal('open');
                $('#eventModalLoader').show();
                $('.event-modal-content').html('');
                $.get('/admin/lessonDate/showRegistrationForm/' + event.lessonDate_id, function (data) {
                    $('.event-modal-content').fadeOut(200, function () {
                        $('.event-modal-content').append(data);
                        $('#eventModalLoader').hide();
                        $('.event-modal-content').fadeIn(200);
                    });
                    $('select').formSelect();
                });

            },
            dayClick: function (date, jsEvent, view) {
                $('#eventModal').modal('open');
                $('#eventModalLoader').show();
                $('.event-modal-content').html('');
                $.get('/admin/lessonDate/create/' + date.format() + '/' + current_lesson_id, function (data) {
                    $('.event-modal-content').fadeOut(200, function () {
                        $('.event-modal-content').html(data);
                        $('#eventModalLoader').hide();
                        $('.event-modal-content').fadeIn(200, function () {
                            $('#eventTabs').tabs();
                        });
                    });
                });
                current_date = date.format();
            },
            select: function (start, end, allDay) {
                var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
            },
            eventRender: function eventRender(event, element, view) {
                return current_colors.includes(event.backgroundColor);
            }
        });
    }
    if ($('#calendar_presence').length > 0) {
        $('#calendar_presence').fullCalendar({
            defaultView: 'listWeek',
            header: {
                left: 'myCustomButton',
                center: 'title',
                right: 'today, prev,next'
            },
            eventLimit: 6, // If you set a number it will hide the itens
            eventLimitText: "lessen",
            eventOrder: 'teacher_id',
            events: events,
            timeFormat: 'H:mm',
            validRange: {
                start: moment(new Date()).format("YYYY-MM-DD"),
                end: moment(deadline, "YYYY-MM-DD").subtract(5, 'days'),
            },
            eventRender: function (event, element) {
                $.each(event.registrations, function (index, registration) {
                    var target = $(element).find(".fc-list-item-title");
                    var row = $('<div class="row">');
                    var student = $("<div class='col-presence col s4'>");
                    var studentContent = registration.student;
                    student.html(studentContent);
                    row.append(student);

                    var comment = $("<div class='col-presence col s4'>");
                    if (registration.comment) {
                        var studentComment = '<div class="comment" data-message="' + registration.comment + '"><i class="material-icons comment-icon">email</i></div>';
                        comment.html(studentComment);
                    }
                    row.append(comment);

                    var presenceContent = $('.switch').html();
                    var presenceSwitch = $("<div class='col-presence switch col s4'>");
                    row.append(presenceSwitch);
                    presenceSwitch.html(presenceContent);


                    var input = row.find(".presence");
                    input.attr('data-id', registration.id);
                    input.addClass('checkbox' + registration.id);
                    if (registration.presence == true) {
                        input.prop('checked', true);
                    }

                    target.append(row);
                });
            }
        });
    }

    $('body').on('click', '.lessondate_delete', function (e) {
        e.preventDefault();
        $.get($(this).attr('href'), function () {
            $('#eventModal').modal('close');
        });

        location.reload();
    });

    $('body').on('click', '.lessondate_register', function () {
        $('.studentSearchForm').fadeToggle('1000');
        $(this).find('i').toggleText('add', 'remove_circle');
        $('#studentSearchInput').focus();
    });

    $('body').on('click', '.lessondate_cancelStudent', function (e) {
        e.preventDefault();
        $.get($(this).attr('href'), function () {
            location.reload();
        });
    });


    $('body').on("click", ".time", function () {
        var span = $(this);
        console.log(teachers);

        if ($(this).attr('class') === 'time') {
            $(this).addClass('selected_time');

            var color = $(".tab .active").css("color");

            $(this).css('background-color', color);
            teachers[current_teacher_key].times.push(span.text());

            teachers[current_teacher_key].removedTimes = teachers[current_teacher_key].removedTimes.filter(function (e) {
                return e !== span.text()
            });
        } else {
            $(this).removeClass('selected_time');
            $(this).css('background-color', '#ffffff');

            teachers[current_teacher_key].removedTimes.push(span.text());


            teachers[current_teacher_key].times = teachers[current_teacher_key].times.filter(function (e) {
                return e !== span.text()
            });

        }
    });

    $('body').on('click', '.eventTab', function (e) {
        id = $(this).attr('id');
        id = id.substring(1, id.length);

        current_teacher_key = teachers.findIndex(function (teacher) {
            return teacher.id == id;
        });
    });

    $('body').on('click', '#lesson_date_save', function () {
        $.ajax({
            url: '/admin/lessonDate/store',
            type: 'POST',
            dataType: 'JSON',
            data: {'lesson_id': current_lesson_id, 'teachers': teachers, 'date': current_date},
            success: function (data) {
                location.reload();
            },
            error: function (XMLHttpRequest) {
                var errors = JSON.parse(XMLHttpRequest.responseText).errors;
                var html = '';

                $.each(errors, function (key,message) {
                    html += '<p class=error>' + message + '</p>';
                });

                if (!html) {
                    html = 'Er is iets fout gegaan!';
                }

                swal({
                    type: 'error',
                    title: 'Oeps...',
                    html: html,
                })
            }
        });
    });

    $('body').on('click', '.close', function () {
        $(this).find('.alert-succes').fadeOut(200);
    });

    $('body').on("keyup", "#studentSearchInput", function () {
        var value = $(this).val();

        $("table tbody tr").each(function (index) {
            if (index !== 0) {

                $row = $(this);

                var id = $row.find("td:first").text();

                if (id.indexOf(value) !== 0) {
                    $row.hide();
                }
                else {
                    $row.show();
                }
            }
        });
    });


    var editor_config = {
        path_absolute: "/",
        selector: "textarea.my-editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };


    if ($('.removed_lessondate').length > 0) {
        $('.removed_lessondate').each(function (index) {
            var amount = $(this).attr('data-removedamount');
            setTimeout(toast.bind(null, amount, index * 1000));
        });
    }

    $('body').on('change', '.legend-lesson-filter', function () {
        if ($(this).is(':checked')) {
            current_colors.push($(this).attr('data-color'));
        } else {
            var index = current_colors.indexOf($(this).attr('data-color'));
            current_colors.splice(index, 1);

        }

        $('#calendar_lessondate').fullCalendar('rerenderEvents');
    });



    $('body').on('click', '.comment', function () {
        $('.modal-phrase').html($(this).attr('data-message'));
        $('.commentModal').modal('open');
    });

    $('body').on('change', '.presence', function () {
        var id = $(this).attr('data-id');
        handlePresence(id, $(this));
    });

    $('.fc-button').addClass('btn waves-effect');


    //validation
    $('.select-dropdown').addClass('validate');

    $('select').formSelect().each(function () {
        if ($(this).attr('class').includes('invalid')) {
            $(this).siblings('.select-dropdown').addClass('invalid');
            $(this).parent().append($(this).parent().siblings('.helper-text'));
        }
    });

    $("select").on('change', function () {
        if ($(this).val()) {
            $(this).siblings('.select-dropdown').removeClass('invalid').addClass('valid');
        }
    });


    if (takenColors.length > 0) {
        takenColors.forEach(function (color) {
            var index = colors.indexOf(color);
            colors.splice(index, 1);
        });
    }

    $('[name="color"]').paletteColorPicker({
        // Color in { key: value } format
        colors: colors,
        // Add custom class to the picker
        custom_class: 'color-picker-big',
        timeout: 50000, // default -> 2000

        // Force the position of picker's bubble
        position: 'downside', // default -> 'upside'
        // Where is inserted the color picker's button, related to the input
        insert: 'after', // default -> 'before'
        // Don't add clear_btn
        clear_btn: 'last', // null -> without clear button, default -> 'first'
        // Forces closin all bubbles that are open before opening the current one
        close_all_but_this: false, // default is false
        // Sets the input's background color to the selected one on click
        // seems that some users find this useful ;)

        onchange_callback: function () {
            $('[name="color"]').click();
        }
    });

    $('.fc-button').addClass('btn waves-effect green lighten-1').removeClass('fc-state-default');

    $('body').on('focus click', '#deadline',  function(e){
        $("#deadline").datepicker('open');

    });
});

function handleWarnings(warnings){

}
function toast(amount) {
    M.toast({html: 'Er zijn zojuist ' + amount + ' lessen verwijderd', classes: 'alert-succes'});
}

function confirmDelete(title, html, confirmtext, loadMessage,elem) {
    swal({
        title: title,
        html: html,
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn waves-effect blue ligthen-1 swal-custom-btn',
        cancelButtonClass: 'btn waves-effect red ligthen-1 swal-custom-btn',
        confirmButtonText: confirmtext
    }).then((result) => {
        if (result.value) {
            swal({
                title: loadMessage
            });
            swal.showLoading();
            $.get(elem.attr('href'), function (data) {
                if (data) {
                    location.reload();
                }
            });
        }
    })
    $('.swal2-styled').removeClass('swal2-styled');
}

// function validateForm(message) {
//     errors = 0;
//     $('form').serializeArray().forEach(function (obj) {
//         if (obj.value.length == 0) {
//             if (obj.name == "description") {
//                 $('.trumbowyg-box').css('border-bottom', 'solid 2px red');
//                 $('.trumbowyg-box').addClass('animated shake');
//             } else {
//                 $('input[name=' + obj.name + ']').addClass('invalid animated shake');
//                 $('select[name=' + obj.name + ']').addClass('invalid animated shake');
//             }
//             errors++;
//         }
//     });
//
//     if (errors !== 0) {
//         return false
//     } else {
//         swal({
//             title: message
//         });
//         swal.showLoading();
//         return true
//     }
// }

$('body').on('click', '.show-swal-loading', function () {
    var message = "aan het laden";

    if($(this).attr('data-message')){
        message = $(this).attr('data-message');
    }
    swal({
        title: message
    });
    swal.showLoading();
});


function handlePresence(id, elem) {
    $.post("/admin/lessonDate/handlePresence", {registration_id: elem.attr('data-id'), presence: elem.is(":checked")})
        .done(function (data) {
            $('.checkbox' + id).prop('checked', elem.is(":checked"));

        });
}

$.fn.extend({
    toggleText: function (a, b) {
        return this.text(this.text() == b ? a : b);
    }
});

