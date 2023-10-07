<?php
// Nama : Dian Pagita
// Nim  : 24060121130092
// lab  : A1

include('header.html');

require_once 'lib/db_login.php';

$style = array(
    "block" => "flex flex-col",
    "label" => "block mb-2 text-sm font-medium text-gray-900",
    "select" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
    "input" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
    "textarea" => "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500",
    "radio" => "w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600",
    "radio-label" => "ml-2 text-sm font-medium text-slate-900",
    "button" => "text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"
);

/*TODO 2 : Buatlah
1. server side validation
2. insert new user
3. tampilkan hasilnya error/berhasil */
if (isset($_POST['submit'])) {
    $is_valid = TRUE;

    $nama = test_input($_POST['nama']);
    if ($nama == '') {
        $error_nama = "Nama tidak boleh kosong";
        $is_valid = FALSE;
    }

    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "Email harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Format email tidak benar";
    }

    if($error_email = "Email tersedia"){
        $is_valid = FALSE;
    }

    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    if (empty($gender)) {
        $error_gender = "Jenis kelamin  tidak boleh kosong";
    }

    $alamat = test_input($_POST['alamat']);
    if ($alamat == '') {
        $error_alamat = "Alamat  tidak boleh kosong";
    }

    $provinsi = $_POST['provinsi'];
    if ($provinsi == '' || $provinsi == 'provinsi') {
        $error_provinsi = "Provinsi  tidak boleh kosong";
    }

    $kabupaten = $_POST['kabupaten'];
    if ($kabupaten == '' || $kabupaten == 'kabupaten') {
        $error_kabupaten = "Kabupaten  tidak boleh kosong";
    }

    if ($is_valid) {
        $query = "INSERT INTO tb_user (`id`, `nama`, `email`, `jenis_kelamin`, `alamat`, `kode_prov`, `kode_kab`) VALUES (NULL, '$nama', '$email', '$gender', '$alamat', '$provinsi', '$kabupaten')";
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br>" . $db->error . '<br>Query: ' . $query);
        } else {
            echo '<div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Success alert!</span> Data telah tersimpan ^^.
            </div>
          </div>';
        }
        $db->close();
    }
}
?>

<div class="text-xl text-center font-semibold">Form Input Pendaftaran</div>
<!-- TODO 3 : definisikan method dan actions pada tags <form> -->
<form name="daftar" method="POST" action="">
    <div class="<?php echo $style['block'] ?>">
        <label for="name" class="<?php echo $style['label'] ?>">Nama</label>
        <input type="text" name="nama" id="nama" class="<?php echo $style['input'] ?>">
        <div id="error_name" style="color: red;">
            <?php if (isset($error_nama))  echo $error_nama ?>
        </div>
    </div>
    <div class="<?php echo $style['block'] ?>">
        <label for="email" class="<?php echo $style['label'] ?>">Email</label>
        <!-- TODO 4 : buatlah cek email menggunakan ajax -->
        <input type="email" name="email" id="email" class="<?php echo $style['input'] ?>" onchange="getUser()" value="<?php if (isset($email)) {echo $email;} ?>">
        <div id="error_email" class="text-green-500">
            <?php if (isset($error_email))  echo $error_email ?>
        </div>
    </div>
    <label class="<?php echo $style['label'] ?>">Jenis Kelamin</label>


    <div class="flex items-center mb-2">
        <input type="radio" value="Laki-laki" name="gender" class="<?php echo $style['radio'] ?>">
        <label class="<?php echo $style['radio-label'] ?>">Laki-laki</label>
    </div>
    <div class="flex items-center">
        <input type="radio" value="Perempuan" name="gender" class="<?php echo $style['radio'] ?>">
        <label class="<?php echo $style['radio-label'] ?>">Perempuan</label>
    </div>
    <div id="error_gender" style="color: red; margin-bottom: 12px;">
        <?php if (isset($error_gender))  echo $error_gender ?>
    </div>
    <div class="<?php echo $style['block'] ?>">
        <label for="alamat" class="<?php echo $style['label'] ?>">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" class="<?php echo $style['textarea'] ?>"></textarea>
        <div id="error_alamat" style="color: red;">
            <?php if (isset($error_alamat))  echo $error_alamat ?>
        </div>
    </div>
    <div class="<?php echo $style['block'] ?>">
        <label for="provinsi" class=`styling.label`>Provinsi</label>
        <select onchange="getKabupaten(this.value)" name="provinsi" id="provinsi" class="<?php echo $style["select"] ?>">
            <option value="">Pilih Provinsi</option>
            <?php require_once('get_provinsi.php'); ?>
        </select>
        <div id="error_provinsi" style="color: red;">
            <?php if (isset($error_provinsi))  echo $error_provinsi ?>
        </div>
    </div>
    <div class="<?php echo $style['block'] ?>">
        <label for="kabupaten">Kabupaten</label>
        <select name="kabupaten" id="kabupaten" class="<?php echo $style['select'] ?>">
            <option value="">Pilih kabupaten</option>
            <!-- TODO 5 : tampilkan daftar kabupaten berdasarkan pilihan provinsi yang dipilih, menggunakan ajax -->
            <?php require_once('get_kabupaten.php'); ?>
        </select>
        <div id="error_kabupaten" style="color: red;">
            <?php if (isset($error_kabupaten))  echo $error_kabupaten ?>
        </div>
    </div>
    <br>
    <button type="submit" name="submit" value="submit" class="<?php echo $style['button'] ?>">
        Daftar</button>
</form>
<?php include('footer.html') ?>