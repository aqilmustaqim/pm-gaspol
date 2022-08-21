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