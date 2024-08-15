<div class="card">
    <div class="card-header">
        <h3>Create a Banillapost</h3>
    </div>

    <div class="card-body">
        <form class="my-3" wire:submit="save">
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" wire:model="post_title" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput" class="text-muted">Title</label>
                </div>
                @error('post_title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="post details" wire:model="content" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingInput" class="text-muted">Text</label>
                </div>
                @error('content')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" placeholder="post details" wire:model="photo" id="">
                </div>
                @error('photo')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="/user/home" wire:navigate class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
