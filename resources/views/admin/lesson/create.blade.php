@extends('admin.layouts.master')

@section('content')
    <div id="createLessonContainer" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <form action="store" method="POST">
        <div class="row">
            <div class="col-lg-12" id="lesson_header">
                <div style="float:left;"><h1 class="h2">Create lesson</h1></div>
            </div>

        </div>
        <hr>
            {{csrf_field()}}
        <div class="row">
            <div class="col-md-5" id="scheduler-form-right">
                <div class="form-group">
                    <label for="usr">Les naam:</label>
                    <input type="text" class="form-control" id="lessonTitle" placeholder="titel" name="title">
                </div>
                <div id="description"></div>
                <div class="form-group">
                    <label for="sel1">Max studenten:</label>
                    <input type="number" min="1" class="form-control" placeholder="number" name="max_registration">
                </div>
            </div>
            <div class="col-md-6" id="scheduler-form-left">
                @include('admin.layouts.lessonDateForm')
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div id="showLessonDates">
                        <table class="table" style="margin-top: 2%" id="dates-table-items">
                            <thead>
                            <tr>
                                <th>Teacher</th>
                                <th>Date</th>
                                <th>Deadline</th>
                                <th>Time</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody class="tbodyDate">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <div class="container" style="width: 80%">
            <!-- Modal -->
            <div class="modal fade" id="lesson_date_form" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
@endsection