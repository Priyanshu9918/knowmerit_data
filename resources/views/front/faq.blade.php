@extends('layouts.front.master')
@section('content')
<style type="text/css">
	.category-tab ul li a.active {
    border-radius: 0;
    border: 1px solid #ffbb00;
    color: #ffbb00;
}
</style>
<!-- <section class="section share-knowledge">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="knowledge-img aos aos-init aos-animate mt-4" data-aos="fade-up">
<img src="assets/img/students/certification.png" alt="" class="img-fluid">
</div>
</div>
<div class="col-md-6 d-flex align-items-center">
<div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
<h2>Learn anything from anywhere anytime</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam dolor fermentum massa viverra congue proin. A volutpat eget ultrices velit nunc orci. Commodo quis integer a felis ac vel mauris a morbi. Scelerisque</p>
<ul class="course-list">
<li><i class="fa-solid fa-circle-check"></i>Best Courses</li>
<li><i class="fa-solid fa-circle-check"></i>Top rated Instructors</li>
</ul>

</div>
</div>
</div>
</div>
</section> -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="text-center">FAQs</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content faq-top faq-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="category-tab">
					<ul class="nav d-flex justify-content-center">
						<li class="nav-item"><a href="#student" class="nav-link active" data-bs-toggle="tab" style="border-top-left-radius: 13px;border-bottom-left-radius: 13px;">Students</a></li>
						<li class="nav-item"><a href="#teacher" class="nav-link" data-bs-toggle="tab" style="border-top-right-radius: 13px;border-bottom-right-radius: 13px;">Teachers</a></li>

					</ul>
				</div>

                <div class="tab-content">
                    <div id="student" class="tab-pane fade show active"></div>
                    <div id="teacher" class="tab-pane fade"></div>
                </div>
				{{-- <div class="tab-content">
					<div class="tab-pane fade show active" id="student">
						<div class="row">
							<div class="col-lg-6">
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqone" aria-expanded="false">Find a teacher</a>
									</h6>
									<div id="faqone" class="collapse" style="">
									<div class="faq-detail">
								   <p>Join the largest community of teachers and students on Know Merit Our platform gives you access to thousands of teaching ads. Academics, languages, dance, sports… Unlimited choices!</p>
											<p>Go to Know Merit, then add the desired subject and your city in the search engine All the teachers available near you will appear!</p>
										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqtwo" aria-expanded="false">Manage my requests</a>
									</h6>
									<div id="faqtwo" class="collapse">
										<div class="faq-detail">
											<p>You choose your teacher and sent them a class request. The request has been accepted, you can now connect via your dashboard.Connect to your Know Merit messages to answer them. You can contact via messaging, phone or email.To have access to their contact details, click on their profile picture from your messages.</p>
											<p>Once the class request has been accepted, don't hesitate to schedule a class by sending them your availabilities.</p>
										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqthree" aria-expanded="false">My account</a>
									</h6>
									<div id="faqthree" class="collapse">
										<div class="faq-detail">
											<p>Go to the Know Merit website, click on “Sign up”, then let the magic happen.You can create your profile from your email address, your Facebook account or your Google account.</p>
											<p>Once your profile has been created, you can add your teachers to your "favourites".</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqfour" aria-expanded="false">Student Pass subscription</a>
									</h6>
									<div id="faqfour" class="collapse">
										<div class="faq-detail">
											<p>After selecting a teacher and sending your request, you can subscribe to the service offered by Know Merit: the Student Pass.</p>
											<h6>What are the advantages of a Student Pass?</h6>
											<ul>
												<li>It's the subscription that allows you to do everything on Know Merit</li>
												<li>Contact all the teachers on the platform for 30 days</li>
												<li>Securely book and pay for a course</li>
												<li>Securely book and pay for a course</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqfive" aria-expanded="false">What is Lorem Ipsum?</a>
									</h6>
									<div id="faqfive" class="collapse">
										<div class="faq-detail">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqsix" aria-expanded="false">What is Lorem Ipsum?</a>
									</h6>
									<div id="faqsix" class="collapse">
										<div class="faq-detail">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="teacher">
						<div class="row">
							<div class="col-lg-6">
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqone" aria-expanded="false">Become a Know Merit</a>
									</h6>
									<div id="faqone" class="collapse" style="">
										<div class="faq-detail">
											<p>Are you a professional teacher or simple a passionate about teaching? Share your knowledge on Know Merit!Have you already created an account? Log into your account and click on “Create an ad” on the top right corner of your profile.</p>

										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqtwo" aria-expanded="false">Manage my ad</a>
									</h6>
									<div id="faqtwo" class="collapse">
										<div class="faq-detail">
											<p>A change in your availability, your class location or your class content? Update your ad quickly! You can modify your ad at any time on your profile, it has never been easier:</p>
											<ul>
												<li>Access the <b>“My ads”</b> tab</li>
												<li>Click on the ad and the section you wish to modify</li>
												<li>Modify your content and click on validate</li>
											</ul>
											<p>Modify your content and click on validate</p>
                                            <p><b>Tip:</b> Do not hesitate to preview your ad to see how it will appear on the Superprof website. To do this, click on “view as a student”</p>

										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqthree" aria-expanded="false">Manage my requests</a>
									</h6>
									<div id="faqthree" class="collapse">
										<div class="faq-detail">
											<p>Congratulations, a student sent you a request! Upon receipt of the request, you have 72 hours to respond. Superprof informs you by email and SMS. So remember to configure your notifications (link to manage my notifications).</p>
											<h6>Accept a request</h6>
											<p>Access your messages, and click “Accept”.As soon as you are accepted, you can talk to the student and organize a first class.</p>
											<h6>Refuse a request</h6>
											<p>If you are unavailable, click on “Refuse” from your mailbox.</p>
											<p>You can leave a personalized refusal message:</p>
											<ul>
												<li>Click on “Refuse” twice</li>
												<li>Then on “Other”</li>
												<li>Write your message then validate!</li>
											</ul>
											<h6>Team tip</h6>
											<p>Short response times are highly appreciated by students, respond quickly!</p>

										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqfour" aria-expanded="false">Pro Pass subscription</a>
									</h6>
									<div id="faqfour" class="collapse">
										<div class="faq-detail">
											<p>Pro Pass, what is it?It is a subscription that gives you, the teacher many advantages:</p>
											<ul>
												<li>More visibility</li>
												<li>Statistics to help you improve your ad: visibility on the number of views of your ad</li>
												<li>A dedicated team to support you!</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqfive" aria-expanded="false">What is Lorem Ipsum?</a>
									</h6>
									<div id="faqfive" class="collapse">
										<div class="faq-detail">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

										</div>
									</div>
								</div>
								<div class="faq-card">
									<h6 class="faq-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#faqsix" aria-expanded="false">What is Lorem Ipsum?</a>
									</h6>
									<div id="faqsix" class="collapse">
										<div class="faq-detail">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $(".nav-link").on("click", function(event) {
            event.preventDefault();
            var targetTab = $(this).attr("href");
            loadTabContent(targetTab);
        });
    });

    function loadTabContent(tabId) {
        var url;

        if (tabId === '#student') {
            url = '/faq-student';
        } else if (tabId === '#teacher') {
            url = '/faq-teacher';
        }

        fetch(url)
            .then(response => response.text())
            .then(data => {
                const tab = $(tabId);
                tab.html(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    loadTabContent('#student');
</script>
@endpush
