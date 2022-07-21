<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<style>
    .card.disable {
        opacity: 0.2;
    }
</style>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<div class="page-wrapper" ng-controller="collectionController">
    <div class="container-fluid">
        <div id="content" class="content">
            <div id="content" class="content content-full-width">
                <div class="row el-element-overlay">
                    <?php
                    foreach ($collections as $key => $value) {
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card ">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1"> <img src="<?php echo base_url(); ?>assets/collection/front/<?php echo $value['image']; ?>" alt="user" style="" />
                                        <div class="el-overlay">
                                            <ul class="list-style-none el-info">
                                                <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);" ng-click="viewPhotos('<?php echo "front/" . $value['image']; ?>')"><i class="sl-icon-magnifier"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content" >
                                        <small>ACCESS CODE</small>
                                        <h4 class="m-b-0"><?php echo $value['access_code']; ?></h4> 
                                    </div>
                                    <div class="el-card-item text-center" style="padding: 10px">
                                        <a class="btn btn-md btn-block btn-dark text-light" href="<?php echo site_url("Account/viewCollection/" . $value["id"]); ?>">View Collection</a>
                                        <div class="btn btn-group " style="    display: block;">
                                            <button class="btn btn-md btn-primary text-light" href="" data-toggle="modal" data-target="#viewserialno" ng-click="viewQrcode('<?php echo $value['access_code']; ?>')">View QR</button>
                                            <a class="btn btn-md btn-warning text-light" href="<?php echo site_url("Account/editCollection/" . $value["id"]); ?>">Update</a>

                                        </div>
                                        <button type="button" class="btn btn-danger" ng-click="confirmDelete(<?php echo $value["id"]; ?>)">Remove Collection</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- end #content -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="viewserialno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        <small>Access Code</small>{{selectedcard.code}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                </div>
                <div class="modal-body">
                    <img src="<?php echo site_url("Api/getCardQr"); ?>/{{selectedcard.code}}" style="width:100%;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$this->load->view('layout/footer');
?>
<script>
    Admin.controller('collectionController', function ($scope, $http, $timeout, $interval) {
    $scope.selectedcard = {"code": "123"};
    $scope.viewQrcode = function (code) {
    console.log(code);
    $scope.selectedcard.code = code;
    }
    $scope.confirmDelete = function (remove_id) {
    swal({
    title: "Please confirm",
            text: "Are you sure want to remove this collection?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Remove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: false
    }).then(
            function () {
            window.location = "<?php echo site_url("Account/removeCollection/") ?>" + remove_id;
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