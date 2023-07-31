<div>


    <div class="row">

        <div class="col-4">
            <button class="btn btn-sm float-end btn-success"
            wire:click="export('xlsx')"
            wire:loading.attr="disabled"
            >excel</button>
        </div>
    </div>


    <table class="table" wire:loading.class.delay="text-muted" >
        <thead>
        <tr>
            <th wire:click="sortBy('name')" style="cursor: pointer;">name</th>
            <th wire:click="sortBy('email')" style="cursor: pointer;">email</th>
            <th wire:click="sortBy('created_at')" style="cursor: pointer;">created_at</th>
        </tr>
        </thead>

        <tbody>
            <tr>
                <td><input wire:model.debounce.500ms="name" placeholder="Search Names..." class="form-control" type="text"></td>
                <td><input wire:model.debounce.500ms="email" placeholder="Search Emails..." class="form-control" type="text"></td>
                <td><input wire:model.debounce.500ms="created_at" placeholder="Search Created At..." class="form-control" type="text"></td>

            </tr>

                @forelse ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4" class="pt-4 border-0">
                            <div class="text-center">
                                <span class="text-muted">No Users Found...</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</div>
