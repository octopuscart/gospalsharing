<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>

<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<style>
    .story-content{
        height:250px;
        width: 100%;
        overflow-y: auto;
    }
</style>

<div class="page-wrapper" ng-controller="cardController">
    <div class="container-fluid">
        <div id="content" class="content">
            <div id="content" class="content content-full-width">

                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            <?php
                            foreach ($language as $key => $value) {
                                ?>
                                <a class="list-group-item   <?php echo $value["active"] == 1 ? 'active' : ''; ?>" href="<?php echo site_url("Story/appViewStory/" . $value["id"]) ?>"><?php echo $value["title"]; ?></a>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                foreach ($storylist as $stkey => $stvalue) {
                                    ?>
                                    <div class="carousel-item <?php echo $stkey == 0 ? 'active' : ''; ?>">
                                        <div class="card">
                                            <div class="row" style="margin:0px;">
                                                <img class="d-block w-100" src="<?php echo $stvalue["image"]; ?>" alt="First slide">
                                                <div class="col-md-12 mt-1">
                                                    <a href="<?php echo site_url("Story/viewStory/".$stvalue["id"]."/".$lenguage_id);?>" class="btn btn-danger pull-right" style="    float: right;"><i class="fa fa-edit"></i> Update Story</a>
                                                </div>
                                                <div class="col-md-12 mt-2 story-content" >
                                                    <?php echo $stvalue["content"] ? $stvalue["content"] : "<p class='no-content'>No Content</p>"; ?>
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


                    <div class="col-md-2">
                        <div class="btn btn-group">
                            <a class="btn btn-primary" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="btn btn-primary" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
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
