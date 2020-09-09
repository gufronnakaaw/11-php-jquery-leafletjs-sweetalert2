$( document ).ready(function(){
    renderMarker();
});


// map
let curLocation = [-6.200000, 106.816666];

let map = L.map('map').setView(curLocation, 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
    
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
    position: 'topleft',
    draw: {
        circlemarker: false,
        rectangle: false,
        polyline: false,
        polygon: false,
        circle: false,
        marker: true
    }
});
map.addControl(drawControl);

map.on(L.Draw.Event.CREATED, function (e) {
    var type = e.layerType,
        layer = e.layer;

    if (type === 'marker') {
        let position = layer.getLatLng();
        let lat = position.lat;
        let long = position.lng;

        $('#tambah_data').modal('show');

        $('#tambah_data').on('shown.bs.modal', function(){
            $('#latitude_tambahData').val(lat);
            $('#longitude_tambahData').val(long);
        });
    }

    drawnItems.addLayer(layer);
});


// render marker
let layerMarker = [];
function renderMarker(){
    $.ajax({
        url: 'getAll.php',
        method: 'post',
        success: function(res){
            let data = JSON.parse(res);
            data.map(el => {
                let lat = el.latitude;
                let long = el.longitude;
                let name = el.nama_lokasi;
                let id = el.id;


                markerLokasi = L.marker([lat,long]).bindPopup(`
                <p style="text-align: center; font-weight: bold; font-size: 15px;">${name}</p>
                <br>
                <a class="badge badge-success text-white" href="javascript:void(0)" onClick="detailLokasi(${id})" style="font-size: 13px;">Detail</a>
                <a class="badge badge-warning text-white" href="javascript:void(0)" onClick="openEditModal(${id})" style="font-size: 13px;">Ubah</a>
                <a class="badge badge-info text-white" href="javascript:void(0)" id="btn_editLokasi" onClick="editLokasi(${id}, ${lat}, ${long})" style="font-size: 13px;">Ubah lokasi</a>
                <a class="badge badge-danger text-white" href="javascript:void(0)" onClick="hapusData(${id})" style="font-size: 13px;">Hapus</a>
                `)
                .openPopup()
                .addTo(map);

                layerMarker.push({id, obj: markerLokasi});
            })
        }
    })
}


// edit lokasi
function editLokasi(id, lat, long){
    if(layerMarker != []){
        layerMarker.map(el=> {
            if(el.id == id){
                map.removeLayer(el.obj);
                let marker = L.marker({lat, lng: long}, {draggable: 'true'})
                .addTo(map)
                .bindPopup(`<h3 style="text-align: center">!</h3>`)
                .openPopup();

                $('#simpan_lokasi').show();
                $('#cancel_lokasi').show();

                $('#cancel_lokasi').on('click', function(){
                    window.location.reload();
                });
                
                $('#simpan_lokasi').on('click', function(){
                    $('#preloader').show();
                    $('#edit_lokasi').modal('show');

                    // request data
                    $.ajax({
                        url: 'getById.php',
                        method: 'post',
                        data: {
                            id
                        },
                        success: function(res){
                            $('#preloader').hide();
                            let data = JSON.parse(res);
                            
                            $('#edit_lokasi').on('shown.bs.modal', function(){
                                $('#id_editLokasi').val(id);
                                $('#nama_lokasi_editLokasi').val(data.nama_lokasi);
                            });
                            
                        }
                        
                    });
                });

                // on dragend
                marker.on('dragend', function(){
                    let position = marker.getLatLng();
                    let lat = position.lat;
                    let long = position.lng;

                    
                    $('#edit_lokasi').on('shown.bs.modal', function(){
                        $('#latitude_editLokasi').val(lat);
                        $('#longitude_editLokasi').val(long);
                    });

                });
                
            }
        })
        
    } else {
        return false;
    }
}  


// form edit lokasi
$('#form-edit-lokasi').submit(function(e){
    e.preventDefault();

    let id = $('#id_editLokasi').val(),
        nama_lokasi = $('#nama_lokasi_editLokasi').val(),
        latitude = $('#latitude_editLokasi').val(),
        longitude= $('#longitude_editLokasi').val();
    
        $.ajax({
            url: "update.php",
            method: 'POST',
            cache:false,
            data: {
                id,
                nama_lokasi,
                latitude,
                longitude
            },
            success: function(res){
                let data = JSON.parse(res);
                console.log(data);
                if(data.status == "success"){
                    Swal.fire({
                        title: `${data.status}`,
                        text: `${data.msg}`,
                        icon: `${data.status}`
                    }).then(function(){
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: `${data.status}`,
                        text: 'tidak ada data yang diubah',
                        icon: `${data.status}`
                    }).then(function(){
                        window.location.reload();
                    });
                }
                
            },
            error: function(){
                alert('Koneksi Error');
            }
        })
});


