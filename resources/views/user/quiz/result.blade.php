<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spirit Anda - {{ $resultSpirit->spirit ?? 'Tidak Ditemukan' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        /* Global Reset & Font */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        /* Body Background & Color (Dynamic) */
        body {
            background-color: {{ $resultSpirit->warna ?? '#FFE6AA' }}; /* Menggunakan warna dari data spirit */
            color: #000; /* Warna teks default hitam */
            padding: 40px;
            position: relative;
            min-height: 100vh; /* Pastikan tinggi penuh */
            overflow: hidden; /* Sembunyikan scrollbar jika tidak diperlukan */
            display: flex; /* Menggunakan flexbox untuk layout keseluruhan */
            flex-direction: column;
            justify-content: space-between;
        }

        /* Header Section (Logo & User Tag) */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 30px;
            font-weight: bold;
        }

        .logo-section img {
            height: 80px; /* Ukuran gambar logo sesuai gambar RAKUN */
        }

        .user-tag {
            border: 2px solid #000;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Main Content Layout */
        .main-content {
            flex-grow: 1;
            display: flex;
            justify-content: space-between; /* Menjaga jarak antar elemen */
            align-items: flex-end; /* Pusatkan ke bawah untuk gambar animal */
            position: relative;
            z-index: 1;
            flex-direction: row;
            max-width: 1300px; /* Lebar lebih luas untuk menampung gambar */
            margin: 0 auto;
            margin-top: -30px;
            padding-bottom: 50px; /* Ruang di bawah gambar animal */
        }

        /* Text Section (Left Column) */
        .text-section {
            max-width: 450px;
            position: relative;
            z-index: 3;
            order: 1;
            text-align: left;
            padding-bottom: 150px; /* Memberi ruang di bawah teks agar gambar animal tidak terlalu tumpang tindih */
        }

        .spirit-heading {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .spirit-name {
            font-weight: bold;
            font-size: 25px;
            margin-bottom: 15px;
        }

        .spirit-desc {
            font-size: 16px;
            line-height: 1.5;
            position: relative;
            z-index: 2;
        }

        /* Icon Row (Logo & Element) */
        .icon-row {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            position: relative;
            z-index: 2;
        }

        .icon-box {
            display: flex;
            border: 2px solid #000;
            border-radius: 4px;
            overflow: hidden;
            width: fit-content;
        }

        .icon-box-item {
            padding: 10px;
            border-right: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: {{ $resultSpirit->warna ?? '#F8C16F' }}; /* Warna sesuai input spirit */
        }

        .icon-box-item:last-child {
            border-right: none;
        }

        .icon-box-item img {
            height: 40px;
            width: 40px;
        }

        /* Animal Image (Right Column) */
        .animal-img {
            height: 700px; /* Ukuran gambar animal 3D lebih besar */
            position: relative;
            z-index: 2;
            left: -20px; /* Geser ke kiri sesuai gambar RAKUN */
            bottom: 120px; /* Angkat sedikit dari bawah main-content */
            object-fit: contain;
            flex-shrink: 0;
            order: 2;
            pointer-events: none;
        }

        /* Arrow Indicator (Fixed Position) */
        .arrow-indicator {
            position: absolute;
            top: 50%;
            right: 40px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 3;
            pointer-events: none;
        }

        .arrow-line {
            height: 120px;
            width: 2px;
            background: #000;
            margin: 5px 0;
        }

        .arrow-dot {
            width: 8px;
            height: 8px;
            background: #000;
            border-radius: 50%;
            margin: 5px 0;
        }

        .spirit-letter {
            font-size: 100px;
            font-weight: 900;
            text-transform: uppercase;
            color: black;
            line-height: 1;
        }

        /* Footer & Share */
        .footer-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            width: 100%;
            padding-top: 20px;
        }

        .footer {
            font-size: 12px;
            z-index: 3;
        }

        .share-text {
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            z-index: 3;
        }

        .share-text img {
            height: 16px;
        }

        /* Background Title (Large Text) */
        .background-title {
            position: absolute;
            top: 200px; /* Posisi lebih sesuai gambar RAKUN */
            left: 50px; /* Posisi lebih sesuai gambar RAKUN */
            font-size: 230px;
            font-weight: 900;
            color: #000; /* Warna hitam solid */
            /* Outline dihilangkan sesuai gambar RAKUN */
            z-index: 1;
            white-space: nowrap;
            pointer-events: none;
            line-height: 1;
        }

        /* Responsive Media Queries */
        @media screen and (max-width: 992px) {
            body {
                padding: 20px;
                flex-direction: column;
            }
            .header-section {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 10px;
            }
            .user-tag {
                position: static;
                margin-top: 10px;
            }
            .main-content {
                flex-direction: column;
                align-items: center;
                margin-top: 0;
                padding-bottom: 20px;
            }
            .text-section {
                max-width: 90%;
                text-align: center;
                order: 2;
                margin-top: 20px;
                padding-bottom: 0; /* Hapus padding bottom di mobile */
            }
            .animal-img {
                height: 300px; /* Lebih kecil di mobile */
                left: 0;
                bottom: 0;
                margin-top: 20px;
                margin-bottom: 0;
                order: 1;
            }
            .background-title {
                font-size: 80px; /* Lebih kecil di mobile */
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                white-space: normal;
                text-align: center;
                opacity: 0.5;
                width: 100%;
                -webkit-text-stroke: none; /* Hapus outline di mobile jika tidak cocok */
                text-stroke: none;
            }
            .spirit-heading {
                margin-bottom: 5px;
            }
            .spirit-name {
                margin-bottom: 10px;
            }
            .spirit-desc {
                font-size: 14px;
                margin-top: 10px;
            }
            .icon-row {
                justify-content: center;
                margin-top: 15px;
            }
            .arrow-indicator {
                display: none;
            }
            .footer-section {
                flex-direction: column;
                align-items: center;
                margin-top: 20px;
            }
            .share-text {
                margin-top: 15px;
            }
        }

        @media screen and (max-width: 576px) {
            body {
                padding: 15px;
            }
            .logo-section {
                font-size: 24px;
            }
            .logo-section img {
                height: 45px;
            }
            .user-tag {
                font-size: 11px;
            }
            .animal-img {
                height: 250px;
            }
            .background-title {
                font-size: 50px;
            }
            .spirit-heading {
                font-size: 16px;
            }
            .spirit-name {
                font-size: 18px;
            }
            .spirit-desc {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    @if ($resultSpirit)
        {{-- HEADER SECTION --}}
        <div class="header-section">
            <div class="logo-section">
                {{-- Logo SPYNA (static asset from Storage/images/Vectorhitam.png) --}}
                <img src="{{ asset('storage/images/Vectorhitam.png') }}" alt="Logo SPYNA" />
                SPYNA
            </div>

            <div class="user-tag">
                {{-- User Icon (static asset from Storage/images/user.png) --}}
                <img src="{{ asset('storage/images/user.png') }}" alt="User" style="height: 16px;" />
                {{ Auth::user()->name ?? 'Pengguna' }}
            </div>
        </div>

        <div class="spirit-heading">Spirit anda adalah...</div>
        <div class="background-title">{{ $resultSpirit->spirit ?? 'SPIRIT' }}</div>
        
        {{-- MAIN CONTENT SECTION --}}
        <div class="main-content">
            <div class="text-section">
                <div class="spirit-name">{{ $resultSpirit->spirit ?? 'Spirit' }} – {{ $resultSpirit->julukan ?? 'Julukan' }}</div>
                <div class="spirit-desc">
                    {{ $resultSpirit->deskripsi ?? 'Deskripsi spirit Anda akan muncul di sini.' }}
                </div>
                <div class="icon-row">
                    {{-- Gambar Logo Spirit (dynamic from Storage) --}}
                    @if ($resultSpirit->gambar_logo)
                    <div class="icon-box-item">
                        <img src="{{ Storage::url($resultSpirit->gambar_logo) }}" alt="{{ $resultSpirit->spirit }} Logo" />
                    </div>
                    @endif
                    {{-- Gambar Elemen (dynamic from Storage) --}}
                    @if ($resultSpirit->gambar_elemen)
                    <div class="icon-box-item">
                        <img src="{{ Storage::url($resultSpirit->gambar_elemen) }}" alt="{{ $resultSpirit->spirit }} Element" />
                    </div>
                    @endif
                </div>
            </div>
            {{-- Gambar Animal 3D (dynamic from Storage) --}}
            @if ($resultSpirit->gambar_animal)
            <img class="animal-img" src="{{ Storage::url($resultSpirit->gambar_animal) }}" alt="{{ $resultSpirit->spirit }}" />
            @else
            {{-- Placeholder jika gambar animal tidak ada, pakai asset untuk fallback statis --}}
            <img class="animal-img" src="{{ asset('img/default_animal.png') }}" alt="Default Animal" />
            @endif
        </div>

        {{-- ARROW INDICATOR --}}
        <div class="arrow-indicator">
            <div class="arrow-line"></div>
            <div class="arrow-dot"></div>
            <div class="arrow-line"></div>
            <div class="spirit-letter">
                {{ substr($resultSpirit->code ?? 'A', 0, 1) }}
            </div>
        </div>

        {{-- FOOTER SECTION --}}
        <div class="footer-section">
            <div class="footer">@All Right Reserved by <strong>SPYNA.Pro</strong></div>

            <div class="share-text">
                Bagikan Sekarang →
                {{-- Share Icon (static asset from Storage/images/Shareicon.png) --}}
                <img src="{{ asset('storage/images/Shareicon.png') }}" alt="Share" />
            </div>
        </div>
    @else
        {{-- Tampilan jika tidak ada hasil spirit --}}
        <div style="text-align: center; margin-top: 100px; color: black;">
            <h1 style="font-size: 36px; margin-bottom: 20px;">Hasil Tidak Ditemukan.</h1>
            <p style="font-size: 18px;">Maaf, kami tidak dapat menemukan Spirit Animal untuk Anda. Silakan coba kuis lagi.</p>
            <a href="{{ route('user.quiz.show') }}" style="display: inline-block; margin-top: 30px; padding: 15px 30px; background-color: #007bff; color: white; text-decoration: none; border-radius: 8px;">Mulai Ulang Kuis</a>
        </div>
    @endif
</body>
</html>