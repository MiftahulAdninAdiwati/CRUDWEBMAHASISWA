<?php 

require '../DatabaseConn/DatabaseConn.php';

// ambil id yang ada di url
$nim = $_GET['nim'];

// data yang diedit kembalikan value 
$mhs = query("SELECT * FROM regular WHERE nim = $nim")[0];

function editData($post){
  global $conn;

  // ambil data dari tiap form
  $nimLama = $_GET["nim"];
  $nim = $post["nim"];
  $nama = htmlspecialchars($post["nama"]);
  $jk = htmlspecialchars($post["jk"]);
  $tgllahir = htmlspecialchars($post["tgllahir"]);
  $alamat = htmlspecialchars($post["alamat"]);
  $email = htmlspecialchars($post["email"]);
  $fakultas = htmlspecialchars($post["fakultas"]);
  $jurusan = htmlspecialchars($post["jurusan"]);

  // kirim data yang sudah di ubah ke database
  $query= "UPDATE regular SET
      nim ='$nim',
      nama ='$nama',
      jk ='$jk',
      tgllahir ='$tgllahir',
      alamat ='$alamat',
      email ='$email',
      fakultas ='$fakultas',
      jurusan ='$jurusan'

      WHERE nim = $nimLama;
      ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

      // cek apakah tombol submit sudah dipklik atau belum

      if ( isset($_POST["submit"]) ) {

        // cek apakah data berhasil ditambah atau tidak
        if (editData($_POST) > 0 ){
          echo "
        <script>
          alert('data berhasil diubah!');
          document.location.href=
          '../';
        </script>
        ";
        }
      else { echo"
            <script>
          alert('data gagal diubah!');
          document.location.href=
          '../';
        </script>
        ";          }
      }



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Edit Data</title>
</head>
<body>
  <div class="form-container">
    <h3>EDIT DATA MAHASISWA</h3>

    <form action="" autocomplete="off" method="post" enctype="multipart/form-data">
      <label for="NIM">NIM</label>
      <input type="text" id="NIM" name="nim" value="<?= $mhs["nim"] ?>" placeholder="Nomor Induk Mahasiswa" required>

    <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" value="<?= $mhs["nama"] ?>" placeholder="Masukkan Nama" required>

      <label for="jk">Jenis Kelamin</label>
    <select id="jk" name="jk">
      <option value="<?= $mhs["jk"] ?>"><?= $mhs["jk"] ?></option>
      <option value="L">Laki-laki</option>
      <option value="P">Perempuan</option>
    </select>
    
    <label for="tglLahir">Tanggal Lahir</label>
      <input type="text" id="tglLahir" name="tgllahir" value="<?= $mhs["tgllahir"] ?>" placeholder="Masukkan Tanggal Lahir"required>

	  <label for="alamat">Alamat</label>
      <input type="text" id="alamat" name="alamat" value="<?= $mhs["alamat"] ?>" placeholder="Masukkan Alamat" required>

	  <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= $mhs["email"] ?>" placeholder="Masukkan Email" required>

	  <label for="fakultas">Fakultas</label>
    <select id="fakultas" name="fakultas">
      <option value="<?= $mhs["fakultas"] ?>"><?= $mhs["fakultas"] ?></option>
      <option value="Teknologi Informasi">Teknologi Informasi</option>
      <option value="Ilmu Sosial dan Ilmu Politik">Ilmu Sosial dan Ilmu Politik</option>
      <option value="Psikologi">Psikologi</option>
      <option value="Teknik">Teknik</option>
      <option value="Ekonomi & Bisnis">Ekonomi & Bisnis</option>
    </select>

	  <label for="jurusan">Jurusan</label>
    <select id="jurusan" name="jurusan">
      <option value="<?= $mhs["jurusan"] ?>"><?= $mhs["jurusan"]  ?></option>
      <option value="Sistem Informasi">Sistem Informasi</option>
      <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
      <option value="Administrasi Publik">Administrasi Publik</option>
      <option value="Psikologi">Psikologi</option>
      <option value="Teknik Elektro">Teknik Elektro</option>
      <option value="Teknik Mesin">Teknik Mesin</option>
      <option value="Manajemen Akutansi">Manajemen Akutansi</option>
    </select>      

      <button type="submit" name="submit">Tambah Data</button>
    </form>
  </div>
</body>
</html>
