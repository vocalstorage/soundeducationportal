$(document).ready(function () {

    var dates = [];
    var datepickerDates = [];
    var times = [];
    var times_edit = [];
    var times_edit_removed = [];
    var times_edit_added = [];
    var fadeSpeed = 500;
    var lesson_date_edit_id = '';
    var lesson_dates = [];
    var lesson_date_index = '';
    var lesson_id = 0;
    createDatepicker();

    $('.collapsible').collapsible();
    $('.sidenav').sidenav();
    $('.times').modal();
    $('.times_create_edit').modal();
    $('.lesson_edit_modal').modal();
    $('.lesson_date_create_modal').modal();

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

    $("#datepicker").change(function () {
        $("#times").fadeIn(300).focus();
    });

    $("body").on("click", ".lesson_date_delete", function () {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.value) {
                swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                $("#btnAddDateCancel").click();
                var id = $(this).attr('id');
                var tr = $(this).closest("tr");
                tr.fadeOut("fast", function () {
                    tr.remove();
                    delete lesson_dates[id];
                    if($('.entr').length > 0){
                        var all_lesson_dates_html = '';
                        lesson_dates.forEach(function (lesson_date) {
                            all_lesson_dates_html += '<input type="hidden" name="dates[]" value="' + encodeURIComponent(JSON.stringify(lesson_date)) + '">';
                        });
                        $("#all_lesson_dates").html(all_lesson_dates_html);
                    }else{
                        $("#btnMakeLesson").fadeOut(fadeSpeed);
                    }
                    createDatepicker();
                });
            }
        });



    });

    $("body").on("click", "span", function () {
        var span = $(this).closest("span");
        if ($("#btnAddDate").length == 0 && $("#form-lesson_date_update").css('display') == 'none') {
            html = '<div class="form-group">\n' +
                '                    <button type="button" class="btn waves-effect green lighten-1" id="btnAddDate" style="display: none">Voeg datum toe</button>\n' +
                '                </div>';
            $("#scheduler-form-left").append(html);
            $("#btnAddDate").fadeIn(fadeSpeed);
        } else if ($("#form-lesson_date_update").css('display') == 'none') {
            $("#btnAddDate").fadeIn(fadeSpeed);
        }
        if ($(this).attr('class') == 'time') {
            $(this).addClass('selected_time');
            times.push($(span).text());
        } else {
            $(this).removeClass('selected_time');
            times = times.filter(function (e) {
                return e !== $(span).text()
            });
            if (times.length == 0) {
                $("#btnAddDate").fadeOut(fadeSpeed);
            }
        }
    });

    $("body").on("click", ".span_edit", function () {
        var span = $(this).closest("span");
        //removed
        if ($(span).css("background-color") == "rgb(76, 175, 80)" || $(span).css("background-color") == "rgb(20, 20, 80)") {
            $(span).css({"background-color": "transparent", "color": "black"});
            if (times_edit.indexOf($(span).text()) > -1) {
                times_edit_removed.push($(span).text());
            }

            if (times_edit_added.indexOf($(span).text()) > -1) {
                times_edit_added = times_edit_added.filter(function (e) {
                    return e !== $(span).text()
                });
            }

        } else {
            $(span).css({"background-color": "#4CAF50", "color": "white"});
            if (times_edit.indexOf($(span).text()) < 0) {
                times_edit_added.push($(span).text());
            }
            if (times_edit_removed.indexOf($(span).text()) > -1) {
                times_edit_removed = times_edit_removed.filter(function (e) {
                    return e !== $(span).text()
                });
            }
        }
    });

    $("body").on("click", "#btnAddDate", function () {

        if($("#deadlineNr").val() > 0 && $("#deadlineNr").val() < 21){
            allTimes = "";
            //order times from am to pm
            times.sort();

            $("#datePlaceholder").remove();
            $("#btnMakeLesson").fadeIn(fadeSpeed);

            allTimes = times.join();

            var lesson_date = {
                date: $("#datepicker").val(),
                teacher_id: $("#teacher_id").val(),
                times: times,
            };

            lesson_dates.push(lesson_date);

            var all_lesson_dates_html = '';
            lesson_dates.forEach(function (lesson_date) {
                all_lesson_dates_html += '<input type="hidden" name="dates[]" value="' + encodeURIComponent(JSON.stringify(lesson_date)) + '">';
            });

            $("#all_lesson_dates").html(all_lesson_dates_html);

            createDatepicker();

            lesson_date_index = lesson_dates.length - 1;

            html = '<tr class="entr entries_'+lesson_date_index+'" id="fadeIn" style="display:none;">';
            html += '<td scope="col">' + $("#teacher_id :selected").text();
            +'</td>';
            html += '<td scope="col">' + $("#datepicker").val() + '</td>';
            html += '<td scope="col">' + allTimes + '</td>';
            html += '<td scope="col"><i class="material-icons lesson_date_create_edit " id="' + lesson_date_index + '">edit</i><i class="material-icons lesson_date_delete" id="' + lesson_date_index + '">delete</i></td>';
            html += '</tr>';

            if ($("#btnMakeLesson").length == 0) {
                $("#lesson_header_function").append('<button class="btn float-right green lighten-1 waves-effect" id="btnMakeLesson">Maak les aan</button>');
            } else {
                $("#lesson_header_function").fadeIn(fadeSpeed);
            }


            $("#btnAddDate").fadeOut(fadeSpeed);
            $("#dates-table-items").append(html);


            $("#fadeIn").fadeIn(fadeSpeed).removeAttr('id');
            $("#times").fadeOut(fadeSpeed);
            $("html, body").animate({scrollTop: 0}, 1000);
            $("#datepicker").val("");
            times = [];
            dates = [];

            $('.time').each(function () {
                if (lesson_date.times.indexOf($(this).text()) > -1) {
                    $(this).removeClass('selected_time');
                }
            });
        }else{
            swal(
                'Error',
                'Deadline number is too small or to big',
                'error'
            )
        }
    });

    $("body").on("click", "#btnAddDateUpdate", function () {
        $("#btnAddDate").fadeOut(fadeSpeed);
        $("#times").fadeOut(fadeSpeed);
        $("#form-lesson_date_update").fadeOut(fadeSpeed);

        times = [];
        $('.time').each(function (time) {
            if ($(this).attr('class') == 'time selected_time') {
                times.push($(this).text());
            }
        });

        times.sort();
        allTimes = times.join();

        lesson_dates[lesson_date_index].date = $('#datepicker').val();
        lesson_dates[lesson_date_index].teacher_id = $('#teacher_id').val();
        lesson_dates[lesson_date_index].times = times;

        var all_lesson_dates_html = '';
        lesson_dates.forEach(function (lesson_date) {
            all_lesson_dates_html += '<input type="hidden" name="dates[]" value="' + encodeURIComponent(JSON.stringify(lesson_date)) + '">';
        });

        $('.entries_' + lesson_date_index).remove();

        html = '<tr class="entr entries_'+lesson_date_index+'" id="fadeIn" style="display:none;">';
        html += '<td scope="col">' + $("#teacher_id :selected").text()+'</td>';
        html += '<td scope="col">' + $("#datepicker").val() + '</td>';
        html += '<td scope="col">' + allTimes + '</td>';
        html += '<td scope="col"><i class="material-icons lesson_date_create_edit " id="' + lesson_date_index + '">edit</i><i class="material-icons lesson_date_delete" id="' + lesson_date_index + '">delete</i></td>';
        html += '</tr>';
        $("#dates-table-items").append(html);
        $("#fadeIn").fadeIn(fadeSpeed).removeAttr('id');

        times = [];
        dates = [];
        $("#datepicker").val("");
        $('.time').each(function () {
            $(this).removeClass('selected_time');
        });
        createDatepicker();


        swal(
            "Succes!",
            "Lesson date is edited!",
            "success"
        );
    });

    $("body").on("click", "#btnAddDateCancel", function () {
        $("#btnAddDate").fadeOut(fadeSpeed);
        $("#times").fadeOut(fadeSpeed);
        $("#form-lesson_date_update").fadeOut(fadeSpeed);

        times = [];
        dates = [];
        $("#datepicker").val("");

        $('.time').each(function () {
            $(this).removeClass('selected_time');
        });
    });


    $("body").on("click", ".btnShowLessonDates", function () {
        if ($('#showLessonDates' + $(this).attr('id')).attr('class') !== "collapsing") {
            if ($('#showLessonDates' + $(this).attr('id')).attr('class') == "collapse") {
                $('.last').hide();
                $('#trShowLessonDates' + $(this).attr('id')).addClass('last');
                $('#trShowLessonDates' + $(this).attr('id')).show();
            }
            if ($('#showLessonDates' + $(this).attr('id')).attr('class') == "collapse show") {
                $('#trShowLessonDates' + $(this).attr('id')).hide();
            }
        }
    });

    $("body").on("click", ".btnShowLessonDatesRegistrations", function () {
        var id = $(this).attr('id').substring(1, $(this).attr('id').length);
        if ($('#showLessonDatesRegistrations' + id).attr('class') !== "collapsing") {
            if ($('#showLessonDatesRegistrations' + id).attr('class') == "collapse") {
                $('.last_r').hide();
                $('#trShowLessonDatesRegistrations' + id).addClass('last_r');
                $('#trShowLessonDatesRegistrations' + id).show();
            }
            if ($('#showLessonDatesRegistrations' + id).attr('class') == "collapse show") {
                $('#trShowLessonDatesRegistrations' + id).hide();
            }
        }
    });

    $(" body").on("click", ".lesson_date_create_edit", function () {
        $("#btnAddDateCancel").click();
        lesson_date_index = $(this).siblings('i').attr('id');
        lesson_date = lesson_dates[lesson_date_index];

        $('#datepicker').val(lesson_date.date);
        $('#teacher_id').val(lesson_date.teacher_id);

        $('.time').each(function () {
            if (lesson_date.times.indexOf($(this).text()) > -1) {
                $(this).addClass('selected_time');
            } else {
                $(this).removeClass('selected_time');

            }
        });

        $("#form-lesson_date_update").fadeIn(300);

        var elem = document.querySelector('#datepicker');
        var instance = M.Datepicker.getInstance(elem);
        instance.setDate(new Date());

        $("#times").fadeIn(300);

    });

    $("body").on("click", ".lesson_date_create", function (e) {
        //$(this).closest().attr('id');
        e.preventDefault();
        $.get( $(this).attr('href'), function( data ) {
            $('.lesson_date_create_modal').modal('open');
            $('.lesson_date_create_modal-content').html(data);
            $("#datepicker").datepicker();
        });
    });

    $("body").on("click", ".lesson_date_store", function (e) {
        //$(this).closest().attr('id');
        e.preventDefault();
        $.ajax({
            url: '/admin/lesson_date/store',
            type: 'POST',
            dataType: 'JSON',
            data: {'date' : $('#datepicker').val(), 'teacher_id' : $("#teacher_id").val(), 'times':times, 'lesson_id' : lesson_id},
            success: function (data) {
                swal({
                    title: 'Lesson date has been created',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload()
                })  ``
            }
        });
    });

    $("body").on("click", ".lesson_date_edit", function () {
        //$(this).closest().attr('id');
        $.ajax({
            url: '/admin/lesson_date/edit',
            type: 'POST',
            dataType: 'JSON',
            data: {lesson_date_id: $(this).attr('id')},
            success: function (data) {
                $('.times').modal('open');
                $('.modal-content').html(data[0].html);
                lesson_date_edit_id = data[0].lesson_date_edit_id;
                times_edit = data[0].times;}
        });
    });

    $("body").on("click", ".lesson_date_update", function () {
        //$(this).closest().attr('id');
        $.ajax({
            url: '/admin/lesson_date/update',
            type: 'POST',
            dataType: 'JSON',
            data: {
                lesson_date_id: lesson_date_edit_id,
                times_edit_added: times_edit_added,
                times_edit_removed: times_edit_removed,
                teacher_id: $("#teacher_id").val()
            },
            success: function (data) {
                swal({
                    title: 'Lesson has been edited',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload()
                })  ``
            }
        });

    });

    $("body").on("click", ".lesson_delete", function (e) {
        //$(this).closest().attr('id');
        e.preventDefault();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $(this).closest('tr').fadeOut(fadeSpeed, function(){
                    $(this).remove();
                });
                $.get( $(this).attr('href'), function( data ) {
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
    });

    $("body").on("click", ".lesson_edit", function (e) {
        e.preventDefault();

        $.get( $(this).attr('href'), function( data ) {
            $('.lesson_edit_modal-content').html(data);
            $('.lesson_edit_modal').modal('open');
            $('#description').trumbowyg();
            $('#description').trumbowyg('html', $("#description_value").val());
        });
    });

    $("body").on("click", ".lesson_update", function (e) {
        e.preventDefault();
        if(validateForm()){
            $.ajax({
                url: '/admin/lesson/update',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    request: $('form').serializeJSON(),
                },
                success: function (data) {
                    $('.lesson_edit_modal').modal('close');

                    swal({
                        title: 'Lesson has been edited',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        location.reload()
                    })
                }
            });
        }
    });

    $('#description')
        .trumbowyg() // Build Trumbowyg on the #editor element
        .on('tbwchange', function(){
            if($(this).trumbowyg('html')){
                $('.trumbowyg-box').css('border-bottom','solid 2px green');
            }else{
                $('.trumbowyg-box').css('border','none');
            }
        });



    $('#teacher_id').change(function () {
        createDatepicker()
    });

    function createDatepicker() {
        var tempDates = [];
        var curruntTeacher = $("#teacher_id").val();

        lesson_dates.forEach(function (lesson_date) {
            if (lesson_date.teacher_id == curruntTeacher) {
                var from = lesson_date.date.split("-");
                var f = new Date(from[2], from[1] - 1, from[0]);
                tempDates.push(f.getTime())
            }
        });

        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            minDate: new Date(),
            disableDayFn: function (date) {
                if (tempDates.includes(date.getTime())) {
                    return date;
                }
            }
        });
    }

});

function validateForm() {
    errors = 0;
    $( 'form' ).serializeArray().forEach(function (obj) {
        if(obj.value.length == 0){
            if(obj.name == "description"){
                $('.trumbowyg-box').css('border-bottom','solid 2px red');
                $('.trumbowyg-box').addClass('animated shake');
            }else{
                $('input[name='+obj.name+']').addClass('invalid animated shake');
            }
            errors++;
        }
    });

    if(errors !== 0){
        return false
    }else{
        return true
    }
}

