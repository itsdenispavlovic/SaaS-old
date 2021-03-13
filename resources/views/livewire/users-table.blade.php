<div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="">Search:</label>
                <input type="text" wire:model="search" placeholder="Search" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="">Per page:</label>
                <select wire:model="perRow" id="" class="form-control">
                    @for($i = 5; $i < 25; $i = $i + 5)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="">Column:</label>
                <select wire:model="orderBy" id="" class="form-control">
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="email">Email</option>
                    <option value="type">Type</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="">Direction:</label>
                <select wire:model="direction" id="" class="form-control">
                    <option value="asc">Asc</option>
                    <option value="desc">Desc</option>
                </select>
            </div>
        </div>
    </div>

    @include('admin.users.table')

    {!! $users->links() !!}
</div>

