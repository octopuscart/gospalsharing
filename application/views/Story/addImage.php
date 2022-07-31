<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<div class="page-wrapper" ng-controller="StoryController">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <h4 class="card-title">Story Images</h4>
        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin #content -->
            <!-- begin #content -->
            <div id="content" class="content content-full-width">
                <!-- begin vertical-box -->
                <div class="vertical-box">

                    <!-- begin vertical-box-column -->
                    <div class="vertical-box-column">

                        <!-- begin wrapper -->
                        <div class="wrapper row">
                            <div class="col-md-4">
                                <!-- begin email form -->
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <!-- begin email to -->
                                    <div class="card-body bg-light">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <img id="output" src="<?php echo $imageobj['image']; ?>" style="width:100%;" />
                                                <div class="form-group">
                                                    <label class="control-label col-form-label">Set Story Image</label>
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
                                                <button type="submit" name="submit_data" class="btn btn-primary p-l-40 p-r-40"><?php echo $imageobj["button_title"]; ?></button>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- end email content -->
                                </form>
                                <!-- end email form -->
                            </div>
                            <div class="col-md-8">
                                <div class="row el-element-overlay">
                                    <?php
                                    foreach ($storylist as $key => $value) {
                                        ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card ">
                                                <div class="el-card-item">
                                                    <div class="el-card-avatar el-overlay-1"> <img src="<?php echo $value['image']; ?>" alt="user" style="" />
                                                        <div class="el-overlay">
                                                            <ul class="list-style-none el-info">
                                                                <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);" ng-click="viewPhotos('<?php echo $value['image']; ?>')"><i class="sl-icon-magnifier"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="el-card-item2 text-center" >
                                                        <div class="btn btn-group " style="    display: block;">
                                                            <a class="btn btn-md btn-dark text-light" href="<?php echo site_url("Story/viewStory/" . $value["id"]); ?>"><i class="fa fa-eye"></i> View</a>

                                                            <a class="btn btn-md btn-warning text-light" href="<?php echo site_url("Story/addStory/" . $value["id"]); ?>"><i class="fa fa-edit"></i></a>
                                                            <button type="button" class="btn btn-danger" ng-click="confirmDelete(<?php echo $value["id"]; ?>)"><i class="fa fa-trash"></i></button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
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
    Admin.controller('StoryController', function ($scope, $http, $timeout, $interval) {
    $scope.selectedcard = {"code": "123"};
    $scope.viewQrcode = function (code) {
    console.log(code);
    $scope.selectedcard.code = code;
    }
    $scope.confirmDelete = function (remove_id) {
    swal({
    title: "Please confirm",
            text: "Are you sure want to remove this story?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Remove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: false
    }).then(
            function () {
            window.location = "<?php echo site_url("Story/removeStoryImage") ?>/" + remove_id;
            console.log("yes pressed", remove_id);
            },
            function (dismiss) {
            if (dismiss === 'timer') {

            }
            }
    );
    }


    });
<?php
$checklogin = $this->session->flashdata('checklogin');
if (isset($checklogin['show'])) {
    ?>
        $.gritter.add({
        title: "<?php echo $checklogin['title']; ?>",
                text: "<?php echo $checklogin['text']; ?>",
                image: '<?php echo base_url(); ?>assets/emoji/<?php echo $checklogin['icon']; ?>',
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class '
                    });
    <?php
}
?>

</script>