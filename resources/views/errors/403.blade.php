@extends("master.master")
@section('body')
    <style>
        .disabled {
            pointer-events: none;
            cursor: default;
        }

        #blog {
            padding-top: 115px;
            margin-bottom: 104px !important;

        }

    </style>
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('homepage') }}">หน้าแรก</a></li>
                    <li><a href="#">คุณไม่มีตำแหน่งในการเข้าใช้งาน กรุณากลับหน้าหลักด้วยครับ</a></li>
                </ol>

            </div>
        </section>
        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog mt-auto mb-auto">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1> คุณไม่มีตำแหน่งในการเข้าใช้งาน กรุณากลับหน้าหลักด้วยครับ</h1>
                        <a href="{{ route('homepage') }}" class="btn btn-danger btn-lg"><i
                                class="fas fa-home me-2"></i>หน้าแรก</a>
                    </div>
                </div>
            </div>
        </section><!-- End Blog Single Section -->
    </main>
@endsection
@section('addjava')
@endsection
