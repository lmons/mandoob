<?php /* Smarty version 2.6.29, created on 2019-05-20 10:51:56
         compiled from modules/Calendar/tpls/shared_users.tpl */ ?>

<script language="javascript">
<?php if ($this->_tpl_vars['edit_shared']): ?>
	<?php echo '
	SUGAR.util.doWhen(function(){
		return typeof cal_loaded != \'undefined\' && cal_loaded == true && typeof dom_loaded != \'undefined\' && dom_loaded == true;	
	},function(){
		CAL.toggle_shared_edit();
	});
	'; ?>

<?php endif; ?>

<?php echo '
			function up(name){
				var td = document.getElementById(name+\'_td\');
				var obj = td.getElementsByTagName(\'select\')[0];
				obj =(typeof obj == "string") ? document.getElementById(obj) : obj;
				if(obj.tagName.toLowerCase() != "select" && obj.length < 2)
					return false;
				var sel = new Array();
							
				for(i = 0; i < obj.length; i++){
					if(obj[i].selected == true) {
						sel[sel.length] = i;
					}
				}
				for(i in sel){
					if(sel[i] != 0 && !obj[sel[i]-1].selected) {
						var tmp = new Array(obj[sel[i]-1].text, obj[sel[i]-1].value);
						obj[sel[i]-1].text = obj[sel[i]].text;
						obj[sel[i]-1].value = obj[sel[i]].value;
						obj[sel[i]].text = tmp[0];
						obj[sel[i]].value = tmp[1];
						obj[sel[i]-1].selected = true;
						obj[sel[i]].selected = false;
					}
				}
			}			
			function down(name){
				var td = document.getElementById(name+\'_td\');
				var obj = td.getElementsByTagName(\'select\')[0];
				if(obj.tagName.toLowerCase() != "select" && obj.length < 2)
					return false;
				var sel = new Array();
				for(i=obj.length-1; i>-1; i--){
					if(obj[i].selected == true) {
						sel[sel.length] = i;
					}
				}
				for(i in sel){
					if(sel[i] != obj.length-1 && !obj[sel[i]+1].selected) {
						var tmp = new Array(obj[sel[i]+1].text, obj[sel[i]+1].value);
						obj[sel[i]+1].text = obj[sel[i]].text;
						obj[sel[i]+1].value = obj[sel[i]].value;
						obj[sel[i]].text = tmp[0];
						obj[sel[i]].value = tmp[1];
						obj[sel[i]+1].selected = true;
						obj[sel[i]].selected = false;
					}
				}
			}
'; ?>

</script>

<div class="modal fade modal-calendar-user-list" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><?php echo $this->_tpl_vars['MOD']['LBL_EDIT_USERLIST']; ?>
</h4>
			</div>
			<div class="modal-body">
				<!--->
				<div class="container-fluid">
					<div class="panel panel-default ">
						<div class="panel-heading  panel-heading-collapse">
							<a id="subpanel_title_activities" class="" role="button" data-toggle="collapse" href="#subpanel_settings_user_list">
								<div class="col-xs-10 col-sm-11 col-md-11">
									<div>
										<?php echo $this->_tpl_vars['MOD']['LBL_EDIT_USERLIST']; ?>

									</div>
								</div>
							</a>
						</div>
						<div id="subpanel_settings_user_list" class="panel-body panel-collapse collapse in">
							<form id="shared_cal" name="shared_cal" action="index.php" method="post">
								<input type="hidden" name="module" value="Calendar">
								<input type="hidden" name="action" value="index">
								<input type="hidden" name="edit_shared" value="">
								<input type="hidden" name="view" value="<?php echo $this->_tpl_vars['view']; ?>
">


								<table cellpadding="0" cellspacing="3" border="0" align="center" width="100%">
									<tr><th valign="top" align="center" colspan="2"><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_USERS']; ?>
</th></tr>
									<tr><td valign="top"></td><td valign="top">
											<table cellpadding="1" cellspacing="1" border="0" class="edit view" align="center">
												<tr>
													<td valign="top" nowrap=""><b><?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
:</b></td>
													<td valign="top" id="shared_ids_td">
														<select id="shared_ids" name="shared_ids[]" multiple size="8"><?php echo $this->_tpl_vars['users_options']; ?>
</select>
													</td>
													<td>
														<a onclick="up('shared_ids');"><?php echo $this->_tpl_vars['UP']; ?>
</a><br>
														<a onclick="down('shared_ids');"><?php echo $this->_tpl_vars['DOWN']; ?>
</a>
													</td>
												</tr>
											</table>
										</td></tr>
								</table>
							</form>
						</div>
					</div>
				</div>
				<!--->
			</div>
			<div class="modal-footer">
				<button id="sharedCalUsersSelectBtn" data-dismiss="modal" class="btn btn-default" type="button"><?php echo $this->_tpl_vars['MOD']['LBL_CANCEL_BUTTON']; ?>
</button>
				<button id="sharedCalUsersSelectBtn" onclick="$('#shared_cal').submit();" class="btn btn-danger" type="button"><?php echo $this->_tpl_vars['MOD']['LBL_APPLY_BUTTON']; ?>
</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>