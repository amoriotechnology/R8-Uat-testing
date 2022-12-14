<!-- Add new customer start -->
<style type="text/css">
    
</style>
    
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo $title ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('permission') ?></a></li>
                <li class="active"><?php echo $title ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message; ?>                   
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

      
        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo $title ?> </h4>
                        </div>
                    </div>
                   
                    <div class="panel-body">

                     <?php echo form_open("Permission/assignrole") ?>
                    <div class="form-group row">
                        <label for="blood" class="col-sm-3 col-form-label">
                            <?php echo display('user') ?> *
                        </label>
                        <div class="col-sm-9">
                            <select  required class="form-control" name="user_id" id="user_type" onchange="userRole(this.value)">
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                foreach($user as $udata){
                                    ?>
                                    <option value="<?php echo $udata['id'] ?>"><?php echo $udata['first_name'].' '.$udata['last_name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                     </div>

                    <div class="form-group row">
                        <label for="blood" class="col-sm-3 col-form-label">
                            <?php echo display('role_name') ?> *
                        </label>
                        <div class="col-sm-9">
                            <select required class="form-control" name="role_id" id="user_type">
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                foreach($user_list as $data){
                                    ?>
                                    <option value="<?php echo $data['id'] ?>"><?php echo $data['type'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                       
                        
                    </div>
               
                        <div class="form-group row text-right">
                              <div class="col-md-12">
                          
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                            </div>
                        </div>
                    <?php echo form_close() ?>
                    </div>
                   <h3><?php echo display('exsisting_role') ?></h3>
                   <table class="table table-striped">
                       <tr>
                       <th>Sno</th>
                       <th>User name</th>
                       <th>role name</th>
                       <th>Remove</th>

                   </tr>
                   <?php 
                        $i=1;
                        if(!empty($assign_list))
                        {
                       foreach($assign_list as $data)
                       {
                        ?>
                   <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['first_name']." ".$data['last_name']; ?></td>
                    <td><?php echo $data['type']; ?></td>
                    <td><a href="<?php echo 'removerole/'.$data['id']; ?>"    onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa fa-trash-o" style="font-size:18px;color:red"></i></a></td>
                    </tr>
               <?php  $i++; } } ?>
                   </table>
                </div>
            </div>
        </div>

    </section>
</div>


