@extends('layouts.homepage')

@section('title', 'Homepage')

@section('main')

<main class="main">

    {{-- Hero Section --}}
    <section id="hero" class="hero section light-background">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Pengiriman Internasional <span>Sae Express</span></h1>
                    <p>Kirim barang dengan layanan yang cepat, aman, dan terpercaya.</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- /Hero Section --}}

    {{-- About Section --}}
    <section id="about" class="about section light-background">

        {{-- Section Title --}}
        <div class="container section-title">
            <h2>Tentang Kami</h2>
            <p><span>Kenali Lebih Dekat</span> <span class="description-title">SAE Express</span></p>
        </div>{{-- End Section Title --}}

        <div class="container">

            <div class="row gy-3">

                <div class="col-lg-6">
                    <img src="{{asset('assets/img/about.jpg')}}" alt="Tentang SAE Express" class="img-fluid" style="max-width: 500px">
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div class="about-content ps-0 ps-lg-3">
                        <h3>Pengiriman Barang Internasional Cepat dan Terpercaya</h3>
                        <p class="fst-italic">
                            SAE Express berdedikasi untuk menyediakan layanan pengiriman barang antar negara yang cepat, aman, dan hemat biaya.
                        </p>
                        <ul>
                            <li>
                                <i class="bi bi-globe"></i>
                                <div>
                                    <h4>Layanan Menyeluruh</h4>
                                    <p>Kami melayani pengiriman barang dari Indonesia ke Taiwan, Singapura, dan negara ASEAN lainnya dengan berbagai pilihan paket.</p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-shield-lock"></i>
                                <div>
                                    <h4>Keamanan Terjamin</h4>
                                    <p>Barang Anda diproses dengan standar keamanan tinggi untuk memastikan sampai tujuan dengan kondisi sempurna.</p>
                                </div>
                            </li>
                        </ul>
                        <p>
                            Dengan pengalaman bertahun-tahun, kami memahami kebutuhan Anda dalam pengiriman internasional. SAE Express selalu berkomitmen untuk memberikan layanan terbaik yang dapat diandalkan.
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </section>

    {{-- /About Section --}}

    {{-- Stats Section --}}
    <section id="stats" class="stats section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-emoji-heart-eyes" style="font-size: 40px; color: white;"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Klien Puas</p>
                    </div>
                </div>{{-- End Stats Item --}}

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-truck" style="font-size: 40px; color: white;"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Paket Dikirim</p>
                    </div>
                </div>{{-- End Stats Item --}}

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-headset" style="font-size: 40px; color: white;"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Jam Dukungan</p>
                    </div>
                </div>{{-- End Stats Item --}}

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-person-check" style="font-size: 40px; color: white;"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Tim Profesional</p>
                    </div>
                </div>{{-- End Stats Item --}}

            </div>

        </div>

    </section>
    {{-- /Stats Section --}}

    {{-- Services Section --}}
    <section id="services" class="services section">

        {{-- Section Title --}}
        <div class="container section-title">
            <h2>Services</h2>
            <p><span>Explore Our</span> <span class="description-title">Services</span></p>
        </div>{{-- End Section Title --}}

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="stretched-link">
                            <h3>Pengiriman Internasional</h3>
                        </div>
                        <p>Kami membantu pengiriman barang dari Indonesia ke berbagai negara seperti Taiwan, Singapura, dan negara ASEAN lainnya.</p>
                    </div>
                </div>{{-- End Service Item --}}

                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="stretched-link">
                            <h3>Pengemasan Aman</h3>
                        </div>
                        <p>Kami menyediakan layanan pengemasan yang aman dan tahan lama untuk memastikan barang tiba dengan selamat.</p>
                    </div>
                </div>{{-- End Service Item --}}

                <div class="col-lg-4 col-md-6" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="stretched-link">
                            <h3>Pengiriman Tepat Waktu</h3>
                        </div>
                        <p>Jaminan pengiriman tepat waktu sesuai dengan jadwal yang telah disepakati bersama.</p>
                    </div>
                </div>{{-- End Service Item --}}

                <div class="col-lg-4 col-md-6" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-map"></i>
                        </div>
                        <div class="stretched-link">
                            <h3>Tracking Real-Time</h3>
                        </div>
                        <p>Lacak posisi barang Anda secara real-time hingga tiba di tujuan akhir.</p>
                    </div>
                </div>{{-- End Service Item --}}

                <div class="col-lg-4 col-md-6" data-aos-delay="500">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="stretched-link">
                            <h3>Asuransi Barang</h3>
                        </div>
                        <p>Kami menyediakan opsi asuransi untuk memberikan perlindungan lebih pada barang kiriman Anda.</p>
                    </div>
                </div>{{-- End Service Item --}}

                <div class="col-lg-4 col-md-6" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <div class="stretched-link">
                            <h3>Layanan Pelanggan 24/7</h3>
                        </div>
                        <p>Tim kami siap membantu Anda kapan saja melalui layanan pelanggan yang tersedia 24/7.</p>
                    </div>
                </div>{{-- End Service Item --}}

            </div>

        </div>

    </section>
    {{-- /Services Section --}}

    {{-- Testimonials Section --}}
    <section id="testimonials" class="testimonials section dark-background">

        <img src="{{asset('assets/img/testimonials-bg.jpg')}}" class="testimonials-bg" alt="bg-testi">

        <div class="container">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        }
                    }
                </script>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <h3>Ahmad Faisal</h3>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Layanan yang diberikan sangat memuaskan. Semua proses berjalan dengan baik dan sesuai dengan ekspektasi saya.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>{{-- End testimonial item --}}

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <h3>Siti Aisyah</h3>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Saya sangat senang dengan hasil kerja tim ini. Proyek selesai tepat waktu dan hasilnya sangat memuaskan.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>{{-- End testimonial item --}}

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <h3>Indra Saputra</h3>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Pengalaman luar biasa! Layanan sangat profesional, dan hasilnya melebihi harapan saya.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>{{-- End testimonial item --}}

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <h3>Rina Wijayanti</h3>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Tim ini benar-benar memahami kebutuhan klien. Saya sangat merekomendasikan layanan mereka.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>{{-- End testimonial item --}}

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <h3>Budi Santoso</h3>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Sangat puas dengan hasil yang saya dapatkan. Layanan ini sangat direkomendasikan.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>{{-- End testimonial item --}}

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section>{{-- /Testimonials Section --}}

    {{-- Faq Section --}}
    <section id="faq" class="faq section light-background">

        {{-- Section Title --}}
        <div class="container section-title">
            <h2>F.A.Q</h2>
            <p><span>Frequently Asked</span> <span class="description-title">Questions</span></p>
        </div>{{-- End Section Title --}}

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="faq-container">

                        <div class="faq-item faq-active">
                            <h3>Bagaimana cara mengirimkan paket melalui Sae Express?</h3>
                            <div class="faq-content">
                                <p>Anda dapat mengirimkan paket melalui Sae Express dengan mengunjungi agen terdekat atau menggunakan layanan pickup di website kami. Pilih tujuan, ukuran paket, dan bayar sesuai tarif yang berlaku.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>{{-- End Faq item--}}

                        <div class="faq-item">
                            <h3>Berapa lama waktu pengiriman dengan Sae Express?</h3>
                            <div class="faq-content">
                                <p>Waktu pengiriman Sae Express bervariasi tergantung pada lokasi tujuan. Pengiriman domestik biasanya memakan waktu 2-4 hari, sedangkan pengiriman internasional bisa memakan waktu hingga 7 hari kerja.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>{{-- End Faq item--}}

                        <div class="faq-item">
                            <h3>Apakah Sae Express melayani pengiriman internasional?</h3>
                            <div class="faq-content">
                                <p>Ya, Sae Express melayani pengiriman internasional ke berbagai negara. Kami menawarkan berbagai pilihan layanan ekspres untuk memastikan paket Anda sampai tepat waktu.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>{{-- End Faq item--}}

                        <div class="faq-item">
                            <h3>Apakah Sae Express menyediakan layanan pelacakan paket?</h3>
                            <div class="faq-content">
                                <p>Ya, Sae Express menyediakan layanan pelacakan paket secara real-time. Anda dapat melacak status pengiriman dengan memasukkan nomor resi di halaman pelacakan kami di website.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>{{-- End Faq item--}}

                        <div class="faq-item">
                            <h3>Bagaimana cara mengajukan klaim jika paket saya rusak?</h3>
                            <div class="faq-content">
                                <p>Jika paket Anda rusak saat pengiriman, Anda dapat mengajukan klaim kepada Sae Express dengan mengisi formulir klaim di website kami atau menghubungi customer service kami untuk bantuan lebih lanjut.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>{{-- End Faq item--}}

                        <div class="faq-item">
                            <h3>Bagaimana cara bergabung menjadi agen Sae Express?</h3>
                            <div class="faq-content">
                                <p>Untuk bergabung menjadi agen Sae Express, silakan hubungi kami melalui halaman <a href="/#contact" class="text-white link-info"><u>Kontak Kami</u></a>. Tim kami akan dengan senang hati membantu Anda dengan informasi dan panduan pendaftaran.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                        {{-- End Faq item--}}

                    </div>

                </div>{{-- End Faq Column--}}

            </div>

        </div>

    </section>{{-- /Faq Section --}}

    {{-- Contact Section --}}
    <section id="contact" class="contact section">

        {{-- Section Title --}}
        <div class="container section-title">
            <h2>Contact</h2>
            <p><span>Need Help?</span> <span class="description-title">Contact Us</span></p>
        </div>{{-- End Section Title --}}

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-5">

                    <div class="info-wrap">
                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>Dusun Wanguk Lor Timur, RT 020
                                    RW 009
                                    Desa.Kadungwungu, Kec.Anjatan,
                                    Kab.Indramayu
                                    Prov. Jawa Barat - Indonesia 45256</p>
                            </div>
                        </div>{{-- End Info Item --}}

                        <div class="info-item d-flex" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+62 812-2273-1612</p>
                            </div>
                        </div>{{-- End Info Item --}}

                        <div class="info-item d-flex" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>sae.express.wanguk@gmail.com</p>
                            </div>
                        </div>{{-- End Info Item --}}

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.9691221667085!2d107.96169807021121!3d-6.397980648389021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e694a3c9be063d3%3A0x2b67b99d09ce4a97!2sJl.%20Raya%20Wanguk%20Lor%2C%20Kedungwungu%2C%20Kec.%20Anjatan%2C%20Kabupaten%20Indramayu%2C%20Jawa%20Barat%2045256!5e0!3m2!1sid!2sid!4v1737047509786!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                {{-- contact --}}
                <div class="col-lg-7">
                    <form id="email-form" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <label for="name-field" class="pb-2">Your Name</label>
                                <input type="text" name="name" id="name-field" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email-field" class="pb-2">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email-field" required>
                            </div>

                            <div class="col-md-12">
                                <label for="subject-field" class="pb-2">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject-field" required>
                            </div>

                            <div class="col-md-12">
                                <label for="message-field" class="pb-2">Message</label>
                                <textarea class="form-control" name="message" rows="10" id="message-field" required></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="button" id="send-email">Send Message</button>
                            </div>

                            <script>
                                document.getElementById('send-email').addEventListener('click', function() {
                                    const name = encodeURIComponent(document.getElementById('name-field').value);
                                    const email = encodeURIComponent(document.getElementById('email-field').value);
                                    const subject = encodeURIComponent(document.getElementById('subject-field').value);
                                    const message = encodeURIComponent(document.getElementById('message-field').value);

                                    const mailtoLink = `mailto:sae.express.wanguk@gmail.com?subject=${subject}&body=Name: ${name}%0AEmail: ${email}%0A%0A${message}`;
                                    window.location.href = mailtoLink;
                                });
                            </script>

                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>{{-- /Contact Section --}}

</main>
@endsection