// tambah data
$('#form-tambah').submit(function(e){
    e.preventDefault();

    let nama_lokasi = $('#nama_lokasi_tambahData').val(),
        latitude = $('#latitude_tambahData').val(),
        longitude= $('#longitude_tambahData').val();

        $.ajax({
            url: "create.php",
            method: 'POST',
            data: {
                nama_lokasi,
                latitude,
                longitude
            },
            success: function(res){
                let data = JSON.parse(res);
                console.log(data);
                if(data.status == "success"){
                    Swal.fire({
                        title: `${data.status}`,
                        text: `${data.msg}`,
                        icon: 'success'
                    }).then(function(){
                        window.location.reload();
                    });

                } else {
                    Swal.fire({
                        title: `${data.status}`,
                        text: `${data.msg}`,
                        icon: `${data.status}`
                    });
                }
                
            },
            error: function(){
                alert('Koneksi Error');
            }
        })
});


// open edit modal
function openEditModal(id){
    $('#edit_data').modal('show');
    $('#preloader').show();
    $.ajax({
        url: "getById.php",
        method: 'POST',
        cache:false,
        data: {
            id
        },
        success: function(res){
            let data = JSON.parse(res);
            // console.log(data);

            $("#id_edit").val(id);
            $("#nama_lokasi_editData").val(data.nama_lokasi);
            $("#latitude_editData").val(data.latitude);
            $("#longitude_editData").val(data.longitude);
            $('#preloader').hide();
        },
        error: function(){
            alert('Koneksi Error');
        },
        timeout: 5000
    })
}


// form edit
$('#form-edit').submit(function(e){
    e.preventDefault();

    let id = $('#id_edit').val(),
        nama_lokasi = $('#nama_lokasi_editData').val(),
        latitude = $('#latitude_editData').val(),
        longitude= $('#longitude_editData').val();

    
    $.ajax({
        url: "update.php",
        method: 'POST',
        cache:false,
        data: {
            id,
            nama_lokasi,
            latitude,
            longitude
        },
        success: function(res){
            let data = JSON.parse(res);
            console.log(data);
            if(data.status == "success"){
                Swal.fire({
                    title: `${data.status}`,
                    text: `${data.msg}`,
                    icon: 'success'
                }).then(function(){
                    window.location.reload();
                })
            } else {
                Swal.fire({
                    title: `${data.status}`,
                    text: 'tidak ada data yang diubah!',
                    icon: 'error'
                }).then(function(){
                    $('#edit_data').modal('hide');
                });
            }
            
        },
        error: function(){
            alert('Koneksi Error');
        },
        timeout: 5000
    });
});


// detail lokasi
function detailLokasi(id){
    $('#detail_lokasi').modal('show');
    $('#preloader').show();
    $.ajax({
        url: "getById.php",
        method: 'POST',
        cache:false,
        data: {
            id
        },
        success: function(res){
            let data = JSON.parse(res);
            // console.log(data);
            $("#id_edit").val(id);
            $("#nama_lokasi_detail").text(data.nama_lokasi);
            $("#latitude_detail").text(data.latitude);
            $("#longitude_detail").text(data.longitude);
            $('#preloader').hide();
        },
        error: function(){
            alert('Koneksi Error');
        },
        timeout: 5000
    })
}


// hapus data
function hapusData(id){
    Swal.fire({
        title: 'Yakin untuk menghapus?',
        text: "Anda akan kehilangan data anda!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d63031',
        cancelButtonColor: '#636e72',
        confirmButtonText: 'Hapus'
      }).then((result) =>{
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: {
                        id
                    },
                    success: function(res){
                        let data = JSON.parse(res);
                        console.log(data);
                        if(data.status == "success"){
                            Swal.fire({
                                title: `${data.status}`,
                                text: `${data.msg}`,
                                icon: 'success'
                            }).then(function(){
                                window.location.reload();
                            });
                        }
                    }
                });
            }
      })

}


// modal in hide
$("#edit_data").on('hide.bs.modal', function(){

    $("#id_edit").val("");
    $("#nama_lokasi_editData").val("");
    $("#latitude_editData").val("");
    $("#longitude_editData").val("");
});

$("#detail_lokasi").on('hide.bs.modal', function(){

    $("#nama_lokasi_detail").text("");
    $("#latitude_detail").text("");
    $("#longitude_detail").text("");
});

$("#edit_lokasi").on('hide.bs.modal', function(){

    $("#id_edit").val("");
    $("#nama_lokasi_editLokasi").val("");
    $("#latitude_editLokasi").val("");
    $("#longitude_editLokasi").val("");
});