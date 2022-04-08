<div id="editForm" class="modal  fade modal_edit"  role="dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ion-android-close"></span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Edit category</h4>
            </div>
            <form   id="formedit" data-parsley-validate="">
            @csrf
            {{method_field('PUT')}}
                <input type="hidden" name="itemId" id="itemId">
                <!-- Modal Body -->
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="parent2">Parent Category</label>
                    </div>
                    <div class="col-md-9">
                        <select name="parent" id="parent2" class="form-control get_parent" >
                            <option selected disabled>Choose Parent</option>
                        </select>
                    </div>
                </div>

                <div class="form-group  row">
                    <div class="col-md-3">
                        <label for="title2">Title<span class="text-red">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="title" id="title2" class="form-control add_title" required="">
                        <span id="title_error_edit" style="display:none" class="help-block text-red">Title Error</span>
                    </div>
                </div>
                <div class="form-group  row">
                    <div class="col-md-3">
                        <label for="language2">Language</label>
                    </div>
                    <div class="col-md-9">
                        <select name="language" id="language2" class="form-control">
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
        function edit(id){
            $('#title_error_edit').hide();
            var $data = id;
            var url = 'category/'+$data+'/edit';
            $.ajax({
                type: 'GET',
                url: url,
                success: function (output) {
                    $('#editForm').modal('show');
                    $("#itemId").val(""+output.item.id);
                    $('#title2').val(output.item_data.title);
                    $("#language2").val(""+output.item_data.lang_id);
                    var parent_id = output.item.parent_id;
                    console.log(parent_id)
                    $.ajax({
                        url:'{{ route('admin.category.get_parent') }}',
                        type:"GET",
                        dataType:'json',
                        success:function (res) {
                            if(res) {
                                $('.get_parent').empty();
                                $('.get_parent').append('<option selected disabled>Choose Parent </option>');
                                $.each(res, function(result ,row){
                                    $('.get_parent').append('<option value="'+row.id+'"> '+row.title+'</option>');
                                });
                                if(parent_id != null){  $('#parent2').val(parent_id); }

                            }else{$(".get_parent").empty() }
                        }
                    });
                },
                error: function(output){
                    alert("fail");
                }
            });
        }


        $('body').on('submit','#formedit',function (e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                url: '{{ url('admin/category/update') }}',
                method: "put",
                data: $(this).serialize(),
                success: function (response) {
                    // console.log(response);
                    if (response.status === true) {

                        $('.modal.modal_edit').modal('hide');
                        table.ajax.reload();
                        get_parent();
                        $("#formedit").parsley().reset();
                        $('#title_error_edit').hide();
                    }

                },
                error: function(res) {
                    if (res.responseJSON['errors']['title']) {
                        $('#title_error_edit').show();
                        $('#title_error_edit').text(res.responseJSON['errors']['title'][0]);
                    }
                }
            });
        })
    </script>
@endpush
