@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Judul halaman diperbesar dan diberi center -->
        <h1 class="mb-4 text-center fw-bold">Blog Terbaru</h1> {{-- Tambahkan text-center & fw-bold agar lebih menonjol --}}

        <div class="row g-4">
            @foreach ($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <!-- Card dengan efek hover dan border lembut -->
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden"> {{-- rounded-4 & overflow-hidden agar sudut membulat --}}
                        
                        <!-- Gambar diberi fixed height dan object-fit agar proporsional -->
                        <img src="{{ $post->image }}" 
                             class="card-img-top" 
                             alt="Post Image" 
                             style="height: 220px; object-fit: cover;"> {{-- object-fit untuk menjaga proporsi gambar --}}
                        
                        <div class="card-body d-flex flex-column">
                            <!-- Judul diberi limit tinggi supaya rapi -->
                            <h5 class="card-title fw-semibold" style="min-height: 50px;">{{ $post->title }}</h5> {{-- fw-semibold untuk ketebalan sedang --}}
                            
                            <!-- Informasi penulis & tanggal -->
                            <p class="text-muted mb-2 small">
                                <i class="bi bi-calendar-event"></i> {{-- icon kalender (Bootstrap Icons) --}}
                                {{ $post->created_at->format('d F Y') }} • 
                                <i class="bi bi-person"></i> {{-- icon user --}}
                                {{ $post->creator?->name }}
                            </p>

                            <!-- Konten ringkas -->
                            <p class="card-text flex-grow-1">
                                {{ $post->contentLimit }}
                            </p>

                            <!-- Tombol baca selengkapnya diberi full width -->
                            <a href="{{ route('post.show', $post->id) }}" 
                               class="btn btn-primary btn-sm w-100 mt-auto">Baca Selengkapnya</a> {{-- w-100 agar tombol memenuhi lebar card --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination di tengah -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection