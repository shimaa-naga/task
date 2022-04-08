<div class="modal fade modal_create" id="myModalHorizontal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ion-android-close"></span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: whitesmoke;">New Category</h4>
            </div>
            <form id="frm_add"  method="POST"  data-parsley-validate="">
            @csrf<!-- Modal Body -->
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="parent">Parent Category</label>
                    </div>
                    <div class="col-md-9">
                        <select name="parent" id="parent" class="form-control get_parent" >
                            <option selected disabled>Choose Parent</option>
                            @foreach ($parents as $parent)
                                <option value="{{$parent->id}}">{{$parent->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group  row">
                    <div class="col-md-3">
                        <label for="title">Title <span class="text-red">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="title" id="title" class="form-control add_title" required=""
                               maxlength="255" data-parsley-maxlength="255">
                        <span id="title_error" style="display:none" class="help-block text-red">Title Error</span>
                    </div>
                </div>
                <div class="form-group  row">
                    <div class="col-md-3">
                        <label for="language">Language</label>
                    </div>
                    <div class="col-md-9">
                        <select name="language" id="language" class="form-control">
                            <option selected disabled>Select Language</option>
                            @foreach ($languages as $language)
                                <option value="{{$language->id}}">{{$language->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                <button type="submit"  class="btn btn-primary">save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script>

        $('body').on('submit',"#frm_add",function (e) {
            e.preventDefault();

            var data = $("#frm_add").serialize();
            // alert(data);
            $.ajax({
                url: "{{ route('admin.category.store') }}",
                method: "post",
                data: data,
                success: function (response) {
                    if (response.status === true) {

                        $('.modal.modal_create').modal('hide');
                        get_parent();
                        table.ajax.reload();
                        $("#frm_add").parsley().reset();
                        $('.add_title').val("");
                    }

                },
                error: function (res) {
                    if (res.responseJSON['errors']['title']) {
                        $('#title_error').show();
                        $('#title_error').text(res.responseJSON['errors']['title'][0]);
                    }

                }
            });
        });

        function get_parent() {
            $.ajax({
                url: "{{ route('admin.category.get_parent') }}",
                type: "GET",
                dataType: 'json',
                success: function (res) {
                    if (res) {

                        $('.get_parent').empty();
                        <?php if (isset($external)) { ?>
                        $('.get_parent').append('<option selected disabled>---</option>');
                        <?php } else {
                        ?>  $('.get_parent').append('<option selected disabled> Choose Parent </option>');
                        <?php }
                        ?>

                        $.each(res, function(result, row){
                            $('.get_parent').append('<option value=" ' + row.id + ' "> ' + row.title + '</option>');
                        });
                    }
                    else{
                        $(".get_parent").empty();
                    }
                }
            });
        }

        $(document).on('show.bs.modal', '.start_modal', function (e) {
            get_parent();
        });

    </script>
@endpush
