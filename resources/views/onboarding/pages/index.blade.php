@extends('onboarding.layouts.app')

@section('content')
	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<h3>What is a Value Idea?</h3>
			<p>When you start to build your personal brand it is very important that you give something of value to your audience in exchange for their contact information. This will help you re-connect with your audience and if they love what you're giving them, they'll invite their friends too and help you grow!</p>
			<p>For example, if you knew a lot about cars and your audience consists of car enthusiasts, something they <b>might</b> value is learning more about cars. Note that "might" exists in that sentence. We don't know exactly if that's something that your audience wants and that's where our software can help you test using the power of artificial intelligence.</p>
			<p>So let's get started. What's something of value you think your audience might want?</p>
		</div>
	</div>

	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<form action="/onboarding/create-idea" method="post" id="create_idea_form">
				@csrf
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<h5>Name of Value Idea:</h5>
							<p>Give this Value Idea a name. Don't worry, you can change it later.</p>
							<input type="text" name="idea_name" class="form-control" required>
						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<h5>Description of Value Idea:</h5>
							<p>Let's get a bit specific with this. The more specific you are, the better your vision will come out. Who will benefit? What is it that you're offering? Where will they receive that value? Why do you think they will like your offer?</p>
							<textarea class="form-control" name="idea_description" rows="3" form="create_idea_form" required></textarea>
						</div>
					</div>

					<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 col-xs-12">
						<input type="submit" value="Create Value Idea" class="btn btn-primary center-button">
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection