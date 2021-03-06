<footer id="colorlib-footer">
	<div class="container">
		<div class="row row-pb-md">
			<div class="col-md-3 colorlib-widget">
				<h4>About {{ config('app.name') }}</h4>
				<p>Helping affiliate marketers test their ideas quicker and cheaper so they can provide more value to their audience and in the process make more money.</p>
				<p>
					<ul class="colorlib-social-icons">
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-facebook"></i></a></li>
					</ul>
				</p>
			</div>
			<div class="col-md-3 colorlib-widget">
				<h4>Helpful Links</h4>
				<p>
					<ul class="colorlib-footer-links">
						<li><a href="/"><i class="icon-check"></i> Home</a></li>
						<li><a href="/solutions"><i class="icon-check"></i> Solutions</a></li>
						{{-- <li><a href="/blog"><i class="icon-check"></i> Blog</a></li> --}}
						<li><a href="/contact"><i class="icon-check"></i> Contact</a></li>
						<li><a href="/privacy"><i class="icon-check"></i> Privacy</a></li>
					</ul>
				</p>
			</div>

				{{-- <div class="col-md-3 colorlib-widget">
					<h4>Recent Blog</h4>
					<div class="f-blog">
						<a href="blog.html" class="blog-img" style="background-image: url({{ URL::asset('/public_site/images/blog-1.jpg') }});">
						</a>
						<div class="desc">
							<h2><a href="blog.html">Photoshoot Technique</a></h2>
							<p class="admin"><span>30 March 2018</span></p>
						</div>
					</div>
					<div class="f-blog">
						<a href="blog.html" class="blog-img" style="background-image: url({{ URL::asset('/public_site/images/blog-2.jpg') }});">
						</a>
						<div class="desc">
							<h2><a href="blog.html">Camera Lens Shoot</a></h2>
							<p class="admin"><span>30 March 2018</span></p>
						</div>
					</div>
					<div class="f-blog">
						<a href="blog.html" class="blog-img" style="background-image: url({{ URL::asset('/public_site/images/blog-3.jpg') }});">
						</a>
						<div class="desc">
							<h2><a href="blog.html">Image the biggest photography studio</a></h2>
							<p class="admin"><span>30 March 2018</span></p>
						</div>
					</div>
				</div> --}}

			<div class="col-md-3 colorlib-widget">
				<h4>Contact</h4>
				<ul class="colorlib-footer-links">
					{{-- <li><a href="tel://1234567920"><i class="icon-phone"></i> + 1235 2355 98</a></li> --}}
					<li><a href="mailto:info@optindev.com"><i class="icon-envelope"></i> info@optindev.com</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="copy">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{ config('app.name') }} All rights reserved  | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>