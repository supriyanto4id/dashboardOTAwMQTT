<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>status Server, Device IoT active </small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
      <!-- TO DO List -->

    

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">Status Server</div>
        <div class="panel-body">
        
          <!-- /.box-header -->
          <div class="box-body no-padding">
              <table class="table table-condensed">
                
                <tr>
                  <td>Version</td>
                  <td><?php echo $version;?></td>
                </tr>
                <tr>
                  <td>SysDescr</td>
                  <td><?php echo $sysdescr;?></td>
                </tr>
                <tr>
                  <td>Uptime</td>
                  <td><?php echo $uptime;?></td>
                </tr>
                <tr>
                  <td>Date Time</td>
                  <td> <?php echo $date_time;?></td>
                </tr>
                <tr>
                  <td>OTP Release</td>
                  <td> <?php echo $otp_release;?> </td>
                </tr>
                <tr>
                  <td>Node Status</td>
                  <td> <span class="label label-success"><?php echo $node_status;?> </span></td>
                </tr>
               
              </table>
            </div>
            <!-- /.box-body -->
        </div>
      </div>
      </div>
 
  
  <div class="col-md-6">
  <div class="box box-primary">
      <div class="box-header with-border">List all client on server</div>
        <div class="panel-body">

        <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">Client id</th>
                  <th>Username</th>
                  <th>Connected at</th>
                </tr>
                <?php 
                    foreach ($parsingListClient["data"] as $key => $value) {
                      ?>
                <tr>
                  <td><?php echo $value['client_id']; ?></td>
                  <td><?php echo $value['username']; ?></td>
                  <td><?php echo $value['connected_at']; ?></td>
                </tr>
              <?php } ?>
          </table>

        </div>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">List all subcriber</div>
        <div class="panel-body">
        <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">Client id</th>
                  <th>Topic</th>
                  <th>QoS</th>
                </tr>
                <?php 
                    foreach ($parsingListSubscribe["data"] as $key => $value) {
                      ?>
                <tr>
                  <td><?php echo $value['client_id']; ?></td>
                  <td><?php echo $value['topic']; ?></td>
                  <td><?php echo $value['qos']; ?></td>
                </tr>
              <?php } ?>
          </table>
        </div>
      </div>
      </div>
 
  
  <div class="col-md-6">
  <div class="box box-primary">
      <div class="box-header with-border">Device IoT</div>
        <div class="panel-body">
           <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">No</th>
                  <!-- <th>Client id</th> -->
                  <th>client id</th>
                  <th>Temperature</th>
                  <th>Humidity</th>
                  
                </tr>

                <?php 
                      $n = 1;
                    foreach ($parsingListClient["data"] as $key => $value) {
                     if ($value['client_id'] != "clientId") {
                     ?>
                       <tr>
                       <td><?php echo $n; ?></td>
                       <td><?php echo $value['client_id']; ?></td>
                      <!-- Temperature -->
                       <td id="device/temperatur/<?php echo $value['client_id'];?>"> </td> 
                       <!-- humidity -->
                       <td id="device/humidity/<?php echo $value['client_id'];?>"> </td>
                     </tr>
                     <?php
                      $n++;
                      }
                     ?>
                      
                
              <?php 
             
            } ?>
          </table>
        </div>
      </div>
  </div>
</div>



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

