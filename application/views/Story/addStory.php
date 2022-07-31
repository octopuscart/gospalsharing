<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>

<!-- ================== BEGIN PAGE CSS STYLE ================== -->


<div class="page-wrapper" ng-controller="cardController">
    <div class="container-fluid">
        <div id="content" class="content">
            <div id="content" class="content content-full-width">
                <table class="table">
                    <tr>
                        <td>
                            <div class="border-bottom title-part-padding">
                                <h4 class="card-title mb-3">Write Content - <?php echo $active_language["title"]; ?></h4>
                            </div>
                        </td>
                        <td>
                            <a class="btn default btn-outline el-link  " style="float: right;    font-weight: 500;    color: black" href="<?php echo site_url("Story/addStory") ?>"><i class="sl-icon-arrow-left"></i> GO BACK</a>
                        </td>
                    </tr>
                </table>
                  <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="m-r-10 card">
                                <img id="output" src="<?php echo $imageobj['image']; ?>" style="width:100%;" />
                                <div class="col-md-12">
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
                                </div>
                            </div>

                        </div>

                        <div class="col-md-7">

                            <div class="card-body" style="    padding-top: 0px;">

                                <!-- Create the editor container -->
                                <textarea cols="80" id="editor1" required="" name="content" rows="10"  data-sample="1" data-sample-short=""></textarea>
                                <button type="submit" class="btn btn-success btn-lg mt-3" name="submit">Add Story</button>

                            </div>
                        </div>

                    </div>
                </form>
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
