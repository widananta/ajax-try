<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }}{{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nama" class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control" autofocus required>
                            <span class="help-block with errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" required>
                            <span class="help-block with errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="col-md-3 control-label">Foto</label>
                        <div class="col-md-6">
                            <input type="file" name="foto" id="foto" class="form-control" required>
                            <span class="help-block with errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>
