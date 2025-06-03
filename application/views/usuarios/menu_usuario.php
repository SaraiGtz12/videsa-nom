	<!-- Main Container -->
        <main id="main-container">
		  <!-- Page Header -->
			<div class="content bg-gray-lighter">
				<div class="row items-push">
					<div class="col-sm-7">
                            <h1 class="page-heading">
                                Men&uacute; de Usuarios
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                <li>Usuarios</li>
                            </ol>
                        </div>
				</div>
			</div>
			<!-- END Page Header -->
			<!-- Page Content -->
			<div class="content">
				<!-- Mega Form -->
				<div class="row">
					<?php
						foreach ($menus as $menu){
							echo '<div class="col-sm-6 col-lg-3">';
								echo '<a class="block block-link-hover2" href="'.base_url().'index.php'.$menu['url'].'">';
									echo '<div class="block-content block-content-full text-center">';
										echo '<div>';
											echo '<img class="img-avatar img-avatar96" src="'.base_url().'assets/'.$menu['ico'].'" alt="">';
										echo '</div>';
										echo '<div class="h5 push-15-t push-5">'.$menu['descripcion'].'</div>';
									echo '</div>';
								echo '</a>';
							echo "</div>";
						}
					?>
				</div>
				<!-- END Mega Form -->	
			</div>
			<!-- END Page Content -->
            <script type="text/javascript">
            	
			</script>
        </main>