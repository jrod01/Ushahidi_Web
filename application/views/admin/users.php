			<div class="bg">
				<h2>Manage Users</h2>
				<!-- tabs -->
				<div class="tabs">
					<?php
					if ($form_error) {
					?>
						<!-- red-box -->
						<div class="red-box">
							<h3>Error!</h3>
							<ul>
							<?php
							foreach ($errors as $error_item => $error_description)
							{
								// print "<li>" . $error_description . "</li>";
								print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
							}
							?>
							</ul>
						</div>
					<?php
					}

					if ($form_saved) {
					?>
						<!-- green-box -->
						<div class="green-box">
							<h3>User Has Been Saved!</h3>
						</div>
					<?php
					}
					?>
					<!-- tabset -->
					<ul class="tabset">
						<li><a href="#" class="active">Add/Edit</a></li>
					</ul>
					<!-- tab -->
					<div class="tab">
						<?php print form::open(); ?>
						<input type="hidden" id="user_id" name="user_id" value="">
						<div class="tab_form_item">
							<strong>Username:</strong><br />
							<?php print form::input('username', '', ' class="text"'); ?>
						</div>
						<div class="tab_form_item">
							<strong>Password:</strong><br />
							<?php print form::input('password', '', ' class="text"'); ?>
						</div>
						<div class="tab_form_item">
							<strong>Full Name:</strong><br />
							<?php print form::input('name', '', ' class="text"'); ?>
						</div>
						<div class="tab_form_item">
							<strong>Role:</strong><br />
							<span class="my-sel-holder">
								<?php print form::dropdown('role',$roles,''); ?>
							</span>
						</div>
						<div class="tab_form_item">
							&nbsp;<br />
							<input type="image" src="<?php echo url::base() ?>media/img/admin/btn-save-settings.gif" class="save-rep-btn" />
						</div>
						<?php print form::close(); ?>			
					</div>
				</div>
				<!-- report-table -->
				<div class="report-form">
					<?php
					if ($form_error) {
						print_r($errors);
					?>
						<!-- red-box -->
						<div class="red-box">
							<h3>Error!</h3>
							<ul>
							<?php
							foreach ($errors as $error_item => $error_description)
							{
								// print "<li>" . $error_description . "</li>";
								print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
							}
							?>
							</ul>
						</div>
					<?php
					}
		
					if ($form_saved) {
					?>
						<!-- green-box -->
						<div class="green-box">
							<h3>Your Settings Have Been Saved!</h3>
						</div>
					<?php
					}
					?>
					<!-- report-table -->
					<?php print form::open(); ?>
						<input type="hidden" name="action" id="action" value="">
						<div class="table-holder">
							<table class="table">
								<thead>
									<tr>
										<th class="col-1">&nbsp;</th>
										<th class="col-2">User</th>
										<th class="col-3">Role</th>
										<th class="col-4">Actions</th>
									</tr>
								</thead>
								<tfoot>
									<tr class="foot">
										<td colspan="4">
											<?php echo $pagination; ?>
										</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									if ($total_items == 0)
									{
									?>
										<tr>
											<td colspan="4" class="col">
												<h3>No Results To Display!</h3>
											</td>
										</tr>
									<?php	
									}
									foreach ($users as $user)
									{
										$user_id = $user->id;
										$username = $user->username;
										$password = $user->password;
										$name = $user->name;
										
										// Get Roles
										foreach(ORM::factory('role')->find_all() as $role)
										{
											if ($user->has(new Role_Model($role->name)))
											$role = $role->name; 
										} 
										?>
										<tr>
											<td class="col-1">&nbsp;</td>
											<td class="col-2">
												<div class="post">
													<h4><?php echo $name; ?> (<?php echo $username; ?>)</h4>
												</div>
											</td>
											<td class="col-3"><?php echo $role; ?></td>
											<td class="col-4">
												<ul>
													<li class="none-separator"><a href="#" onClick="fillFields('<?php echo(rawurlencode($user_id)); ?>','<?php echo(rawurlencode($username)); ?>','<?php echo(rawurlencode($name)); ?>','<?php echo(rawurlencode($role)); ?>')">Edit</a></li>
													<li><a href="#" class="del">Delete</a></li>
												</ul>
											</td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
					<?php print form::close(); ?>
				</div>
			</div>