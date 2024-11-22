function togglePassword() {
    var passwordField = document.getElementById('password');
    var eyeIcon = document.getElementById('eye-icon');

    // Jika saat ini password disembunyikan (tipe "password")
    if (passwordField.type === "password") {
        passwordField.type = "text"; // Ubah tipe input menjadi teks (menampilkan password)
        eyeIcon.classList.remove('fa-eye-slash'); // Ubah ikon menjadi 'fa-eye'
        eyeIcon.classList.add('fa-eye');
    } else {
        // Jika saat ini password ditampilkan (tipe "text")
        passwordField.type = "password"; // Ubah kembali ke tipe password (menyembunyikan password)
        eyeIcon.classList.remove('fa-eye'); // Kembalikan ikon menjadi 'fa-eye-slash'
        eyeIcon.classList.add('fa-eye-slash');
    }
}

// Event listener untuk toggle icon dan menampilkan/menyembunyikan password saat ikon diklik
document.getElementById('eye-icon').addEventListener('click', togglePassword);
