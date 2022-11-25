<!-- <section class="page-breadcumb-area bg-with-black">
    <div class="container text-center">
        <h2 class="title">Admission Form</h2>
        <ul class="links">
            <li><a href="javascript:void(0);">Admission Form</a></li>
        </ul>
    </div>
</section> -->

<section class="page-contact-area">
    <div class="container">
        <div class="row" style="padding-top:5rem;">
            <div class="col-md-12 col-sm-12">
                <div class="admission-form">
                    <div class="row"> 
                 <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="logo">
                        <a href="<?php echo site_url(); ?>">
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
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="admission-address">
                                <div><h3><?php echo $school->school_name; ?></h3></div>                                
                                <div><?php echo $school->address; ?></div>
                                <div><?php echo $school->phone; ?></div>
                                <div><?php echo $school->email; ?></div>
                                
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <span class="student-picture">Photo</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><hr></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Basic Information:</strong></p> </div>
                    </div>  
                    
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Name:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Birth Date:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                                              
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Academic Session:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Standard:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                                              
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">DIV:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Roll No:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                                              
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Gender:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                    
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Blood Group:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">                                           
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Religion:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Caste:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">                                           
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Email:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Home:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                    </div>
                    <div class="row">                                           
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">National ID:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Health Condition:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Address Information:</strong></p> </div>
                    </div>                      
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title">Present Address:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title">Permanent Address:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Academic Information:</strong></p> </div>
                    </div>                     
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Student Type:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Class:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Group:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Second Language:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                                     
                                        
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Father Information:</strong></p> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Father Name:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Father Phone:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Father Education:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Father Profession:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Father Designation:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                        
                    </div>
                    
                        
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Mother Information:</strong></p> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Mother Name:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Mother Phone:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Mother Education:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Mother Profession:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Mother Designation:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Other Information:</strong></p> </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Email:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Health Condition:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Previous School:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Previous Class:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title">Other Info:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                                     
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong>Guardian Information:</strong></p> </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Guardian Name:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Relation with Guardian :</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Guardian Phone:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Email:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Religion:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">Profession:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title">National ID:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title">Present Address:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title">Permanent Address:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title">Other Info:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>         
        </div>
        <div class="row no-print">
            <div class="col-md-12 col-sm-12 text-center margin-top">
                <button class="btn btn-info glbscl-link-btn hvr-bs" onclick="window.print();" style="background-color:blue; color: white;font-weight: 600"><i class="fa fa-print"></i>&nbsp;Print</button>
                <a  class="btn btn-info glbscl-link-btn hvr-bs"  href="<?php echo site_url('admission-online'); ?>">Online Admission</a>
            </div>
        </div>
    </div>
</section>
