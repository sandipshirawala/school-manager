<div class="box">

	<div class="box-header">



		<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

			<li class="active"><a href="#list" data-toggle="tab"><i
					class="icon-align-justify"></i> Upload Student Details </a>
			</li>



		</ul>

		<!------CONTROL TABS END------->



	</div>

	<div class="box-content padded">

		<div class="tab-content">
			<!----CREATION FORM STARTS---->
			<br />
			<form action="<?php echo base_url();?>index.php?admin/read"" method="post" enctype="multipart/form-data">
			<div align="center">

				<input type="file" name="detail" />
			</div>

			<div class="form-actions" align="center">

				<button type="submit" class="btn btn-gray">Submit</button>

			</div>

			</form>

		</div>

	</div>

	<!----CREATION FORM ENDS--->



</div>

</div>

</div>
