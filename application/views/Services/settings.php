<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />



<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/table-manage-default.demo.min.js"></script>
<style>
    .product_text {
        float: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width:350px
    }
    .product_title {
        font-weight: 700;
    }
    .price_tag{
        float: left;
        width: 100%;
        border: 1px solid #222d3233;
        margin: 2px;
        padding: 0px 2px;
    }
    .price_tag_final{
        width: 100%;
    }

    .exportdata{
        margin: 15px 0px 0px 0px;
    }
</style>
<!-- Main content -->




<div class="page-wrapper" >
    <div class="container-fluid">
        <div id="content" class="content">
            <div id="content" class="content content-full-width">
                <div class="">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h3 class="panel-title">App Settings</h3>
                        </div>
                        <div class="box-body">
                            <!-- Tab panes -->
                            <div class="">

                                <div class="" style="padding:20px">
                                    <table class="table">
                                        <?php
                                        foreach ($settings as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $value["title"]; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="attr_value" value="<?php echo $value["data"]["attr_value"]; ?>"  />
                                                                <input type="hidden" class="form-control" name="attr_type" value="<?php echo $value["data"]["attr_type"]; ?>"  />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button type="submit" name="submit" class="btn btn-danger">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>



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
    $(function () {

        $('#tableDataOrder').DataTable({
            language: {
                "search": "Apply filter _INPUT_ to table"
            }
        })
    })

</script>