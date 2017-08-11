<?php $this->load->view(admin_dir('template/header'), $js_files); ?>
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">
            <h3>Departments</h3>                    
        </div><!-- End .heading-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <span>Department List</span>
                            <form class="panel-form right" action="">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="icon16 icomoon-icon-cog-2"></span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style='width:250px'>
                                    <!-- Access Links -->
                                    <?php if ($this->Misc->accessible($this->access, 'departments', 'method', 'add_department')) { ?>
                                        <li><a data-toggle="modal" href="#dfltmodal" class="add_department"><span class="icomoon-icon-plus"></span> Add New Department</a></li>
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
    </div><!-- End contentwrapper -->
</div><!-- End #content -->
<?php $this->load->view(admin_dir('template/footer')); ?>