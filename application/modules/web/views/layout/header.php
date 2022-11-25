<header>
    <div class="header-top-area">
      
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="logo">
                        <!-- <a href="<?php echo site_url(); ?>">
                            <?php if(isset($school->frontend_logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt=""  />
                            <?php }elseif(isset($school->logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt=""  />
                            <?php }else{ ?>
                                <img  width="100" height="100" src="<?php echo IMG_URL; ?>/sms-logo.png">
                            <?php } ?>    
                        </a> -->
                        <!-- <img src="../images/Blue_Logo.png"  height="100" width="100" style="padding-left:30px;"> -->
                        <!-- <h2><img src="../images/18.png" height="50" width="100"></h2> -->
                      <span style="padding-left:4rem;"> <img  width="100" height="100" src="<?php echo IMG_URL; ?>/Blue_Logo.png"></span> 
            </div>
            </div>
                <div class="col-md-6 col-sm-6 col-xs-6" >
                    
                        <!-- <p class="text">Have Any Question</p> -->
                        <h1 style="font-size:3rem;font-weight:600;color:white;float:right; padding-right:5rem;padding-top:2rem;">Help</h1>
                                    
                    <!-- <?php if(isset($school->email)){ ?>
                        <div class="hta-box">
                            <span class="icon"><i class="fas fa-phone"></i></span>
                            <p class="text"><?php echo $school->phone; ?></p>
                        </div>                       
                   <?php } ?>   
                    <?php if(isset($school->email)){ ?>
                        <div class="hta-box">
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <p class="text"><?php echo $school->email; ?></p>
                        </div>                        
                   <?php } ?> -->
                    
                </div>
                
            </div>
        
    </div>

    <div class="container">

   
    </div>

       

    <!-- <div class="header-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 offset-lg-0 col-md-4 offset-md-3 col-sm-6 col-6">
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
                <div class="col-lg-10 offset-lg-0 col-md-8 offset-md-2 col-sm-12 col-12">
                    <div class="menu">
                        <nav id="mobile_menu_active">
                            <ul id="menu">
                                <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                                <li><a href="#"><?php echo $this->lang->line('announcement'); ?> <span class="icon fas fa-chevron-down"></span></a>
                                    <ul class="drop">
                                        <li><a href="<?php echo site_url('news'); ?>"><?php echo $this->lang->line('news'); ?></a></li>
                                        <li><a href="<?php echo site_url('notice'); ?>"><?php echo $this->lang->line('notice'); ?></a></li>
                                        <li><a href="<?php echo site_url('holiday'); ?>"><?php echo $this->lang->line('holiday'); ?></a></li>
                                    </ul>                                
                                </li>
                                <li><a href="<?php echo site_url('events'); ?>"><?php echo $this->lang->line('event'); ?></a></li>
                                <li><a href="<?php echo site_url('galleries'); ?>"><?php echo $this->lang->line('gallery'); ?></a></li>
                                <li><a href="<?php echo site_url('teachers'); ?>"><?php echo $this->lang->line('teacher'); ?></a></li>
                                <li><a href="<?php echo site_url('staff'); ?>"><?php echo $this->lang->line('staff'); ?></a></li>
                                <li><a href="<?php echo site_url('contact'); ?>"><?php echo $this->lang->line('contact_us'); ?></a></li>
                                <?php if(isset($header_pages) && !empty($header_pages)){ ?>
                                    <li><a href="javascript:void(0)"><?php echo $this->lang->line('page'); ?> <span class="icon fas fa-chevron-down"></span></a>
                                        <ul class="drop">
                                        <?php foreach($header_pages AS $obj ){ ?>
                                             <li><a href="<?php echo site_url('page/'.$obj->page_slug); ?>"><?php echo $obj->page_title; ?></a></li>
                                         <?php } ?> 
                                        </ul>                                
                                    </li>    
                                <?php } ?> 
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</header>