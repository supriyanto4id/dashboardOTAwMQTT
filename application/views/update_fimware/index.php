<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update Fimware
      <small>list IoT, you can selecet device </small>
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
  <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Upload File .bin</h3>
        </div>

        <!-- /.box-header -->
        <!-- form start -->

        <?php echo $error;?>
        <?php foreach ($penguna as $penguna_data): ?>
        <?php echo form_open_multipart('updatefimware/do_upload/'.$penguna_data->id_penguna);?>
        <?php endforeach; ?>
          <div class="box-body">
            <div class="form-group">
              <p><?php echo $this->session->flashdata('item'); ?></p>
              <input type="file" name="userfile" size="20" />
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="upload" />
          </div>
        </form>
        <!-- list data -->
        <table class="table table-condensed">
              <tr>
                 <th style="width: 10px">#</th>
                 <th>File Name</th>
                 <th style="width: 40px">Action</th>
               </tr>
                 <?php foreach ($file_bin as $data_file): ?>
               <tr>
                 <td>
                  <input type="checkbox" value="">
                 </td>
                 <td><?php echo $data_file->file_name ?></td>
                 <td>
                   <a href="<?php echo base_url()."update_fimware/delete_file/".$data_file->id_file?>"  class="fa fa-trash-o"></a>
                 </td>
               </tr>
               <?php endforeach; ?>
        </table>

      </div>
      <!-- /.box -->
</div>
<!-- end div md 6 -->
      <div class="col-md-6">
        <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Setting Host Server MQTT</h3>
              </div>
              <!-- /.box-header -->
              <?php foreach ($penguna as $penguna_data): ?>
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Host</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="dns server mqtt / ip server mqtt" value="<?php echo $penguna_data->host_server ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Port</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Port" value="<?php echo $penguna_data->port_server ?> " readonly>
                  </div>
               </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Username" value="<?php echo $penguna_data->username_server?>" readonly>
                  </div>
              </div>
                <div class="form-group">
                  <label  for="inputEmail3" class="col-sm-2 control-label">Password</label>
                  <div  class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Password" value="<?php echo $penguna_data->password_server ?>" readonly>
                  </div>
                </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                <a href="<?php echo site_url('updatefimware/edit/'.$penguna_data->id_penguna)?>" class="btn btn-warning">Edit</a>
                </div>
              </form>
               <?php endforeach; ?>
            </div>
            <!-- /.box -->
      </div>
      <!-- end div md 6 -->
</div>
<!-- end row -->

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
             
             <div class="box-header">
               <h3 class="box-title">List Device IoT </h3> <h1><?php echo $this->session->flashdata('message'); ?></h1>

                <div class="box-tools pull-right">
                  <?php foreach ($penguna as $penguna_data): ?>

                <a href="<?php echo site_url('updatefimware/createdeviceiot/'.$penguna_data->id_penguna)?>" class="btn btn-primary btn-sm">Create</a>
                   <?php endforeach; ?>
                </div>
             </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
             <table class="table table-hover">
                <tr>
                  <th>Name Device</th>
                  <th>Topic to Publish</th>
                  <th>QoS</th>
                  <th>File Bin</th>
                  <th>Action</th>
                  <th>Publish</th>
                </tr>

                <?php foreach ($penguna as $penguna_data): ?>
                 <?php foreach ($device_iot as $data_device): ?>
                <tr>
                  <form action="updatefimware/publish" method="post" >
                  <td >
                    <?php echo $data_device->name_device;?>
                  </td>
                  <td>
                    <?php echo $data_device->topic_publish  ?>
                    <input type="hidden" name="topic" value="<?php echo $data_device->topic_publish  ?>" />
                  </td>
                  <td>
                    <!-- <form action="update_fimware/publish1" method="post" > -->
                      <select name="qos">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                    <!-- </form> -->
                  </td>
                  <td>
                    <!-- <form action="update_fimware/publish" method="post" > -->
                      <select name="file_name">
                          <?php foreach ($file_bin as $data_file): ?>
                        <option value="<?php echo  $data_file->file_name ?>"> <?php echo  $data_file->file_name ?> </option>
                        <?php endforeach; ?>
                      </select>
                      <!-- <input type="submit" value="Submit">
                    </form> -->
                </td>
                <td>
                    <a href="<?php echo site_url('updatefimware/editdeviceiot/'.$data_device->id_device)?>" class="fa fa-edit"></a>
                      <a href="<?php echo site_url('updatefimware/deletedeviceiot/'.$data_device->id_device)?>" class="fa fa-trash-o"></a>
                </td>
                <td>
                      <input type="hidden" name="host_server" value="<?php echo $penguna_data->host_server ?>" />
                      <input type="hidden" name="port_server" value="<?php echo $penguna_data->port_server ?>" />
                      <input type="hidden" name="username_server" value="<?php echo $penguna_data->username_server ?>" />
                      <input type="hidden" name="password_server" value="<?php echo $penguna_data->password_server ?>" />
                   <button type="submit" value="submit" class="btn btn-warning"  >Publish</button>
                   <!-- <input type="submit"  value="Publish" class="btn btn-primary"> -->
                 </td>
               </form>
              </tr>
             <?php endforeach; ?>
             <?php endforeach; ?>

        </table>
      </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
