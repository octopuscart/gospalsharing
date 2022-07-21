<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin #content -->
            <!-- begin #content -->
            <div id="content" class="content content-full-width">
                <!-- begin vertical-box -->
                <div class="vertical-box">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10">
                                        <img src="<?php echo base_url(); ?>assets/collection/front/<?php echo $collectionsobj['image']; ?>" alt="user" class="" width="45">
                                    </div>
                                    <div class="m-l-10" style="margin-left: 10px;">
                                        <h4 class="m-b-0 font-16"><?php echo $collectionsobj['title']; ?></h4>
                                        <span style="font-size: 10px;"><?php echo $collectionsobj['access_code']; ?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn default btn-outline el-link  " style="float: right;    font-weight: 500;    color: black" href="<?php echo site_url("Account/getCollection") ?>"><i class="sl-icon-arrow-left"></i> GO BACK</a>
                            </td>
                        </tr>
                    </table>
                    <!-- begin vertical-box-column -->
                    <div class="vertical-box-column">

                        <!-- begin wrapper -->
                        <div class="wrapper">
                            <div class="col-md-8">
                                <!-- begin email form -->
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <!-- begin email to -->
                                    <div class="card-body ">
                                        <h4 class="card-title">Add New Card</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img id="output" src="<?php echo base_url(); ?>assets/collection/cards/background.jpg" style="height:200px;" />



                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-form-label">Set Card Image</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name='picture' accept="image/*" onchange="loadFile(event)">
                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit_data" class="btn btn-primary p-l-40 p-r-40">Add New Card</button>
                                            </div>
                                        </div>

                                    </div>


                                    <!-- end email content -->
                                </form>
                                <!-- end email form -->
                            </div>
                        </div>
                        <!-- end wrapper -->
                    </div>
                    <!-- end vertical-box-column -->
                </div>
                <!-- end vertical-box -->
            </div>
            <!-- end #content -->
        </div>
    </div>
</div>

<?php
$this->load->view('layout/footer');
?>
<script>
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>