<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help and About us</title>

	<!-- External Stylesheets -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/help-about.css'); ?>">

</head>
<body>
    
    <div class="app-container">
        <div class="app-header">
			<div class="app-header-left">
				<span class="app-icon"></span>
				<p class="app-name">TechInquireHub</p>
			</div>
			<div class="app-header-right">
				<button class="mode-switch" title="Switch theme">
					<svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
						<defs></defs>
						<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
					</svg>
				</button>
				<button class="add-btn" title="Add new question" onclick="window.location.href='<?php echo site_url('dashboard/add_question'); ?>'">
					<svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
						<line x1="12" y1="5" x2="12" y2="19" />
						<line x1="5" y1="12" x2="19" y2="12" />
					</svg>
                    &nbsp Add Question
				</button>
			</div>
        </div>
		
		
        <div class="app-content">
			<?php $activeLink = 'help-about';?>
            <?php include('includes/sidebar.php'); ?>
			
			<div class="projects-section">
                <div class="projects-section-line">
                    <p>HELP CENTER - FAQs</p>
                </div>

                <div class="cards-container">
					<div class="owl-carousel owl-carousel1 owl-theme">
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Asking<br />
										<span>What types of questions should I avoid asking?</span>
									</h5>
									<p class="card-text">Ensure your question is relevant to this site.</p>
									<p class="card-text">Ask practical, answerable questions about real issues you're facing. Avoid open-ended or chatty questions as they can reduce the site's usefulness and overshadow other questions.</p>
									<p class="card-text">Keep your questions focused. If it would take a whole book to answer, it's too broad.</p>
									<p class="card-text">Don't ask questions about the site itself here.</p>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Asking<br />
										<span>What topics can I ask about here?</span>
									</h5>
									<p class="card-text">TechInquireHub is for professional and hobbyist programmers, or anyone passionate about coding.</p>
									<p class="card-text">The best TechInquireHub questions usually include some source code and address:</p>
										<ul>
											<li>Specific programming issues, or</li>
											<li>Software algorithms, or</li>
											<li>Commonly used programming tools; and is</li>
											<li>Practical, answerable problems unique to software development</li>
										</ul>
									<p class="card-text">If your question fits these criteria, you're in the right place!</p>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Asking<br />
										<span>What should I do if no one answers my question?</span>
									</h5>
									<p class="card-text">First, make sure you've asked a clear, well-formulated question.. </p>
									<p class="card-text">To get good answers, you might need to put extra effort into crafting your question. </p>
									<p class="card-text">Improve your question by adding status updates and documenting your continued efforts to solve it.</p>
									<p class="card-text">This will bring more attention to your question and increase the chances of getting answers.</p>
									<p class="card-text"></p>
									<p class="card-text"></p>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Asking<br />
										<span>What are tags, and how should I use them?</span>
									</h5>
									<p class="card-text">Tags are words or phrases describing the topic of your question. </p>
									<p class="card-text">They help connect experts with relevant questions by categorizing them.</p>
									<p class="card-text">Tags also help you find questions that interest you.</p>
									<p class="card-text">Clicking a tag will show you all questions associated with it.</p>
									<p class="card-text"></p>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Answering<br />
										<span>How do I write a good answer?</span>
									</h5>
									<p class="card-text">Thank you for contributing! Here are some tips for writing a great answer: </p>
									<p class="card-text">Understand what the question is asking and provide a direct answer or a viable alternative.</p>
									<p class="card-text">Your answers could say "don't do this or don't do that" but it should also say "do this and do that" or "try this out".</p>
									<p class="card-text">Upvote the answers that you find most helpful.</p>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Answering<br />
										<span>How to reference material written by others</span>
									</h5>
									<p class="card-text">Avoid plagiarism by properly crediting others' work.</p>
									<p class="card-text">If you use content you didn't create, you must:</p>
									<ul>
										<li>Provide a link to the original source</li>
										<li>Quote only the relevant part</li>
										<li>Credit the original author</li>
									</ul>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Model & Moderaton<br />
										<span>How do I use tags to find topics I'm interested in?</span>
									</h5>
									<p class="card-text">Use tags to discover specific questions of interest.</p>
									<p class="card-text">All questions are tagged with their main topics.</p>
									<p class="card-text">Visit the Tags page to browse or search for specific tags. </p>
									<p class="card-text">Clicking on a tag anywhere on the site will show all questions with that tag.</p>
								</div>
							</div>
						</div>
						<div>
							<div class="card text-center">
								<div class="card-body">
									<h5>Model & Moderaton<br />
										<span>Why is voting important?</span>
									</h5>
									<p class="card-text">Voting is crucial for highlighting quality content:; it is how …</p>
									<ul>
										<li>...good content rises to the top</li>
										<li>...incorrect content falls to the bottom</li>
										</ul>
									<p class="card-text">Upvoting signals that a post is interesting, well-researched, and useful.</p>
									<p class="card-text">Downvoting indicates that a post has incorrect information, is poorly researched, or unclear.</p>
									<p class="card-text"></p>
								</div>
							</div>
						</div>
						</div>
					</div>

                  	<!-- Site footer -->
					<footer class="site-footer">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-10">
								<h6>About</h6>
								<p class="text-justify">Welcome to TechInquireHub, a dedicated platform for the exchange of technical knowledge and expertise. Our community is a haven for individuals seeking solutions to technical challenges, and a hub for those passionate about sharing their insights. Whether you're a seasoned professional, a tech enthusiast, or someone facing a perplexing issue, TechInquireHub is your go-to destination. Pose your technical questions, explore a diverse range of topics, and engage with a community committed to collaborative problem-solving. Embrace the power of collective knowledge and join us on a journey where questions find answers and where expertise meets curiosity. Together, let's build a resourceful and supportive environment for all things technical!</p>
							</div>


							<div class="col-xs-6 col-md-2">
								<h6>Quick Links</h6>
								<ul class="footer-links">
								<li><a href="<?php echo site_url('dashboard/index'); ?>">Home</a></li>
								<li><a href="<?php echo site_url('dashboard/questions'); ?>">Questions</a></li>
								<li><a href="<?php echo site_url('tag/list_tags'); ?>">Tags</a></li>
								<li><a href="<?php echo site_url('savedQuestions/index'); ?>">Saved Questions</a></li>
								<li><a href="<?php echo site_url('dashboard/add_question'); ?>">Add Question</a></li>
								<li><a href="<?php echo site_url('profile/index'); ?>">Profile</a></li>
								</ul>
							</div>
						</div>
						<hr>
					</div>
					<div class="container">
							<div class="row">
							<div class="col-md-8 col-sm-6 col-xs-12">
								<p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by 
							<a href="<?php echo site_url('dashboard/index'); ?>" >TechIquireHub</a>.
								</p>
							</div>
						</div>
					</div>
				</footer>
            </div>

        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<script>
		(function () {
			"use strict";

			var carousels = function () {
				$(".owl-carousel1").owlCarousel({
					loop: true,
					center: true,
					margin: 0,
					responsiveClass: true,
					nav: false,
					responsive: {
						0: {
							items: 1,
							nav: false
						},
						680: {
							items: 2,
							nav: false,
							loop: false
						},
						1000: {
							items: 3,
							nav: true
						}
					}
				});
			};

			(function ($) {
				carousels();
			})
				
			(jQuery);
		})();
	</script>

	<!-- Include external JavaScript file -->
	<script src="<?php echo base_url('assets/js/mode-editor.js'); ?>"></script>

</body>
</html>