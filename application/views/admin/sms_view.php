<?php if($class_id != ""):?>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('send_sms');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('send_sms_template');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                          
                <div class="box-content">
                	<?php echo form_open('admin/sms_view/'.$class_id.'/send_group_sms' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                          
                          
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sms_text');?></label>
                                <div class="controls">
                                                              <input type="text" id="sms_recepients1" name="sms_recepients1" size="35" />

                                </div>
                          
                           </div>
  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sms_text');?></label>
                                <div class="controls">
                                    <div class="box closable-chat-box">
                                        <div class="box-content padded">
                                                <div class="chat-message-box">
                                                <textarea name="send_sms" id="ttt" rows="5" placeholder="<?php echo get_phrase('send_sms');?>" class="validate[required]"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('send_sms');?></button>
                        </div>
                
			</div>
			</div>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->




<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/sms_view/'.$class_id.'/send_template_sms' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                        
                        
                         <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sms_template_content');?></label>
                                <div class="controls">
                                    <select name="sms_template_id" >
                    	<option value=""><?php echo get_phrase('sms_template_content');?></option>
						<?php 
                        $sms_templates = $this->db->get('sms_template')->result_array();
                        foreach($sms_templates as $row):
                        ?>
                            <option value="<?php echo $row['sms_template_id'];?>"
                            	<?php if($class_id == $row['sms_template_id'])echo 'selected';?>>
                                	Class <?php echo $row['sms_template_content'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                                </div>
                            </div>
                           
                           
                           
                         <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sms_template_content');?></label>
                                <div class="controls">
                          <input type="text" id="sms_recepients2" name="sms_recepients2" size="35" />
                                </div>
                            </div>
                           
                           
                           
                           
 
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('send_sms');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
			
			          
		</div>
	</div>
</div>

<script>
     $(document).ready(function() {  
     
$('#sms_recepients1').tagsinput({
  itemValue: "value",
  itemText: "text",
  typeahead: {
    source: <?php echo get_students_by_class_id((int) $class_id); ?>
  }
  

});

       $('#sms_recepients1').tagsinput('add', { "value": -1, "text": "Select All"  });        
$('#sms_recepients2').tagsinput({
  itemValue: "value",
  itemText: "text",
  typeahead: {
    source: <?php echo get_students_by_class_id($class_id); ?>
  }
  

});

       $('#sms_recepients2').tagsinput('add', { "value": -1, "text": "Select All"  }); 
});

</script>

<?php endif;?>













<?php if($class_id == ""):?>
<center>
<div class="span5" style="float:none !important;">
    <div class="box">
		<div class="box-header">
			<span class="title"> <i class="icon-info-sign"></i> Please select a class to send SMS.</span>
		</div>
		<div class="box-content padded">
            <br />
            <select name="class_id" onchange="window.location='<?php echo base_url();?>index.php?admin/sms_view/'+this.value">
                <option value=""><?php echo get_phrase('select_a_class');?></option>
                <?php 
                $classes = $this->db->get('class')->result_array();
                foreach($classes as $row):
                ?>
                    <option value="<?php echo $row['class_id'];?>"
                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                            Class <?php echo $row['name'];?></option>
                <?php
                endforeach;
                ?>
            </select>
            <hr />
            <script>
                $(document).ready(function() {
                    function ask()
                    {
                        Growl.info({title:"Select a class to send SMS",text:" "});
                    }
                    setTimeout(ask, 500);
      
                });
            </script>
		</div>
    </div>
</div>
</center>
<?php endif;?>



