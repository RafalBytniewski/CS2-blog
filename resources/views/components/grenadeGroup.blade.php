
@vite(['resources/js/grenadeGroup.js'])
<style>
    /* Ukrycie modala domyślnie */
    .modal-overlay {
        color: black;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
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
        background: white;
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
        <h2 id="modal-title">Add to existing group</h2>
        <table class="mx-5" style="color:black">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Map</th>
                    <th>Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tr>
                <td><button>Mirage smokes from T spawn.</button></td>
                <td><span>Mirage</span></td>
                <td><span>10</span></td>
                <td><button id="modal-confirm" class="btn btn-primary">Add</button></td>
            </tr>
            <tr>
                <td><button>Dust smokes on long.</button></td>
                <td><span>Mirage</span></td>
                <td><span>4</span></td>
                <td><button id="modal-confirm" class="btn btn-primary">Add</button></td>
            </tr>
            <tr>
                <td><button>Anubis A execute.</button></td>
                <td><span>Anubis</span></td>
                <td><span>10</span></td>
                <td><button id="modal-confirm" class="btn btn-primary">Add</button></td>
            </tr>
            <tr>
                <td><button>Nuke Navi wall.</button></td>
                <td><span>Nuke</span></td>
                <td><span>3</span></td>
                <td><button id="modal-confirm" class="btn btn-primary">Add</button></td>
            </tr>
        </tr>
        </table>
        <h2>Make new grenade group</h2>
        <div class="addGroup d-flex flex-row my-3 justify-content-evenly">
            <label for="groupName">Group name:</label>
            <input style="width:30%"type="text" name="groupName" id="" class="form-control @error('groupName') is-invalid @enderror">
            <button class="btn btn-primary">Add</button>
        </div>
        <div class="modal-buttons">

            <button id="modal-confirm" class="btn btn-success">OK</button>
            <button id="modal-cancel" class="btn btn-danger">Cancel</button>
        </div>
    </div>
</div>
