<?php include '../../layout.php'; ?>

<?php
$jenjang = $_GET['jenjang'] ?? null;

$sekolah = [
    'SMK' => [
        [
            'nama' => 'SMK Antartika 1 Sidoarjo',
            'alamat' => 'Jl. Raya Sidoarjo No.1, Sidoarjo, Jawa Timur',
            'telp' => '031-1234567',
            'deskripsi' => 'SMK Antartika 1 Sidoarjo berlokasi di pusat kota Sidoarjo.',
            'gambar' => 'https://radarjatim.id/wp-content/uploads/2024/07/WhatsApp-Image-2024-07-15-at-10.48.34.jpeg'
        ],
        [
            'nama' => 'SMK Antartika 2 Sidoarjo',
            'alamat' => 'Jl. Diponegoro No.10, Sidoarjo, Jawa Timur',
            'telp' => '031-7654321',
            'deskripsi' => 'SMK Antartika 2 Sidoarjo fokus pada pengembangan teknologi dan bisnis.',
            'gambar' => 'https://smkantartika2-sda.sch.id/wp-content/uploads/2025/03/image-392x272.png'
        ]
    ],
    'SMA' => [
        [
            'nama' => 'SMA Antartika Sidoarjo',
            'alamat' => 'Jl. Pahlawan No.5, Sidoarjo',
            'telp' => '031-9876543',
            'deskripsi' => 'SMA Antartika Sidoarjo unggul di bidang akademik dan non-akademik.',
            'gambar' => 'https://smaantarda.sch.id/wp-content/uploads/2024/08/2023-07-06.jpg'
        ],
        [
            'nama' => 'SMA Antartika Surabaya',
            'alamat' => 'Jl. Ahmad Yani No.99, Surabaya',
            'telp' => '031-111222',
            'deskripsi' => 'SMA Antartika Surabaya terkenal dengan program internasional.',
            'gambar' => 'https://lh5.googleusercontent.com/p/AF1QipO_bti3gDPnkOoUYW3HMx4vd-b0eUG3xsYziwlD=w408-h306-k-no'
        ]
    ],
    'SMP' => [
        [
            'nama' => 'SMP Antartika Surabaya',
            'alamat' => 'Jl. Mayjen Sungkono No.8, Surabaya',
            'telp' => '031-333444',
            'deskripsi' => 'SMP Antartika Surabaya memberikan pendidikan berbasis karakter.',
            'gambar' => 'https://lh5.googleusercontent.com/p/AF1QipMG4mLzz5CvVLRjgxkdhv01ETYT1WRoQ0eCHUbh=w203-h360-k-no'
        ]
    ]
];

$kodeLemdik = [
    'SMK Antartika 1 Sidoarjo' => 1,
    'SMK Antartika 2 Sidoarjo' => 2,
    'SMA Antartika Sidoarjo'   => 3,
    'SMA Antartika Surabaya'   => 4,
    'SMP Antartika Surabaya'   => 5
];

$listSekolah = $jenjang && isset($sekolah[$jenjang]) ? $sekolah[$jenjang] : [];
?>
<style>
    .stroke {
        -webkit-text-stroke: 1px #d1d1d1ff;
    }
</style>

