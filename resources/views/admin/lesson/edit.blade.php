<h3 >Edit lesson</h3>

<div class="container">
    <div class="row">
            <form>
                <div class="input-field">
                    <label>Lesson name:</label>
                    <input value="{{$lesson->title}}" type="text" class="validate" placeholder="Lesson title"
                           name="title" >
                </div>
                <div class="input-field">
                    <label>description:</label>
                    <div id="description"></div>
                    <input value="{{$lesson->description}}" id="description_value" type="hidden">
                </div>
                <div class="input-field">
                    <label>max:</label>
                    <input value="{{$lesson->max_registration}}" type="number" min="1" placeholder="max registrations"
                           name="max_registration" class="validate">
                </div>
                <input value="{{$lesson->id}}" type="hidden" name="lesson_id">
            </form>
    </div>
</div>