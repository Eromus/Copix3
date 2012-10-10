<?php if (! $ppo->configurationFileIsWritable){ ?>
<div class="errorMessage">
<h1><?php _etag ('i18n', 'copix:common.messages.error');?></h1>
<ul>
 <li><?php _etag ('i18n', array ('key'=>'install.databaseFileNotWritable', 'configurationFilePath'=>$ppo->configurationFilePath)); ?></li>
</ul>
</div>
<?php } ?>

<form action="<?php echo _url ('ldap|ldap|validForm'); ?>" method="POST">
<table class="CopixTable">
<thead>
<tr>
<th></th>
<th><?php _etag ('i18n', 'ldap.profil.profileName'); ?></th>
<th><?php _etag ('i18n', 'ldap.profil.dnName'); ?></th>
<th><?php _etag ('i18n', 'ldap.profil.hostName'); ?></th>
<th><?php _etag ('i18n', 'ldap.profil.userName'); ?></th>
<th><?php _etag ('i18n', 'ldap.profil.password'); ?></th>
<th><?php _etag ('i18n', 'ldap.profil.shared'); ?></th>
<th></th>
</tr>
</thead>
	<tbody>
		<tr>
			<td><input type="radio" name="defaultRadio" value="nodefault"></td>
			<td colspan="6"><?php _etag ('i18N','ldap.profil.nodefault'); ?></td>
		</tr>
		<?php
/*		    foreach ($ppo->connections as $postFix=>$configuredConnection){ 
		?>
		<tr>
		 <td><input type="radio" name="defaultRadio" <?php echo 'value="default'.$postFix.'"'; 
		 
		 if ($configuredConnection['default'] === true) {
		     echo " checked";
		 }
		 
		 ?>></td>
		 <td><input size="10" type="text" name="connectionName<?php echo $postFix; ?>" value="<?php echo $postFix; ?>" /></td>
		 <td><?php _etag ('select', array ('name'=>'driver'.$postFix, 'values'=>$ppo->drivers, 'selected'=>isset ($configuredConnection['driver']) ? $configuredConnection['driver'] : null)); ?></td>
		 <td><input type="text" value="<?php _etag ('escape', array ('value'=>$configuredConnection['connectionString'])); ?>"
				name="connectionString<?php echo $postFix; ?>" /></td>
		 <td><input type="text"
				value="<?php _etag ('escape', array ('value'=>$configuredConnection['user'])); ?>"
				name="user<?php echo $postFix; ?>" /></td>
		 <td><input type="password"
				value="<?php _etag ('escape', array ('value'=>$configuredConnection['password'])); ?>"
				name="password<?php echo $postFix; ?>" /></td>
		 <td><?php if ($configuredConnection['available']){$imgSrc = 'img/tools/tick.png'; $alt=_i18n ('copix:common.status.valid');}else{$imgSrc = 'img/tools/cross.png';$alt=_i18n ('copix:common.status.notValid');} ?>
		 	<img src="<?php echo _resource ($imgSrc); ?>"
				title="<?php echo $configuredConnection['errorNotAvailable']; ?>"
				alt="<?php echo $alt; ?>" />
			<?php if (!$configuredConnection['available']) {_etag ('popupinformation', array(), $configuredConnection['errorNotAvailable']);}?>
		 	</td>
		</tr>
		<?php 
        }*/
        ?>
		<tr>
			<td></td>
			<td><input size="10" type="text" name="profilName" /></td>
			<td><input size="10" type="text" name="dnName" /></td>
			<td><input size="10" type="text" name="hostName" /></td>
			<td><input size="10" type="text" name="userName" /></td>
			<td><input type="password" value="" name="password" /></td>
			<td><input type="checkbox" value="" name="shared" /></td>
			<td></td>
		</tr>
	</tbody>
</table>

<input type="submit" name="btn" value="<?php _etag ('i18n', 'ldap.profil.test'); ?>" />
<?php /*if ($ppo->valid) { ?>
<input type="submit" name="btn" 
	value="<?php _etag ('i18n', 'install.database.save'); ?>" />
<?php } */?>
</form>