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


<div class="page-wrapper" ng-controller="cardController">
    <div class="container-fluid">
        <div id="content" class="content">
            <div id="content" class="content content-full-width">
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
                            <hr/>
                            <a class="btn btn-dark btn-outline " style="" href="<?php echo site_url("Account/addCard/" . $collectionsobj['id']) ?>"><i class="sl-icon-pencil"></i> ADD CARD</a>

                        </td>
                        <td>
                            <a class="btn default btn-outline el-link  " style="float: right;    font-weight: 500;    color: black" href="<?php echo site_url("Account/getCollection") ?>"><i class="sl-icon-arrow-left"></i> GO BACK</a>

                        </td>
                    </tr>
                </table>
                <div class="row el-element-overlay " id="sortable">
                    <?php
                    foreach ($collectionslist as $key => $value) {
                        ?>
                        <div class="col-lg-2 col-md-6">
                            <div class="card ">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1"> 
                                        <img src="<?php echo base_url(); ?>assets/collection/cards/<?php echo $value['image']; ?>" alt="user" style="" />
                                        <ul class="list-style-none el-info mb-2">
                                            <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);" ng-click="viewDeletePhotos('<?php echo "cards/" . $value['image']; ?>', '<?php echo $value['id']; ?>')"><i class="sl-icon-magnifier"></i></a></li>
                                        </ul>
                                        <div class="mt-4">
                                            <button class="btn btn-danger" ng-click="confirmDelete(<?php echo $value['id']; ?>, <?php echo $ccollection_id; ?>)">Remove Card</button>
                                        </div>
                                        <div class="mt-2">
                                            <p>Display Index:<span class="display_index" id="card_id_<?php echo $value['id']; ?>"></span></p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="panel panel-default" id="shoringconfirmbox">
                    <div class="panel-body">
                        <form action="#" method="post">
                            <input type="hidden" name="card_id" value="" id="form_card_id"/>

                            <button type="submit" class="btn btn-warning" id="reindex" name="reindex"><span aria-hidden="true"><i class="fa fa-indent"></i></span> Confirm Sorting</button>
                            <button type="button" class="btn btn-default" id="cancelreindex" ><span aria-hidden="true"><i class="fa fa-close"></i></span> Cancel</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewPhotoEdit" tabindex="-1" role="dialog" aria-labelledby="viewPhoto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <img class="image" style="width:100%" src="<?php echo base_url(); ?>assets/collection/{{initDataDelete.selected_photo}}">
                </div>
            </div>
        </div>
    </div>
</div>



<?php
$this->load->view('layout/footer');
?>
<script>
    Admin.controller('cardController', function ($scope, $http, $timeout, $interval) {


    $scope.initDataDelete = {"selected_photo": "cards/background.jpg", "card_id": 0};
    $scope.viewDeletePhotos = function (photourl, card_id) {
    $scope.initDataDelete.selected_photo = photourl;
    $("#viewPhotoEdit").modal("show");
    }



    $scope.confirmDelete = function (remove_id, collection_id) {
    swal({
    title: "Please confirm",
            text: "Are you sure want to remove this card?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Remove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: false
    }).then(
            function () {
            window.location = "<?php echo site_url("Account/removeCollectionCard/") ?>" + remove_id + "/" + collection_id;
            console.log("yes pressed", remove_id);
            },
            function (dismiss) {
            if (dismiss === 'timer') {

            }
            }
    );
    }
    });

</script>
