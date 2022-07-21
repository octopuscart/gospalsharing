<div class="modal fade" id="viewPhoto" tabindex="-1" role="dialog" aria-labelledby="viewPhoto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <img class="image" style="width:100%" src="<?php echo base_url(); ?>assets/collection/{{initData.selected_photo}}">
            </div>
        </div>
    </div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<div class="chat-windows"></div>
<!-- ============================================================== -->


<!-- All Jquery -->

<!-- apps -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/dist/js/app.init.light-sidebar.js"></script>-->
<script src="<?php echo base_url(); ?>assets/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo base_url(); ?>assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url(); ?>assets/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url(); ?>assets/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/custom.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="<?php echo base_url(); ?>assets/angular/rootController.js"></script>
<script src="<?php echo base_url(); ?>assets/gritter/js/jquery.gritter.js"></script>

<script>
$(function () {
    'use strict';
    $('#main-wrapper').AdminSettings({
        Theme: false, // this can be true or false ( true means dark and false means light ),
        Layout: 'vertical',
        LogoBg: 'skin2', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        NavbarBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        SidebarType: 'full', // You can change it full / mini-sidebar / iconbar / overlay
        SidebarColor: 'skin2', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
        HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
        BoxedLayout: false // it can be true / false ( true means Boxed and false means Fluid )
    });
});

</script>

<script>

    function shortData() {
        let card_indexs = [];
        let card_ids = [];
        $("#sortable .display_index").each(function (i) {
            $(this).html(i + 1);
            card_ids.push(this.id.replace("card_id_", ""));
        });
        console.log(card_indexs, card_ids);
        $("#form_card_id").val(card_ids.join(","));
 
    }
    $(function () {
        shortData();
        $("#sortable").sortable({
            revert: true,
            stop: function () {
                shortData();
                 $("#shoringconfirmbox").show();
            }
        });
       
        $("ul, li").disableSelection();
         $("#shoringconfirmbox").hide();
        $("#cancelreindex").click(function(){
            $("#shoringconfirmbox").hide();
        })
    });
    
    
</script>

</body>
</html>