<section class="w-full min-h-screen flex flex-col bg-blue-900 px-4 py-10 md:px-20">

    <div class="w-full flex-1 rounded-lg shadow-lg bg-white flex flex-col items-center justify-center font-[poppins] p-6 md:p-12 lg:p-16">

        <!-- Header -->
        <div class="h-fit w-full mb-6 flex flex-wrap items-center">
            <div class="flex justify-center items-center">
                <a href="./jenjang.php" class="p-2 rounded-lg bg-neutral-100 transition-all hover:bg-neutral-200">
                    <i class="fa-solid fa-caret-left"></i>
                </a>
            </div>
        </div>

        <div class="w-full flex-1 flex-inline lg:flex flex-wrap gap-4 justify-center">

            <div class="flex-1 bg-white p-5 rounded-lg flex flex-col items-center gap-2 font-[roboto]">

                <img src="../../public/images/favicon (1).png" class="w-20 shadow-md p-2 rounded-lg " alt="">
                <h1 class="text-3xl font-bold text-neutral-700">Satu Langkah Lagi..</h1>
                <p class="text-sm text-neutral-400 text-center">Isilah data-data di bawah ini untuk melakukan pendaftaran akun terlebih dahulu ya! ✏️</p>

                <div class="w-full max-w-2xl">
                    <!-- FORM -->
                    <form x-data="multiStepForm()" x-ref="form"
                        @submit.prevent="handleSubmit()"
                        action="process_signup.php" method="post"
                        class="w-full flex flex-col gap-4">

                        <!-- STEP 1 -->
                        <div x-show="step === 1" x-transition class="flex flex-col gap-2">
                            <!-- Email -->
                            <div>
                                <p class="text-neutral-400 text-sm">Email</p>
                                <div class="flex items-center border border-neutral-400 rounded-lg overflow-hidden">
                                    <i class="fa-solid fa-envelope p-2 h-full border-r border-neutral-400 text-neutral-400"></i>
                                    <input type="email" name="email" x-model="formData.email" class="flex-1 px-3 py-2 outline-none text-sm" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div>
                                <p class="text-neutral-400 text-sm">Password</p>
                                <div class="flex items-center border border-neutral-400 rounded-lg overflow-hidden">
                                    <i class="fa-solid fa-key p-2 h-full border-r border-neutral-400 text-neutral-400"></i>
                                    <input :type="show ? 'text' : 'password'"
                                        x-model="password"
                                        class="flex-1 px-3 py-2 outline-none text-sm" required>
                                    <button type="button" @click="show = !show" class="px-3 text-neutral-500 hover:text-neutral-700">
                                        <i :class="show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                                    </button>
                                </div>

                                <!-- Rules -->
                                <div x-show="password.length > 0" class="p-3 border border-neutral-400 rounded-lg bg-[#f9f9f9] text-sm mb-2" x-transition>
                                    <p class="text-neutral-400 mb-2 font-semibold">Ketentuan Kata Sandi:</p>
                                    <ul class="space-y-2 text-neutral-400 list-disc">
                                        <li class="flex items-center justify-between">
                                            <span>Minimal 8 karakter dan maksimal 16 karakter</span>
                                            <i :class="lengthValid ? 'fa-solid fa-check text-green-600' : 'fa-solid fa-times text-red-500'"></i>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <span>Gabungan huruf besar dan kecil</span>
                                            <i :class="caseValid ? 'fa-solid fa-check text-green-600' : 'fa-solid fa-times text-red-500'"></i>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <span>Minimal satu angka</span>
                                            <i :class="numberValid ? 'fa-solid fa-check text-green-600' : 'fa-solid fa-times text-red-500'"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <p class="text-neutral-400 text-sm">Konfirmasi Password</p>
                                <div class="flex items-center border rounded-lg overflow-hidden relative"
                                    :class="confirm && confirm !== password ? 'border-red-500' : 'border-neutral-400'">
                                    <i class="fa-solid fa-key p-2 h-full border-r border-neutral-400 text-neutral-400"></i>
                                    <input :type="showConfirm ? 'text' : 'password'"
                                        x-model="confirm"
                                        class="flex-1 px-3 py-2 outline-none text-sm">
                                    <button type="button" @click="showConfirm = !showConfirm" class="px-3 text-neutral-500 hover:text-neutral-700">
                                        <i :class="showConfirm ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                                    </button>
                                    <i x-show="confirm && confirm !== password" class="fa-solid fa-triangle-exclamation text-red-500 absolute right-10"></i>
                                </div>
                            </div>

                            <!-- Tombol Lanjut -->
                            <button type="button"
                                @click="goNext"
                                :disabled="!isValid"
                                class="w-full bg-[#4f5686] mt-4 hover:bg-[#41466e] text-white py-2 rounded-lg font-medium transition disabled:opacity-50 disabled:cursor-not-allowed">
                                Lanjut
                            </button>
                        </div>

                        <!-- STEP 2 -->
                        <div x-show="step === 2" x-transition class="space-y-4">
                            <!-- Nama Lengkap -->
                            <div>
                                <p class="text-neutral-400 text-sm">Nama Lengkap Calon Siswa</p>
                                <div class="flex items-center border border-neutral-400 rounded-lg overflow-hidden">
                                    <i class="fa-solid fa-user p-2 h-full border-r border-neutral-400 text-neutral-400"></i>
                                    <input type="text" name="nama" x-model="formData.nama"
                                        class="flex-1 px-3 py-2 outline-none text-sm" required>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <p class="text-neutral-400 text-sm">Tanggal Lahir Calon Siswa</p>
                                <div class="flex items-center border border-neutral-400 rounded-lg overflow-hidden">
                                    <i class="fa-solid fa-calendar-days p-2 h-full border-r border-neutral-400 text-neutral-400"></i>
                                    <input type="date" name="tanggal_lahir" x-model="formData.tanggal_lahir"
                                        class="flex-1 px-3 py-2 outline-none text-sm" required>
                                </div>
                            </div>

                            <!-- Nomor WhatsApp -->
                            <!-- Nomor WhatsApp -->
                            <div>
                                <p class="text-neutral-400 text-sm">Nomor WhatsApp Ortu/Wali</p>
                                <div class="flex items-center border border-neutral-400 rounded-lg overflow-hidden">
                                    <!-- Dropdown Bendera -->
                                    <select x-model="waCode" @change="updateWA"
                                        class="px-2 py-2 border-r bg-gray-50 text-lg outline-none cursor-pointer">
                                        <option value="+62">🇮🇩</option>
                                        <option value="+60">🇲🇾</option>
                                        <option value="+65">🇸🇬</option>
                                        <option value="+91">🇮🇳</option>
                                        <option value="+1">🇺🇸</option>
                                        <option value="+44">🇬🇧</option>
                                        <option value="+81">🇯🇵</option>
                                        <option value="+82">🇰🇷</option>
                                    </select>

                                    <!-- Kode Negara -->
                                    <span class="px-3 py-2 border-r text-sm text-neutral-600 bg-gray-50"
                                        x-text="waCode"></span>

                                    <!-- Input Nomor -->
                                    <input type="text"
                                        class="flex-1 px-3 py-2 text-sm outline-none"
                                        x-model="waNumber"
                                        @input="updateWA"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                </div>
                            </div>



                            <!-- NIK -->
                            <div>
                                <p class="text-neutral-400 text-sm">NIK Calon Siswa</p>
                                <div class="flex items-center border border-neutral-400 rounded-lg overflow-hidden">
                                    <i class="fa-solid fa-id-card p-2 h-full border-r border-neutral-400 text-neutral-400"></i>
                                    <input type="text" name="nik" x-model="formData.nik"
                                        class="flex-1 px-3 py-2 outline-none text-sm"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                </div>
                            </div>

                            <!-- Tombol Daftar -->
                            <button type="submit"
                                class="w-full bg-[#4f5686] hover:bg-[#41466e] text-white py-2 rounded-lg font-medium transition mt-4">
                                → Daftar
                            </button>
                        </div>

                        <p class="text-center text-sm text-neutral-500">
                            Sudah memiliki akun <span class="font-bold text-neutral-700">Peserta didik</span>?
                            <a href="login.php" class="text-blue-900 hover:underline">Masuk Disini</a>
                        </p>
                    </form>
                </div>
            </div>

            <div class="flex-1 bg-gradient-to-br from-sky-800 to-sky-600 rounded-lg shadow hidden lg:block flex flex-col gap-3 p-4">
                <h1 class="text-center mt-20 text-transparent stroke text-[7rem] xl:text-[12rem] font-bold">PPDB</h1>
            </div>

        </div>

