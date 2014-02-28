<?php include_once 'header.php';?>
	<div class="navListDashboard alignleft">
		<ul>
			<?php 
				if(isset($_SESSION['menuArray']) && count($_SESSION['menuArray']) > 0)
				{
					foreach($_SESSION['menuArray'] as $key => $values)
					{
			?> 
						<li>
							<a href="/admin/<?php echo $values['menuName'];?>" alt="<?php echo $values['menuDisplayName'];?>" title="<?php echo $values['menuDisplayName'];?>"><?php echo $values['menuDisplayName'];?></a>
						</li>
			<?php 		
					}
				}
			?>
		</ul>
	</div>
	<div class="width750px alignleft marTop25px marLeft20px">
		<div class="evenrow border pad5px">
			<div class="alignleft">Version <strong><?php echo $data['getVersionDetails']['New feature'][0]['version_name']?></strong></div>
			<div class="alignright">Release Date: <strong><?=$data['getVersionDetails']['New feature'][0]['release_date']?></strong></div>
			<br clear="all"/>
		</div>
		<div class="versionBox border pad10px marTop5px">
		<?php if(array_key_exists('New feature',$data['getVersionDetails'])){?>
			<h6>Features</h6>
			<ul>
				<?php 
				foreach($data['getVersionDetails']['New feature'] as $values)
				{
					if($values['note_type'] == 'New feature')
					{
				?>
				<li>
					<?=$values['note'];?>
				</li>
				<?php } }?>
			</ul>
			<?php } if(array_key_exists('Enhancement',$data['getVersionDetails'])){?>
			<h6 class="marTop10px">Enhancements</h6>
			<ul>
				<?php 
				foreach($data['getVersionDetails']['Enhancement'] as $values)
				{
					if($values['note_type'] == 'Enhancement')
					{
				?>
				<li>
					<?=$values['note'];?>
				</li>
				<?php } }?>
			</ul>
			<?php } if(array_key_exists('Bug',$data['getVersionDetails'])){?>
			<h6 class="marTop10px">Bug Fixes</h6>
			<ul>
				<?php 
				foreach($data['getVersionDetails']['Bug'] as $values)
				{
					if($values['note_type'] == 'Bug')
					{
				?>
				<li>
					<?=$values['note'];?>
				</li>
				<?php } }?>
			</ul>
			<?php } if(array_key_exists('TBD',$data['getVersionDetails'])){?>
			<h6 class="marTop10px">TBD</h6>
			<ul>
				<?php 
				foreach($data['getVersionDetails']['TBD'] as $values)
				{
					if($values['note_type'] == 'TBD')
					{
				?>
				<li>
					<?=$values['note'];?>
				</li>
				<?php } }?>
			</ul>
			<?php }?>
		</div>
	</div>
<?php include_once 'footer.php';?>		
