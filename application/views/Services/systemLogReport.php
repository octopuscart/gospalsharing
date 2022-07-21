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


<?php

function userReportFunction($users) {
    ?>
    <table id="tableDataOrder" class="table table-bordered table-striped" style='width:100%'>
        <thead>
            <tr>
                <th style="width: 20px;">S.N.</th>
                <th style="width:250px;">Activity Type</th>
                <th >Details</th>
                <th style="width: 280px;">Date Time </th>

                        <!--                <th style="width: 75px;">Edit</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($users)) {

                $count = 1;
                foreach ($users as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>



                        <td>
                            <?php echo $value->log_type; ?>
                        </td>

                        <td>
                            <?php echo $value->log_detail; ?>
                        </td>
                        <td>
                            <?php echo $value->log_datetime; ?>
                        </td>



                    </tr>
                    <?php
                    $count++;
                }
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>

<div class="page-wrapper" >
    <div class="container-fluid">
        <div id="content" class="content">
            <div id="content" class="content content-full-width">
                <div class="">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h3 class="panel-title">System Log Reports</h3>
                        </div>
                        <div class="box-body">
                            <!-- Tab panes -->
                            <div class="">

                                <div class="" style="padding:20px">
                                    <?php userReportFunction($systemlog); ?>
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