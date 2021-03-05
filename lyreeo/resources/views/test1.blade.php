@extends('frontend.layouts.master')
@section('content')

<style type="text/css">
	.container {
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  background: #292970d4;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  justify-content: center;
  align-content: center;
}

.flex {
  min-height: 60pt;
}

@-webkit-keyframes loading {
  0% {
    width: 50pt;
    height: 50pt;
    margin-top: 0;
  }
  25% {
    height: 4pt;
    margin-top: 23pt;
  }
  50% {
    width: 4pt;
  }
  75% {
    width: 50pt;
  }
  100% {
    width: 50pt;
    height: 50pt; margin-top: 0; } } 
@keyframes loading { 0% { width: 50pt; height: 50pt; margin-top: 0; } 25% { height: 4pt; margin-top: 23pt; } 50% { width: 4pt; } 75% { width: 50pt; } 100% { width: 50pt; height: 50pt; margin-top: 0; } }
.loader { width: 50pt; height: 50pt; border-radius: 100%; border: #6767fa 4pt solid; margin-left: auto; margin-right: auto; background-color: transparent; -webkit-animation: loading 1s infinite; animation: loading 1s infinite; }
.load-text { padding-top: 15px; text-align: center; font: 14pt "Helvetica Neue", Helvetica, Arial, sans-serif; color: white; }

</style>

	<div class="container">
		<div class="row">
			<div class="col-md-3 about-box-main">
				<div class="about-sidebar">
					<div class="sidebar-inner">						
						<div class="about-box">
						<img src="{{ asset('dist/images/home-box.png') }}">
						<div class="about-box-top">
							<a class="back-btn" href="human-resource.html">
							<img src="{{ asset('dist/images/arrow-left.png') }}">
							<img class="arrow-img2" src="{{ asset('dist/images/arrow-left2.png') }}"></a>						
						</div>
						<div class="about-box-inner">
							<h2>Smart City Logistics</h2>
						</div>
						</div>
					</div>
					<div class="sidebar-inner sidebar-bottom">
						<div class="sidebar-list">
							<div class="list-inner">
								<h6>Managed by:</h6>
								<span>Max Mustermann</span>
							</div>
							<div class="list-inner">
								<img src="{{ asset('dist/images/user-img1.png') }}">
							</div>
						</div>
						<div class="sidebar-list sidebar-text">
							<div class="list-inner">
								<h6>Project Members:</h6>
								<span>Martha Hamilton, Tony Balboa, Mike Stevenson, Roy Rob</span>
							</div>							
						</div>
						<div class="sidebar-list">
							<ul>
								<li><h6>START:</h6><span>11.12.2020</span></li>
								<li><h6>END (est.):</h6><span>11.12.2020</span></li>
								<li><h6>SPONSOR:</h6><span>John Doe</span></li>
								<li><h6>PROGRESS:</h6><span>70%</span></li>
								<li><h6>LAST UPDATE:</h6><span>18.12.2020</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9 about-content-main">
				<div class="about-content">
					<h2>About</h2>
					<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
					<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod.</p>
				</div>

				<div class="about-details">
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					  <div class="panel-body">
						<div class="about-content-inner">
							<h2>Current Situation</h2>
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="about-content-inner">
							<h2>Prerequisites, dependencies and exclusions</h2>
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="about-content-inner">
							<h2>Alternatives, Options</h2>
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="about-content-inner">
							<h2>Milestones</h2>
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="about-content-inner">
							<h2>Required Resources (financial, human, material)</h2>
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
						</div>
					  </div>
					</div>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">			
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						  <span>+</span><span class="minus-icon"></span>Show Details
						</a>					
					</div>
				</div>				
				<div class="feedback-section">
					<h2>Project Managers Feedback</h2>
					<div class="col-md-4 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src="{{ asset('dist/images/time-icon.png') }}">
								</div>
								<h2>Time</h2>
							</div>
							<div class="feedback-content">
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet nonumy eirmod.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src="{{ asset('dist/images/quality-icon2.png') }}">
								</div>
								<h2>Quality</h2>
							</div>
							<div class="feedback-content">
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet nonumy eirmod.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src="{{ asset('dist/images/coins1.png') }}">
								</div>
								<h2>Cost</h2>
							</div>
							<div class="feedback-content">
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet nonumy eirmod.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="project-details-main about-documents">
					<h2>Attached Files</h2>
					<div class="project-tagsarea">					
						<div class="add-tags">
							<p>Presentation.pptx</p>
						</div>
						<div class="add-tags">
							<p>Presentation.pptx</p>
						</div>
						<div class="add-tags">
							<p>Presentation.pptx</p>
						</div>
						<div class="add-tags">
							<p>Presentation.pptx<img src="{{ asset('dist/images/block.png') }}"></p>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>




	<div class="container">
<div class="flex">
<div class="loader">
</div>
</div>
<div class="load-text">
Loading...
</div>
</div>

@endsection