$(document).ready(function () {
    var timesRemoved = [];
    var fadeSpeed = 500;
    var lesson_dates = [];
    var current_teacher_key = 0;
    var current_date;
    var current_event;

    $('.tooltipped').tooltip();

    $('.collapsible').collapsible();
    $('.sidenav').sidenav();
    $('.times').modal();
    $('.times_create_edit').modal();
    $('.lesson_edit_modal').modal();
    $('.lesson_date_create_modal').modal();
    $('#eventModal').modal();
    $('#addEventModal').modal();
    $('select').formSelect();
    $('.commentModal').modal();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote'],
        })
        .catch(error => {
            console.log(error);
        });

    $("body").on("click", ".swal-show-warning", function (e) {
        e.preventDefault();
        elem = $(this);

        confirmDelete('Are you sure?', $(this).attr('data-message'), 'Yes, delete it!', $(this).attr('data-loading-message'));
    });


    if ($('#calendar_lessondate').length > 0) {
        $('#calendar_lessondate').fullCalendar({
            defaultView: 'agendaWeek',
            customButtons: {
                myCustomButton: {
                    text: 'Aanwezigheid',
                    click: function() {
                        $('#calendar_lessondate,#calendar_presence').fadeToggle(200);
                        $('#calendar_presence').fullCalendar('rerenderEvents');

                    }
                }
            },
            header: {
                left: 'myCustomButton',
                center: 'title',
                right: 'today, prev,next'
            },
            nowIndicator: true,
            eventLimit: 6, // If you set a number it will hide the itens
            eventLimitText: "lessen",
            eventOrder: 'teacher_id',
            events: events,
            timeFormat: 'H:mm',
            validRange: {
                start: new moment,
                end:  moment(deadline.date).subtract(5, 'days'),
            },
            eventClick: function (event, jsEvent, view) {
                 current_event = $(this);
                $('#eventModal').modal('open');
                $('#eventModalLoader').show();
                $('.event-modal-content').html('');
                $.get('/teacher/lessonDate/showRegistrationForm/' + event.lessonDate_id, function (data) {
                    $('.event-modal-content').fadeOut(200,function () {
                        $('.event-modal-content').append(data);
                        $('#eventModalLoader').hide();
                        $('.event-modal-content').fadeIn(200);
                    });
                });

            },
            dayClick: function (date, jsEvent, view) {
                $('#eventModal').modal('open');
                $.get('/teacher/lessonDate/create/' + date.format() + '/' + current_lesson_id, function (data) {
                    $('#eventModal').modal('open');
                    $('#eventModalLoader').show();
                    $('.event-modal-content').html('');
                    $('.event-modal-content').fadeOut(200,function () {
                        $('.event-modal-content').html('');
                        $('.event-modal-content').append(data);
                        $('#eventModalLoader').hide();
                        $('.event-modal-content').fadeIn(200);
                    });
                    current_date = date.format();
                });
            },
        });
    }

    if ($('#calendar_presence').length > 0) {
        $('#calendar_presence').fullCalendar({
            defaultView: 'listDay',
            customButtons: {
                myCustomButton: {
                    text: 'Kalendar',
                    click: function() {
                        $('#calendar_lessondate,#calendar_presence').fadeToggle(200);
                        $('#calendar_lessondate').fullCalendar('rerenderEvents');
                    }
                }
            },
            views: {
                listDay: { buttonText: 'dag' },
                listWeek: { buttonText: 'week' },
                listMonth: { buttonText: 'maand' }
            },
            header: {
                left: 'myCustomButton',
                center: 'title',
                right: 'listDay, listWeek, listMonth, prev,next'
            },
            eventLimit: 6, // If you set a number it will hide the itens
            eventLimitText: "lessen",
            eventOrder: 'teacher_id',
            events: event_regs,
            timeFormat: 'H:mm',
            validRange: {
                start: new moment,
                end:  moment(deadline.date).subtract(5, 'days'),
            },
            eventRender: function(event_reg, element) {
                var target = $(element).find(".fc-list-item-title");

                $.each( event_reg.registrations, function( index, registration ){
                    var row = $('<div class="row">');
                    var student = $("<div class='col-presence col s4'>");
                    var studentContent = registration.student;
                    student.html(studentContent);
                    row.append(student);

                    var comment = $("<div class='col-presence col s4'>");
                    if(registration.comment){
                        var studentComment = '<div class="comment" data-message="'+registration.comment+'"><i class="material-icons comment-icon">email</i></div>';
                        comment.html(studentComment);
                    }
                    row.append(comment);

                    var presenceContent = $('.switch').html();
                    var presenceSwitch = $("<div class='col-presence switch col s4'>");
                    row.append(presenceSwitch);
                    presenceSwitch.html(presenceContent);

                    var input = row.find("input");
                    input.attr('data-id', registration.id);
                    input.addClass('checkbox'+registration.id);

                    if(registration.presence) {
                        input.prop('checked', true);
                    }

                    var confirm = $("<a href='/test'>");
                    if(registration.comment){
                        var studentComment = '<div class="comment" data-message="'+registration.comment+'"><i class="material-icons comment-icon">email</i></div>';
                        comment.html(studentComment);
                    }
                    target.append(row);
                });
            }
        });
    }

    $('body').on("click", ".time", function(){
        var span = $(this);
        if ($(this).attr('class') === 'time') {
            $(this).addClass('selected_time');
            color = teacher.color;

            $(this).css('background-color', color);
            teacher.times.push(span.text());

            teacher.removedTimes =  teacher.removedTimes.filter(function (e) {
                return e !== span.text()
            });
        } else {
            $(this).removeClass('selected_time');
            $(this).css('background-color', '#ffffff');

            teacher.removedTimes.push(span.text());

            teacher.times =  teacher.times.filter(function (e) {
                return e !== span.text()
            });
        }
    });


    $('body').on('click', '#lesson_date_save', function () {
        $.ajax({
            url: '/teacher/lessonDate/store',
            type: 'POST',
            dataType: 'JSON',
            data: {'lesson_id' : current_lesson_id, 'teacher' : teacher, 'date' : current_date},
            success: function (data) {
                location.reload();
            }
        });
    });


    $('body').on('change', '.presence', function() {
        var id = $(this).attr('data-id');
        handlePresence(id, $(this));
    });

    $('body').on('click', '.comment', function () {
        $('.modal-phrase').html($(this).attr('data-message'));
        $('.commentModal').modal('open');
    });

    $('.fc-button').addClass('btn waves-effect green lighten-1').removeClass('fc-state-default');
    $('.fc-day-grid-event').addClass('waves-effect');

    var editor_config = {
        path_absolute : "/",
        selector: "textarea.my-editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

});

function handlePresence(id,elem){
    $.post( "/teacher/lessonDate/handlePresence", { registration_id: elem.attr('data-id'), presence: elem.is(":checked") })
        .done(function( data ) {
            $('.checkbox'+id).prop('checked',elem.is(":checked"));

    });
}

function validateForm(target) {
    if(target.length <= 0){
        target = 'form';
    }
    errors = 0;
    console.log(target);
    $(target).serializeArray().forEach(function (obj) {
        if (obj.value.length == 0 && obj.name !== 'password'){

            $('input[name=' + obj.name + ']').addClass('invalid animated shake');
            $('select[name=' + obj.name + ']').addClass('invalid animated shake');

            errors++;
        }
    });
    if (errors !== 0) {
        return false
    } else {
        $('.loader').show();
        $('.dim-screen').show();
        return true
    }
}

$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    }
});

function confirmDelete(title, html, confirmtext, loadMessage) {
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


