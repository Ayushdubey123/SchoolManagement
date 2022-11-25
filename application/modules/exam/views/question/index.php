<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-question" style="font-size: 25px"></i><small style="font-size: 25px; font-weight: 600">
                 <!-- <?php echo $this->lang->line('manage_assignment'); ?> -->
                     Question
                 </small></h3>
                <ul class="nav navbar-left panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_assignment_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(!has_permission(ADD, 'exam', 'assignment')){ ?>
                        
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('exam/question/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                 <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_question"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?>
                                 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_assignment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?></a> </li>                          
                        <?php } ?>                
                       
                            <li class="li-class-list">
                            
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?>   
                                
                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){  ?>
                            
                                <?php echo form_open(site_url('exam/question/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="school_id"  onchange="get_class_by_school(this.value, '');">
                                            <option value="">--<?php echo $this->lang->line('select_school'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="filter_class_id" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                         
                                    </select>
                                   <?php echo form_close(); ?>
                                                        
                            <?php }else{  ?>
                                
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_assignment_by_class(this.value);">
                                    <?php if($this->session->userdata('role_id') != STUDENT){ ?>
                                    <option value="<?php echo site_url('exam/question/index'); ?>">--<?php echo $this->lang->line('select'); ?>--</option> 
                                     <?php } ?> 
                                    
                                    <?php foreach($class_list as $obj ){ ?>
                                        <?php if($this->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != $this->session->userdata('class_id')){ continue; } ?> 
                                            <option value="<?php echo site_url('exam/question/index'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif($this->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('exam/question/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif($this->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('exam/question/index'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('exam/question/index'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php } ?>                                            
                                    <?php } ?>                                            
                                </select>                               
                            
                            <?php } ?>
                        </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_assignment_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo $this->lang->line('school'); ?></th>
                                        <?php } ?>
                                         <th><?php echo $this->lang->line('academic_year'); ?></th>
                                    
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th>Question</th>
                                       
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>                                       
                                    <?php $count = 1; if(isset($assignments) && !empty($assignments)){ ?>
                                        <?php foreach($assignments as $obj){ ?>
                                        <?php 
                                            if($this->session->userdata('role_id') == GUARDIAN){
                                                if (!in_array($obj->class_id, $guardian_access_data)){ continue; }
                                            }elseif($this->session->userdata('role_id') == TEACHER){
                                                if (!in_array($obj->class_id, $teacher_access_data)){ continue; }
                                            }
                                        ?> 
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->school_name; ?></td>
                                            <?php } ?>
                                          
                                             <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section; ?></td>
                                            <td><?php echo $obj->subject; ?></td>
                                            <td><?php echo $obj->question; ?></td>
                                           
                                            <td>
                                                
                                             <!--    <?php if(!has_permission(VIEW, 'exam', 'question')){ ?>
                                                    <a  onclick="get_assignment_modal(f<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-assignment-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye" style="font-size:20px"></i>
                                                  <?php echo $this->lang->line('view'); ?>  
                                                 </a>
                                                    <?php if($obj->assignment){ ?>
                                                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $obj->assignment; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
                                                    <?php  } ?>
                                                <?php  } ?> -->

                                                <?php if(!has_permission(EDIT, 'exam', 'question')){ ?>
                                                    <a href="<?php echo site_url('exam/question/edit/'.$obj->id); ?>" class="btn btn-info btn-xs" style="background-color:blue;"><i class="fa fa-pencil-square-o" style="font-size:20px"></i>
                                                    <!--  <?php echo $this->lang->line('edit'); ?>  -->
                                                 </a>
                                                <?php  } ?>
                                                
                                                <?php if(!has_permission(DELETE, 'exam', 'question')){ ?>
                                                    <a href="<?php echo site_url('exam/question/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs" style="background-color:red;"><i class="fa fa-trash-o" style="font-size:20px"></i> 
                                                        <!-- <?php echo $this->lang->line('delete'); ?> -->
                                                         </a>
                                                <?php  } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_question">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('exam/question/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                 <?php $this->load->view('layout/school_list_form'); ?>  
                                

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_term">Term: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                          <select  class="form-control col-md-7 col-xs-12"  name="exam_term"  id="add_exam_term" required="required" >
                                           <option value="">--<?php echo $this->lang->line('select'); ?>--</option>              <option>Demo-1</option>
                                                         <option>Demo-2</option>    <option>Demo-3</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('exam_term'); ?></div>
                                    </div>
                                </div>

                                <!-- 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo $this->lang->line('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>   -->             
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="add_class_id" required="required" onchange="get_subject_by_class(this.value, ''); get_section_by_class(this.value, '');" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                   <?php
                                                    if($this->session->userdata('role_id') == TEACHER){
                                                       if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                    }else if($this->session->userdata('role_id') == GUARDIAN){
                                                        if (!in_array($obj->id, $guardian_access_data)) {continue; }
                                                    } 
                                                    ?>
                                                  <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="add_section_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="subject_id"  id="add_subject_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                
                                <!--  <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deadline"><?php echo $this->lang->line('deadline'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="deadline"  id="add_deadline" value="<?php echo isset($post['deadline']) ?  $post['deadline'] : ''; ?>" placeholder="<?php echo $this->lang->line('deadline'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('deadline'); ?></div>
                                    </div>
                                </div> -->
                                <!-- 
                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('assignment'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file" >
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('assignment'); ?></div>
                                    </div>
                                </div> -->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question">Question <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="question"  id="question" placeholder="<?php echo $this->lang->line('question'); ?>" style="width:50rem;"><?php echo isset($post['question']) ?  $post['question'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('question'); ?></div>
                                    </div>
                                </div>
                               
                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_a">Option A:<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_a"  id="option_a" placeholder="<?php echo $this->lang->line('option_a'); ?>"><?php echo isset($post['option_a']) ?  $post['option_a'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_a'); ?></div>
                                    </div>
                                </div>

                                     <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_b">Option B:<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_b"  id="option_b" placeholder="<?php echo $this->lang->line('option_b'); ?>"><?php echo isset($post['option_b']) ?  $post['option_b'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_b'); ?></div>
                                    </div>
                                </div>


                                     <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_c">Option C:<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_c"  id="option_c" placeholder="<?php echo $this->lang->line('option_c'); ?>"><?php echo isset($post['option_c']) ?  $post['option_c'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_c'); ?></div>
                                    </div>
                                </div>

                                     <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_d">Option D:<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_d"  id="option_d" placeholder="<?php echo $this->lang->line('option_d'); ?>"><?php echo isset($post['option_d']) ?  $post['option_d'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_d'); ?></div>
                                    </div>
                                </div>
                                   
                                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id">Answer: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="demo"  id="demo" required="required" >
                                            <option value="A">A</option>
                                             <option value="B">B</option>          
                                              <option value="C">C</option>
                                              <option value="D">D</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('demo'); ?></div>
                                    </div>
                                </div>
                               


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('assignment/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success" style="background-color:blue;color:white;"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                            <!--     <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('add_assignment_instruction'); ?></div>
                                </div> -->
                            </div>
                        </div>  

                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_assignment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('exam/question/edit/'.$assignment->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <!--  <?php $this->load->view('layout/school_list_edit_form'); ?> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('title'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($assignment->title) ?  $assignment->title : ''; ?>" placeholder="<?php echo $this->lang->line('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div> -->
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="edit_class_id" required="required" onchange="get_subject_by_class(this.value, ''); get_section_by_class(this.value, '');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                    <?php
                                                    if($this->session->userdata('role_id') == TEACHER){
                                                       if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                    } 
                                                    ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($assignment->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="edit_section_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
					
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="subject_id"  id="edit_subject_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                                                                        
                                <!-- <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deadline"><?php echo $this->lang->line('deadline'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="deadline"  id="edit_deadline" value="<?php echo isset($assignment->deadline) ?  date('d-m-Y', strtotime($assignment->deadline)) : ''; ?>" placeholder="<?php echo $this->lang->line('deadline'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('deadline'); ?></div>
                                    </div>
                                </div>
                                 -->
                               <!--  <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Question
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_assignment" id="prev_assignment" value="<?php echo $assignment->assignment; ?>" />
                                        <?php if($assignment->assignment){ ?>
                                            <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $assignment->assignment; ?>"  class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?></a> <br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('assignment'); ?></div>
                                    </div>
                                </div> -->
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question">Question</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="question"  id="edit_note" placeholder="question"><?php echo isset($question->question) ?  $question->question : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('question'); ?></div>
                                    </div>
                                </div>

                                  <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_a">Option-A</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_a"  id="edit_note1" placeholder="question"><?php echo isset($question->option_a) ?  $question->option_a : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_a'); ?></div>
                                    </div>
                                </div>
                                      
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_b">Option-B</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_b"  id="edit_note2" placeholder="question"><?php echo isset($question->option_b) ?  $question->option_b : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_b'); ?></div>
                                    </div>
                                    </div>

                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_c">Option-C</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_c"  id="edit_note3" placeholder="question"><?php echo isset($question->option_c) ?  $question->option_c : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_c'); ?></div>
                                    </div>
                                </div>

                                     <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option_d">Option-D</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="option_d"  id="edit_note4" placeholder="question"><?php echo isset($question->option_d) ?  $question->option_d : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('option_d'); ?></div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($assignment) ? $assignment->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('exam/question/index/'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success" style="background-color:blue;color: white;"><?php echo $this->lang->line('update'); ?></button>
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


<div class="modal fade bs-assignment-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_assignment_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_assignment_modal(assignment_id){
         
        $('.fn_assignment_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('assignment/get_single_assignment'); ?>",
          data   : {assignment_id : assignment_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_assignment_data').html(response);
             }
          }
       });
    }
</script>

  <link href="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.min.js"></script>
 <script type="text/javascript">     
  $('#question').jqte();
  $('#option_a').jqte();
  $('#option_b').jqte();
  $('#option_c').jqte();
  $('#option_d').jqte();
  $('#edit_note').jqte();
  $('#edit_note1').jqte();
  $('#edit_note2').jqte();
  $('#edit_note3').jqte();
  $('#edit_note4').jqte();
  
  </script>

<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>


<!-- Super admin js START  -->
 <script type="text/javascript">
     
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)  && $this->session->userdata('role_id') != TEACHER){ ?>
            $("#edit_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();        
        var class_id = '';
        
        <?php if(isset($edit) && !empty($edit)){ ?>
            class_id =  '<?php echo $assignment->class_id; ?>';           
         <?php } ?> 
        
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select_school'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(class_id){
                       $('#edit_class_id').html(response);   
                   }else{
                       $('#add_class_id').html(response);   
                   }                  
               }
            }
        });
    }); 

  </script>
<!-- Super admin js end -->

 <script type="text/javascript">
     
  $('#add_deadline').datepicker();
  $('#edit_deadline').datepicker();

    
    var edit = false;
    <?php if(isset($edit)){ ?>
        edit = true;
        get_subject_by_class('<?php echo $assignment->class_id; ?>', '<?php echo $assignment->subject_id; ?>');
        get_section_by_class('<?php echo $assignment->class_id; ?>', '<?php echo $assignment->section_id; ?>');
    <?php } ?>
    
    function get_subject_by_class(class_id, subject_id){       
        
        var school_id = '';
        
        <?php if(isset($edit)){ ?>                
            school_id = $('#edit_school_id').val();
         <?php }else{ ?> 
            school_id = $('#add_school_id').val();
         <?php } ?> 
             
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select_school'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
            data   : {school_id:school_id, class_id : class_id , subject_id : subject_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   if(edit){
                        $('#edit_subject_id').html(response);
                   }else{
                        $('#add_subject_id').html(response);
                   }
               }
            }
        });                  
        
   }
   
    function get_section_by_class(class_id, section_id){       
        
        var school_id = '';
        <?php if(isset($edit)){ ?>                
            school_id = $('#edit_school_id').val();
         <?php }else{ ?> 
            school_id = $('#add_school_id').val();
         <?php } ?> 
             
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select_school'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {school_id:school_id, class_id : class_id , section_id : section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   if(edit){
                        $('#edit_section_id').html(response);
                   }else{
                        $('#add_section_id').html(response);
                   }
               }
            }
        });                  
        
   }
   
   
   
   /* Menu Filter Start */
    function get_assignment_by_class(url){          
        if(url){
            window.location.href = url; 
        }
    }
    
    function get_assignment_by_class_sa(class_id){
    
        var school_id = $('#school_id_filter').val();
        if( !school_id){
            
           toastr.error('<?php echo $this->lang->line('select_school'); ?>');
           return false;
        }        
        if(!class_id){
            return false;
        }        
       window.location.href = '<?php echo site_url('assignment/index/'); ?>'+class_id+'/'+school_id; 
        
    }
    
 </script>
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
        
        
    <?php if(isset($filter_class_id)){ ?>
        get_class_by_school('<?php echo $filter_school_id; ?>', '<?php echo $filter_class_id; ?>');
    <?php } ?>
    
    function get_class_by_school(school_id, class_id){   
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id : school_id, class_id : class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#filter_class_id').html(response);                     
               }
            }
        });
    }   

     

        
    $("#add").validate();     
    $("#edit").validate(); 
</script>