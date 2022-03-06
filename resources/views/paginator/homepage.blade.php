<style>
    ul.pagination .btn.btn-purple.btn-radin {
        border-radius: 15px !important;
    }

    ul.pagination .btn.btn-purple.btn-radin:hover {
        background: #6f4491 !important;
        border-color: #6f4491 !important;
    }

    ul.pagination .btn.btn-radin {
        border-radius: 15px !important;
    }

    ul.pagination .btn.btn-purple {
        background: #a364d3 !important;
        border-color: #a364d3 !important;
        color: white !important;
    }

    ul.pagination a.btn-radin:hover {
        background: #bbc2ca !important;
        border-color: #bbc2ca !important;
        color: white;
    }

    ul.pagination a.active {
        background: #a364d3 !important;
        border-color: #a364d3 !important;
        color: white !important;
    }

    ul.pagination a.active:hover {
        background: #6f4491 !important;
        border-color: #6f4491 !important;
        color: white !important;
    }

</style>

@if (isset($paginator) && $paginator->lastPage() > 1)
    <?php
    $interval = isset($interval) ? abs(intval($interval)) : 3;
    $from = $paginator->currentPage() - $interval;
    if ($from < 1) {
        $from = 1;
    }

    $to = $paginator->currentPage() + $interval;
    if ($to > $paginator->lastPage()) {
        $to = $paginator->lastPage();
    }
    ?>

    <div class="row">
        @if ($paginator->onFirstPage())
            <div class="col-md-6">
            </div>
        @else
            <div class="col-md-6">
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-primary ">
                    <i class="fas fa-hand-point-left me-2"></i>อ่านข่าวก่อนหน้านี้
                </a>
            </div>
        @endif


        @if ($paginator->hasMorePages())
            <div class="col-md-6">
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="btn btn-primary "
                    style="float:right;">
                    <i class="fas fa-hand-point-right me-2"></i>อ่านข่าวถัดไป
                </a>
            </div>
        @else
            <div class="col-md-6">
            </div>
        @endif

    </div>

    <!-- next/last -->


@endif
