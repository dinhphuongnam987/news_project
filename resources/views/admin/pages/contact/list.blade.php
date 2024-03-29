@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Email</th>
                    <th class="column-title">Phone</th>
                    <th class="column-title">Lời nhắn</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $email           = Hightlight::show($val['email'], $params['search'], 'email');
                            $phone           = Hightlight::show($val['phone'], $params['search'], 'phone');
                            $message         = Hightlight::show($val['message'], $params['search'], 'message');
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td >{{ $name }}</td>
                            <td >{{ $email }}</td>
                            <td >{{ $phone }}</td>
                            <td >{{ $message }}</td>
                            <td>{!! $status !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 9])
                @endif
            </tbody>
        </table>
    </div>
</div>
           