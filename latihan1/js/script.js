// 1. Dari Object mejadi JSON
// let mahasiswa = {
//     nama    : "Rifki Ramadhan",
//     nrp     : "123456",
//     email   : "riifkiramadhan2@gmail.com"
// }
// console.log(JSON.stringify(mahasiswa));

// 2. Dari JSON menjadi Object
// let xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function() {
//     if(xhr.readyState == 4 && xhr.status == 200) {
//         let mahasiswa = JSON.parse(this.responseText);
//         console.log(mahasiswa);
//     }
// }
// xhr.open('GET', 'rest-api.json', true);
// xhr.send();

// 3. Menggunakan JQuery satu function
$.getJSON('rest-api.json', function(data) {
    console.log(data);
});