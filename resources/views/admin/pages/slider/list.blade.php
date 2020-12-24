@php
    use App\Helpers\Template;
@endphp

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Slider Info</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @if(count($items) > 0)
                @foreach($items as $key => $value)
                    @php
                        $index          = $key + 1;
                        $class          = ($index % 2 == 0) ? 'even' : 'odd';
                        $id             = $value['id'];
                        $name           = $value['name'];
                        $description    = $value['description'];
                        $link           = $value['link'];
                        $thumb          = $value['thumb'];
                        $status         = $value['status'];
                        $created        = $value['created'];
                        $created_by     = $value['created_by'];
                        $modified       = $value['modified'];
                        $modified_by    = $value['modified_by'];
                        $createdHistory     = Template::showItemHistory($created_by, $created);
                        $modifiedHistory    = Template::showItemHistory($created_by, $created);
                        $itemStatus         = Template::showItemStatus($controllerName, $id, $status);
                        $itemThumb          = Template::showItemThumb($controllerName, $thumb, $name);
                        $listButtonAction   = Template::showButtonAction($controllerName, $id);
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td>{{ $index }}</td>
                        <td width="40%">
                            <p><strong>Name:</strong> {{ $name }}</p>
                            <p><strong>Description:</strong> {{ $description }}</p>
                            <p><strong>Link:</strong> {{ $link }} </p>
                            <p> {!! $itemThumb !!} </p>
                        </td>
                        <td> {!! $itemStatus !!} </td>
                        <td>{!! $createdHistory !!}</td>
                        <td>{!! $modifiedHistory !!}</td>
                        <td class="last">
                            <div class="zvn-box-btn-filter">{!! $listButtonAction !!}</div>
                        </td>
                    </tr>
                @endforeach
            @else
                @include('admin.templates.list_empty', ['colspan' => 6])
            @endif
            </tbody>
        </table>
    </div>
</div>
