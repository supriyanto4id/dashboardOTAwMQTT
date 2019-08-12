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

    <div class="row">
      <div class="col-md-6">
        <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Setting Host Server MQTT</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
               <form action="<?php echo $action; ?>" class="form-horizontal" method="post" >
                <div class="box-body">

                  <div class="form-group">
                  <label for="int" class="col-sm-2 control-label">Host </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="dns server mqtt / ip server mqtt" name="host_server" value="<?php echo $host_server ?>">
                    <p>  <?php echo form_error('host_server') ?></p>
                  </div>

                </div>

                <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Port</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Port" name="port_server" value="<?php echo $port_server ?>">
                  <p>  <?php echo form_error('port_server') ?></p>
                </div>
              </div>
              <div class="form-group">
                  <label for="int" class="col-sm-2 control-label">Username </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Username" name="username_server" value="<?php echo $username_server?>">
                    <p>  <?php echo form_error('username_server') ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Password" name="password_server" value="<?php  echo $password_server?>">
                    <p>  <?php echo form_error('password_server') ?></p>
                  </div>
                </div>

                </div>
                <!-- /.box-body -->
                <input type="hidden" name="id_penguna" value="<?php echo $id_penguna; ?>" />
                <div class="box-footer">
                  <button type="submit" class="btn btn-warning"  >Update</button>
                  <a href="<?php echo site_url('updatefimware') ?>" class="btn btn-primary">Cancel</a>
                  <!-- <a href="<?php echo site_url('updatefimware/update_action/'.$id_penguna)?>" class="btn btn-default">Update</a> -->
                </div>
              </form>

            </div>
            <!-- /.box -->
      </div>
    </div>





  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
