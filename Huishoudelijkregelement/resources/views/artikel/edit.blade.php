@include('Bootstrap.bootstrap')
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<div class="container">
    <h1>Regel aanpassen</h1>
    <form  action="{{ route('artikel.update', $id) }}" method="post" id="usrform">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputTitle">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{$artikel->title}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputDescription">Description</label>
                <textarea id="mytextarea" form="usrform" t class="form-control" name="description" placeholder="Description">{{$artikel->description}}</textarea>
            </div>
        </div>


        <button type="submit" class="btn btn-info">Aanpassen</button>
    </form>
</div>

