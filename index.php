<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAPS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/leaflet/leaflet.css">
    <link rel="stylesheet" href="css/sweetAlert/sweetalert2.css">
    <link rel="stylesheet" href="css/leaflet/leaflet.draw.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Example Web Map</a>
        <button class="btn btn-secondary btn-sm ml-3" id="cancel_lokasi">Cancel</button>
        <button class="btn btn-danger btn-sm ml-3" id="simpan_lokasi">Simpan</button>
        
    </nav>
    <div id="preloader">
        <div id="loader"></div>
    </div>

    <!-- map -->
    <div id="map"></div>
    
    <!-- modal tambah -->
    <div class="modal fade" id="tambah_data" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="" method="POST" autocomplete="off" id="form-tambah">

                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="nama_lokasi_tambahData" required>
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude_tambahData" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude_tambahData" readonly required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- modal edit -->
    <div class="modal fade" id="edit_data" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_data">Edit data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="" method="POST" autocomplete="off" id="form-edit">

                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="nama_lokasi_editData" name="nama_lokasi" required>
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude_editData" name="latitude" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude_editData" name="longitude" readonly required>
                        </div>
                        <input type="hidden" id="id_edit" />

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning">Ubah</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- modal edit lokasi -->
    <div class="modal fade" id="edit_lokasi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_lokasi">Edit Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="  " method="POST" autocomplete="off" id="form-edit-lokasi">

                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="nama_lokasi_editLokasi" name="nama_lokasi" required>
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude_editLokasi" name="latitude" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude_editLokasi" name="longitude" readonly required>
                        </div>
                        <input type="hidden" id="id_editLokasi" />

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-info">Ubah</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- modal detail lokasi -->
    <div class="modal fade" id="detail_lokasi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail_lokasi">Detail Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama Lokasi</th>
                                <td id="nama_lokasi_detail"></td>
                            </tr>
                            <tr>
                                <th>Latitude</th>
                                <td id="latitude_detail"></td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td id="longitude_detail"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <!-- javascript -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/leaflet/leaflet-src.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/sweetAlert/sweetalert2.all.js"></script>

    <script src="js/leaflet-draw/Leaflet.draw.js"></script>
    <script src="js/leaflet-draw/Control.Draw.js"></script>
    <script src="js/leaflet-draw/Leaflet.Draw.Event.js"></script>

    <script src="js/leaflet-draw/Toolbar.js"></script>
    <script src="js/leaflet-draw/Tooltip.js"></script>
    <script src="js/leaflet-draw/draw/DrawToolbar.js"></script>
    
    <script src="js/leaflet-draw/edit/handler/Edit.Marker.js"></script>

    <script src="js/leaflet-draw/draw/handler/Draw.Feature.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Polyline.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Polygon.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.SimpleShape.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Rectangle.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Marker.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.CircleMarker.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Circle.js"></script>

    <script src="js/leaflet-draw/ext/TouchEvents.js"></script>
    <script src="js/leaflet-draw/edit/EditToolbar.js"></script>
    <script src="js/leaflet-draw/edit/handler/EditToolbar.Edit.js"></script>
    <script src="js/leaflet-draw/edit/handler/EditToolbar.Delete.js"></script>
    
    <script src="js/leaflet-draw/ext/LatLngUtil.js"></script>
    <script src="js/script.js"></script>
</body>
</html>