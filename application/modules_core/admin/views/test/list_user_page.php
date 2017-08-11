<?php $this->load->view(admin_dir('template/header')); ?>
<div id="def_body">
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->
            <div id="loader">
                <div class="heading">
                    <h3>User</h3>                    
                </div><!-- End .heading-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <span>User List</span>
                                    <form class="panel-form right" action="">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <span class="icon16 icomoon-icon-cog-2"></span>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" style='width:250px'>
                                            <!--Access Links--> 
                                            <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'add_user')) { ?>
                                                <li><a href="<?php echo admin_url("user/add_user_page"); ?>"><span class="icomoon-icon-plus"></span> Add New User</a></li>
                                            <?php }
                                            ?>
                                        </ul>
                                    </form>
                                </h4>
                            </div><!-- End .panel-heading -->
                            <div id='containerList'></div>	

                        </div><!-- End .panel -->
                    </div><!-- End .span12 -->  
                </div><!-- End .row -->  
                <!-- Page end here -->       
            </div><!-- End #loader -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
</div><!-- End #def_body -->

<script type="text/javascript">
    $(document).ready(function () {
        load_datalist({action: "<?php echo admin_url('user/method/list_user'); ?>"});

        //Link
        $('#containerList').on('click', '.deleteuser', {
            'action': "<?php echo admin_url("user/method/delete_user"); ?>",
            'conMessage': "You are about to delete this user.",
            'redirect': "<?php echo current_url(); ?>"
        }, dfltaction_item);
    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>