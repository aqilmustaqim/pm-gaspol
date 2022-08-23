//Data Table
$(document).ready(function () {
    $('#example').DataTable();
});

//Tombol-Approve
$('.tombol-approve').on('click',function(e){
  //Matikan fungsi A href nya
  e.preventDefault();
  //Ambil Isi Hrefnya
  const href = $(this).attr('href');
  Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Data Member Diaktivasi!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Gaspol Om !'
    }).then((result) => {
      if (result.isConfirmed) {
        //Tampilkan Href
        document.location.href = href;
      }
    })
});

//Tombol-hapus
$('.tombol-hapus').on('click',function(e){
    //Matikan fungsi A href nya
    e.preventDefault();
    //Ambil Isi Hrefnya
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Akan Dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          //Tampilkan Href
          document.location.href = href;
        }
      })
});

//Flash Data
const swal = $('.profile').data('profile'); //Ambil Data FlashDatanya
if ( swal ){
    //Kalau Ada isinya jalankan sweetalert
    Swal.fire({
        title: 'Data Profile ',
        text: 'Berhasil ' + swal,
        icon: 'success'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="/auth/logout";
        }
      })
}

//Flash Data
const swal1 = $('.member').data('member'); //Ambil Data FlashDatanya
if ( swal1 ){
    //Kalau Ada isinya jalankan sweetalert
    Swal.fire({
        title: 'Data Member ',
        text: 'Berhasil ' + swal1,
        icon: 'success'
    })
}

$('.btn-change-password').on('click',function(){
    let passwordlama = $('#passwordlama').val();
    let passwordbaru = $('#passwordbaru').val();
    let passwordkonfirmasi = $('#passwordkonfirmasi').val();

    if(passwordlama == ''){
        Swal.fire({
            title: 'Change Password ',
            text: 'Password Lama Tidak Boleh Kosong !',
            icon: 'error'
        });
    }else if(passwordbaru.length < 8){
        Swal.fire({
            title: 'Change Password ',
            text: 'Password Minimal 8 Karakter !',
            icon: 'error'
        });
    }else if(passwordbaru == ''){
        Swal.fire({
            title: 'Change Password ',
            text: 'Password Baru Tidak Boleh Kosong !',
            icon: 'error'
        });
    }else if(passwordkonfirmasi != passwordbaru){
        Swal.fire({
            title: 'Change Password ',
            text: 'Password Konfirmasi Harus Match Dengan Password !',
            icon: 'error'
        });
    }else{
          $.ajax({
            method: "POST",
            url: "/auth/changePassword",
            data: {
              passwordlama : passwordlama,
              passwordbaru : passwordbaru,
              passwordkonfirmasi : passwordkonfirmasi
            },
            success: function(data){
              if(data == "passwordsalah"){
                Swal.fire({
                  title: 'Change Password',
                  text: 'Password Lama Salah !',
                  icon: 'error'
                })
              }else if(data == "berhasil"){
                Swal.fire({
                    title: 'Change Password',
                    text: 'Berhasil Di Ubah Silahkan Login Ulang !',
                    icon: 'success'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href="/auth/logout";
                    }
                  })
              }
      
            }
        });
    }
});

// $('.tombol-save-profile').on('click',function(){
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//       }).then((result) => {
//         if (result.isConfirmed) {
//           //Jalankan Ajax
//           $.ajax({
//             method: "POST",
//             url: "/auth/editProfile",
//             data: {
//               nama : $('.nama').val(),
//               foto : $('.foto').val(),
//               fotoLama : $('.fotoLama').val()
//             },
//             success: function(data){
//               if(data == "1"){
//                 Swal.fire({
//                   title: 'Data Project',
//                   text: 'Berhasil Tambahkan',
//                   icon: 'success'
//                 }).then((result) => {
//                   document.location.reload();
//                 })
                
//               }
      
//             }
//         });
//         }
//       })
// });