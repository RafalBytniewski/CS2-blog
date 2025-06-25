@vite(['resources/js/grenadeGroup.js'])
<style>
    .modal-overlay {
        color: rgb(255, 255, 255);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*  background: rgba(0, 0, 0, 0.6); */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        z-index: 1000;
    }

    /* Styl treści modala */
    .modal-content {
        background: #2b3035 !important;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        height: 800px;
        width: 90%;
        max-width: 800px;
        /* Maksymalna szerokość modala */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    /* Pokazywanie modala */
    .modal-show {
        opacity: 1;
        visibility: visible;
    }
</style>
<!-- Modal -->

<div id="custom-modal" class="modal-overlay">
    <div class="modal-content">
        <h2 id="modal-title">Add to group</h2>
        <table class="mx-5" style="color:rgb(241, 236, 236)">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Map</th>
                    <th>Count</th>
                    <th>Action</th>
                </tr>
            </thead>

<tbody id="group-table-body">
</tbody>

            </tr>
        </table>
        <div hidden>
        <h2>Make new grenade group</h2>
        <form action="{{ route('grenade.group.store') }}" method="post">
            @csrf
            {{-- USER --}}
            <input name="user_id" type="hidden" @if(Auth::check())value="{{ Auth::user()->id }}" @endif>
            {{-- MAP --}}
            <div class="row mb-3">
                <label for="map" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.map')
                    }}</label>
                <div class="col-md-6">
                    <select id="map" class="form-control @error('map') is-invalid @enderror" name="map_id" required>
                        <option value=""></option>
                        @foreach($maps as $map)
                        <option value="{{ $map->id}}">{{ $map->name }}</option>
                        @endforeach
                    </select>
                    @error('map')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- NAME --}}
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{
                    __('name') }}</label>
                <div class="col-md-6">
                    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- VISIBILITY --}}
            <div class="row mb-3">
                <label for="visibility" class="col-md-4 col-form-label text-md-end">{{
                    __('visibility') }}</label>
                <div class="col-md-6">
                    <select id="visibility" class="form-control @error('visibility') is-invalid @enderror"
                        name="visibility" required>
                        <option value="0">private</option>
                        <option value="1" selected>public</option>
                    </select>
                    @error('visibility')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- DESCRIPTION --}}
            <div class="row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{
                    __('description') }}</label>
                <div class="col-md-6">
                    <input type="text" name="description" id=""
                        class="form-control @error('description') is-invalid @enderror">
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>
        <div class="modal-buttons">
            <button id="modal-cancel" class="btn btn-danger">Cancel</button>
        </div>
    </div>
</div>