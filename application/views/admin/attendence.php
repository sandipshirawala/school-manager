<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

			<li class="active">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo get_phrase('manage_attendence');?>

                    	</a></li>

		</ul>

    	<!------CONTROL TABS END------->

        

	</div>

	<div class="box-content padded">

            <!----TABLE LISTING STARTS--->

            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">

				<center>

                <?php echo form_open('admin/attendence');?>

                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">

                	<tr>

                        <td><?php echo get_phrase('select_class');?></td>

                        <td>&nbsp;</td>

                	</tr>

                	<tr>

                       

                        <td>

                        	<select name="class_id" class=""   style="float:left;">

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

                        </td>
                        
						<td>

                        	<select name="month" class="" >

                                <option value=""><?php echo get_phrase('select_month');?></option>

                                <?php 

                                $days = $this->db->get('workingdays')->result_array();

                                foreach($days as $row4):

                                ?>

                                    <option value="<?php echo $row4['work_id'];?>"

                                        <?php if($month == $row4['work_id'])echo 'selected';?>>

                                            <?php echo $row4['month'];?></option>

                                <?php

                                endforeach;

                                ?>

                            </select>


                        </td>
                       

                        <td>

                        	<input type="hidden" name="operation" value="selection" />

                    		<input type="submit" value="<?php echo get_phrase('manage_attendence');?>" class="btn btn-normal btn-gray" />

                        </td>

                	</tr>

                </table>

                </form>

                </center>

                

                

                <br /><br />

                

                

                <?php if($class_id >0 && $month > 0):?>

                <?php 

						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////

						$students	=	$this->crud_model->get_students($class_id);

						foreach($students as $row):

							$verify_data	=	array(	'class_id' => $class_id , 
							
							                            'month' => $month ,

														'student_id' => $row['student_id']);

							$query = $this->db->get_where('attendence' , $verify_data);

							

							if($query->num_rows() < 1)

								$this->db->insert('attendence' , $verify_data);

						 endforeach;

				?>
				<?php 
				
				  $verify_data1	=	array('work_id' => $month );
				 
				 $query = $this->db->get_where('workingdays', $verify_data1);
				 
				 $total	=	$query->result_array();
                 echo form_open('admin/attendence');
							foreach($total as $row5): 
				?>
                <div align="center"><b><?php echo get_phrase('Total_Working_Days');?></b><b> <input type="number" value="<?php echo $row5['total_days'];?>" name="totaldays"  /></b>
				<input type="hidden" name="working" value="days" />
				<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
				<input type="hidden" name="month" value="<?php echo $month; ?>" />

                                	<button type="submit" class="btn btn-normal btn-gray"> Update</button>
				</div><br />
				<?php endforeach; ?>
				</form>
                <table class="table table-normal box" >

                    <thead>

                        <tr>

                            <td><?php echo get_phrase('student');?></td>

                            <td><?php echo get_phrase('Total_Presented_Days');?></td>

                            <td></td>

                        </tr>

                    </thead>

                    <tbody>

                    	

                        <?php 

						$students	=	$this->crud_model->get_students($class_id);

						foreach($students as $row):

						

							$verify_data	=	array(	'class_id' => $class_id ,
							                            
														'month' => $month ,

														'student_id' => $row['student_id']);

														

							$query = $this->db->get_where('attendence' , $verify_data);							 

							$attendence	=	$query->result_array();

							foreach($attendence as $row2):

							?>

                            <?php echo form_open('admin/attendence');?>

							<tr>

								<td>

									<?php echo $row['name'];?>

								</td>

								<td>

									 <input type="number" value="<?php echo $row2['present'];?>" name="present"  />

								</td>

                                <td>

                                	<input type="hidden" name="atten_id" value="<?php echo $row2['attendence_id'];?>" />

                                    

                                	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />

                                    <input type="hidden" name="month" value="<?php echo $month;?>" />

                                	<input type="hidden" name="operation" value="update" />

                                	<button type="submit" class="btn btn-normal btn-gray"> Update</button>

                                </td>

							 </tr>

                             </form>

                         	<?php 

							endforeach;

						 endforeach;

						 ?>

                     </tbody>

                  </table>

            

            <?php endif;?>

			</div>

            <!----TABLE LISTING ENDS--->

            

		</div>

	</div>

</div>



<script type="text/javascript">

  function show_subjects(class_id)

  {

      for(i=0;i<=100;i++)

      {



          try

          {

              document.getElementById('subject_id_'+i).style.display = 'none' ;

	  		  document.getElementById('subject_id_'+i).setAttribute("name" , "temp");

          }

          catch(err){}

      }

      document.getElementById('subject_id_'+class_id).style.display = 'block' ;

	  document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");

  }



</script> 