
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-static">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link href="{{ asset('icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ mix('css/default/all.css') }}" rel="stylesheet" type="text/css">
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body>
	<div class="page-content">

		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

			<div class="navbar navbar-dark bg-dark-100 navbar-static border-0">
				<div class="navbar-brand flex-fill wmin-0">
					<a href="index.html" class="d-inline-block">
						<img src="/images/logo_light.png" class="sidebar-resize-hide" alt="">
						<img src="/images/logo_icon_light.png" class="sidebar-resize-show" alt="">
					</a>
				</div>

				<ul class="navbar-nav align-self-center ml-auto sidebar-resize-hide">
					<li class="nav-item dropdown">
						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
							<i class="icon-transmission"></i>
						</button>

						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
							<i class="icon-cross2"></i>
						</button>
					</li>
				</ul>
			</div>

			<div class="sidebar-content">

				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<li class="nav-item">
							<a href="{{ route('dashboard') }}" class="nav-link">
								<i class="icon-home4"></i>
								<span>
									{{ __('Dashboard') }}
								</span>
							</a>
						</li>
					</ul>
				</div>

			</div>

		</div>

		<div class="content-wrapper">

			<div class="navbar navbar-expand-lg navbar-light navbar-static">
				<div class="d-flex flex-1 d-lg-none">
					<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
						<i class="icon-transmission"></i>
					</button>

					<button data-target="#navbar-search" type="button" class="navbar-toggler" data-toggle="collapse">
						<i class="icon-search4"></i>
					</button>
				</div>

				<div class="navbar-collapse collapse flex-lg-1 order-2 order-lg-1" id="navbar-search">
					<div class="navbar-search d-flex align-items-center py-2 py-lg-0">
						<div class="form-group-feedback form-group-feedback-left flex-grow-1">
							<input type="text" class="form-control" placeholder="Search">
							<div class="form-control-feedback">
								<i class="icon-search4 opacity-50"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">
					<ul class="navbar-nav flex-row">
						<li class="nav-item nav-item-dropdown-lg dropdown dropdown-user">
							<a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle" data-toggle="dropdown">
								<img src="/images/demo/users/face11.jpg" class="rounded-pill mr-lg-2" height="34" alt="">
								<span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
							</a>

							<div class="dropdown-menu dropdown-menu-right">
								<a href="{{ route('profile.show') }}" class="dropdown-item"><i class="icon-user-plus"></i> {{ __('Profile') }}</a>
								<div class="dropdown-divider"></div>
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<a href="{{ route('logout') }}" class="dropdown-item"
										onclick="event.preventDefault();
										this.closest('form').submit();"
									><i class="icon-switch2"></i> {{ __('Log Out') }}</a>
								</form>
							</div>
						</li>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<div class="page-header page-header-light">

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ __('Dashboard') }}</a>
								<a href="content_cards.html" class="breadcrumb-item">Content</a>
								<span class="breadcrumb-item active">Cards</span>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<a href="#" class="breadcrumb-elements-item">
									<i class="icon-comment-discussion mr-2"></i>
									Support
								</a>

								<div class="breadcrumb-elements-item dropdown p-0">
									<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
										<i class="icon-gear mr-2"></i>
										Settings
									</a>

									<div class="dropdown-menu dropdown-menu-right">
										<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
										<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
										<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="content">

				{{ $slot }}
				
			</div>

			<div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="https://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</span>

					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item"><a href="https://demo.interface.club/limitless/docs/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
					</ul>
				</div>
			</div>

		</div>

	</div>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
