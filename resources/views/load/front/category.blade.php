<div class="tab-pane {{ $view == 'grid' ? 'active' : '' }}" id="grid-view">
    <div class="row mt-2">
        @foreach ($products as $product)
            <div class="col-xl-3 col-md-4 col-6 mb-20 sm-mb-15 {{ $loop->even ? 'sm-pl' : 'sm-pr' }}">
                @include('common.product.style1')
            </div>
        @endforeach
    </div>

</div>
<div class="tab-pane show {{ $view == 'list' ? 'active' : '' }}" id="list-view">
     <div class="d-flex flex-wrap">
        @foreach ($products as $product)
            @include('common.product.style2')
        @endforeach
    </div>
</div>
<div class="row mb-30 sm-mt-20">
    <div class="col-sm-4 col-12 mb-3 mb-sm-0 text-center text-sm-left">
        @if ($products->total() > 0)
            <span class="mb-0 mt-2 pagination-title">
                Showing
                {{ ($products->currentpage() - 1) * $products->perpage() + 1 }}
                to
                {{ ($products->currentpage() - 1) * $products->perpage() + $products->count() }} of
                {{ $products->total() }} entries
            </span>
        @else
            <span class="mb-0 mt-2 pagination-title">
                No Product Found
            </span>
        @endif
    </div>
    <div class="col-sm-8 col-12">
        <div class="float-sm-right">{!! $products->onEachSide(1)->links() !!}</div>
    </div>
</div>
