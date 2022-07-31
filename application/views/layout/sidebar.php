<?php
$userdata = $this->session->userdata('logged_in');
if ($userdata) {
    
} else {
    redirect("Authentication/index", "refresh");
}
$menu_control = array();

$order_menu = array(
    "title" => "Story Images",
    "icon" => "icon-Receipt-4",
    "active" => "",
    "sub_menu" => array(
        "Add Story" => site_url("Story/addStory"),
        "View Stories" => site_url("Story/appViewStory"),
        "Add Image" => site_url("Story/addImage"),
    ),
);
array_push($menu_control, $order_menu);

$order_menu = array(
    "title" => "Story Language",
    "icon" => "mdi mdi-translate",
    "active" => "",
    "sub_menu" => array(
        "Settings" => site_url("Story/languageSetting"),
    ),
);
array_push($menu_control, $order_menu);

//array_push($menu_control, $user_menu);

$setting_menu = array(
    "title" => "Settings",
    "icon" => "ti-settings",
    "active" => "",
    "sub_menu" => array(
        "System Log" => site_url("Services/systemLogReport"),
    ),
);

array_push($menu_control, $setting_menu);

foreach ($menu_control as $key => $value) {
    $submenu = $value['sub_menu'];
    foreach ($submenu as $ukey => $uvalue) {
        if ($uvalue == current_url()) {
            $menu_control[$key]['active'] = 'active';
            break;
        }
    }
}
?>
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="<?php echo base_url(); ?>assets/assets/images/users/icon.png" alt="users" class="rounded-circle img-fluid" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium"><?php echo $userdata['first_name']; ?> <?php echo $userdata['last_name']; ?></h5>
                            <a href="<?php echo site_url("profile") ?>" title="Profile" class="btn btn-circle btn-sm">
                                <i class="ti-settings"></i>
                            </a>
                            &nbsp;
                            <a href="<?php echo site_url("Authentication/logout") ?>" title="Logout" class="btn btn-circle btn-sm">
                                <i class="ti-power-off"></i>
                            </a>

                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->

<?php foreach ($menu_control as $mkey => $mvalue) { ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark <?php echo $mvalue['active']; ?>" href="javascript:void(0)" aria-expanded="false">
                            <i class="<?php echo $mvalue['icon']; ?>"></i>
                            <span class="hide-menu"><?php echo $mvalue['title']; ?> </span>
                        </a>

                        <ul aria-expanded="false" class="collapse  first-level <?php echo $mvalue['active'] == 'active' ? 'in' : ''; ?>">
                    <?php
                    $submenu = $mvalue['sub_menu'];
                    foreach ($submenu as $key => $value) {
                        ?>
                                <li class="sidebar-item">
                                    <a href="<?php echo $value; ?>" class="sidebar-link">
                                        <i class="mdi mdi-book-multiple"></i>
                                        <span class="hide-menu"> <?php echo $key; ?> </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
<?php } ?>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
