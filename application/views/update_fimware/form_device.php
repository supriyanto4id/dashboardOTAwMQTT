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
                <h3 class="box-title">Create Device IoT</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
               <form action="<?php echo $action; ?>" class="form-horizontal" method="post" >
                <div class="box-body">

                  <div class="form-group">
                  <label for="int" class="col-sm-2 control-label">Name Device </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="name device IoT" name="name_device" value="<?php echo $name_device ?>">
                    <p>  <?php echo form_error('name_device') ?></p>
                  </div>

                </div>

                <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Topic to Publish</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="topic to publish" name="topic_publish" value="<?php echo $topic_publish ?>">
                  <p>  <?php echo form_error('topic_publish') ?></p>
                </div>
              </div>
                </div>
                <!-- /.box-body -->
                  <input type="hidden" name="id_device" value="<?php echo $id_device ?>" />
                  <input type="hidden" name="qos" value="<?php echo $qos ?>" />
                <input type="hidden" name="id_penguna" value="<?php echo $id_penguna ?>" />
                <div class="box-footer">
                  <button type="submit" class="btn btn-warning"  ><?php echo $button ?></button>
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
