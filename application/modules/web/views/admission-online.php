
<!-- <section class="page-breadcumb-area bg-with-black">
    <div class="container text-center">
        <h2 class="title">Online Admission</h2>
        <ul class="links">
            
         
        </ul>
    </div>
</section> -->

<section>
    <div class="container text-center">        
        <?php $this->load->view('layout/message'); ?> 
    </div>
</section>

<section class="page-contact-area">
    <div class="container">
        <form action="<?php echo site_url('admission-online'); ?>" method="post" id="admission" name="admission" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="admission-form">
                    <!-- <div class="row"> 
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="admission-address">
                             
                                
                                <div><h3><?php echo $school->school_name; ?></h3>  </div>                                
                                <div><?php echo $school->address; ?></div>
                                <div><?php echo $school->phone; ?></div>
                                <div><?php echo $school->email; ?></div>
                                <div><h4>Online Admission</h4></div>
                            </div>
                        </div>                        
                    </div> -->
                    <div class="row"> 

                        <div class="col-md-4 col-sm-4 col-xs-4 " style="padding-left: 10rem;padding-top:4rem;">
                    <div class="logo">
                        <a href="#">
                            <?php if(isset($school->frontend_logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt=""  />
                            <?php }elseif(isset($school->logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt=""  />
                            <?php }else{ ?>
                                <img  width="100" height="100" src="<?php echo IMG_URL; ?>/sms-logo.png">
                            <?php } ?>    
                        </a>
                    </div>
                        
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 " style="padding-right: 50px;padding-top:4rem;">
                            <div class="admission-address">
                             
                                
                                <div><h3><?php echo $school->school_name; ?></h3>  </div>                                
                                <div><?php echo $school->address; ?></div>
                                <div><?php echo $school->phone; ?></div>
                                <div><?php echo $school->email; ?></div>
                               
                            </div>
                        </div>                        
    </div>

    <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="admission-address">   
             <div><h1 style="font-size: 30px;line-height: 40px;font-weight: 800;letter-spacing: 0;margin-top: 10px;">Admission Form</h1></div>
             </div>
             </div>
        </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><hr></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Basic Information:</strong></p> </div>
                    </div>                     
                      
                    <div class="row">                  
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="name">Name<span class="required">*</span></label>
                                <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="Name" required="required" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('name'); ?></div> 
                            </div>
                        </div>                     
                        <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                <label  for="dob">Birth Date<span class="required">*</span></label>
                                <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="dob" value="<?php echo isset($post['dob']) ?  $post['dob'] : ''; ?>" placeholder="Birth Date" required="required" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('dob'); ?></div>
                             </div>
                        </div>

                         <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                 <label for="gender">Gender<span class="required">*</span></label>
                                  <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                    <option value="">Select</option>
                                   <!--  <?php $genders = get_genders(); ?>
                                    <?php foreach($genders as $key=>$value){ ?>
                                        <option value="<?php echo $key; ?>" <?php echo isset($post['gender']) && $post['gender'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                    <?php } ?> -->
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="help-block"><?php echo form_error('gender'); ?></div>
                             </div>
                         </div>

                         <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                 <label for="blood_group">BLood Group</label>
                                  <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                    <option value="">--Select--</option>
                                    <!-- <?php $bloods = get_blood_group(); ?>
                                    <?php foreach($bloods as $key=>$value){ ?>
                                        <option value="<?php echo $key; ?>" <?php echo isset($post['blood_group']) && $post['blood_group'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                    <?php } ?> -->
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    </select>
                                <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                             </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                  <label for="religion">Religion</label>
                                  <!-- <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="add_religion" value="<?php echo isset($post['religion']) ?  $post['religion'] : ''; ?>" placeholder="Religion" type="text" autocomplete="off"> -->
                                  <select class="form-control col-md-7 col-xs-12"  name="religion"  id="add_religion" style="font-size:1.5rem;">
                                      <option value="">-- select one --</option>
                                      <option value="Hinduism">Hinduism</option>
                                      <option value="Islam">Islam</option>
                                      <option value="Jainism">Jainism</option>
                                      <option value="Buddhism">Buddhism</option>
                                      <option value="Sikhism">Sikhism</option>
                                       <option value="Christianity">Christianity</option>
                                         <option value="Other">Other</option>
                                      
                                  </select>
                                   <div class="help-block"><?php echo form_error('religion'); ?></div>
                             </div>
                         </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                  <label for="caste">Caste</label>
                                  <!-- <input  class="form-control col-md-7 col-xs-12"  name="caste"  id="add_caste" value="<?php echo isset($post['caste']) ?  $post['caste'] : ''; ?>" placeholder="Caste" type="text" autocomplete="off"> -->
                                  <select class="form-control col-md-7 col-xs-12" name="caste"  id="add_caste">
                                      <option value="">--Select--</option>
                                      <option value="GEN">GEN</option>
                                      <option value="SC">SC</option>
                                      <option value="ST">ST</option>
                                      <option value="OBC">OBC</option>
                                      
                                  </select>
                                   <div class="help-block"><?php echo form_error('caste'); ?></div>
                             </div>
                         </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group">
                           <label for="email">Email</label>
                           <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="Email" type="email" autocomplete="off">
                           <div class="help-block"><?php echo form_error('email'); ?></div>
                        </div>
                    </div>                       
                       
                     <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="item form-group">
                             <label for="phone">Phone<span class="required">*</span></label>
                             <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="Phone" required="required" type="text" autocomplete="off">
                             <div class="help-block"><?php echo form_error('phone'); ?></div>
                         </div>
                     </div>

                     <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="item form-group">
                             <label for="national_id">National ID</label>
                             <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($post['national_id']) ?  $post['national_id'] : ''; ?>" placeholder="National ID" type="text" autocomplete="off">
                             <div class="help-block"><?php echo form_error('national_id'); ?></div>
                         </div>
                     </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="health_condition">Health Condition</label>
                               <input  class="form-control col-md-7 col-xs-12"  name="health_condition"  id="health_condition" value="" placeholder="Health Condition" type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('health_condition'); ?></div>
                            </div>
                        </div>  
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="photo">Photo</label>
                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                <div class="text-info" style="font-size: 9px;"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                <div class="help-block"><?php echo form_error('photo'); ?></div>
                            </div>
                        </div>
                    </div>
                                          
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Academic Information:</strong></p> </div>
                    </div>
                    <div class="row">                                      
                         <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                 <label for="type_id">Student Type</label>
                                 <select  class="form-control col-md-7 col-xs-12 quick-field" name="type_id" id="add_type_id">
                                    <option value="">--Select--</option>
                                    <?php foreach($types as $obj){ ?>
                                        <option value="<?php echo $obj->id; ?>" <?php echo isset($post['type_id']) && $post['type_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->type; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block"><?php echo form_error('type_id'); ?></div>
                             </div>
                         </div>                        
                         <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                 <label for="class_id">Class<span class="required">*</span></label>
                                 <select  class="form-control col-md-7 col-xs-12 quick-field" name="class_id" id="add_class_id" required="required" onchange="get_section_by_class(this.value, '');">
                                    <option value="">--Select--</option>
                                    <?php foreach($classes as $obj){ ?>
                                        <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block"><?php echo form_error('class_id'); ?></div>
                             </div>
                         </div>                        
                         <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                <label for="group">Group</label>
                                <select  class="form-control col-md-7 col-xs-12" name="group" id="group">
                                    <option value="">--Select--</option>
                                    <!-- <?php $groups = get_groups(); ?>
                                    <?php foreach($groups as $key=>$value){ ?>
                                        <option value="<?php echo $key; ?>" <?php echo isset($post['group']) && $post['group'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                    <?php } ?> -->
                                    <option value="Science">Science</option>
                                    <option value="Art">Art</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="School">School</option>
                                </select>
                                <div class="help-block"><?php echo form_error('group'); ?></div>
                             </div>
                         </div>                   
                         <div class="col-md-3 col-sm-3 col-xs-12">
                             <div class="item form-group">
                                <label for="second_language">Second Language</label>
                                <input  class="form-control col-md-7 col-xs-12"  name="second_language"  id="second_language" value="<?php echo isset($post['second_language']) ?  $post['second_language'] : ''; ?>" placeholder="Second Language" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('second_language'); ?></div>
                             </div>
                         </div>
                    </div>                
                    
                          <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Father Information:</strong></p> </div>
                    </div>
                     <div class="row">  
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="father_name">Father Name <span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="father_name"  id="father_name" value="<?php echo isset($post['father_name']) ?  $post['father_name'] : ''; ?>" placeholder="Father Name" type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('father_name'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="father_phone">Father Phone <span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="father_phone"  id="father_phone" value="<?php echo isset($post['father_phone']) ?  $post['father_phone'] : ''; ?>" placeholder="Father Phone"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('father_phone'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="father_education">Father Education <span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="father_education"  id="father_education" value="<?php echo isset($post['father_education']) ?  $post['father_education'] : ''; ?>" placeholder="Father Education"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('father_education'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="father_profession">Father Profession<span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="father_profession"  id="father_profession" value="<?php echo isset($post['father_profession']) ?  $post['father_profession'] : ''; ?>" placeholder="Father Profession"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('father_profession'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="father_designation">Father Designation <span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="father_designation"  id="father_designation" value="<?php echo isset($post['father_designation']) ?  $post['father_designation'] : ''; ?>" placeholder="Father Designation"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('father_designation'); ?></div>
                            </div>
                        </div>                        
                   </div>
                                            
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Mother Information:</strong></p> </div>
                    </div>
                    <div class="row">  
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="mother_name">Mother Name <span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="mother_name"  id="mother_name" value="<?php echo isset($post['mother_name']) ?  $post['mother_name'] : ''; ?>" placeholder="Mother Name" type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('mother_name'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="mother_phone">Mother Phone <span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="mother_phone"  id="mother_phone" value="<?php echo isset($post['mother_phone']) ?  $post['mother_phone'] : ''; ?>" placeholder="Mother Phone"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('mother_phone'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="mother_education">Mother Education<span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="mother_education"  id="mother_education" value="<?php echo isset($post['mother_education']) ?  $post['mother_education'] : ''; ?>" placeholder="Mother Education"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('mother_education'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="mother_profession">Mother Profession<span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="mother_profession"  id="mother_profession" value="<?php echo isset($post['mother_profession']) ?  $post['mother_profession'] : ''; ?>" placeholder="Mother Profession"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('mother_profession'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                               <label for="mother_designation">Mother Designation<span class="required">*</span></label>
                               <input  class="form-control col-md-7 col-xs-12"  name="mother_designation"  id="mother_designation" value="<?php echo isset($post['mother_designation']) ?  $post['mother_designation'] : ''; ?>" placeholder="Mother Designation"  type="text" autocomplete="off">
                               <div class="help-block"><?php echo form_error('mother_designation'); ?></div>
                            </div>
                        </div>                        
                   </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Guardian Information:</strong></p> </div>
                    </div>  
                    
                       
                    <div class="row"> 
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="is_guardian">Is Guardian<span class="required">*</span></label>
                                <select  class="form-control col-md-7 col-xs-12 quick-field" name="is_guardian" id="is_guardian" required="required" onchange="check_guardian_type(this.value);">
                                    <option value="">--Select--</option>
                                    <option value="father" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'father' ?  'selected="selected"' : ''; ?>>Father</option>
                                    <option value="mother" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'mother' ?  'selected="selected"' : ''; ?>>Mother</option>
                                     <option value="brother" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'brother' ?  'selected="selected"' : ''; ?>>Brother</option>
                                      <option value="sister" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'sister' ?  'selected="selected"' : ''; ?>>Sister</option>
                                    <option value="other" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'other' ?  'selected="selected"' : ''; ?>>Other</option>
                                    <option value="exist_guardian" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'exist_guardian' ?  'selected="selected"' : ''; ?>>Guardian exist</option>
                                </select>
                                <div class="help-block"><?php echo form_error('is_guardian'); ?></div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_phone">Phone<span class="required">*</span></label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_phone"  id="gud_phone" value="<?php echo isset($post['gud_phone']) ?  $post['gud_phone'] : ''; ?>" placeholder="Phone" required="required" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('gud_phone'); ?></div>
                                <input type="hidden" name="guardian_id" id="guardian_id" value="" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 fn_existing_guardian <?php if(isset($post['guardian_id']) && $post['guardian_id'] == 'exist_guardian'){ ''; }else{ echo 'display'; } ?>">
                            <div class="item form-group">
                                <label style="width: 100%;margin-bottom: 0;">&nbsp;</label>
                                <button  class="btn btn-info glbscl-link-btn btn-xs"  name="find"  id="fn_find" type="button">Find Guardian By Phone</button>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_relation">Relation with Guardian</label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_relation"  id="relation_with" value="<?php echo isset($post['relation_with']) ?  $post['relation_with'] : ''; ?>" placeholder="Relation with Guardian" type="text">
                                <div class="help-block"><?php echo form_error('gud_relation'); ?></div>
                            </div>
                        </div> 
                    </div> 
                                   
                                
                    
                    <div class="row">                                        
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_name">Name<span class="required">*</span></label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_name"  id="gud_name" value="<?php echo isset($post['gud_name']) ?  $post['gud_name'] : ''; ?>" placeholder="Name" required="required" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('gud_name'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_email">Email<span class="required">*</span></label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_email"  id="gud_email" value="<?php echo isset($post['gud_email']) ?  $post['gud_email'] : ''; ?>" placeholder="Email" required="required email" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('gud_email'); ?></div>
                            </div>
                        </div>
                        <!--<div class="col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="item form-group">-->
                        <!--        <label for="gud_national_id">National ID</label>-->
                        <!--        <input  class="form-control col-md-7 col-xs-12"  name="gud_national_id"  id="gud_national_id" value="<?php echo isset($post['gud_national_id']) ?  $post['gud_national_id'] : ''; ?>" placeholder="National ID" type="text" autocomplete="off">-->
                        <!--        <div class="help-block"><?php echo form_error('gud_national_id'); ?></div>-->
                        <!--    </div>-->
                        <!--</div>                        -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_profession">Profession</label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_profession"  id="gud_profession" value="<?php echo isset($post['gud_profession']) ?  $post['gud_profession'] : ''; ?>" placeholder="Profession" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('gud_profession'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_religion">Religion</label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_religion"  id="gud_religion" value="<?php echo isset($post['gud_religion']) ?  $post['gud_religion'] : ''; ?>" placeholder="Religion" type="text" autocomplete="off">
                                <div class="help-block"><?php echo form_error('gud_religion'); ?></div>
                            </div>
                        </div>                        
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group">
                                <label for="other_info">Other Info</label>
                                <input  class="form-control col-md-7 col-xs-12"  name="gud_other_info"  id="add_gud_other_info" value="<?php echo isset($post['gud_other_info']) ?  $post['gud_other_info'] : ''; ?>" placeholder="Other Info"  type="text">
                                <div class="help-block"><?php echo form_error('gud_other_info'); ?></div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">  
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_present_address">Present Address</label>
                                <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_present_address"  id="gud_present_address"  placeholder="Present Address"><?php echo isset($post['gud_present_address']) ?  $post['gud_present_address'] : ''; ?></textarea>
                                <div class="help-block"><?php echo form_error('gud_present_address'); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="item form-group">
                                <label for="gud_permanent_address">Permanent Address</label>
                                <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_permanent_address"  id="gud_permanent_address"  placeholder="Permanent Address"><?php echo isset($post['gud_permanent_address']) ?  $post['gud_permanent_address'] : ''; ?></textarea>
                                <div class="help-block"><?php echo form_error('gud_permanent_address'); ?></div>
                            </div>
                        </div>
                    </div>
                   
                        
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <p class="admission-form-title">
                                <strong>Address Infromation:</strong>
                               Same as Guarduan Address<input  class=""  name="same_as_guardian"  id="same_as_guardian" value="1"  type="checkbox" <?php echo isset($post['same_as_guardian']) ?  'checked="checked"' : ''; ?>>
                            </p> 
                        </div>
                    </div>  
                    <div class="row">   
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="item form-group">
                                <label for="present_address">Present Address</label>
                                 <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address"  placeholder="Present Address"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                 <div class="help-block"><?php echo form_error('present_address'); ?></div>
                            </div>
                        </div>                                    
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="item form-group">
                               <label for="permanent_address">Permanent Address</label>
                               <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address"  placeholder="Permanent Address"><?php echo isset($post['permanent_address']) ?  $post['permanent_address'] : ''; ?></textarea>
                               <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                            </div>
                        </div>
                   </div>

                    
                    <!--<div class="row">-->
                    <!--    <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Previous School:</strong></p> </div>-->
                    <!--</div>-->
                    <!--<div class="row"> -->
                    <!--    <div class="col-md-3 col-sm-3 col-xs-12">-->
                    <!--         <div class="item form-group">-->
                    <!--            <label for="previous_school">School Name</label>-->
                    <!--            <input  class="form-control col-md-7 col-xs-12"  name="previous_school"  id="previous_school" value="<?php echo isset($post['previous_school']) ?  $post['previous_school'] : ''; ?>" placeholder="School Name"  type="text" autocomplete="off">-->
                    <!--            <div class="help-block"><?php echo form_error('previous_school'); ?></div>-->
                    <!--         </div>-->
                    <!--     </div>-->
                    <!--    <div class="col-md-3 col-sm-3 col-xs-12">-->
                    <!--         <div class="item form-group">-->
                    <!--            <label for="previous_class">Class</label>-->
                    <!--            <input  class="form-control col-md-7 col-xs-12"  name="previous_class"  id="previous_class" value="<?php echo isset($post['previous_class']) ?  $post['previous_class'] : ''; ?>" placeholder="Class"  type="text" autocomplete="off">-->
                    <!--            <div class="help-block"><?php echo form_error('previous_class'); ?></div>-->
                    <!--         </div>-->
                    <!--     </div>-->
                    <!--</div>-->
                    
                    <div class="ln_solid"><hr/></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 margin-top">
                        <button type="submit" class="btn btn-info glbscl-link-btn hvr-bs" style="background-color:blue;color: white;">&nbsp;Submit</button>
                        <a  class="btn btn-info glbscl-link-btn hvr-bs"  href="<?php echo site_url('admission-form'); ?>" style="background-color:lightblack;"> <i class="fa fa-print"></i>  Admission Form</a>
                    </div>
                    
                </div>
                </div>
            </div>         
        </div>
        </form>     
    </div>
</section>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">     
     
    $('#dob').datepicker({ startView: 2 });
    $('#admission').validate();
    
        
    function check_guardian_type(guardian_type){

         $('#relation_with').val('');  
         $('#gud_name').val('');  
         $('#gud_phone').val('');  
         $('#gud_present_address').val('');  
         $('#gud_permanent_address').val('');  
         $('#gud_religion').val(''); 
         $('#gud_profession').val(''); 
         $('#gud_national_id').val(''); 
         $('#gud_email').val(''); 
         $('#gud_other_info').val(''); 

        if(guardian_type == 'father'){

            $('#relation_with').val('<?php echo $this->lang->line('father'); ?>'); 
            $('.fn_existing_guardian').hide();
            $('.fn_except_exist').show();                          
            $('#gud_name').prop('required', true);               
            $('#gud_phone').prop('required', true);               
            $('#gud_email').prop('required', true);               

            var f_name = $('#father_name').val();
            var f_phone = $('#father_phone').val(); 
            var f_profession = $('#father_profession').val(); 

            $('#gud_name').val(f_name);  
            $('#gud_phone').val(f_phone); 
            $('#gud_profession').val(f_profession); 

        }else if(guardian_type == 'mother'){

            $('#relation_with').val('<?php echo $this->lang->line('mother'); ?>');   
            $('.fn_existing_guardian').hide();
            $('.fn_except_exist').show();            
            $('#gud_name').prop('required', true);               
            $('#gud_phone').prop('required', true);               
            $('#gud_email').prop('required', true); 

            var m_name = $('#mother_name').val();
            var m_phone = $('#mother_phone').val(); 
            var m_profession = $('#mother_profession').val(); 

            $('#gud_name').val(m_name);  
            $('#gud_phone').val(m_phone); 
            $('#gud_profession').val(m_profession); 

        }else if(guardian_type == 'other'){
            $('#relation_with').val('<?php echo $this->lang->line('other'); ?>');    
            $('.fn_existing_guardian').hide();
            $('.fn_except_exist').show();           
            $('#gud_name').prop('required', true);               
            $('#gud_phone').prop('required', true);               
            $('#gud_email').prop('required', true); 

        }else if(guardian_type == 'exist_guardian'){
            $('.fn_existing_guardian').show();
            $('.fn_except_exist').hide();            
            $('#gud_name').prop('required', false);               
            $('#gud_phone').prop('required', false);               
            $('#gud_email').prop('required', false); 

        }else{
             $('#relation_with').val('');   
             $('.fn_existing_guardian').hide();
             $('.fn_except_exist').show();             
             $('#gud_name').prop('required', true);               
             $('#gud_phone').prop('required', true);               
             $('#gud_email').prop('required', true); 
        }

     }
     
    $('#same_as_guardian').on('click', function(){
        
        if($(this).is(":checked")) {
            
            var present =  $('#gud_present_address').val();  
            var permanent = $('#gud_permanent_address').val(); 
            
            $('#present_address').val(present);  
            $('#permanent_address').val(permanent);  
        }else{
             $('#present_address').val('');  
             $('#permanent_address').val(''); 
        }
    });
        
         
    $('#fn_find').on('click', function(){
           
        var phone = $('#gud_phone').val();

        if(!phone){
            $('#gud_phone').focus();
            return false;
        }

        $.ajax({       
        type   : "POST",
        dataType: "json",
        url    : "<?php echo site_url('web/get_guardian_info'); ?>",
        data   : { phone : phone},               
        async  : true,
        success: function(response){ 
           if(response)
           {
                $('#guardian_id').val(response.id);  
                $('#gud_name').val(response.name);  
                $('#gud_email').val(response.email);  
                $('#gud_national_id').val(response.national_id);  
                $('#gud_profession').val(response.profession);  
                $('#gud_religion').val(response.religion);  
                $('#gud_present_address').val(response.present_address);  
                $('#gud_permanent_address').val(response.permanent_address); 
                $('#gud_phone').val(response.phone);                    

           }else{

                $('#guardian_id').val('');  
                $('#gud_name').val('');  
                $('#gud_email').val('');  
                $('#gud_national_id').val('');  
                $('#gud_profession').val('');  
                $('#gud_religion').val('');  
                $('#gud_present_address').val('');  
                $('#gud_permanent_address').val(''); 
                $('#gud_phone').val(''); 
                
                }
             }
         });  
     });
        
        
</script>
