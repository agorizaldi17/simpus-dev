<?php if($this->session->flashdata('flash_message') != ""):?>
 		<script>
			jAlert('<?php echo $this->session->flashdata('flash_message'); ?>', 'Informasi');
		</script>
<?php endif;?>
<div class="rightpanel">
	<div class="breadcrumbwidget">
    	<ul class="breadcrumb">
        	<li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="#">Master Pelayanan</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $page_title; ?></li>
        </ul>
	</div><!--breadcrumbwidget-->
    <div class="pagetitle">
    	<h1><?php echo $page_title; ?></h1> <span>Halaman manajemen data unit pelayanan</span>
    </div><!--pagetitle-->
     
    <div class="maincontent">
    	<div class="contentinner content-dashboard">
        	<div class="row-fluid">
            	<div class="span12">
					<div id="tabs">
  	 					<ul>
                        	<?php if(isset($edit_unit_pelayanan)):?>
            				<li class="ui-tabs-active"><a href="#ubah"><i class="icon-edit"></i> Ubah Data Unit Pelayanan</a></li>
            				<?php endif;?>
      						
                            <li class="<?php if(!isset($edit_unit_pelayanan))echo 'ui-tabs-active';?>"><a href="#list"><i class="icon-align-justify"></i> Daftar Unit Pelayanan</a></li>
                            <li class=""><a href="#tambah"><i class="icon-plus"></i> Tambah Unit Pelayanan</a></li>
                        </ul>
                        
                        <!----EDITING FORM STARTS---->
        				<?php if(isset($edit_unit_pelayanan)):?>
                        <div id="ubah">
                       		<h4 class="widgettitle">Ubah Data Unit Pelayanan</h4>
                            <div class="row-fluid">
                                <div class="span6">
                                <?php foreach ($edit_unit_pelayanan as $row): ?>
                            	<?php echo form_open('cont_master_pelayanan/unit_pelayanan/ubah/do_update/'.$row['kd_unit_pelayanan'], array('class' => 'stdform stdform2', 'id' => 'form_edit')); ?>
                                    <table class="table table-bordered table-invoice">
                                        <input type="hidden" name="kd_unit_pelayanan" id="kd_unit_pelayanan" value="<?php echo $row['kd_unit_pelayanan']; ?>" class="input-medium" />
                                        <tr>
                                            <td>Nama Unit</td>
                                            <td><input type="text" name="nm_unit" id="nm_unit" value="<?php echo $row['nm_unit']; ?>" class="input-large" /></td>
                                        </tr>
                                    </table>
                                    <p class="stdformbutton">
                                        <button class="btn btn-primary btn-circle"><i class="icon-ok icon-white"></i> Perbaharui</button>
                                    </p>
                            	<?php echo form_close(); ?>
                            <?php endforeach; ?>
                        	</div><!--widgetcontent-->
                            </div>
                        </div>
                        <?php endif;?>
                        <!---- END EDITING FORM ---->
                        
                        <!---- DAFTAR UNIT PELAYANAN START ---->
   						<div id="list">
                        	<?php echo $this->table->generate(); ?>
                        <script type="text/javascript">
							jQuery(document).ready(function () {
								var oTable = jQuery('#dyntable').dataTable({
									"bProcessing": true,
									"bServerSide": true,
									"bAutoWidth": false,
									"sAjaxSource": '<?php echo base_url(); ?>datatable_master/unit_pelayanan',
									"bJQueryUI": false,
									"sPaginationType": "full_numbers",
									//"aaSortingFixed": [[0,'asc']],
									"fnDrawCallback": function(oSettings) {
										jQuery.uniform.update();
									},
									"iDisplayStart ": 10,
									"oLanguage": {
										"sProcessing": "<center><img src='<?php echo base_url(); ?>assets/img/loaders/loader_blue.gif' /></center>"
									},
									"fnInitComplete": function () {
										//oTable.fnAdjustColumnSizing();
									},
									'fnServerData': function (sSource, aoData, fnCallback) {
										jQuery.ajax
										({
											'dataType': 'json',
											'type': 'POST',
											'url': sSource,
											'data': aoData,
											'success': fnCallback
										});
									}
								});
							});
						</script>
                        </div>
                         <!---- END DAFTAR UNIT PELAYANAN ---->
                        
                        <!---- TAMBAH UNIT PELAYANAN START ---->
                        <div id="tambah">
                       		<h4 class="widgettitle">Data Unit Pelayanan</h4>
                            <div class="row-fluid">
                                <div class="span6">
                                <?php echo form_open('cont_master_pelayanan/unit_pelayanan/tambah', array('class' => 'stdform stdform2', 'id' => 'form_input')); ?>
                                    <table class="table table-bordered table-invoice">
                                        <tr>
                                            <td>Nama Unit</td>
                                            <td><input type="text" name="nm_unit" id="nm_unit" class="input-large" /></td>
                                        </tr>
                                    </table>
                                    <p class="stdformbutton">
                                        <button class="btn btn-primary btn-circle"><i class="icon-ok icon-white"></i> Simpan</button>
                                        <button type="reset" class="btn btn-success btn-circle"><i class="icon-refresh icon-white"></i> B a t a l</button>
                                    </p>
                               	<?php echo form_close();  ?>
                                </div><!--widgetcontent-->
                                </div>
                        </div>
                        <!---- END TAMBAH UNIT PELAYANAN ---->
                	</div><!--tabs-->
                </div><!--span12-->
            </div><!--row-fluid-->
        </div><!--contentinner-->
    </div><!--maincontent-->
</div><!--mainright-->
<script type="text/javascript">
jQuery(document).ready(function(){
	// With Form Validation
	jQuery("#form_edit").validate({
		rules: {
			kd_unit_pelayanan: "required",
			nm_unit: "required",
			aktif:"required"
			
		},
		messages: {
			kd_unit_pelayanan: "Kode unit pelayanan harus diisi!",
			nm_unit: "Nama unit harus diisi!",
			aktif: "Aktif harus diiisi!"
		},
		highlight: function(label) {
			jQuery(label).closest('p').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('Ok!').addClass('valid')
	    		.closest('p').addClass('success');
	    }
	});
	jQuery("#form_input").validate({
		rules: {
			kd_unit_pelayanan: "required",
			nm_unit: "required",
			aktif:"required"
			
		},
		messages: {
			kd_unit_pelayanan: "Kode unit pelayanan harus diisi!",
			nm_unit: "Nama unit harus diisi!",
			aktif: "Aktif harus diiisi!"
		},
		highlight: function(label) {
			jQuery(label).closest('p').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('Ok!').addClass('valid')
	    		.closest('p').addClass('success');
	    }
	});
});

</script>