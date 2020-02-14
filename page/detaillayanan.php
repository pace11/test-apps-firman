<?php 

$sql = mysqli_query($conn, "SELECT * FROM tbl_layanan WHERE id_layanan='$_GET[id]'");
while($data = mysqli_fetch_array($sql)){
  $isi['nama'] = $data['nama_layanan'];
  $isi['alamat'] = $data['alamat_layanan'];
  $isi['lat'] = $data['lat'];
  $isi['lng'] = $data['lng'];
  $isi['type'] = 'Layanan';
  $markers[] = $isi;
  $isian['nama'] = $data['nama_layanan'];
  $isian['alamat'] = $data['alamat_layanan'];
  $img = json_decode($data['data_img']);
  $isian['img'] = 'http://localhost:81/tari-skripsi/file/'.$img[0];
  $info[] = $isian;
}
$get = mysqli_query($conn, "SELECT * FROM tbl_layanan 
                          JOIN tbl_distrik ON tbl_layanan.id_distrik=tbl_distrik.id_distrik
                          JOIN tbl_jenislayanan ON tbl_layanan.id_jenislayanan=tbl_jenislayanan.id_jenislayanan 
                          WHERE id_layanan='$_GET[id]'");
$datas = mysqli_fetch_array($get);

?>
<div class="content-wrapper">
  <div class="container">
    <section class="content-header">
      <h1>
        Layanan
        <small>Website Pelayanan Publik Kota Jayapura </small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Peta Layanan Publik Kota Jayapura</h3>
            </div>
            <div class="box-body">
              <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <td>Nama Tempat</td>
                                  <td><?= $datas['nama_layanan'] ?></td>
                                </tr>
                                <tr>
                                  <td>Jenis Layanan</td>
                                  <td><span><?= $datas['nama_jenis_layanan'] ?></td>
                                </tr>
                                <tr>
                                  <td>Distrik</td>
                                  <td><?= $datas['nama_distrik'] ?></td>
                                </tr>
                                <tr>
                                  <td>Aksi</td>
                                  <td>
                                    <button id="btnAction" class="btn btn-primary btn-xs" onClick="locate()"><span class="fa fa-refresh"></span> Refresh Maps</button>
                                    <?php 
                                      if (isset($_POST['submit'])){

                                          $_SESSION['lat'] = $_POST['latMe'];
                                          $_SESSION['lng'] = $_POST['lngMe'];
                              
                                          $mylocate = [
                                              'nama'        => 'Pengunjung',
                                              'alamat'      => 'Jayapura, Papua, Indonesia',
                                              'lat'         => $_POST['latMe'],
                                              'lng'         => $_POST['lngMe'],
                                              'type'        => 'Pengunjung',
                                          ];
                                          $mylocate2 = [
                                              'nama'        => 'Pengunjung',
                                              'alamat'      => 'Jayapura, Papua, Indonesia',
                                              'img'         => 'http://localhost:81/tari-skripsi/dist/img/pengunjung.png',
                                          ];
                                              json_encode($mylocate);
                                          
                                          array_unshift($markers,$mylocate);
                                          array_unshift($info,$mylocate2);
                              
                                      } ?>
                                    <form action="?page=detaillayanan&id=<?= $datas['id_layanan'] ?>" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <input id="latMe" type="hidden" name="latMe">
                                        <input id="lngMe" type="hidden" name="lngMe">
                                        <input id="btnRefresh" type="submit" class="btn btn-warning btn-xs" name="submit" value="Tampilkan Rute">
                                      </div>
                                    </form>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Gunakan Rute</td>
                                  <td>
                                    <a id="rutedetail" href="https://www.google.com/maps/dir/?api=1&origin=<?= $_SESSION['lat']?>,<?= $_SESSION['lng'] ?>&destination=<?= $datas['lat'] ?>,<?= $datas['lng'] ?>&travelmode=driving" target="_blank"" class="btn btn-success btn-xs"><i class="fa fa-map"></i> Rute Detail</a>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row"> 
                          <div class="col-md-12">
                            <div id="mapcanvas" style="width: 100%; height: 500px"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <td>Image Layanan Publik</td>
                                </tr>
                                <tr>
                                  <td><?= carousel($datas['data_img']) ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php 
  include "footer.php";
?>
<script>
$(function(){
  $('#btnRefresh').hide();
  $('#rutedetail').hide();
});
</script>
<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapcanvas"), mapOptions);
    map.setTilt(50);
    
    var iconBase = 'http://localhost:81/tari-skripsi/dist/img/';

    //label markers
    var icons = {
        Layanan : {
            icon : iconBase + 'layanan.png'
        },
        Pengunjung : {
            icon : iconBase + 'pengunjung.png'
        },
    } 

    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if(count($markers) > 0){
            foreach($markers as $row){
                echo '["'.$row['nama'].'",'.$row['lat'].','.$row['lng'].',"'.$row['type'].'"],';
            }
        }
        ?>
    ];
                        
    var infoWindowContent = [
        <?php if(count($info) > 0){
            foreach($info as $row){ ?>
                [
                '<div class="info_content">' +
                '<h5><?php echo $row['nama']; ?></h5>' +
                '<p><?php echo $row['alamat']; ?></p>' +
                '<img src="<?php echo $row['img'] ?>" width="150" style="margin-bottom:5px;">'+
                '</div>'
                ],
        <?php } } ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          title: markers[i][0],
          icon: icons[markers[i][3]].icon
      });
      
      // Add info window to marker    
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent(infoWindowContent[i][0]);
              infoWindow.open(map, marker);
          }
      })(marker, i));
      bounds.extend(position);
    }
      map.fitBounds(bounds); 
}
function locate(){
    if ("geolocation" in navigator){
        navigator.geolocation.getCurrentPosition(function(position){ 
            var currentLatitude = position.coords.latitude;
            var currentLongitude = position.coords.longitude;
            $('#latMe').val(currentLatitude);
            $('#lngMe').val(currentLongitude);
            $('#btnRefresh').show();
            $('#rutedetail').show();
        });
    }
}
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyC_JSjDVBZsdjyGBsO2OdQMPkFMQfVCweA&callback=initMap">
</script>
