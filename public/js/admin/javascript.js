$(document).ready(function () {
    var times = [];
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
    $('.tooltipped').tooltip();
    $('.tap-target').tapTarget();

    if($('#deadline').val()){
        value = $('#deadline').val();
        $('#deadline').datepicker(
            {
                minDate: 0,
                format: 'dd/mm/yyyy'
            }
        );
        $('#deadline').datepicker('setDate', value);
    }else{
        $('#deadline').datepicker(
            {
                minDate: new Date(),
                format: 'dd/mm/yyyy'
            }
        );
    }




    $.trumbowyg.svgPath = '/assets/icons.svg';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#description').trumbowyg({
        btns: [
            ['foreColor', 'backColor', 'strong', 'em'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em'],
            ['superscript', 'subscript'],
            ['link'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ]
    });

    $('#description').trumbowyg('html', $("#description_value").val());

    $("#datepicker").change(function () {
        $("#times").fadeIn(300).focus();
    });


    $("body").on("click", ".confirm_delete", function (e) {
        //$(this).closest().attr('id');


        e.preventDefault();
        elem = $(this);
        confirmDelete('Are you sure?',"You won't be able to revert this!",'Yes, delete it!', elem);
    });

    $('#description')
        .trumbowyg() // Build Trumbowyg on the #editor element
        .on('tbwchange', function () {
            if ($(this).trumbowyg('html')) {
                $('.trumbowyg-box').css('border-bottom', 'solid 2px green');
            } else {
                $('.trumbowyg-box').css('border', 'none');
            }
            $('#description_value').val($(this).trumbowyg('html'));
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
            eventClick: function (event, jsEvent, view) {
                 current_event = $(this);
                $('#eventModal').modal('open');
                $.get('/admin/lessonDate/showRegistrationForm/' + event.lessonDate_id, function (data) {
                    $('#eventModal').html('');
                    $('#eventModal').append(data);
                    $('select').formSelect();
                });

            },
            dayClick: function (date, jsEvent, view) {
                $('#eventModal').modal('open');

                $.get('/admin/lessonDate/create/' + date.format() + '/' + current_lesson_id, function (data) {
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
    $('body').on('click', '.lessondate_delete', function (e) {
        e.preventDefault();
        $.get($(this).attr('href'), function() {
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
        $.get($(this).attr('href'), function() {
            location.reload();
        });
    });


    $('body').on("click", ".time", function(){
        var span = $(this);
        if ($(this).attr('class') === 'time') {
            $(this).addClass('selected_time');

            var color = $(".tab .active").css("color");

            $(this).css('background-color', color);
            teachers[current_teacher_key].times.push(span.text());

            teachers[current_teacher_key].removedTimes =  teachers[current_teacher_key].removedTimes.filter(function (e) {
                return e !== span.text()
            });
        } else {
            $(this).removeClass('selected_time');
            $(this).css('background-color', '#ffffff');

            teachers[current_teacher_key].removedTimes.push(span.text());


            teachers[current_teacher_key].times =  teachers[current_teacher_key].times.filter(function (e) {
                return e !== span.text()
            });

        }
    });

    $('body').on('click', '.eventTab', function(e) {
        id = $(this).attr('id');
        id = id.substring(1, id.length);

        current_teacher_key = teachers.findIndex(function (teacher){
            return teacher.id == id;
        });
    });

    $('body').on('click', '#lesson_date_save', function () {
        console.log(teachers);
        $.ajax({
            url: '/admin/lessonDate/store',
            type: 'POST',
            dataType: 'JSON',
            data: {'lesson_id' : current_lesson_id, 'teachers' : teachers, 'date' : current_date},
            success: function (data) {
                location.reload();
            }
        });
    });

    $('body').on("keyup","#studentSearchInput", function() {
        var value = $(this).val();

        $("table tbody tr").each(function(index) {
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

    $('#lfm').filemanager('image');
});

function confirmDelete(title, text, confirmtext, elem){
    swal({
        title: title,
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmtext
    }).then((result) => {
        if (result.value) {
            elem.closest('tr').fadeOut(500, function () {
                elem.remove();
            });
            $.get(elem.attr('href'), function (data) {
                if (data) {
                    swal(
                        'Deleted!',
                        'Lesson has been deleted.',
                        'success'
                    )
                }
            });
        }

    })
}

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



