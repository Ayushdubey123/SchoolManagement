<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-user-md" style="font-size: 25px"></i>&nbsp;<small style="font-size: 25px;font-weight: 600"> 
                    <!-- <?php echo $this->lang->line('manage_designation'); ?> -->
                        Designation
                    </small></h3>
                <ul class="nav navbar-left panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- <div class="x_content quick-link">
               <?php $this->load->view('quick-link'); ?>          
            </div> -->
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_designation_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'hrm', 'designation')){ ?>
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('hrm/designation/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_designation"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_designation"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?></a> </li>                          
                        <?php } ?>   
                            
                        <!-- <li class="li-class-list">
                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                             <select  class="form-control col-md-7 col-xs-12" onchange="get_designation_by_school(this.value);">
                                     <option value="<?php echo site_url('hrm/designation/index'); ?>">--<?php echo $this->lang->line('select_school'); ?>--</option> 
                                 <?php foreach($schools as $obj ){ ?>
                                     <option value="<?php echo site_url('hrm/designation/index/'.$obj->id); ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                 <?php } ?>   
                             </select>
                         <?php } ?>  
                         </li> -->   
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_designation_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo $this->lang->line('school_name'); ?></th>
                                        <?php } ?>
                                        <th><?php echo $this->lang->line('designation'); ?></th>
                                        <th><?php echo $this->lang->line('note'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($designations) && !empty($designations)){ ?>
                                        <?php foreach($designations as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->school_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $obj->note; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'hrm', 'designation')){ ?>
                                                    <a href="<?php echo site_url('hrm/designation/edit/'.$obj->id); ?>" class="btn btn-info btn-xs" style="background-color:blue;"><i class="fa fa-pencil-square-o" style="font-size:20px"></i> 
                                                       <!--  <?php echo $this->lang->line('edit'); ?> -->
                                                         </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'hrm', 'designation')){ ?>
                                                    <a href="<?php echo site_url('hrm/designation/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs" style="background-color:red;"><i class="fa fa-trash-o" style="font-size:20px"></i> 
                                                        <!-- <?php echo $this->lang->line('delete'); ?> -->
                                                         </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_designation">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('hrm/designation/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('designation'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($name) ?  $name : ''; ?>" placeholder="<?php echo $this->lang->line('designation'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($note) ?  $note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a  href="<?php echo site_url('hrm/designation/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success" style="background-color:blue"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_designation">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('hrm/designation/edit/'.$designation->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_edit_form'); ?> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('designation'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                        <input  class="form-control col-md-7 col-xs-12"  name="name" value="<?php echo isset($designation) ? $designation->name : ''; ?>"  placeholder="<?php echo $this->lang->line('designation'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($designation) ? $designation->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($designation) ? $designation->id : ''; ?>" name="id" />
                                        <a href="<?php echo site_url('hrm/designation/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true,              
              responsive: true
          });
        });
        
    $("#add").validate();     
    $("#edit").validate();    
    
    
    function get_designation_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
    
</script>