</section>
<script>
    function multiStepForm() {
        return {
            step: 1,
            show: false,
            showConfirm: false,
            password: '',
            confirm: '',
            waNumber: '', // nomor tanpa kode
            waCode: '+62', // default Indonesia
            formData: {
                email: '',
                password: '',
                nama: '',
                tanggal_lahir: '',
                wa: '', // gabungan (kode + nomor)
                nik: ''
            },

            // rules password
            get lengthValid() {
                return this.password.length >= 8 && this.password.length <= 16;
            },
            get caseValid() {
                return /[a-z]/.test(this.password) && /[A-Z]/.test(this.password);
            },
            get numberValid() {
                return /\d/.test(this.password);
            },
            get matchValid() {
                return this.password && this.password === this.confirm;
            },
            get isValid() {
                return this.lengthValid && this.caseValid && this.numberValid && this.matchValid;
            },

            // update full nomor WhatsApp
            updateWA() {
                this.formData.wa = this.waCode + this.waNumber;
            },

            goNext() {
                if (this.isValid) {
                    this.formData.password = this.password;
                    this.step = 2;
                } else {
                    alert('Password tidak valid, periksa kembali!');
                }
            },
            handleSubmit() {
                if (this.step === 1) {
                    this.goNext();
                } else {
                    this.updateWA(); // pastikan WA terisi sebelum submit
                    if (
                        !this.formData.nama.trim() ||
                        !this.formData.tanggal_lahir.trim() ||
                        !this.formData.wa.trim() ||
                        !this.formData.nik.trim()
                    ) {
                        alert('Harap lengkapi semua data!');
                        return;
                    }
                    this.$refs.form.submit();
                }
            }
        }
    }
</script>