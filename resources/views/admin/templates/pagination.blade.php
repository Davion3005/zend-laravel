@php
    $totalItems = $items->total();
    $totalPages = $items->lastPage();
    $itemPerPage = $items->perPage();

@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Phân trang'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6">
                        <p class="m-b-0">Số phần tử trên 1 trang: <b>{{ $itemPerPage }}</b><br> <span
                                class="label label-success label-pagination">Tổng số trang: {{ $totalPages }}</span></p>
                        <p class="m-b-0">Tổng số phần từ: {{ $totalItems }}</p>
                    </div>

                    <div class="col-md-6">
                        {{ $items->links('pagination.pagination_backend') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
