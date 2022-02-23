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
    <ul class="pagination " style="justify-content: center;">
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

        <!-- first/previous -->
        <li style="padding-right: 25px;">
            <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="ย้อนกลับ"
                class="btn btn-purple btn-radin text-white previous_url">
                <span aria-hidden="true"><i class="fas fa-arrow-alt-circle-left"></i> ย้อนกลับ</span>
            </a>
        </li>
        <!-- links -->
        @for ($i = $from; $i <= $to; $i++)
            <?php
            $isCurrentPage = $paginator->currentPage() == $i;
            ?>
            <li class="number_paginate">
                <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}"
                    class=" btn btn-radin  number {{ $isCurrentPage ? 'active' : '' }}">
                    {{ $i }}
                </a>
            </li>
        @endfor

        <!-- next/last -->
        <li style="padding-left: 25px;">
            <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="ถัดไป"
                class="btn btn-radin btn-purple text-white  next">
                <span aria-hidden="true"> ถัดไป <i class="fas fa-arrow-alt-circle-right"></i></span>
            </a>
        </li>

    </ul>

@endif
