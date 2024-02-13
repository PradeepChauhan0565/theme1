<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Subscribers</h3>

                    <div class="card-tools ">
                        <div class="input-group input-group-sm" style="width: 270px;">
                            <input wire:model="search" type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>

                            </div>
                            <a href="{{ asset('subscribers-excle') }}" title="download" class="  px-4 ">
                                <i class="fas fa-download"></i>

                            </a>
                        </div>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="p-3">Sr NO.</th>
                                <th class="p-3">Emails</th>
                                <th class="p-3">Subscribe/Unsubscribe</th>
                                <th class="p-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Subscribers as $item)
                                <tr>
                                    <td class="p-2 border">
                                        {{ ($Subscribers->currentpage() - 1) * $Subscribers->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td class="p-2 border">{{ $item->email }}</td>
                                    <td class="p-2 border">{{ $item->status }}</td>
                                    <td class="p-2 border">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y h:i a') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
            {{ $Subscribers->links() }}
        </div>
    </div>


</div>
