<?php 

$sql = mysqli_query($conn, "SELECT * FROM tbl_layanan");
while($data = mysqli_fetch_array($sql)){
  $isi['nama'] = $data['nama_layanan'];
  $isi['alamat'] = $data['alamat_layanan'];
  $isi['lat'] = $data['lat'];
  $isi['lng'] = $data['lng'];
  $markers[] = $isi;
  $isian['nama'] = $data['nama_layanan'];
  $isian['alamat'] = $data['alamat_layanan'];
  $img = json_decode($data['data_img']);
  $isian['img'] = 'http://localhost:81/tari-skripsi/file/'.$img[0];
  $isian['detail'] = 'http://localhost:81/tari-skripsi/index.php?page=detaillayanan&id='.$data['id_layanan'];
  $info[] = $isian;
}

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
                          <div id="mapcanvas" style="width: 100%; height: 500px"></div>
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
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapcanvas"), mapOptions);
    map.setTilt(50);
    
    var iconBase = 'http://localhost:81/tari-skripsi/dist/img/layanan.png';

    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if(count($markers) > 0){
            foreach($markers as $row){
                echo '["'.$row['nama'].'",'.$row['lat'].','.$row['lng'].'],';
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
                '<a href="<?php echo $row['detail'] ?>" class="btn btn-primary btn-xs btn-block">detail</a>'+
                '</div>'
                ],
        <?php } } ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0],
            icon: iconBase
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));
        // Center the map to fit all markers on the screen
    }
        map.fitBounds(bounds);
}
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyC_JSjDVBZsdjyGBsO2OdQMPkFMQfVCweA&callback=initMap">
</script>
