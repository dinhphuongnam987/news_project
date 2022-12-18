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
                    <th class="column-title">Product Info</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Code</th>
                    <th class="column-title">Giá tiền gốc</th>
                    <th class="column-title">Giá tiền</th>
                    <th class="column-title">Số lượng</th>
                    <th class="column-title">Số lượng còn lại</th>
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
                            $description     = Hightlight::show($val['description'], $params['search'], 'description');
                            $thumb           = Template::showItemThumb($controllerName, $val['thumb'], $val['name']);
                            $quantity        = $val['quantity'];
                            $qty_remaining   = $val['quantity_remaining'];
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']); 
                            $code            = Hightlight::show($val['code'], $params['search'], 'code');
                            $original_price  = $val['original_price'];
                            $price           = $val['price'];
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="15%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Description:</strong> {!! $description !!}</p>
                            </td>
                            <td width="20%">
                                <p>{!! $thumb !!}</p>
                            </td>
                            <td>{!! $code !!}</td>
                            <td>{!! $original_price !!}</td>
                            <td>{!! $price !!}</td>
                            <td>{!! $quantity !!}</td>
                            <td>{!! $qty_remaining !!}</td>
                            <td>{!! $status !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
           