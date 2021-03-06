<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle colorlib-nav-white"><i></i></a>

<nav class="colorlib-nav" role="navigation">
	<div class="top-menu">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div id="colorlib-logo"><a href="/">{{ config('app.name') }}</a></div>
				</div>
				<div class="col-md-10 text-right menu-1">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="/solutions">Solutions</a></li>
						{{-- <li><a href="/blog">Blog</a></li> --}}
						<li><a href="/contact">Contact</a></li>
						<li class="has-dropdown">
							<a>Members</a>
							<ul class="dropdown">
								<li><a href="/login">Login</a></li>
								<li><a href="/plan/1">Register for Beta</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>