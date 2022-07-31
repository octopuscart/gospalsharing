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
                            <h3>Story ID: #<?php echo $storyboj["id"] . ", Display No.: " . $storyboj["display_index"]; ?></h3>

                        </td>
                        <td>
                            <a class="btn default btn-outline el-link  " style="float: right;    font-weight: 500;    color: black" href="<?php echo site_url("Story/addStory") ?>"><i class="sl-icon-arrow-left"></i> GO BACK</a>
                        </td>
                    </tr>
                </table>
                <ul class="nav nav-tabs">

                    <?php
                    foreach ($language as $key => $value) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link  <?php echo $value["active"] == 1 ? 'active' : ''; ?>" href="<?php echo site_url("Story/viewStory/" . $storyboj["id"] . "/" . $value["id"]) ?>"><?php echo $value["title"]; ?></a>
                        </li>                       
                        <?php
                    }
                    ?>
                </ul>
                <div class="row mt-2">

                    <div class="col-md-6">
                        <div class="m-r-10 ">
                            <img src="<?php echo $storyboj['image']; ?>" alt="user" class="" width="100%;">
                            <div class="col-md-12 mt-2">
                                <?php echo $content; ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card-body" style="    padding-top: 0px;">
                            <form action="" method="post">
                                <!-- Create the editor container -->
                                <textarea cols="80" id="editor1" required="" name="content" rows="10"  data-sample="1" data-sample-short=""><?php echo $content; ?></textarea>
                                <button type="submit" class="btn btn-success btn-lg mt-3" name="submit">Submit</button>
                            </form>
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
