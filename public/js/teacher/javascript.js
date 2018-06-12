$(document).ready(function () {
    var timesRemoved = [];
    var fadeSpeed = 500;
    var lesson_dates = [];
    var current_teacher_key = 0;
    var current_date;
    var current_event;



    $('.collapsible').collapsible();
    $('.sidenav').sidenav();
    $('.times').modal();
    $('.times_create_edit').modal();
    $('.lesson_edit_modal').modal();
    $('.lesson_date_create_modal').modal();
    $('#eventModal').modal();
    $('#addEventModal').modal();
    $('select').formSelect();



    $.trumbowyg.svgPath = '/assets/icons.svg';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    if ($('#calendar_lessondate').length > 0) {
        $('#calendar_lessondate').fullCalendar({
            defaultView: 'agendaWeek',
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
            eventClick: function (event, jsEvent, view) {
                 current_event = $(this);
                $('#eventModal').modal('open');
                $.get('/teacher/lessonDate/showRegistrationForm/' + event.lessonDate_id, function (data) {
                    $('#eventModal').html('');
                    $('#eventModal').append(data);
                    $('select').formSelect();
                });

            },
            dayClick: function (date, jsEvent, view) {
                $('#eventModal').modal('open');
                $.get('/teacher/lessonDate/create/' + date.format() + '/' + current_lesson_id, function (data) {
                    $('#eventModal').html('');
                    $('#eventModal').append(data);
                    $('select').formSelect();
                    $('#datepicker').datepicker();
                    $('#eventTabs').tabs();

                    current_date = date.format();
                });
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
            eventRender: function(event, element) {
                $(element).find('a').addClass('col s12');

                var target =  $(element).find(".fc-list-item-title");
                // var title = $("<div class='col s9'>");
                // title = title.html(event.title);



                $.each( event.registrations, function( index, obj ){
                    var student = $("<div class='col-presence col s9'>");
                    var studentContent = '<div>' + obj.student + '</div>';
                    student.html(studentContent);
                    target.append(student);

                    var presenceContent = $('.switch').html();
                    var presenceSwitch = $("<div class='col-presence switch col s3'>");
                    presenceSwitch.html(presenceContent);

                    target.append(presenceSwitch);

                    if(event.presence) {
                        $(element).find("input").attr('checked', 'checked');
                    }
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

});


function validateForm() {
    errors = 0;
    $('form').serializeArray().forEach(function (obj) {
        if (obj.value.length == 0) {
            if (obj.name == "description") {
                $('.trumbowyg-box').css('border-bottom', 'solid 2px red');
                $('.trumbowyg-box').addClass('animated shake');
            } else {
                $('input[name=' + obj.name + ']').addClass('invalid animated shake');
                $('select[name=' + obj.name + ']').addClass('invalid animated shake');
            }
            errors++;
        }
    });

    if (errors !== 0) {
        return false
    } else {
        return true
    }
}

$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    }
});



