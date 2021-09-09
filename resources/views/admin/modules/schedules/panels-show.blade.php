<div id="tab1" class="tab-pane fade show active">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>
                                            {{ trans('validation.attributes.name') }}
                                        </th>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('validation.attributes.email') }}
                                        </th>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('validation.attributes.phone_s') }}
                                        </th>
                                        <td>
                                            <ul>
                                                <li>{{ $item->phone }}</li>
                                                @foreach( $phones as $phone )
                                                    <li>{{ $phone->phone }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('validation.attributes.address') }}
                                        </th>
                                        <td>
                                            {{ $item->address }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
