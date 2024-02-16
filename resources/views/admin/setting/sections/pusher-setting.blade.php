<div class="tab-pane fade" id="pusher-setting" role="tabpanel">
    <form action="{{ route('admin.pusher-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="pusher_id">Pusher APP ID</label>
                <input type="text" name="pusher_app_id" id="pusher_id" class="form-control" placeholder="APP ID Giriniz" value="{{ config('settings.pusher_app_id') }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="pusher_app_key">Pusher KEY</label>
                    <input type="text" name="pusher_key" id="pusher_app_key" class="form-control" placeholder="Pusher Key Giriniz" value="{{ config('settings.pusher_key') }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="pusher_app_secret">Pusher Secret</label>
                <input type="text" name="pusher_secret" id="pusher_app_secret" class="form-control" placeholder="Pusher Secret Giriniz" value="{{ config('settings.pusher_secret') }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="pusher_app_cluster">Pusher Cluster</label>
                <input type="text" name="pusher_cluster" id="pusher_app_cluster" class="form-control" placeholder="Pusher Cluster Giriniz" value="{{ config('settings.pusher_cluster') }}" />
            </div>

        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Kaydet</button>
        </div>
    </form>
</div>
