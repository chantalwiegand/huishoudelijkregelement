@include('Bootstrap.bootstrap')
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<div class="container">
    <h1>Regel toevoegen</h1>
    <form  action="{{ route('artikel.store') }}" method="post" id="usrform">
@csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputTitle">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputDescription">Description</label>
                <textarea id="mytextarea" form="usrform" t class="form-control" name="description" placeholder="Description" ></textarea>
            </div>
        </div>


        <button type="submit" class="btn btn-info">Toevoegen</button>
    </form>
</div>

