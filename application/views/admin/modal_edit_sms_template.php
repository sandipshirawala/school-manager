<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/sms_template_view/do_update/'.$row['sms_template_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('sms_template_content');?></label>
                    <div class="controls">
                        <textarea class="validate[required]" name="sms_template_content" value="<?php echo $row['sms_template_content'];?>"></textarea>
                    </div>
                </div>
               </div>
              
              
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('edit_sms_template');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>