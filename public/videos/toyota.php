<?php

class mobil {
    // 1. Memiliki 3 property
    public $pemilik;
    public $merk;
    public $kecepatan;

    // 2. Memiliki 3 method
    public function nyalakan_mobil() {
        return "Mobil dinyalakan.";
    }

    public function matikan_mobil() {
        return "Mobil dimatikan.";
    }

    public function tambah_kecepatan($nilai) {
        $this->kecepatan += $nilai;
    }
}

//3. Buat 2 objek dari class mobil
$mobil_nopal = new mobil();
$mobil_dapiq = new mobil();

//4. Set property untuk masing-masing objek
// a. $mobil_nopal
$mobil_nopal->pemilik = "nopal";
$mobil_nopal->merk = "Toyota";
$mobil_nopal->kecepatan = 0;

// b. $mobil_dapiq
$mobil_dapiq->pemilik = "dapiq";
$mobil_dapiq->merk = "Honda";
$mobil_dapiq->kecepatan = 0;

//5. Tampilkan informasi setiap mobil (pemilik, merk, kecepatan awal), hidupkan mobil, kemudian tambahkan kecepatan:
echo "Informasi Mobil nopal:\n";
echo "Pemilik: " . $mobil_nopal->pemilik . "\n";
echo "Merk: " . $mobil_nopal->merk . "\n";
echo "Kecepatan Awal: " . $mobil_nopal->kecepatan . " km/h\n";
echo $mobil_nopal->nyalakan_mobil() . "\n";
$mobil_nopal->tambah_kecepatan(30);
echo "Kecepatan setelah ditambah: " . $mobil_nopal->kecepatan . " km/h\n\n";

echo "Informasi Mobil dapiq:\n";
echo "Pemilik: " . $mobil_dapiq->pemilik . "\n";
echo "Merk: " . $mobil_dapiq->merk . "\n";
echo "Kecepatan Awal: " . $mobil_dapiq->kecepatan . " km/h\n";
echo $mobil_dapiq->nyalakan_mobil() . "\n";
$mobil_dapiq->tambah_kecepatan(50);
echo "Kecepatan setelah ditambah: " . $mobil_dapiq->kecepatan . " km/h\n\n";

//6. Tampilkan kecepatan setiap mobil setelah ditambah
echo "Kecepatan Akhir Mobil nopal: " . $mobil_nopal->kecepatan . " km/h\n";
echo "Kecepatan Akhir Mobil dapiq: " . $mobil_dapiq->kecepatan . " km/h\n";

?>