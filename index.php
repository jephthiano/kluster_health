<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','all_tables.inc.php')); // create all tables
require_once(file_location('inc_path','session_check_nologout.inc.php')); //session
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "HOME | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?>
<?php if(!isset($_SESSION['patient_id'])){?>
<link rel="stylesheet"href="<?=file_location('home_url','plugins/landing.css');?>">
<link rel="stylesheet"href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<?php }?>
<title><?=$page_name?></title>
</head>
<body id="boy"class=''style="font-family:Roboto,sans-serif;width:100%;">
	<?php
	if(isset($_SESSION['patient_id'])){
		require_once(file_location('inc_path','page_load.inc.php')); //page loader
		$name = ucwords(content_data('patient_table','p_fullname',$p_id,'p_id'));
		$profile_pics = file_location('media_url',get_media('patient',$p_id));
		?>
		<div class="j-row">
			<?php require_once(file_location('inc_path','side_bar_1.inc.php')); //first side bar?>
			<div id=""class="j-col m10">
				<?php require_once(file_location('inc_path','navigation.inc.php'));?>
				<div class="j-main-body">
					<div class="j-hide-small j-hide-medium"style="margin-top:64px;"></div>
					<?php //index header for small and large?>
					<div id="index_header">
						<div class='j-hide-small j-hide-medium'>
							<div class="j-right">
								<div class="j-circle j-color5"style="display:inline-block;padding:12px 12px;margin-right:15px">
									<a href="<?=file_location('home_url','reminders/')?>">
									<img src="<?=file_location('media_url','home/notification.png')?>"/>
									</a>
								</div>
								<a href="<?=file_location('home_url','account/')?>">
								<img src="<?=$profile_pics?>"class='j-right j-circle j-border-2 j-border-color4'style="width:50px;height:50px;"/>
								</a>
							</div>
							<div class='j-xlarge j-text-color7'>Welcome, <span class='j-bolder j-text-color1'><?=$name;?></span></div>
							<br>
						</div>
						<div class='j-color1 j-padding j-hide-large j-hide-xlarge'style="height:200px;border-radius:0px 0px 100px 20px">
							<div class='j-padding'>
								<a href="<?=file_location('home_url','account/')?>">
								<img src="<?=$profile_pics?>"class='j-right j-circle j-border-2 j-border-color4'style="width:50px;height:50px;"/>
								</a>
							</div><br class='j-clearfix'><br>
							<div class='j-xlarge'><b>Welcome,</b> <br> <?=$name?></div>
						</div>
					</div>
					<?php //for reminder?>
					<div class='j-padding'style="margin-top:5px;">
						<div class='j-text-color5 j-large j-bolder'style="margin-bottom:4px;">Reminder</div>
						<div id='hom'>
							<?php patient_section_data('home');?>
						</div>
						<?php
						
						?>
						<?php
						//if user has completed profile dont show
						$country = content_data('patient_table','p_country',$p_id,'p_id');
						if($country === false || empty($country)){
							?>
							<div class='j-color6 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
								<div class='j-large j-text-color7 j-bolder'>Complete your profile data</div>
								<div class='j-text-color3'>Some datails are missing in your profile</div>
								<div class='j-center j-margin'>
									<a href="<?=file_location('home_url','account/edit_profile')?>">
									<span class='j-text-color5 j-button j-color1'style="padding:5px 24px;border-radius:15px;">Complete Profile</span>
									</a>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
		</div>
		<?php
	}else{
		?>
		<header>
			<nav class="navbar">
			  <p class="logo">KlusterHealth</p>
			  <ul class="j-large">
				<li><a href="<?=file_location('home_url','misc/about_us/')?>">About Us</a></li>
				<li><a href="#features">Features</a></li>
				<li><a href="#services">Services</a></li>
				<li><a href="<?=file_location('home_url','misc/faq/')?>">FAQs</a></li>
				<li><a href="<?=file_location('home_url','misc/contact_us/')?>">Contact Us</a></li>
			  </ul>
			  <span class="buttons">
				<button class="btn outline"onclick="$('#login_modal').fadeIn('slow');">Log In</button>
				<button class="btn filled"onclick="$('#signup_modal').fadeIn('slow');">Sign Up</button>
			  </span>
			  <div id="menubar menu"class='j-hide-large j-hide-xlarge'><img src="<?=file_location('media_url','home/menu.png')?>" alt="" /></div>
			</nav>
			<div class="background-image">
			  <div class="background-content">
				<h1 class='j-bolder'>Providing an exceptional <br />patient experience</h1>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessit<br />atibusreiciendis eos saepe vitae quibusdam corrupti ip<br />ipsa asperiores reprehenderit</p>
				<div class="buttons">
				  <button class="btn filled"onclick="$('#signup_modal').fadeIn('slow');">Sign Up</button>
				  <button class="btn j-text-color2 j-border-2 j-border-color2"onclick="$('#login_modal').fadeIn('slow');">Log In</button>
				</div>
			  </div>
			</div>
		</header>
		<section id="about" class="about">
			<div class="abt-image"><img src="<?=file_location('media_url','home/gal5.jpg')?>" alt="chinese lady" /></div>
			<div class="about-content">
			  <h2 class="j-bolder">About us</h2>
			  <p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas,
				consequuntur harum beatae inventore voluptatem numquam voluptatibus
				fuga, cupiditate cumque porro perferendis tempora, adipisci culpa odio
				molestias dolorem blanditiis quos ad!
			  </p>
			  <button class="btn outline"><a href="<?=file_location('home_url','misc/about_us/')?>">Read more</a></button>
			</div>
		</section>
		
		<section id="services" class="why-choseus">
			<div class="why-us">
			  <h2>Why Chose Us</h2>
			  <div class="inner-content">
				<div class="why-inner">
				  <img class="fas fa-notes-medical" alt="icon" src="" />
				  <p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit.
					Recusandae error explicabo possimus fugit fuga inventore tenetur
				  </p>
				</div>
				<div class="why-inner">
				  <img class="fas fa-notes-medical" alt="icon" src="" />
				  <p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit.
					Recusandae error explicabo possimus fugit fuga inventore tenetur
				  </p>
				</div>
				<div class="why-inner">
				  <img class="fas fa-notes-medical" alt="icon" src="" />
				  <p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit.
					Recusandae error explicabo possimus fugit fuga inventore tenetur
				  </p>
				</div>
			  </div>
			</div>
			<div class="why-img">
			  <img src="<?=file_location('media_url','home/gal2.jpg')?>" alt="doctor" />
			</div>
		</section>
	  
		  <section class="our-doctors">
			<div>
			  <h2>Meet the Medical Professionals</h2>
			  <p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet
				asperiores nihil a.
			  </p>
			</div>
			<div class="doctors">
				<?php
				for($i = 0; $i < 3; $i++){
					?>
					<div class="not-inner-doctor">
						<div class="doctor-img"><img class="j-round"src="<?=file_location('media_url','home/gal5.jpg')?>" alt="doctor" /></div>
						<div><div class='j-bolder j-large'>Doctor Name</div><div>Doctor Title</div></div>				
					</div>
					<?php
				}
				?>
			</div>
		  </section>
		  
		<section>
			<div class='j-color7 j-newsletter-padding'style=''>
				<center>
					<div class='j-xlarge'>Stay Updated</div>
					<div>Join our mailing list to receive updates on the latest news and programmes.</div>
				</center>
				<br>
				<div>
					<for class=''method='post'>
						<span class='mg j-text-color1'id='nme'></span>
						<input type='text'id='nm'name='nm'class="ip j-input j-color4 j-color4 j-round-large j-border-2 j-border-color5"placeholder='Name'style="width:100%;"/><br>
						<span class='mg j-text-color1'id='eme'></span>
						<input type='email'id='em'name='em'class="ip j-input j-color4 j-color4 j-round-large j-border-2 j-border-color5"placeholder='Email'style="width:100%;"/><br>
						<div style='padding-bottom: 20px;'class='j-itallic'>By clicking Subscribe, agree to receive notifications, updates, publications, alerts and newsletters from <?=ucwords(get_xml_data('company_name'))?>.</div>
						<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round-large j-bolder">Subscribe</button>
					</for>
				</div>
			</div>
		</section>
		<?php
		require_once(file_location('inc_path','footer.inc.php'));
		home_modal('login');home_modal('signup');
	}
	?>
<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>